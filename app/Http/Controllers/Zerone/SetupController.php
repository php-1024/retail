<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Setup;
use Illuminate\Http\Request;
use Session;


class SetupController extends Controller{
    //参数设置展示
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $setup_list = Setup::get_all();

        dump(Setup::getOne([['id','2']])->cfg_value);
        dump($request);
        $re = Setup::where('id','=',1)->restore();//修改保存服务商通道链接开启状态(软删除)
        if ($re){
            dump('软删除恢复成功');
        }else{
            dump('软删除恢复失败');
        }
        return view('Zerone/Setup/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'setup_list'=>$setup_list]);
    }
    //参数设置编辑
    public function setup_edit_check(Request $request){
        $serviceurl = $request->input('serviceurl');//[serviceurl]服务商通道链接
        $merchanturl = $request->input('merchanturl');//[merchant]商户通道链接
        $depth = $request->input('depth');//[depth]人员构深度设置
        $serviceurl_deleted = $request->input('serviceurl_deleted');//是否开启服务商通道链接
        $merchanturl_deleted = $request->input('merchanturl_deleted');//是否开启商户通道链接
        Setup::editSetup([['id',1]],['cfg_value'=>$serviceurl]);//修改保存服务商通道链接
        Setup::editSetup([['id',2]],['cfg_value'=>$merchanturl]);//修改保存商户通道链接
        Setup::editSetup([['id',3]],['cfg_value'=>$depth]);//修改保存人员构深度设置
        if(empty($serviceurl_deleted)){
            Setup::editSetup([['id',1]],['deleted_at'=>time()]);//修改保存服务商通道链接开启状态
        }else{
            Setup::editSetup([['id',1]],['deleted_at'=>null]);//修改保存服务商通道链接开启状态
        }
        if(empty($merchanturl_deleted)){
            Setup::editSetup([['id',2]],['deleted_at'=>time()]);//修改保存商户通道链接开启状态
        }else{
            Setup::editSetup([['id',2]],['deleted_at'=>null]);//修改保存服务商通道链接开启状态
        }
        return response()->json(['data' => '系统参数修改成功！', 'status' => '1']);
    }
}