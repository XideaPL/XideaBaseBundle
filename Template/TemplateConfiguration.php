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
    protected $namespace;

    /**
     * @var array
     */
    protected $templates;
    
    /**
     * @var string
     */
    protected $engine;
    
    /**
     * @var bool
     */
    protected $namespacedPaths = false;

    /**
     * 
     * @param string $namespace
     * @param string $templates
     * @param string $engine
     */
    public function __construct($namespace, $templates, $engine = 'twig')
    {
        $this->namespace = $namespace;
        $this->templates = $templates;
        $this->engine = $engine;
    }
    
    /**
     * @inheritDoc
     */
    public function setNamespacedPaths($namespacedPaths)
    {
        $this->namespacedPaths = $namespacedPaths;
    }
    
    /**
     * @inheritDoc
     */
    public function getNamespacedPaths()
    {
        return $this->namespacedPaths;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate($name, $format = 'html')
    {
        if(isset($this->templates[$name])) {
            $template = $this->templates[$name];
            
            if(isset($template['path'])) {
                $separator = $this->namespacedPaths ? '/' : ':';
                $namespace = isset($template['namespace']) ? $template['namespace'] : $this->namespace;
                $templateNamespace = $namespace ? sprintf('%s%s', $namespace, $separator) : '';
                
                return sprintf('%s%s.%s.%s', $templateNamespace, $template['path'], $format, $this->engine);
            }
        }
        
        throw new \Exception;
    }
}