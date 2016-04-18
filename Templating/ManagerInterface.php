<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Templating;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ManagerInterface
{
    /**
     * @return string
     */
    function render($name, array $parameters = array());
    
    /**
     * @return Response
     */
    function renderResponse($name, array $parameters = array(), Response $response = null);
}
