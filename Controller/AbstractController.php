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
use Xidea\Bundle\BaseBundle\Template\TemplateManagerInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractController
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
     * @var RouterInterface
     */
    protected $router;

    /*
     * @var TranslatorInterface
     */
    protected $translator;

    /*
     * @var TemplateManagerInterface
     */
    protected $templateManager;

    /**
     * 
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

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
     * @param TemplateManagerInterface $templateManager
     */
    public function setTemplateManager(TemplateManagerInterface $templateManager)
    {
        $this->templateManager = $templateManager;
    }

    /**
     * 
     * @return TemplateManagerInterface
     */
    public function getTemplateManager()
    {
        return $this->templateManager;
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
     * @param string $url
     * @param int $status
     * @return RedirectResponse
     */
    protected function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
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
        if($this->getRouter())
            return $this->redirect($this->getRouter()->generate($route, $parameters), $status);
        
        throw new \LogicException();
    }

    /**
     * 
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     * @return Response
     * @throws \LogicException
     */
    protected function render($view, array $parameters = array(), Response $response = null)
    {
        if($this->getTemplateManager())
            return $this->getTemplateManager()->renderResponse($view, $parameters, $response);
        
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
