<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserLoginModel extends Model
{
    protected $db;
    protected $DBGroup          = 'soulsoftDB';
    protected $table            = 'employees';
    protected $primaryKey       = 'EmpId';
    // protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['EmpId','EmpCode','EmpName','Designation','LoginUserName','Password','Description','CreatedBy','CreatedOn','UpdatedBy','UpdatedOn'];

    // protected bool $allowEmptyInserts = false;


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
    // protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    // protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function __construct()
    {
        parent::__construct();
        // $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }

    
}
