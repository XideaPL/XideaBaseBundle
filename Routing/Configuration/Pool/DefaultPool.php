<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing\Configuration\Pool;

use Xidea\Bundle\BaseBundle\Routing\Configuration\PoolInterface;
use Xidea\Bundle\BaseBundle\Routing\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultPool implements PoolInterface
{
    /**
     * @var array
     */
    protected $configurationScopes;
    
    /**
     * @var ConfigurationInterface[]
     */
    protected $configurations;
    
    /**
     * @inheritDoc
     */
    public function addConfiguration(ConfigurationInterface $configuration, $priority = 0)
    {
        $this->configurationScopes[$configuration->getScope()] = $priority;
        $this->configurations[$configuration->getScope()] = $configuration;
        
        $this->sortConfigurations();
    }

    /**
     * @inheritDoc
     */
    public function getConfiguration($scope)
    {
        return isset($this->configurations[$scope]) ? $this->configurations[$scope] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }
    
    /*
     * 
     */
    public function getRoute($name)
    {
        $resolveRoute = function($configuration, $name) {
            if(is_object($configuration)) {
                return $configuration->getRoute($name);
            }
            return [];
        };
        
        if(strpos($name, '@') !== false) {
            $routeData = explode('@', $name);
            $configuration = $this->getConfiguration($routeData[1]);
            $route = call_user_func($resolveRoute, $configuration, $routeData[0]);
            if($route) {
                return $route;
            }
        } else {
            foreach($this->configurationScopes as $scope => $priority) {
                $configuration = $this->getConfiguration($scope);
                $route = call_user_func($resolveRoute, $configuration, $name);
                if($route) {
                    return $route;
                }
            }
        }
        
        throw new \Exception;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoutes()
    {
        $routes = [];
        
        foreach($this->configurationScopes as $scope => $priority) {
            $configuration = $this->getConfiguration($scope);
            $routes += $configuration->getRoutes();
        }
        
        return $routes;
    }
    
    /**
     * @return array
     */
    protected function sortConfigurations()
    {
        return arsort($this->configurationScopes);
    }
}
