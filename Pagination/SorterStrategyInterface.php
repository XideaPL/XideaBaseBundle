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
interface SorterStrategyInterface
{
    /**
     * @param mixed $target
     * @param array $keys
     * @param array $directions
     * 
     * @return array
     */
    function sort($target, $keys, $directions);
    
    /**
     * 
     * @param mixed $target
     * 
     * @return bool
     */
    function support($target);
}
