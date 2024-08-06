<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cors extends BaseConfig
{
    public $allowedOrigins = ['http://localhost:3000'];
    public $allowedMethods = ['GET', 'POST', 'OPTIONS'];
    public $allowedHeaders = ['Content-Type', 'Authorization'];
}
