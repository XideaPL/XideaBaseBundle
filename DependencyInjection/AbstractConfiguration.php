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
    
    public function getDefaultTemplateEngine()
    {
        return 'twig';
    }
    
    protected function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine(), array()))
            ->end();
    }
    
    protected function addTemplateNode($namespace, $engine, $templates = array(), $namespacedPaths = false)
    {
        $builder = new TreeBuilder();
        $node = $builder->root('template');
        
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('namespace')->defaultValue($namespace)->end()
                ->scalarNode('engine')->defaultValue($engine)->end()
                ->booleanNode('namespaced_paths')
                    ->defaultValue($namespacedPaths)
                ->end()
                ->arrayNode('templates')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('namespace')->defaultNull()->validate()->ifNull()->thenUnset()->end()->end()
                            ->scalarNode('path')->end()
                        ->end()
                    ->end()
                    ->defaultValue($templates)
                ->end()
            ->end()
        ;
        
        return $node;
    }
}
