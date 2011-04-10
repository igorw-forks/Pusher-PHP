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
    
    public function __construct($appId, $key, $secret, $options = array())
    {
        $options = array_merge($options, array(
            'app_id'    => $appId,
            'key'       => $key,
            'secret'    => $secret,
        ));
        $this->connection = new Connection($options);
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
        $this->throwBadMethodCallException();
    }
    
    public function offsetExists($name)
    {
        $this->throwBadMethodCallException();
    }
    
    public function offsetUnset($name)
    {
        $this->throwBadMethodCallException();
    }
    
    private function throwBadMethodCallException()
    {
        throw new \BadMethodCallException("Illegal use of array-syntax on Pusher. You may only use it for accessing channels.");
    }
}
