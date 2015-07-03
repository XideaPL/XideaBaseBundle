<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

use Symfony\Component\HttpFoundation\Response;
use Xidea\Bundle\TemplateBundle\Template\TemplateConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface TemplateManagerInterface
{
    /**
     * Adds a configuration.
     *
     * @param TemplateConfigurationInterface $configuration
     * @param int $priority
     */
    
    function addConfiguration(TemplateConfigurationInterface $configuration, $priority = 0);
    
    /**
     * Returns a configuration.
     *
     * @return TemplateConfigurationInterface
     */
    function getConfiguration($scope);
    
    /**
     * @return string
     */
    function render($name, array $parameters = array());
    
    /**
     * @return Response
     */
    function renderResponse($name, array $parameters = array(), Response $response = null);
}
