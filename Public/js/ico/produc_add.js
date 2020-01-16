//产品页面通用JS

//产品页面表单验证
$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	$("#form1").validate({
		//onsubmit:false,
		rules: {
			name: "required",
			crm_gnhpxk: "required",
			crm_efiily: "required",
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
			crm_gnhpxk: "请输入产品编号",
			crm_efiily: "请输入产品品牌",
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
		url: "http://192.168.1.209:7001/manager/syncAccount/getCategoryTree",
		data: {
			level: lv,
			value: val
		},
		dataType: 'json',
		cache: false,
		success: function(data) {
			console.log(data)
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

//规格新增
var ggnum = 0;

function addguige() {
	var guige = $("#guige_v").val();
	var str;
	str = guige + '；'
	var foot = '<tr><td colspan="4">供应总量：<input type="button" class="btn btn-success" onclick="num()" value="计算总量" />' +
		'<input type="text" class="input-small mar-left2" id="total" readonly="readonly" /> </td></tr>';

	if(guige != "") {
		$("#guige").append(str);
		$("#guige_tab").show();
		$("#guige_foot").html(foot);
		var tab = '<tr><td width="10%" class="td_center"><input type="checkbox" class="kccheck" /></td><td width="40%">' + guige + '</td>' +
			'<td width="50%" class="td_center"><input name="kc_' + ggnum + '" type="text" class="add_input_text" digits="true" min="0" /></td></tr>'
		$("#guige_tab").append(tab);
		ggnum++;
	}
	$("#guige_v").val("");
}

//价格区间展示
$("#price").on("change", ".minnum", function() {
	var minnum = $(this).val();
	$(this).parent().next().next().children(".pronum").html(minnum)
})

$("#price").on("change", ".unitprice", function() {
	var price = $(this).val();
	$(this).parent().next().children(".price").html(price)
})

//增加价格区间
var jgnum = 1;

function addprice() {

	var pricestr = '<tr><td width="30%">起批量：<input type="text" name="minnum_' + jgnum + '" class="add_input_text minnum" digits="true" min="0" required /></td><td width="30%" class="td_center">' +
		'<input type="text" class="add_input_text unitprice" name="unitprice_' + jgnum + '" number="true" min="0" required /> 元</td><td width="40%" class="td_center">' +
		'<sapn class="pronum"> </sapn>个以上 <span class="price" class="mar-lefts2"> </span>元 <a class="btn btn-warning removeprice"><span>删除</span></a></td></tr>'

	$("#price>tbody").append(pricestr);
	jgnum++;

};
//删除价格区间
$("#price").on("click", ".removeprice", function() {
	console.log($(this).parent().parent());
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
				tol += Number(kc);
				var specitem = '{"specName":"' + kctext + '", "specStockNum":' + kc + '}'
				specstr.push(specitem);
			}
			//console.log($(val).context.checked);
		}
	);
	$("#total").val(tol);
}

//图片上传
$(document).on("change", "input[type=file]", update);

function update() {
	$("#submit").attr("disabled", "disabled");
	var uri = "http://192.168.1.209:7001/manager/trade/uploadImg";
	var xhr = new XMLHttpRequest();
	var img = new FormData();
	xhr.open("POST", uri, true);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			var keyval = $.parseJSON(xhr.responseText);
			button.attr("key", keyval.key);
			alert("图片上传成功");
			$("#submit").removeAttr("disabled");
			//console.log(keyval.key)
			//alert(xhr.responseText); 
		}
	};
	//          var file = document.getElementById("file").files[0];
	var file = $(this)[0].files[0];
	var button = $(this);
	img.append('file', file);
	xhr.send(img);
}

//运费查询
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: "http://192.168.1.209:7001/manager/template/queryTradeShipTemplate",
		data: {
			sid: $("#userid").attr("userId")
		},
		dataType: 'json',
		cache: false,
		success: function(data) {
			if(data.code == 2000) {
				console.log(data);
				var obj = data.data;
				var tempstr;
				if(obj == null) {
					$("#ship").attr("disabled", "disabled");
					tempstr = '<option>无运费模板</option>'
				} else {
					for(i = 0; i < obj.length; i++) {
						var tempname = obj[i].templateName;
						var tempid = obj[i].sid;
						tempstr += '<option value="' + tempid + '">' + tempname + '</option>'
					}
				}
				$("#ship").append(tempstr);

			}
		}
	});
})

