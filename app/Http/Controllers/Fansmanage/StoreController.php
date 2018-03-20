<?php
namespace App\Http\Controllers\Fansmanage;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationBranchinfo;
use App\Models\OrganizationRetailinfo;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class StoreController extends Controller{
    //创建总分店
    public function store_create(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];
        $onebranch = Organization::checkRowExists([['parent_id',$organization_id],['type',4]]); //查询有没有总店，如果有，接下来创建的都是分店
        dump($organization_id);
        return view('Fansmanage/Store/store_create',['onebranch'=>$onebranch,'onebranch'=>$onebranch,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }

    //创建总分店功能提交
    public function store_create_check(Request $request){

        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $organization_id = $admin_data['organization_id']; //组织id
        $oneOrganization =Organization::getOneCatering([['id',$organization_id]]);
        dd($oneOrganization);
        $organization_parent_id = $organization_id;        //组织上级id
        $parent_tree = $oneOrganization['parent_tree'].$organization_id.',';//树型关系

        $program_id = $request->get('program_id');     //选择资产程序id
        $organization_name = $request->organization_name;
        $type = '4';                                    //店铺组织为4
        $realname = $request->realname;            //负责人姓名
        $mobile = $request->mobile;       //负责人电话
        $user = Account::max('account');
        $account  = $user+1;//用户账号
        $password = $request->password;
        $key = config("app.branch_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        DB::beginTransaction();
        try{
            $organization = [
                'organization_name'=>$organization_name,
                'parent_id'        =>$organization_parent_id,
                'parent_tree'      =>$parent_tree,
                'program_id'       =>$program_id,
                'asset_id'         =>$program_id,
                'type'             =>$type,
                'status'           =>'1',
            ];
            //在组织表创建保存店铺信息
            $id = Organization::addOrganization($organization);
            $storeinfo = [
                'organization_id'      =>$id,
                'retail_owner'          =>$realname,
                'retail_owner_idcard'  =>'',
                'retail_owner_mobile'  =>$mobile,
            ];
            //在分店织信息表创建店铺组织信息
            OrganizationRetailinfo::addOrganizationRetailinfo($storeinfo);
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



    //分店店管理
    public function store_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];
        $listBranch = Organization::getbranch([['parent_id',$organization_id],['type',5]],'10','id'); //查询有没有总店，如果有，接下来创建的都是分店

        return view('Catering/Store/store_list',['listBranch'=>$listBranch,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

}
?>