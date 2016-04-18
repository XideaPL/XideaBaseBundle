<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\Routing\RouterInterface,
    Symfony\Component\EventDispatcher\EventDispatcherInterface,
    Symfony\Component\EventDispatcher\Event,
    Symfony\Component\Translation\TranslatorInterface;
use Xidea\Bundle\BaseBundle\Response\HandlerInterface as ResponseHandlerInterface;
use Xidea\Bundle\BaseBundle\Templating\ManagerInterface as TemplatingManagerInterface;
use Xidea\Base\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
trait BaseControllerTrait
{
    /*
     * @var ConfigurationInterface
     */
    protected $configuration;

    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;
    
    /*
     * @var ResponseHandlerInterface
     */
    protected $responseHandler;

    /*
     * @var RouterInterface
     */
    protected $router;

    /*
     * @var TranslatorInterface
     */
    protected $translator;

    /*
     * @var TemplatingManagerInterface
     */
    protected $templatingManager;

    /**
     * 
     * @return ConfigurationInterface
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * 
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * 
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
    
    /**
     * 
     * @param ResponseHandlerInterface $responseHandler
     */
    public function setResponseHandler(ResponseHandlerInterface $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    /**
     * 
     * @return ResponseHandlerInterface
     */
    public function getResponseHandler()
    {
        return $this->responseHandler;
    }

    /**
     * 
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * 
     * @return RouterInterface
     */
    public function getRouter()
    {
        return $this->router;
    }
    
    /**
     * 
     * @param TemplatingManagerInterface $templatingManager
     */
    public function setTemplatingManager(TemplatingManagerInterface $templatingManager)
    {
        $this->templatingManager = $templatingManager;
    }

    /**
     * 
     * @return TemplatingManagerInterface
     */
    public function getTemplatingManager()
    {
        return $this->templatingManager;
    }

    /**
     * 
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * 
     * @return TranslatorInterface
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * 
     * @param string $route
     * @param array $parameters
     * @param int $status
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        if($this->getResponseHandler())
            return $this->getResponseHandler()->redirect($this->getResponseHandler()->url($route, $parameters), $status);
        
        throw new \LogicException();
    }
    
    /**
     * 
     * @param type $eventName
     * @param Event|null $event
     * @return \Symfony\Component\EventDispatcher\Event
     * @throws \LogicException
     */
    protected function dispatch($eventName, Event $event = null)
    {
        if($this->getEventDispatcher())
            return $this->getEventDispatcher()->dispatch($eventName, $event);
        
        throw new \LogicException();
    }
}
