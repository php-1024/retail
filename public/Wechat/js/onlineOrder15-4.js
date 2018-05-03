$(function(){
    //显示提货方式
    show('selectexpress');
});
//隐藏alert
$(".popup_alert").click(function(e){
    //stopPropagation(e);
    if(!$(e.target).is(".popup_alert_hook *") && !$(e.target).is(".popup_alert_hook")){
        $(".popup_alert").css({display: 'none'});
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
function selectexpress(obj,address){
    var $this = $(obj);
    $this.addClass("action").siblings().removeClass('action');
    //隐藏添加收货地址按钮
    if (address == 1) {//快递配送
        $("#address").css({display:"block"});
        $("#zitiinfo").hide();
        $("#distribution").text("快递配送");
    }else if(address == 2){//到店自提
        $("#zitiinfo").css({display:"block"});
        $("#address").hide();
        $("#distribution").text("到店自提");
    }
}