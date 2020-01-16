//产品页面通用JS
var url = $("#manager").attr('manager');
var product = $("#product").attr("product");
var commodityType = $("#commodityType").val();
//产品页面表单验证
$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单

	$("#form1").validate({
		 onkeyup: function(element, event) {
             //去除左侧空格
             var value = this.elementValue(element).replace(/^\s+/g, "");
             $(element).val(value);
         },
		//onsubmit:false,
		rules: {
			name: "required",
			crm_efiily:"required",
			// crm_gnhpxk: "required",
			crm_qmbrki: {
				required: true,
				minlength: 15
			},
			total: {
				required: true,
				digits: true
			}
		},
		messages: {
			name: "请输入产品名称",
			crm_efiily:"请输入品牌",
			// crm_gnhpxk: "请输入编号",
			crm_qmbrki: {
				required: "请输入产品描述",
				minlength: "产品描述不能小于 15 个字"
			},
			total: "请输入正确的供应总量"
		}
	});
});

//产品分类
function typeList(lv, val, name) {
	$.ajax({
		type: "get",
		url: url + '/manager/syncAccount/getCategoryTree',
		data: {
			level: lv,
			value: val
		},
		dataType: 'json',
		cache: false,
		success: function(data) {
			//console.log(data)
			if(code = "200") {
				switch(lv) {
					case 1:
						var first = data[0];
						var second = data[1];
						var third = data[2];
						var str1 = "";
						var str2 = "";
						var str3 = "";
						for(k = 0; k < first.length; k++) {
							var text1 = first[k].text;
							var value1 = first[k].value;
							str1 += '<li class="typeli" data-text="' + text1 + '" data-value="' + value1 + '" data-level="' + first[k].level + '" data-haschild="' + first[k].hasChild + '" >' + text1 + '</li>'
						}
						$("#typelist1").html(str1);
						break;
					case 2:
						var second = data[0];
						var third = data[1];
						var str2 = "";
						var str3 = "";
						var child = $(this).data("data-haschild");

						for(i = 0; i < second.length; i++) {
							//var level2 = second[i].level;
							var text2 = second[i].text;
							var value2 = second[i].value;
							str2 += '<li class="typeli" data-faval="' + val + '" data-faname="' + name + '" data-text="' + text2 + '" data-value="' + value2 + '" data-level="' + second[i].level + '" data-haschild="' + second[i].hasChild + '">' + text2 + '</li>'
						}
						$("#typelist2").html(str2);
						break;
					case 3:
						var third = data[0];
						var str3 = "";
						for(j = 0; j < third.length; j++) {
							var text3 = third[j].text;
							var value3 = third[j].value;
							str3 += '<li class="typeli" data-faval="' + val + '" data-faname="' + name + '" data-text="' + text3 + '" data-value="' + value3 + '" data-level="' + third[j].level + '" data-haschild="' + third[j].hasChild + '">' + text3 + '</li>'
						}
						$("#typelist3").html(str3);
						break;
				}
			}
		}

	});
}
//产品分类确认
$(".type_content").on("click", ".typeli", function() {
	var lv = Number($(this).attr("data-level"));
	var val = $(this).attr("data-value");
	var child = $(this).attr("data-haschild");
	var name = $(this).attr("data-text");
	var faval = $(this).attr("data-faval");
	var faname = $(this).attr("data-faname");

	switch(lv) {
		case 1:
			typeList(2, val, name);
			$("#typename").html("");
			$("#typelist3").html("");
			$("#typename").attr({
				"data-lv1-value": val,
				"data-lv2-value": '',
				"data-lv3-value": '',
				"data-lv1-name": name,
				"data-lv2-name": '',
				"data-lv3-name": ''
			})
			break;
		case 2:
			$("#typename").attr({
				"data-level": lv,
				"data-lv2-value": val,
				"data-lv3-value": '',
				"data-lv2-name": name,
				"data-lv3-name": ''
			})
			if(child == 'true') {
				typeList(3, val, name);
				$("#typename").html("");
				$(this).siblings().removeClass("type_active");
			} else {
				$("#typename").attr({
					"data-level": lv
				})
				$("#typename").html(name);
				$("#typelist3").html("");
				$(this).siblings().removeClass("type_active");
				$(this).addClass("type_active");
			}
			break;
		case 3:
			$("#typename").html(name);
			$("#typename").attr({
				"data-level": lv,
				"data-lv3-value": val,
				"data-lv3-name": name
			})
			$(this).siblings().removeClass("type_active");
			$(this).addClass("type_active");
			break;

	}
})

