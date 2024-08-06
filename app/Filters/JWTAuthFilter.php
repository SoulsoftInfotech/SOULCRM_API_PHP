<?php

namespace App\Filters;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthFilter implements FilterInterface
{
    private $jwtSecret = 'fdsfsdf684454dgsgs464545646gs64461'; // Directly set the JWT secret key

    public function before(RequestInterface $request, $arguments = null)
{
    $uri = $request->getUri()->getPath();

    // Log the current route for debugging
    log_message('debug', 'JWTAuthFilter - Current route: ' . $uri);

    // Bypass the filter for login route
    if (strpos($uri, 'api/users/login') !== false) {
        return;
    }
    if(strpos($uri, 'api/users/createuser') !== false) {
      return;
    }

    $authHeader = $request->getHeaderLine('Authorization');
    if (!$authHeader) {
        return Services::response()
            ->setStatusCode(401)
            ->setJSON(['message' => 'Unauthorized: Token is missing']);
    }

    $token = explode(' ', $authHeader)[1];
    try {
        $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
        // Perform additional checks if needed
    } catch (\Exception $e) {
        return Services::response()
            ->setStatusCode(401)
            ->setJSON(['message' => 'Unauthorized: Invalid token']);
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed
    }
}
