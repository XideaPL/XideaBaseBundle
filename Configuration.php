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
class Configuration implements ConfigurationInterface
{
    /**
     * @var \Xidea\Bundle\BaseBundle\TemplateConfigurationInterface
     */
    protected $templateConfiguration;

    public function __construct($templateConfiguration)
    {
        $this->templateConfiguration = $templateConfiguration;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateConfiguration()
    {
        return $this->templateConfiguration;
    }

}
