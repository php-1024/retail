<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        /**************************零壹程序管理系统*******************************/
        'ToolingCheck'=>\App\Http\Middleware\Tooling\ToolingCheck::class,//检测普通页面跳转的中间件
        'ToolingCheckAjax'=>\App\Http\Middleware\Tooling\ToolingCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹程序管理系统*******************************/

        /**************************零壹平台管理系统*******************************/
        'ZeroneCheck'=>\App\Http\Middleware\Zerone\ZeroneCheck::class,//检测普通页面跳转的中间件
        'ZeroneCheckAjax'=>\App\Http\Middleware\Zerone\ZeroneCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹平台管理系统*******************************/

        /**************************服务商平台管理系统*******************************/
        'ProxyCheck'=>\App\Http\Middleware\Proxy\ProxyCheck::class,//检测普通页面跳转的中间件
        'ProxyCheckAjax'=>\App\Http\Middleware\Proxy\ProxyCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************服务商平台管理系统*******************************/

        /**************************商户平台管理系统*******************************/
        'CompanyCheck'=>\App\Http\Middleware\Company\CompanyCheck::class,//检测普通页面跳转的中间件
        'CompanyCheckAjax'=>\App\Http\Middleware\Company\CompanyCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************商户平台管理系统*******************************/

        /**************************零壹总店管理系统*******************************/
        'CateringCheck'=>\App\Http\Middleware\Catering\CateringCheck::class,//检测普通页面跳转的中间件
        'CateringCheckAjax'=>\App\Http\Middleware\Catering\CateringCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹总店管理系统*******************************/

        /**************************零壹分店管理系统*******************************/
        'BranchCheck'=>\App\Http\Middleware\Branch\BranchCheck::class,//检测普通页面跳转的中间件
        'BranchCheckAjax'=>\App\Http\Middleware\Branch\BranchCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹分店管理系统*******************************/

        /**************************零壹分店管理系统简版*******************************/
        'CateringBranchCheck'=>\App\Http\Middleware\CateringBranch\CateringBranchCheck::class,//检测普通页面跳转的中间件
        'CateringBranchCheckAjax'=>\App\Http\Middleware\CateringBranch\CateringBranchCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹分店管理系统简版*******************************/

        /**************************零售总店管理系统*******************************/
        'RetailCheck'=>\App\Http\Middleware\Retail\RetailCheck::class,//检测普通页面跳转的中间件
        'RetailCheckAjax'=>\App\Http\Middleware\Retail\RetailCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零售总店管理系统*******************************/
    ];
}
