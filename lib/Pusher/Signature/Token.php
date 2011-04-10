<?php

/*
 * This file is part of the Pusher-PHP library.
 *
 * (c) Squeeks <squeek@cpan.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pusher\Signature;

/**
 * Signature Token, port of Martyn Loughran's signature gem
 */
class Token
{
    public $key;
    public $secret;
    
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }
    
    public function sign(Request $request)
    {
        $request->sign($this);
    }
}
