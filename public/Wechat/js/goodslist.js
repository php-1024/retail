$(function(){
    var total_price = 0;//购物车总价格

    var fansmanage_id=$("#fansmanage_id").val();//联盟主组织ID
    var _token=$("#_token").val();
    var store_id=$("#store_id").val();//店铺ID
	//获取goods分类列表
    var class_url = "http://develop.01nnt.com/api/wechatApi/category";
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
                var cart_num = [];
                for (var i = 0; i < json.data.goods_list.length; i++) {
                    str += cart_list_box(json.data.goods_list[i].goods_name,json.data.goods_list[i].goods_price,
                        json.data.goods_list[i].num,json.data.goods_list[i].goods_id);
                    //计算购物车总价格
                    total_price += parseFloat(json.data.goods_list[i].goods_price) * parseInt(json.data.goods_list[i].num);
                    //记录购物车列表数量,渲染商品列表赋值商品列表存在购物车的数量
                    cart_num[json.data.goods_list[i].goods_id] = json.data.goods_list[i].num;
                }
                //购物车总价格
                totalprice(total_price);
                //购物车总数
                var total = json.data.total;
                $("#total").text(total);
                $("#goods_total").text(total);
                //购物车列表渲染
                var $cart_list = $("#cart_list");
                $cart_list.empty();
                $cart_list.append(str);
    		}
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
                            //判断列表与购物车的id存在就读取购物车的数量
                            if(cart_num[json.data.goodslist[i].id]){
                                json.data.goodslist[i].number = cart_num[json.data.goodslist[i].id];
                            }
                            str += goods_list_box(json.data.goodslist[i].name,json.data.goodslist[i].details,
                            json.data.goodslist[i].stock,json.data.goodslist[i].price,json.data.goodslist[i].thumb[0].thumb,
                            json.data.goodslist[i].number,json.data.goodslist[i].id);
                        }
                        var $goodslist = $("#goodslist");
                        $goodslist.empty();
                        $goodslist.append(str);
            		}
        		}
        	);
		}
	);
});
//添加购物车
function cart_add(obj){
    $.showIndicator();
    var url = "http://develop.01nnt.com/api/wechatApi/shopping_cart_add";
    var $this = $(obj);
    var goods_id = $this.data("goodsid");
    var goods_name = $this.data("goodsname");
    var stock = $this.data("goodsstock");
    var goods_thumb = $this.data("goodsthumb");
    var goods_price = $this.data("goodsprice");
    var fansmanage_id=$("#fansmanage_id").val();//联盟主组织ID
    var _token=$("#_token").val();
    var store_id=$("#store_id").val();//店铺ID
    var zerone_user_id=$("#zerone_user_id").val();//用户零壹ID
    var user_id=$("#shop_user_id").val();//用户店铺ID
    var data = {
            fansmanage_id:fansmanage_id,
            zerone_user_id:zerone_user_id,
            user_id:user_id,
            store_id:store_id,
            goods_id:goods_id,
            goods_price:goods_price,
            goods_name:goods_name,
            goods_thumb:goods_thumb,
            num:1,
            stock:stock,
            _token:_token
    };
    $.post(
    	url,
        data,
    	function(json){
            console.log(json);
    		if (json.status == 1) {
                //删除点击加号按钮的当前状态
                $(".cart_border").removeClass('action');
                //添加点击加号按钮的当前状态
                $this.parent().addClass('action');
                $("#goods_id"+json.data.goods_id).text(json.data.num);
                //购物车总价格
                totalprice(json.data.goods_price);
                $.hideIndicator();
    		}
		}
	);
}
//购物车总价格
function totalprice(price){
    var $this = $("#cart_price");
    var old_price = $this.data("totalprice");
    var total = parseFloat(price) + parseFloat(old_price);
    //记录总价格的值
    $this.attr('data-totalprice', total.toFixed(2));
    $this.html("金额总计<em>&yen;"+total.toFixed(2)+"</em>");
}
//购物车列表
function cart_list_box(name,price,num,goods_id) {
    str = '<li>'+
        '<span>'+name+'</span>'+
        '<span>&yen;'+price+'</span>'+
        '<div class="cart_alert_btn">'+
            '<div class="goods_btn cart_border">'+
                '<a href="javascript:;" class="cart_box delect_cart_btn">-</a>'+
                '<a href="javascript:;" id="goods_id'+goods_id+'" class="cart_box delect_cart_inpt">'+num+'</a>'+
                '<a href="javascript:;" class="cart_box add_cart_btn">+</a>'+
            '</div>'+
        '</div>'+
    '</li>';
    return str;
}
//商品列表
function goods_list_box(name,details,stock,price,thumb,number,goods_id) {
    var str = "";
        str += '<div class="gl_item">'+
        '<div class="gl_item_fl">'+
            '<div class="goods_img">'+
                '<img src="http://develop.01nnt.com/'+thumb+'">'+
            '</div>'+
            '<div class="goods_right">'+
                '<div class="goods_right_item">'+
                    '<section class="gri_center">'+
                        '<h3 class="goods_tltie"><span>'+name+'</span></h3>'+
                    '</section>'+
                    '<section class="gri_center">'+
                        '<p class="goods_details">'+details+'</p>'+
                    '</section>'+
                    '<section class="gri_center">'+
                        '<p class="goods_distance">'+
                            '<span>库存：</span>'+
                            '<span>'+stock+'</span>'+
                        '</p>'+
                    '</section>'+
                    '<section class="gri_center gri_center_juzhong">'+
                        '<div class="goods_price">'+
                            '<span>&yen;'+price+'</span>'+
                        '</div>';
                        //购物车存在商品数量显示数量和减号
                        if(number > 0){
                        str += '<div class="goods_btn cart_border">'+
                                    '<a href="javascript:;" class="cart_box delect_cart_btn gs_show"'+
                                    'data-goodsid="'+goods_id+'"'+
                                    'data-goodsname="'+name+'"'+
                                    'data-goodsstock="'+stock+'"'+
                                    'data-goodsthumb="http://develop.01nnt.com/'+thumb+'"'+
                                    'data-goodsprice="'+price+'">-</a>'+
                                    '<a href="javascript:;" id="goods_id'+goods_id+'" class="cart_box delect_cart_inpt gs_show">'+number+'</a>';
                        }else{
                        str += '<div class="goods_btn action">'+
                                    '<a href="javascript:;" class="cart_box delect_cart_btn gs_hide">-</a>'+
                                    '<a href="javascript:;" id="goods_id'+goods_id+'" class="cart_box delect_cart_inpt gs_hide">'+number+'</a>';
                        }


                        str +='<a href="javascript:;" class="cart_box add_cart_btn"'+
                                    'data-goodsid="'+goods_id+'"'+
                                    'data-goodsname="'+name+'"'+
                                    'data-goodsstock="'+stock+'"'+
                                    'data-goodsthumb="http://develop.01nnt.com/'+thumb+'"'+
                                    'data-goodsprice="'+price+'" onclick="cart_add(this)">+</a>'+
                        '</div>'+
                    '</section>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>'
    return str;
}
//隐藏alert
$("#alert").click(function(e){
    //stopPropagation(e);
    if(!$(e.target).is(".popup_alert_hook *") && !$(e.target).is(".popup_alert_hook")){
        $(".popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
           setTimeout(function(){
              $(".popup_alert").css({display: 'none'});
         },250);
    }
});
//因为冒泡了，会执行到下面的方法。
function stopPropagation(e) {
    var ev = e || window.event;
    if (ev.stopPropagation) {
        ev.stopPropagation();
    }
    else if (window.event) {
        window.event.cancelBubble = true;//兼容IE
    }
}
function show(obj){
     $("#"+obj).css({display: 'flex'});
    $("#"+obj+" .popup_alert_hook").addClass('fadeInUp');
}
function hide(obj) {
    $("#"+obj).css({display: 'none'});
    $("#"+obj+" .popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
}
function showcart(obj,em){
    $(em).hide();
    $("#"+obj).css({display: 'flex'});
    $("#"+obj+" .popup_alert_hook").addClass('fadeInUp');
}
function goodsclass(obj){
    $("#"+obj).css({display: 'flex'});
    $("#"+obj+" .popup_alert_hook").removeClass('fadeOutUp').addClass('fadeInDown');
}
function hidegoodsclass(obj){
    $("#"+obj+" .popup_alert_hook").removeClass('fadeInDown').addClass('fadeOutUp');
    setTimeout(function(){
      $("#"+obj).css({display: 'none'});
     },250);
}
function hidecart(obj,em) {
    $(em).hidden();
    $("#"+obj).css({display: 'none'});
    $("#"+obj+" .popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
}
$("#cart").click(function(e){
    //stopPropagation(e);
    if(!$(e.target).is(".popup_alert_hook *") && !$(e.target).is(".popup_alert_hook")){
        $(".popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
           setTimeout(function(){
              $(".popup_alert").css({display: 'none'});
         },250);
        $("#cart_btn_b").show();
    }
})
