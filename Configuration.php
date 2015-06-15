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
     * @var string
     */
    protected $code;
    
    /**
     * @var \Xidea\Bundle\BaseBundle\Template\TemplateConfigurationInterface
     */
    protected $templateConfiguration;

    public function __construct($code, $templateConfiguration)
    {
        $this->code = $code;
        $this->templateConfiguration = $templateConfiguration;
    }
    
    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateConfiguration()
    {
        return $this->templateConfiguration;
    }

}
