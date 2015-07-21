<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface SorterInterface
{
    /**
     * @param Request $request
     */
    function setRequest(Request $request);
    
    /**
     * @return Request
     */
    function getRequest();
    
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
