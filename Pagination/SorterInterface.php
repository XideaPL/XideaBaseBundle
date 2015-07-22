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
interface SorterInterface
{
    /**
     * @param array $options
     */
    function setOptions(array $options);
    
    /**
     * @return array
     */
    function getOptions();
    
    /**
     * @return void
     */
    function sort($target, array $options = []);
}
