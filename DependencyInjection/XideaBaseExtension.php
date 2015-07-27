<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaBaseExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        list($config, $loader) = $this->setUp($configs, new Configuration($this->getAlias()), $container);

        $loader->load('main.yml');
        $loader->load('twig.yml');
        
        $this->loadTemplateSection($config, $container, $loader);
        $this->loadPaginationSection($config, $container, $loader);
    }
    
    protected function getConfigurationDirectory()
    {
        return __DIR__.'/../Resources/config';
    }
    
    protected function getDefaultTemplates()
    {
        return [
            'main' => ['path' => '/main'],
            'base_pagination_bootstrap_v3' => ['path' => '@XideaBase/Pagination/pagination_bootstrap_v3'],
            'base_sorting' => ['path' => '@XideaBase/Pagination/sorting']
        ];
    }
}
