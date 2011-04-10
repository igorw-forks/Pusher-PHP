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

use Buzz\Message\Request;
use Buzz\Message\Response;

/**
 * Connection Exception
 */
class ConnectionException extends \RuntimeException
{
    private $request;
    private $response;
    
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        
        $message = sprintf("Pusher API call failed with HTTP status code '%s' and message '%s'.", $response->getStatusCode(), $response->getContent());
        parent::__construct($message);
    }
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function getResponse()
    {
        return $this->response;
    }
}