//产品分类展示
function typelistshow() {
	$(".type_content").toggle();
	typeList(1, 'main');
}

function getUuid(_n) {
	var _chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var _result = _n;
    for (var i = 31; i > 0; --i) _result += _chars[Math.floor(Math.random() * _chars.length)];
    return _result;
}

//规格新增
var ggarr;
function addguige() {	
	var guige = $.trim($("#guige_v").val());
	var str;
	str = guige + ';'
	
	ggarr = $("#guige").html().split(";");
	if(guige != "") {
		if(ggarr.length < 3 ) {
			if(guige.indexOf("颜色") != -1 && $("#guige").html().indexOf("颜色") != -1){
				alert("你已添加过颜色类规格");
			}else{
				if(jQuery.inArray(guige, ggarr) < 0) {
					$("#guige").append(str);
					var uuid1 = getUuid('1');			
					var uuid2 = getUuid('2');
					if(guige.indexOf("颜色") != -1 ){
						var _addDivGuige='<tr><td vd=' + uuid1 + '>' + guige + '</td><td><p><input vd=' + uuid2 + ' type="text" style="width:100px"/><a href="" target="_blank"><img style="margin-left:20px;width:60px;height:60px"  src="./Public/img/1.png" class="guigeImg" key=""/></a><a class="btn btn-primary" onclick="imgGuigeClick(this)" >+上传图片</a><input type="file"  onchange="updateGuige(this);" style="display:none;"><a class="btn btn-warning removeguige" style="margin:0 25px">-</a><a class="btn btn-primary addNewGuige">+</a></p></td></tr>';
					}else{
						var _addDivGuige='<tr><td vd=' + uuid1 + '>' + guige + '</td><td><p><input vd=' + uuid2 + ' type="text" style="width:100px"/><a class="btn btn-warning removeguige" style="margin:0 25px">-</a><a class="btn btn-primary addNewGuige">+</a></p></td></tr>';
					}			
					$("#guige_tab").append(_addDivGuige);
				} else {
					alert("请不要重复输入规格");
				}
			}
		}else{
			alert("只能添加两种规格");
		}
	}
	$("#guige_v").val("");
}

//添加规格
$("#guige_tab").on("click", ".addNewGuige", function() {
	var uuid3 = getUuid('2');
	var _guigeName = $(this).parent().parent().prev().html();
	if(_guigeName.indexOf("颜色") != -1 ){
		var _addguige='<p><input vd=' + uuid3 + ' type="text" style="width:100px"/><a href="" target="_blank"><img style="margin-left:20px;width:60px;height:60px"  src="./Public/img/1.png" class="guigeImg" key=""/></a><a class="btn btn-primary" onclick="imgGuigeClick(this)" >+上传图片</a><input type="file"  onchange="updateGuige(this);" style="display:none;"><a class="btn btn-warning removeguige" style="margin:0 25px">-</a></p>';
	}else{
		var _addguige = '<p><input vd=' + uuid3 + ' type="text" style="width:100px"/><a class="btn btn-warning removeguige" style="margin:0 25px">-</a></p>';
	}
	$(this).parent().parent().append(_addguige);
})

//删除规格
$("#guige_tab").on("click", ".removeguige", function() {
	var checked_ids = [];
	$($(this).parent().parent().find('input[type="text"]')).each(function(){
    	checked_ids.push($(this).attr("vd"));
  	});
  	if(checked_ids.length==1){
	    var	_ggarr = $("#guige").html().split(";");    
		var ggdel= $(this).parent().parent().prev().html();    
		var ggindex=jQuery.inArray(ggdel, _ggarr);
		_ggarr.splice(ggindex,1);    
		$("#guige").html(_ggarr.join(";"));		
        $(this).parent().parent().parent().remove();
    }else{
    	$(this).parent().remove();
    }
    changeGuigeNum();
})

