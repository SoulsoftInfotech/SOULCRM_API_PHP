<?php

namespace App\Models\Campaign;

use CodeIgniter\Model;

class CampaignModel extends Model
{
    protected $table            = 'Campaign';
    protected $primaryKey       = 'CampaignId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
   
    protected $allowedFields = [
       'CampaignName',
        'ContactNo',
        'Location',
        'Description',
        'HandlerEmpId',
        'HandlerEmp',
        'Image',
        'Video',
        'CreatedBy',
        'CreatedOn',
        'UpdatedBy',
        'UpdatedOn'
    ];
    

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
    protected $db;
    public function __construct($db = null)
    {
        parent::__construct();

        // If a dynamic database connection is provided, use it
        if ($db !== null) {
            $this->db = $db;
        }
    }
    public function countCampaign()
    {
        $campaignCount = $this->countAllResults(); // Count all rows in the table without executing a query
        return $campaignCount;
    }
}
