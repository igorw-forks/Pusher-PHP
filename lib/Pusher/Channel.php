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
 * Pusher channel
 */
class Channel
{
    private $name;
    private $connection;
    
    public function __construct($name, Connection $connection)
    {
        $this->name = $name;
        $this->connection = $connection;
    }
    
    public function trigger($eventName, $data = null, $socketId = null)
    {
        $this->connection->trigger($this->name, $eventName, $data, $socketId);
    }
    
    public function authenticationString($socketId, $customString = null)
    {
        $stringToSign = $socketId.':'.$this->name . ($customString ? ':'.$customString : '');
        $signature = $this->connection->sign($stringToSign);
        return $this->connection->getKey().':'.$signature;
    }
    
    public function authenticate($socketId, $customData = null)
    {
        $customData = json_encode($customData);
        $auth = $this->authenticationString($socketId, $customData);
        return array(
            'auth'          => $auth,
            'channel_data'  => $custom_data,
        );
    }
}
