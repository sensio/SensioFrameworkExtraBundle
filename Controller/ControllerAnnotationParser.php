<?php

namespace Bundle\Sensio\FrameworkExtraBundle\Controller;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Bundle\Sensio\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Bundle\Sensio\FrameworkExtraBundle\Configuration\AnnotationReader;

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * .
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class ControllerAnnotationParser
{
    protected $reader;

    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Registers a core.controller listener.
     *
     * @param Symfony\Component\EventDispatcher\EventDispatcher $dispatcher An EventDispatcher instance
     */
    public function register(EventDispatcher $dispatcher)
    {
        $dispatcher->connect('core.controller', array($this, 'filter'));
    }

    /**
     * 
     *
     * @param Event $event An Event instance
     */
    public function filter(Event $event, $controller)
    {
        if (!is_array($controller)) {
            return $controller;
        }

        $object = new \ReflectionObject($controller[0]);
        $method = $object->getMethod($controller[1]);

        $request = $event->get('request');

        $annotations = array_merge(
            $this->reader->getClassAnnotations($object),
            $this->reader->getMethodAnnotations($method)
        );

        foreach ($annotations as $configuration) {
            if ($configuration instanceof ConfigurationInterface) {
                $request->attributes->set('_'.$configuration->getAliasName(), $configuration);
            }
        }

        return $controller;
    }
}
