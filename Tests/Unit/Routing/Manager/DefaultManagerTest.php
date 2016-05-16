<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Tests\Unit\Routing\Manager;
/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateUrl()
    {
        $manager = $this->createManager();
        
        $this->assertEquals('xidea.pl', $manager->url('route'));
    }
    
    protected function createManager()
    {
        $manager = $this->getMock('Xidea\Bundle\BaseBundle\Routing\ManagerInterface', ['url']);

        $manager->method('url')->willReturn('xidea.pl');
        
        return $manager;
    }
}