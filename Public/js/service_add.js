//产品页面通用JS
var url = $("#manager").attr('manager');
var product = $("#product").attr("product");
//产品页面表单验证
$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	$("#form1").validate({
		//onsubmit:false,
		onkeyup: function(element, event) {
            //去除左侧空格
            var value = this.elementValue(element).replace(/^\s+/g, "");
            $(element).val(value);
        },
		rules: {
			crm_name: "required",
			crm_gnhpxk: "required",
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
			name: "请输入商品名称",
			crm_gnhpxk: "请输入商品型号",
			crm_qmbrki: {
				required: "请输入商品描述",
				minlength: "商品描述不能小于 15 个字"
			},
			total: "请输入正确的供应总量"
		}

	});
});


//社区分类
function typeList(){
	$.ajax({
		type: "POST",
		url: url + '/manager/community/getCommunityType',
		data: {},
		dataType: 'json',
		cache: false,
		success: function(data) {
			//console.log(data)
			if(code = "2000") {
				var first = data.data;
				first.pop()	
				var str1 = '';
				for(k = 0; k < first.length; k++) {

					var text1 = first[k].text;
					var value1 = first[k].value;
					str1 += '<li class="typeli" data-text="' + text1 + '" data-value="' + value1 + '" data-level="' + first[k].level + '" data-haschild="' + first[k].hasChild + '" >' + text1 + '</li>'
				}
				$("#typelist1").html(str1);
			}
		}
	});
}

//分类确认
$(".type_content").on("click", ".typeli", function() {
	//console.log($(this).attr('data-value'));
	$('#typename').html($(this).html());
	$("#typename").attr({
			"value": $(this).attr('data-value'),
			"name": $(this).html(),
	})
	
});

//产品分类展示
function typelistshow() {
	$(".type_content").toggle();
	typeList(1, 'main');
}

//规格新增
var ggnum = 0;
var ggarr;
function addguige() {
	var guige = $("#guige_v").val();
	var str;
	str = guige + '；';
	var foot = '<tr><td colspan="4">供应总量：<input type="button" class="btn btn-success" onclick="num()" value="计算总量" />' +
		'<input type="text" class="input-small mar-left2" id="total" readonly="readonly" /> </td></tr>';

	if(guige != "") {
		$('.shopprice').hide();
		if(jQuery.inArray(guige, ggarr) < 0) {
			$("#guige").append(str);
			$("#guige_tab").show();
			$("#guige_foot").html(foot);
			var tab = '<tr><td width="10%" class="td_center"><input type="checkbox" class="kccheck" /></td><td width="20%">' + guige + '</td>' +
				'<td width="30%" class="td_center"><input name="pr_' + ggnum + '" type="text" value=""></td>'+
				'<td width="40%" class="td_center"><input name="kc_' + ggnum + '" type="text" class="add_input_text" digits="true" min="0" /><a class="btn btn-warning removeguige"><span>删除</span></a></td></tr>';
			$("#guige_tab").append(tab);
			ggnum++;
		} else {
			alert("请不要重复输入规格")
		}
	}
	ggarr = $("#guige").html().split("；");
	$("#guige_v").val("");

}
//删除规格
$("#guige_tab").on("click", ".removeguige", function() {
	var ggdel= $(this).parent().prev().prev().html();
	var ggindex=jQuery.inArray(ggdel, ggarr);
	ggarr.splice(ggindex,1);
	$("#guige").html(ggarr.join("；"));
	var foot = '<tr><td colspan="4">供应总量：' +'<input type="text" class="input-small mar-left2" id="total"/> </td></tr>';	
	//console.log(ggarr.length)
	if(ggarr.length == 1){
		$('.shopprice').show();
		$('#guige_tab').hide();
		$("#guige_foot").html(foot);
	}
	$(this).parent().parent().remove();
});



//计算总量
var specstr; //库存数组
var price = [];
function num() {
	specstr = [];
	var tol = 0;
	$(".kccheck").each(
		function(index, val) {
			if($(val).context.checked) {
				var kc = $(val).parent().next().next().next().children("input").val();
				var pr = $(val).parent().next().next().children("input").val();
				price.push(pr);
				var kctext = $(val).parent().next().text();
				if(Number(kc) <= 0 || Number(kc) == ""){
					$("#kcnum").val(0);
					return ;
				}
				$("#kcnum").val(1);
				tol += Number(kc);
				var specitem = '{"communitySpec":"' + kctext + '","communityPrice":"' + pr + '", "communityStock":' + kc + '}';
				specstr.push(specitem);
			}
			//console.log($(val).context.checked);
		}
	);
	$("#total").val(tol);
}


