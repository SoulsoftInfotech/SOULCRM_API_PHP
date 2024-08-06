<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Cors;

class CorsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $cors = new Cors();
        $response = service('response');
    
        $response->setHeader('Access-Control-Allow-Origin', implode(', ', $cors->allowedOrigins));
        $response->setHeader('Access-Control-Allow-Methods', implode(', ', $cors->allowedMethods));
        $response->setHeader('Access-Control-Allow-Headers', implode(', ', $cors->allowedHeaders));
    
        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(200);
            $response->send();
            exit;
        }
    }
    

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after the request
    }
}
