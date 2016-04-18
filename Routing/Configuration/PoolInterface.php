<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing\Configuration;

use Xidea\Bundle\BaseBundle\Routing\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface PoolInterface
{
    /**
     * Adds a configuration.
     *
     * @param ConfigurationInterface $configuration
     * @param int $priority
     */
    
    function addConfiguration(ConfigurationInterface $configuration, $priority = 0);
    
    /**
     * Returns a configuration.
     *
     * @return ConfigurationInterface
     */
    function getConfiguration($scope);
    
    /**
     * return array
     */
    function getConfigurations();
    
    /**
     * return array
     */
    function getRoutes();
    
    /**
     * 
     * @param string $name
     * 
     * @return array
     */
    function getRoute($name);
}
