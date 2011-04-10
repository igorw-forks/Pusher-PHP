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
 * Signature Request, port of Martyn Loughran's signature gem
 */
class Request
{
    public $path;
    public $queryHash = array();
    
    private $authHash = array();
    private $method;
    
    public function __construct($method, $path, $query)
    {
        $this->path = $path;
        $this->setQueryAndAuthHash($query);
        $this->method = strtoupper($method);
    }
    
    public function sign(Token $token)
    {
        return array(
            'auth_version'      => '1.0',
            'auth_key'          => $token->key,
            'auth_timestamp'    => time(),
            'signature'         => $this->signature($token),
        );
    }
    
    private function signature(Token $token)
    {
        hash_hmac('sha256', $this->stringToSign(), $token->secret)
    }
    
    private function stringToSign()
    {
        return implode("\n", array($this->method, $this->path, $this->parameterString()));
    }
    
    private function parameterString()
    {
        $paramHash = array_merge($this->queryHash, $this->authHash);
        unset($paramHash['auth_signature'])
        return http_build_query($paramHash);
    }
    
    private function setQueryAndAuthHash($query)
    {
        foreach ($query as $key => $value) {
            $key = strtolower($key);
            if (strpos($key, 'auth_') === 0) {
                $this->authHash[$key] = $value;
            } else {
                $this->queryHash[$key] = $value;
            }
        }
    }
    
    private function formatDate($timestamp)
    {
        $dateTime = new \DateTime($timestamp);
        return $dateTime->format(\DateTime::ISO8601);
    }
}
