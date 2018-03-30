<?php
/**
 * 零售版店铺
 * 进出开单管理
 **/

namespace App\Http\Controllers\Retail;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\RetailCategory;
use App\Models\Organization;
use App\Models\RetailPurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BillingController extends Controller
{
    //添加商品分类页面
    public function purchase_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();         //获取粉丝管理平台的组织id
        $search_data = [];
        $where = [
            'retail_id' => $admin_data['organization_id'],
            'fansmanage_id' => $fansmanage_id,
        ];
        $list = RetailPurchaseOrder::getPaginage($where,$search_data,'1','created_at','DESC'); //订单信息
        dump($admin_data['organization_id']);
        dump($fansmanage_id);
        return view('Retail/Billing/purchase_goods',['list'=>$list,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //添加商品分类操作
    public function category_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $category_name = $request->get('category_name');    //栏目名称
        $category_sort = $request->get('category_sort');    //栏目排序
        if (empty($category_sort)){
            $category_sort = '0';
        }
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $category_data = [
            'name' => $category_name,
            'created_by' => $admin_data['id'],
            'displayorder' => $category_sort,
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $admin_data['organization_id'],
        ];
        DB::beginTransaction();
        try {
            RetailCategory::addCategory($category_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员添加零售店铺分类的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在零售管理系统添加了栏目分类！');//保存操作记录
            }else{//零售店铺本人操作记录
                OperationLog::addOperationLog('10',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了栏目分类！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加分类失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加分类信息成功', 'status' => '1']);
    }
}

?>