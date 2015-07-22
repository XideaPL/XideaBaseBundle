<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class AbstractSorter implements SorterInterface
{
    const PARAMETER_NAME = 'sort';
    const DIRECTION_VALUE = 'asc';
    
    /*
     * @var RequestStack
     */
    protected $requestStack;
    
    /*
     * @var array 
     */
    protected $options = [
        'parameterName' => self::PARAMETER_NAME,
        'defaultDirectionValue' => self::DIRECTION_VALUE
    ];
    
    /**
     * 
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->requestStack->getCurrentRequest();
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
        
        if(!$fields) {
            return;
        }
        
        $defaultDirection = $options['defaultDirectionValue'];
        if(strpos($fields, '+') !== false) {
            $fields = explode('+', $fields);
        }
        
        $sorterFields = [];
        $resolveField = function($field) use ($sorterFields, $defaultDirection) {
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