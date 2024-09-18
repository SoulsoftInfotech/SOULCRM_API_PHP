<?php

namespace App\Controllers\Api\Campaign;

use App\Controllers\BaseController;
use App\Controllers\Api\User\UserLogin;
use App\Models\Campaign\CampaignModel;
use CodeIgniter\HTTP\ResponseInterface;

class CampaignController extends BaseController
{
    public function index()
    {
        //
    }

    public function createCampaign(){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
       

        $CampaignModel = new CampaignModel($db);

        $data=[
            'CampaignId' => $this->request->getVar('CampaignId'),
            'CampaignName'=> $this->request->getVar('CampaignName'),
            'ContactNo'=> $this->request->getVar('ContactNo'),
            'Location'=> $this->request->getVar('Location'),
            'ProductId'=> $this->request->getVar('ProductId'),
            'LeadType'=> $this->request->getVar('LeadType'),
            'Description'=> $this->request->getVar('Description'),
            'HandlerEmp' => $this->request->getVar('HandlerEmp'),
            'Image' => $this->request->getVar('Image'),
            'Video'=> $this->request->getVar('Video'),
            'CreatedBy' =>$this->request->getVar('CreatedBy'),
            'CreatedOn' =>$this->request->getVar('CreatedOn'),
            'UpdatedBy' =>$this->request->getVar('UpdatedBy'),
            'UpdatedOn' =>$this->request->getVar('UpdatedOn')
        ];

        if($CampaignModel->save($data)){
            return $this->response->setJSON([
               'status'=>200,
               'message'=>'Campaign created successfully',
               'data'=>$data
            ]);
        }
        return $this->response->setJSON([
           'status'=>500,
           'message'=>'Failed to create campaign'
        ]);
    }   

    public function updateCampaign($id){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
       

        $CampaignModel = new CampaignModel($db);

        $data=[
            'CampaignId' => $this->request->getVar('CampaignId'),
            'CampaignName'=> $this->request->getVar('CampaignName'),
            'ContactNo'=> $this->request->getVar('ContactNo'),
            'Location'=> $this->request->getVar('Location'),
            'ProductId'=> $this->request->getVar('ProductId'),
            'LeadType'=> $this->request->getVar('LeadType'),
            'Description'=> $this->request->getVar('Description'),
            'HandlerEmp' => $this->request->getVar('HandlerEmp'),
            'Image' => $this->request->getVar('Image'),
            'Video'=> $this->request->getVar('Video'),
            'CreatedBy' =>$this->request->getVar('CreatedBy'),
            'CreatedOn' =>$this->request->getVar('CreatedOn'),
            'UpdatedBy' =>$this->request->getVar('UpdatedBy'),
            'UpdatedOn' =>$this->request->getVar('UpdatedOn')
        ];

        if ($CampaignModel->update($id, $data)) {
            return $this->response->setJSON([
               'status'=>200,
               'message'=>'Campaign update successfully',
               'data'=>$data
            ]);
        }
        return $this->response->setJSON([
           'status'=>500,
           'message'=>'Failed to uodate campaign'
        ]);
    }   

    public function deleteCampaign($id){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
       

        $CampaignModel = new CampaignModel($db);



        if($CampaignModel->delete($id)){
            return $this->response->setJSON([
               'status'=>200,
               'message'=>'Campaign deleted successfully',
               'data'=>$id
            ]);
        }
        return $this->response->setJSON([
           'status'=>500,
           'message'=>'Failed to delete campaign'
        ]);
    }

    public function getAllCampaign(){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $CampaignModel = new CampaignModel($db);

        $result = $CampaignModel->findAll();
        if($result){
            return $this->response->setJSON([
               'status'=>200,
               'message'=>'Campaigns fetched successfully',
               'data'=>$result
            ]);
    
            }
        return $this->response->setJSON([
            'status'=>500,
           'message'=>'Failed to Fetch Campaigns'
        ]);
    }
    

}
