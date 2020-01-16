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
.tabtitle{font-size: 17.5px;font-weight:bold;margin: 20px auto;width:120px;}
.tdshop{vertical-align:middle;}
.price{font-size: 18px;margin-top: 5px;}
tr{font-size: 16px;}
.table th, .table td{text-align: center;vertical-align:middle;font-size: 16px;padding: 5px;border: 1px solid #EBF1F1;}
.btn-button{margin: 30px auto;font-size: 20px;}
.ems{border:1px solid #ccc;font-size: 18px;}
.orderno{background-color: #F4F4F4;font-size: 16px;height: 35px;margin-bottom: 30px;}
.ordernot{margin-left:10px;margin-right:60px;text-align: center; float: left;padding-top: 7px;}
.shopinfo{background-color: #F4F4F4;font-size: 16px;}
.tmoney{font-size: 16px;float:right;}
.tmoney2{margin: 10px;}
.orderinfo{font-size: 16px;font-weight: bold;background-color: #E8F1F6;height: 30px;padding-top: 8px;padding-left:30px;margin-top:35px;margin-bottom:25px;}
.message{font-size: 16px;margin-left:35px;margin-bottom:15px;margin-top:10px;}
</style>

<!-- 只写一个详情页面,详情页的信息根据状态判断来显示 -->

<div class="container">
    <?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
    <div class="row">
        <div class="span12">
            <div class="orderno">
                <div class="ordernot">订单编号 : <?php echo ($order["childOrderList"]["0"]["orderNo"]); ?></div>
                <div class="ordernot">订单状态 : <span style="color:#029BE2;font-weight: bold;">
                        <?php if($order[childOrderList][0][totalOrderStatus] == 'F0'): ?>待支付
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F13'): ?>待支付
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F1'): ?>待发货
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F14'): ?>待收货
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F4'): ?>已完成
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F11'): ?>订单关闭
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F20'): ?>订单关闭
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F21'): ?>订单关闭
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F19'): ?>订单关闭
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F15'): ?>退货中
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F16'): ?>用户申请退货
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F17'): ?>已退货
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F18'): ?>已驳回
                            <?php elseif($order[childOrderList][0][totalOrderStatus] == 'F24'): ?>已完成
                            <?php else: endif; ?></span></div>
                <div class="ordernot">订单类型 : 销售订单</div>
                <div style="clear: both;"></div>
            </div>
            
            <div>
                <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="shopinfo">
                        <th style="padding-left: 120px;">商品信息</th>
                        <th>商品价格(元)</th>
                        <th>数量</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>

                    <?php if(is_array($shop)): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td width="50%" style="padding-top: 15px;">
                            <img src="<?php echo ($vo["servicePicPath"]); ?>" alt="" style="width:120px;float:left;margin-right: 15px;">
                            <div><?php echo ($vo["title"]); ?></div><br>
                            <div>
                                <?php echo ($vo["specification"]); ?>
                            </div>
                            <div style="clear:both;"></div>
                        </td>
                        <td style="padding-top: 15px;"><?php echo ($vo["goodsPrice"]); echo ($vo["serviceUnit"]); ?></td>
                        <td style="padding-top: 15px;">
                            <?php echo ($vo["serviceNum"]); ?>
                        </td>
                        <td style="padding-top: 15px;">
                            <?php if($vo["orderStatus"] == '0'): ?>待支付
                                <?php elseif($vo["orderStatus"] == '13'): ?>待支付
                                <?php elseif($vo["orderStatus"] == '1'): ?>待发货
                                <?php elseif($vo["orderStatus"] == '14'): ?>待收货
                                <?php elseif($vo["orderStatus"] == '4'): ?>已完成
                                <?php elseif($vo["orderStatus"] == '11'): ?>订单关闭
                                <?php elseif($vo["orderStatus"] == '20'): ?>订单关闭
                                <?php elseif($vo["orderStatus"] == '21'): ?>订单关闭
                                <?php elseif($vo["orderStatus"] == '19'): ?>订单关闭
                                <?php elseif($vo["orderStatus"] == '15'): ?>退货中<br/>(退货原因:<?php echo ($vo["returnReason"]); ?>)
                                <?php elseif($vo["orderStatus"] == 16): ?>用户申请退货<br/>(退货原因:<?php echo ($vo["returnReason"]); ?>)
                                <?php elseif($vo["orderStatus"] == 17): ?>已退货<br/>(退货原因:<?php echo ($vo["returnReason"]); ?>)
                                <?php elseif($vo["orderStatus"] == 18): ?>已驳回<br/>(退货原因:<?php echo ($vo["returnReason"]); ?>)
                                <?php elseif($vo["orderStatus"] == 24): ?>已完成
                                <?php else: endif; ?> 
                        </td>
                        <?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": ?><td></td><?php break;?>
                            <?php default: ?>
                                <?php if($vo["orderStatus"] == '16'): ?><td>
                                    <div class="btn btn-primary sonorder" orderNo="<?php echo ($vo["orderNo"]); ?>" childOrderNo="<?php echo ($vo["childOrderNo"]); ?>" orderId="<?php echo ($vo["sid"]); ?>" totalOrderStatus="<?php echo ($vo["totalOrderStatus"]); ?>" status="<?php echo ($vo["orderStatus"]); ?>" type='3' orderChangeDatetime="<?php echo ($vo["orderChangeDatetime"]); ?>" >同意退货，并退款</div>
                                    <div class="btn btn-primary sonorder" orderNo="<?php echo ($vo["orderNo"]); ?>" childOrderNo="<?php echo ($vo["childOrderNo"]); ?>" orderId="<?php echo ($vo["sid"]); ?>" totalOrderStatus="<?php echo ($vo["totalOrderStatus"]); ?>" status="<?php echo ($vo["orderStatus"]); ?>" type='4' orderChangeDatetime="<?php echo ($vo["orderChangeDatetime"]); ?>">驳回</div>
                                    </td>
                                <?php elseif($vo["orderStatus"] == '22'): ?>
                     <!--                <td>
                                        <div class="btn btn-primary sonorder" orderNo=" <?php echo ($vo["orderNo"]); ?>" childOrderNo="<?php echo ($vo["childOrderNo"]); ?>" orderId=" <?php echo ($vo["sid"]); ?>" totalOrderStatus="<?php echo ($vo["totalOrderStatus"]); ?>" status="<?php echo ($vo["orderStatus"]); ?>" orderChangeDatetime="<?php echo ($vo["orderChangeDatetime"]); ?>">收货并退款</div>
                                    </td> -->
                                <?php else: ?>
                                    <td></td><?php endif; endswitch;?> 
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div>
            <div class="tmoney">
                <div class="tmoney2">商品总价:￥
                    <?php $sum = 0; foreach ($shop as $val){ $sum += ($val['payPrice']); } echo ($sum);?>
                </span></div>
                <div class="tmoney2">运费:￥<?php echo ($order["totalOrderInfo"]["freight"]); ?></div>
                <div class="tmoney2">订单总价:<span style="color:#029BE2;font-weight: bold;">￥
                    <?php $sum = 0; foreach ($shop as $val){ $sum += ($val['payPrice']); }; echo ($sum+$order['totalOrderInfo']['freight']);?></span></div>
            </div><div style="clear:both;"></div>

            <div class="orderinfo">订单信息</div>
            <div>
                <div class="message">收货人姓名: <span style="margin-left: 65px;"><?php echo ($order["totalOrderInfo"]["receiptUserName"]); ?></span></div>
                <div class="message">收货人手机号:<span style="margin-left: 53px;"><?php echo ($order["totalOrderInfo"]["receiptTelephone"]); ?></span></div>
                <div class="message">收货人地址:<span style="margin-left: 69px;"><?php echo ($order["totalOrderInfo"]["receiptPlace"]); ?></span></div>
                <div class="message">买家留言:<span style="margin-left: 86px;"><?php echo ($order["totalOrderInfo"]["message"]); ?></span></div>
                <div class="message">下单时间:<span style="margin-left: 85px;"><?php echo ($order["totalOrderInfo"]["dealDatetime"]); ?></span></div>
            </div>

            <div class="orderinfo">付款信息</div>
            <div>
                <div class="message">支付方式:&nbsp;&nbsp;
                    <?php if($order['totalOrderInfo']['payType'] == '0'): ?>支付宝
                        <?php elseif($order['totalOrderInfo']['payType'] == '1'): ?>微信  
                        <?php elseif($order['totalOrderInfo']['payType'] == '2'): ?>余额支付    
                        <?php elseif($order['totalOrderInfo']['payType'] == '3'): ?>银行卡
                        <?php elseif($order['totalOrderInfo']['payType'] == '4'): ?>线下付款
                        <?php else: endif; ?>
                </div>
                <div class="message">付款时间:&nbsp;&nbsp;<?php echo ($order["totalOrderInfo"]["payDatetime"]); ?></div>
                <div class="message">付款账号:&nbsp;&nbsp;<?php echo ($order["totalOrderInfo"]["buyerName"]); ?></div>
            </div>
           
            <div class="orderinfo">快递信息</div>
            <div class="btn btn-primary ems" orderNo="<?php echo ($vo["orderNo"]); ?>" payNo="<?php echo ($order["childOrderList"]["0"]["payNo"]); ?>">
                查看物流
            </div><br/><br>
            <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" id="logi">
            </table>

            <?php switch($_SESSION['position_id']): case "13": case "14": case "15": case "16": break;?>
                <?php default: ?>
                    <div class="orderinfo">处理意见</div>
                    <div class="btn-button">
                       <!--       根据状态值显示数据 -->
                       <?php if(($shop[0][totalOrderStatus] == 'F0') OR ($shop[0][totalOrderStatus] == 'F13')): ?><div class="btn btn-primary operation" orderNo="<?php echo ($order["childOrderList"]["0"]["orderNo"]); ?>" status="<?php echo ($shop["0"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($shop["0"]["orderChangeDatetime"]); ?>">订单取消</div>
                        <div class="btn btn-primary shut" url="<?php echo U('Order/index');?>">关闭</div>
                        <?php elseif($shop[0][totalOrderStatus] == 'F1'): ?>
                        <div class="btn btn-primary"><a href="<?php echo U('Order/send',array('payNo'=>$order['totalOrderInfo']['payNo'],'orderNo'=>$order['totalOrderInfo']['ordreNo'],'orderChangeDatetime'=>$order['totalOrderInfo']['orderChangeDatetime']));?>" type='1' style="color: #fff;" >发货</a></div>
                        <div class="btn btn-primary operation" orderNo="<?php echo ($order["childOrderList"]["0"]["orderNo"]); ?>" status="<?php echo ($shop["0"]["totalOrderStatus"]); ?>" type='2' orderChangeDatetime="<?php echo ($shop["0"]["orderChangeDatetime"]); ?>">拒绝发货并退款</div>
                        <div class="btn btn-primary shut" url="<?php echo U('Order/index');?>">关闭</div>
                        <?php elseif(($shop[0][totalOrderStatus] == 'F14') OR ($shop[0][totalOrderStatus] == 'F4') OR ($shop[0][totalOrderStatus] == 'F11') OR ($shop[0][totalOrderStatus] == 'F20') OR ($shop[0][totalOrderStatus] == 'F21') OR ($shop[0][totalOrderStatus] == 'F19') OR ($shop[0][totalOrderStatus] == 'F15') OR ($shop[0][totalOrderStatus] == 'F17') OR ($shop[0][totalOrderStatus] == 'F24') OR ($vo["orderStatus"] == 'F18')): ?>
                        <div class="btn btn-primary shut" url="<?php echo U('Order/index');?>">关闭</div>
                        <?php elseif($shop[0][totalOrderStatus] == 'F16'): ?>
                        <div class="btn btn-primary shut" url="<?php echo U('Order/index');?>">关闭</div>
                        <?php elseif($shop[0][totalOrderStatus] == 'F22'): ?>
                        <div class="btn btn-primary operation" orderNo="<?php echo ($order["childOrderList"]["0"]["orderNo"]); ?>" status="<?php echo ($shop["0"]["totalOrderStatus"]); ?>" orderChangeDatetime="<?php echo ($shop["0"]["orderChangeDatetime"]); ?>">收货并退款</div>
                        <div class="btn btn-primary shut" url="<?php echo U('Order/index');?>">关闭</div>   
                        <?php else: endif; ?> 
                    </div><?php endswitch;?>
        </div>
    </div>
</div>
<script>
$('.shut').click(function(){
    var url = $(this).attr('url');
    window.location.href = url;
});


$('.operation').click(function(){
    var orderNo = $(this).attr('orderNo');
    var status = $(this).attr('status');
    var type = $(this).attr('type');
    var orderChangeDatetime = $(this).attr('orderChangeDatetime');
    //alert(type);return;
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
            var childOrderStatusChanged = '17';
        }else if(type ==4){
            var orderStatusChanged = 'F18';
            var childOrderStatusChanged = '18';
        }
    }else if(status == 'F22'){
        var orderStatusChanged = 'F17';
        var childOrderStatusChanged = '17';
    }
    //alert(orderStatusChanged);
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
            alert('网络异常!');
        }
    });
});

