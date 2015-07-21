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
interface PaginatorStrategyInterface
{
    /**
     * @return int
     */
    function getTotal();
    
    /**
     * @return array
     */
    function paginate($target, $offset, $limit);
    
    /**
     * 
     * @param mixed $target
     * 
     * @return bool
     */
    function support($target);
}
