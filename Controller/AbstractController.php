<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\Routing\RouterInterface,
    Symfony\Component\EventDispatcher\EventDispatcherInterface,
    Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
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
     * @var TemplatingInterface
     */
    protected $templating;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function getTemplateConfiguration()
    {
        return $this->configuration->getTemplateConfiguration();
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
    
    public function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }
    
    public function getTemplating()
    {
        return $this->templating;
    }
    
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function getTranslator()
    {
        return $this->translator;
    }
}
