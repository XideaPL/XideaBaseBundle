<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

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
        $objects = $this->loadObjects($request);
        
        if (null !== $response = $this->onPreList($objects, $request)) {
            return $response;
        }
        
        return $this->onListView(array(
            'objects' => $objects
        ), $request);
    }
    
    abstract protected function loadObjects(Request $request);
    
    abstract protected function onPreList($objects, $request);
    
    abstract protected function onListView($data, $request);
}