/**
* 递归生成规格列表
* @param {*} skuarr 存储每一种排列组合的数组
* @param {*} i 要用list数据的第几项作为基数,i为几,最后的结果就是以list[i]的数据开头,一般以第一项的值放在组合的第一位,如果要以其他属性开头,方法需要变动一下,有兴趣可以自己研究
* @param {*} list 要生成排列的原始数据
* const list = [
　　['黑色','红色','白色'],
　　['S','M'],
　　['好','差']
]
*/
var _arr=[];
function func(skuarr=[], i, list){
	for (var j=0; j<list[i].length; j++) {  
	    if (i<list.length-1) {  　　　// 演示一下第一次执行函数的结果
	       skuarr[i] = list[i][j]  // skuarr[0] = ['黑色']  i=0, j=0
	       func(skuarr, i+1, list)    // 执行递归 skuarr[1] = ['s']  i=1, j=0
	     } else {
	　　　　　　// 拓展运算符合并数组  
	        _arr.push([...skuarr,list[i][j]])  // arr[0] = ['黑色','s','好']  i=2不符合if条件,执行else   j=0
	     }  
	  }  
	  return _arr;  
 }

//动态改变产品销售规格
function changeGuigeNum(){
	var guigeName = [];
	var guigeArr = [];
	$.each($("#guige_tab tr"),function(){
		guigeName.push($(this).find('td').eq(0).html());
		var item = [];
		$.each($(this).find('td').eq(1).find('input[type="text"]'),function(){			
			if($.trim($(this).val()) !=''){
				item.push($(this).val()+';'+$(this).parent().parent().parent().find('td').eq(0).attr('vd')+';'+$(this).attr('vd'));
			}
		})
		guigeArr.push(item);
	})
	var _html = '';
	if(commodityType == 2){
		var _oldPrice = $.trim($("#oldPrice").val());//一口价
	}
	if(guigeArr.length > 0){
		_arr=[];
		var _guigeData = func([], 0, guigeArr);
		_html += '<tr>';		
		for (var _i=0, guigeNameLen = guigeName.length; _i<guigeNameLen; _i++){
		    _html += '<th>'+guigeName[_i]+'</th>';
		}
		if(commodityType == 1){
			_html += '<th>库存</th></tr>';
		}else{			
			_html += '<th>价格（元）</th><th>库存</th></tr>';
		}
		for (var _j=0, guigeArrLen = _guigeData.length; _j<guigeArrLen; _j++){
			_html += '<tr>';
			for (var _k=0, _guigeArrLen = _guigeData[_j].length; _k<_guigeArrLen; _k++){
			    _html += '<td vpd="'+_guigeData[_j][_k].split(";")["1"]+'" vd="'+_guigeData[_j][_k].split(";")["2"]+'"style="text-align: center">'+_guigeData[_j][_k].split(";")["0"]+'</td>';
			}
			if(commodityType == 1){
		    	_html += '<td style="text-align: center"><input class="specStockNum" type="text" style="width: 100px"></td></tr>';
			}else{				
		    	_html += '<td style="text-align: center"><input class="specPrice" value="'+_oldPrice+'" type="text" style="width: 100px"></td><td style="text-align: center"><input class="specStockNum" type="text" style="width: 100px"></td></tr>';
			}
		}
	}
	$("#guige_num").empty().html(_html);
}

//规格变化 改变产品销售规格
$("#guige_tab").on("change", "input[type='text']", function() {
	changeGuigeNum();
})

//批量填充库存
function changeAllGuigeNum(){	
	var _addAllNum = $.trim($("#addAllGuige").val());
	if(commodityType == 2){
		var _addAllPrice = $.trim($("#addAllPrice").val());
		if (! /^[0-9]+.?[0-9]*$/.test(_addAllPrice)) {
	　　　　$("#addAllPrice").val('');
	　　　　alert("价格请输入正确数字!");　　　　
	　　} else {　　　　
			$.each($("#guige_num tr td").find('.specPrice'),function(){				
				$(this).val(_addAllPrice);
			})
	　　}		
	}
	if (! /^[0-9]+[0-9]*]*$/.test(_addAllNum)) {
　　　　$("#addAllGuige").val('');
　　　　alert("库存请输入正确数字!");　　　　
　　} else {
		var _tol = 0;　　　　
		$.each($("#guige_num tr td").find('.specStockNum'),function(){
			$(this).val(_addAllNum);
			_tol += Number(_addAllNum);
		})
		$("#total").val(_tol);
　　}	
}

