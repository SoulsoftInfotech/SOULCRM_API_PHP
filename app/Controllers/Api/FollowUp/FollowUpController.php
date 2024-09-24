<?php

namespace App\Controllers\Api\FollowUp;
use App\Controllers\Api\User\UserLogin;
use App\Models\FollowUp\FollowUpModel;
use App\Controllers\BaseController;



class FollowUpController extends BaseController
{
   public function  getfollowupdata($LeadId){
      $dbname = $this->request->getVar('DBNAME');
      $uname = $this->request->getVar('UNAME');
      $pass = $this->request->getVar('PASS');
      $host = $this->request->getVar('HOST');

      $connect = new UserLogin();
      $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
      $db = \Config\Database::connect($dbconnectarray);

      $FollowUpModel = new FollowUpModel($db);
      
      $followupData = $FollowUpModel->where("LeadId",$LeadId)->findAll();

      if(!$followupData){
         return $this->response->setJSON([
            'status' => 404,
            'message' => 'No followup data found'
         ]);
      }
      else{
         return $this->response->setJSON([
            'status' => 200,
            'message' => 'Followup data fetched successfully',
            'data' => $followupData
         ]);
      }
   }
   public function create()
    {
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect = new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);

        $followupModel = new FollowUpModel($db);
        // $number = $CreateLeadModel->findFollowUpDataAll($id);

        $data = [
            'LeadId' => $this->request->getVar('LeadId'),
            'Date' => $this->request->getVar('Date'),
            'Communication' => $this->request->getVar('Communication'),
            'NextFollowUpDate' => $this->request->getVar('NextFollowUpDate'),
            'FollowUpEmployee' => $this->request->getVar('FollowUpEmployee'),
        ];
        $followup =$followupModel->save($data);
        if ($followup) {
            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Follow Up data retrieved successfully',
                'data' => $followup
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 404,
                'message' => 'No data found for Follow Up',
                'data' => 0
            ]);
        }
    }
}