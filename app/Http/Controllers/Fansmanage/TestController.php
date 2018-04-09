<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 15:41
 */

namespace App\Http\Controllers\Fansmanage;


use App\Http\Controllers\Controller;
use App\Models\FansmanageUser;
use App\Models\Label;

class TestController extends Controller
{
    public function test()
    {
        // 获取粉丝列表
        $list = FansmanageUser::getPaginage([['fansmanage_id', 5]], '', '10', 'id');

        $list = $list->toArray();
        dd($list["data"][0]["user_origin"]);
    }
}