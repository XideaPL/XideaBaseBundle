<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Routing\Manager;

use Symfony\Component\HttpFoundation\RedirectResponse;
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
    public function url($name, array $parameters = array(), $referenceType = false)
    {
        return $this->router->generate($name, $parameters, $referenceType);
    }
    
    /**
     * @inheritDoc
     */
    public function redirect($url, $status = 302, $headers = array())
    {
        return new RedirectResponse($url, $status, $headers);
    }
}