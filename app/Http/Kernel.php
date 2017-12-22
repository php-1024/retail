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
        //检测是否登录
        'CheckIsLogin'=> \App\Http\Middleware\CheckIsLogin::class,
        //检测是否登录 - 登录页面 防止重复使用登录页面
        'CheckNotLogin'=> \App\Http\Middleware\CheckNotLogin::class,
        //检测用户登录后台提交的数据是否一致
        'DashBoardLoginPost'=>\App\Http\Middleware\DashBoardLoginPost::class,
        /**************************零壹程序管理系统*******************************/
        'ToolingCheckIsLogin'=>\App\Http\Middleware\Tooling\ToolingCheckIsLogin::class,//判断页面是否登陆，若未登陆则跳转到登录页面
        'ToolingCheckIsLoginAjax'=>\App\Http\Middleware\Tooling\ToolingCheckIsLoginAjax::class,//判断页面是否登陆，若未登陆提示未登录错误。
        'ToolingLoginPost'=>\App\Http\Middleware\Tooling\ToolingLoginPost::class,//登陆提交信息检测是否合法
        'ToolingCheckIsSuper'=>\App\Http\Middleware\Tooling\ToolingCheckIsSuper::class,//检测是否超级管理员，若不是超级管理员，不能使用超级管理员的一些功能
        'ToolingCheckIsSuperAjax'=>\App\Http\Middleware\Tooling\ToolingCheckIsSuperAjax::class,//检测是否超级管理员，若不是超级管理员，不能使用超级管理员的一些功能
        'ToolingAccountAddCheck'=>\App\Http\Middleware\Tooling\ToolingAccountAddCheck::class,//添加系统管理员时的表单检测中间件
        'ToolingEditPasswordCheck'=>\App\Http\Middleware\Tooling\ToolingEditPasswordCheck::class,//修改登录密码时的表单检测中间件
        'ToolingNodeAddCheck'=>\App\Http\Middleware\Tooling\ToolingNodeAddCheck::class,//添加节点时的表单检测中间件
        'ToolingNodeEditCheck'=>\App\Http\Middleware\Tooling\ToolingNodeAddCheck::class,//编辑节点时的表单检测中间件
        'ToolingAccountEditCheck'=>\App\Http\Middleware\Tooling\ToolingAccountEditCheck::class,//修改账号信息时的表单检测中间件
        'ToolingAccountLockCheck'=>\App\Http\Middleware\Tooling\ToolingAccountLockCheck::class,//修改账号信息时的表单检测中间件
        'ToolingCheckSearchDate'=>\App\Http\Middleware\Tooling\ToolingCheckSearchDate::class,//检测查询时日期范围格式的中间件
        'ToolingModuleAddCheck'=>\App\Http\Middleware\Tooling\ToolingModuleAddCheck::class,//检测查询时日期范围格式的中间件
        'ToolingModuleEditCheck'=>\App\Http\Middleware\Tooling\ToolingModuleEditCheck::class,//检测查询时日期范围格式的中间件
        'ToolingProgramAddCheck'=>\App\Http\Middleware\Tooling\ToolingProgramAddCheck::class,//检测查询时日期范围格式的中间件
        'ToolingProgramEditCheck'=>\App\Http\Middleware\Tooling\ToolingProgramEditCheck::class,//检测查询时日期范围格式的中间件
        'ToolingCheck'=>\App\Http\Middleware\Tooling\ToolingCheck::class,//检测普通页面跳转的中间件
        'ToolingCheckAjax'=>\App\Http\Middleware\Tooling\ToolingCheckAjax::class,//检测Ajax数据提交的中间件
        /**************************零壹程序管理系统*******************************/
    ];
}
