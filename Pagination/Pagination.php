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
     * @var int
     */
    protected $currentPageNumber;
    
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
     * {@inheritDoc}
     */
    public function setCurrentPageNumber($pageNumber)
    {
        $this->currentPageNumber = $pageNumber;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getCurrentPageNumber()
    {
        return $this->currentPageNumber;
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
    public function rewind() {
        reset($this->items);
    }
    
    /**
     * {@inheritDoc}
     */
    public function current() {
        return current($this->items);
    }
    
    /**
     * {@inheritDoc}
     */
    public function key() {
        return key($this->items);
    }
    
    /**
     * {@inheritDoc}
     */
    public function next() {
        next($this->items);
    }
    
    /**
     * {@inheritDoc}
     */
    public function valid() {
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