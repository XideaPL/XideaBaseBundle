<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Xidea\Bundle\BaseBundle\Template\TemplateConfigurationPoolInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class TemplateManager implements TemplateManagerInterface
{
    /*
     * @var TemplateConfigurationPoolInterface
     */
    protected $configurationPool;
    
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * 
     * @param EngineInterface $templating
     */
    public function __construct(TemplateConfigurationPoolInterface $configurationPool, EngineInterface $templating)
    {
        $this->configurationPool = $configurationPool;
        $this->templating = $templating;
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $parameters = array())
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->render($this->configurationPool->getTemplate($name, $format), $parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->renderResponse($this->configurationPool->getTemplate($name, $format), $parameters, $response);
    }
}