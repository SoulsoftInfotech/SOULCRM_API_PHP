<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use App\Models\Lead\CreateLeadModel;
use App\Models\Lead\CustomerModel;
use App\Models\User\UserLoginModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Database\Config;
use App\Models\ValidationOrganization\OrganizationAuth;


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
        $userLoginModel = new UserLoginModel();
        $loginUserName = $this->request->getVar('LoginUserName');
        $password = $this->request->getVar('Password');
    
        $user = $userLoginModel->where('LoginUserName', $loginUserName)->first();
    
         if ($user && $user['Password'] === $password) {
            // if ($user && password_verify($password, $user['Password'])) {
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
                'msg' => 'user login successfully!',
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


    public function checkauthcode()
    {
        $authCode = $this->request->getVar('AuthCode');

        $orgModel = new OrganizationAuth();

        if ($authCode) {
            $orgDetails = $orgModel->ValidateOrganizationCode($authCode);
            if (!empty($orgDetails)) {
                $orgDetails = $orgDetails[0];
                $dbName = $orgDetails['DBName'];
                $dbPassword = $orgDetails['DBPassword'];
                $dbUser = $orgDetails['DBusername'];
                $dbHost = $orgDetails['IP'] ?? 'localhost'; // Default to localhost if IP is not provided

                // Create new database connection
                $db = \Config\Database::connect([
                    'DSN'      => '',
                    'hostname' => 'localhost',
                    'username' => $dbUser,
                    'password' => $dbPassword,
                    'database' => $dbName,
                    'DBDriver' => 'MySQLi',
                    'DBPrefix' => '',
                    'pConnect' => false,
                    'DBDebug'  => (ENVIRONMENT !== 'production'),
                    'charset'  => 'utf8',
                    'DBCollat' => 'utf8_general_ci',
                    'swapPre'  => '',
                    'encrypt'  => false,
                    'compress' => false,
                    'strictOn' => false,
                    'failover' => [],
                    'port'     => 3306,
                ]);

                // Optionally set this database connection to be used by the models
                $db->initialize();

                // Use the new database connection
                // Example: $builder = $db->table('your_table')->get();
                
                return $this->response->setJSON([
                    'data'   => $orgDetails,
                    'status' => 200,
                    'message' => 'User is Authorized'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 404,
                    'message' => 'Auth Code is invalid'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status'=> 404,
                'message' => 'Auth Code is empty'
            ]);
        }
    }
       
}
