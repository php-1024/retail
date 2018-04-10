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
use App\Models\UserLabel;

class TestController extends Controller
{
    public function test()
    {
        // 获取粉丝列表
        $list = FansmanageUser::getPaginage([['fansmanage_id', 5]], '', '10', 'id');
        dump($list);
        dump($list[0]["userOrigin"]["id"]);
        dd($list[0]["userLabel"]['label_id']);

        $label = Label::ListLabel([['fansmanage_id', 5], ['store_id', '0']]);

        dump($label);

        $res = UserLabel::getPluck([['user_id', 1], ['organization_id', 5]], 'label_id')->first();
        var_dump($res);
    }
}