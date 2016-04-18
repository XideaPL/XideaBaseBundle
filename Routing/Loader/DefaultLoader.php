<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing\Loader;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Xidea\Bundle\BaseBundle\Routing\Configuration\PoolInterface;

/**
 * Description of DefaultLoader
 *
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class DefaultLoader extends Loader
{
    /*
     * @var PoolInterface
     */
    protected $pool;
    
    /*
     * @var boolean
     */
    private $loaded = false;
    
    /**
     * 
     * @param PoolInterface $pool
     */
    public function __construct(PoolInterface $pool)
    {
        $this->pool = $pool;
    }

    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "xidea" loader twice');
        }

        $routes = new RouteCollection();
        
        $routesArray = $this->pool->getRoutes();
        foreach($routesArray as $name => $config) {
            $routes->add($name, new Route($config['path'], $config['defaults'], $config['requirements']));
        }

        $this->loaded = true;

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'xidea' === $type;
    }
}
