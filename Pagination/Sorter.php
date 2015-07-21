<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class Sorter implements SorterInterface
{
    /*
     * @var Request
     */
    protected $request;
    
    /*
     * @var array 
     */
    protected $options = [
        'parameterName' => 'sort',
        'defaultDirectionValue' => 'asc'
    ];
    
    /**
     * @inheritDoc
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * @inheritDoc
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
    
    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * @inheritDoc
     */
    public function sort($target, array $options = [])
    {
        $request = $this->getRequest();
        
        if (!$request instanceof Request) {
            throw new \RuntimeException('Use the request object in the sorter.');
        }
        
        $options = array_merge($this->options, $options);
        
        $fields = $request->query->get($options['parameterName']);
        $defaultDirection = $options['defaultDirectionValue'];
        if(strpos($fields, '+') !== false) {
            $fields = explode('+', $fields);
        }
        
        $sorterFields = [];
        $resolveField = function($field) use ($sorterFields) {
            $field = explode('.', $field);
            if(count($field) == 3) {
                $sorterFields[$field[1]] = [
                    'alias' => $field[0],
                    'direction' => $field[2]
                ];
            } else {
                $sorterFields[$field[0]] = [
                    'direction' => isset($field[1]) ? $field[1] : $defaultDirection
                ];
            }
        };
        
        if(is_array($fields)) {
            foreach($fields as $field) {
                call_user_func($resolveField, $field);
            }
        } else {
            call_user_func($resolveField, $fields);
        }
        
        if(count($sorterFields)) {
            $strategy = $this->getStrategy($target);
            $strategy->sort($target, $sorterFields);
        }
    }
    
    /**
     * @return SorterStrategyInterface
     */
    protected function getStrategy($target)
    {
        $strategies = $this->getStrategies();
        
        foreach($strategies as $strategy) {
            if($strategy->support($target))
                return $strategy;
        }
        
        throw new \Exception;
    }
    
    /**
     * @return SorterStrategyInterface[]
     */
    protected function getStrategies()
    {
        return [
            new Sorter\Strategy\QueryBuilderStrategy()
        ];
    }
}