<?php
/**
 * Wechat接口
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
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
        foreach($data as $key=>$value){

            $ss = $this->GetDistance('22.724083','114.260654',$value['organization_simpleinfo']['lat'],$value['organization_simpleinfo']['lng']);
            echo $ss;exit;
        }

//        // 数据返回
//        $data = ['status' => '1', 'msg' => '登陆成功', 'data' => ['account_id' => $data['id']]];

//        return response()->json($data);
    }


    /**
     *  计算两组经纬度坐标 之间的距离
     *   params ：lat1 纬度1； lng1 经度1； lat2 纬度2； lng2 经度2； len_type （1:m or 2:km);
     *   return m or km
     */
    private function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2)
    {
        $PI = 3.1415926;
        $radLat1 = $lat1 * $PI / 180.0;   //PI圆周率
        $radLat2 = $lat2 * $PI / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($lng1 * $PI / 180.0) - ($lng2 * $PI / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * 6378.137;
        $s = round($s * 1000);
//        if ($len_type -- > 1) {
//            $s /= 1000;
//        }
        return round($s, $decimal);
    }

}