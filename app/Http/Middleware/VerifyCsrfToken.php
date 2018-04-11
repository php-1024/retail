<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'api/wechat/response/*',
        'api/wechat/open',

        /****Android接口****/
        'api/androidapi/login',//登入
        'retail/subordinate/login_test',//登入
        'api/androidapi/goodscategory',//商品分类
        'api/androidapi/goodslist',//商品列表
        'api/androidapi/order_check',//订单提交接口
        'api/androidapi/cancel_order',//取消订单接口
        'api/androidapi/order_list',//订单列表接口
        'api/androidapi/order_detail',//订单详情接口
        'api/androidapi/cash_payment',//现金支付接口
        'api/androidapi/other_payment',//其他支付接口
        'api/androidapi/allow_zero_stock',//开启/关闭零库存开单接口
        'api/androidapi/change_stock_role',//下单减库存/付款减库存接口
        'api/androidapi/stock_cfg',//查询店铺设置
        /****Android接口****/

    ];
}
