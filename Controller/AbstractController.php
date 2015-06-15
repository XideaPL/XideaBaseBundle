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
     * @var string
     */
    protected $context = 'xidea_base';
    
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

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setTemplateManager(TemplateManagerInterface $templateManager)
    {
        $this->templateManager = $templateManager;
        
        $this->templateManager->setContext($this->context);
    }

    public function getTemplateManager()
    {
        return $this->templateManager;
    }

    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    protected function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }

    protected function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        if($this->getRouter())
            return $this->redirect($this->getRouter()->generate($route, $parameters), $status);
        
        throw new \LogicException();
    }

    protected function render($view, array $parameters = array(), Response $response = null)
    {
        if($this->getTemplateManager())
            return $this->getTemplateManager()->renderResponse($view, $parameters, $response);
        
        throw new \LogicException();
    }
    
    protected function dispatch($eventName, Event $event = null)
    {
        if($this->getEventDispatcher())
            return $this->getEventDispatcher()->dispatch($eventName, $event);
        
        throw new \LogicException();
    }
}
