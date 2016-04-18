<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Templating\Manager;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Xidea\Bundle\BaseBundle\Templating\ManagerInterface;
use Xidea\Bundle\BaseBundle\Templating\Configuration\PoolInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultManager implements ManagerInterface
{
    /*
     * @var PoolInterface
     */
    protected $pool;
    
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * 
     * @param EngineInterface $templating
     */
    public function __construct(PoolInterface $pool, EngineInterface $templating)
    {
        $this->pool = $pool;
        $this->templating = $templating;
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $parameters = array())
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->render($this->pool->getTemplate($name, $format), $parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        $format = isset($parameters['_format']) ? $parameters['_format'] : 'html';
        
        return $this->templating->renderResponse($this->pool->getTemplate($name, $format), $parameters, $response);
    }
}