//图片上传
$(document).on("change", "input[type=file]", update);
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

function update() {
	//maskshow();
//	$("#submit").attr("disabled", "disabled");
	var uri = url + '/manager/trade/uploadImg';
	var img = new FormData();
	var file = $(this)[0].files[0];
	file_size = file.size;
    var size = file_size / 1024;
    if (size > 10240) {
      return alert("上传的图片大小不能超过10M！");
    }else{
    	maskshow();
    }
	var xhr = new XMLHttpRequest();
	//var img = new FormData();
	xhr.open("POST", uri, true);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			var keyval = $.parseJSON(xhr.responseText);
			button.attr("key", keyval.key);
			//console.log(keyval.key);
			alert("图片上传成功");
			maskhide();
			//$("#submit").removeAttr("disabled");
			//console.log(keyval.key)
			//alert(xhr.responseText); 
		}else{
			maskhide();
		}
	};
	//var file = document.getElementById("file").files[0];
	//var file = $(this)[0].files[0];
	var button = $(this);
	img.append('file', file);
	xhr.send(img);
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
				//console.log(obj);
				var tempstr;
				if(obj == null) {
					$("#ship").attr("disabled", "disabled");
					tempstr = '<option>无运费模板</option>'
				} else {
					for(i = 0; i < obj.length; i++) {
						if (obj[i].infoList) {
							var tempname = obj[i].templateName;
							var tempid = obj[i].sid;
							tempstr += '<option value="' + tempid + '">' + tempname + '</option>'
						};
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
		num()
		specstrarr = '[' + specstr.toString() + ']';
	}
	if($("#kcnum").val() == 0){
		alert("规格库存不能为空");
		return;
	}
	if(price.length){
		var servicePrice = (Math.min.apply(null, price));
	}else{
		var servicePrice = $('.servicePrice').val();
	}
	// console.log(specstrarr);
	//console.log($("#form1").valid());
	var userid = $("#userid").attr("userId");
	var productname = $("#name").val();
	var detail = getContent();
	//console.log(detail);return;
	if(detail.length > 4000){
		alert('商品描述的字数超出最大限制!');
		return false;
	}
	var goodsModel = $("#crm_gnhpxk").val();
	var goodsBrand = $("#crm_efiily").val();
	var tradeunit = $("#crm_fwuzfa").val();
	var sumStockNum = $("#total").val();
	var typestr = $('#typename').html();
	var goodsType = $('#typename').attr('value');
	var tradeClassHeadArrary = '[{"value":"' + goodsType + '","text":"' + typestr + '"}]';
	var type = $("#typename");

	var discount = parseFloat(parseFloat($('.discount').val()*1000)/10000);

	if(discount > 1){
		alert('请输入正确折扣');
		return false;
	}else if(discount == ''){
		discount = 1;
	}
	//console.log(discount);return;
	var imgstr = [];
	var isFreight = $("input[name='free']:checked").val();
	if(isFreight == ''){
		alert('请选择是否有配送费!');
		return false;
	}
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
	//console.log(imgstr.length);return false;
	var imgstrarr = '[' + imgstr.toString() + ']';
	if(type.html() == "") {
		alert("请选择商品类目")
	}else if(imgstr.length < 3){
		alert('图片至少上传三张');
	}else if(imgstr.length > 6){
		alert('图片最多上传六张');
	}else if(detail == ""){
		alert('请填写商品详情信息');
	}else if(tradeunit==""){
		alert("请选择计量单位")
	}else {
		if(productname=="" || goodsModel=="" ||  goodsBrand=="" ){
			alert("您有必填项未填写");
		}
		if($("#form1").valid()) {
			$.ajax({
				type: "post",
				url: url + '/manager/community/saveCommunity',
				data: {
					userId: userid,
					serviceName: productname,
					serviceDetail: detail,
					servicePrice: servicePrice,
					serviceUnit:"元",
					goodsUnit: tradeunit,
					goodsModel: goodsModel,
					goodsBrand: goodsBrand,
					sumStockNum: sumStockNum,
					tradeClassHeadArrary: tradeClassHeadArrary,
					goodsType:goodsType,
					servicePictureArray: imgstrarr,
					specArray: specstrarr,
					discount:discount,
					isFreight:isFreight
				},
				dataType: 'json',
				cache: false,
				success: function(data) {
					//console.log(data);
					if(data.code == '2000'){
						window.location.href = product
					}else{
						alert(data.message);
					}
				}
			});
		}
	}
}
