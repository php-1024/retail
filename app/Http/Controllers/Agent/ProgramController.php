<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\AssetsOperation;
use App\Models\Package;
use App\Models\Program;
use Illuminate\Http\Request;
use Session;
class ProgramController extends Controller{
    //系统资产列表
    public function program_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        $list = Program::getPaginage([['is_asset','1']],15,'id');
        dump($list);
//        foreach ($list as $key=>$value) {
//            foreach ($value['programs'] as $k => $v) {
//                $re = Assets::getOne([['organization_id', $organization_id], ['package_id', $value['id']], ['program_id', $v['id']]]);
//                $list[$key]['programs'][$k]['program_spare_num'] = $re['program_spare_num'];
//                $list[$key]['programs'][$k]['program_use_num'] = $re['program_use_num'];
//            }
//        }
        return view('Agent/Program/program_list',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //资产划拨记录
    public function program_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        $list = AssetsOperation::getPaginage([['organization_id',$organization_id]],[['draw_organization_id',$organization_id]],'10','id');//查询操作记录

        return view('Agent/Program/program_log',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}
?>