<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

use Xidea\Bundle\BaseBundle\ConfigurationPoolInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class TemplateManager implements TemplateManagerInterface
{
    /**
     * @var string
     */
    protected $context = 'xidea_base';

    /**
     * @var array
     */
    protected $configurationPool;
    
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * 
     * @param ConfigurationPoolInterface $configurationPool
     */
    public function __construct(ConfigurationPoolInterface $configurationPool, EngineInterface $templating)
    {
        $this->configurationPool = $configurationPool;
        $this->templating = $templating;
    }
    
    /**
     * @inheritDoc
     */
    public function setContext($context)
    {
        $this->context = $context;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getContext()
    {
        return $this->context;
    }
    
    /**
     * @inheritDoc
     */
    public function getConfiguration()
    {
        return $this->configurationPool->getConfiguration($this->getContext())->getTemplateConfiguration();
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $parameters = array())
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->render($this->getConfiguration()->getTemplate($name, $format), $parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->renderResponse($this->getConfiguration()->getTemplate($name, $format), $parameters, $response);
    }
}