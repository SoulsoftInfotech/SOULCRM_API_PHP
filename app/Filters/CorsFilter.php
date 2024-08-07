<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CorsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Allow all origins for simplicity; adjust as needed for security
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // Handle preflight OPTIONS request
        if ($request->getMethod(true) === 'OPTIONS') {
            // Return a 200 OK response for OPTIONS request
            $response = service('response');
            return $response->setStatusCode(200)
                            ->setHeader('Access-Control-Allow-Origin', '*')
                            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                            ->setBody('OK');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No additional headers needed after response
    }
}

