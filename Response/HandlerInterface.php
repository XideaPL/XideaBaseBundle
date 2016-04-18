<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Response;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface HandlerInterface
{
    /**
     * @return string
     */
    function url($name, array $parameters = array(), $referenceType = false);
    
    /**
     * @return Response
     */
    function view($name, array $parameters = array(), Response $response = null);
    
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function redirect($url, $status = 302, $headers = array());
}
