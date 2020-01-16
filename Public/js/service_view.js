//产品页面通用JS
var url = $("#manager").attr('manager');
var edit = $("#edit").attr("edit");
var product = $("#product").attr("product");
//console.log(url);
function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) return unescape(r[2]);
	return null;
}

var sid = getQueryString("sid");

//产品详情页初始化
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: url+'/manager/serviceGoods/getGoodsBase',
		async: true,
		data: {
			sid: sid,
			module:'community_goods_extend'
		},
		dataType: "json",
		cache: false,
		success: function(data) {
			//console.log(data)
			if(data.code == 2000) {
				var trade = data.data.resultMap;
				//console.log(trade)
				$("#pro_name").html(trade.serviceName);
				$("#pro_name").attr('title',trade.serviceName);
				$("#pro_user").html(trade.userNickName);
				$("#pro_model").html(trade.goodsModel);
				$("#por_brand").html(trade.goodsBrand);
				$("#por_unit").html(trade.goodsUnit);
				if(trade.goodsType == '5100000000'){
					var goodsName = '美食';
				}else if(trade.goodsType == '5200000000'){
					var goodsName = '休闲娱乐';
				}else if(trade.goodsType == '5300000000'){
					var goodsName = '生活服务';
				}else if(trade.goodsType == '5400000000'){
					var goodsName = '丽人';
				}else if(trade.goodsType == '5700000000'){
					var goodsName = '旅游酒店';
				}else if(trade.goodsType == '5600000000'){
					var goodsName = '家政服务';
				}else if(trade.goodsType == '5800000000'){
					var goodsName = '商品服务';
				}else if(trade.goodsType == '5900000000'){
					var goodsName = '其他';
				}else if(trade.goodsType == '100001'){
					var goodsName = '跑腿外卖';
				}
				$("#pro_type").html(goodsName);
				$("#pro_total").html(trade.stockNum);
				$("#pro_detail").html(trade.serviceDetail);

				$.each(data.data.picList, function(index, val) {
					if($(this)[0].mainPage) {
						var mainpic = '<a href="' + $(this)[0].realPicUrl + '" class="litebox"><img src="' + $(this)[0].realPicUrl + '" class="thumbnail thumb100"></a>'
						$(".box-main").html(mainpic);
					} else {
						var secpic = '<div class="box-secondary"><a href="' + $(this)[0].realPicUrl + '" target="_blank" class="litebox">' +
							'<img src="' + $(this)[0].realPicUrl + '" class="thumbnail thumb100"></a></div>'
						$("#secondary_pic").append(secpic);
					}
				});
				$("#pro_edit").attr("href", edit+sid)

			}
		}
	});
})

//商品删除
function prodelete() {
	if(confirm('确认删除吗？')) {
		$.ajax({
			type: "post",
			url: url+'/manager/trade/deleteService',
			async: true,
			data: {
				serviceIds: sid
			},
			dataType: "json",
			cache: false,
			success: function(data) {
				//console.log(data);
				if(data.data.length == 0) {
					alert("删除失败，该商品已上架或有未完成订单")
				} else {
					alert(data.message);
					window.location.href = product
				}

			}
		});
	}

}