<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection\Helper;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ExtensionHelper
{
    /*
     * @var string
     */
    protected $alias;
    
    public function __construct($alias)
    {
        $this->alias = $alias;
    }
    
    public function getAlias()
    {
        return $this->alias;
    }
    
    public function loadRoutingSection(array $config, array $routes, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        if(isset($config['routing'])) {
            $routes = array_merge($routes, $config['routing']['routes']);

            $parameters = array(
                'routing.scope' => $config['routing']['scope'],
                'routing.routes' => $routes
            );
            foreach($parameters as $name => $value) {
                $container->setParameter(sprintf('%s.%s', $this->getAlias(), $name), $value);
            }
            
            $routingConfigurationName = sprintf('%s.routing.configuration', $this->getAlias());
            $defaultRoutingConfigurationName = $routingConfigurationName.'.default';
            
            if(!$container->hasDefinition($defaultRoutingConfigurationName)) {
                $container->setDefinition($defaultRoutingConfigurationName, new Definition('Xidea\Bundle\BaseBundle\Routing\Configuration\DefaultConfiguration', [
                    $config['routing']['scope'],
                    $routes
                ]))
                ->addTag('xidea_base.routing.configuration', [
                    'priority' => $config['routing']['priority']
                ]);
            }
            
            $container->setAlias($routingConfigurationName, $config['routing']['configuration']);
        }
    }
    
    public function loadTemplatingSection(array $config, array $templates, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        if(isset($config['templating'])) {
            $templates = array_merge($templates, $config['templating']['templates']);

            $parameters = array(
                'templating.scope' => $config['templating']['scope'],
                'templating.engine' => $config['templating']['engine'],
                'templating.templates' => $templates
            );
            foreach($parameters as $name => $value) {
                $container->setParameter(sprintf('%s.%s', $this->getAlias(), $name), $value);
            }
            
            $templateConfigurationName = sprintf('%s.templating.configuration', $this->getAlias());
            $defaultTemplateConfigurationName = $templateConfigurationName.'.default';
            
            if(!$container->hasDefinition($defaultTemplateConfigurationName)) {
                $container->setDefinition($defaultTemplateConfigurationName, new Definition('Xidea\Bundle\BaseBundle\Templating\Configuration\DefaultConfiguration', [
                    $config['templating']['scope'],
                    $templates,
                    $config['templating']['engine']
                ]))
                ->addTag('xidea_base.templating.configuration', [
                    'priority' => $config['templating']['priority']
                ]);
            }
            
            $container->setAlias($templateConfigurationName, $config['templating']['configuration']);
        }
    }
    
    public function loadPaginationSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        if(isset($config['pagination'])) {
            $paginatorDefinitionName = sprintf('%s.paginator', $this->getAlias());            
            if($container->hasDefinition($paginatorDefinitionName)) {
                $paginatorDefinition = $container->getDefinition($paginatorDefinitionName);
                $paginatorDefinition->addMethodCall('setOptions', [[
                    'parameterName' => $config['pagination']['parameter_name']
                ]]);
            }
            $sorterDefinitionName = sprintf('%s.sorter', $this->getAlias());            
            if($container->hasDefinition($sorterDefinitionName)) {
                $sorterDefinition = $container->getDefinition($sorterDefinitionName);
                $sorterDefinition->addMethodCall('setOptions', [[
                    'parameterName' => $config['pagination']['sorter']['parameter_name'],
                    'defaultDirectionValue' => $config['pagination']['sorter']['default_direction_value']
                ]]);
            }
        }
    }
}
