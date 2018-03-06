<?php
/**
 *店铺管理界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationCompanyinfo;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class StoreController extends Controller{
    //店铺管理创建店铺
    public function store_add(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $program = Package::getList([],0,'id','ASC');//查询所有商户系统套餐程序
        return view('Company/Store/store_add',['program'=>$program,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺管理立即开店
    public function store_add_second(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $package_name = $request->package_name;         //套餐名称
        $package_id = $request->package_id;             //套餐id
        $package_program = Package::getList(['id'=>$package_id],0,'id','DESC');   //查询当前所选餐包含的程序
        dump($package_name);
        dump($package_id);
        dump($package_program);
        return view('Company/Store/store_add_second',['package_name'=>$package_name,'package_program'=>$package_program,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺管理
    public function store_add_second_check(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $parent_id = $admin_data['id'];                 //上级id
        $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树型关系
        $program_id = $request->program_id;
        $organization_name = $request->organization_name;
        $type = '4';                                    //店铺组织为4
        $company_owner = $request->realname;            //负责人姓名
        $company_owner_mobile = $request->tell;         //负责人电话
        $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度
        $user = Account::max('account');
        $account  = $user+1;//用户账号
        $password = $request->password;
        $key = config("app.company_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        DB::beginTransaction();
        try{
            $organization = [
                'organization_name'=>$organization_name,
                'parent_id'        =>$parent_id,
                'parent_tree'      =>$parent_tree,
                'program_id'       =>$program_id,
                'type'             =>$type,
                'status'           =>'1',
            ];
            //在组织表创建保存店铺信息
            $id = Organization::addOrganization($organization);
            $companyinfo = [
                'organization_id'       =>$id,
                'company_owner'         =>$company_owner,
                'company_owner_idcard'  =>'',
                'company_owner_mobile'  =>$company_owner_mobile,
            ];
            //在商户组织信息表创建店铺组织信息
            OrganizationCompanyinfo::addOrganizationCompanyinfo($companyinfo);
            $accdata = [
                'organization_id'  =>$id,
                'parent_id'        =>$parent_id,
                'parent_tree'      =>$parent_tree,
                'deepth'           =>$deepth,
                'account'          =>$account,
                'password'         =>$encryptPwd,
                'mobile'           =>$company_owner_mobile,
            ];
            Account::addAccount($accdata);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在商户管理系统创建了店铺：'.$organization_name);    //保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name,'创建了店铺：'.$organization_name);//保存操作记录
            }
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '创建店铺失败，请稍后再试！', 'status' => '0']);
        }
        return response()->json(['data' => '创建店铺成功,请前往管理店铺进行管理！', 'status' => '1']);
    }

    //店铺管理
    public function store_list(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $parent_id = $admin_data['id'];
        $organization = Organization::getArrayCompany(['parent_id'=>$parent_id]);//type=4为总店组织
        dd($organization);
        return view('Company/Store/store_list',['organization'=>$organization,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>