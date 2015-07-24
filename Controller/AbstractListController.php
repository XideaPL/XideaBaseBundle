<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Bundle\BaseBundle\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractListController extends AbstractController
{
    /*
     * @var string
     */
    protected $listTemplate = 'list';
    
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
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $models = $this->loadModels($request);
        
        if (null !== $response = $this->onPreList($models, $request)) {
            return $response;
        }
        
        return $this->onListView(array(
            'models' => $models
        ), $request);
    }
    
    /**
     * 
     * @param array $parameters
     * @param Request $request
     * @return Response
     */
    protected function onListView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->listTemplate, $parameters);
    }
    
    /**
     * @param Request $request
     * 
     * @return array
     */
    abstract protected function loadModels(Request $request);
    
    /**
     * @param mixed $models
     * @param Request $request
     */
    abstract protected function onPreList($models, Request $request);
}
