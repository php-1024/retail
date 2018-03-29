<?php
/**
 * 零售版店铺
 * 进销存管理-进出管理
 **/
namespace App\Http\Controllers\Retail;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\FansmanageUser;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationRetailinfo;
use App\Models\Program;
use App\Models\RetailCategory;
use App\Models\RetailGoods;
use App\Models\RetailOrder;
use App\Models\RetailSupplier;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    //零售进销存管理--供应商添加
    public function supplier_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $where = [
            'retail_id' => $admin_data['organization_id'],
        ];
        $category = RetailCategory::getList($where, '0', 'displayorder', 'DESC');   //栏目
        return  view('Retail/Import/supplier_add',['category'=>$category,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //零售进销存管理--供应商添加数据操作
    public function supplier_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $company_name = $request->get('company_name');      //公司名称
        $contactname = $request->get('contactname');        //联系人姓名
        $contactmobile = $request->get('contactmobile');    //联系人电话
        $displayorder = $request->get('displayorder');      //排序
        if (empty($displayorder)){
            $displayorder = '0';
        }
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $supplier_data = [
            'company_name' => $company_name,
            'contactname' => $contactname,
            'contactmobile' => $contactmobile,
            'displayorder' => $displayorder,
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $admin_data['organization_id'],
        ];
        DB::beginTransaction();
        try {
            RetailSupplier::addSupplier($supplier_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员添加零售店铺供应商的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在零售管理系统添加了供应商！');//保存操作记录
            }else{//零售店铺本人操作记录
                OperationLog::addOperationLog('10',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了供应商！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加供应商失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加供应商成功', 'status' => '1']);
    }

    //零售进销存管理--供应商列表
    public function supplier_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $company_name = $request->get('company_name');         //获取供应商名称
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id');    //获取粉丝管理平台的组织id
        $where = [
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $admin_data['organization_id'],
        ];
        $supplier = RetailSupplier::getPaginage($where,$company_name,'0', 'displayorder', 'DESC');   //供应商信息
        return  view('Retail/Import/supplier_list',['supplier'=>$supplier,'company_name'=>$company_name,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}

?>