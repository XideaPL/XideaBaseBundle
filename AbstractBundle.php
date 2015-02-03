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
        
        $this->addRegisterMappingsPass($container);
    }
    
    /**
     * @param ContainerBuilder $container
     */
    protected function addRegisterMappingsPass(ContainerBuilder $container)
    {
        $mappings = $this->getModelMappings();
        
        if(!empty($mappings)) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver($mappings));
        }
    }
    
    protected function getModelMappings()
    {
        return array();
    }
}
