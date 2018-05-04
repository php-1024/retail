$(function(){
	//获取当前月日
	var myDate = new Date();
	var month = myDate.getMonth();
	var dateri = myDate.getDate();
	var arr = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'];
	month = arr[parseInt(month+1,10)-1]
	$("#month").html(dateri+"<span>"+month+"月</span>");
});
function searchshop(){
	alert();
}

function shoplist(name,address,logo,distance) {
	var str = "<li>"+"<a href='javascript:;'>"+
					"<div class='shop_img'>"+
						"<img src='http://develop.01nnt.com/"+logo+"'>"+
					"</div>"+
					"<div class='shop_right'>"+
						"<section class='shop_name'><h3><span>"+name+"</span></h3></section>"+
						"<section class='shop_youhui'><p>满120减10</p></section>"+
						"<section class='shop_juli'><p>距离<span><em><</em>&nbsp;"+distance+"km</span></p></section>"+
						"<section class='shop_juli'><p>地址:"+address+"</p></section>"+
					"</div>"+
				"</a>"+
			"</li>";
	return str;
}
