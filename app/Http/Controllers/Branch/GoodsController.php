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
use App\Models\CateringSpec;
use App\Models\CateringSpecItem;
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
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统添加了商品！');//保存操作记录
            } else {//商户本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加了商品！');//保存操作记录
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
        $spec = CateringSpec::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        return view('Branch/Goods/goods_edit', ['category' => $category, 'goods' => $goods, 'spec'=>$spec,'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
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
        if ($category_id == 0) {
            return response()->json(['data' => '请选择分类！', 'status' => '0']);
        }
        $where = [
            'id' => $goods_id,
        ];
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
            $goods_id = CateringGoods::editCateringGoods($where,$goods_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统编辑了商品！');//保存操作记录
            } else {//商户本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '编辑了商品！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑商品失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '编辑商品信息成功', 'status' => '1', 'goods_id' => $goods_id]);
    }




    //规格类添加
    public function spec_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $spec_name = $request->get('spec_name');            //获取规格类名称
        $goods_id = $request->get('goods_id');              //获取商品ID
        if (empty($spec_name)){
            return response()->json(['data' => '请输入规格类名称！', 'status' => '0']);
        }
        $spec_data = [
            'name' => $spec_name,
            'goods_id' => $goods_id,
        ];
        DB::beginTransaction();
        try {
            $spec_id = CateringSpec::addCateringSpec($spec_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统添加了商品规格！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加商品规格！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加规格类失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加规格类信息成功', 'status' => '1', 'spec_id' => $spec_id]);
    }

    //子规格添加
    public function spec_item_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $spec_item_name = $request->get('spec_item_name');  //获取子规格类名称
        $spec_id = $request->get('spec_id');                //获取商品ID
        if (empty($spec_item_name)){
            return response()->json(['data' => '请输入子规格类名称！', 'status' => '0']);
        }
        $spec_item_data = [
            'name' => $spec_item_name,
            'spec_id' => $spec_id,
        ];
        DB::beginTransaction();
        try {
            $spec_id = CateringSpecItem::addSpecItem($spec_item_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统添加了商品子规格！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加了商品子规格！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加子规格失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加子规格信息成功', 'status' => '1', 'spec_id' => $spec_id]);

    }



    //规格异步加载部分
    public function goods_spec(Request $request)
    {
        $goods_id = $request->get('goods_id');              //商品的ID
        $spec = CateringSpec::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        return view('Branch/Goods/goods_spec', ['spec'=>$spec]);
    }




    //编辑规格类弹窗
    public function spec_edit(Request $request)
    {
        $spec_id = $request->get('spec_id');              //商品的ID
        $spec = CateringSpec::getOne([['id',$spec_id]]);
        return view('Branch/Goods/goods_spec_edit', ['spec'=>$spec,'spec_id'=>$spec_id]);
    }
    //编辑规格类操作方法
    public function spec_edit_check(Request $request)
    {
        $spec_id = $request->get('spec_id');              //规格类ID
        $spec_name = $request->get('spec_name');          //规格类名称
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        DB::beginTransaction();
        try {
            $spec_id = CateringSpec::editCateringSpec([['id',$spec_id]],['name'=>$spec_name]);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统修改了商品规格！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了商品规格！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑规格失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '编辑规格信息成功', 'status' => '1', 'spec_id' => $spec_id]);
    }

    //编辑子规格操作方法
    public function spec_item_edit_check(Request $request)
    {
        $spec_item_id = $request->get('spec_item_id');              //子规格id
        $spec_item_name = $request->get('spec_item_name');              //子规格id
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        DB::beginTransaction();
        try {
            $spec_id = CateringSpecItem::editSpecItem([['id',$spec_item_id]],['name'=>$spec_item_name]);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统修改了商品子规格！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了商品子规格！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑子规格失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '编辑子规格信息成功', 'status' => '1', 'spec_id' => $spec_id]);
    }

    //删除规格类操作方法
    public function spec_delete_check(Request $request)
    {
        $spec_id = $request->get('spec_id');              //规格类ID
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $list = CateringSpec::getList(['spec_id'=>$spec_id],0,'id','DESC');
        dd($list);
        DB::beginTransaction();
        try {
            CateringSpec::deleteCateringSpec($spec_id);
            $list = CateringSpec::getList(['spec_id'=>$spec_id],0,'id','DESC');
            dd($list);
            foreach ($list as $key=>$val){
                CateringSpecItem::deleteCateringSpecItem($spec_id);
            }
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在餐饮分店管理系统删除了商品规格！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('5', $admin_data['organization_id'], $admin_data['id'], $route_name, '删除了商品规格！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除规格失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除规格信息成功', 'status' => '1']);
    }


    //删除规格类弹窗
    public function spec_delete(Request $request)
    {
        $spec_id = $request->get('spec_id');              //规格类ID
        $spec = CateringSpec::getOne(['id'=>$spec_id]);
        return view('Branch/Goods/goods_spec_delete', ['spec'=>$spec]);
    }

    //编辑子规格弹窗
    public function spec_item_edit(Request $request)
    {
        $spec_item_id = $request->get('spec_item_id');              //子规格id
        $spec_item = CateringSpecItem::getOne(['id'=>$spec_item_id]);
        return view('Branch/Goods/goods_spec_item_edit', ['spec_item'=>$spec_item]);
    }

    //删除子规格弹窗
    public function spec_stem_delete(Request $request)
    {
        $goods_id = $request->get('goods_id');              //商品的ID
        $spec = CateringSpec::getList(['goods_id'=>$goods_id],0,'created_at','DESC');
        return view('Branch/Goods/delete_spec_stem', ['spec'=>$spec]);
    }


    //添加子规格弹窗
    public function spec_item_add(Request $request)
    {
        $spec_id = $request->input('spec_id');
        $goods_id = $request->input('goods_id');
        return view('Branch/Goods/goods_spec_comfirm',['spec_id'=>$spec_id,'goods_id'=>$goods_id]);
    }






    //上传图片处理
    public function upload_thumb_check(Request $request)
    {

//        Storage::put('avatars/1', $fileContents);
        $path = $request->file('upload_thumb');

        dd($path);
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