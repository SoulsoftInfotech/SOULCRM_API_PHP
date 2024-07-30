<?php

namespace App\Controllers\Api\Lead;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Lead\CreateLeadModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    public function itemExcelUpload()
    {
        // Check if file is uploaded
        if ($this->request->getFile('excel_file')->isValid()) {
            $file = $this->request->getFile('excel_file');
            $extension = $file->getExtension();
            if ($extension == 'xlsx' || $extension == 'csv') {

                if ($extension == 'xlsx') {
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
                    $worksheet = $spreadsheet->getActiveSheet();
                    $excelData = $worksheet->toArray();
                } else {
                    $file = fopen($file->getTempName(), 'r');
                    $excelData = [];
                    while (($row = fgetcsv($file)) !== false) {
                        $excelData[] = $row;
                    }
                    fclose($file);
                }
                $columnNames = $excelData[0];

                $rowData = [];

                for ($i = 1; $i < count($excelData); $i++) {
                    $row = $excelData[$i];
                    $rowAsKeyValue = [];
                    for ($j = 0; $j < count($row); $j++) {
                        $rowAsKeyValue[$columnNames[$j]] = $row[$j];
                    }
                    $rowData[] = $rowAsKeyValue;
                }

                $CreateLeadModel = new CreateLeadModel();
                if ($CreateLeadModel->insertBatch($rowData)) {
                    // Respond with success message and the data
                    $response = [
                        'status' => 200,
                        'msg' => 'Excel file data saved successfully!',
                        'data' => $rowData,
                    ];
                    return $this->response->setJSON($response);
                } else {
                    // Respond with error message if saving failed
                    $response = [
                        'status' => 500,
                        'msg' => 'Failed to save Excel file data.',
                    ];
                    return $this->response->setJSON($response);
                }
            } else {
                // Respond with error if file is not Excel or CSV
                $response = [
                    'status' => 400,
                    'msg' => 'Uploaded file must be in Excel format (xlsx) or CSV.',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            // Respond with error if no file is uploaded or file upload failed
            $response = [
                'status' => 400,
                'msg' => 'No file uploaded or file upload failed.',
            ];
            return $this->response->setJSON($response);
        }
    }
}
