<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use App\Models\User\UserLoginModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserLogin extends BaseController
{
    public function index()
    {
        //
    }

//     public function create()
// {
//     $authHeader = $this->request->getHeaderLine('Authorization');
//     if (!$authHeader) {
//         return $this->response->setJSON(['message' => 'Unauthorized: Token is missing'])->setStatusCode(401);
//     }

//     $token = explode(' ', $authHeader)[1];
//     try {
//         $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
//         // Check if the user has the right permissions to create users
//         if ($decoded->role !== 'admin') {
//             return $this->response->setJSON(['message' => 'Unauthorized: Insufficient permissions'])->setStatusCode(403);
//         }
//     } catch (\Exception $e) {
//         return $this->response->setJSON(['message' => 'Unauthorized: Invalid token'])->setStatusCode(401);
//     }

//     // Proceed with user creation logic
// }

    
    public function create()
    {
        $userLoginModel = new UserLoginModel();

        $empData = [
            'EmpId' => $this->request->getVar('EmpId'),
            'EmpCode' => $this->request->getVar('EmpCode'),   
            'EmpName' => $this->request->getVar('EmpName'),
            'Designation' => $this->request->getVar('Designation'),
            'LoginUserName' => $this->request->getVar('LoginUserName'),
            'Password' => $this->request->getVar('Password'),
            'Description' => $this->request->getVar('Description'),
            'CreatedBy' => $this->request->getVar('CreatedBy'),
            'CreatedOn' => date('Y-m-d H:i:s'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d H:i:s'),
        ];

        if ($userLoginModel->save($empData)) {
            return $this->response->setJSON([
                'status' => 201,
                'message' => 'Employee created successfully',
                'data' => $empData
            ]);
        }

        return $this->response->setJSON([
            'status' => 500,
            'message' => 'Failed to create employee'
        ]);
    }

    public function login()
    {
        $userLoginModel = new UserLoginModel();
        $loginUserName = $this->request->getVar('LoginUserName');
        $password = $this->request->getVar('Password');

        $user = $userLoginModel->where('LoginUserName', $loginUserName)->first();

        if ($user && $user['Password'] === $password) {
            // Generate JWT token
            $key = getenv('JWT_SECRET');
            $issuedAt = time();
            $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour from the issued time
            $payload = [
                'iat' => $issuedAt,
                'exp' => $expirationTime,
                'sub' => $user['EmpId'],
                'username' => $user['LoginUserName'],
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            // Prepare response data
            $response = [
                'msg' => 'user login successfully!',
                'userid' => $user['EmpId'],
                'url' => 'https://soulcrm.soulsoft.in/',
                'type' => 'master',
                'status' => 200,
                'tokenDetails' => [
                    'email' => $user['LoginUserName'],
                    'displayName' => $user['LoginUserName'],
                    'expireDate' => date('Y-m-d H:i:s', $expirationTime),
                    'expiresIn' => 3600,
                    'idToken' => $jwt,
                    'refreshToken' => $this->generateRefreshToken($user['EmpId']),
                    'registered' => true,
                    'userid' => $user['EmpId'],
                ]
            ];

            return $this->response->setJSON($response);
        }

        return $this->response->setJSON([
            'msg' => 'Invalid username or password',
            'status' => 401
        ]);
    }

    private function generateRefreshToken($userId)
    {
        $key = getenv('JWT_SECRET');
        $payload = [
            'exp' => time() + (3600 * 24 * 7), // Valid for 7 days
            'userid' => $userId,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
}














