<html>
<head>

</head>
<body>

<h1>测试</h1>


<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>


    wechatInit({{$item["appId"]}},{{$item["timestamp"]}},{{$item["nonceStr"]}},{{$item["signature"]}})


    function wechatInit($appid,$timestamp,$nonceStr,$signature){
        wx.config({
            debug: true,
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
</script>
</body>
</html>