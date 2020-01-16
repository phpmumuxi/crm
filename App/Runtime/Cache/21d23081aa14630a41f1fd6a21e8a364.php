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
<script src="__PUBLIC__/js/layer/layer.js" type="text/javascript"></script>
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

.product{100%}
.product tr td{border:0px solid #fff; }
.table th, .table td{text-align: center;vertical-align:middle;border: 1px solid #EBF1F1;}

.goodsname div{float:left}
.ordermoney{padding: 5px;}
.changepricetable th, .changepricetable td{text-align: center;vertical-align:middle;border: 1px solid #BEBEBE;}
#secompany{color:red;}

            input:focus{
                 border-color: #66afe9;
                 outline: 0;
                 -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
                 box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
            }
.span4{width:50%}
#viewUser span{cursor: pointer;}
</style>
<div style="margin-bottom:90px" class="container">
	<div class="page-header" style="border:none; font-size:14px;">
		<ul class="nav nav-tabs">
		  <li class="active"><a  href="<?php echo U('order/index');?>"><img src="__PUBLIC__/img/caigou.png"/>&nbsp;订单</a></li>
			<?php if($_SESSION['position_id']!= 1): ?><li class=""><a href="<?php echo U('order/analytics');?>"><img src="__PUBLIC__/img/tongji.png"/> &nbsp;统计</a></li><?php endif; ?>
	 	</ul>
	</div>
	<?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
	<div class="row">
		<div class="span2 knowledgecate">
			<ul class="nav nav-list">
				<li class="active">
					<a href="<?php echo U('Order/index');?>">已卖出商品</a>
				</li>
				<li class="">
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
					<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($userType == '0'): ?><a href="<?php echo U('Order/index',array('userType'=>1,'userId'=>$vo['user_id']));?>"><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
						<?php if($userType == '1'): ?><a href="<?php echo U('Order/index',array('userType'=>2,'userId'=>$vo['user_id']));?>"><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
						<?php if($userType == '2'): ?><a href="<?php echo U('Order/index',array('userType'=>2,'parentId'=>$vo['parent_id'],'userId'=>$vo['user_id']));?>" class="companyUser"<?php if($_COOKIE['companyUser']== $vo['user_id']): ?>id="secompany"<?php endif; ?>><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "$empty" ;endif; ?>
				</p><?php endif; ?>
			<?php if($_SESSION['position_id']== '14' OR $_SESSION['position_id']== '15' OR $_SESSION['position_id']== '1'): ?><p class="view">
					<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Order/index',array('userId'=>$vo['user_id']));?>" class="companyUser"<?php if($_COOKIE['companyUser']== $vo['user_id']): ?>id="secompany"<?php endif; ?>><?php echo ($vo["company"]); ?></a>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "$empty" ;endif; ?>
				</p>
				<p style="margin-left: 250px">
				<?php if($_SESSION['position_id']== '1'): echo ($pages); endif; ?>
				</p><?php endif; ?>

			<div class="pull-left">
				<ul class="nav pull-left">
					<li class="pull-left" style="margin-top:6px">
						<form class="form-inline" id="searchForm"  action="" method="get">
							<ul class="nav pull-left">
								<?php if($_SESSION['position_id']== '1'): ?><li>
									<input id="search" type="text" class="input-medium search-query" name="search_company" placeholder="搜索公司名称" value=""/>&nbsp;
								</li><?php endif; ?>
								<li id="conditionContent" class="pull-left"> &nbsp;&nbsp;支付方式:
									<select id="condition" style="width:auto" name="payMent">
										<option value='99' <?php if($data["payMent"] == 99): ?>selected<?php endif; ?>>全部</option>
										<option value="0" <?php if($data["payMent"] == 0): ?>selected<?php endif; ?>>支付宝</option>
										<option value="1" <?php if($data["payMent"] == 1): ?>selected<?php endif; ?>>微信</option>
										<option value="2" <?php if($data["payMent"] == 2): ?>selected<?php endif; ?>>余额支付</option>
										<option value="3" <?php if($data["payMent"] == 3): ?>selected<?php endif; ?>>银行卡</option>
										<option value="4" <?php if($data["payMent"] == 4): ?>selected<?php endif; ?>>线下付款</option>
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
									<input type="hidden" name="act" id="act" value="index"/>
									<button type="submit" id="" class="btn" style="margin-left: 0px;"> <img src="__PUBLIC__/img/search.png"/> 确 定</button>
								</li>
							</ul>
						</form>
					</li>
				</ul>
			</div><br><br>
			<p class="view">
				<b>订单列表</b>
				<img src=" __PUBLIC__/img/by_owner.png"/> <a href="<?php echo U('Order/index',array('orderStatus'=>0,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 0): ?>class="active"<?php endif; ?>><?php echo L('ALL');?></a>&nbsp;&nbsp; &nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>1,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 1): ?>class="active"<?php endif; ?>>待发货</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; &nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>2,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 2): ?>class="active"<?php endif; ?>>待支付</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>3,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 3): ?>class="active"<?php endif; ?>>待收货</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>4,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 4): ?>class="active"<?php endif; ?>>已完成</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>5,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 5): ?>class="active"<?php endif; ?>>订单关闭</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Order/index',array('orderStatus'=>6,'tebSort'=>1,'userType'=>$userType,'userId'=>$newUserId,'parentId'=>$newParentId));?>" <?php if($_GET['orderStatus'] == 6): ?>class="active"<?php endif; ?>>退货中</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>

			<table class="table table-hover table_thead_fixed" width="100%" border="1" cellspacing="1" cellpadding="0">
				<?php if($orderEmpty): ?><tr><td colspan='5'>暂无订单数据</td></tr><?php endif; ?>
				<?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td>&nbsp;&nbsp;&nbsp;订单编号:<?php echo ($vo["orderInfo"]["ordreNo"]); ?></td>
						<td colspan="4">下单时间:<?php echo ($vo["orderInfo"]["dealDatetime"]); ?>&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table class="product">
								<?php if(is_array($vo["orderChildList"])): $i = 0; $__LIST__ = $vo["orderChildList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><tr>
										<td><img src="<?php echo ($child["servicePicPath"]); ?>" alt="" style="width:80px;"></td>
										<td>
											<div class="order23"><?php echo (msubstr($child["title"],0,10)); ?></div>
											<div class="order23">
												<?php if($child["specification"] != ''): ?>已选规格:<?php echo (msubstr($child["specification"],0,10)); ?>
													<?php else: endif; ?>
											</div>
											<div class="order23"><?php echo ($child["goodsPrice"]); echo ($child["serviceUnit"]); ?>*<?php echo ($child["serviceNum"]); ?></div>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</table>
						</td>

						<td>
							订单总金额:<?php echo ($vo["orderInfo"]["priceWithFreight"]); ?>元
						</td>

						<td>
							<div class="order23">收货人:<?php echo ($vo["orderChildList"]["0"]["userName"]); ?></div>
							<div class="order23">
								支付方式:
								<?php if($vo[orderChildList][0][payType] == '0'): ?>支付宝
									<?php elseif($vo[orderChildList][0][payType] == '1'): ?>微信
									<?php elseif($vo[orderChildList][0][payType] == '2'): ?>余额支付
									<?php elseif($vo[orderChildList][0][payType] == '3'): ?>银行卡
									<?php elseif($vo[orderChildList][0][payType] == '4'): ?>线下付款
									<?php else: ?>未支付<?php endif; ?>
							</div>
						</td>

						<td>
							<?php if($vo[orderInfo][totalOrderStatus] == 'F0'): ?>待支付
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F13'): ?>待支付
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F1'): ?>待发货
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F14'): ?>待收货
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F4'): ?>已完成
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F11'): ?>订单关闭
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F20'): ?>订单关闭
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F21'): ?>订单关闭
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F19'): ?>订单关闭
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F15'): ?>退货中
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F16'): ?>用户申请退货
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F17'): ?>已退货
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F18'): ?>已驳回
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F24'): ?>已完成
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F22'): ?>待商家收货
								<?php else: endif; ?>
						</td>

						<td>
						
							<?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": ?><div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; break;?>
								<?php default: ?>
								<?php if(($vo[orderInfo][totalOrderStatus] == 'F0') OR ($vo[orderInfo][totalOrderStatus] == 'F13') ): ?><div><a href="javascript:;" class="pricechange" orderNo="<?php echo ($vo["orderInfo"]["ordreNo"]); ?>">修改价格</a></div>
									<div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div><br>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; ?>
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F1'): ?>
									<div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div><br>
									<div><a href="<?php echo U('Order/send',array('payNo'=>$vo['orderInfo']['payNo'],'orderNo'=>$vo['orderInfo']['ordreNo'],'orderChangeDatetime'=>$vo['orderInfo']['orderChangeDatetime']));?>" orderNo="<?php echo ($vo["orderInfo"]["ordreNo"]); ?>" status="<?php echo ($vo["orderInfo"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderInfo"]["orderChangeDatetime"]); ?>" type='1'>发货</a></div><br>
									<div><a href="javascript:;" orderNo="<?php echo ($vo["orderInfo"]["ordreNo"]); ?>" status="<?php echo ($vo["orderInfo"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderInfo"]["orderChangeDatetime"]); ?>" class="operation" type='2'>拒绝发货并退款</a></div>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; ?>
								<?php elseif(($vo[orderInfo][totalOrderStatus] == 'F14') OR ($vo[orderInfo][totalOrderStatus] == 'F4') OR ($vo[orderInfo][totalOrderStatus] == 'F11') OR ($vo[orderInfo][totalOrderStatus] == 'F20') OR ($vo[orderInfo][totalOrderStatus] == 'F21') OR ($vo[orderInfo][totalOrderStatus] == 'F19') OR ($vo[orderInfo][totalOrderStatus] == 'F15') OR ($vo[orderInfo][totalOrderStatus] == 'F17') OR ($vo[orderInfo][totalOrderStatus] == 'F24')): ?>
									<div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div><br>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; ?>
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F16'): ?>
									<div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div><br>
									<div><a href="javascript:;" orderNo="<?php echo ($vo["orderInfo"]["ordreNo"]); ?>" status="<?php echo ($vo["orderInfo"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderInfo"]["orderChangeDatetime"]); ?>" class="operation" type ='3'>同意</a></div><br>
									<div><a href="javascript:;" orderNo="<?php echo ($vo["orderInfo"]["ordreNo"]); ?>" status="<?php echo ($vo["orderInfo"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderInfo"]["orderChangeDatetime"]); ?>" class="operation" type='4'>驳回</a></div>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; ?>
								<?php elseif($vo[orderInfo][totalOrderStatus] == 'F22'): ?>
									<div><a href="<?php echo U('Order/view',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'payMent'=>$vo['orderInfo']['payMent'],'tradeFinishTime'=>$vo['orderInfo']['tradeFinishTime']));?>">订单详情</a></div><br>
									<div><a href="<?php echo U('Pay/doalipay',array('ordreNo'=>$vo['orderInfo']['orderNo'],'ordreId'=>$vo['orderInfo']['orderNo'],'totalPrice'=>encode($vo['orderInfo']['totalPrice'])));?>">收货并退款</a></div><br>
									<?php if($vo[orderInfo][isEvaluate] == '1'): ?><div><a href="<?php echo U('Order/evaluateinfo',array('ordreNo'=>$vo['orderInfo']['ordreNo'],'orderType'=>$vo['orderInfo']['totalOrderStatus']));?>">评价</a></div><?php endif; ?>
								<?php else: endif; endswitch;?>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<?php echo ($page); ?>
		</div>
	</div>
