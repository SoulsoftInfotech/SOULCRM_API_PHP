<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
// use App\Filters\CorsFilter;
use App\Filters\JWTAuthFilter; // Import the JWTAuthFilter class


class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        // 'cors'          => \App\Filters\CorsFilter::class,
        // 'cors' => CorsFilter::class,
        'authFilter'    => \App\Filters\JWTAuthFilter::class, // Correctly define the alias
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            'cors' => ['except' => ['*']], // Apply CORS filter to all API routes except these
            'authFilter' => [
                'except' => [
                    'api/users/login', // Make sure this matches the actual route
                    'api/users/create' ,// Example of another route that might need exclusion
                    'api/org/getdts' // Example of another route that might need exclusion'
                ],
            ],
        ],
        'after' => [
            // 'cors' => ['except' => []],
            // 'cors',
            'toolbar',
          
        ],
    ];
     

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [
        'authFilter' => \App\Filters\JWTAuthFilter::class, // Correctly define the alias
        // 'authFilter' => ['before' => ['api/*']],
    ];
}
