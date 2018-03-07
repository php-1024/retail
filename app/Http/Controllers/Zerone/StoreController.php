<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\Assets;
use App\Models\AssetsOperation;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationStoreinfo;
use App\Models\Package;
use App\Models\PackageProgram;
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
        $organization_name  = $request->organization_name;
        $where = ['type'=>'4'];
        $branch_munber = [];
        $listStore = Organization::getCateringAndAccount($organization_name,$where,20,'id'); //查询店铺
        foreach($listStore as $key=>$val){
            $oneAssets = Assets::getOne([['organization_id',$val->id]]);
            $branch_munber[$val->id]=!empty($oneAssets->program_spare_num)?$oneAssets->program_spare_num:0;
        }
        dd($branch_munber);
        return view('Zerone/Store/store_list',['listStore'=>$listStore,'branch_munbe'=>$branch_munber,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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

        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $program_id = $request->program_id;//程序id--资产程序
        $organization_id = $request->organization_id;//组织id
        $organization_name = $request->organization_name;//店铺名称
        $re = Organization::checkRowExists([['organization_name',$organization_name]]);
        if($re == 'true'){
            return response()->json(['data' => '店铺名称已存在！', 'status' => '0']);
        }
        $program_munber = $request->program_munber;//允许开设分店数量
        $assets_status = $request->assets_status;//是否消耗上级组织的开设分店数量
        $realname = $request->realname;//负责人姓名
        $password = $request->password;//店铺登入密码
        $program = '4';//程序id --管理程序
        $type = '4';//店铺组织
        $oneOrg = Organization::getOneCompany(['id'=>$organization_id]);
        $parent_tree = $oneOrg['parent_tree'] . ','.$organization_id . ',';//组织树

        $user = Account::max('account');
        $account  = $user+1;//用户账号

        $key = config("app.catering_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $package_id = PackageProgram::where([['program_id',$program_id]])->pluck('package_id')->first(); //套餐id

        DB::beginTransaction();
        try{
            $organization = [
                'organization_name'=>$organization_name,
                'parent_id'        =>$organization_id,
                'parent_tree'      =>$parent_tree,
                'program_id'       =>$program,
                'type'             =>$type,
                'status'           =>'1',
            ];
            //在组织表创建保存店铺信息
            $id = Organization::addOrganization($organization);

            if($assets_status == '1' && $organization_id!=1){//如果消耗上级组织开设分店数量并且不是零壹组织
                $assets = Assets::getOne([['program_id',$program_id],['organization_id',$organization_id]]);//查询程序数量
                if($program_munber > $assets['program_spare_num']){
                    return response()->json(['data' => '该店铺能使用的程序数量没有那么多！', 'status' => '0']);
                }
                $number = $assets['program_spare_num']-$program_munber; //剩余数量
                $use_number = $assets['program_use_num']+$program_munber; //使用数量
                Assets::editAssets([['id',$assets['id']]],['program_spare_num'=>$number,'program_use_num'=>$use_number]);

                $data = ['account_id'=>$admin_data['id'],'organization_id'=>$organization_id,'draw_organization_id'=>$id,'program_id'=>$program_id,'package_id'=>$package_id,'status'=>$assets_status,'number'=>$number];
                //添加操作日志
                AssetsOperation::addAssetsOperation($data);//保存操作记录
            }

            $addAssets = [
                'package_id'        =>$package_id,
                'organization_id'   =>$id,
                'program_id'        =>$program_id,
                'program_spare_num' =>$program_munber,
                'program_use_num'   =>'0',
            ];
            //程序管理资产数量添加
            Assets::addAssets($addAssets);

            $storeinfo = [
                'organization_id'     =>$id,
                'store_owner'         =>$realname,
                'store_owner_idcard'  =>'',
                'store_owner_mobile'  =>'',
            ];
            //在店铺织信息表创建店铺组织信息
            OrganizationStoreinfo::addOrganizationStoreinfo($storeinfo);
            $accdata = [
                'organization_id'  =>$id,
                'parent_id'        =>'1',
                'parent_tree'      =>'0'.','.'1'.',',
                'deepth'           =>'1',
                'account'          =>$account,
                'password'         =>$encryptPwd,
                'mobile'           =>'',
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
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'创建了店铺'.$organization_name);//保存操作记录

            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '创建店铺失败，请稍后再试！', 'status' => '0']);
        }
        return response()->json(['data' => '创建店铺成功,请前往总店铺列表进行管理！', 'status' => '1']);

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