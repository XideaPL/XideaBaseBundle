<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
abstract class AbstractExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        list($config, $loader) = $this->setUp($configs, new Configuration(), $container);

        if(isset($config['template']))
            $this->loadTemplateSection($config['template'], $container, $loader);
    }
    
    public function setUp(array $configs, ConfigurationInterface $configuration, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator($this->getConfigurationDirectory()));
        
        return array($config, $loader);
    }
    
    protected function loadConfigurationSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $services = array(
            'configuration',
            'template_configuration'
        );
        foreach($services as $service) {
            if(isset($config[$service]))
                $container->setAlias(sprintf('%s.%s', $this->getAlias(), $service), $config[$service]);
        }
    }
    
    protected function loadTemplateSection($prefix, array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $templates = array();
        foreach ($config['templates'] as $name => $parameters) {
            $templates[$name] = $parameters;
        }
        
        $container->setAlias($prefix.'.template.configuration', $config['configuration']);
        
        $parameters = array(
            'template.namespace' => $config['namespace'],
            'template.engine' => $config['engine'],
            'template.namespaced_paths' => $config['namespaced_paths'],
            'template.templates' => $templates
        );
        foreach($parameters as $name => $value) {
            $container->setParameter(sprintf('%s.%s', $prefix, $name), $value);
        }
    }

    abstract protected function getConfigurationDirectory();
}