//库存变化 产品销售规格库存改变
$("#guige_num").on("change", ".specStockNum",function() {
	if (! /^[0-9]+[0-9]*]*$/.test($.trim($(this).val()))) {
		$(this).val('');
　　　　alert("请输入正确数字!");　　
	}else{		
		var _tolNum = 0;　　　　
		$.each($("#guige_num tr td").find('.specStockNum'),function(){			
			_tolNum += Number($.trim($(this).val()));
		})
		$("#total").val(_tolNum);
　　}	
})

///价格区间展示
$("#price").on("change", ".minnum", function() {
	var minnum = $(this).val();
	if(parseInt(minnum) <= 0){
		alert('起批量不能为0');
		return false;
	}
	//价格区间判断顺序
	var prevnum = $(this).parent().parent().prev().find(".minnum").val();
	var nextnum = $(this).parent().parent().next().find(".minnum").val();
	var unitname = $("#crm_fwuzfa").val();

	if(parseInt(minnum) <= parseInt(prevnum)){
		alert("起批量必须大于前一个");
		return
	}
	if(nextnum !=null){//中间或者第一位的格区间编辑
		if(prevnum == null){//第一个价格区间

			var spacenum = minnum+'-'+String(parseInt(nextnum)-1)+unitname+'&nbsp;&nbsp;';
		

		}else{//中间的价格区间
			if(parseInt(minnum) >= parseInt(nextnum)){
				alert("起批量要小于后一个价格区间起批量");
				return
			}else{
				
				var spacenum = minnum+'-'+String(parseInt(nextnum)-1)+unitname+'&nbsp;&nbsp;';
				var prevspacenum = prevnum+'-'+String(parseInt(minnum)-1)+unitname+'&nbsp;&nbsp;';
			}
		}
		
	}else{ //最后一位价格区间
		if(prevnum == null){//第一个价格区间

			var spacenum = minnum+unitname+'以上'+'&nbsp;&nbsp;';
		

		}else{
			var prevspacenum = prevnum+'-'+String(parseInt(minnum)-1)+unitname+'&nbsp;&nbsp;';
			var spacenum = minnum+unitname+"以上"+'&nbsp;&nbsp;';
			
		}
		
	}

	$(this).parent().parent().find(".pronum").html(spacenum)
	$(this).parent().parent().prev().find(".pronum").html(prevspacenum)
})

$("#price").on("change", ".unitprice", function() {
	var price = $(this).val();
	//debugger
	//var purchasePrice = $(this).parent().next().children(".purchase_price").val();//进货价
	$(this).parent().next().next().children(".price").html(price);
})


//增加价格区间
var jgnum = 1;

function addprice() {

	var pricestr = '<tr><td width="30%">起批量：<input type="text" name="minnum_' + jgnum + '" class="add_input_text minnum" digits="true" min="0" required />'+
	'</td><td width="10%" class="td_center">' +
		'<input type="text" class="add_input_text unitprice" name="unitprice_' + jgnum + '" number="true" min="0" required /> 元'+
		'</td>'+
		'<td width="10%" class="td_center">'+
		'<input type="text" class="add_input_text originalPrice " name="originalPrice_"'+jgnum+ ' number="true" min="0" required/> 元'+
		'</td>'+
	
		'<td width="20%" class="td_center">' +
		'<sapn class="pronum"> </sapn><span class="price" class="mar-lefts2"> </span>元 <a class="btn btn-warning removeprice"><span>删除</span></a></td></tr>'

	$("#price>tbody").append(pricestr);
	jgnum++;

};
//删除价格区间
$("#price").on("click", ".removeprice", function() {
	//console.log($(this).parent().parent());
	$(this).parent().parent().remove();
})

