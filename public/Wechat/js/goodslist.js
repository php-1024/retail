$(function(){
    var fansmanage_id=$("#fansmanage_id").val();//联盟主组织ID
    var _token=$("#_token").val();
    var store_id=$("#store_id").val();//店铺ID
	//获取goods分类列表
    var class_url = "http://develop.01nnt.com/api/wechatApi/category";
	$.showPreloader('加载中');
    $.post(
    	class_url,
        {'fansmanage_id': fansmanage_id,'_token':_token,'store_id':store_id},
    	function(json){
    		if (json.status == 1) {
    			var str = "<li class='action'><a href='javascript:;'>全部</a></li>";
    			    console.log(json.data.categorylist.length - 1);
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

    		}
		}
	);
});

//隐藏alert
$("#alert").click(function(e){
    return;
    //stopPropagation(e);
    if(!$(e.target).is(".popup_alert_hook *") && !$(e.target).is(".popup_alert_hook")){
        $(".popup_alert_hook").removeClass('fadeInUp').addClass("fadeOutDown");
           setTimeout(function(){
              $(".popup_alert").css({display: 'none'});
         },250);
    }
})
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
