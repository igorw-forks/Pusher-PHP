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

use Buzz\Client\Curl as BuzzClient;
use Buzz\Message\Request;
use Buzz\Message\Response;

/**
 * Pusher connection
 */
class Connection
{
    private $options = array(
        'host'  => 'https://api.pusherapp.com',
    );
    
    public function __construct(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
    
    public function trigger($channel, $eventName, $data, $socketId = null)
    {
        $path = $this->buildPath($channel);
        
        $payload = json_encode($data);
        
        $query = http_build_query(array(
            'auth_key'          => $this->options['key'],
            'auth_timestamp'    => time(),
            'auth_version'      => '1.0',
            'body_md5'          => md5($payload),
            'name'              => $eventName,
        ));
        
        if ($socketId !== null) {
            $query .= '&'.http_build_query(array('socket_id' => $socketId));
        }
        
        $signature = $this->sign("POST\n$path\n$query");
        $query .= '&'.http_build_query(array('auth_signature' => $signature));
        
        $request = new Request(Request::METHOD_POST, $path.'?'.$query, $this->options['host']);
        $request->addHeader('Content-type: application/json');
        $request->setContent($payload);
        
        $response = new Response();
        
        $client = new BuzzClient();
        $client->send($request, $response);
        
        if ($response->getStatusCode() != 202) {
            throw new \RuntimeException(sprintf("Request to %s failed with HTTP status code '%s' and message '%s'.", $this->options['host'], $response->getStatusCode(), $response->getContent()));
        }
    }
    
    public function sign($message)
    {
        return hash_hmac('sha256', $message, $this->options['secret']);
    }
    
    public function getKey()
    {
        return $this->options['key'];
    }
    
    private function buildPath($channel)
    {
        return sprintf('/apps/%s/channels/%s/events',
                $this->options['app_id'], $channel);
    }
}
