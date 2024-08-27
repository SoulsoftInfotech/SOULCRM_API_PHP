<?php

namespace App\Models\org;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
    protected $db;
    protected $DBGroup          = 'default';
    protected $table            = 'OraganizationMaster';
    protected $primaryKey       = 'Id';
    // protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Id', 'OrganizationName', 'OrgCode', 'Contact', 'DBusername', 'DBName', 'DBPassword', 'IP', 'LiscKey', 'Status', 'GstIn', 'Amount', 'LKFromDate', 'LKToDate', 'CreatedOn', 'UpdatedOn', 'AMCDate'];

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
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }
  
}
