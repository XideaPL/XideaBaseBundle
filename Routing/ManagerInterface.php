<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ManagerInterface
{
    /**
     * @return string
     */
    function url($name, array $parameters = array(), $referenceType = false);
    
    /**
     * @return RedirectResponse
     */
    function redirect($url, $status = 302, $headers = array());
}
