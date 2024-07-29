<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CreateLeadModel;

class CreateLeadController extends BaseController
{
    public function index()
    {
        //
    }
    public function create()
    {
        $leadModel = new CreateLeadModel();

        $leadData = [
            'LeadId' => $this->request->getVar('LeadId'),
            'LeadNo' => $this->request->getVar('LeadNo'),
            'LeadDate' => $this->request->getVar('LeadDate'),
            'ContactNo' => $this->request->getVar('ContactNo'),
            'LeadName' => $this->request->getVar('LeadName'),
            'CompanyName' => $this->request->getVar('CompanyName'),
            'Location' => $this->request->getVar('Location'),
            'ProductId' => $this->request->getVar('ProductId'),
            'LeadType' => $this->request->getVar('LeadType'),
            'LeadPlatForm' => $this->request->getVar('LeadPlatForm'),
            'Reference' => $this->request->getVar('Reference'),
            'Narration' => $this->request->getVar('Narration'),
            'LeadStatus' => $this->request->getVar('LeadStatus'),
            'HandlerEmp' => $this->request->getVar('HandlerEmp'),
            'CreatedBy' => $this->request->getVar('CreatedBy'),
            'CreatedOn' => date('Y-m-d H:i:s'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d H:i:s'),
        ];

        if ($leadModel->save($leadData)) {
            return $this->response->setJSON([
                'status' => 201,
                'message' => 'Lead created successfully',
                'data' => $leadData
            ]);
        }

        return $this->response->setJSON([
            'status' => 500,
            'message' => 'Failed to create lead'
        ]);
    }

    public function update($id)
    {
        $leadModel = new CreateLeadModel();

        $leadData = [
            'LeadId' => $this->request->getVar('LeadId'),
            'LeadNo' => $this->request->getVar('LeadNo'),
            'LeadDate' => $this->request->getVar('LeadDate'),
            'ContactNo' => $this->request->getVar('ContactNo'),
            'LeadName' => $this->request->getVar('LeadName'),
            'CompanyName' => $this->request->getVar('CompanyName'),
            'Location' => $this->request->getVar('Location'),
            'ProductId' => $this->request->getVar('ProductId'),
            'LeadType' => $this->request->getVar('LeadType'),
            'LeadPlatForm' => $this->request->getVar('LeadPlatForm'),
            'Reference' => $this->request->getVar('Reference'),
            'Narration' => $this->request->getVar('Narration'),
            'LeadStatus' => $this->request->getVar('LeadStatus'),
            'HandlerEmp' => $this->request->getVar('HandlerEmp'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d H:i:s'),
        ];

        if ($leadModel->update($id, $leadData)) {
            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Lead updated successfully',
                'data' => $leadData
            ]);
        }

        return $this->response->setJSON([
            'status' => 500,
            'message' => 'Failed to update lead'
        ]);
    }
}
