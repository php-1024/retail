<html>
<head>

</head>
<body>

<h1>测试</h1>


<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>


    wechatInit("{{$item["appId"]}}","{{$item["timestamp"]}}","{{$item["nonceStr"]}}","{{$item["signature"]}}")


    function wechatInit($appid,$timestamp,$nonceStr,$signature){
        wx.config({
            debug: false,
            appId: $appid,
            timestamp: $timestamp,
            nonceStr: $nonceStr,
            signature: $signature,
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'chooseImage',
                'uploadImage',
                'onMenuShareTimeline',
                'hideOptionMenu',
                'showMenuItems',
                'onMenuShareAppMessage',
                'startRecord',
                'stopRecord',
                'onVoiceRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'onVoicePlayEnd',
                'uploadVoice',
                'downloadVoice',
                'translateVoice',
            ]
        });


    }
    wx.ready(function(){
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度

                console.log(latitude);
                console.log(longitude);
                console.log(speed);
                console.log(accuracy);
            }
        });
    });


</script>
</body>
</html>