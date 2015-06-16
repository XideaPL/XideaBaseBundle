<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface TemplateConfigurationInterface
{
    /**
     * 
     * @param bool $namespacedPaths
     */
    function setNamespacedPaths($namespacedPaths);
    
    /**
     * @return bool
     */
    function getNamespacedPaths();
    
    /**
     * Returns a template.
     *
     * @return string
     */
    function getTemplate($name, $format = 'html');
}
