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
    public function testConstructor()
    {
        $pusher = new Pusher('app_id', 'key', 'secret');
        $pusher['channel']->trigger('wtf');
    }
}
