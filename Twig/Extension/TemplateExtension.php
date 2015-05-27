<?php

namespace Xidea\Bundle\BaseBundle\Twig\Extension;

use Xidea\Bundle\BaseBundle\BaseTemplateConfigurationInterface;

class TemplateExtension extends \Twig_Extension {

    /*
     * @BaseTemplateConfigurationInterface
     */
    protected $templateConfiguration;

    /**
     * 
     * @param BaseTemplateConfigurationInterface $templateConfiguration
     */
    public function __construct(BaseTemplateConfigurationInterface $templateConfiguration) {
        $this->templateConfiguration = $templateConfiguration;
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
        return $this->templateConfiguration->getTemplate($context, $name, $format);
    }
}