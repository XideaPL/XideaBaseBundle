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
use Symfony\Component\HttpFoundation\RedirectResponse;

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
    function view($template, array $parameters = array(), Response $response = null)
    {
        return new Response($this->templatingManager->render($template, $parameters, $response));
    }
    
    /**
     * @inheritDoc
     */
    function redirect($url, $status = Response::HTTP_FOUND, $headers = array())
    {
        return new RedirectResponse($url, $status, $headers);
    }
    
    /**
     * @inheritDoc
     */
    public function redirectToRoute($route, array $parameters = array(), $status = Response::HTTP_FOUND, $headers = array())
    {
        return new RedirectResponse($this->routingManager->url($route, $parameters), $status, $headers);
    }
}