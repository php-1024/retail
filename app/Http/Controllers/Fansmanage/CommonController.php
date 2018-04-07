<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/7
 * Time: 11:14
 */

namespace App\Http\Controllers\Fansmanage;


use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    protected $admin_data = [];
    protected $menu_data = [];
    protected $son_menu_data = [];
    protected $route_name = '';

    /**
     * 请求参数的获取
     */
    public function getRequestInfo()
    {
        // 中间件产生的 管理员数据参数
        $this->admin_data = request()->get('admin_data');
        // 中间件产生的 菜单参数
        $this->menu_data = request()->get('menu_data');
        // 中间件产生的 子菜单参数
        $this->son_menu_data = request()->get('son_menu_data');
        // 获取当前的页面路由
        $this->route_name = request()->path();
    }
}