<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ConfigurationInterface
{
    /**
     * Returns the code related to the configuration.
     * 
     * @return string
     */
    function getCode();
    
    /*
     * @return string
     */
    function getPaginationParameterName();
    
    /*
     * @return int
     */
    function getPaginationLimit();
    
    /*
     * @return array
     */
    function getPaginationLimitValues();
    
    /*
     * @return string
     */
    function getSortParameterName();
}
