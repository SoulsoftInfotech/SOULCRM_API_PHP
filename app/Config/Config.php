<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    public $jwtSecret;

    public function __construct()
    {
        parent::__construct();

        // Load JWT secret from environment variables
        $this->jwtSecret = getenv('JWT_SECRET');
    }
}
