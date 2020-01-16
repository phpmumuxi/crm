//产品页面通用JS
var position = $(".position").attr("position");
var urll=$("#manager").attr('manager');
var pagenums = $("#pagenums").val();
var keyword = $("#keyword").val();
var type = $("#type").val();
var url = "";
var commodityType = $("#commodityType").val();
if(position==1){
	url = $("#manager").attr('manager') + "/manager/serviceGoods/getServiceList";
 
}else{
	
	if(commodityType == 1){
		 url = $("#manager").attr('manager') + "/manager/trade/queryWholesaleTradeByUserList";//批发
	}else{
		url = $("#manager").attr('manager') + "/manager/trade/queryRetailTradeByUserList ";//零售
	}
}
//url = $("#manager").attr('manager') + "/manager/trade/queryTradeByUserList";

//测试环境
var testurl='http://mail.luichi.info:8881/pc/commerceModule/commerceDetail.html';
// 正式环境
// var testurl='http://eachonline.com/commerceModule/commerceDetail.html';
var masterurl='http://eachonline.com/commerceModule/commerceDetail.html';
var view = $("#view").attr("view");
var edit = $("#edit").attr("edit");
// console.log(position);

var userid = $("#userid").attr("userId");
var position_id = $("#position_id").attr("position_id");
if(!userid){
	userid = 111;
}
if(!pagenums){
	start = 0;
}else{
	start = (pagenums-1)*10;
	 
}

if(!keyword){
	keyword ='';
}
if(!type){
	type ='';
}

$(document).ready(
	list(userid, start, 10, keyword, type,commodityType,'')  
);

//输出url参数
function GetUrlParms() 
{
 var args=new Object(); 
 var query=location.search.substring(1);//获取查询串 
 var pairs=query.split("&");//在逗号处断开 
 for(var i=0;i<pairs.length;i++) 
 { 
  var pos=pairs[i].indexOf('=');//查找name=value 
   if(pos==-1) continue;//如果没有找到就跳过 
   var argname=pairs[i].substring(0,pos);//提取name 
   var value=pairs[i].substring(pos+1);//提取value 
   args[argname]=unescape(value);//存为属性 
 }
 return args;
}
//查询列表
function list(user, start, size, keyword, type,commodityType,serviceStatus) {	
	commodityType = $("#commodityType").val();
	if(commodityType==1){
		$("#nav_item_1").addClass('active');
		$("#nav_item_2").removeClass('active');
		$("#nav_item_2").parent().find(".allshow").hide();
	}else{
		$("#nav_item_2").addClass('active');
		$("#nav_item_1").removeClass('active');
		$("#nav_item_1").parent().find(".allshow").hide();
	}
	$.ajaxSetup({ cache: false });
	$.ajax({
		type: "post",
		url: url,
		async: true,
		data: {
			userId: user,
			start: start,
			pageSize: size,
			keyWord: keyword,
			type: type,
			value: type,
            commodityType:commodityType,
            serviceStatus:serviceStatus
		},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				var obj = data.data;
				// console.log(obj);
				//初始化页数
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
				
				var pagenums = $("#pagenum").val();
				var Params = GetUrlParms();
				//初始化列表			
				
				$("#form_container").html('');
				var liststr;
				if(obj.count == 0) {
					liststr = '<tr><td colspan="9" style="text-align: center;padding: 30px 0;">没有查到数据</td></tr>'
					$("#form_container").append(liststr);
				} else {
					for(i = 0; i < obj.list.length; i++) {
						var status;
						if (obj.list[i].serviceGoodsBase.serviceStatus==1) {
							status="已上架"
						} else{
							status="已下架"
						}
						var j;
						$.each(obj.list[i].serviceGoodsPicture, function(index,imgval) {
							if(imgval.mainPage){
								j=index;
							}

						});

						var upDownTime = obj.list[i].serviceGoodsBase.upDownTime;//上下架时间
						if(!upDownTime){
							upDownTime='';
						}
						$('#upDownTime').show();
						if(obj.list[i].serviceGoodsBase.checkStatus == 0) {
							if(position == 13 || position == 14 || position == 15 || position == 16 || position == 1){
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="'+view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>待审核</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;</td></tr>';
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="'+view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>待审核</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;<br/><a href="'+edit + obj.list[i].serviceGoodsBase.sid + "&pagenums="+pagenums+"&commodityType="+commodityType+'">编辑</a></td></tr>';
							}

							$("#form_container").append(liststr);
						} else if(obj.list[i].serviceGoodsBase.checkStatus == 1) {
							if(position == 13 || position == 14 || position == 15 || position == 16 || position == 1){
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核通过</td>' +
								'<td>'+status+'</td>' +
								'<td>'+upDownTime+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;</td></tr>';
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核通过</td>' +
								'<td>'+status+'</td>' +
								'<td>'+upDownTime+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;<br/><a href="'+edit + obj.list[i].serviceGoodsBase.sid + "&pagenums="+pagenums+"&commodityType="+commodityType+'">编辑</a></td></tr>';
							}

							$("#form_container").append(liststr);
						} else {
							if(position == 13 || position == 14 || position == 15 || position == 16 || position == 1){
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核失败</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;</td></tr>';
							}else{
								liststr = '<tr><td><input name="product_id[]" class="check_list" type="checkbox" key="' + obj.list[i].serviceGoodsBase.sid + '" data-check="' + obj.list[i].serviceGoodsBase.checkStatus + '" /></td>' +
								'<td><img src="' + obj.list[i].serviceGoodsPicture[j].realPicUrl + '" class="thumbnail thumb45"></td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '"><span>' + obj.list[i].serviceGoodsBase.serviceName + '</span></a></td>' +
								'<td>' + obj.list[i].serviceGoodsBase.text + ' </td>' +
								'<td>审核失败</td>' +
								'<td>'+status+'</td>' +
								'<td>' + obj.list[i].serviceGoodsBase.userNickName + '</td>' +
								'<td><a href="' +view+ obj.list[i].serviceGoodsBase.sid + '">查看</a>&nbsp;' +
									'<br/><a target="_blank" href="'+testurl+'?sid=' + obj.list[i].serviceGoodsBase.sid + '&goodsUserId='+obj.list[i].serviceGoodsBase.userId+'">预览</a>&nbsp;<br/><a href="'+edit + obj.list[i].serviceGoodsBase.sid + "&pagenums="+pagenums+"&commodityType="+commodityType+'">编辑</a></td></tr>';

							}

							$("#form_container").append(liststr);
						}

					}
				}

				
				var prev = start - size;
				var next = parseInt(start) + parseInt(size);
				var last = (page - 1) * size;
				var nav;
				if(start == 0) {
					if(size > obj.count) {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type +'\',\'' + commodityType +'\',\'' + serviceStatus +'\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span>下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">末页</span></li></ul></div>'
						$("#pagenav").html(nav);
					} else {
						nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">首页</span></li>' +
							'<li><span>&laquo; 上一页</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">下一页 &raquo;</span></li>' +
							'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">末页</span></li></ul></div>'
						$("#pagenav").html(nav);
					}

				} else if((parseInt(start) + parseInt(size)) > obj.count) {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">&laquo; 上一页</span></li>' +
						'<li><span >下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">末页</span></li></ul></div>'
					$("#pagenav").html(nav);
				} else {
					nav = '<div><ul><li><span class="pagenav" onclick="list(\'' + user + '\',0,' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">首页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + prev + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">&laquo; 上一页</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + next + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">下一页 &raquo;</span></li>' +
						'<li><span class="pagenav" onclick="list(\'' + user + '\',' + last + ',' + size + ',\'' + keyword + '\',\'' + type + '\',\'' + commodityType +'\',\'' + serviceStatus +'\')">末页</span></li></ul></div>'
					$("#pagenav").html(nav);
				}

			}
		}
	});
}
//分页显示
$("#listrows").on("change", function() {
	var serviceStatus=$('#product_all_up_down').val();
	if(serviceStatus=='-1'){
		serviceStatus='';
	}
	list(userid, 0, $(this).val(), keyword, type,commodityType,serviceStatus) ;
})

