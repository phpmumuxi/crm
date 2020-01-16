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
<style type="text/css">
	.datetime{width: 86px;}
	.datemoney{width: 68px;}
	.order1{border-bottom:1px solid #ccc;border-top:1px solid #ccc;border-right:1px solid #ccc;margin-bottom:10px; }
	.orderb{border-left:1px solid #ccc;border-top:1px solid #ccc;padding: 10px;}
	.order12{font-size: 18px;}
	.order2{font-size: 16px;border-top: 1px solid #ccc;}
	.order22{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;}
	.order221{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;width:190px;}
	.order222{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;width:160px;}
	.order223{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;width:165px;}
	.order224{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;width:90px;}
	.order225{float: left;border-left:1px solid #ddd;height: 100px;padding: 10px;width:90px;padding-left:33px; }
	.order23{padding: 5px;}
	.ordermoney{padding: 5px;}
	.product tr td{border:0px solid #fff; }
	.table th, .table td{text-align: center;vertical-align:middle;border: 1px solid #EBF1F1;}
	#secompany{color:red;}
</style>
<div class="container">
	<div class="page-header" style="border:none; font-size:14px; ">
		<ul class="nav nav-tabs">
			<li class="active"><a  href="<?php echo U('order/index');?>"><img src="__PUBLIC__/img/caigou.png"/>&nbsp;订单</a></li>
			<?php if($_SESSION['position_id']!= 1): ?><li><a href="<?php echo U('order/analytics');?>"><img src="__PUBLIC__/img/tongji.png"/> &nbsp;统计</a></li><?php endif; ?>
		</ul>
	</div>
	<?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
	<div class="row">
		<div class="span2 knowledgecate">
			<ul class="nav nav-list">
				<li class="">
					<a href="<?php echo U('Order/index');?>">已卖出商品</a>
				</li>
				<li class="active">
					<a href="<?php echo U('Order/back');?>">售后申请处理</a>
				</li>
				<li class="">
					<a href="<?php echo U('Order/service');?>">已销售的社区服务</a>
				</li>
				<li>
					<a href="<?php echo U('Order/managerservice');?>">已销售的电子券服务</a>
				</li>
			</ul>
		</div>
		<div class="span10">
			<?php if($_SESSION['position_id']== '13'): ?><p class="view">
					<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($userType == '0'): ?><a href="<?php echo U('Order/back',array('userType'=>1,'userId'=>$vo['user_id']));?>"><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
						<?php if($userType == '1'): ?><a href="<?php echo U('Order/back',array('userType'=>2,'userId'=>$vo['user_id']));?>"><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
						<?php if($userType == '2'): ?><a href="<?php echo U('Order/back',array('userType'=>2,'parentId'=>$vo['parent_id'],'userId'=>$vo['user_id']));?>" class="companyUser"<?php if($_COOKIE['companyUser']== $vo['user_id']): ?>id="secompany"<?php endif; ?>><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
				</p><?php endif; ?>
			<?php if($_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '1'): ?><p class="view">
				<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Order/back',array('userId'=>$vo['user_id']));?>" class="companyUser"<?php if($_COOKIE['companyUser']== $vo['user_id']): ?>id="secompany"<?php endif; ?>><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
			</p>
				<p style="margin-left: 250px">
				<?php if($_SESSION['position_id']== '1'): echo ($pages); endif; ?>
				</p><?php endif; ?>
			<div class="pull-left">
				<ul class="nav pull-left">
					<li class="pull-left" style="margin-top:6px">
						<form class="form-inline" id="searchForm" action="<?php echo U('Order/back');?>" method="get">
							<ul class="nav pull-left">
								<?php if($_SESSION['position_id']== '1'): ?><li>
										<input id="search" type="text" class="input-medium search-query" name="search_company" placeholder="搜索公司名称" value=""/>&nbsp;
									</li><?php endif; ?>
								<li id="conditionContent" class="pull-left"> &nbsp;&nbsp;支付方式:
									<select id="condition" style="width:auto" name="payMent">
										<option value='99' <?php if($data["payMent"] == 99): ?>selected<?php endif; ?>>全部</option>
										<option value="0" <?php if($data["payMent"] == 0): ?>selected<?php endif; ?>>支付宝</option>
										<option value="1" <?php if($data["payMent"] == 1): ?>selected<?php endif; ?>>微信</option>
										<option value="2" <?php if($data["payMent"] == 2): ?>selected<?php endif; ?>>余额</option>
										<option value="3" <?php if($data["payMent"] == 3): ?>selected<?php endif; ?>>银行卡</option>
										<option value="4" <?php if($data["payMent"] == 4): ?>selected<?php endif; ?>>线下汇款</option>
									</select>&nbsp;
								</li>
								<li class="pull-left">
									&nbsp;&nbsp;订单时间:&nbsp;&nbsp;
									<input type="text" id="start_date" value="<?php echo ($data["beginTime"]); ?>" name="beginTime" onClick="WdatePicker({dateFmt:'yyyy-MM-dd', maxDate:&quot;#F{$dp.$D('end_date')||'2038-01-01'}&quot;})" class="Wdate" style="width: 95px;"/>到
									<input type="text" id="end_date" value="<?php echo ($data["endTime"]); ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd', minDate:&quot;#F{$dp.$D('start_date')}&quot;,maxDate:'2038-01-01'})" name="endTime" class="Wdate" style="width: 95px;"/> &nbsp;
								</li>
								<li class="pull-left">
									&nbsp;&nbsp;订单金额:&nbsp;&nbsp;
									<input   name="beginMoney" id="" type="text" value="<?php echo ($data["beginMoney"]); ?>" class="datemoney beginMoney"/> <span id="">到
									<input  name="endMoney" id="" type="text" value="<?php echo ($data["endMoney"]); ?>" class="datemoney endMoney"/> &nbsp;
								</li>
								<li id="searchContent" class="pull-left">
									<input id="search" type="text" class="input-medium search-query" name="k" placeholder="订单编号,商品名称" value="<?php echo ($data["orderName"]); ?>"/>&nbsp;
								</li>
								<li class="pull-left">
									<input type="hidden" name="userId" value="<?php echo ($newUserId); ?>"/>
									<input type="hidden" name="parentId" value="<?php echo ($newParentId); ?>"/>
									<input type="hidden" name="userType" value="<?php echo ($userType); ?>"/>
									<input type="hidden" name="m" value="order"/>
									<input type="hidden" name="a" id="a" value="back"/>
									<button type="submit" id="" class="btn"> <img src="__PUBLIC__/img/search.png"/> 确 定</button>
								</li>
							</ul>
						</form>
					</li>
				</ul>
			</div><br><br>
			<p class="view">
				<b>订单列表</b>
				<img src=" __PUBLIC__/img/by_owner.png"/> <a href="<?php echo U('Order/back',array('orderStatus'=>0,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 0): ?>class="active"<?php endif; ?>><?php echo L('ALL');?></a>&nbsp;&nbsp; &nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/back',array('orderStatus'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 1): ?>class="active"<?php endif; ?>>申请退货</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; &nbsp;
				<a href="<?php echo U('Order/back',array('orderStatus'=>2,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 2): ?>class="active"<?php endif; ?>>待商家收货</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/back',array('orderStatus'=>3,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 3): ?>class="active"<?php endif; ?>>已退货</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/back',array('orderStatus'=>4,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 4): ?>class="active"<?php endif; ?>>已驳回</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>

			<table class="table table-hover table_thead_fixed" width="100%" border="1" cellspacing="1" cellpadding="0">
				<?php if($orderEmpty): ?><tr><td colspan='5'>暂无订单数据</td></tr><?php endif; ?>
				<?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td>&nbsp;&nbsp;&nbsp;订单编号:<?php echo ($vo["orderNo"]); ?></td>
						<td colspan="4">下单时间:<?php echo ($vo["createTime"]); ?>&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table class="product">
								<tr>
									<td><img src="<?php echo ($vo["servicePicPath"]); ?>" alt="" style="width:120px;"></td>
									<td>
										<div class="order23"><?php echo (msubstr($vo["title"],0,10)); ?></div>
										<div class="order23">
											<?php if($vo["specification"] != ''): ?>已选规格:<?php echo ($vo["specification"]); ?>
												<?php else: endif; ?>
										</div>
										<div class="order23"><?php echo ($vo["goodsPrice"]); echo ($vo["serviceUnit"]); ?>*<?php echo ($vo["serviceNum"]); ?></div>
									</td>
								</tr>
							</table>
						</td>

						<td>
							<!-- 订单总金额:<?php echo ($vo['goodsPrice']*$vo['serviceNum']); ?>元  -->
							订单总金额:<?php echo ($vo['refundPrice']); ?>元
						</td>

						<td>
							<div class="order23">收货人:<?php echo ($vo["userName"]); ?></div>
							<div class="order23">
								支付方式:
								<?php if($vo[payType] == '0'): ?>支付宝
									<?php elseif($vo[payType] == '1'): ?>微信
									<?php elseif($vo[payType] == '2'): ?>余额支付
									<?php elseif($vo[payType] == '3'): ?>银行卡
									<?php elseif($vo[payType] == '4'): ?>线下支付
									<?php else: endif; ?>
							</div>
						</td>
						<td>
							<?php if($vo[orderStatus] == 'F0'): ?>待支付
								<?php elseif($vo[orderStatus] == 'F1'): ?>待发货
								<?php elseif($vo["orderStatus"] == 'F4'): ?>已完成
								<?php elseif($vo[orderStatus] == 'F11'): ?>订单关闭
								<?php elseif($vo[orderStatus] == 'F13'): ?>待支付
								<?php elseif($vo[orderStatus] == 'F14'): ?>待收货
								<?php elseif($vo[orderStatus] == 'F19'): ?>订单关闭
								<?php elseif($vo[orderStatus] == 'F15'): ?>退货中
								<?php elseif($vo[orderStatus] == 'F16'): ?>用户申请退货
								<?php elseif($vo[orderStatus] == 'F17'): ?>已退货
								<?php elseif($vo[orderStatus] == 'F18'): ?>已驳回
								<?php elseif($vo[orderStatus] == 'F20'): ?>订单关闭
								<?php elseif($vo[orderStatus] == 'F21'): ?>订单关闭
								<?php elseif($vo[orderStatus] == 'F26'): ?>申请退货
								<?php elseif($vo[orderStatus] == 'F27'): ?>同意退货
								<?php elseif($vo[orderStatus] == 'F28'): ?>已驳回
								<?php elseif($vo[orderStatus] == 'F22'): ?>待商家收货
								<?php else: endif; ?>
						</td>
						<td>
							<?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": ?><div><a href="<?php echo U('Order/viewback',array('sid'=>$vo['sid'],'orderChangeDatetime'=>$vo['orderChangeTime']));?>">订单详情</a></div><?php break;?>
								<?php default: ?>
								<?php if(($vo[orderStatus] == 'F27') OR ($vo[orderStatus] == 'F28') ): ?><div><a href="<?php echo U('Order/viewback',array('sid'=>$vo['sid'],'orderChangeDatetime'=>$vo['orderChangeTime']));?>">订单详情</a></div><br>
									<?php elseif($vo[orderStatus] == 'F26'): ?>
									<div><a href="<?php echo U('Order/viewback',array('sid'=>$vo['sid'],'orderChangeDatetime'=>$vo['orderChangeTime']));?>">订单详情</a></div><br>
									<div><a href="javascript:;" orderStatus="<?php echo ($vo["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderChangeTime"]); ?>" sid="<?php echo ($vo["sid"]); ?>"class="operation" type ='3'>同意</a></div><br>
									<div><a href="javascript:;" orderStatus="<?php echo ($vo["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderChangeTime"]); ?>" sid="<?php echo ($vo["sid"]); ?>"class="operation" type='4'>驳回</a></div>
									<?php elseif($vo[orderStatus] == 'F22'): ?>
									<div><a href="<?php echo U('Order/viewback',array('sid'=>$vo['sid'],'orderChangeDatetime'=>$vo['orderChangeTime']));?>">订单详情</a></div><br>
									<div><a href="<?php echo U('Pay/doalipay',array('ordreNo'=>$vo['payNo'],'title'=>$vo['title'],'sid'=>$vo['sid'],'orderChangeTime'=>$vo['orderChangeTime'],'totalPrice'=>encode($vo['refundPrice'])));?>" target="view_window">收货并退款</a></div><br>
									<?php else: endif; endswitch;?>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<?php echo ($page); ?>
		</div>
	</div>

	<script>
		$(function(){
			$('.status').click(function () {
				$('.status').removeClass("active");
				$(this).addClass("active");
			});
		});

		$('.operation').click(function(){
			var sid = $(this).attr('sid');
			var orderChangeDatetime = $(this).attr('orderChangeDatetime');
			var orderStatus = $(this).attr('orderStatus');
			var type = $(this).attr('type');
			// console.log(orderChangeDatetime);
			// 	console.log(sid);return;
			if (orderStatus == 'F22') {
				var orderStatusChanged = 'F17';
			}else if(orderStatus == 'F26'){
				if(type == 3){
					var orderStatusChanged = 'F22';
				}else if(type ==4){
					var orderStatusChanged = 'F28';
				}
			}

			$.ajax({
				url:'<?php echo ($url); ?>/manager/order/afterSale/orderStatusChange',
				data:{sid:sid,orderStatusChanged:orderStatusChanged,orderChangeDatetime:orderChangeDatetime},
				type:'post',
				cache:'false',
				dataType:'json',
				success:function(json){
					//console.log(json);
					alert(json.message);
					location.reload();
				},
				error:function(){
					alert('异常!');
				}
			});
		});

		$('.beginMoney').blur(function(){
			beginMoney = $('.beginMoney').val();
		});
		$('.endMoney').blur(function(){
			var endMoney = $('.endMoney').val();
			if (beginMoney > endMoney) {
				alert('请正确输入订单金额!');
				return;
			}
		});

	</script>
	<script src="__PUBLIC__/js/images-loaded.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/litebox.min.js" type="text/javascript"></script>
	
</body>
<div style="height: 60px;clear: both"></div>
<div style="background-color: #b9b9b9;text-align:center;bottom:0;left:0;position:fixed;width:100%;z-index: 50">
	<div style="height:60px;margin-top:20px;z-index: 50">
		<div style="text-align:center;">逸务(上海)电子商务有限公司  沪ICP备14024312号  Copyright©2014-2016</div>
		<div style="text-align:center;">Powered By crm.yiguanjiaclub.net v4.6.3</div>		
	</div>
</div>
</html>