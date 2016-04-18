<?php

namespace Xidea\Bundle\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\ConfigurationCompilerPass;
use Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\RoutingConfigurationCompilerPass;
use Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\TemplatingConfigurationCompilerPass;

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
