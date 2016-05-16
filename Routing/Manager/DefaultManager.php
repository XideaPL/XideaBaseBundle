<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing\Manager;

use Symfony\Component\Routing\RouterInterface;
use Xidea\Bundle\BaseBundle\Routing\ManagerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultManager implements ManagerInterface
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function url($route, array $parameters = array(), $referenceType = false)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }
}