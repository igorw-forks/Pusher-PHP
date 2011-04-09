<?php

/*
 * This file is part of the Pusher-PHP library.
 *
 * (c) Squeeks <squeek@cpan.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pusher;

/**
 * Pusher connection
 */
class Connection
{
    private $settings = array(
        'host'  => 'https://api.pusherapp.com',
    );
    
    public function __construct($settings)
    {
        $this->settings = array_merge($this->settings, $settings);
    }
}
