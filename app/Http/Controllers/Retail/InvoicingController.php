<?php
/**
 * 零售版店铺
 * 进销存管理-进出开单
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
use App\Models\RetailPurchaseOrder;
use App\Models\RetailSupplier;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicingController extends Controller
{
    //零售进销存开单--供应商到货开单
    public function purchase_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id');    //获取粉丝管理平台的组织id
        $where = [
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $admin_data['organization_id'],
        ];
        $category = RetailCategory::getList($where, '0', 'displayorder', 'DESC');   //栏目
        return  view('Retail/Invoicing/purchase_goods',['category'=>$category,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //零售进销存开单--供应商搜索
    public function search_company(Request $request)
    {
        $company_id = $request->get('company_id');      //供应商ID
        $company_name = $request->get('company_name');      //供应商ID
        $contactmobile = $request->get('contactmobile');      //供应商ID
        $company = RetailSupplier::SearchCompany($company_id,$company_name,$contactmobile);
        if ($company == null){
            return response()->json(['data' => '商户不存在！请重新选择！', 'status' => '0']);
        }else{
            return view('Retail/Invoicing/select_company',['company'=>$company]);
        }
    }




    //零售进销存开单--退供应商货物开单
    public function return_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return  view('Retail/Invoicing/return_goods',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //零售进销存开单--报损开单
    public function loss_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return  view('Retail/Invoicing/loss_goods',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }


    //零售进销存开单--盘点开单
    public function check_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return  view('Retail/Invoicing/check_goods',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //零售进销存开单--商品列表
    public function goods_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $category_id = $request->get('category_id');    //栏目分类id
        $goods_name = $request->get('goods_name');      //商品名称
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id');    //获取粉丝管理平台的组织id
        if (!empty($category_id)){
            $goods = RetailGoods::getList(['retail_id'=>$admin_data['organization_id'],'fansmanage_id'=>$fansmanage_id,'category_id'=>$category_id],'0','id','DESC');
        }elseif (!empty($goods_name)){
            $goods = RetailGoods::getList(['retail_id'=>$admin_data['organization_id'],'fansmanage_id'=>$fansmanage_id,'name'=>$goods_name],'0','id','DESC');
        }else{
            $goods = RetailGoods::getList(['retail_id'=>$admin_data['organization_id'],'fansmanage_id'=>$fansmanage_id],'0','id','DESC');
        }
        return  view('Retail/Invoicing/goods_list',['goods'=>$goods]);
    }

    public function purchase_goods_check(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $ordersn = date('YmdHis').rand(1000,9999);        //生成订单编号
        $orders = $request->get('orders');                  //接收订单信息
        //进货开单订单信息整理
        $order_data = [
            'ordersn' => $ordersn,
            'order_price' => $orders['order_price'],
            'remarks' => '',
            'company_id' => $orders['company_id'],
            'operator_id' => $orders['operator_id'],
            'order_type' => '1',  //1：为进货订单、2为退货订单
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $admin_data['organization_id'],
        ];
        DB::beginTransaction();
        try {
            RetailPurchaseOrder::addOrder($order_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员在零售店进货开单的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在零售管理系统进行了进货开单！');//保存操作记录
            }else{//零售店铺本人操作记录
                OperationLog::addOperationLog('10',$admin_data['organization_id'],$admin_data['id'],$route_name, '进行了进货开单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '进货开单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '进货开单成功', 'status' => '1']);
    }
}

?>