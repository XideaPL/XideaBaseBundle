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
     * @return Response
     */
    function view($template, array $parameters = array(), Response $response = null);
    
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function redirect($url, $status = Response::HTTP_FOUND, $headers = array());
    
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function redirectToRoute($route, array $parameters = array(), $status = Response::HTTP_FOUND, $headers = array());
}
