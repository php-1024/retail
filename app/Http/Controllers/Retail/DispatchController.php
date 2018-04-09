<?php
/**
 * 零售版店铺
 * 栏目分类管理
 **/

namespace App\Http\Controllers\Retail;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\DispatchProvince;
use App\Models\OperationLog;
use App\Models\Province;
use App\Models\RetailCategory;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DispatchController extends Controller
{
    //添加运费模板页面
    public function dispatch_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Dispatch/dispatch_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //添加运费模板操作
    public function dispatch_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $dispatch_name = $request->get('dispatch_name');    //栏目名称
        $displayorder = $request->get('displayorder');      //栏目排序
        $number = date('Ymdhis').rand(1000,9999);        //时间加上4为随机数，一共18位数
        if (empty($dispatch_name)){
            return response()->json(['data' => '请输入运费模板名称！', 'status' => '0']);
        }
        if (empty($displayorder)){
            $displayorder = '0';
        }
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $dispatch_data = [
            'name' => $dispatch_name,
            'number' => $number,
            'displayorder' => $displayorder,
            'fansmanage_id' => $fansmanage_id,
            'store_id' => $admin_data['organization_id'],
        ];
        DB::beginTransaction();
        try {
            Dispatch::addDispatch($dispatch_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员添加零售店铺分类的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在零售管理系统添加了运费模板！');//保存操作记录
            }else{//零售店铺本人操作记录
                OperationLog::addOperationLog('10',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了运费模板！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加运费模板失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加运费模板信息成功', 'status' => '1']);
    }


    //运费模板列表
    public function dispatch_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $dispatch_name = $request->get('dispatch_name');    //模板名称
        $list = Dispatch::getPaginage(['store_id'=>$admin_data['organization_id']],$dispatch_name,'0','displayorder','DESC');
        return view('Retail/Dispatch/dispatch_list',['list'=>$list,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //编辑运费模板
    public function dispatch_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $dispatch_id = $request->get('id');                //模板ID
        $dispatch = Dispatch::getOne(['id'=>$dispatch_id]);     //运费模板信息
        $dispatch_province = DispatchProvince::getList(['dispatch_id'=>$dispatch_id],0,'id','ASC');
        foreach ($dispatch_province as $key=>$val){
            $provinces = explode(',',$val->province_id);
            foreach ($provinces as $kk=>$vv){
                $province_name[] = Province::getOne(['id'=>$vv])->first();
            }
        }
        $province = Province::getList([],0,'id','ASC');
        dump($province_name);
        dump($province->toArray());
        dump($dispatch_province);
        return view('Retail/Dispatch/dispatch_edit',['province'=>$province,'dispatch'=>$dispatch,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //运费模板省份添加
    public function dispatch_province_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $dispatch_id = $request->get('dispatch_id');
        $provinces = $request->get('provinces');
        $province = implode(',',$provinces);
        $dispatch_province = ['dispatch_id'=>$dispatch_id,'province_id'=>$province];
        DB::beginTransaction();
        try {
            DispatchProvince::addDispatchProvince($dispatch_province);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在零售管理系统设置了运费模板！');//保存操作记录
            }else{//零售店铺本人操作记录
                OperationLog::addOperationLog('10',$admin_data['organization_id'],$admin_data['id'],$route_name, '设置了运费模板！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加运费区域失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加运费区域信息成功', 'status' => '1']);
    }

}

?>