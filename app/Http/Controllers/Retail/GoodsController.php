<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Retail;

use App\Http\Controllers\Controller;
use App\Models\CateringCategory;
use App\Models\CateringGoods;
use App\Models\CateringGoodsThumb;
use App\Models\OperationLog;
use App\Models\CateringSpec;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'restaurant_id' => $admin_data['organization_id'],
        ];
        $category = CateringCategory::getList($where, '0', 'displayorder', 'DESC');
        return view('Retail/Goods/goods_add', ['category' => $category, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
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
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $goods_data = [
            'fansmanage_id' => $fansmanage_id,
            'restaurant_id' => $admin_data['organization_id'],
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
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统添加了商品！');//保存操作记录
            } else {//商户本人操作记录
                OperationLog::addOperationLog('10', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加了商品！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加商品失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加商品成功', 'status' => '1', 'goods_id' => $goods_id]);
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
            'restaurant_id' => $admin_data['organization_id'],
        ];
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $goods_thumb = CateringGoodsThumb::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        $goods = CateringGoods::getOne(['id' => $goods_id, 'fansmanage_id' => $fansmanage_id, 'restaurant_id' => $admin_data['organization_id']]);
        $category = CateringCategory::getList($where, '0', 'displayorder', 'DESC');
        $spec = CateringSpec::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        return view('Retail/Goods/goods_edit', ['goods_thumb'=>$goods_thumb,'category' => $category, 'goods' => $goods, 'spec'=>$spec,'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    //编辑商品操作
    public function goods_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $goods_id = $request->get('goods_id');              //商品ID
        $category_id = $request->get('category_id');        //栏目ID
        $name = $request->get('name');                      //商品名称
        $price = $request->get('price');                    //商品价格
        $stock = $request->get('stock');                    //商品库存
        $displayorder = $request->get('displayorder');      //商品排序
        $details = $request->get('details');                //商品详情
        $fansmanage_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        if ($category_id == 0) {
            return response()->json(['data' => '请选择分类！', 'status' => '0']);
        }
        $where = [
            'id' => $goods_id,
        ];
        $goods_data = [
            'fansmanage_id' => $fansmanage_id,
            'restaurant_id' => $admin_data['organization_id'],
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
            $goods_id = CateringGoods::editCateringGoods($where,$goods_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统编辑了商品！');//保存操作记录
            } else {//商户本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '编辑了商品！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑商品失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '编辑商品信息成功', 'status' => '1', 'goods_id' => $goods_id]);
    }


    //图片异步加载部分
    public function goods_thumb(Request $request)
    {
        $goods_id = $request->get('goods_id');              //商品的ID
        $goods_thumb = CateringGoodsThumb::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        return view('Retail/Goods/goods_thumb', ['goods_thumb'=>$goods_thumb]);
    }


    //上传图片处理
    public function upload_thumb_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $goods_id = $request->get('goods_id');
        $file = $request->file('upload_thumb');
        if ($file->isValid()) {
            //检验文件是否有效
            $entension = $file->getClientOriginalExtension(); //获取上传文件后缀名
            $new_name = date('Ymdhis') . mt_rand(100, 999) . '.' . $entension;  //重命名
            $path = $file->move(base_path() . '/uploads/catering/', $new_name);   //$path上传后的文件路径
            $file_path =  'uploads/catering/'.$new_name;
            $goods_thumb = [
                'goods_id' => $goods_id,
                'thumb' => $file_path,
            ];
            DB::beginTransaction();
            try {
                CateringGoodsThumb::addGoodsThumb($goods_thumb);
                //添加操作日志
                if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                    OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统上传了商品图片！');//保存操作记录
                } else {//分店本人操作记录
                    OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '上传了商品图片！');//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '上传商品图片失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '上传商品图片信息成功','file_path' => $file_path, 'status' => '1']);

        } else {
            return response()->json(['status' => '0']);
        }
    }



    //商品列表
    public function goods_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $where = [
            'restaurant_id' => $admin_data['organization_id'],
        ];
        $goods = CateringGoods::getPaginage($where, '10', 'displayorder', 'DESC');
        return view('Retail/Goods/goods_list', ['goods' => $goods, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }


    //删除商品弹窗
    public function goods_delete(Request $request)
    {
        $goods_id = $request->get('id');              //分类栏目的id
        return view('Retail/Goods/goods_delete',['goods_id'=>$goods_id]);
    }

    //删除商品操作
    public function goods_delete_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $goods_id = $request->get('goods_id');        //获取分类栏目ID
        DB::beginTransaction();
        try {
            CateringGoods::select_delete($goods_id);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在零售店铺管理系统删除了商品！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('10', $admin_data['organization_id'], $admin_data['id'], $route_name, '删除商品！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除商品失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除商品成功', 'status' => '1']);
    }
}

?>