//产品页面通用JS
var position = $(".position").attr("position");
var sessionuserid = $("#sessionUserid").attr("userId");
var url = $("#manager").attr('manager');
var typeurl="";
var listurl="";
if(position==1){
	typeurl = $("#manager").attr('manager') + "/manager/serviceGoods/getServiceCommunityType";
	listurl = $("#manager").attr('manager') + "/manager/serviceGoods/getServiceCommunityList";
}else {
	typeurl = $("#manager").attr('manager') + "/manager/community/getCommunityType";
	listurl = $("#manager").attr('manager') + "/manager/community/queryCommunityList";
}
//var testurl='http://mail.luichi.info:8881/pc/commerceModule/commerceDetail.html';
var testurl='http://eachonline.com/commerceModule/commerceDetail.html';
var masterurl='http://eachonline.com/commerceModule/commerceDetail.html';
var view = $("#view").attr("view");
var edit = $("#edit").attr("edit");
//console.log(view);
userid = $("#userid").attr("userId");

//var userid 
//if(position == 16){
//	userid = sessionuserid;
//}else{
//	userid = $("#userid").attr("userId");
//}


if(!userid){
	userid = 111;
}
$(document).ready(
	list(userid, 0, 10, '', '')
);
//查询列表
function list(user, start, size, keyword, type) {
	$.ajax({
		type: "post",
		url: listurl,
		async: true,
		data: {
			userIds: user,
			start: start,
			pageSize: size,
			keyWord: keyword,
			type: type,
			value:type
		},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				var obj = data.data;
				console.log(obj);
				$("#form_container").html('');
				var liststr;
				if(obj.count == 0) {
					liststr = '<tr><td colspan="8" style="text-align: center;padding: 30px 0;">没有查到数据</td></tr>';
					$("#form_container").append(liststr);
				} else {
					for(i = 0; i < obj.goodsList.length; i++) {
						var status;
						if (obj.goodsList[i].serviceGoodsBase.serviceStatus==1) {
							status="已上架"
						}else{
							status="已下架"
						}
						var j;
						$.each(obj.goodsList[i].serviceGoodsPicture, function(index,imgval) {
							if(imgval.mainPage){
								j=index;
							}
						});

						if(obj.goodsList[i].serviceGoodsBase.checkStatus == 0) {
							if(position == 16 ||position == 14 || position == 15 || position == 1){
								
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="'+view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>待审核</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;'; 
								//	'<a href="'+testurl+'?sid=' + obj.goodsList[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;';
								if(sessionuserid == obj.goodsList[i].serviceGoodsBase.userId){
									liststr = liststr +  '</td></tr>';//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid +'&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a></td></tr>';
								}else{
									liststr = liststr + '</td></tr>';
								}
								
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" userid="' + obj.goodsList[i].serviceGoodsBase.userId + '"/></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="'+view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>待审核</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									//'<a href="'+testurl+'?sid=' + obj.goodsList[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;
									//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid +'&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a>'+
								'</td></tr>';
							}
							$("#form_container").append(liststr);
						} else if(obj.goodsList[i].serviceGoodsBase.checkStatus == 1) {
							if(position == 16 || position == 14 || position == 15 || position == 1){
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核通过</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' ;
									//'<a href="'+testurl+'?sid=' + obj.goodsList[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;';
								if(sessionuserid == obj.goodsList[i].serviceGoodsBase.userId){
									liststr = liststr + '</td></tr>';//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid +'&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a></td></tr>';
								}else{
									liststr = liststr + '</td></tr>';
								}
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" userid="' + obj.goodsList[i].serviceGoodsBase.userId + '"/></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核通过</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									//'<a href="'+testurl+'?sid=' + obj.goodsList[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;
									//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid + '&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a>'+
								'</td></tr>';

							}

							$("#form_container").append(liststr);
						} else {
							if(position == 16 || position == 14 || position == 15 || position == 1){
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核失败</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' ;
									//'<a href="'+testurl+'?sid=' + obj.goodsList[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;';

								if(sessionuserid == obj.goodsList[i].serviceGoodsBase.userId){
									liststr = liststr + '</td></tr>';//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid +'&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a></td></tr>';
								}else{
									liststr = liststr + '</td></tr>';
								}
								
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.goodsList[i].serviceGoodsBase.sid + '" data-check="' + obj.goodsList[i].serviceGoodsBase.checkStatus + '" userid="' + obj.goodsList[i].serviceGoodsBase.userId + '"/></td>' +
								'<td><img src="' + obj.goodsList[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '"><span title="'+ obj.goodsList[i].serviceGoodsBase.serviceName +'">' + obj.goodsList[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核失败</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.goodsList[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.goodsList[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									//'<a href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.goodsList[i].serviceGoodsBase.userId+'">预览</a>&nbsp;
									//'<a href="'+edit + obj.goodsList[i].serviceGoodsBase.sid + '&company='+obj.goodsList[i].serviceGoodsBase.userId+ '">编辑</a>'+
								'</td></tr>';
								// console.log(liststr);
							}

							$("#form_container").append(liststr);
						}

					}
				}

				var page = Math.ceil(obj.count / size);
				var now = Math.ceil((parseInt(start) + 1) / size);
				var total = '共' + obj.count + ' 条记录' + now + '/' + page + ' 页';
				$("#total").text(total);

				var pagenum;
				for(i = 1; i < page + 1; i++) {
					pagenum += '<option value="' + i + '">' + i + '</option>';
					$("#pagenum").html(pagenum);
				}
				$("#pagenum").val(now);
				var prev = start - size;
				var next = parseInt(start) + parseInt(size);
				var last = (page - 1) * size;
				var nav;
				if(start == 0) {
					if(size > obj.count) {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span>下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>';
						$("#pagenav").html(nav);
					} else {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>';
						$("#pagenav").html(nav);
					}

				} else if((parseInt(start) + parseInt(size)) > obj.count) {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">&laquo; 上一页</span></li>' +
						'<li><span >下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>';
					$("#pagenav").html(nav);
				} else {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">&laquo; 上一页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\')">末页</span></li></ul></div>';
					$("#pagenav").html(nav);
				}

			}
		}
	});
}
//分页显示
$("#listrows").on("change", function() {
	list(userid, 0, $(this).val(), '', '')
});

//页数切换
$("#pagenum").on("change", function() {
	var sizenum = $("#listrows").val();
	var pages = ($(this).val() - 1) * sizenum;
	list(userid, pages, sizenum, '', '')
});

//检索
function search() {
	var word = $("#search").val();
	list(userid, 0, 10, word, '')
}

//商品类目
// $(document).ready(function() {
// 	$.ajax({
// 		type: "post",
// 		url: url+'/manager/trade/queryClassHead',
// 		async: true,
// 		data: {
// 			userId: userid
// 		},
// 		datatype: "JSON",
// 		success: function(data) {
// 			//console.log(data);
// 			if(data.code == 2000) {
// 				var obj = data.data;
// 				for(i = 0; i < obj.list.length; i++) {
// 					var listli = '<li><a href="javascript:void(0);" onclick="list(\'' + userid + '\', 0, 10,\'\', \'' + obj.list[i].levelList1.value + '\')">' +
// 						'<i class="icon-white icon-chevron-right"></i>' + obj.list[i].levelList1.text + '</a></li>'
// 					$("#prolist").append(listli);

// 				}
// 			}
// 		}
// 	});
// });

//商品类目
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: typeurl,
		async: true,
		data: {},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				if(position==1) {
					var obj = data.data.typeList;
				}else{
					var obj = data.data;
				}
				for(i = 0; i < obj.length; i++) {
					var listli = '<li class="sallshow" style="display: none"><a href="javascript:void(0);" onclick="list(\'' + userid + '\', 0, 10,\'\', \'' + obj[i].value + '\')">' +
						'<i class="icon-white icon-chevron-right"></i>' + obj[i].text + '</a></li>';
					$("#prolist2").append(listli);

				}
			}
		}
	});
});

