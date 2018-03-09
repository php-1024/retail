<?php
/**
 *餐饮分店管理系统
 * 栏目管理
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\OrganizationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CategoryController extends Controller
{
    //添加商品分类
    public function category_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Branch/Category/category_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //添加商品分类提交检测
    public function category_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $category_name = $request->get('category_name');    //栏目名称
        $category_sort = $request->get('category_sort');    //栏目排序
        if (empty($category_sort)){
            $category_sort = '0';
        }
        $category_data = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
            'created_by' => $admin_data['id'],
            'category_name' => $category_name,
            'category_sort' => $category_sort,
        ];
        DB::beginTransaction();
        try {
            OrganizationCategory::addCategory($category_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在餐饮分店管理系统添加了栏目分类！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了栏目分类！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加分类失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加分类信息成功', 'status' => '1']);
    }

    //商品分类列表
    public function category_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $where = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
        ];
        $category = OrganizationCategory::getPaginage($where,'10','category_sort','DESC');
        dump($category);
        return view('Branch/Category/category_list',['category'=>$category,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}

?>