//表单提交
function addproduct() {
	var specstrarr;
	if($("#guige").text().indexOf('；') >= 0) {
		num();
		specstrarr = '[' + specstr.toString() + ']';
	}

	console.log($("#form1").valid());
	var userid = $("#userid").attr("userId");
	var productname = $("#name").val();
	var area = $("#province").val() + "-" + $("#city").val() + "-" + $("#town").val();
	var address = $("#address").val();
	var detail = $("#crm_qmbrki").val();
	var tradearr = [];
	$(".minnum").each(
		function() {
			var price = $(this).parent().next().children(".unitprice").val();
			var item = {
				"minBuyNum": $(this).val(),
				"price": price
			};
			tradearr.push(item);
		}
	);

	var servicePrice = tradearr[0].price;
	var type = $("#typename");
	var classValueOne = type.attr("data-lv1-value");
	var classValueTwo = type.attr("data-lv2-value");
	var classValueThree;
	if (type.attr("data-level")==2) {
		classValueThree = type.attr("data-lv2-value");
	} else{
		classValueThree = type.attr("data-lv3-value");
	}
	
	var goodsModel = $("#crm_gnhpxk").val();
	var goodsBrand = $("#crm_efiily").val();
	var tradeunit = $("#crm_fwuzfa").val();
	var shipId = $("#ship").val();
	var goodsWeight = $("#goodsweight").val();
	var sumStockNum = $("#total").val();
	var typestr;
	if(type.attr("data-level") == 3) {
		typestr = '[{"value":"' + type.attr("data-lv1-value") + '","text":"' + type.attr("data-lv1-name") + '","level":"1","parentCatCode":"","hasChild":"1","catStatus":"1"},' +
			'{"value":"' + type.attr("data-lv2-value") + '","text":"' + type.attr("data-lv2-name") + '","level":"2","parentCatCode":"' + type.attr("data-lv1-value") + '","hasChild":"1","catStatus":"1"},' +
			'{"value":"' + type.attr("data-lv3-value") + '","text":"' + type.attr("data-lv3-name") + '","level":"3","parentCatCode":"' + type.attr("data-lv2-value") + '","hasChild":"0","catStatus":"1"}]'
	} else if(type.attr("data-level") == 2) {
		typestr = '[{"value":"' + type.attr("data-lv1-value") + '","text":"' + type.attr("data-lv1-name") + '","level":"1","parentCatCode":"","hasChild":"1","catStatus":"1"},' +
			'{"value":"' + type.attr("data-lv2-value") + '","text":"' + type.attr("data-lv2-name") + '","level":"2","parentCatCode":"' + type.attr("data-lv1-value") + '","hasChild":"0","catStatus":"1"}]'
	}
	var imgstr = [];
	$.each($("input:file"), function(i, val) {
		var imgitem;
		if(i == 0) {
			imgitem = '{"picServiceUrl": "' + $(this).attr("key") + '","mainPage": "1"}';
			imgstr.push(imgitem);
		} else {
			imgitem = '{"picServiceUrl": "' + $(this).attr("key") + '","mainPage": "0"}';
			imgstr.push(imgitem);
		}
	});
	var tradePriceArrary = [];
	for(i = 0; i < tradearr.length; i++) {
		if(i < tradearr.length - 1) {
			var priceitem = '{"minBuyNum": ' + tradearr[i].minBuyNum + ',"maxBuyNum": ' + tradearr[i + 1].minBuyNum + ',"price": ' + tradearr[i].price + ',"unit": "' + tradeunit + '","number":"' + i + '"}';
			tradePriceArrary.push(priceitem);
		} else {
			var priceitem = '{"minBuyNum": ' + tradearr[i].minBuyNum + ',"maxBuyNum":0,"price": ' + tradearr[i].price + ',"unit": "' + tradeunit + '","number":"' + i + '"}';
			tradePriceArrary.push(priceitem);
		}

	}

	var imgstrarr = '[' + imgstr.toString() + ']';

	var pricearr = '[' + tradePriceArrary.toString() + ']';
	console.log(type.html() == "");
	if(type.html() == "") {
		alert("请选择产品类别")
	} else {
		if($("#form1").valid()) {
			$.ajax({
				type: "post",
				url: "http://192.168.1.209:7001/manager/trade/saveTrade",
				data: {
					userId: userid,
					serviceName: productname,
					serviceDistrict: area,
					address: address,
					serviceDetail: detail,
					servicePrice: servicePrice,
					classValueOne: classValueOne,
					classValueTwo: classValueTwo,
					classValueThree: classValueThree,
					goodsModel: goodsModel,
					goodsBrand: goodsBrand,
					shipId: shipId,
					goodsWeight: goodsWeight,
					sumStockNum: sumStockNum,
					tradeClassHeadArrary: typestr,
					servicePictureArray: imgstrarr,
					tradeSpecParameterArrary: specstrarr,
					tradePriceRangeArrary: pricearr
				},
				dataType: 'json',
				cache: false,
				success: function() {
					alert("保存成功");
					window.location.href = 'crm/209/index.php?m=product'
				}
			});
		}
	}

}