//产品上架
function upproduct() {
	var products = [];
	var userids = [];
	//console.log($("#form_container>tr>td>.check_list"));
	$.each($("#form_container>tr>td>.check_list"), function() {
		if($(this).context.checked) {
			if($(this).attr("data-check") == 1) {
				products.push($(this).attr("key"));
				userids.push($(this).attr("userid"));
			}else{
				alert('请等待商品审核!');
			}
		}
	});

	$.ajax({
		type: "post",
		url: url+'/manager/trade/editorSoldOut',
		async: true,
		data: {
			serviceIds: products.toString(),
			serviceStatus: 1
		},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				alert('上架成功!');
				window.location.reload();
			}
		}
	});

}
//产品下架
// function downproduct() {
// 	var products = [];
// 	var userids = [];
// 	$.each($("#form_container>tr>td>.check_list"), function() {
// 		//console.log($(this));
// 		if($(this).context.checked) {
// 			products.push($(this).attr("key"));
// 			userids.push($(this).attr("userid"));
// 		}
// 	});
// 	//console.log(products);
// 	if(confirm('确认要下架吗?')) {
//
// 		$.ajax({
// 			type: "post",
// 			url: 'index?m=product&a=checkdelete',
// 			async: true,
// 			data: {
// 				userid: userids
// 			},
// 			dataType: "json",
// 			cache: false,
// 			success: function(data) {
// 				if(data.status == 1){
// 					alert('部分数据没有权限');
// 				}else{
// 					$.ajax({
// 						type: "post",
// 						url: url+'/manager/trade/editorSoldOut',
// 						async: true,
// 						data: {
// 							serviceIds: products.toString(),
// 							serviceStatus: 0
// 						},
// 						datatype: "JSON",
// 						success: function(data) {
// 							//console.log(data);
// 							if(data.code == 2000) {
// 								alert(data.message);
// 								window.location.reload();
// 							}
// 						}
// 					});
// 				}
// 			}
// 		});
// 	}
// }

function downproduct() {
	var products = [];
	var userids = [];
	$.each($("#form_container>tr>td>.check_list"), function() {
		//console.log($(this));
		if($(this).context.checked) {
			products.push($(this).attr("key"));
			userids.push($(this).attr("userid"));
		}
	});
	//console.log(products);
	if(confirm('确认要下架吗?')) {

		$.ajax({
			type: "post",
			url: url+'/manager/trade/editorSoldOut',
			async: true,
			data: {
				serviceIds: products.toString(),
				serviceStatus: 0
			},
			datatype: "JSON",
			success: function(data) {
				//console.log(data);
				if(data.code == 2000) {
					alert(data.message);
					window.location.reload();
				}
			}
		});
	}
}

//产品删除
function prodelete() {
	if(confirm('确认删除吗？')) {
		var products = [];
		var userids = [];
		$.each($("#form_container>tr>td>.check_list"), function() {
			//console.log($(this));
			if($(this).context.checked) {
				products.push($(this).attr("key"));
				userids.push($(this).attr("userid"));
			}
		});

		$.ajax({
			type: "post",
			url: url+'/manager/trade/deleteService',
			async: true,
			data: {
				serviceIds: products.toString()
			},
			dataType: "json",
			cache: false,
			success: function(data) {
				//console.log(data);
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