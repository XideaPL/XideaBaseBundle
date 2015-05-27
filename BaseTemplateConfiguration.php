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
class BaseTemplateConfiguration implements BaseTemplateConfigurationInterface
{
    /**
     * @var array
     */
    protected $configurations = array();
    
    /**
     * @inheritDoc
     */
    public function addConfiguration($context, TemplateConfigurationInterface $configuration)
    {
        $this->configurations[$context] = $configuration;
    }
    
    /**
     * @inheritDoc
     */
    public function getConfiguration($context)
    {
        return isset($this->configurations[$context]) ? $this->configurations[$context] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate($context, $name, $format = 'html')
    {
        $configuration = $this->getConfiguration($context);
        
        if($configuration) {
            return $configuration->getTemplate($name, $format);
        }
        
        throw new Exception();
    }
}
