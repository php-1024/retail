jQuery.noConflict();
jQuery(function(){
    var total_price = 0;//购物车总价格

    var fansmanage_id=jQuery("#fansmanage_id").val();//联盟主组织ID
    var _token=jQuery("#_token").val();
    var store_id=jQuery("#store_id").val();//店铺ID
	//获取goods分类列表
    var class_url = "http://develop.01nnt.com/api/wechatApi/category";
    $.showPreloader();

    jQuery.post(
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
    			var jQuerygoods_cs_lt = jQuery("#goods_cs_lt");
    			jQuerygoods_cs_lt.empty();
    			jQuerygoods_cs_lt.append(str);
    			//赋值弹出框的分类列表
    			var jQuerygoods_cs_lt_alert = jQuery("#goods_cs_lt_alert");
    			jQuerygoods_cs_lt_alert.empty();
    			jQuerygoods_cs_lt_alert.append(str);
    		}
		}
	);
	//获取购物车商品
	var cart_list_url = "http://develop.01nnt.com/api/wechatApi/shopping_cart_list";
    var shop_user_id=jQuery("#shop_user_id").val();//用户店铺ID
    var zerone_user_id=jQuery("#zerone_user_id").val();//用户零壹ID
    jQuery.post(
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
                jQuery("#cart_price").html("金额总计<em>&yen;"+total_price+"</em>");
                //购物车总数
                var total = json.data.total;
                jQuery("#total").text(total);
                jQuery("#goods_total").text(total);

                var jQuerycart_list = jQuery("#cart_list");
                jQuerycart_list.empty();
                jQuerycart_list.append(str);
    		}
		}
	);
    //获取商品列表
    var goodslist_url = "http://develop.01nnt.com/api/wechatApi/goods_list";
    jQuery.post(
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
                var goodslist = jQuery("#goodslist");
                goodslist.empty();
                goodslist.append(str);
    		}
		}
	);
    $.hidePreloader();
});
//购物车列表
function cart_list_box(name,price,num) {
    str = '<li>'+
        '<span>'+name+'</span>'+
        '<span>&yen;'+price+'</span>'+
        '<div class="cart_alert_btn">'+
            '<div class="goods_btn cart_border">'+
                '<a href="javascript:;" class="cart_box delect_cart_btn">-</a>'+
                '<a href="javascript:;" class="cart_box delect_cart_inpt">'+num+'</a>'+
                '<a href="javascript:;" class="cart_box add_cart_btn">+</a>'+
            '</div>'+
        '</div>'+
    '</li>';
    return str;
}
//商品列表
function goods_list_box(name,details,stock,price,thumb) {
    str = '<div class="gl_item">'+
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
                        '</div>'+
                        '<div class="goods_btn cart_border">'+
                            '<a href="javascript:;" class="cart_box delect_cart_btn">-</a>'+
                            '<a href="javascript:;" class="cart_box delect_cart_inpt">123</a>'+
                            '<a href="javascript:;" class="cart_box add_cart_btn">+</a>'+
                        '</div>'+
                    '</section>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>'
    return str;
}
//隐藏alert
jQuery("#alert").click(function(e){
    //stopPropagation(e);
    if(!jQuery(e.target).is(".popup_alert_hook *") && !jQuery(e.target).is(".popup_alert_hook")){
        jQuery(".popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
           setTimeout(function(){
              jQuery(".popup_alert").css({display: 'none'});
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
     jQuery("#"+obj).css({display: 'flex'});
    jQuery("#"+obj+" .popup_alert_hook").addClass('fadeInUp');
}
function hide(obj) {
    jQuery("#"+obj).css({display: 'none'});
    jQuery("#"+obj+" .popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
}
function showcart(obj,em){
    jQuery(em).hide();
    jQuery("#"+obj).css({display: 'flex'});
    jQuery("#"+obj+" .popup_alert_hook").addClass('fadeInUp');
}
function goodsclass(obj){
    jQuery("#"+obj).css({display: 'flex'});
    jQuery("#"+obj+" .popup_alert_hook").removeClass('fadeOutUp').addClass('fadeInDown');
}
function hidegoodsclass(obj){
    jQuery("#"+obj+" .popup_alert_hook").removeClass('fadeInDown').addClass('fadeOutUp');
    setTimeout(function(){
      jQuery("#"+obj).css({display: 'none'});
     },250);
}
function hidecart(obj,em) {
    jQuery(em).hidden();
    jQuery("#"+obj).css({display: 'none'});
    jQuery("#"+obj+" .popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
}
jQuery("#cart").click(function(e){
    //stopPropagation(e);
    if(!jQuery(e.target).is(".popup_alert_hook *") && !jQuery(e.target).is(".popup_alert_hook")){
        jQuery(".popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
           setTimeout(function(){
              jQuery(".popup_alert").css({display: 'none'});
         },250);
        jQuery("#cart_btn_b").show();
    }
})
