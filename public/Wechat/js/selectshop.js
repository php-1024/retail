function shoplist(organization_name) {
	var str = "<li>"+"<a href='javascript:;'>"+
					"<div class='shop_img'>"+
						"<img src='images/emotion@2x.png'>"+
					"</div>"+
					"<div class='shop_right'>"+
						"<section class='shop_name'><h3><span>"+organization_name+"</span></h3></section>"+
						"<section class='shop_youhui'><p>满120减10</p></section>"+
						"<section class='shop_juli'><p>小吃快餐<span><em><</em>&nbsp;920m</span></p></section>"+
						"<section class='shop_juli'><p>地址:广东省深圳市龙岗区龙城广场万汇大厦1606</p></section>"+
					"</div>"+
				"</a>"+
			"</li>";
	return str;
}

$(function(){
	//获取当前月日
	var myDate = new Date();
	var month = myDate.getMonth();
	var dateri = myDate.getDate();
	var arr = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'];
	var shijian = arr[parseInt(month+1,10)-1]
	console.log("month"+shijian);
	console.log(dateri);
});