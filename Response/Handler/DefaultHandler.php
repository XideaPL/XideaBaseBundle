<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Response\Handler;

use Xidea\Bundle\BaseBundle\Response\HandlerInterface;
use Xidea\Bundle\BaseBundle\Routing\ManagerInterface as RoutingManagerInterface;
use Xidea\Bundle\BaseBundle\Templating\ManagerInterface as TemplatingManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultHandler implements HandlerInterface
{
    /**
     * @var RoutingManagerInterface
     */
    protected $routingManager;
    
    /**
     * @var TemplatingManagerInterface
     */
    protected $templatingManager;

    /**
     * @param RoutingManagerInterface $routingManager
     * @param TemplatingManagerInterface $templatingManager
     */
    public function __construct(RoutingManagerInterface $routingManager, TemplatingManagerInterface $templatingManager)
    {
        $this->routingManager = $routingManager;
        $this->templatingManager = $templatingManager;
    }

    /**
     * @inheritDoc
     */
    public function url($name, array $parameters = array(), $referenceType = false)
    {
        return $this->routingManager->url($name, $parameters, $referenceType);
    }
    
    /**
     * @inheritDoc
     */
    public function view($name, array $parameters = array(), Response $response = null)
    {
        return $this->templatingManager->renderResponse($name, $parameters, $response);
    }
    
    /**
     * @inheritDoc
     */
    public function redirect($url, $status = 302, $headers = array())
    {
        return $this->routingManager->redirect($url, $status, $headers);
    }
}