<!-- 下面是订单修改价格 -->
<div class="orderpricechange" style="display:none">
	<div class="pricediv" style="padding:50px">
	    <table class="changepricetable" width="100%" border="1"  cellspacing="1" cellpadding="0">
                </table>
          </div>
</div>
<script>
/*
 * 订单修改弹出框
 */
$(".pricechange").click(function(){

	var orderNo = $(this).attr('orderNo');
	
  	$.ajax({
		url:'<?php echo ($url); ?>/manager/order/getOrderRecordByParams',
		data:{totalOrderNo:orderNo,orderType:1},
		type:'post',
		cache:'false',
		dataType:'json',
		success:function(json){
			if(json.data.totalOrderInfo["totalOrderStatus"]== 'F0' || json.data.totalOrderInfo["totalOrderStatus"]== 'F13'){
			
				var tableth = '  <tr class="shopinfo"><th style="">商品</th><th>单价</th><th>数量</th><th>商品原价</th><th>涨/减价</th><th>运费</th></tr>';
				$(".changepricetable").html(tableth);
				var allgoodsprice = 0 ;//商品总价
				var allorderorice = 0;//订单总价
				for(var i = 0 ; i < json.data.childOrderList.length ; i++){
					
				if(i==0){
					
					if(json.data.childOrderList[i]["freight"] == null){
						json.data.childOrderList[i]["freight"]=0;
					}
					// var trcontent = '<tr class="orderchild" platformPer="'+json.data.childOrderList[i]["platformPer"]+'" integralRatio="'+json.data.childOrderList[i]["integralRatio"]+'" servicepayprice="'+json.data.
					var trcontent = '<tr class="orderchild" servicepayprice="'+json.data.childOrderList[i]["servicePayPrice"]+'" childorderno="'+json.data.childOrderList[i]["childOrderNo"]+'" sid="'+json.data.childOrderList[i]["sid"]+'" originalprice="'+json.data.childOrderList[i]["originalGoodsPrice"]+'"  sellerid="'+json.data.childOrderList[i]["sellerId"]+'" specification="'+json.data.childOrderList[i]["specification"]+'" goodssid="'+json.data.childOrderList[i]["goodsSid"]+'"><td class="goodsname" width="25%" style="padding-top: 15px;"><div><img src="' + json.data.childOrderList[i]["servicePicPath"]+'"'+
	 				' style="width:100px;height:100px;float:left;margin-right: 15px;"></div><div style="width:100px;height:100px"><p style="padding-top:10px"><span title="'+json.data.childOrderList[i]["title"]+'">'+ json.data.childOrderList[i]["title"].replace(/(.{6})(.*)/g,'$1.....') + '</span></p>'+
	 				'<p style="padding-bottom:10px"><span title="'+json.data.childOrderList[i]["specification"]+'">' + json.data.childOrderList[i]["specification"].replace(/(.{6})(.*)/g,'$1.....') + '</span></p>' + 
	 				'</div></td>' + 
	 				' <td class="goodsprice" width="15%"  style="padding-top: 15px;">' +json.data.childOrderList[i]["goodsPrice"] + '</td>'+
	 				' <td  width="15%"  class="servicenum" style="padding-top: 15px;">' + json.data.childOrderList[i]["serviceNum"]+ '</td>'+
	 				' <td  width="15%"  style="padding-top: 15px;">' +json.data.childOrderList[i]["originalGoodsPrice"] + '</td>'+
	 				' <td  width="15%"  style="padding-top: 15px;"><input type="hidden" class="radiovalue" value="" /> <p><span > <input class="isadd" type="radio" name="radioname'+i+'" value="1" />减     &nbsp;&nbsp;<input class="islose" placeholder="￥" style="width:40px;height:20px" type="text" /><label></label></span></p><p><span> <input type="radio" name="radioname'+i+'" class="isadd" value="0" />涨   &nbsp;&nbsp; <input class="add"  placeholder="￥" style="width:40px;height:20px" type="text" /><label></label></span></p></td>'+
	 				' <td  width="15%"  style="padding-top: 15px;" rowspan="'+json.data.childOrderList.length+'"><div ><label style="display:inline-block">运费： &nbsp;&nbsp;</label><input placeholder="￥" style="width:50px;height:20px" type="text" class="freight" value="'+ json.data.childOrderList[i]["freight"] +'" /><label></label></div></td></tr>';
				}else{
					// var trcontent = '<tr class="orderchild" platformPer="'+json.data.childOrderList[i]["platformPer"]+'" integralRatio="'+json.data.childOrderList[i]["integralRatio"]+'" servicepayprice="'+json.data.
					var trcontent = '<tr class="orderchild" servicepayprice="'+json.data.childOrderList[i]["servicePayPrice"]+'" childorderno="'+json.data.childOrderList[i]["childOrderNo"]+'" sid="'+json.data.childOrderList[i]["sid"]+'" originalprice="'+json.data.childOrderList[i]["originalGoodsPrice"]+'"  sellerid="'+json.data.childOrderList[i]["sellerId"]+'" specification="'+json.data.childOrderList[i]["specification"]+'" goodssid="'+json.data.childOrderList[i]["goodsSid"]+'"><td class="goodsname" width="25%" style="padding-top: 15px;"><div><img src="' + json.data.childOrderList[i]["servicePicPath"]+'"'+
	 				' style="width:100px;height:100px;float:left;margin-right: 15px;"></div><div style="width:100px;height:100px"><p style="padding-top:10px"><span title="'+json.data.childOrderList[i]["title"]+'">'+ json.data.childOrderList[i]["title"].replace(/(.{6})(.*)/g,'$1.....') + '</span></p>'+
	 				'<p style="padding-bottom:10px"><span title="'+json.data.childOrderList[i]["specification"]+'">' + json.data.childOrderList[i]["specification"].replace(/(.{6})(.*)/g,'$1.....') + '</span></p>' + 
	 				'</div></td>' + 
	 				' <td class="goodsprice" width="15%"  style="padding-top: 15px;">' +json.data.childOrderList[i]["goodsPrice"] + '</td>'+
	 				' <td  width="15%"  class="servicenum" style="padding-top: 15px;">' + json.data.childOrderList[i]["serviceNum"]+ '</td>'+
	 				' <td  width="15%"  style="padding-top: 15px;">' +json.data.childOrderList[i]["originalGoodsPrice"] + '</td>'+
	 				' <td  width="15%"  style="padding-top: 15px;"><input type="hidden" class="radiovalue" value="" /> <p><span > <input class="isadd" type="radio" name="radioname'+i+'" value="1" />减     &nbsp;&nbsp;<input class="islose" placeholder="￥" style="width:40px;height:20px" type="text" /><label></label></span></p><p><span> <input type="radio" name="radioname'+i+'" class="isadd" value="0" />涨   &nbsp;&nbsp; <input class="add"  placeholder="￥" style="width:40px;height:20px" type="text" /><label></label></span></p></td>';
	 				
				}
				allgoodsprice = allgoodsprice+parseFloat(json.data.childOrderList[i]["servicePayPrice"]);//子订单商品总价
					$(".changepricetable").append(trcontent);
				}
				allgoodsprice = allgoodsprice.toFixed(2);//把小数保留2位就行
				allorderorice = parseFloat(allgoodsprice) + parseFloat(json.data.totalOrderInfo["freight"]);//订单总价
				var orderinfo = '<tr><td colspan="6">'+
								'<div style="margin:10px;float:left;width:100%;text-align:right;"><label style="display:inline-block;margin-right:40px;">商品总价&nbsp;:￥'+allgoodsprice+'</label><label style="display:inline-block;margin-right:40px;">运费&nbsp;:￥'+json.data.totalOrderInfo["freight"]+'</label><label style="display:inline-block;margin-right:30px;">订单总价&nbsp;:￥'+allorderorice+'</label></div>'+
								'<div style="margin:10px;float:left;width:100%;text-align:left;">订单信息</div>'+
								'<div style="margin:10px;float:left;width:100%;text-align:left;"><input type="hidden" payno="'+json.data.totalOrderInfo["payNo"]+'" goodsname="'+json.data.childOrderList[0]["title"]+'" buyerid="'+json.data.totalOrderInfo["buyerId"]+'" class="ordernumber" value="'+json.data.totalOrderInfo["ordreNo"]+'"><label class="ordreno" style="display:inline-block;margin-right:40px;">订单编号&nbsp;:'+json.data.totalOrderInfo["ordreNo"]+'</label><label style="display:inline-block;margin-right:40px;">'+json.data.totalOrderInfo["dealDatetime"]+'</label><label style="display:inline-block;margin-right:30px;">待支付</label></div>'+
								'<div style="margin:10px;float:left;width:100%;text-align:left;"><label style="display:inline-block;margin-right:40px;">收货人&nbsp;:'+json.data.totalOrderInfo["userName"]+'</label><label style="display:inline-block;margin-right:40px;">'+json.data.totalOrderInfo["receiptTelephone"]+'</label></div>'+
								'<div style="margin:10px;float:left;width:100%;text-align:left;"><label style="display:inline-block;margin-right:40px;">收货地址&nbsp;:'+json.data.totalOrderInfo["receiptPlace"]+'</label></div>'+
								'</td></tr>';
				$(".changepricetable").append(orderinfo);
				layer.open({
					type: 1,
					title: '',
					content: '<div class="layerdiv">'+$('.orderpricechange').html()+'<span class="save-agree" style="float:left;width:100%;text-align: center;"><button style="background:#029be1;color:white;height:43px;width:115px;margin-right:70px;margin-top:100px;padding:10px;border-radius:5px" type="button" class="btn save">确定</button><button style="background:#029be1;color:white;height:43px;width:115px;margin-top:100px;padding:10px;border-radius:5px" type="button" class="btn closesave">取消</button></span>'+'</div>',
					skin: 'layer-ext-moon',
					area: ['80%','90%'], 
					resize: false,
					shadeClose: true,
					success:function(){
						//radio点击事件
						$(".isadd").on("click",function(){
							
							var radiovalue = $(this).val();
				
							$(this).parent().parent().parent().find(".radiovalue").val(radiovalue) ;
						})
						//保存订单
						$('.save').on('click',function(){
							var ordreNo = $(".ordernumber").val();
							var buyerId = $(".ordernumber").attr("buyerid");//买家Id 
							var goodsName = $(".ordernumber").attr("goodsname");//订单第一个子订单商品名称
							var payNo = $(".ordernumber").attr("payno");//支付编号
							var orderType="1";//卖家为1，买家为0
							var freight = $(".layerdiv .freight").val();
							var orderParams = [];
							var orderPriceSum = 0;
							if (freight !== '' && isNaN(freight)) { 
								$(".freight").next().html("<font color='red'>请填写数字</font>"); 
								  return;    
								}else{
									$(".freight").next().html("<font color='green'>OK</font>"); 
								}
							var result = true;  
							$(".layerdiv .orderchild").each(
									function () {
										var goodsSid = $(this).attr("goodssid");//
										var servicePayPrice = $(this).attr("servicepayprice");//子订单商品总价
										
										var sid = $(this).attr("sid");//订单id
										var sellerId = $(this).attr("sellerid");//卖家Id
										var specification = $(this).attr("specification");
										var childOrderNo = $(this).attr("childorderno");//客户id
									    var goodsPrice = parseFloat($(this).find(".goodsprice").html());
										var goodsPriceOld = parseFloat(goodsPrice);
				
										var addOrSubtract = $(this).find(".radiovalue").val();
										var serverNum = parseInt($(this).find(".servicenum").html());
										var originalGoodsPrice = parseFloat($(this).attr("originalprice"));

										// var platformPer = $(this).attr("platformPer");
										// var integralRatio = $(this).attr("integralRatio");

										if(addOrSubtract !== ""){
											if(addOrSubtract == '1'){
												discountPrice = $(this).find(".islose").val();
												if (isNaN(discountPrice) || discountPrice == "") { 
											
													$(this).find(".islose").next().html("<font color='red'>请填写数字</font>");
													 result = false;  
													return false;  
													}else{
														$(this).find(".islose").next().html("<font color='green'>OK</font>");  
													}
												
												if(discountPrice > goodsPrice*serverNum){
													
													//$(this).find(".islose").next().html("<font color='red'>减去的价格不能大于当前商品的单价</font>");
													alert("减去的价格不能大于当前商品的单价");
													result = false; 
													return false;
												}
												
											    var goodsPrice = (goodsPrice * serverNum - parseFloat(discountPrice))/serverNum;
											    var orderChiledPrice = parseFloat(servicePayPrice)-parseFloat(discountPrice);//子订单价格=原来价格-折扣价格
											}
											if(addOrSubtract == '0'){
												discountPrice = $(this).find(".add").val();
												if (isNaN(discountPrice) || discountPrice == "") { 
	
													$(this).find(".add").after("<label><font color='red'>请填写数字</font></label>"); 
													result = false; 
													return false;   
													}else{
														$(this).find(".add").after("<label><font color='green'>OK</font></label>");  
													}
												var goodsPrice = (goodsPrice * serverNum + parseFloat(discountPrice))/serverNum;
												var orderChiledPrice = parseFloat(servicePayPrice)+parseFloat(discountPrice);//子订单价格=原来价格-折扣价格
												
											}
										}else{
											discountPrice = 0;
											var orderChiledPrice = parseFloat(servicePayPrice)+parseFloat(discountPrice);
										}
										goodsPrice = parseFloat(Math.round(goodsPrice*100)/100);//保留2位小数
			 							orderPriceSum = orderChiledPrice+orderPriceSum;//计算新 的商品总价 
										var item = {
											"sellerId":sellerId,
											"goodsSid":goodsSid,
											"goodsPrice": goodsPrice,
											"addOrSubtract": addOrSubtract,
											"discountPrice": discountPrice,
											"serverNum" :serverNum,
											"servicePayPrice":orderChiledPrice,
											"originalGoodsPrice":goodsPriceOld,
											"orderId":sid,
											"childOrderNo":childOrderNo,
											"specification":specification,
											//"goodsPriceOld":goodsPriceOld
											// "platformPer":platformPer,  
											// "integralRatio":integralRatio,  
											
										};
										orderParams.push(item);//每个商品的修改后的参数
									}
								);
							if (!result)  
						          return;  
							orderParams=JSON.stringify(orderParams);
							orderPriceSum = parseFloat(orderPriceSum)+parseFloat(freight);//商品总价+邮费=订单总价
							data = {orderNo:ordreNo,orderType:orderType,orderParams:orderParams,freight:freight,buyerId:buyerId,goodsName:goodsName,sumPrice:orderPriceSum,payNo:payNo}
					
							// console.log(data);return;
							//$.post('http://192.168.1.60:8080/manager/order/orderPriceChang',data,function(result){
							$.post('<?php echo ($url); ?>/manager/order/orderPriceChang',data,function(result){
								if(result.success){
									console.log(result.data.returnValue);
									alert(result.data.returnValue);
									location.reload(); 
									
								}else{
									alert(result.message);
									location.reload(); 
								}
							},'json')
						});
						
						//关闭弹出层
						$('.closesave').on('click',function(){
							layer.closeAll();
						});
					}
				});
			}else{
				alert("此订单订单已支付请刷新页面");return;
			}
 		},
		error:function(){
			alert('请求失败!');
		}
	});  

})


