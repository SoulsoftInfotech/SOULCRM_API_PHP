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
    'UpdatedBy', 'UpdatedOn'];

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
                $lead['CreatedOn'] = date('Y-m-d', strtotime($lead['CreatedOn']));
            }
            if (isset($lead['UpdatedOn'])) {
                $lead['UpdatedOn'] = date('Y-m-d', strtotime($lead['UpdatedOn']));
            }
        }

        return $leads;
    }
}
