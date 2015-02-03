<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ConfigurationInterface
{
    /**
     * Returns a template configuration.
     *
     * @return \Xidea\Bundle\BaseBundle\TemplateConfigurationInterface
     */
    public function getTemplateConfiguration();
}
