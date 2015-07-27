<?php

namespace Xidea\Bundle\BaseBundle\Twig\Extension;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Xidea\Bundle\BaseBundle\Template\TemplateManagerInterface,
    Xidea\Bundle\BaseBundle\Pagination\PaginationInterface,
    Xidea\Bundle\BaseBundle\Pagination\SortingInterface;

class PaginationExtension extends \Twig_Extension
{
    /*
     * @var TemplateManagerInterface
     */
    protected $manager;

    /*
     * @var UrlGeneratorInterface
     */
    protected $router;

    /**
     * 
     * @param TemplateManagerInterface $manager
     */
    public function __construct(TemplateManagerInterface $manager, UrlGeneratorInterface $router)
    {
        $this->manager = $manager;
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'xidea_base_pagination' => new \Twig_Function_Method($this, 'pagination', array('is_safe' => array('html'))),
            'xidea_base_sorting' => new \Twig_Function_Method($this, 'sorting', array('is_safe' => array('html')))
        );
    }

    public function getName()
    {
        return 'xidea_base_template';
    }

    public function pagination(PaginationInterface $pagination, $options = [])
    {
        $options = array_merge($pagination->getPaginatorOptions(), $options);
        
        $viewData = $pagination->getViewData();

        if (isset($options['template'])) {
            return $this->manager->render($options['template'], $viewData);
        }
    }

    public function sorting(SortingInterface $sorting, $title, $key, $options = [])
    {
        $options = array_merge($sorting->getSorterOptions(), $options);

        $viewData = $sorting->getViewData();
        $viewData['title'] = $title;
        $keys = $sorting->getKeysWithDirections();
        $attributes = [];
        
        $class = [];
        if($sorting->isSorted($key)) {
            $class[] = 'sorting-'.$sorting->getDirection($key);
            $keys[$key] = $sorting->getNextDirection($key);
        } else {
            $class[] = 'sortable';
            $keys[$key] = $sorting->getSorterOption('defaultDirectionValue');
        }
        $parameterValue = [];
        foreach($keys as $key => $direction) {
            $parameterValue[] = $key.'.'.$direction;
        }
        $attributes['href'] = $this->router->generate($sorting->getRoute(), [
            $sorting->getSorterOption('parameterName') => implode('+', $parameterValue)
        ], $options['absoluteUrl']);
        
        $attributes['class'] = implode(' ', $class);
        $viewData['attributes'] = $attributes;

        if (isset($options['template'])) {
            return $this->manager->render($options['template'], $viewData);
        }
    }

}
