<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class TemplateConfiguration implements TemplateConfigurationInterface
{
    /**
     * @var string
     */
    protected $scope;

    /**
     * @var array
     */
    protected $templates;
    
    /**
     * @var string
     */
    protected $engine;

    /**
     * 
     * @param string $scope
     * @param string $templates
     * @param string $engine
     */
    public function __construct($scope, $templates, $engine = 'twig')
    {
        $this->scope = $scope;
        $this->templates = $templates;
        $this->engine = $engine;
    }
    
    /**
     * @inheritDoc
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    /**
     * @inheritDoc
     */
    public function getScope()
    {
        return $this->scope;
    }
    
    /**
     * @inheritDoc
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }
    
    /**
     * @inheritDoc
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate($name, $format = 'html')
    {
        if(isset($this->templates[$name])) {
            $template = $this->templates[$name];
            
            if(isset($template['path'])) {                
                return sprintf('%s.%s.%s', $template['path'], $format, $this->engine);
            }
        }
        
        return false;
    }
}