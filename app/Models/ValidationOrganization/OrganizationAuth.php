<?php

namespace App\Models\ValidationOrganization;

use CodeIgniter\Model;

class OrganizationAuth extends Model
{
    protected $table            = 'OraganizationMaster';
    protected $primaryKey       = 'Id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'OrganizationName', 'OrgCode', 'Contact', 'DBName', 'DBPassword', 'IP', 
    'LiscKey', 'Status', 'GstIn', 'Amount', 'LKFromDate', 'LKToDate', 
    'CreatedOn', 'UpdatedOn', 'AMCDate'];

    protected bool $allowEmptyInserts = false;
    
    protected $DBGroup      ='default';
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



public function ValidateOrganizationCode($code){
   return $this->where('OrgCode',$code)->first();
}
}