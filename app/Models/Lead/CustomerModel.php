<?php

namespace App\Models\Lead;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'BookingId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['BookingId', 
    'BookingDate', 
    'LeadId', 
    'BookedByEmplId', 
    'BookedForProductId', 
    'BookingAmount', 
    'InstallationDate'];

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
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->db = \Config\Database::connect();
    //     // OR $this->db = db_connect();
    // }

    // public function __construct()
    // {
    //     parent::__construct();
    //     // $this->db = \Config\Database::connect();
    //     // OR $this->db = db_connect();
    // }

}
