<?php

namespace App\Controllers\Api\Assignment\AssignmentController;

use App\Controllers\BaseController;
use App\Models\Lead\CreateLeadModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Api\User\UserLogin;
class AssignmentController extends BaseController
{
    public function index()
    {
        //
    }

    public function assignmentCampaign(){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
       

        $leadModel = new CreateLeadModel($db);
        $Campaign= $this->request->getVar('Campaign');
        $HandlerEmp=$this->request->getVar('HandlerEmp');

        if(empty($HandlerEmp)||empty($Campaign)){
            return $this->response->setJSON([
                'status' => 400,
               'message' => 'HandlerEmp and Campaign are required',
            ]);  // Return Bad Request status code and message  // Bad Request status code is 400.  // Bad Request is a client-side error, meaning the request could not be understood by the server.  // The server responded with a 400 Bad Request status code, which indicates that the request could not be processed due to some problem with the request message.  // The client should correct the request and resubmit it.  // In this case, the client should provide the HandlerEmp and Campaign in the request body.  // The client should not assume that the server will fix the error itself.  // The client should then try to resubmit the request.  // In this case, the client should resubmit the request body with the correct HandlerEmp and Campaign.
        }
        $update = $leadModel->where(['Campaign'=> $Campaign])->set('HandlerEmp', $HandlerEmp)->update();
        
        if($update){
            return $this->response->setJSON([
                'status' => 200,
               'message' => 'Campaign Assigned Successfully',
            ]);
        }
        else{
            return $this->response->setJSON([
                'status' => 500,
               'message' => 'Failed to Assign Campaign',
            ]);
        }

    }
}
