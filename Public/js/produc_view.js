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
		url: url+'/manager/trade/queryCrmTradeDetail',
		async: true,
		data: {
			//sid:"ac630c047ca442948b691ce48c1c2e33"
			sid: sid
		},
		dataType: "json",
		cache: false,
		success: function(data) {
			//console.log(data)
			if(data.code == 2000) {
				var trade = data.data.tradeInfo;
				// console.log(trade)
				$("#pro_name").html(trade.serviceName);
				$("#pro_name").attr('title',trade.serviceName);
				$("#pro_user").html(trade.userNickName);
				// $("#pro_model").html(trade.goodsModel);
				$("#por_brand").html(trade.goodsBrand);
				if(trade.tchList.length == 2) {
					$("#pro_type").html(trade.tchList[1].text)
				} else if(trade.tchList.length == 3) {
					$("#pro_type").html(trade.tchList[2].text)
				}
				$("#por_unit").html(trade.tprList[0].unit);
				$("#pro_weight").html(trade.goodsWeight + "公斤");
				$("#pro_total").html(trade.stockNum);
				if(trade.address){
					$("#pro_address").html(trade.serviceDistrict + " " + trade.address);
				}else{
					$("#pro_address").html(trade.serviceDistrict);
				}
				$("#pro_total").html(trade.stockNum);
				$("#pro_detail").html(trade.serviceDetail);

				$.each(trade.picList, function(index, val) {
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