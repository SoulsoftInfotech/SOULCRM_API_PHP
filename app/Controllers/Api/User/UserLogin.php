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
        // $passwordmatch=$userLoginModel->where('Password', $password);
        // print_r($user);
        // print_r($passwordmatch);
        // print_r($user);

        if ($user && $user['Password']=== $password) {
            // Generate token or session here
            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Login successful',
                'data' => $user // You should not return the password hash
            ]);
        }

        return $this->response->setJSON([
            'status' => 401,
            'message' => 'Invalid username or password'
        ]);
    }















    // public function create()
    // {
    //     $userLoginModel = new UserLoginModel();

    //     $empData = [
    //         'EmpId' => $this->request->getVar('EmpId'),
    //         'EmpCode' => $this->request->getVar('EmpCode'),
    //         'EmpName' => $this->request->getVar('EmpName'),
    //         'Designation' => $this->request->getVar('Designation'),
    //         'LoginUserName' => $this->request->getVar('LoginUserName'),
    //         'Password' => password_hash($this->request->getVar('Password'), PASSWORD_BCRYPT),
    //         'Description' => $this->request->getVar('Description'),
    //         'CreatedBy' => $this->request->getVar('CreatedBy'),
    //         'CreatedOn' => date('Y-m-d H:i:s'),
    //         'UpdatedBy' => $this->request->getVar('UpdatedBy'),
    //         'UpdatedOn' => date('Y-m-d H:i:s'),
    //     ];

    //     if ($userLoginModel->save($empData)) {
    //         return $this->response->setJSON([
    //             'status' => 201,
    //             'message' => 'Employee created successfully',
    //             'data' => $empData
    //         ]);
    //     }

    //     return $this->response->setJSON([
    //         'status' => 500,
    //         'message' => 'Failed to create employee'
    //     ]);
    // }

    // public function login()
    // {
    //     $userLoginModel = new UserLoginModel();
    //     $loginUserName = $this->request->getVar('LoginUserName');
    //     $password = $this->request->getVar('Password');

    //     $user = $userLoginModel->where('LoginUserName', $loginUserName)->first();

    //     if ($user && password_verify($password, $user['Password'])) {
    //         // Generate tokens
    //         $tokens = $this->generateToken($user['EmpId']);

    //         // Store refresh token in the database
    //         $userLoginModel->update($user['EmpId'], [
    //             'refresh_token' => $tokens['refresh_token'],
    //             'refresh_token_expiration' => date('Y-m-d H:i:s', time() + 2592000)
    //         ]);

    //         return $this->response->setJSON([
    //             'status' => 200,
    //             'message' => 'Login successful',
    //             'access_token' => $tokens['access_token'],
    //             'refresh_token' => $tokens['refresh_token']
    //         ]);
    //     }

    //     return $this->response->setJSON([
    //         'status' => 401,
    //         'message' => 'Invalid username or password'
    //     ]);
    // }

    // public function refreshToken()
    // {
    //     $refreshToken = $this->request->getVar('refresh_token');

    //     if (!$refreshToken) {
    //         return $this->response->setJSON([
    //             'status' => 400,
    //             'message' => 'Refresh token is required'
    //         ]);
    //     }

    //     $key = getenv('JWT_SECRET');

    //     try {
    //         $decoded = JWT::decode($refreshToken, new Key($key, 'HS256'));
    //         $userId = $decoded->sub;

    //         $userLoginModel = new UserLoginModel();
    //         $user = $userLoginModel->find($userId);

    //         if ($user && $user['refresh_token'] === $refreshToken && strtotime($user['refresh_token_expiration']) > time()) {
    //             // Generate a new access token
    //             $accessToken = $this->generateToken($userId)['access_token'];

    //             return $this->response->setJSON([
    //                 'status' => 200,
    //                 'message' => 'Token refreshed successfully',
    //                 'access_token' => $accessToken
    //             ]);
    //         }

    //         return $this->response->setJSON([
    //             'status' => 401,
    //             'message' => 'Invalid or expired refresh token'
    //         ]);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'status' => 401,
    //             'message' => 'Invalid refresh token'
    //         ]);
    //     }
    // }

    // private function generateToken($userId)
    // {
    //     $key = getenv('JWT_SECRET');
    //     $accessTokenPayload = [
    //         'iat' => time(),
    //         'exp' => time() + 3600, // 1 hour
    //         'sub' => $userId
    //     ];

    //     $refreshTokenPayload = [
    //         'iat' => time(),
    //         'exp' => time() + 2592000, // 30 days
    //         'sub' => $userId
    //     ];

    //     $key = new Key(getenv('JWT_SECRET'), 'HS256');
    //     $accessToken = JWT::encode($accessTokenPayload, $key, 'HS256');
    //     $refreshToken = JWT::encode($refreshTokenPayload, new Key($key, 'HS256'), 'HS256');
    //     return [
    //         'access_token' => $accessToken,
    //         'refresh_token' => $refreshToken
    //     ];
    // }
}
