<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [];

    public function __construct()
    {
        parent::__construct();

        // Default database configuration
        $this->default = [
            'DSN'          => '',
            'hostname'     => 'localhost',
            'username'     => 'u311423116_CRM',
            'password'     => 'SoulSoft@2024',
            'database'     => 'u311423116_SoulOrgCRM',
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => true,
            'charset'      => 'utf8',
            'DBCollat'     => 'utf8_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => 3306, // Default MySQL port
            'numberNative' => false,
        ];

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}

// namespace Config;

// use CodeIgniter\Database\Config;

// /**
//  * Database Configuration
//  */
// class Database extends Config
// {
//     /**
//      * The directory that holds the Migrations
//      * and Seeds directories.
//      */
//     public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

//     /**
//      * Lets you choose which connection group to
//      * use if no other is specified.
//      */
//     public string $defaultGroup = 'default';

//     /**
//      * The default database connection.
//      *
//      * @var array<string, mixed>
//      */
//     public array $default = [];

//     public function __construct()
//     {
//         parent::__construct();

//         // Check for database configuration in the session
//         $dbConfig = session()->get('dbConfig');

//         if ($dbConfig) {
//             $this->default = [
//                 'DSN'          => $dbConfig['DSN'] ?? '',
//                 'hostname'     =>'localhost',
//                 'username'     => $dbConfig['username'] ?? '',
//                 'password'     => $dbConfig['password'] ?? '',
//                 'database'     => $dbConfig['database'] ?? '',
//                 'DBDriver'     => $dbConfig['DBDriver'] ?? 'MySQLi',
//                 'DBPrefix'     => $dbConfig['DBPrefix'] ?? '',
//                 'pConnect'     => $dbConfig['pConnect'] ?? false,
//                 'DBDebug'      => $dbConfig['DBDebug'] ?? true,
//                 'charset'      => $dbConfig['charset'] ?? 'utf8',
//                 'DBCollat'     => $dbConfig['DBCollat'] ?? 'utf8_general_ci',
//                 'swapPre'      => $dbConfig['swapPre'] ?? '',
//                 'encrypt'      => $dbConfig['encrypt'] ?? false,
//                 'compress'     => $dbConfig['compress'] ?? false,
//                 'strictOn'     => $dbConfig['strictOn'] ?? false,
//                 'failover'     => $dbConfig['failover'] ?? [],
//                 'port'         => $dbConfig['port'] ?? 3306,
//                 'numberNative' => $dbConfig['numberNative'] ?? false,
//             ];
//         } else {
//             // Default database configuration
//             $this->default = [
//                 'DSN'          => '',
//                 'hostname'     => 'localhost',
//                 'username'     => 'u311423116_CRM',
//                 'password'     => 'SoulSoft@2024',
//                 'database'     => 'u311423116_SoulOrgCRM',
//                 'DBDriver'     => 'MySQLi',
//                 'DBPrefix'     => '',
//                 'pConnect'     => false,
//                 'DBDebug'      => true,
//                 'charset'      => 'utf8',
//                 'DBCollat'     => 'utf8_general_ci',
//                 'swapPre'      => '',
//                 'encrypt'      => false,
//                 'compress'     => false,
//                 'strictOn'     => false,
//                 'failover'     => [],
//                 'port'         => 3306,
//                 'numberNative' => false,
//             ];
//         }

//         // Ensure that we always set the database group to 'tests' if
//         // we are currently running an automated test suite, so that
//         // we don't overwrite live data on accident.
//         if (ENVIRONMENT === 'testing') {
//             $this->defaultGroup = 'tests';
//         }
//     }
// }
