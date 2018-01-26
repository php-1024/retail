<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title>选择服务商 | 零壹服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/bootstrap-reset.css" type="text/css"/>
    <!--external css-->
    <link rel="stylesheet" href="{{asset('public/Company/library/font-awesome')}}/css/font-awesome.css"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Company/library/jquery-easy-pie-chart')}}/jquery.easy-pie-chart.css"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/style-responsive.css" type="text/css"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Company/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<section class="">
    <div class="row state-overview" style="margin: 10px;">
        <div class="col-lg-12 col-sm-6">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li>
                    <h3 style="margin-top: 10px;"><i class="icon-desktop"></i> 选择要进入的商户组织</h3>
                </li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row state-overview" style="margin: 10px;">
        <div class="form-group">
            <div class="col-lg-12">
                <div class="input-group m-bot15 col-lg-3 "><span class="input-group-addon"><i
                                class="icon-search"></i></span>
                    <input type="text" class="form-control " placeholder="服务商名称">
                </div>
                <div class="input-group m-bot15 col-lg-2 ">
                    <button type="button" class="btn btn-primary"><i class="icon-search"></i> 查询</button>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <!--state overview start-->
    <div class="row state-overview" style="margin: 10px;">
        @foreach($organization as $key=>$val)
        <div class="col-lg-3 col-sm-6">
            <a href="index.html">
                <section class="panel">
                    <div class="symbol terques"><i class="icon-arrow-right"></i></div>
                    <div class="value"><b>{{ $val->organization_name }}</b>
                        <p>东北战区</p>
                    </div>
                </section>
            </a>
        </div>
        @endforeach

    </div>
    <!--state overview end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Company')}}/js/jquery.js"></script>
<script src="{{asset('public/Company')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Company')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Company')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Company')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{asset('public/Company')}}/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="{{asset('public/Company/library/jquery-easy-pie-chart')}}/jquery.easy-pie-chart.js"></script>
<script src="{{asset('public/Company')}}/js/owl.carousel.js"></script>
<script src="{{asset('public/Company')}}/js/jquery.customSelect.min.js"></script>

<!--common script for all pages-->
<script src="{{asset('public/Company')}}/js/common-scripts.js"></script>

<!--script for this page-->
<script src="{{asset('public/Company')}}/js/sparkline-chart.js"></script>
<script src="{{asset('public/Company')}}/js/easy-pie-chart.js"></script>
<script>

    //owl carousel

    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true

        });
    });

    //custom select box

    $(function () {
        $('select.styled').customSelect();
    });

</script>
</body>
</html>
