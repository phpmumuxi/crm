//产品页面通用JS
var url = $("#manager").attr('manager');
var product = $("#product").attr("product");

function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) return unescape(r[2]);
	return null;
}

var sid = getQueryString("sid");
var shipval;

//运费查询
// function getship() {
// 	$.ajax({
// 		type: "post",
// 		url: '' + url + '/manager/community/getShopFee',
// 		data: {
// 			userId: $("#userid").attr("userId")
// 		},
// 		dataType: 'json',
// 		cache: false,
// 		success: function(data) {
// 			//console.log(data);
// 			if(data.code == 2000) {		
// 				var obj = data.data;
// 				if(obj.fee == 0) {
// 					$("input:radio[name='free']").eq(0).attr("checked",'checked');
// 				} else {
// 					$("input:radio[name='free']").eq(1).attr("checked",'checked');
// 				}
// 			}
// 		}
// 	});
// }

//产品编辑页初始化
$(document).ready(function() {
	$.ajax({
		type: "post",
		url: url + '/manager/serviceGoods/getGoodsBase',
		async: true,
		data: {
			sid: sid,
			module:'community_goods_extend'
		},
		dataType: "json",
		cache: false,
		success: function(data) {
			//console.log(data);
			if(data.code == 2000) {
				var trade = data.data.resultMap;
				//console.log(trade);
				// ue.addListener("ready", function () {
		  //       // editor准备好之后才可以使用
		  //       	console.log(trade.serviceDetail);
		  //       	ue.setContent(trade.serviceDetail);

		  //       });
//				ue.ready( function (editor) { 
//					ue.setContent(trade.serviceDetail);
//				});  

				editor.txt.html(trade.serviceDetail);
				if (trade.checkComment!==null&&trade.checkComment!=="") {
					$(".warning").show();
					$(".warning .checkComment").text(trade.checkComment);
				}
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
				$("#name").val(trade.serviceName);
				$("#crm_gnhpxk").val(trade.goodsModel);
				$("#crm_efiily").val(trade.goodsBrand);
				$("#typename").text(goodsName);

		        //是否设置配送费
		        if(data.data.resultMap.isFreight == 0){
		        	$("input:radio[name='free']").eq(0).attr("checked",'checked');
		        }else{
		        	$("input:radio[name='free']").eq(1).attr("checked",'checked');
		        }
				$("#crm_fwuzfa").val(trade.goodsUnit);
				if(trade.specList.length > 1){
					$('.shopprice').hide();
				}else{
					$('.servicePrice').val(trade.servicePrice);
				}
				
				$("#total").val(trade.stockNum);
				//console.log(trade.discount);
				$(".discount").val(parseFloat(trade.discount)*1000/100);
				shipval = trade.shipId;

				//图片初始化
				seq_item = 1;
				//console.log(data.data.picList);
				$.each(data.data.picList, function(index, val) {
					if($(this)[0].mainPage) {
						$("#main_pic_prev").attr("src", $(this)[0].realPicUrl);
						$("#main_pic").attr("key", $(this)[0].picServiceUrl);
					} else {
						var add_file_html = '';
						add_file_html += '<table  id="tables_files_' + seq_item + '" class="table table-striped">';
						add_file_html += '<tbody class="files">';
						add_file_html += '<tr class="template-upload fade in">';
						add_file_html += '<td width="20%">';
						add_file_html += '<div class="thumbnail thumb80">';
						add_file_html += '<img id="sec_pic_' + seq_item + '_prev" class="thumb80" src="' + $(this)[0].realPicUrl + '"/>';
						add_file_html += '</div>';
						add_file_html += '</td>';
						// add_file_html += '<td width="35%">';
						// add_file_html += '<p><span id="sec_pic_' + seq_item + '_prev_name">无</span></p>';
						// add_file_html += '</td>';
						// add_file_html += '<td width="25%">';
						// add_file_html += '<p><span id="sec_pic_' + seq_item + '_prev_size">0</span> KB</p>';
						// add_file_html += '</td>';
						add_file_html += '<td width="3%">';
						add_file_html += '<div class="btn btn-success fileinput-button">';
						add_file_html += '<span>选择文件</span>';
						add_file_html += '<input type="file" name="sec_pic[]" id="sec_pic_' + seq_item + '" key="' + $(this)[0].picServiceUrl + '">';
						add_file_html += '</div>&nbsp;';
						add_file_html += '<a class="btn btn-warning fileinput-button btn_reduce_files">';
						add_file_html += '<span>取消</span>';
						add_file_html += '</a>';
						add_file_html += '</td>';
						add_file_html += '</tr>';
						add_file_html += '</tbody>';
						add_file_html += '</table>';
						$('.div_add').before(add_file_html);
						seq_item++;
					}

				});


				//规格初始化
				if(trade.specList.length == 0) {
					$("#total").val(trade.stockNum)
				} else {
					var foot = '<tr><td colspan="4">供应总量：<input type="button" class="btn btn-success" onclick="num()" value="计算总量" />' +
						'<input type="text" class="input-small mar-left2" id="total" readonly="readonly" /> </td></tr>';
					$("#guige_tab").show();
					$("#guige_foot").html(foot);
					$.each(trade.specList, function(index, val) {
						var tab = '<tr><td width="10%" class="td_center"><input type="checkbox" class="kccheck" checked /></td><td width="40%">' + $(this)[0].communitySpec + '</td>' +
							'<td width="50%" class="td_center"><input name="pr_' + ggnum + '" type="text" class="add_input_text"  min="0" value="' + $(this)[0].communityPrice + '" /></td><td><input name="kc_' + ggnum + '" type="text" class="add_input_text" digits="true" min="0" value="' + $(this)[0].communityStock + '" /></td><td><a class="btn btn-warning removeguige"><span>删除</span></a></td></tr>'
						$("#guige_tab").append(tab);
						$("#guige").append($(this)[0].communitySpec + "；");
						$("#total").val(trade.stockNum);
						ggnum++;
					});
				}
			}
		}
	});
})



