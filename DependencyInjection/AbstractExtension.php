<?php

namespace Xidea\Bundle\BaseBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Definition;

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

        $this->loadTemplateSection($config, $container, $loader);
    }
    
    public function setUp(array $configs, ConfigurationInterface $configuration, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator($this->getConfigurationDirectory()));
        
        return array($config, $loader);
    }
    
    protected function loadTemplateSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        if(isset($config['template'])) {
            $templates = array_merge($this->getDefaultTemplates(), $config['template']['templates']);

            $parameters = array(
                'template.scope' => $config['template']['scope'],
                'template.engine' => $config['template']['engine'],
                'template.templates' => $templates
            );
            foreach($parameters as $name => $value) {
                $container->setParameter(sprintf('%s.%s', $this->getAlias(), $name), $value);
            }
            
            $templateConfigurationName = sprintf('%s.template.configuration', $this->getAlias());
            $defaultTemplateConfigurationName = $templateConfigurationName.'.default';
            
            if(!$container->hasDefinition($defaultTemplateConfigurationName)) {
                $container->setDefinition($defaultTemplateConfigurationName, new Definition('Xidea\Bundle\BaseBundle\Template\TemplateConfiguration', [
                    $config['template']['scope'],
                    $templates,
                    $config['template']['engine']
                ]))
                ->addTag('xidea_base.template.configuration', [
                    'priority' => $config['template']['priority']
                ]);
            }
            
            $container->setAlias($templateConfigurationName, $config['template']['configuration']);
        }
    }

    abstract protected function getConfigurationDirectory();
    
    protected function getDefaultTemplates()
    {
        return array();
    }
}
