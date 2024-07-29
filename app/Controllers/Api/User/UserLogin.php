<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use App\Models\User\UserLoginModel;

class UserLogin extends BaseController
{
    public function index()
    {
        //
    }

    // 
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

}
