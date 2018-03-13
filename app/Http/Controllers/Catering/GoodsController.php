<?php
namespace App\Http\Controllers\Catering;
use App\Http\Controllers\Controller;
use App\Models\CateringCategory;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;
class GoodsController extends Controller{
    //商品分类查询
    public function goods_category(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $branch_id = $request->branch_id;//分店id
        if(!empty($branch_id)){
            $branch_id = $branch_id;
        }else{
            $branch_id = $admin_data['organization_id'];
        }
        $category_name = $request->category_name;//分类名称

        $search_data = ['category_name'=>$category_name,'branch_id'=>$branch_id];

        $list = CateringCategory::getPaginage([['store_id',$branch_id]],$category_name,'15','id');//获取所有分店分类

        $listBranch = Organization::getList([['parent_id',$admin_data['organization_id']]]);
        return view('Catering/Goods/goods_category',['search_data'=>$search_data,'listBranch'=>$listBranch,'list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商品查询
    public function goods_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Goods/goods_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商品查看详情
    public function goods_detail(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Goods/goods_detail',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>