//页数切换
$("#pagenum").on("change", function() {
	var sizenum = $("#listrows").val();
	var pages = ($(this).val() - 1) * sizenum;
	var serviceStatus=$('#product_all_up_down').val();
	if(serviceStatus=='-1'){
		serviceStatus='';
	}
	list(userid, pages, sizenum, keyword, type,commodityType,serviceStatus) ;
})

//检索
function search() {
	var word = $("#search").val();	
	var _serviceStatus=$('#product_all_up_down').val();

	if(_serviceStatus=='-1'){
		_serviceStatus='';
	}

	list(userid, 0, 10, word,  type,commodityType,_serviceStatus) ;
}
//上下架切换事件
$('#product_all_up_down').on('change',function(){
	var _ss=$(this).val();

	if(_ss=='-1'){
		_ss='';
	}
	list(userid, 0, 10, keyword,  type,commodityType,_ss) ;
})

//商品类目
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: urll+'/manager/trade/queryClassHead',
		async: true,
		data: {
			userId: userid
		},
		datatype: "JSON",
		success: function(data) {
			if(data.code == 2000) {
				var obj = data.data.list;
				// console.log(obj[0].levelList1);
				for(i = 0; i < obj[0].levelList1.length; i++) {
					var listli = '<li class="allshow" style="display: none"><a href="javascript:void(0);" onclick="list(\'' + userid + '\', 0, 10,\'\', \'' + obj[0].levelList1[i].value + '\',\''+commodityType+ '\',\'\')">' +
						'<i class="icon-white icon-chevron-right"></i>' + obj[0].levelList1[i].text + '</a></li>'
					//console.log(listli);
					$(".prolist").append(listli);
					//console.log(obj[i])
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
	var url=$("#manager").attr('manager');
	if(Number(products.length)>0){
		if(confirm('确认要上架吗?')) {
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
	}else{
		alert('请先选择要上架的产品!');
	}
}
//产品下架
function downproduct() {
	var products = [];
	$.each($("#form_container>tr>td>.check_list"), function() {
		//console.log($(this));
		if($(this).context.checked) {
			products.push($(this).attr("key"))
		}
	});
	var url=$("#manager").attr('manager');
	if(Number(products.length)>0){
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
					if(data.code == 2000) {
						alert('下架成功!');
						window.location.reload();
					}
				}
			});
		}
	}else{
		alert('请先选择要下架的产品!');
	}
	
}
//产品删除
function prodelete() {
	var products = [];
	$.each($("#form_container>tr>td>.check_list"), function() {
		//console.log($(this));
		if($(this).context.checked) {
			products.push($(this).attr("key"))
		}
	});
	if(Number(products.length)>0){
		if(confirm('确认删除吗？')) {
			$.ajax({
				type: "post",
				url: urll+'/manager/trade/deleteService',
				async: true,
				data: {
					serviceIds: products.toString()
				},
				dataType: "json",
				cache: false,
				success: function(data) {
					// console.log(data);
					if(data.data.length == 0) {
						alert("删除失败，该商品已上架或有未完成订单")
					} else {
						alert(data.message);
						window.location.reload()
					}

				}
			});
		}
	}else{
		alert('请先选择要删除的产品!');
	}
}