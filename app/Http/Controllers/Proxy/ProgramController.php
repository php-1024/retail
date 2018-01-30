<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Organization;
use App\Models\Package;
use Illuminate\Http\Request;
use Session;
class ProgramController extends Controller{
    //添加服务商
    public function program_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        $listOrg = Organization::getOneProxy([['id',$organization_id]]);
        $list = Package::getPaginage([],15,'id');
        foreach ($list as $key=>$value) {
            foreach ($value['programs'] as $k => $v) {
                $re = Assets::getOne([['organization_id', $organization_id], ['package_id', $value['id']], ['program_id', $v['id']]]);
                $list[$key]['programs'][$k]['program_spare_num'] = $re['program_spare_num'];
                $list[$key]['programs'][$k]['program_use_num'] = $re['program_use_num'];
            }
        }
        dump($list);
        return view('Proxy/Program/program_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //添加服务商
    public function program_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Proxy/Program/program_log',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}
?>