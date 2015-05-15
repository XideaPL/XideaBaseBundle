<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Doctrine\ORM;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ModelManagerInterface
{
    /**
     * @param bool $flushMode
     */
    function setFlushMode($flushMode = true);
    
    /**
     * @return bool
     */
    function isFlushMode();
    
    /**
     * @return void
     */
    function flush();
    
    /**
     * @return void
     */
    function clear();
}
