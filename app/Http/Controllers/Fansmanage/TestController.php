<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 15:41
 */

namespace App\Http\Controllers\Fansmanage;


use App\Http\Controllers\Controller;
use App\Models\Label;

class TestController extends Controller
{
    public function test()
    {
        $list = Label::getPluck(['fansmanage_id' => 5],"label_name");
        if(!empty($list)) {
            $local_label = $list->toArray();
        }


        $data = [
            0 => [
                "id" => 2,
                "name" => "星标组",
                "count" => 1
            ],
            1 => [
                "id" => 100,
                "name" => "测试标签",
                "count" => 0
            ],
            2 => [
                "id" => 102,
                "name" => "广东粉丝",
                "count" => 1,
            ],
            3 => [
                "id" => 103,
                "name" => "深圳粉丝1",
                "count" => 0,
            ],
            4 => [
                "id" => 104,
                "name" => "广西粉丝1",
                "count" => 0,
            ]
        ];
        $a = array_column($data,"name");
        $b = array_diff($a,$local_label);

        foreach ($b as $key => $val){
            $re_tags_val = $data[$key];

            var_dump($re_tags_val);
        }

        dd($b);
    }
}