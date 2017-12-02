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
        'ProgramCheckIsLogin'=>\App\Http\Middleware\ProgramCheckIsLogin::class,//判断页面是否登陆，若未登陆则跳转到登录页面
        'ProgramCheckIsLoginAjax'=>\App\Http\Middleware\ProgramCheckIsLoginAjax::class,//判断页面是否登陆，若未登陆提示未登录错误。
        'ProgramIsLogin'=>\App\Http\Middleware\ProgramIsLogin::class,//登录页面判断如果登陆了就跳转到首页
        'ProgramLoginPost'=>\App\Http\Middleware\ProgramLoginPost::class,//登陆提交信息检测是否合法
        'ProgramCheckIsSuper'=>\App\Http\Middleware\ProgramCheckIsSuper::class,//检测是否超级管理员，若不是超级管理员，不能使用超级管理员的一些功能
        'ProgramCheckIsSuperAjax'=>\App\Http\Middleware\ProgramCheckIsSuperAjax::class,//检测是否超级管理员，若不是超级管理员，不能使用超级管理员的一些功能
        'ProgramAccountAddCheck'=>\App\Http\Middleware\ProgramAccountAddCheck::class,//添加系统管理员时的表单检测中间件
        'ProgramEditPasswordCheck'=>\App\Http\Middleware\ProgramEditPasswordCheck::class,//修改登录密码时的表单检测中间件
        'ProgramNodeAddCheck'=>\App\Http\Middleware\ProgramNodeAddCheck::class,//添加节点时的表单检测中间件
        'ProgramNodeEditCheck'=>\App\Http\Middleware\ProgramNodeAddCheck::class,//编辑节点时的表单检测中间件
        'ProgramAccountEditCheck'=>\App\Http\Middleware\ProgramAccountEditCheck::class,//修改账号信息时的表单检测中间件
        'ProgramAccountLockCheck'=>\App\Http\Middleware\ProgramAccountLockCheck::class,//修改账号信息时的表单检测中间件
        'ProgramCheckSearchDate'=>\App\Http\Middleware\ProgramCheckSearchDate::class,//检测查询时日期范围格式的中间件
        /**************************零壹程序管理系统*******************************/
    ];
}
