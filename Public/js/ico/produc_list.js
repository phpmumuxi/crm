//产品页面通用JS
var userid = $("#userid").attr("userId");
$(document).ready(
	list(userid, 0, 10, '', '')
);
//查询列表
function list(user, start, size, keyword, type) {
	$.ajax({
		type: "post",
		url: "http://192.168.1.209:7001/manager/trade/queryTradeByUserList",
		async: true,
		data: {
			userId: user,
			start: start,
			pageSize: size,
			keyWord: keyword,
			type: type
		},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				console.log(data);
				var obj = data.data;
				$("#form_container").html('');
				var liststr;
				if(obj.count == 0) {
					liststr = '<tr><td colspan="6" style="text-align: center;padding: 30px 0;">没有查到数据</td></tr>'
					$("#form_container").append(liststr);
				} else {
					for(i = 0; i < obj.list.length; i++) {
						if(obj.list[i].serviceGoodsBase.checkStatus == 0) {
							liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[0].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>待审核</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;<a href="/crm/209/index.php?m=product&a=edit&sid=' + obj.list[i].serviceGoodsBase.sid + '">编辑</a></td></tr>';
							$("#form_container").append(liststr);
						} else if(obj.list[i].serviceGoodsBase.checkStatus == 1) {
							liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[0].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核通过</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;<a href="/crm/209/index.php?m=product&a=edit&sid=' + obj.list[i].serviceGoodsBase.sid + '">编辑</a></td></tr>';
							$("#form_container").append(liststr);
						} else {
							liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[0].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核失败</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="/crm/209/index.php?m=product&a=view&sid=' + obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;<a href="/crm/209/index.php?m=product&a=edit&sid=' + obj.list[i].serviceGoodsBase.sid + '">编辑</a></td></tr>';
							$("#form_container").append(liststr);
						}

					}
				}

				var page = Math.ceil(obj.count / size);
				var now = Math.ceil((start + 1) / size);
				var total = '共' + obj.count + ' 条记录' + now + '/' + page + ' 页'
				$("#total").text(total);

				var pagenum;
				for(i = 1; i < page + 1; i++) {
					pagenum += '<option value="' + i + '">' + i + '</option>'
					$("#pagenum").html(pagenum);
				}
				$("#pagenum").val(now);
				var prev = start - size;
				var next = start + size;
				var last = (page - 1) * size;
				var nav;
				if(start == 0) {
					if(size > obj.count) {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span>下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>'
						$("#pagenav").html(nav);
					} else {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>'
						$("#pagenav").html(nav);
					}

				} else if((start + size) > obj.count) {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">&laquo; 上一页</span></li>' +
						'<li><span >下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>'
					$("#pagenav").html(nav);
				} else {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">&laquo; 上一页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>'
					$("#pagenav").html(nav);
				}

			}
		}
	});
}
//分页显示
$("#listrows").on("change", function() {
	list(userid, 0, $(this).val(), '', '')
})

//页数切换
$("#pagenum").on("change", function() {
	var sizenum = $("#listrows").val();
	var pages = ($(this).val() - 1) * sizenum;
	list(userid, pages, sizenum, '', '')
})

//检索
function search() {
	var word = $("#search").val();
	list(userid, 0, 10, word, '')
}
//商品类目
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: "http://192.168.1.209:7001/manager/trade/queryClassHead",
		async: true,
		data: {
			userId: userid
		},
		datatype: "JSON",
		success: function(data) {
			console.log(data);
			if(data.code == 2000) {
				var obj = data.data;
				for(i = 0; i < obj.list.length; i++) {
					var listli = '<li><a href="javascript:void(0);" onclick="list(\'' + userid + '\', 0, 10,\'\', \'' + obj.list[i].levelList1.value + '\')">' +
						'<i class="icon-white icon-chevron-right"></i>' + obj.list[i].levelList1.text + '</a></li>'
					$("#prolist").append(listli);

				}
			}
		}
	});
});

//产品上架
function upproduct() {
	var products = [];
	$.each($("#form_container>tr>td>.check_list"), function() {

		if($(this).context.checked) {
			if($(this).attr("data-check") == 1) {
				products.push($(this).attr("key"))
			}
		}
	});

	$.ajax({
		type: "post",
		url: "http://192.168.1.209:7001/manager/trade/editorSoldOut",
		async: true,
		data: {
			serviceIds: products.toString(),
			serviceStatus: 1
		},
		datatype: "JSON",
		success: function(data) {

			if(data.code == 2000) {
				console.log(data);
				alert('上架成功!');
			}
		}
	});
}
//产品下架

function downproduct() {
	var products = [];
	$.each($("#form_container>tr>td>.check_list"), function() {
		console.log($(this));
		if($(this).context.checked) {
			products.push($(this).attr("key"))
		}
	});
	console.log(products);
	if(confirm('确认要下架吗?')) {
		$.ajax({
			type: "post",
			url: "http://192.168.1.209:7001/manager/trade/editorSoldOut",
			async: true,
			data: {
				serviceIds: products.toString(),
				serviceStatus: 0
			},
			datatype: "JSON",
			success: function(data) {

				if(data.code == 2000) {
					alert('下架成功!');
				}
			}
		});

	}
}

//产品删除
function prodelete() {
	if(confirm('确认删除吗？')) {
		var products = [];
		$.each($("#form_container>tr>td>.check_list"), function() {
			console.log($(this));
			if($(this).context.checked) {
				products.push($(this).attr("key"))
			}
		});
		$.ajax({
			type: "post",
			url: "http://192.168.1.209:7001/manager/trade/deleteService",
			async: true,
			data: {
				serviceIds: products.toString()
			},
			dataType: "json",
			cache: false,
			success: function(data) {
				console.log(data);
				if(data.data.length == 0) {
					alert("删除失败，该商品已上架或有未完成订单")
				} else {
					alert(data.message);
					window.location.reload()
				}

			}
		});
	}
}