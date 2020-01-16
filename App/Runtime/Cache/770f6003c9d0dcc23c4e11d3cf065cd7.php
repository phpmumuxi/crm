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
<script src="__PUBLIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<style>
    .orderno{background-color: #F4F4F4;font-size: 16px;height: 35px;margin-bottom: 30px;}
    .ordernot{margin-left:10px;margin-right:60px;text-align: center; float: left;padding-top: 7px;}
    .shopinfo{background-color: #F4F4F4;font-size: 16px;}
    .tmoney{font-size: 16px;float:right;}
    .orderinfo{font-size: 16px;font-weight: bold;background-color: #E8F1F6;height: 30px;padding-top: 8px;padding-left:30px;margin-top:35px;margin-bottom:25px;}
    .message{font-size: 16px;margin-left:35px;margin-bottom:15px;margin-top:10px;}
</style>
<div class="container">
    <?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
    <div class="row">
        <div class="span12">
            <div class="orderno">

                <div class="ordernot">订单编号 : <?php echo ($order["orderNo"]); ?></div>
                <div class="ordernot">订单状态 : <span style="color:#029BE2;font-weight: bold;"><?php switch($order["orderStatus"]): case "F22": ?>待商家收货<?php break;?>
                            <?php case "F26": ?>申请退货<?php break;?>
                            <?php case "F27": ?>同意<?php break;?>
                            <?php case "F28": ?>已驳回<?php break;?>
                            <?php default: endswitch;?></span></div>
                <div class="ordernot">订单类型 : 售后订单</div>
                <div style="clear: both;"></div>
            </div>
            <div>
                <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="shopinfo">
                        <th style="padding-left: 120px;">商品信息</th>
                        <th>退货单价(元)</th>
                        <th>数量</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
 
                    <tr>
                        <td width="50%" style="padding-top: 15px;">
                            <img src="<?php echo ($order["servicePicPath"]); echo ($vo["servicePicPath"]); ?>" alt="" style="width:120px;float:left;margin-right: 15px;">
                            <div><?php echo ($order["title"]); ?></div><br>
                            <div>
                                <?php echo ($order["specification"]); ?>
                            </div>
                            <div style="clear:both;"></div>
                        </td>
                        <td style="padding-top: 15px;"><?php echo (round($order['refundPrice']/$order['serviceNum'] , 2)); ?> <?php echo ($order["serviceUnit"]); ?></td>
                        <td style="padding-top: 15px;">
                            <?php echo ($order["serviceNum"]); ?>
                        </td>
                        <td style="padding-top: 15px;">
                            <?php switch($order["orderStatus"]): case "F22": ?>待商家收货<?php break;?>
                                <?php case "F26": ?>申请退货<?php break;?>
                                <?php case "F27": ?>同意<?php break;?>
                                <?php case "F28": ?>已驳回<?php break;?>
                                <?php default: endswitch;?>
                        </td>
                        <td style="padding-top: 15px;">
                        <?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": break;?>
                            <?php default: ?>
                        <?php if(($order[orderStatus] == 'F27') OR ($order[orderStatus] == 'F28') ): elseif($order[orderStatus] == 'F26'): ?>
                            <div><a href="javascript:;" orderStatus="<?php echo ($order["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($order["orderChangeTime"]); ?>" sid="<?php echo ($order["sid"]); ?>"class="operation" type ='3'>同意</a></div><br>
                            <div><a href="javascript:;" orderStatus="<?php echo ($order["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($order["orderChangeTime"]); ?>" sid="<?php echo ($order["sid"]); ?>"class="operation" type='4'>驳回</a></div>
                        <?php elseif($order[orderStatus] == 'F22'): ?>
                            <div><a href="<?php echo U('Pay/doalipay',array('ordreNo'=>$order['payNo'],'title'=>$order['title'],'sid'=>$order['sid'],'orderChangeTime'=>$order['orderChangeTime'],'totalPrice'=>encode($order['refundPrice'])));?>" target="view_window">收货并退款</a></div><br>
                        <?php else: endif; endswitch;?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tmoney">退款总金额:<span style="color:#029BE2;font-weight: bold;">￥<?php echo ($order['refundPrice']); ?></span></div>
            <div style="clear:both;"></div>
            <div class="orderinfo">订单信息</div>
            <div>
                <div class="message">收货人姓名: <?php echo ($order["userName"]); ?></div>
                <div class="message">收货人手机号:<?php echo ($order["telephone"]); ?></div>
                <div class="message">收货人地址:<?php echo ($order["servicePlace"]); ?></div>
                <div class="message">问题描述:<?php echo ($order["question"]); ?></div>
                <div class="message">下单时间:<?php echo ($order["createTime"]); ?></div>
                <div class="message">受理时间:<?php echo ($order["dealTime"]); ?></div>
                <div class="message">退款时间:<?php echo ($order["refundTime"]); ?></div>
            </div>
            <div class="orderinfo">付款信息</div>
            <div>
                <div class="message">支付方式:
                    <?php if($order[payType] == '0'): ?>支付宝
                        <?php elseif($order[payType] == '1'): ?>微信  
                        <?php elseif($order[payType] == '2'): ?>余额支付    
                        <?php elseif($order[payType] == '3'): ?>银行卡
                        <?php elseif($order[payType] == '4'): ?>线下支付
                        <?php else: endif; ?>
                </div>
                <div class="message">付款时间:<?php echo ($order["refundTime"]); ?></div>
               <!--  <div class="message">付款账号:</div> -->
            </div>
            
            
            <?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": break;?>
                <?php default: ?>
                <div class="orderinfo">处理意见:</div>
                <div class="message">
                    <?php if(($order[orderStatus] == 'F27') OR ($order[orderStatus] == 'F28') ): elseif($order[orderStatus] == 'F26'): ?>
                        <div><a href="javascript:;" orderStatus="<?php echo ($order["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($order["orderChangeTime"]); ?>" sid="<?php echo ($order["sid"]); ?>"class="operation" type ='3'>同意</a></div><br>
                        <div><a href="javascript:;" orderStatus="<?php echo ($order["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($order["orderChangeTime"]); ?>" sid="<?php echo ($order["sid"]); ?>"class="operation" type='4'>驳回</a></div>
                    <?php elseif($order[orderStatus] == 'F22'): ?>
                        <div><a href="<?php echo U('Pay/doalipay',array('ordreNo'=>$order['payNo'],'title'=>$order['title'],'sid'=>$order['sid'],'orderChangeTime'=>$order['orderChangeTime'],'totalPrice'=>encode($order['refundPrice'])));?>"class="btn btn-primary" target="view_window">收货并退款</a></div><br>
                    <?php else: endif; ?>
                </div><?php endswitch;?>
        </div>
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
            window.location.href = document.referrer;
        },
        error:function(){
            alert('网络异常!');
        }
    });
});
</script>
<include file="Public:footer">