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
 * Main pusher class
 */
class Pusher implements \ArrayAccess
{
    private $channels = array();
    private $connection;
    
    public function __construct($appId, $key, $secret)
    {
        $this->connection = new Connection(array(
            'app_id'    => $appId,
            'key'       => $key,
            'secret'    => $secret,
        ));
    }
    
    public function offsetGet($name)
    {
        if (!isset($this->channels[$name])) {
            $this->channels[$name] = new Channel($name, $this->connection);
        }
        
        return $this->channels[$name];
    }
    
    public function offsetSet($name, $value)
    {
        throw new \RuntimeException("Illegal use of array-syntax on Pusher. You may only use it for accessing channels.");
    }
    
    public function offsetExists($name)
    {
        throw new \RuntimeException("Illegal use of array-syntax on Pusher. You may only use it for accessing channels.");
    }
    
    public function offsetUnset($name)
    {
        throw new \RuntimeException("Illegal use of array-syntax on Pusher. You may only use it for accessing channels.");
    }
}
