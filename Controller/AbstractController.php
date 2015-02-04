<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractController
{
    /*
     * @var ConfigurationInterface
     */
    protected $configuration;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function getTemplateConfiguration()
    {
        return $this->configuration->getTemplateConfiguration();
    }
    
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
}