$('.sonorder').click(function(){
    var orderNo = $(this).attr('orderNo');
    var childOrderNo = $(this).attr('childOrderNo');
    // console.log('a'+childOrderNo);return;
    var orderId = $(this).attr('orderId');
    var orderChangeDatetime = $(this).attr('orderChangeDatetime');
    var status = $(this).attr('status');
    var type = $(this).attr('type');
     if(status == '16'){
        if(type == 3){
            var childOrderStatusChanged = '17';
            var totalOrderStatus = 'F22';
        }else if(type ==4){
            var childOrderStatusChanged = '18';
            var totalOrderStatus = 'F18';
        }
     }
    $.ajax({
        url:'<?php echo ($url); ?>/manager/order/singleOrderStatusChange',
        data:{orderNo:orderNo,childOrderNo:childOrderNo,orderId:orderId,totalOrderStatus:totalOrderStatus,childOrderStatusChanged:childOrderStatusChanged,orderType:1,orderChangeDatetime:orderChangeDatetime},
        type:'post',
        cache:'false',
        dataType:'json',
        success:function(json){
           //console.log(json);
           if (json.code == 2000) {
                alert(json.message);
                location.reload();
           }
        },
       error:function(){
        alert('网络异常!');
    }
});
});

$('.ems').click(function(){
    var payNo = $(this).attr('payNo');
    var orderNo = $(this).attr('orderNo');
    var index = layer.load(0, {shade: false});
    //console.log(index);
    //var orderNo = 'adsf';
    $.ajax({
        type: "POST",
        cache: true,
        async: true,
        ifModified:true,
        timeout:12000,
        url:'<?php echo ($url); ?>/manager/order/express/queryExpressInfo',
        data:{orderNo:orderNo,mainTradeNo:payNo},
        dataType:'json',
        success:function(json){
            //console.log(json);return;
            // delete index;
            // var index=undefined;
            // console.log(index);
            layer.closeAll('loading');
            if(json.code == 2000){
                var data = json.data.expressDetail.result.list;
                var expressInfo = json.data.expressInfo;
                //console.log(data);
                if(data){
                	 var html = '<tr><td colspan="2" style="text-align: left;">承载单位&nbsp;：&nbsp;&nbsp;'+expressInfo.expressCompanyName+'</td></tr><tr><td colspan="2" style="text-align: left;">快递单号&nbsp;：&nbsp;&nbsp;'+expressInfo.expressNumber+'</td></tr>';
                    for (var i=0;i<data.length;i++){
                        var obj = data[i];
                        //console.log(obj);
                        html += '<tr>'  
                        +'<td style="text-align: left;">'+obj.remark+'</td>'
                        +'<td>'+obj.datetime+'</td>'
                        +'</tr>';
                    }    
                    document.getElementById("logi").innerHTML =html;
            }else{
                alert('暂无物流信息');
            }
        }else{
            alert('暂无物流信息');
        }
    },
    error:function(){
        alert('网络异常!');
        layer.closeAll('loading');
    }
});
});
</script>

<include file="Public:footer">