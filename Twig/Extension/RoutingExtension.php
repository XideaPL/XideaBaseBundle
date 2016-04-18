<?php

namespace Xidea\Bundle\BaseBundle\Twig\Extension;

use Xidea\Bundle\BaseBundle\Templating\Configuration\PoolInterface;

class RoutingExtension extends \Twig_Extension {

    /*
     * @var PoolInterface
     */
    protected $configurationPool;

    /**
     * 
     * @param PoolInterface $configurationPool
     */
    public function __construct(PoolInterface $configurationPool) {
        $this->configurationPool = $configurationPool;
    }
    
    public function getFunctions()
    {
        return array(
            'xidea_route' => new \Twig_Function_Method($this, 'getRoute', array('is_safe' => array('html')))
        );
    }

    public function getName() {
        return 'xidea_base_routing';
    }
    
    public function getRoute($name) {
        return $this->configurationPool->getRoute($name);
    }
}