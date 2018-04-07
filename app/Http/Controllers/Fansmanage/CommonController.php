<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/7
 * Time: 11:14
 */

namespace App\Http\Controllers\Fansmanage;


use App\Http\Controllers\Controller;
use App\Models\OperationLog;

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

    /**
     * 返回消息提示
     * @param string $status 状态码
     * @param string $data 状态信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponseMsg($status, $data)
    {
        $responseData = [
            "status" => $status,
            "data" => $data
        ];
        return response()->json($responseData);
    }

    /**
     * 添加操作记录
     * @param $program_id
     * @param $info
     * @param $organization_id
     * @param $id
     */
    public function insertOperationLog($program_id, $info, $organization_id = '', $id = '')
    {
        $this->getRequestInfo();
        // 判断是否有传送组织id
        $organization_id = $organization_id ?? $this->admin_data['organization_id'];
        // 判断是否有传送id
        $id = $id ?? $this->admin_data['id'];
        dump($organization_id);
        dump($id);

        $res = OperationLog::addOperationLog($program_id, $organization_id, $id, $this->route_name, $info);

        dd($res);
    }
}