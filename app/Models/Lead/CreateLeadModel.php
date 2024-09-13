<?php

namespace App\Models\Lead;

use CodeIgniter\Model;

class CreateLeadModel extends Model
{
    protected $table            = 'Leads';
    protected $primaryKey       = 'LeadId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['LeadNo', 'LeadDate', 'ContactNo', 'LeadName', 'CompanyName', 
    'Location', 'ProductId', 'LeadType', 'LeadPlatForm', 'Reference', 
    'Narration', 'LeadStatus', 'HandlerEmp','Address','CreatedBy', 'CreatedOn', 
    'UpdatedBy', 'UpdatedOn','NextFollowUpDate','Campaign'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $db; // Add this property to hold the dynamic database connection
    public function __construct($db = null)
    {
        parent::__construct();

        // If a dynamic database connection is provided, use it
        if ($db !== null) {
            $this->db = $db;
        }
    }
    // public function __construct()
    // {
    //     parent::__construct();
    //     // $this->db = \Config\Database::connect();
    //     // OR $this->db = db_connect();
    // }
    public function setDatabaseConnection($db)
    {
        $this->db = $db;
        // $this->db->initialize(); // Ensure the database connection is initialized
    }

    // public function connectToDatabaseCreateLead($orgcode){
    //     if($orgcode==89){          
    //         $this->db = \Config\Database::connect('soulsoftDB');
    //     }
    //     else{         
    //         $this->db = \Config\Database::connect('RKEntDB');
    //     }
      
    // }
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->db = \Config\Database::connect();
    //     // OR $this->db = db_connect();
    // }
    // public function getAllLeadsModel(){
    //     return $this->where('LeadStatus','Lead')->findAll();
    // }
    public function getAllLeadsModel()
    {
        $leads = $this->where('LeadStatus', 'Lead')->findAll();

        // Format dates to only show the date part
        foreach ($leads as &$lead) {
            if (isset($lead['CreatedOn'])) {
                $lead['CreatedOn'] = date('d-m-Y', strtotime($lead['CreatedOn']));
            }
            if (isset($lead['UpdatedOn'])) {
                $lead['UpdatedOn'] = date('d-m-Y', strtotime($lead['UpdatedOn']));
            }
        }

        return $leads;
    }

    public function findBookingData()
    {
        $bookingData = $this->where('LeadStatus','Booking Done')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
        return $bookingData;
    }

    public function findInstallationData()
    {
        $installationData = $this->where('LeadStatus','Installation')->findAll();

        // Format dates to only show the date part
        foreach ($installationData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
        return $installationData;
    }

    public function findPotentialData()
    {
        $PotentialData = $this->where('LeadStatus','Potential')
                              ->orWhere('LeadStatus','Visit Required')  
                              ->findAll();

        // Format dates to only show the date part
        foreach ($PotentialData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
        return $PotentialData;
    }

    public function findDemoData()
    {
        $DemoData = $this->where('LeadStatus','Demo')->findAll();

        // Format dates to only show the date part
        foreach ($DemoData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $DemoData;

    }

    public function findCallBackData()
    {
        $CallBackData = $this->where('LeadStatus','Call Back')->findAll();

        // Format dates to only show the date part
        foreach ($CallBackData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $CallBackData;
    }

    public function findNotInterestedData()
    {
        $NotInterestedData = $this->where('LeadStatus','Not Interested')->findAll();

        // Format dates to only show the date part
        foreach ($NotInterestedData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $NotInterestedData;
    }

    public function findVisitRequiredData()
    {
        $VisitRequiredData = $this->where('LeadStatus','Visit Required')->findAll();

        // Format dates to only show the date part
        foreach ($VisitRequiredData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $VisitRequiredData;
    }

    public function findDataEntryData()
    {
        $DataEntryData = $this->where('LeadStatus','Data Entry')->findAll();

        // Format dates to only show the date part
        foreach ($DataEntryData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $DataEntryData;
    }

    public function findCustomerData()
    {
        $CustomerData = $this->where('LeadStatus','Customer')->findAll();

        // Format dates to only show the date part
        foreach ($CustomerData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }

        return $CustomerData;
    }
















    public function countLeads(){
        return $this->where('LeadStatus','Lead')->countAllResults();
    }
    public function countPotential(){
        return $this->where('LeadStatus','Potential')->countAllResults();
    }
    public function countInstallation(){
        return $this->where('LeadStatus','Installation')->countAllResults();
    }
    public function countBookingDone(){
        return $this->where('LeadStatus','Booking Done')->countAllResults();
    }
    

    public function countAllTypes(){
        $leads =$this->where('LeadStatus','Lead')->countAllResults();
        $potential =$this->where('LeadStatus','Potential')->countAllResults();
        $installation =$this->where('LeadStatus','Installation')->countAllResults();
        $bookingDone =$this->where('LeadStatus','Booking Done')->countAllResults();
        return array('leads'=>$leads,'potential'=>$potential,'installation'=>$installation,'bookingDone'=>$bookingDone);
    }



    public function findFollowUpDataAll($id){
        return $this->where('LeadId',$id)->findAll();
    }
}
