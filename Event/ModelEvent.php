<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Event;

use Symfony\Component\EventDispatcher\Event,
    Symfony\Component\HttpFoundation\Request;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ModelEvent extends Event
{

    /**
     * @var TicketInterface
     */
    protected $model;
    
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructs an event.
     *
     * @param mixed $model The model
     */
    public function __construct($model, Request $request = null)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
    
    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
