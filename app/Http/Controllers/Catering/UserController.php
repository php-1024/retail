<?php
namespace App\Http\Controllers\Catering;
use App\Http\Controllers\Controller;
use App\Models\MemberLabel;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;
class UserController extends Controller{
    //粉丝标签管理
    public function user_tag(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/User/user_tag',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //会员标签ajax显示页面
    public function member_label_add(Request $request){

        return view('Catering/User/member_label_add');
    }
    //会员标签功能提交
    public function member_label_add_check(Request $request){
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数

        $member_name = $request->member_name; //会员标签名称
        $organization_id = $menu_data['organization_id'];//组织id
        dd($organization_id);
        $data = [
            'member_name'=>$member_name,
            'organization_id'=>$organization_id,
            'parent_id'=>0,
            'member_number'=>0,
        ];
        MemberLabel::addMemberLabel($data);

        return response()->json(['data' => '创建会员标签成功！', 'status' => '1']);
    }
    //粉丝用户管理
    public function user_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/User/user_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //粉丝用户足迹
    public function user_timeline(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/User/user_timeline',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>