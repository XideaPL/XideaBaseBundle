<?php

namespace Xidea\Bundle\BaseBundle\Twig\Extension;

use Xidea\Bundle\BaseBundle\ConfigurationPoolInterface;

class TemplateExtension extends \Twig_Extension {

    /*
     * @var ConfigurationPoolInterface
     */
    protected $configurationPool;

    /**
     * 
     * @param ConfigurationPoolInterface $configurationPool
     */
    public function __construct(ConfigurationPoolInterface $configurationPool) {
        $this->configurationPool = $configurationPool;
    }
    
    public function getFunctions()
    {
        return array(
            'xidea_template' => new \Twig_Function_Method($this, 'getTemplate', array('is_safe' => array('html')))
        );
    }

    public function getName() {
        return 'xidea_base_template';
    }
    
    public function getTemplate($context, $name, $format = 'html') {
        $configuration = $this->configurationPool->getConfiguration($context);
        
        if(is_object($configuration)) {
            return $configuration->getTemplateConfiguration->getTemplate($name, $format);
        }
        
        throw new \LogicException;
    }
}