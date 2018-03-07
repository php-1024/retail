<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Module;
use App\Models\Organization;
use App\Models\Package;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class StoreController extends Controller{
    //店铺列表
    public function store_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺添加
    public function store_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = Program::getPaginage([['complete_id','3']],15,'id');
        $module_list = [];//功能模块列表
        foreach($list as $key=>$val){
            $program_id = $val->id;
            $module_list[$val->id] =Module::getListProgram($program_id,[],0,'id');
        }
        return view('Zerone/Store/store_add',['list'=>$list,'module_list'=>$module_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺添加
    public function store_insert(Request $request){
        $program_id = $request->input('id');//程序id
        $program_name = Program::getPluck([['id',$program_id]],'program_name')->first();//程序名字
        $listOrg = Organization::where([['type','3'],['status','1']])->Orwhere([['type','1']])->get();//上级组织信息
        return view('Zerone/Store/store_insert',['program_id'=>$program_id,'program_name'=>$program_name,'listOrg'=>$listOrg]);
    }

    //店铺添加功能提交
    public function store_insert_check(Request $request){

        $program_id = $request->program_id;//程序id
        $organization_id = $request->organization_id;//组织id
        $organization_name = $request->organization_name;//店铺名称
        $program_munber = $request->program_munber;//允许开设分店数量
        $assets_status = $request->assets_status;//是否消耗上级组织的开设分店数量
        $realname = $request->realname;//负责人姓名
        $password = $request->password;//店铺登入密码
        $program_id = '4';//程序id
        $type = '4';//店铺组织
        $oneOrg = Organization::getListProxy(['id'=>$organization_id]);
        dd($oneOrg);
        $key = config("app.catering_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重

        DB::beginTransaction();
        try{
            $organization = [
                'organization_name'=>$organization_name,
                'parent_id'        =>$organization_id,
                'parent_tree'      =>$parent_tree,
                'program_id'       =>$program_id,
                'type'             =>$type,
                'status'           =>'1',
            ];
            //在组织表创建保存店铺信息
            $id = Organization::addOrganization($organization);
            $branchinfo = [
                'organization_id'      =>$id,
                'branch_owne'          =>$realname,
                'branch_owner_idcard'  =>'',
                'branch_owner_mobile'  =>$mobile,
                'type'                 =>$branch_type,
            ];
            //在分店织信息表创建店铺组织信息
            OrganizationBranchinfo::addOrganizationBranchinfo($branchinfo);
            $accdata = [
                'organization_id'  =>$id,
                'parent_id'        =>'1',
                'parent_tree'      =>'0'.','.'1'.',',
                'deepth'           =>'1',
                'account'          =>$account,
                'password'         =>$encryptPwd,
                'mobile'           =>$mobile,
            ];
            //在管理员表添加信息
            $account_id = Account::addAccount($accdata);

            $accdatainfo = [
                'account_id'        =>$account_id,
                'realname'         =>$realname,
                'idcard'           =>'',
            ];
            //在管理员表添加信息
            AccountInfo::addAccountInfo($accdatainfo);
            //添加操作日志
            if ($admin_data['is_super'] == 2){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在店铺理系统创建了店铺：'.$organization_name);    //保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('4',$admin_data['organization_id'],$admin_data['id'],$route_name,'创建了分店：'.$organization_name);//保存操作记录
            }
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '创建分店失败，请稍后再试！', 'status' => '0']);
        }
        return response()->json(['data' => '创建分店成功,请前往总分店管理进行管理！', 'status' => '1']);

    }

    //店铺人员架构
    public function store_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_structure',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺分店管理
    public function store_branchlist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_branchlist',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺设置参数
    public function store_config(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_config',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}