<?php

namespace Config;

use App\Filters\Ci4ms;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use Modules\Backend\Filters\BackendAfterLoginFilter;
use Modules\Backend\Filters\BackendAuthFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf' => CSRF::class,
        'toolbar' => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'ci4ms' => Ci4ms::class,
        'backendAuthFilter' => BackendAuthFilter::class,
        'backendAfterLoginFilter' => BackendAfterLoginFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            //'honeypot',
            'csrf'=>['except' => [
                'newComment',
                'repliesComment',
                'loadMoreComments',
                'commentCaptcha',
                'backend/blogs/comments/commentResponse'
            ]],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            //'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