//计算总量
var specstr; //库存数组
function num() {
	specstr = [];
	var tol = 0;
	$(".kccheck").each(
		function(index, val) {
			if($(val).context.checked) {
				var kc = $(val).parent().next().next().children("input").val();
				var kctext = $(val).parent().next().text()
				// if(Number(kc) <= 0 || Number(kc) == ""){
				// 	$("#kcnum").val(0);
				// 	return ;
				// }
				// $("#kcnum").val(1);
				tol += Number(kc);
				var specitem = '{"specName":"' + kctext + '", "specStockNum":' + Number(kc) + '}'
				specstr.push(specitem);
			}
			//console.log($(val).context.checked);
		}
	);
		
	$("#total").val(tol);
}


function maskshow() {
	$("#mask").css({
		display: "block",
		height: $(document).height()
	});
	$(".dialog").css("display", "block");
}

function maskhide() {
	$("#mask").css({
		display: "none",
		height: $(document).height()
	});
	$(".dialog").css("display", "none");
}

//运费查询
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: url + '/manager/template/queryTradeShipTemplate',
		data: {
			sid: $("#userid").attr("userId")
		},
		dataType: 'json',
		cache: false,
		success: function(data) {
			if(data.code == 2000) {
				var obj = data.data;
				// console.log(obj);
				var tempstr='';
				if(obj == null) {
					$("#ship").attr("disabled", "disabled");
					tempstr += '<option value="0">无运费模板</option>';
				} else {
					tempstr += '<option va="0" value="0">--请选择--</option>';
					for(i = 0; i < obj.length; i++) {
						if (obj[i].infoList) {
							var tempname = obj[i].templateName;
							var tempid = obj[i].sid;
							var typeid = obj[i].feeWay;
							tempstr += '<option va="' + typeid + '" value="' + tempid + '">' + tempname + '</option>'
						};
					}
				}
				$("#ship").append(tempstr);
				//模板切换事件
				$("#ship").change(function(){
					var _ty=$(this).find('option:selected').attr('va');
					if(_ty==2){
						$("#goodsweight").val('1');
						$("#goodsweight").parent().parent().hide();						
					}else if(_ty==1){
						$("#goodsweight").val('');
						$("#goodsweight").parent().parent().show();
					}else{

					}
				})
			}
		}
	});
})

/**
 * 资质认证
 */
function busenessCheck(){
	switch(positionId){
		case '17':
			companyUserId = userId;
			break;
		case '18':
			companyUserId = parentId;
			break;
	}
	
	var level = $("#typename").attr("data-level");
	var tyvalue =  $("#typename").attr("data-lv"+level+"-value");
	$.ajax({
		url:url + "/manager/businessQualification/toCheck",
		type:"POST",
		data:{userId:companyUserId,value:tyvalue},
		cache:false,
		dataType:"json",
		success:function(res){
			if(res.success){
				busCheck=true;
			}else{
				busCheck=false;
				layer.open({
					type: 1,
					title: "<div style='text-align:center'><strong>提示</strong></div>",
					content:"<div style=''><div><div style='padding-top:20px;padding-bottom:20px;text-align:center;font-size:18px'>您尚未提交此类目所需的资质证照！！！</div></div><div style='text-align:center;border-bottom:1px solid white;'><div style='margin-top:6%;margin-left:10px;'><a href="+addbusinessUrl+"><button style='color:blue' class='notice delok'>立即添加</button></a><button style='margin-left:15%' class='notice layerclose'>返回</button></div></div></div>",
					skin: 'layer-ext-moon',
					area: ['22%','26%'],
					resize: false,
					shadeClose: true,
					success:function(){
							$(".layerclose").click(function(){
								layer.closeAll();
							})
						}
					});
			}
		}
	})
	
}

