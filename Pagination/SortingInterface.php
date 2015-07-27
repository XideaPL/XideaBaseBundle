<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface SortingInterface
{
    /*
     * @return mixed
     */
    function getSorterOption($name);
    
    /*
     * @return array
     */
    function getSorterOptions();
    
    /**
     * @param string $route
     */
    function setRoute($route);
    
    /**
     * @return string
     */
    function getRoute();
    
    /**
     * @param array $parameters
     */
    function setRouteParameters(array $parameters);
    
    /**
     * @return array
     */
    function getRouteParameters();
    
    /**
     * @param string $name
     * @param mixed $value
     */
    function addRouteParameter($name, $value);
    
    /**
     * @param array $keys
     */
    function setKeys(array $keys);
    
    /**
     * @return array
     */
    function getKeys();
    
    /**
     * @param string $key
     * @param string $direction
     */
    function addKey($key, $direction = AbstractSorter::DIRECTION_VALUE);
    
    /*
     * @return bool
     */
    function isSorted($key);

    /**
     * @return array
     */
    function getDirections();
    
    /**
     * @param string $key
     * @param string $direction
     */
    function setDirection($key, $direction = AbstractSorter::DIRECTION_VALUE);
    
    /**
     * @param string $key
     * 
     * @return string
     */
    function getDirection($key);
    
    /**
     * @param string $key
     * 
     * @return string
     */
    function getNextDirection($key);
    
    /*
     * @return array
     */
    function getKeysWithDirections();
    
    /**
     * @return array
     */
    function getViewData();
}
