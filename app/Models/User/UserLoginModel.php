<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserLoginModel extends Model
{
    protected $table            = 'Employees';
    protected $primaryKey       = 'Id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['EmpId','EmpCode', 'EmpName', 'LoginType', 'LoginUserName', 'Password', 'Description', 'CreatedBy', 'CreatedOn', 'UpdatedBy', 'UpdatedOn'];

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
    public function setDatabaseConnection($db)
    {
        $this->db = $db;
        // $this->db->initialize(); // Ensure the database connection is initialized
    }
     
    // public function __construct()
    // {
    //     parent::__construct();
    //      $this->db = \Config\Database::connect();
    // }

    // Optional: Implement dynamic database connection if needed
}
