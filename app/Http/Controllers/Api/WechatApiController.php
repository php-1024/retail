<?php
/**
 * Wechat接口
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\SimpleCategory;
use App\Models\SimpleGoods;
use App\Models\SimpleGoodsThumb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class WechatApiController extends Controller

{
    /**
     * 店铺列表
     */
    public function store_list(Request $request)
    {
        // 商户id
        $fansmannage_id = $request->organization_id;
        // 纬度
        $lat = $request->lat;
        // 经度
        $lng = $request->lng;
        // 查询条件
        $where[] = ['parent_id', $fansmannage_id];
        // 前端页面搜索
        $keyword = $request->keyword;
        // 是否存在搜索条件
        if ($keyword) {
            $where[] = ['name', 'LIKE', "%{$keyword}%"];
        }
        // 查询店铺信息
        $data = Organization::getListSimple($where)->toArray();
        // 是否存在店铺
        if (empty($data)) {
            return response()->json(['msg' => '查无店铺', 'status' => '0', 'data' => '']);
        }
        foreach ($data as $key => $value) {
            // 计算距离
            $data[$key]['distance'] = $this->GetDistance($lat, $lng, $value['lat'], $value['lng']);
        }
        // 冒泡距离排序
        $data = $this->order($data);
        foreach ($data as $k => $v) {
            unset($data[$k]['lat']);
            unset($data[$k]['lng']);
        }
        // 数据返回
        $data = ['status' => '1', 'msg' => '数据获取成功', 'data' => ['storelist' => $data]];

        return response()->json($data);
    }

    //organization_id=2&lat=22.724083&lng=114.260654

    /**
     * 分类接口列表
     */
    public function category(Request $request)
    {
        Session::put('fansmanage_id', 2);
        // 商户id
        $fansmanage_id = Session::get('fansmanage_id');
        // 店铺id
        $retail_id = $request->retail_id;
        // 分类列表
        $category = SimpleCategory::getList([['fansmanage_id', $fansmanage_id], ['simple_id', $retail_id]], 0, 'id', 'DESC', ['id', 'name', 'displayorder']);

        // 数据返回
        $data = ['status' => '1', 'msg' => '数据获取成功', 'data' => ['categorylist' => $category]];

        return response()->json($data);
    }

    /**
     * 商品列表接口
     */
    public function goods_list(Request $request)
    {
        Session::put('fansmanage_id', 2);
        // 商户id
        $fansmanage_id = Session::get('fansmanage_id');
        // 店铺id
        $retail_id = $request->retail_id;
        // 关键字
        $keyword = $request->keyword;
        // 条码
        $scan_code = $request->scan_code;
        $where = [['fansmanage_id', $fansmanage_id],['simple_id', $retail_id], ['status', '1']];
        if ($keyword) {
            $where[] = ['name', 'LIKE', '%' . $keyword . '%'];
        }
        if ($scan_code) {
            $where[] = ['barcode', $scan_code];
        }
        $goodslist = SimpleGoods::getList($where, '0', 'displayorder', 'asc', ['id', 'name', 'category_id', 'details', 'price', 'stock']);
        if (empty($goodslist->toArray())) {
            return response()->json(['status' => '0', 'msg' => '没有商品', 'data' => '']);
        }
        foreach ($goodslist as $key => $value) {
            $goodslist[$key]['category_name'] = SimpleCategory::getPluck([['id', $value['category_id']]], 'name');
            $goodslist[$key]['thumb'] = SimpleGoodsThumb::where([['goods_id', $value['id']]])->select('thumb')->get();
        }
        $data = ['status' => '1', 'msg' => '获取商品成功', 'data' => ['goodslist' => $goodslist]];
        return response()->json($data);
    }

    /**
     * 购物车添加商品
     */
    public function shopping_cart_add(Request $request)
    {
        Session::put('fansmanage_id', 2);
        // 用户店铺id
        $user_id = $request->user_id;
        // 用户零壹id
        $zerone_user_id = $request->zerone_user_id;
        // 联盟主id
        $fansmanage_id = Session::get('fansmanage_id');
        // 店铺id
        $store_id = $request->store_id;
        // 商品id
        $store_id = $request->goods_id;
        // 商品名称
        $goods_name = $request->goods_name;
        // 商品图片
        $goods_thumb = $request->goods_thumb;
        // 商品数量
        $num = $request->num;
        // 商品库存
        $stock = $request->stock;

//        $data = ['status' => '1', 'msg' => '获取商品成功', 'data' => ['goodslist' => $goodslist]];
        return response()->json($data);
    }


    /**
     *  计算两组经纬度坐标 之间的距离
     *   params ：lat1 纬度1； lng1 经度1； lat2 纬度2； lng2 经度2； len_type （1:m or 2:km);
     *   return m or km
     */
    private function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 2, $decimal = 2)
    {
        $PI = 3.1415926;
        $radLat1 = $lat1 * $PI / 180.0;   //PI圆周率
        $radLat2 = $lat2 * $PI / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($lng1 * $PI / 180.0) - ($lng2 * $PI / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * 6378.137;
        $s = round($s * 1000);
        if ($len_type-- > 1) {
            $s /= 1000;
        }
        return round($s, $decimal);
    }


    private function order($arr)
    {
        $len = count($arr);//6
        for ($k = 0; $k <= $len; $k++) {
            for ($j = $len - 1; $j > $k; $j--) {
                if ($arr[$j]['distance'] < $arr[$j - 1]['distance']) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j - 1];
                    $arr[$j - 1] = $temp;
                }
            }
        }
        return $arr;
    }


}