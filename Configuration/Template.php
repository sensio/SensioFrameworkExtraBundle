<?php

namespace Sensio\Bundle\FrameworkExtraBundle\Configuration;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * The Template class handles the @extra:Template annotation parts.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Template implements ConfigurationInterface
{
    /**
     * The template reference.
     *
     * @var TemplateReference
     */
    protected $template;
    /**
     * The associative array of template variables.
     *
     * @var array
     */
    protected $vars = array();

    /**
     * Returns the array of templates variables.
     *
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * Sets the template variables
     *
     * @param array $vars The template variables
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     * Sets the template logic name.
     *
     * @param string $template The template logic name
     */
    public function setValue($template)
    {
        $this->setTemplate($template);
    }

    /**
     * Returns the template reference.
     *
     * @return TemplateReference
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the template reference.
     *
     * @param TemplateReference $template The template reference
     */
    public function setTemplate(TemplateReference $template)
    {
        $this->template = $template;
    }

    /**
     * Returns the annotation alias name.
     *
     * @return string
     * @see ConfigurationInterface
     */
    public function getAliasName()
    {
        return 'template';
    }
}
