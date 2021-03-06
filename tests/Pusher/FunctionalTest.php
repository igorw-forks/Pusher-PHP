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
class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!isset($_SERVER['PUSHER_APP_ID']) || !isset($_SERVER['PUSHER_KEY']) || !isset($_SERVER['PUSHER_SECRET'])) {
            $this->markTestSkipped("Not all pusher environment variables (PUSHER_APP_ID, PUSHER_KEY, PUSHER_SECRET) set.");
        }
    }
    
    /** @test */
    public function shouldTriggerEventSuccessfully()
    {
        $pusher = $this->createRealPusher();
        $pusher['foo_channel']->trigger('bar_event', 'pushed data');
    }
    
    private function createRealPusher()
    {
        $pusher = new Pusher($_SERVER['PUSHER_APP_ID'], $_SERVER['PUSHER_KEY'], $_SERVER['PUSHER_SECRET']);
        return $pusher;
    }
}
