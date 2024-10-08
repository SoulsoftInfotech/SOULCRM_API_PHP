<?php

namespace App\Controllers\Api\Lead;

use App\Controllers\Api\User\UserLogin;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Lead\CreateLeadModel;
use App\Models\Lead\CustomerModel;
use PhpOffice\PhpSpreadsheet\IOFactory;



class CreateLeadController extends BaseController
{
    public function index()
    {
        //
    }
    public function create()
    {
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $leadModel = new CreateLeadModel($db);
        $leadData = [
            // 'LeadId' => $this->request->getVar('LeadId'),
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
            'Address'=>$this->request->getVar('Address'),
            'CreatedBy' => $this->request->getVar('CreatedBy'),
            'CreatedOn' => date('Y-m-d'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d'),
            'NextFollowUpDate' =>$this->request->getVar('NextFollowUpDate'),
            'Campaign'=>$this->request->getVar('Campaign')
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
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        
        $leadModel = new CreateLeadModel($db);

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
            'Address'=>$this->request->getVar('Address'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d'),
            'NextFollowUpDate' =>$this->request->getVar('NextFollowUpDate'),
            'Campaign'=>$this->request->getVar('Campaign')
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

    public function getAllLeads()
    {
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);

        $leadModel = new CreateLeadModel($db);

        try {
            $leads = $leadModel->getAllLeadsModel();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching leads: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 500,
                'message' => 'Failed to fetch leads'
            ]);
        }

        if ($leads) {
            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Leads retrieved successfully',
                'data' => $leads
            ]);
        }

        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No leads found'
        ]);
    }



    public function updateWithCustomer($id)
    {
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);

        $leadModel = new CreateLeadModel($db);
        $customerModel = new CustomerModel($db);
    
        // Prepare lead data
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
            'Address'=>$this->request->getVar('Address'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d'),
            'NextFollowUpDate' =>$this->request->getVar('NextFollowUpDate'),
            'Campaign'=>$this->request->getVar('Campaign')
        ];
    
        if ($leadModel->update($id, $leadData)) {
            // Check if LeadType is converted to Customer
            if ($leadData['LeadType'] == 'Booking Done') {
                // Prepare customer data
                $customerData = [
                    'BookingDate' => date('Y-m-d'),
                    'LeadId' => $leadData['LeadId'],
                    'BookedByEmplId' => $leadData['HandlerEmp'],
                    'BookedForProductId' => $leadData['ProductId'],
                    'BookingAmount' => $this->request->getVar('BookingAmount'), // Take as input
                    'InstallationDate' => $this->request->getVar('InstallationDate') // Take as input
                ];
    
                // Check if customer data is valid before inserting.
                if (empty($customerData['BookingAmount']) || !is_numeric($customerData['BookingAmount'])) {
                    return $this->response->setJSON([
                        'status' => 400,
                        'message' => 'Invalid Booking Amount'
                    ]);
                }
    
    
                // Insert customer data
                if (!$customerModel->insert($customerData)) {
                    // Log the error for debugging
                    log_message('error', 'Failed to create customer record: ' . $customerModel->errors());
                    
                    return $this->response->setJSON([
                        'status' => 500,
                        'message' => 'Failed to create customer record'
                    ]);
                }
               
            }
    
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
    

    public function getAllCustomers()
    {

        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);


        $customerModel = new CustomerModel($db);
    
        // Fetch all customer records from the model
        $customers = $customerModel->findAll();
    
        if ($customers) {
            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Customers retrieved successfully',
                'data' => $customers
            ]);
        }
    
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No customers found'
        ]);
    }
    
    public function getCustomerById($id)
{
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $customerModel = new CustomerModel($db);

    // Fetch customer record by ID
    $customer = $customerModel->find($id);

    if ($customer) {
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Customer retrieved successfully',
            'data' => $customer
        ]);
    }

    return $this->response->setJSON([
        'status' => 404,
        'message' => 'Customer not found'
    ]);
}

public function itemExcelUpload()
{
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    // Get the uploaded file
    $file = $this->request->getFile('excel_file');

    // Check if file is uploaded
    if (!$file || !$file->isValid()) {
        return $this->response->setJSON([
            'status' => 400,
            'msg' => 'No file uploaded or file upload failed.',
        ]);
    }

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

        // Define the target fields
        $targetFields = [
            'LeadId', 'LeadNo', 'LeadDate', 'ContactNo', 'LeadName', 'CompanyName', 
            'Location', 'ProductId', 'LeadType', 'LeadPlatForm', 'Reference', 
            'Narration', 'LeadStatus', 'HandlerEmp', 'Address', 'CreatedBy', 
            'CreatedOn', 'UpdatedBy', 'UpdatedOn', 'NextFollowUpDate','Campaign'
        ];

        // Extract column names and data
        $columnNames = array_filter($excelData[0], 'is_string'); // Ensure column names are strings
        $rowData = [];

        // Create a mapping of column names to target fields
        $columnMapping = [];
        foreach ($columnNames as $index => $name) {
            if (in_array($name, $targetFields)) {
                $columnMapping[$name] = $index;
            }
        }

        // Process each row of data
        for ($i = 1; $i < count($excelData); $i++) {
            $row = $excelData[$i];
            $rowAsKeyValue = [];

            foreach ($targetFields as $field) {
                if (isset($columnMapping[$field])) {
                    // For 'CreatedOn' and 'UpdatedOn', extract only the date part
                    if (in_array($field, ['CreatedOn', 'UpdatedOn']) && !empty($row[$columnMapping[$field]])) {
                        $rowAsKeyValue[$field] = date('Y-m-d', strtotime($row[$columnMapping[$field]]));
                    } else {
                        $rowAsKeyValue[$field] = $row[$columnMapping[$field]];
                    }
                } else {
                    // Handle missing columns by setting default values or skipping
                    $rowAsKeyValue[$field] = null; // or some default value
                }
            }

            $rowData[] = $rowAsKeyValue;
        }

        $CreateLeadModel = new CreateLeadModel($db);
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
}


