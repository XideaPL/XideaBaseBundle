<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Xidea\Base\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractShowController extends AbstractController
{
    /*
     * @var string
     */
    protected $showTemplate = 'show';
    
    /**
     * 
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        parent::__construct($configuration);
    }
    
    /**
     * 
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function showAction($id, Request $request)
    {
        $model = $this->loadModel($id);
        
        if (null !== $response = $this->onPreShow($model, $request)) {
            return $response;
        }
        
        return $this->onShowView(array(
            'model' => $model
        ), $request);
    }
    
    /**
     * 
     * @param array $parameters
     * @param Request $request
     * @return Response
     */
    protected function onShowView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->showTemplate, $parameters);
    }
    
    /**
     * @param int $id
     */
    abstract protected function loadModel($id);
    
    /**
     * @param mixed $model
     * @param Request $request
     */
    abstract protected function onPreShow($model, Request $request);
}
