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
    public function __construct(ConfigurationInterface $configuration)
    {
        parent::__construct($configuration);
    }

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
    
    protected function onListView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->getTemplateConfiguration()->getTemplate('list'), $parameters);
    }
    
    abstract protected function loadModels(Request $request);
    
    abstract protected function onPreList($models, Request $request);
}
