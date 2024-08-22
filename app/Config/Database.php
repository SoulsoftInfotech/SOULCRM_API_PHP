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


     //----------------------------------Organization Database--------------------------------//
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'u311423116_CRM',
        'password'     => 'SoulSoft@2024',
        'database'     => 'u311423116_SoulOrgCRM',
        // 'username'     => 'u311423116_soulcrm',
        // 'password'     => 'SoulSoft@2024',
        // 'database'     => 'u311423116_soulcrm',
        // 'username'     => 'root',
        // 'password'     => '',
        // 'database'     => 'soul_crm',
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
        'port'         => 3306,
        'numberNative' => false,
    ];

      //----------------------------------SoulSoft Database--------------------------------//
    public array $soulsoftDB = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'u311423116_soulcrm',
        'password'     => 'SoulSoft@2024',
        'database'     => 'u311423116_soulcrm',
        // 'username'     => 'root',
        // 'password'     => '',
        // 'database'     => 'soul_crm',
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
        'port'         => 3306,
        'numberNative' => false,
    ];

     //----------------------------------RKenterprises Database--------------------------------//
     public array $RKEntDB = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'u311423116_SoulSoft_RKEnt',
        'password'     => 'SoulSoft@2024',
        'database'     => 'u311423116_SoulSoft_RKEnt',
        // 'username'     => 'root',
        // 'password'     => '',
        // 'database'     => 'soul_crm',
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
        'port'         => 3306,
        'numberNative' => false,
    ];



    // 'hostname'     => 'https://soulcrm.soulsoft.in/',
// 'database'     => 'soul_crm'
    /**
     * This database connection is used when
     * running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
