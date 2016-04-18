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
class RoutingConfigurationCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $pool = 'xidea_base.routing.configuration.pool';
        
        if (!$container->hasDefinition($pool)) {
            return;
        }

        $definition = $container->getDefinition(
            $pool
        );

        $taggedServices = $container->findTaggedServiceIds(
            'xidea_base.routing.configuration'
        );
        
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addConfiguration',
                    array(new Reference($id), $attributes['priority'])
                );
            }
        }
    }
}