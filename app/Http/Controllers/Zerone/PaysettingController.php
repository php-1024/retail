<?php

namespace App\Http\Controllers\Zerone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationAgentapply;
use Illuminate\Support\Facades\DB;
use Session;

class PaysettingController extends Controller
{
    /**
     * 代理审核列表
     */
    public function agent_examinelist(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');
        // 中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 代理名字，页面搜索用
        $agent_name = $request->input('agent_name');
        // 手机号码，页面搜索用
        $agent_owner_mobile = $request->input('agent_owner_mobile');
        // 用于分页和输入框value值
        $search_data = ['agent_name' => $agent_name, 'agent_owner_mobile' => $agent_owner_mobile];
        // 数据库值查询条件
        $where = [['status', '<>', '1']];
        if (!empty($agent_name)) {
            //代理名字搜索条件
            $where[] = ['agent_name', 'like', '%' . $agent_name . '%'];
        }
        if (!empty($agent_owner_mobile)) {
            //手机搜索条件
            $where[] = ['agent_owner_mobile', $agent_owner_mobile];
        }
        //查询代理注册审核列表
        $list = OrganizationAgentapply::getPaginage($where, '15', 'id');
        return view('Zerone/Agent/agent_examinelist', ['list' => $list, 'search_data' => $search_data, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }


}

?>