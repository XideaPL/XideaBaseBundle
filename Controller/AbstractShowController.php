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
abstract class AbstractShowController extends AbstractController
{
    public function __construct(ConfigurationInterface $configuration)
    {
        parent::__construct($configuration);
    }
    
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
    
    protected function onShowView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->getTemplateConfiguration()->getTemplate('show'), $parameters);
    }
    
    abstract protected function loadModel($id);
    
    abstract protected function onPreShow($model, Request $request);
}
