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
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        // Handle preflight OPTIONS request
        if ($request->getMethod(true) === 'OPTIONS') {
            $response = service('response');
            $response->setStatusCode(200);
            $response->setHeader('Access-Control-Allow-Origin', '*');
            $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No additional headers needed after response
    }
}



// namespace App\Filters;

// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Filters\FilterInterface;

// class CorsFilter implements FilterInterface
// {
//     public function before(RequestInterface $request, $arguments = null)
//     {
//         // Allow all origins for simplicity; adjust as needed for security
//         header("Access-Control-Allow-Origin: *");
//         header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//         header("Access-Control-Allow-Headers: Content-Type, Authorization,X-Requested-With");

//         // Handle preflight OPTIONS request
//         if ($request->getMethod(true) === 'OPTIONS') {
//             $response = service('response');
//             $response->setStatusCode(200);
//             $response->setHeader('Access-Control-Allow-Origin', '*');
//             $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
//             $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
//             return $response;
//         }
//     }

//     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
//     {
//         // No additional headers needed after response
//     }
// }

