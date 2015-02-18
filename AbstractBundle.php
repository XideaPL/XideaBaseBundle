<?php

namespace Xidea\Bundle\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

abstract class AbstractBundle extends Bundle
{    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $this->addRegisterMappingsPass($container, $this->getName());
    }
    
    /**
     * @param ContainerBuilder $container
     */
    protected function addRegisterMappingsPass(ContainerBuilder $container, $bundleName)
    {
        $mappings = $this->getModelMappings();
        
        if(!empty($mappings)) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array(),
                false,
                array($bundleName => $this->getModelNamespace())
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
