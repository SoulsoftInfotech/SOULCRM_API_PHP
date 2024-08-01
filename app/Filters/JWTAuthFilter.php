<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return service('response')
                ->setJSON(['message' => 'Unauthorized: No token provided'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        // Retrieve the secret key from environment variables
        $key = getenv('JWT_SECRET');
        if (!$key) {
            return service('response')
                ->setJSON(['message' => 'Unauthorized: No secret key provided'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        try {
            // Decode the JWT token
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            // Optionally store user info in session or request object
        } catch (\Exception $e) {
            return service('response')
                ->setJSON(['message' => 'Unauthorized: Invalid or expired token'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after
    }
}
