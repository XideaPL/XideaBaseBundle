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
use Xidea\Bundle\BaseBundle\Template\TemplateConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class TemplateManager implements TemplateManagerInterface
{
    /**
     * @var array
     */
    protected $configurationScopes;
    
    /**
     * @var TemplateConfigurationInterface[]
     */
    protected $configurations;
    
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * 
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }
    
    /**
     * @inheritDoc
     */
    public function addConfiguration(TemplateConfigurationInterface $configuration, $priority = 0)
    {
        $this->configurationScopes[$configuration->getScope()] = $priority;
        $this->configurations[$configuration->getScope()] = $configuration;
        
        $this->sortConfigurations();
    }

    /**
     * @inheritDoc
     */
    public function getConfiguration($scope)
    {
        return isset($this->configurations[$scope]) ? $this->configurations[$scope] : null;
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $parameters = array())
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->render($this->getTemplate($name, $format), $parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->renderResponse($this->getTemplate($name, $format), $parameters, $response);
    }
    
    /*
     * 
     */
    protected function getTemplate($name, $format)
    {
        $resolveTemplate = function($configuration, $name, $format) {
            if(is_object($configuration)) {
                return $configuration->getTemplate($name, $format);
            }
            return '';
        };
        
        if(strpos($name, '@') !== false) {
            $templateData = explode('@', $name);
            $configuration = $this->getConfiguration($templateData[1]);
            $template = call_user_func($resolveTemplate, $configuration, $templateData[0], $format);
            if($template) {
                return $template;
            }
        } else {
            foreach($this->configurationScopes as $scope => $priority) {
                $configuration = $this->getConfiguration($scope);
                $template = call_user_func($resolveTemplate, $configuration, $name, $format);
                if($template) {
                    return $template;
                }
            }
        }
        
        throw new \Exception;
    }
    
    /*
     * 
     */
    protected function sortConfigurations()
    {
        return arsort($this->configurationScopes);
    }
}