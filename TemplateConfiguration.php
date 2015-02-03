<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle;

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

    public function __construct($namespace, $templates, $engine = 'twig')
    {
        $this->namespace = $namespace;
        $this->templates = $templates;
        $this->engine = $engine;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate($name, $format = 'html')
    {
        return sprintf('%s:%s.%s.%s', $this->namespace ?: ':', $this->getTemplatePath($name), $format, $this->engine);
    }
    
    protected function getTemplatePath($name)
    {
        if(isset($this->templates[$name])) {
            $template = $this->templates[$name];
            
            return $template['path'];
        }
        
        throw new \Exception;
    }
}
