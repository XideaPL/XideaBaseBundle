<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ConfigurationInterface
{
    /**
     * 
     * @param string $scope
     */
    function setScope($scope);
    
    /**
     * @return string
     */
    function getScope();
    
    /**
     * Returns routes.
     *
     * @return array
     */
    function getRoutes();
    
    /**
     * Returns a route.
     *
     * @return array
     */
    function getRoute($name);
}
