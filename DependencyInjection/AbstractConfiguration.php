<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    /*
     * @var string
     */
    protected $alias;
    
    public function __construct($alias)
    {
        $this->alias = $alias;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        return $treeBuilder;
    }
    
    abstract public function getDefaultTemplateNamespace();
    
    abstract public function getDefaultTemplates();
    
    public function getDefaultTemplateEngine()
    {
        return 'twig';
    }
    
    protected function addConfigurationSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('template_configuration')->isRequired()->cannotBeEmpty()->end()
            ->end();
    }
    
    protected function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('namespace')->defaultValue($this->getDefaultTemplateNamespace())->end()
                        ->scalarNode('engine')->defaultValue($this->getDefaultTemplateEngine())->end()
                        ->arrayNode('templates')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('path')->end()
                                ->end()
                            ->end()
                            ->defaultValue($this->getDefaultTemplates())
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