//产品页面表单验证
$().ready(function() {
	// 在键盘按下并释放及提交后验证提交表单
	$("#form1").validate({
		//onsubmit:false,
		//去除输入框空格
		onkeyup: function(element, event) {
            //去除左侧空格
            var value = this.elementValue(element).replace(/^\s+/g,"");
            $(element).val(value);
        },
		rules: {
			crm_name: "required",
			crm_gnhpxk: "required",
			ueditor: {
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
			ueditor: {
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
var ggarr = $("#guige").html().split("；");
function addguige() {
	var guige = $("#guige_v").val();
	var str;
	str = guige + '；';
	var foot = '<tr><td colspan="4">供应总量：<input type="button" class="btn btn-success" onclick="num()" value="计算总量" />' +
		'<input type="text" class="input-small mar-left2" id="total" readonly="readonly" /> </td></tr>';

	if(guige != "") {
		if(jQuery.inArray(guige, ggarr) < 0) {
			$('.shopprice').hide();
			$("#guige").append(str);
			$("#guige_tab").show();
			$("#guige_foot").html(foot);
			var tab = '<tr><td width="10%" class="td_center"><input type="checkbox" class="kccheck" /></td><td width="20%">' + guige + '</td>' +
				'<td width="30%" class="td_center"><input name="pr_' + ggnum + '" type="text" value=""></td>'+
				'<td width="30%" class="td_center"><input name="kc_' + ggnum + '" type="text" class="add_input_text" digits="true" min="0" /></td><td><a class="btn btn-warning removeguige"><span>删除</span></a></td></tr>';
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
	ggarr = $("#guige").html().split("；");
	//console.log(ggarr);
	var ggdel= $(this).parent().prev().prev().prev().html();
	$("#delSpecArrary").append('<span>'+ggdel+'</span>');
	//console.log(ggdel);
	var ggindex=jQuery.inArray(ggdel, ggarr);
	ggarr.splice(ggindex,1);
	$("#guige").html(ggarr.join("；"));	
	var foot = '<tr><td colspan="4">供应总量：' +'<input type="text" class="input-small mar-left2" id="total"/> </td></tr>';
	//var shopprice = '<td class="tdleft" width="15%">商品单价:</td>'+'<td colspan="3">'+'<input type="text" class="add_input_text unitprice servicePrice" name="unitprice_0" number="true" min="0" required/> 元</td>';	
	//console.log(ggarr.length)
	if(ggarr.length == 1){
		//console.log(shopprice);
		$('.shopprice').show();
		$('#guige_tab').hide();
		$("#guige_foot").html(foot);
	}
	//console.log(ggarr)
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
			alert("图片上传成功");
			maskhide();
//			$("#submit").removeAttr("disabled");
			//console.log(keyval.key)
			//alert(xhr.responseText); 
		}else{
			maskhide();
		}
	};
	//          var file = document.getElementById("file").files[0];
	//var file = $(this)[0].files[0];
	var button = $(this);
	img.append('file', file);
	xhr.send(img);
}

//表单提交
function upproduct() {

	var specstrarr;
	if($("#guige").text().indexOf('；') > 0) {
		num();
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

	var userid = $("#userid").attr("userId");
	var productname = $("#name").val();
	var detail = getContent();
/*	if(detail.length > 4000){
		alert('商品描述的字数超出最大限制!');
		return false;
	}*/
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
	// console.log(discount);return;
	var free = $("input[name='free']:checked").val();
	if(free == ''){
		alert('请选择是否有配送费!');
		return false;
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

	var imgstrarr = '[' + imgstr.toString() + ']';
	//删除spec
	var delSpecArrary = [];
	$("#delSpecArrary span").each(function(){
		var specvalue = $(this).html();
		var delspec ='{"specName":"'+specvalue+'"}';
		delSpecArrary.push(delspec);
	});
	delSpecArrary = '['+delSpecArrary+']';
	//console.log(imgstrarr);
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
	}else{
		if( goodsBrand=="" ){
			alert("您有必填项未填写");
			var branderror = $("#crm_efiily").next().attr("class");
			if(branderror == "branderror"){
				return;
			}else{
				$("<label class='branderror' style='color:red'>请输入品牌信息</label>").insertAfter("#crm_efiily");
				
			}
			return;
			
		}
		
		if(productname=="" || goodsModel==""  ){
			alert("您有必填项未填写");
		}
		
		
		if($("#form1").valid()) {
			var index = layer.load(1, {shade: [0.1,'#fff']});
			$.ajax({
				type: "post",
				url: url + '/manager/community/updateCommunity',
				//url: "http://192.168.1.27:8080/manager/community/updateCommunity",
				data: {
					serviceId: sid,
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
					isFreight:free,
					delSpecArrary:delSpecArrary  //新增已删除
				},
				dataType: 'json',
				cache: false,
				success: function(data){
					console.log(data);
					if(data.code == '2000'){
						layer.closeAll('loading');
						window.location.href = product
					}else{
						layer.closeAll('loading');
						alert(data.message);
					}
				},
				error:function(data){
					//console.log(data);
				}
			});
		}
	}
}
