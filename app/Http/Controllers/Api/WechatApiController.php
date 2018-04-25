<?php
/**
 * Wechat接口
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\SimpleCategory;
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