$(function(){
		$('.status').click(function () {
			$('.status').removeClass("active");
			$(this).addClass("active");
		});
	});


	$('.operation').click(function(){
		var orderNo = $(this).attr('orderNo');
		var status = $(this).attr('status');
		var orderChangeDatetime = $(this).attr('orderChangeDatetime');

		if (status == 'F0' || status == 'F13') {
			var orderStatusChanged = 'F11';
			var childOrderStatusChanged = '11';
		}else if(status == 'F1'){
			var type = $(this).attr('type');
			if(type == 1){
				var orderStatusChanged = 'F14';
				var childOrderStatusChanged = '14';
			}else if(type ==2){
				var orderStatusChanged = 'F21';
				var childOrderStatusChanged ='21';
			}
		}else if(status == 'F16'){
			if(type == 3){
				var orderStatusChanged = 'F22';
				var childOrderStatusChanged = '22';
			}else if(type ==4){
				var orderStatusChanged = 'F18';
				var childOrderStatusChanged = '18';
			}
		}else if(status == 'F22'){
			var orderStatusChanged = 'F17';
			var childOrderStatusChanged = '17';
		}
		$.ajax({
			url:'<?php echo ($url); ?>/manager/order/megerOrderStatusChange',
			data:{orderNo:orderNo,orderStatusChanged:orderStatusChanged,childOrderStatusChanged:childOrderStatusChanged,orderType:1,orderChangeDatetime:orderChangeDatetime},
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