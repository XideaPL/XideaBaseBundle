<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection\Helper;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class ConfigurationHelper
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
    
    public function addRoutingSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('routing')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('scope')->defaultValue($this->getAlias())->end()
                        ->scalarNode('configuration')->defaultValue(sprintf('%s.routing.configuration.default', $this->getAlias()))->end()
                        ->scalarNode('priority')->defaultValue(0)->end()
                        ->arrayNode('routes')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('path')->end()
                                    ->arrayNode('defaults')
                                        ->useAttributeAsKey('name')
                                        ->prototype('scalar')->end()
                                        ->defaultValue([])
                                    ->end()
                                    ->arrayNode('requirements')
                                        ->useAttributeAsKey('name')
                                        ->prototype('scalar')->end()
                                        ->defaultValue([])
                                    ->end()
                                ->end()
                            ->end()
                            ->defaultValue([])
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    public function addTemplateSection(ArrayNodeDefinition $node, $engine = 'twig')
    {
        $node
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('scope')->defaultValue($this->getAlias())->end()
                        ->scalarNode('configuration')->defaultValue(sprintf('%s.template.configuration.default', $this->getAlias()))->end()
                        ->scalarNode('engine')->defaultValue($engine)->end()
                        ->scalarNode('priority')->defaultValue(0)->end()
                        ->arrayNode('templates')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('path')->end()
                                ->end()
                            ->end()
                            ->defaultValue([])
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    public function addPaginationSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pagination')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('parameter_name')->defaultValue('page')->end()
                        ->arrayNode('sorter')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('parameter_name')->defaultValue('sort')->end()
                                ->scalarNode('default_direction_value')->defaultValue('asc')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
