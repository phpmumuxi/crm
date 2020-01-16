<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title><?php echo($_SESSION['company'])?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=9;IE=8;IE=7;IE=EDGE">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="description" content=""/>
	<link type="text/css" href="__PUBLIC__/css/bootstrap.min.css?t=20170830" rel="stylesheet" />
	<link type="text/css" href="__PUBLIC__/css/bootstrap-responsive.min.css?t=20170830" rel="stylesheet">
	<link type="text/css" href="__PUBLIC__/css/jquery-ui-1.10.0.custom.css?t=20170830" rel="stylesheet" />
	<link type="text/css" href="__PUBLIC__/css/font-awesome.min.css?t=20170830" rel="stylesheet" />
	<link class="docs" href="__PUBLIC__/css/docs.css?t=20170830" rel="stylesheet"/>
	<link rel="shortcut icon" href="../favicon.ico"/>
    <script type="text/javascript">
        var browserInfo = {browser:"", version: ""};
        var ua = navigator.userAgent.toLowerCase();
        if (window.ActiveXObject) {
            browserInfo.browser = "IE";
            browserInfo.version = ua.match(/msie ([\d.]+)/)[1];
            if(browserInfo.version <= 7){
                if(confirm("您的ie浏览器版本过低，建议使用chorme浏览器")){}
            }
        }
    </script>
	<!--[if lt IE 9]>
	<script src="__PUBLIC__/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<script src="__PUBLIC__/js/jquery-1.9.0.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/jquery-ui-1.10.0.custom.min.js?t=20170830" type="text/javascript"></script>
	<script src="__PUBLIC__/js/WdatePicker.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/gototop.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/5kcrm_zh-cn.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/5kcrm.js" type="text/javascript"></script>
	<!--[if lte IE 6]>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap-ie6.css">
	<![endif]-->
	<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/ie.css">
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link type="text/css" href="__PUBLIC__/css/jquery.ui.1.10.0.ie.css" rel="stylesheet"/>
	<script src="__PUBLIC__/js/ie8-eventlistener.js" type="text/javascript"></script>
	<![endif]-->
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<input type="hidden" id = "manager" manager="<?php echo C('URL')?>">
<div class="navbar navbar-inverse navbar-fixed-top" style="z-index:20000">
	<div class="navbar-inner">
		<div class="container" >
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="<?php echo U('dynamic/index');?>" alt="" style="font-size: 16px;"><?php echo($_SESSION['company']) ?></a>
			<ul class="nav pull-right">
					<?php if($_SESSION['position_id']!= '13'): ?><li class="dropdown" >
							<a href="#" title="<?php echo L('QUICK_ADD');?>" class="dropdown-toggle" data-toggle="dropdown" style="padding: 10px;"><i class="icon-plus"  style="padding: 2px 0px;"></i>  <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php if(is_array($simple)): $i = 0; $__LIST__ = $simple;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["module_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
								<li><a href="<?php echo U('navigation/index','type=simple');?>"><?php echo L('OPTION_SET');?></a></li>
							</ul>
						</li><?php endif; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 3px;line-height:32px"><?php echo (session('name')); ?>&nbsp;
							<img src="<?php echo getLastedImg(); ?>" class="avatar"/>
			            </a>
			            <?php echo W("Navigation",['type'=>1]);?>						
					</li>
			</ul>
		</div>
	</div>
</div>

<div class="navbar container">
	<div class="" style="text-align:center;">
		<div class="container" style="font-size:15px">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo W("Navigation",['type'=>0]);?>
			<?php if(session('position_id') == 1): ?><ul class="nav"><li><a href="<?php echo U('shop/shop');?>">店铺</a></li></ul><?php endif; ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="__PUBLIC__/js/kindeditor-all-min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/zh_CN.js"></script>
<script src="__PUBLIC__/js/PCASClass.js" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.validate.min.js" charset="UTF-8"></script>
<script src="__PUBLIC__/js/layer/layer.js" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/js/messages_zh.js" charset="UTF-8"></script>
<!-- <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script> -->
<!-- <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script> -->
<!-- <link rel="stylesheet" href="__PUBLIC__/css/kindeditor.css" type="text/css" /> -->
 <script type="text/javascript" src="__PUBLIC__/wangEditor/js/wangEditor.min.js" charset="UTF-8"></script> 
<link rel="stylesheet" href="__PUBLIC__/css/jquery.fileupload.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/css/base.css" type="text/css" />
<style type="text/css">
.navbar-fixed-top{
			z-index:20000;		
		}
		
	.basic {
		font-size: 20px;
		font-weight: bold;
		margin-left: 65px;
		margin-bottom: 14px;
	}
	
	.content {
		margin-left: 75px;
		font-size: 17px;
		font-family: 微软雅黑;
	}
	
	.quote {
		border: 1px solid #ccc;
		width: 800px;
	}
	.add_table{
		table-layout:fixed;
	}
	.thum{
		display: inline-block;
		border:0;
		padding:0;
		margin: 10px;
		cursor: pointer;
		position: relative;
	}
	#platform_per::-webkit-input-placeholder{
	 text-align: right;
	 color:black;
	}
	#platform_per::-moz-placeholder{
	 text-align: right;
	 color:black;
	}
	#platform_per:-ms-input-placeholder{
	 text-align: right;
	 color:black;
	}
