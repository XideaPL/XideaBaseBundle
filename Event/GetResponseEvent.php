<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Event;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class GetResponseEvent extends ModelEvent
{
    private $response;
    
    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

}
