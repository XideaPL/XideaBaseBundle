<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Tests\Unit\Routing\Manager;

use Xidea\Bundle\BaseBundle\Routing\Manager\DefaultManager;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testRedirect()
    {
        $manager = $this->createManager();
        
        $response = $manager->redirect('xidea.pl');
        
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\RedirectResponse', $response);
        $this->assertEquals('xidea.pl', $response->getTargetUrl());
        $this->assertEquals(302, $response->getStatusCode());
    }
    
    protected function createManager()
    {
        $router = $this->getMockBuilder('Symfony\Component\Routing\RouterInterface')
            ->getMock()
        ;
        
        return new DefaultManager($router);
    }
}