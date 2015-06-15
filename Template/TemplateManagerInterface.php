<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Template;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface TemplateManagerInterface
{
    /**
     * @param string $context
     * 
     * @return TemplateManagerInterface The instance
     */
    function setContext($context);
    
    /**
     * @return string
     */
    function getContext();
    
    /**
     * Returns a configuration.
     *
     * @return \Xidea\Bundle\TemplateBundle\Template\TemplateConfigurationInterface
     */
    function getConfiguration();
    
    /**
     * @return string
     */
    function render($name, array $parameters = array());
    
    /**
     * @return Response
     */
    function renderResponse($name, array $parameters = array(), Response $response = null);
}
