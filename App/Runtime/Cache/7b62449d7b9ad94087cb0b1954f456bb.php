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
<style>
	#form_container td {border:0px solid #a1bcdb; word-break:break-all; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; -o-text-overflow:ellipsis; }
</style>
<link href="__PUBLIC__/css/litebox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="__PUBLIC__/css/base.css" type="text/css" />
<script src="__PUBLIC__/js/PCASClass.js" type="text/javascript"></script>
<div class="container">
	<div class="page-header" style="border:none; font-size:14px;">
		<ul class="nav nav-tabs">
			<?php if($_SESSION['position_id']== '19' OR $_SESSION['position_id']== '20' OR $_SESSION['position_id']== '16'): ?><li class="active"><a  href="<?php echo U('product/index');?>"><img src="__PUBLIC__/img/caigou.png"/>&nbsp;服务</a></li>
				<?php else: ?>
			<li class="active"><a  href="<?php echo U('product/index');?>"><img src="__PUBLIC__/img/caigou.png"/>&nbsp;产品</a></li><?php endif; ?>
			<?php if(in_array(($_SESSION['position_id']), explode(',',"1,13"))): else: ?>
			<li class=""><a href="<?php echo U('product/analytics');?>"><img src="__PUBLIC__/img/tongji.png"/> &nbsp;统计</a></li><?php endif; ?>
			<?php if(session('position_id') == 19 || session('position_id') == 20 || session('position_id') == 16 || session('position_id') == 14): ?><li class=""><a href="<?php echo U('product/manager');?>"><img src="__PUBLIC__/img/tongji.png"/> &nbsp;优惠打折</a></li><?php endif; ?>
		</ul>
		<input type="hidden" id="position_id" position_id="<?php echo session('position_id')?>" />
		<?php if($_SESSION['position_id']== '13' OR $_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '16' OR $_SESSION['position_id']== '1'): ?><input type="hidden" id="userid" userId="<?php echo getuserid();?>"/>
			<?php elseif($_SESSION['position_id']== '17' OR $_SESSION['position_id']== '19' OR $_SESSION['position_id']== '' OR $_SESSION['position_id']== '22'): ?>
			<input type="hidden" id="userid" userId="<?php echo $_SESSION['user_id']?>" />
			<?php else: ?>
			<input type="hidden" id="userid" userId="<?php echo $_SESSION['parent_id']?>" /><?php endif; ?>
	
		<input type="hidden" id="view" view="<?php echo U('Product/view?sid=');?>">
		<input type="hidden" id="edit" edit="<?php echo U('Product/edit?sid=');?>">
		<input type="hidden" class="position" position="<?php echo ($position); ?>">
		<input type='hidden' id="pagenums" value="<?php echo ($pagenums); ?>" />
		<input type='hidden' id="type" value="<?php echo ($type); ?>" />
		<input type='hidden' id="keyword" value="<?php echo ($keyword); ?>" />
		<input type='hidden' id="commodityType" value="<?php echo ($commodityType); ?>" />
	</div>
	<div class="row">
		<div class="span2 knowledgecate">
			<ul class="nav nav-list prolist" id="prolistpf">
				<li id="nav_item_1" class="<?php if(($commodityType) == "1"): ?>active<?php endif; ?>">
					<a href="<?php echo U('Product/index',['commodityType'=>1]);?>">批发产品</a>
				</li>
				<li class="all" data-commoditytype="1">
					<a class="active"><i class="icon-white icon-chevron-right"></i>全部</a>
				</li>
			</ul>
			
			<ul class="nav nav-list prolist" id="prolistls">
				<li id="nav_item_2" class="<?php if(($commodityType) == "2"): ?>active<?php endif; ?>">
					<a href="<?php echo U('Product/index',['commodityType'=>2]);?>">零售产品</a>
				</li>
				<li class="all" data-commoditytype="2">
					<a class="active"><i class="icon-white icon-chevron-right"></i>全部</a>
				</li>
			</ul>
			
			<?php switch($_SESSION['position_id']): case "1": case "13": case "14": case "15": case "16": break;?>
				<?php default: ?>
					<ul class="nav nav-list">						
						<li class="">
							<a href="<?php echo U('Product/freight');?>">查看运费模板</a>
						</li>						
					</ul><?php endswitch;?>

			<?php if($_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '16' OR $_SESSION['position_id']== '1'): ?><ul class="nav nav-list" id="prolist2">
					<li class="active">
						<a href="<?php echo U('Product/service');?>">查看社区服务</a>
					</li>
				</ul>
				<?php else: endif; ?>
		</div>
		<div class="span10">
			<div class="pull-left">				
				<ul class="nav pull-left">
					<li id="searchContent" class="pull-left">
						<input id="search" type="text" class="input-medium search-query" name="search" value="<?php echo ($keyword); ?>" />&nbsp;&nbsp;
					</li>
					<li  class="pull-left">
						<select id="product_all_up_down" style="width: 75px">
							<option value='-1'>全部</option>
							<option value='1'>上架</option>
							<option value='0'>下架</option>
						</select>
					</li>
					<li class="pull-left">
						&nbsp;&nbsp;<button type="submit" id="dosearch" class="btn" onclick="search()"> <img src="/Public/img/search.png"/>搜索</button>
					</li>					
				</ul>				
			</div>
			<div style="clear: both"></div>
			<div style="margin-top: 20px">				
				<ul class="nav pull-left">					
					<?php if($_SESSION['position_id']== '13' OR $_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '16' OR $_SESSION['position_id']== '1'): else: ?>
						<input type="hidden" name="urr" value="">
						<li class="pull-left">
							<a id="delete" class="btn" style="margin-right: 5px;" onclick="prodelete()"><i class="icon-remove"></i>删除</a>
						</li>
						<li class="pull-left">
							<a id="soldup" class="btn" style="margin-right: 5px;" onclick="upproduct()">上 架</a>
						</li>
						<li class="pull-left">
							<a id="soldout" class="btn" style="margin-right: 5px;" onclick="downproduct()">下 架</a>
						</li><?php endif; ?>
				</ul>				
			</div>
			<div class="pull-right">
				<?php if($_SESSION['position_id']== '13' OR $_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '16' OR $_SESSION['position_id']== '1'): else: ?>
					<a class="btn btn-primary" href="<?php echo U('Product/add',['commodityType'=>$commodityType]);?>"><i class="icon-plus"></i>&nbsp; 添加产品</a>&nbsp;<?php endif; ?>
			</div>
		</div>
		<div class="span10" style="margin-bottom: 60px">

			<table class="table table-hover table-striped" style="background:none repeat scroll 0 0; margin:0px auto;  width:100%; table-layout:fixed; border:0px solid #a1bcdb; ">
			<!--<table class="table table-hover table-striped table_thead_fixed">-->
				<thead>
					<tr id="childNodes_num">
						<th style="width:5%;"><input class="check_all" id="check_all" type="checkbox" /> &nbsp;</th>
						<th style="width:10%;">图片</th>
						<th>产品名称</th>
						<th  style="width:10%;">产品类别</th>
						<th  style="width:10%;">审核状态</th>
						<th  style="width:10%;">产品状态</th>
						<th  id="upDownTime" style="width:10%;display: none;width:15%">上/下架时间</th>
						<th  style="width:10%;">创建人</th>
						<th  style="width:10%;">操作 </th>
					</tr>
				</thead>
				<tbody id="form_container">

				</tbody>

				<tfoot>
					<tr>
						<td id="td_colspan">
							<div class="pagination">
								<div class="span2" id="total"></div>
								<div class="span3" id="pagenav"></div>
								<div class="span2">跳转到第
									<select style="width:auto;display:inline-block;" id="pagenum"></select>页
								</div>

								<div class="span2">每页显示
									<select style="width:auto;display:inline-block;" id="listrows">
										<option value="10">10</option>
										<option value="5">5</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
									</select>条</div>
								</div>
						</td>
					</tr>
				</tfoot>

					</table>

				</div>

			</div>
		</div>
		<script src="__PUBLIC__/js/images-loaded.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/js/litebox.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/js/productt_list.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(".all").click(function(){
			var comtype = $(this).data("commoditytype");
			$("#commodityType").val(comtype); 
			var child = $(this).parent().find(".allshow");
			if(child.css("display")=="none") {
				child.show();
			}else{
				child.hide();
			}
		})
		$(function() {
			$("#check_all").click(function() {
				$("input[class='check_list']").prop('checked', $(this).prop("checked"));
			});

		});
		$nodes_num = document.getElementById("childNodes_num").children.length;
		$("#td_colspan").attr('colspan', $nodes_num);



		$("#form_container td").each(function(i){

			//给td设置title属性,并且设置td的完整值.给title属性.
			$(this).attr("title",$(this).text());

		});
		</script>

		
</body>
<div style="height: 60px;clear: both"></div>
<div style="background-color: #b9b9b9;text-align:center;bottom:0;left:0;position:fixed;width:100%;z-index: 50">
	<div style="height:60px;margin-top:20px;z-index: 50">
		<div style="text-align:center;">逸务(上海)电子商务有限公司  沪ICP备14024312号  Copyright©2014-2016</div>
		<div style="text-align:center;">Powered By crm.yiguanjiaclub.net v4.6.3</div>		
	</div>
</div>
</html>