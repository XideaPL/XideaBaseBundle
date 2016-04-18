<?php

namespace Xidea\Bundle\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;
use Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass,
    Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\TemplatingConfigurationCompilerPass;

class XideaBaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ConfigurationCompilerPass());
        $container->addCompilerPass(new RoutingConfigurationCompilerPass());
        $container->addCompilerPass(new TemplatingConfigurationCompilerPass());
    }
}
