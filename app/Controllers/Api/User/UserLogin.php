<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use App\Models\User\UserLoginModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserLogin extends BaseController
{
    private $jwtSecret = 'fdsfsdf684454dgsgs464545646gs64461'; // Directly set the JWT secret key

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
        $loginUserName = $this->request->getVar('LoginUserName');
        $password = $this->request->getVar('Password');

        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        // Generate the database connection array
        $dbconnectarray = $this->generateDBarray($dbname, $uname, $pass, $host);
        echo "Connecting to database: " . json_encode($dbconnectarray, JSON_PRETTY_PRINT) . "\n";

        // Create a new database connection using the generated array
        $db = \Config\Database::connect($dbconnectarray);

        // Pass the custom database connection to the model
        $userLoginModel = new UserLoginModel($db);

        $user = $userLoginModel->where('LoginUserName', $loginUserName)->first();

        if ($user && $user['Password'] === $password) {
            $issuedAt = time();
            $expirationTime = $issuedAt + 3600; // JWT valid for 1 hour
            $payload = [
                'iat' => $issuedAt,
                'exp' => $expirationTime,
                'sub' => $user['EmpId'],
                'username' => $user['LoginUserName'],
            ];

            $jwt = JWT::encode($payload, $this->jwtSecret, 'HS256');

            $response = [
                'msg' => 'User login successfully!',
                'userid' => $user['EmpId'],
                'url' => 'http://localhost:8080/',
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
        $payload = [
            'exp' => time() + (3600 * 24 * 7), // Valid for 7 days
            'userid' => $userId,
        ];
        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }

    public function generateDBarray($dbname, $uname, $pass, $host)
    {
        $custom = [
            'DSN'      => '',
            'hostname' => $host,
            'username' => $uname,
            'password' => $pass,
            'database' => $dbname,
            'DBDriver' => 'MySQLi',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => true,
            'charset'  => 'utf8mb4',
            'DBCollat' => 'utf8mb4_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => 3306,
        ];

        return $custom;
    }
}