//表单提交
function addproduct() {
	var type = $("#typename");
	if (type.html() == "") {
		alert("请选择产品类别");return;
	}
	switch(positionId){
	case '17':
		companyUserId = userId;
		break;
	case '18':
		companyUserId = parentId;
		break;
	case '22':
		companyUserId = userId;
		break;
}

var level = $("#typename").attr("data-level");
var tyvalue =  $("#typename").attr("data-lv"+level+"-value");
$.ajax({
	url:url + "/manager/businessQualification/toCheck",
	type:"POST",
	data:{userId:companyUserId,value:tyvalue},
	cache:false,
	dataType:"json",
	success:function(res){
		if(res.success){
			// var sumStockNum = $("#total").val();
			// if(sumStockNum ==''){
			// 	num();
			// }
			// if($("#kcnum").val() == 0){
			// 	alert("规格库存不能为空");
			// 	return;
			// }
			
			// var specstrarr;
			// if ($("#guige").text().indexOf('；') >= 0) {
			// 	num();
			// 	specstrarr = '[' + specstr.toString() + ']';
			// }
			
			var userid = $("#userid").attr("userId");
			var productname = $("#name").val();
			var area = $("#province").val() + "-" + $("#city").val() + "-" + $("#town").val();
			// var address = $("#address").val();
			var detail = getContent();
			if (detail.length > 4000) {
				alert('商品描述的字数超出最大限制!');
				return false;
			}
			var tradearr = [];
			var servicePrice = '';
			var _priceRange = '';			
			//价格区间判断1为批发2为零售商品价格格式
			if(commodityType == 1){//批发商品价格
				$(".minnum").each(
						function () {
							var price = $(this).parent().next().children(".unitprice").val();//单价
						    var originalPrice = $(this).parent().next().next().children(".originalPrice").val();//进货价
							var item = {
								"minBuyNum": $(this).val(),
								"price": price,
								"originalPrice": originalPrice
							};
							tradearr.push(item);
						}
					);
			}else{//零售商品价格
				if($("#guige_num tr td").length>0){
					var _priceArr=[];
					$.each($("#guige_num tr td").find('.specPrice'),function(){
						_priceArr.push($(this).val());
					})
					if($.inArray($.trim($("#oldPrice").val()), _priceArr) == '-1'){
						alert("产品销售规格中至少其中一个的规格价格要和一口价一致");
						return;
					}
					var maxPrice = Math.max.apply(null,_priceArr);
					var minPrice = Math.min.apply(null,_priceArr);
					if(maxPrice == minPrice){
						_priceRange = maxPrice;
					}else{
						_priceRange = minPrice+'~'+maxPrice;
					}
				}else{
					var minPrice = $.trim($("#oldPrice").val());
					_priceRange = minPrice;
				}
				var item = {
						"minBuyNum": 1,
						"price": minPrice,
						"originalPrice": $.trim($("#oldPrice").val())
					};
				tradearr.push(item);
			}

			var servicePrice = tradearr[0].price;
			
			var classValueOne = type.attr("data-lv1-value");
			var classValueTwo = type.attr("data-lv2-value");
			var classValueThree;
			if (type.attr("data-level") == 2) {
				classValueThree = type.attr("data-lv2-value");
			} else {
				classValueThree = type.attr("data-lv3-value");
			}

			// var goodsModel = $("#crm_gnhpxk").val();
			var goodsBrand = $("#crm_efiily").val();
			var tradeunit = $("#crm_fwuzfa").val();
			var shipId = $("#ship").val();
			if (shipId == '0') {
				shipId='';
			}

			// var platformPer = $.trim($("#platform_per").val());
			// if (!/^(?:100|[1-9][0-9]?|0)$/.test(platformPer)) {  
		 //        alert('平台利润分成请输入0-100范围内的整数！');
		 //        return false;
		 //    } 
			// if(Number(platformPer)==0){
			// 	platformPer='';
			// }

			var goodsWeight = $.trim($("#goodsweight").val());
			if (Number(goodsWeight) <= 0) {
				alert("商品重量不可为空");
				return false;
			}
			var sumStockNum = $.trim($("#total").val());
			if(sumStockNum === ''){
				alert("库存不能为空");
				return;
			}
			var typestr;
			if (type.attr("data-level") == 3) {
				typestr = '[{"value":"' + type.attr("data-lv1-value") + '","text":"' + type.attr("data-lv1-name") + '","level":"1","parentCatCode":"","hasChild":"1","catStatus":"1"},' +
					'{"value":"' + type.attr("data-lv2-value") + '","text":"' + type.attr("data-lv2-name") + '","level":"2","parentCatCode":"' + type.attr("data-lv1-value") + '","hasChild":"1","catStatus":"1"},' +
					'{"value":"' + type.attr("data-lv3-value") + '","text":"' + type.attr("data-lv3-name") + '","level":"3","parentCatCode":"' + type.attr("data-lv2-value") + '","hasChild":"0","catStatus":"1"}]'
			} else if (type.attr("data-level") == 2) {
				typestr = '[{"value":"' + type.attr("data-lv1-value") + '","text":"' + type.attr("data-lv1-name") + '","level":"1","parentCatCode":"","hasChild":"1","catStatus":"1"},' +
					'{"value":"' + type.attr("data-lv2-value") + '","text":"' + type.attr("data-lv2-name") + '","level":"2","parentCatCode":"' + type.attr("data-lv1-value") + '","hasChild":"0","catStatus":"1"}]'
			}
			var imgstr = [];//图片数组
			//选择主图
			var mainImg= '{"picServiceUrl": "' + $("#mainThum").find("img").attr("key") + '","mainPage": "1"}';
				imgstr.push(mainImg);
			if($("#mainThum").find("img").length <= 0){
				alert("请上传主图!");
				return false;
			}
			//遍历副图
			$.each($("#imgList .thum"), function(i, val) {
				var imgitem;
				imgitem = '{"picServiceUrl": "' + $(this).find("img").attr("key") + '","mainPage": "0"}';
				imgstr.push(imgitem);
			});
			var tradePriceArrary = [];
			for (i = 0; i < tradearr.length; i++) {
				if (i < tradearr.length - 1) {
					var priceitem = '{"minBuyNum": ' + tradearr[i].minBuyNum + ',"maxBuyNum": ' + (tradearr[i + 1].minBuyNum - 1) + ',"price": ' + tradearr[i].price + ',"originalPrice": ' + tradearr[i].originalPrice + ',"unit": "' + tradeunit + '","number":"' + i + '"}';
					tradePriceArrary.push(priceitem);
				} else {
					var priceitem = '{"minBuyNum": ' + tradearr[i].minBuyNum + ',"maxBuyNum":0,"price": ' + tradearr[i].price + ',"originalPrice": ' + tradearr[i].originalPrice + ',"unit": "' + tradeunit + '","number":"' + i + '"}';
					tradePriceArrary.push(priceitem);
				}

			}
			var imgstrarr = '[' + imgstr.toString() + ']';
			var pricearr = '[' + tradePriceArrary.toString() + ']';

			var _flag = true,_flag_guige = true,_flag_img = true,_flag_price = true,_flag_stock = true;
			//规格类别及规格属性值
			var _tradeSpecGroupArray = [];
			if($("#guige_tab tr").length>0){
				$.each($("#guige_tab tr"),function(_i){
					var itemOne = {};
					itemOne.sid = $(this).find('td').eq(0).attr('vd');
					itemOne.specGroup = $(this).find('td').eq(0).html();
					itemOne.specGroupSort = _i+1;
					itemOne.tradeSpecParameter = [];
					$.each($(this).find('td').eq('1').find('p'),function(_ind){
						var itemTwo = {};
						itemTwo.sid = $(this).find("input[type='text']").attr('vd');
						itemTwo.tradeSpecGroupId = $(this).parent().prev().attr('vd');
						itemTwo.specName = $(this).find("input[type='text']").val();
						if($.trim($(this).find("input[type='text']").val()) ==''){
							_flag = false;
							_flag_guige = false;
						}
						itemTwo.specNameSort = _ind+1;
						var itemT = [];

						if($(this).find("img").length > 0) {			
							var itemThree = {};
							itemThree.tradeSpecParameterId = $(this).find("input[type='text']").attr('vd');
							if($(this).find("img").attr('key')==''){
								_flag = false;
								_flag_img = false;
							}
							itemThree.tradeSpecParameterPic = $(this).find("img").attr('key');
							itemT.push(itemThree);
						}
						itemTwo.tradeSpecParamterPic = itemT;
						itemOne.tradeSpecParameter.push(itemTwo);
					})
					_tradeSpecGroupArray.push(itemOne);
				})
				if(!_flag_guige){
					alert("请填写规格");
				}
				if(!_flag_img){
					alert("请上传规格图片");
				}
			}else{
				alert("产品规格不能为空");
				return;
			}
			_tradeSpecGroupArray = JSON.stringify(_tradeSpecGroupArray);			

			//规格组库存
			var _tradeSepecStockArray = [];
			if($("#guige_num tr").length>0){
				$.each($("#guige_num tr:not(:first)"),function(_ii){
					var _itemOne = {};
					var _vd1 = '';		
					var _vd2 = '';		
					var _vd3 = '';		
					$.each($(this).find('td'),function(){
						if($(this).text()){
							_vd1 += $(this).attr('vpd')+';';	
							_vd2 += $(this).attr('vd')+';';	
							_vd3 += $(this).html()+';';	
						}else{					
							if($(this).find('.specPrice').length>0 && $.trim($(this).find('.specPrice').val())==''){
								_flag = false;
								_flag_price = false;
							}
							if($(this).find('.specStockNum').length>0 && $.trim($(this).find('.specStockNum').val())==''){
								_flag = false;
								_flag_stock = false;
							}
							if(commodityType == 1){
								_itemOne.specPrice = 0;
							}else{
								if($(this).find('.specPrice').length>0){
									_itemOne.specPrice = $.trim($(this).find(".specPrice").val());
								}
							}
							if($(this).find('.specStockNum').length>0){
								_itemOne.specStockNum = Number($.trim($(this).find('.specStockNum').val()));
							}
						}
					})
					_itemOne.specStockSort = _ii+1;			
					_itemOne.specGroupId = _vd1.substring(0,_vd1.length-1);
					_itemOne.specParameterIdData = _vd2.substring(0,_vd2.length-1);
					_itemOne.specParameterNameData = _vd3.substring(0,_vd3.length-1);
					_tradeSepecStockArray.push(_itemOne);
				})
				if(!_flag_price){
					alert("请填写产品销售规格价格");
				}
				if(!_flag_stock){
					alert("请填写产品销售规格库存");
				}
			}else{
				alert("产品销售规格库存不能为空");
				return;
			}
			_tradeSepecStockArray = JSON.stringify(_tradeSepecStockArray);

			if(!_flag){
				return false;
			}
		if (tradeunit == "") {
				alert("请选择计量单位")
			} else {
				// if(productname=="" || goodsModel=="" ||  goodsBrand=="" ){
				if(productname=="" || goodsBrand=="" ){
					alert("您有必填项未填写");
				}
				if ($("#form1").valid()) {
					$.ajax({
						type: "post",
						url: url + '/manager/trade/saveTrade',
						//url: 'http://192.168.1.27:8080/manager/trade/saveTrade',
						data: {
							userId: userid,
							serviceName: productname,
							serviceDistrict: area,
							serviceDetail: detail,
							servicePrice: servicePrice,
							classValueOne: classValueOne,
							classValueTwo: classValueTwo,
							classValueThree: classValueThree,
							serviceUnit: "元/" + tradeunit,
							goodsBrand: goodsBrand,
							shipId: shipId,
							goodsWeight: goodsWeight,
							sumStockNum: sumStockNum,
							tradeClassHeadArrary: typestr,
							servicePictureArray: imgstrarr,
							// tradeSpecParameterArrary: specstrarr,
							tradeSpecParameterArrary: '',
							tradePriceRangeArrary: pricearr,
							tradeSpecGroupArray:_tradeSpecGroupArray,
							tradeSepecStockArray:_tradeSepecStockArray,
							priceRange:_priceRange,
							commodityType:commodityType,//批发为1，零售为2
							// platformPer:platformPer
						},
						dataType: 'json',
						cache: false,
						success: function (re) {
							if(re.success){
								alert("保存成功");
								window.location.href = product
							}else{
								alert("操作失败");
							}
							
						}
					});
				}
			}
		}else{
			layer.open({
				type: 1,
				title: "<div style='text-align:center'><strong>提示</strong></div>",
				content:"<div style=''><div><div style='padding-top:20px;padding-bottom:20px;text-align:center;font-size:18px'>您尚未提交此类目所需的资质证照！！！</div></div><div style='text-align:center;border-bottom:1px solid white;'><div style='margin-top:6%;margin-left:10px;'><a href="+addbusinessUrl+"><button style='color:blue' class='notice delok'>立即添加</button></a><button style='margin-left:15%' class='notice layerclose'>返回</button></div></div></div>",
				skin: 'layer-ext-moon',
				area: ['22%','26%'],
				resize: false,
				shadeClose: true,
				success:function(){
						$(".layerclose").click(function(){
							layer.closeAll();
						})
					}
				});
		}
	}
})
	

}





