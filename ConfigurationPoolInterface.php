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
interface ConfigurationPoolInterface
{
    /**
     * @param \Xidea\Bundle\BaseBundle\ConfigurationInterface $configuration
     */
    function addConfiguration(ConfigurationInterface $configuration);
    
    /**
     * 
     * @param string $code
     * 
     * @return \Xidea\Bundle\BaseBundle\ConfigurationInterface
     */
    function getConfiguration($code);
    
    /**
     * return array
     */
    function getConfigurations();
}