</style>
<div class="container">	
	<div class="page-header">
		<h4>商品编辑</h4>
	</div>
	<div class="row">
			<input type="hidden" id="product" product="<?php echo U('Product/index',['pagenums' => $pagenums,'commodityType'=>$commodityType]);?>">
		<input type='hidden' id="kcnum"  value="1" />
		<input type='hidden' id="commodityType"  value="<?php echo ($commodityType); ?>" />
		<div class="span12">
		</div>
		<div class="span12">
			<form id="form1" action="" method="post" enctype="multipart/form-data">
				<input type='hidden' name="r" />
				<input type='hidden' name="module" />
				<input type='hidden' name="id" />
				<input type='hidden' id="pagenums" value="<?php echo ($pagenums); ?>" />
				<?php if($_SESSION['position_id']== '17' OR $_SESSION['position_id']== '22'): ?><input type="hidden" id="userid" userId="<?php echo $_SESSION['user_id']?>" />
				<?php elseif($_SESSION['position_id']== '18'): ?>
					<input type="hidden" id="userid" userId="<?php echo $_SESSION['parent_id']?>" />
				<?php else: endif; ?>
				<table class="table" width="95%" border="0" cellspacing="1" cellpadding="0">
					<tbody>
						<tr class="warning">
							<td colspan="4"><img src="__PUBLIC__/img/warning.png"/> 请注意：<span class="checkComment"></span></td>
						</tr>
						<tr>
							<th colspan="4">基本信息</th>
						</tr>
						<tr>
							<td class="tdleft" width="15%"> 产品名称:</td>
							<td width="35%"><input type="text" id="name" name="name" /> &nbsp; <span id="nameTip" style="color:red;"></span></td>
							<td></td>
							<td></td>
							<!-- <td class="tdleft" width="15%">产品型号:</td>
							<td width="35%"><input type="text" id="crm_gnhpxk" name="crm_gnhpxk" /> &nbsp; <span id="crm_gnhpxkTip" style="color:red;"></span></td> -->
						</tr>
						<tr>
							<td class="tdleft" width="15%">产品类别:</td>
							<td width="35%">
								<span id="typename"></span>
								
								<a class="btn btn-primary pull-right" id="#" href="javascript:void(0);" onclick="typelistshow()">
									<i class="icon-plus"></i>&nbsp;&nbsp;选择
								</a>
								</td>

							<td class="tdleft" width="15%">品牌:</td>
							<td width="35%"><input type="text" id="crm_efiily" name="crm_efiily" /> &nbsp; <span id="crm_efiilyTip" style="color:red;"></span></td>
						</tr>
						<tr class="type_content" style="display: none;">
							<td class="tdleft" width="15%"></td>
							<td colspan="3">
								<div id="typelist1">
									加载中，请稍后……
								</div>
								<div id="typelist2"></div>
								<div id="typelist3"></div>
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">产品描述:</td>
							<td colspan="3"><!-- <textarea rows="6" class="span6" id="crm_qmbrki" name="crm_qmbrki"></textarea> -->
							<div id="editor" name="crm_qmbrki"></div>
							<!-- <script id="ueditor" name="crm_qmbrki" type="text/plain" style="width:850px;height:300px;"></script> -->
							<span id="crm_basrhsTip" style="color:red;"></span></td>
						</tr>
						<tr>
							<th colspan="4">产品图片</th>
						</tr>
						<tr>
							<td class="tdleft" height="100">主图</td>
							<td id="mainImgclass" colspan="4">
								<div class="mainThum" id="mainThum" style="display: inline-block;border:0;padding:0;cursor: pointer;">				
															
								</div>
								<div class="thum">				
									<a class="btn btn-primary" onclick="imgOneclick()" >+上传图片</a>	
									<input type="file"  class="upOneImg" onchange="update(this);" style="display:none;">						
								</div>
								<div style="display: inline;">（建议600*600，支持gif,jpg,jpeg,png,bmp格式）</div>
							</td>							
						</tr>
						</tr>
						<tr>
							<td class="tdleft" style="min-height:50">副图</td>
							<td id="imgclass"  colspan="4" >
								<div id="imgList" style="width:700px">
									<div class="thumAdd" style="display: inline-block;border:0;padding:0;cursor: pointer;margin: 10px;position: relative;">				
										<a class="btn btn-primary"  onclick="imgMoreclick()" >+上传图片</a>	
										<input type="file" name="upMoreImg[]" class="upMoreImg" onchange="uploadMoreImg(this);" multiple="true" style="display:none;">
									</div>
									
								</div>
							</td>
											
						</tr>
						<tr>
							<th colspan="4">交易信息</th>
						</tr>						
						<?php if($commodityType == 1): ?><tr>
							<td class="tdleft" width="15%">批量价格：</td>
							<td colspan="3">
								<table class="table add_table" id="price">
									<tbody>
										<tr>
											<th width="25%">起批量</th>
											<th width="15%">产品单价</th>
											<th width="15%">进货价</th>
											<th width="20%">预览</th>
										</tr>
										<tr>
											<td width="25%">起批量：<input type="text" name="minnum_0" class="add_input_text minnum" digits="true" min="0" required /></td>
											<td width="15%" class="td_center">
												<input type="text" class="add_input_text unitprice" name="unitprice_0" number="true" min="0" required/> 元</td>
											<td width="15%" class="td_center">
												<input type="text" class="add_input_text  originalPrice " name="originalPrice_0" number="true" min="0" required/> 元
											</td>
											<td width="20%" class="td_center">
												<sapn class="pronum"> </sapn><span class="price" class="mar-lefts2"> </span>元
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3">
												<a class="btn btn-primary" href="javascript:void(0);" onclick="addprice()">
													<i class="icon-plus"></i>&nbsp;&nbsp;增加价格区间
												</a>
											</td>
										</tr>
									</tfoot>
								</table>

							</td>
						</tr>
						<?php else: ?>
							<tr>
								<td class="tdleft" width="15%">一口价：</td>
								<td>
									<input type="text" id="oldPrice" number="true" min="0" />									
								</td>
							</tr><?php endif; ?>
						<!-- <tr>
							<td class="tdleft" width="15%"> 平台利润分成：</td>
							<td colspan="3"><input type="text" id="platform_per" name="platform_per" placeholder="%"/> &nbsp; <span>(利润分成按照商品售价的百分比收取，平台会把利润分成的50%作为购物领积分赠与下单用户)</span></td>
						</tr> -->
						<tr>
							<td class="tdleft" width="15%">产品规格：</td>
							<td colspan="3">
								<table class="table add_table">
									<tbody>
										<tr>
											<td colspan="3">
												<input type="text" placeholder="输入要添加的规格名称" class="input-medium" id="guige_v" />
												<a class="btn btn-primary" id="guige_add" href="javascript:void(0);" onclick="addguige()">
													<i class="icon-plus"></i>
												</a>
												<span id="guige" style="display: none"></span>
											<span style="color:#999">&nbsp;&nbsp;&nbsp;（输入规格名称，点击添加按钮，进行商品规格的配置）</span>
											</td>
										</tr>
									</tbody>
								</table>

								<table class="table" border="0">
									<tbody id="guige_tab" >									
										
									</tbody>								
								</table>
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">产品销售规格：</td>
							<td colspan="3">
								<p><?php if($commodityType == 2): ?><input type="text"  id="addAllPrice" placeholder="价格" style="width:150px"/>&nbsp;&nbsp;&nbsp;<?php endif; ?><input type="text"  id="addAllGuige" placeholder="库存" style="width:150px"/><a class="btn btn-primary" href="javascript:void(0);" onclick="changeAllGuigeNum()">批量填充</a></p>
								<table class="table add_table">
									<tbody id="guige_num">
										
									</tbody>									
								</table>
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">总库存：</td>
							<td colspan="3"><input type="text" name="total" id="total" class="input-medium" /></td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">计量单位：</td>
							<td colspan="3">
								<select id="crm_fwuzfa" name="crm_fwuzfa" class="input-medium">
									<option value=''>--请选择--</option>
									<option value='个'>个</option>
									<option value='箱'>箱</option>
									<option value='盒'>盒</option>
									<option value='套'>套</option>
									<option value='袋'>袋</option>
									<option value='双'>双</option>
									<option value='件'>件</option>
									<option value='条'>条</option>
									<option value='卷'>卷</option>
									<option value='台'>台</option>
									<option value='支'>支</option>
									<option value='只'>只</option>
									<option value='瓶'>瓶</option>
									<option value='克'>克</option>
									<option value='千克'>千克</option>
									<option value='包'>包</option>
									<option value='升'>升</option>
									<option value='副'>副</option>
									<option value='袋'>袋</option>
									<option value='把'>把</option>
									<option value='本'>本</option>
									<option value='次'>次</option>
									<option value='米'>米</option>
									<option value='吨'>吨</option>
									<option value='顶'>顶</option>
									<option value='批'>批</option>
									<option value='pcs'>pcs</option>
									<option value='天'>天</option>
								</select> &nbsp; <span id="crm_fwuzfaTip" style="color:red;"></span>
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">发货地址:</td>
								<td colspan="3">
								<script type="text/javascript">
									$(function() {
										new PCAS("crm_gepklk['state']", "crm_gepklk['city']", "crm_gepklk['area']", "", "", "");
									});
								</script>
								<select id="province" name="crm_gepklk['state']" class="input-medium" required></select>
								<select id="city" name="crm_gepklk['city']" class="input-medium" required></select>
								<select id="town" name="crm_gepklk['area']" class="input-medium" required></select>
								<!-- <input id="address" type="text" name="crm_gepklk['street']" placeholder="街道信息" class="input-large" required /> -->
								
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">运费设置:</td>
							<td colspan="3">
								<select id="ship">
								</select>
								<!-- <input type="button" onclick="window.open('../index.php?m=product&a=freight')" value="设置运费模板" class="btn btn-success" /> -->
							</td>
						</tr>
						<tr>
							<td class="tdleft" width="15%">单位重量:</td>
							<td colspan="3">
								<input type="text" id="goodsweight" class="add_input_text" number="true" min="0" required /> 公斤
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td style="text-align:center;" colspan="4"><input id="submit" name="submit" onclick="upproduct()" class="btn btn-primary" type="button" value="保存" />&nbsp; <!--<input name="submit" onclick="newadd()" class="btn btn-primary" type="submit" value="保存并新建" /> &nbsp;--><input class="btn" type="button" onclick="history.go(-1)" value="返回" /></td>
						</tr>
					</tfoot>
				</table>
				<div id="delSpecArrary" style="display:none;"></div>
			</form>
		</div>
	</div>
