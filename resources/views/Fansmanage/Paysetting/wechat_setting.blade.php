<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>零壹云管理平台 | 总店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/js/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/app.css" type="text/css"/>
    <link href="{{asset('public/Fansmanage/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Fansmanage')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Fansmanage')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Fansmanage')}}/js/ie/excanvas.js"></script>
    <![endif]-->

    <style>
        .sub-well {
            margin-left: 12px;
        }
    </style>
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Fansmanage/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Fansmanage/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">微信支付设置</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                微信支付设置
                            </header>
                            <div class="row wrapper">

                                <div class="well">
                                    <h3>温馨提示</h3>
                                    <p class="text-danger">1. 你必须向微信公众平台提交企业信息以及银行账户资料，审核通过并签约后才能使用微信支付功能</p>
                                    <p class="text-danger">
                                        2. 零壹支持微信支付接口，注意你的零壹访问地址一定不要写错了，这里我们用访问地址代替下面说明中出现的链接，申请微信支付的接口说明如下：</p>

                                    <p class="text-danger sub-well">JS API网页支付参数</p>
                                    <p class="text-danger sub-well">支付授权目录: https://o2o.01nnt.com/wechat/</p>
                                    <p class="text-danger sub-well">支付请求实例: https://o2o.01nnt.com/wechat/pay.php/</p>
                                    <p class="text-danger sub-well">共享收货地址: 选择"是"</p>
                                    <p class="text-danger">3. 注意要把微信网页授权的地址设置为: o2o.01nnt.com</p>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <form class="form-horizontal" method="get">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">微信支付</label>
                                        <div class="col-sm-8">

                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                                           value="option1" checked>打开
                                                </label>


                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                                           value="option1">关闭
                                                </label>
                                            </div>



                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">商户号(MchId)</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">Api密钥(paySignKey)</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">商户支付证书(apiclient_cert.pem)</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="input-id-1" name="apiclient_cert"
                                                      placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入" rows="6"></textarea>
                                            <p class="help-block">从商户平台上下载支付证书, 解压并取得其中的 apiclient_cert.pem
                                                用记事本打开并复制文件内容, 填入以上文本框内</p>
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"
                                               for="input-id-1">支付证书私钥(apiclient_key.pem)</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="input-id-1" name="apiclient_key"
                                                      placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入" rows="6"></textarea>
                                            <p class="help-block">从商户平台上下载支付证书, 解压并取得其中的 apiclient_key.pem
                                                用记事本打开并复制文件内容, 填入以上文本框内</p>
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" class="btn btn-success" id="addBtn">保存资料</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                </form>
                            </div>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

<script src="{{asset('public/Fansmanage')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Fansmanage')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Fansmanage')}}/js/app.js"></script>
<script src="{{asset('public/Fansmanage')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Fansmanage')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Fansmanage')}}/js/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/demo.js"></script>
<script src="{{asset('public/Fansmanage/sweetalert')}}/sweetalert.min.js"></script>

<script type="text/javascript">
    //弹出文本输入框
    function getEditTextForm() {
        var url = $('#default_reply_text_edit_url').val();
        var token = $('#_token').val();
        var data = {'_token': token};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>
</body>
</html>
























