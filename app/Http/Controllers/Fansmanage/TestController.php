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
        $list = Label::ListLabel(['fansmanage_id' => 5]);
        dd($list);
    }
}