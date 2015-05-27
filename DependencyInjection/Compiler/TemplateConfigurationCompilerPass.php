<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\Reference;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class TemplateConfigurationCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $configuration = $container->getAlias('xidea_base.template.base_configuration');
        
        if (!$container->hasDefinition($configuration)) {
            return;
        }

        $definition = $container->getDefinition(
            $configuration
        );

        $taggedServices = $container->findTaggedServiceIds(
            'xidea_base.template.configuration'
        );
        
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addConfiguration',
                    array($attributes['alias'], new Reference($id))
                );
            }
        }
    }
}