</div>

<div id="mask"></div>
<div class="dialog" style="display:none; ">
	<img src="__PUBLIC__/img/load.gif">正在上传……
</div>
<script type="text/javascript" src="__PUBLIC__/js/uploadPreview.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/produc_edit.js"></script>
<script type="text/javascript">
var positionId ="<?php echo (session('position_id')); ?>";
var userId	="<?php echo (session('user_id')); ?>";
var parentId	="<?php echo (session('parent_id')); ?>";
var companyUserId;
var busCheck = false;
var addbusinessUrl = "<?php echo U('Company/permit');?>";

/**
 * 移除图片div
 */

 function removeImg(a){
	$(a).parent().remove();
}
/**
 * 单图片点击事件
 */
 function imgOneclick(){
	 $(".upOneImg").click(); 
}
 /**
  * 多图片点击事件
  */
  function imgMoreclick(){
 	 $(".upMoreImg").click(); 
 }
/**
 * 规格图片点击事件
 */
 function imgGuigeClick(t){
	 $(t).next().click(); 
}
//规格图片上传
function updateGuige(a) {
	var uri = url + '/manager/trade/uploadImg';
	var img = new FormData();
	var file = $(a)[0].files[0];
	file_name = file.name;
	var extStart=file_name.lastIndexOf("."); 
    var ext=file_name.substring(extStart,file_name.length).toUpperCase(); 
    if(ext!=".jpeg"&&ext!=".jpg"&&ext!=".bmp"&&ext!=".png" &&ext!=".JPEG"&&ext!=".JPG"&&ext!=".BMP"&&ext!=".PNG"){ 
        alert("文件选择错误,图片类型必须是jpeg,jpg,bmp,png中的一种"); 
        return false; 
    }
	file_size = file.size;
    var size = file_size / 1024;
    if (size > 10240) {
      return alert("上传的图片大小不能超过10M！");
    }else{
    	maskshow();
    }
	var xhr = new XMLHttpRequest();
	xhr.open("POST", uri, true);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			var keyval = $.parseJSON(xhr.responseText);				
			$(a).parent().find('.guigeImg').attr('key',keyval.key);
			$(a).parent().find('.guigeImg').attr('src',keyval.keyUrl);
			$(a).parent().find('.guigeImg').parent().attr('href',keyval.keyUrl);
			maskhide();
		}else{
			maskhide();
		}
	};
	img.append('file', file);
	xhr.send(img);
}
/*
 *单张图上传
 */
  function update(a) {
		var uri = url + '/manager/trade/uploadImg';
		var img = new FormData();
		var file = $(a)[0].files[0];
		file_size = file.size;
		file_name = file.name;
		var extStart=file_name.lastIndexOf("."); 
        var ext=file_name.substring(extStart,file_name.length).toUpperCase(); 
        if(ext!=".jpeg"&&ext!=".jpg"&&ext!=".bmp"&&ext!=".png" &&ext!=".JPEG"&&ext!=".JPG"&&ext!=".BMP"&&ext!=".PNG"){ 
            alert("文件选择错误,图片类型必须是jpeg,jpg,bmp,png中的一种"); 
            return false; 
        }
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
				var imgtxt = '<a href="'+keyval.keyUrl+'"><img style="margin-left:20px;width:100px;height:100px"  key="'+keyval.key+'" src="'+keyval.keyUrl+'"  /></a>';
				button.html(imgtxt);
				alert("图片上传成功");
				maskhide();
			}else{
				maskhide();
			}
		};
		var button = $('#mainThum');
		img.append('file', file);
		xhr.send(img);
	}
 /*
  * 上传图片
  */
 function uploadMoreImg(a) {
 	var uri =url+'/manager/trade/newBatchUploadImgs';
 	console.log($(a)[0]);
 		var file = $(a)[0].files;
 		console.log(file);
 		var img = new FormData();
 		for(var i=0;i<file.length;i++){
 			file_size = file[i].size;
 		    var size = file_size / 1024;
 		   		file_name = file[i].name;
 			var extStart=file_name.lastIndexOf("."); 
 	        var ext=file_name.substring(extStart,file_name.length).toUpperCase(); 
 	        if(ext!=".jpeg"&&ext!=".jpg"&&ext!=".bmp"&&ext!=".png" &&ext!=".JPEG"&&ext!=".JPG"&&ext!=".BMP"&&ext!=".PNG"){ 
 	            alert("文件选择错误,图片类型必须是jpeg,jpg,bmp,png中的一种"); 
 	            return false; 
 	        }
 		    if (size > 10240) {
 		      return alert("上传的图片大小不能超过10M！");
 		    }else{
 		    	if(size < 10){
 		    		 return alert("图片太小！");
 		    	}else{
 		    		img.append("files", file[i]);
 		    		maskshow();
 		    	}
 		    }
 		}

 		var xhr = new XMLHttpRequest();
 		xhr.open("POST", uri, true);
 		xhr.onreadystatechange = function() {
 			if(xhr.readyState == 4 && xhr.status == 200) {
 				var keyval = $.parseJSON(xhr.responseText);
 				console.log(keyval['keyList']);console.log(keyval['keyList'][0].imageKey);
 				for(var j=0;j < keyval['keyList'].length;j++){
 					var imgdiv = '<div class="thum"  >'	+		
 					'<img key="'+keyval['keyList'][j].imageKey+'" style="width:100px;height:100px;" src="'+keyval['keyList'][j].imageUrl+'" class="" />' +
 					'<div  onclick="removeImg(this)" class="removediv" style="width: 10px;color:red;position: absolute;top:0;right:0;cursor: pointer;font-size:15px;">X</div>'+				
 					'</div>';
 					$(a).parent().before(imgdiv);
 				}
 				maskhide();
 			}else{
 				maskhide();
 			}
 		};
 		xhr.send(img);
 		
 	
 }

	 var E = window.wangEditor
	    var editor = new E('#editor')
	 
	 
	  editor.customConfig.uploadImgServer = '<?php echo (C("YIGUANJIACLUB")); ?>:8002/manager/trade/batchUploadImg';//批量
	   ////editor.customConfig.uploadImgServer = 'http://yiguanjiaclub.org:8002/manager/trade/uploadImg';//单个
	    editor.customConfig.uploadFileName = 'files';
	    editor.customConfig.uploadImgMaxLength = 500;
	    editor.customConfig.uploadImgTimeout = 100000;
		editor.customConfig.uploadImgHooks = {
		    before: function (xhr, editor, files) {
		        // 图片上传之前触发
		        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件
		        
		        // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
		        // return {
		        //     prevent: true,
		        //     msg: '放弃上传'
		        // }
		    },
		    success: function (xhr, editor, result) {
		        // 图片上传并返回结果，图片插入成功之后触发
		        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
		    },
		    fail: function (xhr, editor, result) {
		    	var a = 1;
		        // 图片上传并返回结果，但图片插入错误时触发
		        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
		    },
		    error: function (xhr, editor) {
		    	var a = 1;
		        // 图片上传出错时触发
		        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
		    },
		    timeout: function (xhr, editor) {
		        // 图片上传超时时触发
		        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
		    },
		
		    // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
		    // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
		    customInsert: function (insertImg, result, editor) {
		        // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
		        // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果
			//insertImg(result.keyUrl);
		        // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
		        
		    	  var urlList = result.keyList;
			        for(var i=0; i < urlList.length;i++){
			        	insertImg(urlList[i]);
			        } 
			        
			        
		        // result 必须是一个 JSON 格式字符串！！！否则报错
		    }
		 	}
	    editor.create();
	    
	     function getContent() {
	    	 var content = editor.txt.html();
	    	 // console.log(content);
	        return content;
    }
</script>
</body>

</html>