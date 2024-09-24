<?php

namespace App\Models\FollowUp;

use CodeIgniter\Model;

class FollowUpModel extends Model
{
    protected $table            = 'followup';
    protected $primaryKey       = 'Id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'LeadId',
        'Date',
        'Communication',
        'NextFollowUpDate',
        'FollowUpEmployee'
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
    
    protected $db; // Add this property to hold the dynamic database connection

    // Constructor to accept a dynamic database connection
    public function __construct($db = null)
    {
        parent::__construct();

        // If a dynamic database connection is provided, use it
        if ($db !== null) {
            $this->db = $db;
        }
    }
}
