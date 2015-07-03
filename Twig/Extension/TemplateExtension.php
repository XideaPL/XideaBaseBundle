<?php

namespace Xidea\Bundle\BaseBundle\Twig\Extension;

use Xidea\Bundle\BaseBundle\Template\TemplateConfigurationPoolInterface;

class TemplateExtension extends \Twig_Extension {

    /*
     * @var TemplateConfigurationPoolInterface
     */
    protected $configurationPool;

    /**
     * 
     * @param TemplateConfigurationPoolInterface $configurationPool
     */
    public function __construct(TemplateConfigurationPoolInterface $configurationPool) {
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
    
    public function getTemplate($name, $format = 'html') {
        return $this->configurationPool->getTemplate($name, $format);
    }
}