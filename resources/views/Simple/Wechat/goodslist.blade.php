<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Session::get('organization_name') }}</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="{{asset('public/Wechat')}}/css/public/light7.min.css">
    <link rel="stylesheet" href="{{asset('public/Wechat')}}/css/goodslist.css">
  </head>
  <body>
  	<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
  	<input type="hidden" name="fansmanage_id" id="fansmanage_id" value="{{$fansmanage_id}}">
  	<input type="hidden" name="store_id" id="store_id" value="{{$store_id}}">
  	<input type="hidden" name="shop_user_id" id="shop_user_id" value="{{session("zerone_auth_info.shop_user_id")}}">
  	<input type="hidden" name="zerone_user_id" id="zerone_user_id" value="{{session("zerone_auth_info.zerone_user_id")}}">
    <div class="page">
	    <div class="g-flexview">
			<div class="head">
				<div class="nav">
					<ul class="clear_after" id="goods_cs_lt">
					</ul>
				</div>
				<div class="nav_right" onclick="goodsclass('goodsclass')">
					<i class="nav_icon buy_drop_down action"></i>
					<i class="nav_icon nav_icon_into"></i>
				</div>
			</div>
			<div class="search">
			    <div class="search_item">
			    	<label class="icon_search" for="search"></label>
					<input type="search" id="search" name="" placeholder="七夕礼物 玫瑰">
					<label class="icon_scavenging"></label>
			    </div>
			</div>
			<div class="goodslist" id="goodslist">
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border action">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn action">
										<!-- <a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a> -->
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div class="gl_item">
					<div class="gl_item_fl">
						<div class="goods_img">
							<img src="">
						</div>
						<div class="goods_right">
							<div class="goods_right_item">
								<section class="gri_center">
									<h3 class="goods_tltie"><span>同城送花 向日葵百合混搭</span></h3>
								</section>
								<section class="gri_center">
									<p class="goods_details">9朵向日葵 阳光款</p>
								</section>
								<section class="gri_center">
									<p class="goods_distance">
										<span>距离</span>
										<span><</span>
										<span>920m</span>
										<span>|</span>
										<span>库存：</span>
										<span>10</span>
									</p>
								</section>
								<section class="gri_center gri_center_juzhong">
									<div class="goods_price">
										<span>&yen;158.00</span>
									</div>
									<div class="goods_btn cart_border">
										<a href="javascript:;" class="cart_box delect_cart_btn">-</a>
										<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>
										<a href="javascript:;" class="cart_box add_cart_btn">+</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	    <div class="cart_bottom">
	    	<div class="cart_fl">
				<div class="cart_left">
					<div class="cart_kuang clear_after" id="cart_btn_b" onclick="showcart('cart',this)">
						<div class="cart_kuang_img">
							<span class="goods_number" id="goods_total">0</span>
						</div>
					</div>
					<h3 class="cart_price" id="cart_price">您还未选购商品哦~</h3>
				</div>
				<div class="cart_right"><a href="javascript:;" onclick="show('alert')">去结算 <i></i></a></div>
	    	</div>
	    </div>
		<!-- alert -->
		<div class="popup_alert" id="alert">
			<div class="quhuo alert_width popup_alert_hook">
				<p class="quhuoinfo">确认清空购物车吗?</p>
				<div class="max_height_box">
					<!-- <p>我的取货信息我的取货信息我的取货信息</p> -->
				</div>
				<div class="alert_btn_wz">
					<a href="javascript:;" class="btn_alert my_text_align btn_alert_bg1" onclick="hide('alert')">取消</a>
					<a href="javascript:;" class="btn_alert my_text_align btn_alert_bg" onclick="hide('alert')">确认</a>
				</div>
			</div>
		</div>
		<!-- alert -->
		<!-- alert -->
		<div class="popup_alert quhuoinfo cart" id="cart">
			<div class="cart_box_h popup_alert_hook">
				<div class="sanjiaoxing_box">
					<div class="sanjiaoxing"></div>
					<div class="open_cart_kuang">
						<div class="cart_kuang clear_after" onclick="show('cart')">
							<div class="cart_kuang_img">
								<span class="goods_number" id="total"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="cart_top">
					<span>已选商品</span>
					<span onclick="show('alert')">清空</span>
				</div>
				<ul class="cart_list" id="cart_list">

				</ul>
			</div>
		</div>
		<!-- alert -->
		<!-- alert -->
		<div class="popup_alert quhuoinfo goodsclass" id="goodsclass">
			<div class="goodsclass_box_h popup_alert_hook">
				<ul class="clear_after" id="goods_cs_lt_alert">
				</ul>
			</div>
			<div class="goodsclass_close" onclick="hidegoodsclass('goodsclass')"></div>
		</div>
		<!-- alert -->
    </div>
    <script type='text/javascript' src="{{asset('public/Wechat')}}/js/public/jquery.min.js" charset='utf-8'></script>
    <script type='text/javascript' src="{{asset('public/Wechat')}}/js/public/light7.min.js" charset='utf-8'></script>
    <script type='text/javascript' src="{{asset('public/Wechat')}}/js/goodslist.js" charset='utf-8'></script>
    <script type="text/javascript">
        $(function(){
    var total_price = 0;//购物车总价格

    var fansmanage_id=$("#fansmanage_id").val();//联盟主组织ID
    var _token=$("#_token").val();
    var store_id=$("#store_id").val();//店铺ID
	//获取goods分类列表
    var class_url = "http://develop.01nnt.com/api/wechatApi/category";
    $.showPreloader();
    $.post(
    	class_url,
        {'fansmanage_id': fansmanage_id,'_token':_token,'store_id':store_id},
    	function(json){
    		if (json.status == 1) {
    			var str = "<li class='action'><a href='javascript:;'>全部</a></li>";
    			for (var i = json.data.categorylist.length - 1; i >= 0; i--) {
    				if (i == json.data.categorylist.length - 1) {
    					str +="<li><a href='javascript:;'>"+json.data.categorylist[i].name+"</a></li>";
    					continue;
    				}
    				str +="<li><a href='javascript:;'>"+json.data.categorylist[i].name+"</a></li>";
    			}
    			//赋值分类列表
    			var $goods_cs_lt = $("#goods_cs_lt");
    			$goods_cs_lt.empty();
    			$goods_cs_lt.append(str);
    			//赋值弹出框的分类列表
    			var $goods_cs_lt_alert = $("#goods_cs_lt_alert");
    			$goods_cs_lt_alert.empty();
    			$goods_cs_lt_alert.append(str);
    		}
		}
	);
	//获取购物车商品
	var cart_list_url = "http://develop.01nnt.com/api/wechatApi/shopping_cart_list";
    var shop_user_id=$("#shop_user_id").val();//用户店铺ID
    var zerone_user_id=$("#zerone_user_id").val();//用户零壹ID
    $.post(
    	cart_list_url,
        {'fansmanage_id': fansmanage_id,'_token':_token,'store_id':store_id,'user_id':shop_user_id,'zerone_user_id':zerone_user_id},
    	function(json){
            console.log(json);
    		if (json.status == 1) {
                var str = "";
                for (var i = 0; i < json.data.goods_list.length; i++) {
                    str += cart_list_box(json.data.goods_list[i].goods_name,json.data.goods_list[i].goods_price,
                        json.data.goods_list[i].num);
                    total_price += parseFloat(json.data.goods_list[i].goods_price);
                }
                //购物车总价格
                $("#cart_price").html("金额总计<em>&yen;"+total_price+"</em>");
                //购物车总数
                var total = json.data.total;
                $("#total").text(total);
                $("#goods_total").text(total);

                var $cart_list = $("#cart_list");
                $cart_list.empty();
                $cart_list.append(str);
    		}
		}
	);
    //获取商品列表
    var goodslist_url = "http://develop.01nnt.com/api/wechatApi/goods_list";
    $.post(
    	goodslist_url,
        {'fansmanage_id': fansmanage_id,'_token':_token,'store_id':store_id},
    	function(json){
            var str = "";
            console.log(json);
    		if (json.status == 1) {
                for (var i = 0; i < json.data.goodslist.length; i++) {
                    //console.log(json.data.goodslist[i+2].thumb[0].thumb);
                    str += goods_list_box(json.data.goodslist[i].name,json.data.goodslist[i].details,
                    json.data.goodslist[i].stock,json.data.goodslist[i].price,json.data.goodslist[i].thumb[0].thumb);

                }
                var goodslist = $("#goodslist");
                goodslist.empty();
                goodslist.append(str);
    		}
		}
	);
    $.hidePreloader();
});
    </script>
  </body>
</html>
