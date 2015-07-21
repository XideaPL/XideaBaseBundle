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
interface PaginationInterface
{
    /**
     * @param int $pageNumber
     */
    function setCurrentPageNumber($pageNumber);
    
    /**
     * @return int
     */
    function getCurrentPageNumber();
    
    /**
     * @param int $limit
     */
    function setLimit($limit);
    
    /**
     * @return int
     */
    function getLimit($limit);
    
    /**
     * @param int $total
     */
    function setTotal($total);
    
    /**
     * @return int
     */
    function getTotal();
    
    /**
     * @param mixed $items
     */
    function setItems($items);
    
    /**
     * @return array
     */
    function getItems();
}
