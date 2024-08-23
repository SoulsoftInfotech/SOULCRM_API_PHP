<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserLoginModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'EmpId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['EmpId', 'EmpCode', 'EmpName', 'Designation', 'LoginUserName', 'Password', 'Description', 'CreatedBy', 'CreatedOn', 'UpdatedBy', 'UpdatedOn'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'CreatedOn';
    protected $updatedField  = 'UpdatedOn';
    protected $deletedField  = null; // No soft deletes

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
    }

    // Optional: Implement dynamic database connection if needed
}
