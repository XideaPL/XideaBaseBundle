<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface BaseTemplateConfigurationInterface
{
    /**
     * 
     * @param string $context
     * @param \Xidea\Bundle\BaseBundle\TemplateConfigurationInterface $configuration
     */
    function addConfiguration($context, TemplateConfigurationInterface $configuration);
    
    /**
     * 
     * @param string $context
     * 
     * @return TemplateConfigurationInterface
     */
    function getConfiguration($context);
    
    /**
     * return array
     */
    function getConfigurations();
    
    /**
     * Returns a template.
     *
     * @return string
     */
    function getTemplate($context, $name, $format = 'html');
}
