<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Templating\Configuration\Pool;

use Xidea\Bundle\BaseBundle\Templating\Configuration\PoolInterface;
use Xidea\Bundle\BaseBundle\Templating\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultPool implements PoolInterface
{
    /**
     * @var array
     */
    protected $configurationScopes;
    
    /**
     * @var ConfigurationInterface[]
     */
    protected $configurations;
    
    /**
     * @inheritDoc
     */
    public function addConfiguration(ConfigurationInterface $configuration, $priority = 0)
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
    public function getConfigurations()
    {
        return $this->configurations;
    }
    
    /*
     * 
     */
    public function getTemplate($name, $format = 'html')
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
