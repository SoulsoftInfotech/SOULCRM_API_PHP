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
    'UpdatedBy', 'UpdatedOn','NextFollowUpDate'];

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

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }
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
    }

    public function findInstallationData()
    {
        $bookingData = $this->where('LeadStatus','Installation')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findPotentialData()
    {
        $bookingData = $this->where('LeadStatus','Potential')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findDemoData()
    {
        $bookingData = $this->where('LeadStatus','Demo')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findCallBackData()
    {
        $bookingData = $this->where('LeadStatus','Call Back')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findNotInterestedData()
    {
        $bookingData = $this->where('LeadStatus','Not Interested')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findVisitRequiredData()
    {
        $bookingData = $this->where('LeadStatus','Visit Required')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findDataEntryData()
    {
        $bookingData = $this->where('LeadStatus','Data Entry')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }

    public function findCustomerData()
    {
        $bookingData = $this->where('LeadStatus','Customer')->findAll();

        // Format dates to only show the date part
        foreach ($bookingData as &$booking) {
            if (isset($booking['CreatedOn'])) {
                $booking['CreatedOn'] = date('d-m-Y', strtotime($booking['CreatedOn']));
            }
            if (isset($booking['UpdatedOn'])) {
                $booking['UpdatedOn'] = date('d-m-Y', strtotime($booking['UpdatedOn']));
            }
        }
    }
}