public function leadOptions() {

    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $leadArray = array(
        "Lead",//4          
        "Potential",//3     
        "Demo",//5
        "Call Back",//6
        "Not Interested",//7
        "Visit Required",//8
        // "Data Entry",//9
        "Installation",//2     
        // "Customer",//10
        "Booking Done"//1      
    );
    
    $response = [
        'status' => 200,
        'msg' => 'All lead type options are available',
        'data' => $leadArray
    ];
    
    return $this->response->setJSON($response);
}


public function getAllCustomer(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findCustomerData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Customer retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Customer data found'
        ]);
    }
}

public function getAllDataEntry(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findDataEntryData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Data Entry retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Data Entry data found'
        ]);
    }
}

public function getAllVisitRequired(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findVisitRequiredData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Visit Required retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Visit Required data found'
        ]);
    }
}

public function getAllBookingDone(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findBookingData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Booking data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No booking data found'
        ]);
    }
}

public function getAllInstallation(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findInstallationData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Installation data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Installation data found'
        ]);
    }
}

public function getAllPotential(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findPotentialData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Potential data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Potential data found'
        ]);
    }
}

public function getAllDemo(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findDemoData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Demo data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Demo data found'
        ]);
    }
}

public function getAllCallBack(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findCallBackData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Call Back data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Call Back data found'
        ]);
    }
}


public function getAllNotInterested(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $bookingdone=$CreateLeadModel->findNotInterestedData();

    if($bookingdone){
        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Not Interested data retrieved successfully',
            'data' => $bookingdone
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' => 404,
            'message' => 'No Not Interested data found'
        ]);
    }
}










public function countPotentialtype(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->countPotential();

    if($number){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Count of Potential are as Follows',
            'data'=>$number
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' =>404,
            'message'=>'No data found for Potential',
            'data'=>0
        ]);
    }
}
public function countLeadstype(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->countLeads();

    if($number){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Count of Leads are as Follows',
            'data'=>$number
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' =>404,
            'message'=>'No data found for leads',
            'data'=>0
        ]);
    }
}
public function countInstallationtype(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->countInstallation();

    if($number){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Count of Installation are as Follows',
            'data'=>$number
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' =>404,
            'message'=>'No data found for Installation',
            'data'=>0
        ]);
    }
}
public function countBookingDonetype(){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->countBookingDone();

    if($number){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Count of Booking Done are as Follows',
            'data'=>$number
        ]);
    }
    else{
        return $this->response->setJSON([
            'status' =>404,
            'message'=>'No data found for Booking Done',
            'data'=>0
        ]);
    }
}


public function countAllTypes(){

    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->countAllTypes();
    if($number){
        return $this->response->setJSON(
            [
                'status'=>200,
                'message'=>'Count of all type of leads are as follows',
                'data'=>$number
            ]
            );
    }
    else{
        return $this->response->setJSON([
            'status'=>404,
            'message'=>'No Data Found For All Types',
            'data'=>$number
        ]);
    }
}

public function followUpData($id){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');

    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);
    $number=$CreateLeadModel->findFollowUpDataAll($id);

    if($number){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Follow Up data retrieved successfully',
            'data'=>$number
        ]);
    }
    else{
        return $this->response->setJSON([
            'status'=>404,
            'message'=>'No data found for Follow Up',
            'data'=>0
        ]);
    }

}


public function getleadsbycampaignId($id){
    $dbname = $this->request->getVar('DBNAME');
    $uname = $this->request->getVar('UNAME');
    $pass = $this->request->getVar('PASS');
    $host = $this->request->getVar('HOST');
    
    $connect=new UserLogin();
    $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
    $db = \Config\Database::connect($dbconnectarray);

    $CreateLeadModel = new CreateLeadModel($db);

    $data=$CreateLeadModel->where('Campaign',$id)->findAll();

    if($data){
        return $this->response->setJSON([
            'status'=>200,
            'message'=>'Leads retrieved successfully for campaign ID',
            'data'=>$data
        ]);
    }
    else{
        return $this->response->setJSON([
            'status'=>404,
            'message'=>'No data found for campaign ID',
            'data'=>0
        ]);
    }

}
}
