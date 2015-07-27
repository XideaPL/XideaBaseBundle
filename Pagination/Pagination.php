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
class Pagination implements PaginationInterface, \Countable, \Iterator, \ArrayAccess
{
    /*
     * @var array
     */
    protected $paginatorOptions;
    
    /*
     * @var SortingInterface
     */
    protected $sorting;
    
    /*
     * @var string
     */
    protected $route;
    
    /*
     * @var array
     */
    protected $routeParameters = [];
    
    /*
     * @var int
     */
    protected $currentPage;

    /*
     * @var int
     */
    protected $limit;

    /*
     * @var int
     */
    protected $total;

    /*
     * @var array
     */
    protected $items = [];
    
    /**
     * 
     * @param array $paginatorOptions
     */
    public function __construct(array $paginatorOptions)
    {
        $this->paginatorOptions = $paginatorOptions;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPaginatorOption($name)
    {
        return isset($this->paginatorOptions[$name]) ? $this->paginatorOptions[$name] : null;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPaginatorOptions()
    {
        return $this->paginatorOptions;
    }

    /**
     * {@inheritDoc}
     */
    public function setSorting(SortingInterface $sorting = null)
    {
        $this->sorting = $sorting;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getSorting()
    {
        return $this->sorting;
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
    public function setCurrentPage($page)
    {
        $this->currentPage = $page;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * {@inheritDoc}
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * {@inheritDoc}
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * {@inheritDoc}
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritDoc}
     */
    public function setItems($items)
    {
        if (!is_array($items) && !$items instanceof \Traversable) {
            throw new \UnexpectedValueException("Items must be an array type");
        }
        $this->items = $items;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function getPageCount()
    {
        return intval(ceil($this->total / $this->limit));
    }

    /**
     * {@inheritDoc}
     */
    public function getViewData()
    {
        $pageCount = $this->getPageCount();
        $current = $this->getCurrentPage();

        if ($pageCount < $current) {
            $this->setCurrentPage($current = $pageCount);
        }

        $viewData = [
            'parameterName' => $this->getPaginatorOption('parameterName'),
            'route' => $this->getRoute(),
            'last' => $pageCount,
            'current' => $current,
            'limit' => $this->limit,
            'first' => 1,
            'pageCount' => $pageCount,
            'total' => $this->total
        ];
        
        if($current > 1) {
            $viewData['previous'] = $current - 1;
        }
        
        if($current < $pageCount) {
            $viewData['next'] = $current + 1;
        }
        
        return $viewData;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        reset($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        next($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return key($this->items) !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

}
