<?php

namespace Xidea\Bundle\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

abstract class AbstractBundle extends Bundle
{
    public function getBundlePrefix()
    {
        return 'XideaBaseBundle';
    }
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $this->addRegisterMappingsPass($container, $this->getBundlePrefix());
    }
    
    /**
     * @param ContainerBuilder $container
     */
    protected function addRegisterMappingsPass(ContainerBuilder $container, $bundlePrefix)
    {
        $mappings = $this->getModelMappings();
        
        if(!empty($mappings)) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array(),
                false,
                array($bundlePrefix => $this->getModelNamespace())
            ));
        }
    }
    
    protected function getModelNamespace()
    {
        return 'Xidea\Component\Base\Model';
    }
    
    protected function getModelMappings()
    {
        return array(
            sprintf($this->getConfigPath().'/%s', $this->getDoctrineMappingDirectory()) => $this->getModelNamespace()
        );
    }
    
     protected function getDoctrineMappingDirectory()
    {
        return 'doctrine/model';
    }
    
    protected function getConfigPath()
    {
        return sprintf(
            '%s/Resources/config',
            $this->getPath()
        );
    }
}
