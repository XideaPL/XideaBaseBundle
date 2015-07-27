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
class Sorting implements SortingInterface
{
    /*
     * @var array
     */
    protected $sorterOptions = [];
    
    /*
     * @var string
     */
    protected $route;
    
    /*
     * @var array
     */
    protected $routeParameters;
    
    /*
     * @var array
     */
    protected $keys = [];
    
    /*
     * @var array
     */
    protected $directions = [];
    
    /**
     * 
     * @param array $sorterOptions
     */
    public function __construct(array $sorterOptions)
    {
        $this->sorterOptions = $sorterOptions;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getSorterOption($name)
    {
        return isset($this->sorterOptions[$name]) ? $this->sorterOptions[$name] : null;
    }
    
    /*
     * {@inheritDoc}
     */
    public function getSorterOptions()
    {
        return $this->sorterOptions;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRoute()
    {
        return $this->route;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setRouteParameters(array $parameters)
    {
        $this->routeParameters = $parameters;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRouteParameters()
    {
        return $this->routeParameters;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addRouteParameter($name, $value)
    {
        $this->routeParameters[$name] = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setKeys(array $keys)
    {
        foreach($keys as $key => $direction) {
            $this->addKey($key, $direction);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getKeys()
    {
        return $this->keys;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addKey($key, $direction = AbstractSorter::DIRECTION_VALUE) {
        $this->keys[] = $key;
        $this->directions[$key] = $direction;
    }
    
    /**
     * {@inheritDoc}
     */
    public function isSorted($key)
    {
        return in_array($key, $this->keys);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDirections()
    {
        return $this->directions;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDirection($key, $direction = AbstractSorter::DIRECTION_VALUE) {
        if(isset($this->directions[$key])) {
            $this->directions[$key] = $direction;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDirection($key)
    {
        if(isset($this->directions[$key])) {
            return $this->directions[$key];
        }
        
        return AbstractSorter::DIRECTION_VALUE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getNextDirection($key)
    {
        $direction = $this->getDirection($key);
        $directionValues = $this->getSorterOption('availableDirectionValues');
        
        if(count($directionValues) > 1) {
            $last = end($directionValues);
            if($last == $direction) {
                $direction = $directionValues[0];
            } else {
                $index = array_search($direction, $directionValues);
                $direction = $directionValues[$index + 1];
            }
        }
        
        return $direction;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getKeysWithDirections()
    {
        $result = [];
        
        foreach($this->keys as $key) {
            $result[$key] = $this->directions[$key];
        }
        
        return $result;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getViewData()
    {
        return [
            'parameterName' => $this->getSorterOption('parameterName')
        ];
    }
}