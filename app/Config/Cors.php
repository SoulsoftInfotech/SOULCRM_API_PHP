<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cors extends BaseConfig
{
    public $allowedOrigins = ['*'];
    public $allowedMethods = ['*'];
    public $allowedHeaders = ['*'];
}
    