<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface TemplateConfigurationPoolInterface
{
    /**
     * Adds a configuration.
     *
     * @param TemplateConfigurationInterface $configuration
     * @param int $priority
     */
    
    function addConfiguration(TemplateConfigurationInterface $configuration, $priority = 0);
    
    /**
     * Returns a configuration.
     *
     * @return TemplateConfigurationInterface
     */
    function getConfiguration($scope);
    
    /**
     * return array
     */
    function getConfigurations();
    
    /**
     * 
     * @param string $name
     * @param string $format
     */
    function getTemplate($name, $format = 'html');
}
