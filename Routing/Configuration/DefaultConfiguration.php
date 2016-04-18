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
class DefaultConfiguration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $scope;

    /**
     * @var array
     */
    protected $routes;

    /**
     * 
     * @param string $scope
     * @param string $routes
     */
    public function __construct($scope, $routes)
    {
        $this->scope = $scope;
        $this->routes = $routes;
    }
    
    /**
     * @inheritDoc
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    /**
     * @inheritDoc
     */
    public function getScope()
    {
        return $this->scope;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @inheritDoc
     */
    public function getRoute($name)
    {
        if(isset($this->routes[$name])) {
            return $this->routes[$name];
        }
        
        return [];
    }
}