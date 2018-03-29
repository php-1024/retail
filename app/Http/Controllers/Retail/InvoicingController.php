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
            return response()->json(['data' => '选择商户成功！', 'status' => '1']);
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
}

?>