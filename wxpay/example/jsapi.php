<?php
ini_set('date.timezone', 'Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach ($data as $key => $value) {
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

$domain_url = "http://develop.01nnt.com/wxpay";


//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();


//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("test");
$input->SetAttach("test");
$input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
$input->SetTotal_fee("1");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url("{$domain_url}/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);


$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';


var_dump($order);


$jsApiParameters = $tools->GetJsApiParameters($order);

var_dump($jsApiParameters);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();


$a_k = "9_aeWuKiTlzBxR21jNsPhB3JnaxLZ4IzxaLwIGZgF3xElEjiFRRhioVoYKxYd2okiD4ywJymzuNBLyP9KO-HB80QaTgm1WAU5_ICINbqNL1mbMrSOtvxGZkcJAQOmPIspTW2QcXXOovnhJy059IEUeAHAPLB";

$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$a_k}&type=jsapi";
$res = file_get_contents($url);
$res = json_decode($res, true);
$ticket = $res["ticket"];


var_dump($ticket);

// 设置得到签名的参数
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
var_dump($url);

$timestamp = time();
$nonceStr = substr(md5(time()), 0, 16);
// 这里参数的顺序要按照 key 值 ASCII 码升序排序
$string = "jsapi_ticket={$ticket}&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
$signature = sha1($string);
$signPackage = array("appId" => "wx3fb8f4754008e524", "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "rawString" => $string, "signature" => $signature);


//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>微信支付样例-支付</title>


    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script>
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo $signPackage["appId"]; ?>', // 必填，公众号的唯一标识
            timestamp: '<?php echo $signPackage["timestamp"]; ?>', // 必填，生成签名的时间戳
            nonceStr: '<?php echo $signPackage["nonceStr"]; ?>', // 必填，生成签名的随机串
            signature: '<?php echo $signPackage["signature"]; ?>',// 必填，签名
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'openAddress',
                'chooseWXPay',
            ] // 必填，需要使用的JS接口列表
        });

        wx.ready(function () {
            wx.openAddress({
                success: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        })
    </script>

    <script type="text/javascript">
        //    //调用微信JS api 支付
        //    function jsApiCall() {
        //        WeixinJSBridge.invoke(
        //            'getBrandWCPayRequest',
        //            <?php //echo $jsApiParameters; ?>//,
        //            function (res) {
        //                console.log(res);
        //                WeixinJSBridge.log(res.err_msg);
        //                // console.log(res.err_code+res.err_desc+res.err_msg);
        //            }
        //        );
        //    }
        //
        //    function callpay() {
        //        if (typeof WeixinJSBridge == "undefined") {
        //            if (document.addEventListener) {
        //                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
        //            } else if (document.attachEvent) {
        //                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
        //                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
        //            }
        //        } else {
        //            jsApiCall();
        //        }
        //    }
        //</script>
    //
    <script type="text/javascript">
        //    //获取共享地址
        //    function editAddress() {
        //        WeixinJSBridge.invoke(
        //            'openAddress',
        //            <?php //echo $editAddress; ?>//,
        //            function (res) {
        //                console.log(res);
        //                // var value1 = res.proviceFirstStageName;
        //                // var value2 = res.addressCitySecondStageName;
        //                // var value3 = res.addressCountiesThirdStageName;
        //                // var value4 = res.addressDetailInfo;
        //                // var tel = res.telNumber;
        //                //
        //                // console.log(value1 + value2 + value3 + value4 + ":" + tel);
        //            }
        //        );
        //    }
        //    editAddress();
        // window.onload = function () {
        //     if (typeof WeixinJSBridge == "undefined") {
        //         if (document.addEventListener) {
        //             document.addEventListener('WeixinJSBridgeReady', editAddress, false);
        //         } else if (document.attachEvent) {
        //             document.attachEvent('WeixinJSBridgeReady', editAddress);
        //             document.attachEvent('onWeixinJSBridgeReady', editAddress);
        //         }
        //     } else {
        //         editAddress();
        //     }
        // };
        function callpay() {

            wx.ready(function () { // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
                wx.chooseWXPay({
                    appId: '<?php echo $order["appid"]; ?>',
                    timestamp: '<?php echo time(); ?>', // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
                    nonceStr: '<?php echo $order["nonce_str"]; ?>', // 支付签名随机串，不长于 32 位
                    package: 'prepay_id=<?php echo $order["prepay_id"]; ?>', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
                    signType: 'MD5', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
                    paySign: '<?php echo $order["sign"]; ?>', // 支付签名
                    success: function (res) {
                        // 支付成功后的回调函数
                        if (res.errMsg == "chooseWXPay:ok") {
                            //支付成功
                            alert('支付成功');
                        } else {
                            alert(res.errMsg);
                        }
                    },
                    cancel: function (res) {
                        //支付取消
                        alert('支付取消');
                    }
                });
            });
        }
    </script>
</head>
<body>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
<div align="center">
    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;"
            type="button" onclick="callpay()">立即支付
    </button>
</div>
</body>
</html>