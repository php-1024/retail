$(function(){
	//获取goods分类列表
    var fansmanage_id=$("#fansmanage_id").val();
    var _token=$("#_token").val();
    var store_id=$("#store_id").val();
    var url = "http://develop.01nnt.com/api/wechatApi/category";
	$.showPreloader('加载中');
    $.post(
    	url,
        {'fansmanage_id': fansmanage_id,'_token':_token,'store_id':store_id},
    	function(json){
    		if (json.status == 1) {
    			console.log(json);
    		}
			$.hidePreloader();
		}
	})
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