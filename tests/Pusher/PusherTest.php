<?php

/*
 * This file is part of the Pusher-PHP library.
 *
 * (c) Squeeks <squeek@cpan.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pusher\Tests;

use Pusher\Pusher;

/**
 * Pusher test cases.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 */
class PusherTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function shouldReturnChannelOnChannelAccess()
    {
        $pusher = $this->createStubPusher();
        $this->assertInstanceOf('Pusher\Channel', $pusher['foo_channel']);
    }
    
    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldThrowExceptionOnArraySet()
    {
        $pusher = $this->createStubPusher();
        $pusher['foo_channel'] = 'bar';
    }
    
    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldThrowExceptionOnArrayIsset()
    {
        $pusher = $this->createStubPusher();
        isset($pusher['foo_channel']);
    }
    
    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldThrowExceptionOnArrayUnset()
    {
        $pusher = $this->createStubPusher();
        unset($pusher['foo_channel']);
    }
    
    private function createStubPusher()
    {
        $pusher = new Pusher('20', '12345678900000001', '12345678900000001');
        return $pusher;
    }
}
