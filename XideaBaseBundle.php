<?php

namespace Xidea\Bundle\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;
use Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\ConfigurationPoolCompilerPass,
    Xidea\Bundle\BaseBundle\DependencyInjection\Compiler\TemplateConfigurationCompilerPass;

class XideaBaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ConfigurationPoolCompilerPass());
        $container->addCompilerPass(new TemplateConfigurationCompilerPass());
    }
}
