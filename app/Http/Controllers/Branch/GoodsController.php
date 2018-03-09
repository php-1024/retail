<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\CateringCategory;
use App\Models\CateringGoods;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Session;

class GoodsController extends Controller
{
    //添加商品
    public function goods_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $where = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
        ];
        $category = CateringCategory::getList($where, '0', 'displayorder', 'DESC');
        return view('Branch/Goods/goods_add', ['category' => $category, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    //添加商品数据操作
    public function goods_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由

        $category_id = $request->get('category_id');        //栏目ID
        $name = $request->get('name');                      //商品名称
        $price = $request->get('price');                    //商品价格
        $stock = $request->get('stock');                    //商品库存
        $displayorder = $request->get('displayorder');      //商品排序
        $details = $request->get('details');                //商品详情
        if ($category_id == 0) {
            return response()->json(['data' => '请选择分类！', 'status' => '0']);
        }
        $goods_data = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
            'created_by' => $admin_data['id'],
            'category_id' => $category_id,
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'displayorder' => $displayorder,
            'details' => $details,
        ];
        DB::beginTransaction();
        try {
            $goods_id = CateringGoods::addCateringGoods($goods_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统添加了栏目分类！');//保存操作记录
            } else {//商户本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加了栏目分类！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加分类失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加分类信息成功', 'status' => '1', 'goods_id' => $goods_id]);
    }


    //编辑商品
    public function goods_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $goods_id = $request->get('goods_id');              //获取当前的页面路由
        $where = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
        ];
        $goods = CateringGoods::getOne(['id' => $goods_id, 'program_id' => '5', 'organization_id' => $admin_data['organization_id']]);
        $category = CateringCategory::getList($where, '0', 'displayorder', 'DESC');
        return view('Branch/Goods/goods_edit', ['category' => $category, 'goods' => $goods, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    public function upload_thumb_check(Request $request)
    {

//        Storage::put('avatars/1', $fileContents);
        $path = $request->file('avatar')->store('avatars');

        return $path;
    }

    //商品列表
    public function goods_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $where = [
            'program_id' => '5',
            'organization_id' => $admin_data['organization_id'],
        ];
        $goods = CateringGoods::getPaginage($where, '10', 'displayorder', 'DESC');
        return view('Branch/Goods/goods_list', ['goods' => $goods, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    //拷贝其他分店商品
    public function goods_copy(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Branch/Goods/goods_copy', ['admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }
}

?>