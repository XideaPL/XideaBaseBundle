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

    public function __construct($code)
    {
        $this->code = $code;
    }
    
    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->code;
    }
}
