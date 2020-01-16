<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>公司登录</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="description" content=""/>
	<meta name="author" content="<?php echo L('AUTHOR');?>"/>
	<link type="text/css" href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
	<link type="text/css" href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="__PUBLIC__/css/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
	<link type="text/css" href="__PUBLIC__/css/font-awesome.min.css" rel="stylesheet" />
	<link href="__PUBLIC__/css/docs.css" rel="stylesheet"/>
	<link rel="shortcut icon" href="../favicon.png"/>
    <script type="text/javascript">
        var browserInfo = {browser:"", version: ""};
        var ua = navigator.userAgent.toLowerCase();
        if (window.ActiveXObject) {
            browserInfo.browser = "IE";
            browserInfo.version = ua.match(/msie ([\d.]+)/)[1];
            if(browserInfo.version <= 7){
                if(confirm("您的ie浏览器版本过低，建议使用chorme浏览器，\n点击【确定】转到下载页面")){}
                location.href = 'http://www.google.cn/intl/zh-CN/chrome/browser/';
            }
        }
    </script>
	<script src="__PUBLIC__/js/jquery-1.9.0.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/layer/layer.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/js/WdatePicker.js" type="text/javascript"></script>
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
	<![endif]-->	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="__PUBLIC__/js/respond.min.js"></script>
	<![endif]-->
</head>
<style type="text/css">
body {
	padding-top: 60px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}
.userinfo div{
	float:left;
}
.form-signin {
	max-width: 400px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}
.wukong {
	margin-top:30px;
	padding-top:10px;
	border-top:1px solid #e5e5e5;		
}
.logo{
	width:50px;
	height:50px;
}
.luichi{
		font-size: 16px;
		text-align: center;
		background: #b9b9b9;
		width:100%;
		height: 60px;
		line-height: 60px;
		color:#f8f8f8;
}
.yiwu{
	background: #1273a3;
	margin-top: 300px;
}
</style>
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="javascript:;" alt="" style="font-family: 宋体;">逸管家智能数据</a> 
		</div> 
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="span8">
			<!-- <h4><img src="__PUBLIC__/img/index_notice.png" style="width:17.5px;"/> <?php echo L('SYSTEM_ANNOUNCEMENT');?></h4> -->
			<!-- <div class="hero-unit">
			<?php if(is_array($announcement_list)): $k = 0; $__LIST__ = $announcement_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><p><?php echo ($k); ?>、<a onclick="javascript:show(<?php echo ($vo['announcement_id']); ?>);" style="font-size: 14px;color:#<?php echo ($vo["color"]); ?>"><?php echo ($vo["title"]); ?></a> <?php if((time()-$vo['update_time']) < 86400*7): ?>&nbsp; <img src="./Public/img/new.gif"><?php endif; ?> &nbsp; (<?php echo L('UPDATE_DATE');?>：<?php echo (date("Y-m-d H:i",$vo["update_time"])); ?>)
				</p>
				<div id="content<?php echo ($vo['announcement_id']); ?>" class="hide"><?php echo ($vo["content"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div> -->
			<div>
				<a href="#" ><img src="__PUBLIC__/img/crm2.png" alt="" ></a>
			</div>
			
		</div>
		<div class="span4">
		  <div style="border-left:1px solid #eee;">
			  <form action="" method="post" name="form-signin" class="form-signin" >
					<fieldset>
					<label class='message'></label>
					<legend><h3>公司登录</h3></legend>
					<?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
					<?php echo L('USER_NAME');?>：<input type="text" name="name" class="text-input" placeholder="手机号/<?php echo L('USER_NAME');?>"/><br/>
					<?php echo L('LOGIN_PASSWORD');?>：<input type="password" name="password" class="password text-input" placeholder="<?php echo L('PASSWORD');?>"/>
					<br/>
					<label class="checkbox"><input type="checkbox" name="autologin"/> <?php echo L('AUTO_LOGIN_IN_THREE_DAYS');?></label>
					<input name="submit" class="btn btn-primary " type="button" value="<?php echo L('LOGIN');?>" style="line-height: 24px;padding:4px 121px;margin-left: 0px;"/> &nbsp; <br/><br/><a href="<?php echo U('user/lostpw');?>" style="line-height: 0px;padding:4px 121px;"><?php echo L('FORGET_PASSWORD');?></a>
					</fieldset>
			  </form>
		  </div>
		</div>
	</div>
</div>
<div class='agreement' style="display:none;width:100%;height:100%;margin:0 auto;">
	<div style="width:900px;margin-left:25%;">
	<div style="padding-top:30px;padding-bottom:30px; width:90%;height:20px; line-height:20px; text-align:center;display:block;"><font style='font:bold 12px/1.5em "Microsoft YaHei";color:#333333;font-size:24px '>会员协议</font></div>
		<div style="overflow:auto;width:860px;height:600px;margin-left:20px;word-break:break-all;">
			
			<p style="text-indent:28px;line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">在接受本协议之前，请您仔细阅读本协议的全部内容。您点击接受本协议即意味着您使用的逸管家账户所对应的法律主体同意受本协议约束。</span></span>
</p>
<p style="text-indent:28px;line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">如果您对本协议的条款有疑问，请通过逸管家客服渠道（或电话</span>400-100-9293<span style="font-family:宋体">）进行咨询，逸管家将向您解释条款内容。如果您不同意本协议的任何内容，请不要继续后续操作。</span></span>
</p>
<p style="text-indent:28px;line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议由同意遵照本协议及其附件与【逸管家电子商务平台】规则（详见本协议附件一）全部条款的法律主体（下称</span></span><strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">甲方</span></span></strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">或</span></span><strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">【联合体成员】</span></span></strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">）与【逸管家电子商务平台】合作联合运营人</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">—【</span><strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">意梓（上海）电子商务有限公司</span></span></strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">】</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">（下称</span></span><strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">乙方</span></span></strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">）在共同接受中华人民共和国法律约束、认可与保护之下，</span></span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">共同网签确认。</span></span>
</p>
<p style="text-indent:28px;line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p style=";line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】是由逸管家集团以</span>“新消费”模式为基础，通过服务于全球的企业管家、零售业管家、贸易经销商管家、私人管家与注册商家、注册会员交汇的模式，创造性构建的</span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">全球物联网大数据平台</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">]</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。该平台以投资于实体产业为方向，带动并联合中国及境外百万企业组合运营，致力于联合</span>“百万中小企业</span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">/</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">服务企业</span>”、“百万中小零售业”，在以共享经济的模式发展的同时，借助国际资本市场，</span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">&nbsp;</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">打造一个全球强大的经济集团。</span></span>
</p>
<p style=";line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p style=";line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">逸管家将致力于在</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">6000</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">万家中小企业中选择</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">100</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">万家生产企业</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">/</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">贸易商和</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">400</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">万家门店</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">/</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">各类服务商以联合体的方式造就集团核心体系，尝试为联合体内成员的资金、销售、品牌等系列问题提供解决方案。【逸管家电子商务平台】前期预计将涵盖《</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">B2B</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">板块》《</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">B2C</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">板块》《管家服务运营板块》《</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">O2O</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">板块》《社交板块》等服务综合体，未来还将会结合联合体会员的实际需求创设其他新兴板块纳入该平台。</span></span>
</p>
<p style=";line-height:150%;background:rgb(255,255,255)">
    <span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">一、&nbsp; </span></span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体"></span><span style="font-family:宋体">术语与定义</span></span></strong><br/>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">&nbsp;&nbsp;&nbsp; 除非本协议上下文另有所指，本协议中使用的简称含义如下：</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"></span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"></span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">1.1&nbsp; 【逸管家电子商务平台】指由逸务（上海）电子商务有限公司与意梓（上海）电子商务有限公司合作联合开发、运营及管理的，提供给联合体成员发布各类商品、服务、技术等信息并供联合体成员进行交易、接受服务与信息交流的网络信息平台。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.2</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">&nbsp; 【联合体成员】指向</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">用户提供商品、服务、技术等信息的法人或其他组织，细分则以</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">{</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">企业</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">}</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">{</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">商户</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">}</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">{</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">交易商</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">}</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">区分。他们是通过</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">与用户产生交易、安排商业行为的主体。</span></span><span style="font-family:宋体;color:rgb(0,0,0);font-size:14px"><br/></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.3</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">&nbsp; 【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】指与</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">运营人签署书面管家协议，以为【联合体成员】和【个人会员】提供综合服务为宗旨的自然人、法人及其他组织。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.4</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">&nbsp; 【个人会员】指接受并同意【逸管家电子商务平台】《用户使用协议》（详见本协议附件二）全部条款及运营人不时发布的其他全部服务条款和操作规则，访问和使用</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">与商户进行商业交易的使用者。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px"></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">1.5&nbsp; 【交易】指用户与联合体成员或其之间，在逸管家平台上所进行的商品或服务的支付。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">1.6&nbsp; 【信息】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">指联合体成员通过逸管家发布的商品、服务、技术等信息，此类信息包括但不限于商品、服务、技术的名称、种类、数量、质量、价格、配送方式、支付形式、退换货方式、退款条件、售后服务等内容。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.7&nbsp; </span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【价格】指用户为购买服务或商品而应向逸管家联合体支付的服务或商品的价格，价格的数额及变更以用户与逸管家联合体在当期交易撮合中达成的即期约定数额为确定依据，不具有追溯力。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.8&nbsp; </span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【佣金】指乙方或其指定的【特许经营商】根据本协议约定向甲方支付的服务费。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.9&nbsp; </span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【期权】指甲方作为</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">乙方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">平台签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家总监，乙方根据乙方母体</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">员工激励计划</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">在</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">符</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">合</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">一定条件下发行给甲</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">方一定</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">数量的母体</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">管</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">家期权。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.10&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">母</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">体】指</span>Chee </span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">Group International Limited</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">，</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">一家开曼群岛公司，乙方的非直接全资母公司。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">1.11&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【特许经营商】：</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">既</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">服务于逸管家平台，同时也是具有管理指定区域内【联合体成员】职能及由其负责的【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】团队的执行主体。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">二、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">协议内容、效力</span></span></strong>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:normal;font-size:14px">2.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议内容及所有乙方已经发布或将来可能发布的规则可在乙方互联网系统进行查看，甲方在使用乙方提供的各项服务时，承诺接受并遵守各项相关规则的规定。乙方有权根据需要另行制定补充规则。对于影响甲方权利义务的变更，乙方将提前至少</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">10</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">天在平台或系统中公示。甲方应在接收正式告知收讫之日</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">10</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">日内予以书面确认。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:normal;font-size:14px">2.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">补充协议一经生效即构成本协议双方权利义务的补充约定，并成为本协议的一部分。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:normal;font-size:14px">2.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议仅限于</span>2018<span style="font-family:宋体">年</span><span style="font-family:Times New Roman">11</span><span style="font-family:宋体">月</span><span style="font-family:Times New Roman">1</span><span style="font-family:宋体">日至</span><span style="font-family:Times New Roman">2018</span><span style="font-family:宋体">年</span><span style="font-family:Times New Roman">12</span><span style="font-family:宋体">月</span><span style="font-family:Times New Roman">31</span><span style="font-family:宋体">日前双方签署之用。该期限之前与之后乙方对不特定第三方设定的同类约定对甲方不予适用。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">三、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">关于甲方联合体成员身份的认领与激活</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-weight:normal;font-size:14px">3.1&nbsp;&nbsp; </span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方接受并签署本协议应视为甲方接受乙方提供给予甲方使用的乙方平台的用户名、密码、账号等身份的确认与领取。甲方应根据乙方平台使用流程上传资料进行身份、资质等各方面信息验证，待乙方根据《逸管家联合体成员准入标准规定》（详见本协议附件三）对前述信息审核通过，即意味着甲方的账号被激活，甲方将享有【逸管家电子商务平台】之【联合体成员】相关权益并承担相应义务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-weight:normal;font-size:14px">3.2&nbsp;&nbsp; </span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方将在根据本协议约定取得【联合体成员】资格当日自动享有【逸管家电子商务平台】之【个人会员】身份，并应同时遵守【逸管家电子商务平台】之《逸管家用户使用协议》（详见本协议附件二）等相关规定。</span> <br/></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">&nbsp; <br/></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">四、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">服务细则</span></span></strong>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">&nbsp;&nbsp; 【联合体成员】后续将根据《逸管家电子商务平台规则服务规定》（详见本协议附件五）并基于本协议约定成为适格【联合体成员】后严格遵守乙方所制定的相应服务准则向其【个人会员】及各方提供诚信、优质、高效的有偿服务。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">五、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">甲方同意之规则</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】仅作为第三方信息技术平台，为【联合体成员】及相关方提供商品、服务、技术等交易平台开发维护与技术支持服务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方同意并确认：本平台或运营管理人对于使用平台的交易各方的任何指向性权利、义务不存在任何保证、担保、代偿、替代责任。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方应当是具有完全民事行为能力的法人或其他组织，并符合本协议《逸管家联合体成员准入标准规定》（详见本协议附件三）的全部资质要求。否则，甲方不应接受乙方提供的任何服务</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">，乙方亦有权拒绝向甲方提供服务。如因甲方未如实披露相关信息或未遵守乙方相关规定及要求，对于已经发生的交易，乙方作为平台运营方有权取消相关交易，并要求甲方依法承担相应的法律责任。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.4&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方应妥善保管帐户及密码，承诺在每次上网或使用其他服务完毕后，将帐户安全退出，以保证帐户安全。甲方承诺不将帐户以任何方式出借、转让或用作其他非法用途，否则甲方应承担因此造成的任何损失并承担相应的法律责任。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.5&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">任何人利用甲方的帐户所进行的活动，均视为甲方本人的行为，由甲方对此负完全的责任。若甲方帐户或密码被盗或发生其他任何安全问题时，甲方应立即书面有效通知到乙方并向公安机关报案。乙方对未经法定限制的情形不承担任何责任。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.6&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方在注册及使用乙方服务时提交的信息应真实、准确、完整。若前述信息发生变更，甲方应及时修改。若因甲方提交的信息不真实、不准确、不完整，导致乙方无法提供服务或给其自身或任何方带来损失时，则该损失将由甲方自行承担。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.7&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方在使用乙方提供的服务时，应遵守本协议、本协议附件及其他协议的使用规则及法律法规，遵循自愿、平等、公平及诚实信用原则，不侵犯他人合法权益或谋取任何不正当利益，不扰乱交易秩序，不进行任何虚假交易，不得发送任何非法内容的信息。如乙方通过内部监管或经逸管家平台使用者举报，发现甲方存在违反法律规定或前述任何约定的行为并经合理验证后，乙方有权立即终止与甲方的合作，并要求甲方依法承担相应的法律责任。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">5.8&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方同意并确认，乙方仅为信息服务、实现对价交易的平台管理运营人，除本协议特别约定外，并非【联合体成员】所提供具体商品或者服务的生产者和销售者。甲方同意并承诺其针对由【联合体成员】所提供具体商品或者服务、售后服务的任何矛盾和纠纷均不应针对乙方提出或要求乙方进行解决。乙方亦不作为甲方、其他【联合体成员】及其交易对手的担保人、代责人或偿付人。</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"> <br/></span>
</p>
<p>
    <span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><br/></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">六、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">甲方与【逸管家电子商务平台】关系</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方根据本协议约定取得【联合体成员】的相关资格后，将有权向【个人会员】提供相关业务服务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">乙方将综合考量【联合体成员】的主营业务、地域位置、商业特征、发展需求等各方面因素后，将甲方交由指定的【特许经营商】、【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】并通过【逸管家电子商务平台】为甲方提供相应的付费服务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方根据</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">《逸管家管家准入标准规定》（详见本协议附件六）</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">经另行申请并获得批准许可后，本身也可以在与乙方另行签订《逸管家之管家协议》后作为【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】向其他【联合体成员】提供有偿服务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.4&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">根据本协议约定，甲方在乙方平台上提供的广告、宣传等各类信息及产品、服务须符合法律、法规、规章、《逸管家之联合体成员协议》及相关要求，产品及服务责任由甲方自行承担，如出现欺诈等违法违规或损害消费者权益的情况，【逸管家电子商务平台】及其管理人有权将甲方提供的产品或服务下架并单方面与该等甲方解除合作关系。</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"> <br/></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.5&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">作为【联合体成员】的生产企业、贸易商、实体门店、各类服务商作为商品或服务提供者与【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】、【个人会员】共同成为【逸管家电子商务平台】的核心。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6.6&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方须以诚实信用为第一行为准则，在【逸管家电子商务平台】上的一切行为，必须真实合法。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">七、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">乙方提供的服务</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;font-size:14px">7.1&nbsp;</span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】应尽商业上合理努力达成平台创始目标：通过对门店、服务商的分配和联合生产企业、贸易商的共同加入与合作；为【联合体成员】配置不同类型管家单位；向【注册会员】开放加入</span>{<span style="font-family:宋体">逸管家电子商务平台</span><span style="font-family:Times New Roman">}</span><span style="font-family:宋体">的所有企业及零售商家的客户端的相关资源，以求搭建、打造全球化、立体化的供给侧</span><span style="font-family:Times New Roman">+</span><span style="font-family:宋体">需求端和谐互利的商业模式。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">承诺在相关信息库建设完毕后向甲方进行开放，尽合理商业努力使【逸管家电子商务平台】成员体验全球物联网大数据信息，搭建真实、全面、细致的互联网大数据平台，搭建【逸管家电子商务平台】各分支板块的架构。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">根据商业规划对【逸管家电子商务平台】重点品牌进行统一推广，着力在新媒体、互联网、传统媒体、纸媒广告等渠道进行品牌形象包装及宣传，提升品牌附加价值。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.4&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">在【逸管家电子商务平台】成员各方致力于打造全球知名品牌、于全球各地自行办理相关新商标、新标识等相关知识产权的申请及注册过程中为成员提供必要且合理的协助，使前述成员在提升品牌价值同时，该品牌知识产权能得以全方位保护。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.5&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">负责开发网络系统以提供给【逸管家电子商务平台】成员各方在企业招聘、财务安排等一系列的管理系统规划安排中进行使用（包括</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">OA</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">PC</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">APP</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">CRM</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">系统、</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">ERP</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">及财务管理系统等所有互联网可使用系统）。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.6&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">整合联合体全方位资源，形成企业管家、经销商管家、贸易管家及私人管家服务，为【逸管家电子商务平台】成员各方提供企业私人定制服务，并尽商业上合理努力根据【逸管家电子商务平台】成员所需在包括开业登记、场地租赁、内部装潢、设备采购、耗材购买、代理记账、税务申报、人力资源、法务合规、清洁安保等领域提供相应</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">[</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">有针对性的推荐介绍、沟通渠道等一系列综合性解决方案提议与信息</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">]</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7.7&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">整合联合体资源，形成销售团队、销售渠道、销售系统、服务网点共享，技术团队共享，设计团队共享等，使运营成本降低，同时通过期权激励带动着消费增长，同时以管家系统为媒介实现销售突破。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">八、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">甲方工作任务及权益</span></span></strong>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.1&nbsp; <span style="font-family:宋体">甲方应在本协议签署后，经乙方根据《逸管家联合体成员准入标准规定》（详见本协议附件三）审核通过后在【逸管家电子商务平台】完成注册成为</span></span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">【联合体成员】</span></span></strong><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">，有权享受由特定【特许经营商】、【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】所提供的相关服务并可根据乙方平台相关规则与约定向【个人会员】提供相应产品与服务。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.2 <span style="font-family:宋体">【联合体成员】运营权期限：</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">2018</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">年</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">月</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">30</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">日至</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">2019</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">年</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">6</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">月</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">30</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">日为试运营期间，</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">2019</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">年</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">7</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">月</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">1</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">日</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">后为付费经营期间。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.3&nbsp; <span style="font-family:宋体">付费经营期间到期后，经双方协议，甲方按当期经营收费制度续费的，续费完成的可继续获得</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">【联合体成员】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">经营权及相关权益</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。</span></span>
</p>
<p style="text-indent:0;line-height:150%">
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.4&nbsp; <span style="font-family:宋体">甲方成为【联合体成员】须：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(1)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">符合</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">《逸管家联合体成员准入标准规定》（详见本协议附件三）并</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">经乙方审核通过。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(2)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">签约后</span>10<span style="font-family:宋体">个工作日内一次性支付【联合体成员】注册费</span><span style="font-family:Times New Roman">1</span><span style="font-family:宋体">万，该注册费因试运营期间给予【联合体成员】的最优奖励政策，本费用为【逸管家电子商务平台】系统费用，经由乙方安排而达成成员各方共同受益，乙方没有退还责任。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(3)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">付费经营期间【联合体成员】注册费为</span>1.1<span style="font-family:宋体">万</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">年。如甲方书面确认将参与后续付费经营期间，各方同意将于付费经营期开始后另行约定付费时间并由甲方向乙方指定账户支付前述费用</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(4)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">如甲方决定不参与付费经营的，甲方将有权随时终止本协议，并不须支付后续付费经营期间【联合体成员】注册费，甲方将无权参与【逸管家电子商务平台】后续开展的任何经营活动（包括试运营期间的相关经营活动）或享有任何权益，取消【联合体成员】资格；前述已缴纳的平台注册费已经由乙方安排而达成成员各方共同受益，乙方没有退还责任；甲方无其他责任</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。</span></span>
</p>
<p style="text-indent:0;line-height:150%">
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.5 <span style="font-family:宋体">服务及技术服务费：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(1)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">根据本协议约定，甲方在取得前述【联合体成员】资格后可向【个人会员】提供相应的商品、服务（以下简称</span>“</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">服务交易</span></span></strong><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">”），且甲方可提供的商品、服务范围及为【个人会员】所提供的服务质量应满足</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">《逸管家电子商务平台规则服务规定》（详见本协议附件五）相关</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">要求。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(2)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">根据本协议约定，甲方向【个人会员】</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">提供的服务交易可分为</span>(a)<span style="font-family:宋体">线上服务交易及</span><span style="font-family:Times New Roman">(b)</span><span style="font-family:宋体">线下服务交易，且前述服务交易的具体分类应以《逸管家电子商务平台规则服务规定》（详见本协议附件五）的分类界定为准。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(3)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方知晓并同意，甲方与【个人会员】达成的全部服务交易均应通过乙方平台进行定期结算；乙方有权对前述线上商品交易向甲方收取其费用总额</span>3</span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">.1%</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">的技术服务费、对前述线上服务交易向甲方收取其费用总额</span>8.6</span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">%</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">的技术服务费。该等技术服务费将由乙方在其平台进行费用结算时自动扣除，剩余的服务交易费用将由乙方系统自动结算至甲方指定账户。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(4)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">乙方将会综合考量甲方的主营业务、地域位置、商业特征、发展需求等各方面因素后，将甲方交由指定的【特许经营商】、【签约企业</span>/<span style="font-family:宋体">门店</span><span style="font-family:Times New Roman">/</span><span style="font-family:宋体">服务商管家】并通过【逸管家电子商务平台</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">】为甲方提供相应服务，前述所提供的服务范围、服务标准等信息应以《逸管家电子商务平台规则服务规定》（详见本协议</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">附件五）为准。</span></span>
</p>
<p style="text-indent:0;line-height:150%">
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"></span>8.6 <span style="font-family:宋体">甲方的</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">用户拓展权力：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(1)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方应在本协议约定期限内尽责从事【逸管家】平台所提示的</span>“【个人会员】分配事项”；</span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(2)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">经</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">协商并确认，甲方有权在</span>2019<span style="font-family:宋体">年</span><span style="font-family:Times New Roman">06</span><span style="font-family:宋体">月</span><span style="font-family:Times New Roman">30</span><span style="font-family:宋体">日前分配符合</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">《逸管家个人会员准入标准规定》（详见本协议附件四）</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">的【个人会员】合计</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">500</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">名，【逸管家电子商务平台</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">】对经线上注册确认的每个个人会员给予相应奖励。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.7 <span style="font-family:宋体">根据本协议约定及甲乙双方另行签订的期权合同，甲方将有权根据前述规定</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">获得一定数量的期权</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">或享有相当于该等数量的期权权益</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.8&nbsp; <span style="font-family:宋体">甲方根据本协议取得之【联合体成员】资格非经双方书面认可，不得转让、抵押、质押或再行完全或部分转授权第三人。</span></span>
</p>
<p style="text-indent:0;line-height:150%">
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.9&nbsp; <span style="font-family:宋体">基于第</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">8.4</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">项（1）款、（2）款</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">工作的全部完成，经乙方审核通过，甲方将有权获得下述额外权益及奖励：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">&nbsp;</span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">将有权根据与乙方另行签署的期权合同获赠相应</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">数量的期权</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">或享有相当于该等数量的期权权益；前述期权的行权和权益等相关事宜应以双方另行签署的期权合同为准；及试运营期间签约加入的【联合体成员】获得最优奖励条件。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.10 <span style="font-family:宋体">乙方根据本协议约定所收取的运营费、会员费、注册费、技术服务费等各类费用为【逸管家电子商务平台】系统费用，经由乙方安排而达成成员各方共同受益，除本协议另行约定外，乙方没有退还责任。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.11 <span style="font-family:宋体">甲方向指定【个人会员】及相关对象提供服务、完成分配事项及履行其他根据本协议所约定的职责过程中所产生的全部费用应由甲方自行承担，除本协议另行约定，甲方同意并确认乙方无义务为甲方提供任何形式的垫付、报销、补助等。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">8.12 <span style="font-family:宋体">双方在履行本协议约定过程中所发生的各项税收等费用应根据相关法律、法规及其他规范性文件的要求由双方自行承担。</span></span>
</p>
<p>
    <br/>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">九、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">知识产权</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">9.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">甲方同意，在使用乙方平台中，任何平台相关信息、图片、协议、技术、用户评论等信息都属于乙方的合法知识产权。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">9.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">乙方许可的关联方有权将上述信息内容进行使用或者与其他人合作使用，使用范围包括但不限于网站、电子杂志、杂志、刊物等。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">保密条款</span></span></strong>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">10.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">自本协议签署确认之日起，除非</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">一致另行同意，每一方应当，并应促使该一方控制的每一人士，对本协议、本协议项下任何条款、条件及其存在，每一方的身份，以及从另一方处收到或该一方准备的、仅与本协议或前述文件相关的具有非公开性质的任何其他信息（以下合称</span>“</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">保密信息</span></span></strong><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px">”）保密；</span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">10.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">但是，任何一方可在以下情况下披露保密信息或允许保密信息的披露：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(1)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">在适用法律或任何交易所规则要求披露的范围内；但该一方应当，在可行并在适用法律许可的范围内立即将该事实书面通知其他各方，并且（在其他各方的合作和合理的努力下）采取一切合理的努力以寻求获取保护性命令、保密待遇或其他适当的救济；在该等情形下，该一方应仅提供被合法地要求披露的那部分保密信息，并应尽合理的努力在任何其他各方合理要求的范围内使该等保密信息处于保密状态；</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(2)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">为履行其与本协议相关的义务，在必须知晓的情形下向其管理人员、董事、雇员、投资人、合伙人、股东和专业顾问披露，只要该一方向获得所披露的任何保密信息的每一人士告知该等保密信息的保密性质，且该人士就保密信息承诺遵守与该一方相同的保密义务。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">10.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">为避免疑问，保密信息不包括下列信息：</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(1)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">在披露方披露前，接收方已合法掌握的信息；</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(2)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">非因接收方违反本协议第十条所作的披露而为公众所知的信息；</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-size:14px">(3)&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">接收方从第三方处合法获得的信息，接收方并不知道该第三方违反任何不向其披露该信息的法律或合同义务。</span></span>
</p>
<p style=";line-height:150%;background:rgb(255,255,255)">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十一、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">合同的变更、解除、终止履行</span></span></strong>
</p>
<p>
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">经甲乙双方协商一致，可以对本协议进行修改、变更或提前终止。任何修改、变更或提前终止必须制成书面文件，经本协议</span></span><span style=";font-family:Calibri;font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">签署后生效。</span></span>
</p>
<p>
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十二、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">违约责任</span></span></strong>
</p>
<p>
    <span style="font-family:Calibri;font-size:14px">12.1&nbsp;</span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">任何一方违反、延迟履行、未能履行或拒不履行其在本协议中的任何约定，或其在本协议或合作期间作出任何</span></span><span style=";font-family:Calibri;font-size:14px"><span style="font-family:宋体">不真实</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">的陈述或保证，即构成违约行为。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">12.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">任何一方违反本协议，致使另一方承担任何费用、责任或蒙受任何损失，违约方应就上述任何费用、责任或损失（包括但不限于因违约而支付或损失的利息以及律师费）赔偿守约方。违约方向守约方支付的赔偿金总额应当与因该违约行为产生的损失相同，上述赔偿包括守约方因履约而应当获得的利益，但该等预期收益不得超过协议双方的合理预期。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">12.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">如甲方以欺诈用户、安排虚假招商广告、非法或违规收取保证金、佣金等任何形式获得非法利益，或利用【逸管家电子商务平台】从事任何违法违规行为，乙方将有权单方终止本协议并依法追究甲方兴业的法律责任。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十三、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">不可抗力</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">13.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">如果任何一方在本协议签署确认之后因任何不可抗力事件的发生（包括发生诸如地震、台风、洪水、火灾、军事行动、出现罢工、暴动、战争、或其他协议一方所不能合理控制的不可预见之不可抗力事件）而不能履行本协议的条款和条件，受不可抗力阻止的一方应在不可抗力事件发生后毫不延迟地立即通知其他协议方，并在通知发出后的</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">日内提供该等事件的详细资料和证明文件，解释不能或延迟履行其在本协议项下全部或部分义务的原因并向其他方提供由相关主管部门出具的声明该事件为不可抗力事件的书面凭证。</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">应通过协商寻求找到并执行协议</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">均能接受的解决方法。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">13.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">由于不可抗力事件而导致任何本协议的延迟履行或未能履行均不应构成受不可抗力阻止的一方的违约，并且不应因此导致就任何损害、损失或罚金的索赔。在此情况下受不可抗力阻止的一方</span></span><span style=";font-family:宋体;color:rgb(51,51,51);font-size:14px;background:rgb(255,255,255)"><span style="font-family:宋体">应采取一切措施，使因不可抗力导致的损失减少到最低限度，且</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">仍有义务采取合理可行的措施履行本协议未受影响的其他约定。不可抗力事件消除后，受不可抗力阻止的一方应尽快向合同他方发出不可抗力事件消除的书面通知。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">13.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">如不可抗力事件或不可抗力事件的影响阻碍一方或</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">履行其在本协议项下的全部或部分义务为期一（</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">1</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">）个月以上，则未受不可抗力影响的协议方有权要求终止本协议并免除本协议规定的部分义务或延迟本协议的履行。</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体"><br/></span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十四、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">法律适用与争议解决</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议的订立、执行及解释适用中国法律。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">用户如与甲方因交易的约定或履行（包括但不限于商品或服务的数量、质量、价格、有效期、预约时间、配送方式售后服务）等问题发生争议或纠纷，甲方应根据自身发布的信息作为真实依据向用户履行服务义务并承担因此发生的所有费用。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">若用户发现甲方在提供商品或服务时损害了用户的合法权益，用户有权依据《中华人民共和国消费者权益保护法》及相关法律、法规的规定向该甲方主张并维护自己的合法权益。甲方如无合理原因不得拒绝履行对用户的先行赔付义务。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14.4&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">若本协议在履行过程中发生的或与本协议有关的一切争议，双方应友好协商解决；如</span></span><span style=";font-family:宋体;font-size:15px"><span style="font-family:宋体">在争议发生后十五（</span></span><span style=";font-family:&#39;Times New Roman&#39;;font-size:15px">15</span><span style=";font-family:宋体;font-size:15px"><span style="font-family:宋体">）天内</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">协商不成的，</span></span><span style=";font-family:宋体;font-size:15px"><span style="font-family:宋体">任何一方有权</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px"><span style="font-family:宋体">将该争议</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">提交</span></span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">香港国际仲裁中心</span></span></strong><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px;background:rgb(255,255,255)">&nbsp;(Hong Kong International Arbitration Center, HKIAC)</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">进行仲裁，并确认适用其届时有效的仲裁规则进行仲裁。甲乙双方确认适用法律为中华人民共和国法律。仲裁庭应由一（</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">1</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">）名双方共同指定的仲裁员组成，仲裁语言为中文。该仲裁裁决是终局性的，对本协议双方均具有法律约束力。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">14.5&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">争议解决期间，双方继续拥有各自在本协议项下的其它权利并应继续履行其在本协议下的相应义务。</span></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span>
</p>
<p>
    <span style="font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px">十五、&nbsp;</span><strong><span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">合同效力及其他条款</span></span></strong>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.1&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议及其附件构成</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">就本协议合作事宜达成的完整协议，并取代</span></span><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">双方</span></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">此前关于本次交易所达成的任何协议、意向书、备忘录、陈述或其他义务（无论以书面或口头形式，包括各类沟通形式），且本协议（包括其修改协议或修正，以及附件及其他相关文件）包含了双方就本协议项下事项的唯一和全部协议。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.2&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议经甲乙方合法签署后生效。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.3&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">为保障双方权益，甲乙双方另行签订的纸质加盟协议与本协议具备同等法律效力。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.4&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议的附件是本协议不可分割的组成部份，与本协议正文互为补充并具有同等的法律效力。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.5&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议任何条款的无效不应影响本协议任何其它条款的有效性。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.6&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">本协议任何一方未行使或延迟行使本协议的任何权利、权力或特权不应视为放弃这些权利、权力或特权；任何单独一次或部分放弃行使任何权利、权力或特权亦不应妨碍将来行使这些权利、权力或特权。</span></span>
</p>
<p>
    <span style="font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-size:14px">15.7&nbsp;</span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">鉴于【逸管家电子商务平台】为逸务（上海）电子商务有限公司与意梓（上海）电子商务有限公司合作联合开发并运营，且双方共同归属于逸管家集团。逸务（上海）电子商务有限公司已授权意梓（上海）电子商务有限公司全权代表其签署与【逸管家电子商务平台】相关的协议，以及协议中涉及款项的收款、付款工作。</span></span>
</p>
<p style="text-align:center;line-height:150%">
    <span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px"><span style="font-family:宋体">以下无正文</span></span><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">]</span>
</p>
<p style="line-height:150%">
    <span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">&nbsp;</span>
</p>
<p style=";text-align:left;line-height:150%">
    <span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px"><br/></span>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件一：</span></span></strong>
</p>
<p style="text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">【逸管家电子商务平台】规则</span></span></strong>
</p>
<p style=";text-align:center;line-height:150%">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">详见逸管家电子商务平台规则</span></span><strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件二：</span></span></strong>
</p>
<p style=";text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">《用户使用协议》</span></span></strong>
</p>
<p style=";text-align:center;line-height:150%">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">详见逸管家电子商务平台规则</span></span><strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件三：</span></span></strong>
</p>
<p style="text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">《逸管家联合体成员准入标准规定》</span></span></strong>
</p>
<table width="507">
    <tbody>
        <tr style="height:18px" class="firstRow">
            <td colspan="6" style="padding: 0px 7px; border-color: windowtext; border-style: solid; border-width: 1px;" width="507" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">联合体准入标准</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">编号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">材料名称</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">文档形式</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">编号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">材料名称</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">文档形式</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">1</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">公司名称</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">8</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">对接人手机号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">2</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">营业执照</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">9</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">开户行</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">3</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">开户行许可证</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">10</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">账号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">4</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">公司负责人姓名</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">11</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">企业性质</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">5</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">公司负责人手机号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">12</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">企业规模</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">6</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">公司办公地址</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">13</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">年度销售额</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:15px">7</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="154" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">对接人信息</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="40" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">14</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="116" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:15px">服务需求</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="78" valign="center"></td>
        </tr>
    </tbody>
</table>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件四：</span></span></strong>
</p>
<p style="text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">《逸管家个人会员准入标准规定》</span></span></strong>
</p>
<p style="text-indent:28px">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">个人会员准入标准：</span></span>
</p>
<p style="margin-left:5px;text-indent:28px">
    <span style=";font-family:宋体;font-size:14px">1、个人会员应当具备中华人民共和国法律规定的与其</span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">相</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">适应的民事行为能力。</span></span><span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">若不具备前述与其行为相适应的民事行为能力，则其本人及其监护人应依照法律规定承担因此而导致的一切后果。</span></span>
</p>
<p style="margin-left:28px">
    <span style=";font-family:宋体;font-size:14px">2、个人会员还需确保不是任何国家、国际组织或者地域实施的贸易限制、制裁或其他法律、规则限制的对象，否则可能无法正常注册及使用逸管家平台服务。</span>
</p>
<p style="margin-left:28px">
    <span style=";font-family:宋体;font-size:14px">3、个人会员须在平台使用本人真实身份信息注册。</span>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件五：</span></span></strong>
</p>
<p style="text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">《逸管家电子商务平台规则服务规定》</span></span></strong>
</p>
<p style="text-align:center">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">详见逸管家电子商务平台规则</span></span>
</p>
<p>
    <span style=";font-family:宋体;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件六：</span></span></strong>
</p>
<p style="text-align:center;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">《逸管家管家准入标准规定》</span></span></strong>
</p>
<p style="text-indent:28px">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">管家准入标准（自然人）：</span></span>
</p>
<p style="text-indent:28px">
    <span style=";font-family:宋体;font-size:14px"><span style="font-family:宋体">管家应当是具有完全民事行为能力的自然人、无犯罪记录</span></span>
</p>
<table width="488">
    <tbody>
        <tr style="height:18px" class="firstRow">
            <td colspan="4" style="padding: 0px 7px; border-color: windowtext; border-style: solid; border-width: 1px;" width="488" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">管家准入标准（法人）</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">编号</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1px 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">材料名称</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1px 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">文档形式</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1px 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">备注</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">1</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">营业执照正、副本/事业单位法人证书</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">2</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">员工登记表及任职情况</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">3</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">税务登记证</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">4</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">银行开户许可证及银行开户明细</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">5</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">公司成立章程或企业组织文件及其变动文件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">要求:工商部门调阅并盖章</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">7</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">法定代表人或负责人身份证明</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">8</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">主要股东身份证明</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">公司股东提供最基本资料</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px">
            <td rowspan="5" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">9</span>
                </p>
            </td>
            <td rowspan="5" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">&nbsp;最近3年及申请前一个月的财务报表</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px">&nbsp;</span>
                </p>
            </td>
            <td rowspan="5" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td rowspan="5" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style="margin-bottom:16px;text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">1.包括资产负债表、损益表及会计报表附注，现金流量表；</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">2.成立不足三年的，提交自成立以来年度和申请前一个月的财务</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">报表。</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px"></tr>
        <tr style="height:21px"></tr>
        <tr style="height:21px"></tr>
        <tr style="height:21px"></tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">10</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">&nbsp;纳税申报表或纳税证明</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">11</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">最近2年交易账户银行对帐单</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/存折复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">12</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">相关资质证书、特殊行业批准/许可文件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">13</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">在履行合同及2年内已履行合同 </span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px">
            <td rowspan="3" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">14</span>
                </p>
            </td>
            <td rowspan="3" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">&nbsp;主要资产明细及证明资料,使用地 </span>
                </p>
            </td>
            <td rowspan="3" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td rowspan="3" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">包括房地产证明、机器设备清单</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">存货清单、应收款清单、对外投资合同或协议等</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px"></tr>
        <tr style="height:21px"></tr>
        <tr style="height:21px">
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">15</span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">抵/质押物权属证明、评估报告和作价依据</span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">1.如采用此担保方式；2.评估报告/作价依据必须提供原件.</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px"></tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">16</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">征信授权书（法定代表人及公司</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center"></td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">17</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">最近2年度内债权\债务明细 </span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:18px">
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">18</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">&nbsp;待结诉讼\仲裁文书及法院执行裁决 </span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件/复印件</span>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">根据实际需要</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">提供</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px">
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="26" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">19</span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="230" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">前述文件材料--真实性承诺函 </span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="92" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">原件</span>
                </p>
            </td>
            <td rowspan="2" style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="140" valign="center">
                <p style=";text-align:center;line-height:16px">
                    <span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">由法定代表人、股东承</span><span style="font-family:宋体;color:rgb(0,0,0);font-size:12px"><br/></span><span style=";font-family:宋体;color:rgb(0,0,0);font-size:12px">担真实性联保责任</span>
                </p>
            </td>
        </tr>
        <tr style="height:21px"></tr>
    </tbody>
</table>
<p style=";text-align:center;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><br/></span></strong>
</p>
<p style="text-align:left">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<p style=";text-align:left;line-height:150%">
    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">附件七：</span></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong><strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px"><span style="font-family:宋体">本协议双方银行账户基本信息</span></span></strong>
</p>
<p style="line-height:150%">
    <strong><span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">&nbsp;</span></strong>
</p>
<table width="604">
    <tbody>
        <tr class="firstRow">
            <td style="padding: 0px 7px; border-color: windowtext; border-style: solid; border-width: 1px; background: rgb(190, 190, 190) none repeat scroll 0% 0%;" width="123" valign="center"></td>
            <td style="padding: 0px 7px; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1px 1px 1px medium; background: rgb(190, 190, 190) none repeat scroll 0% 0%;" width="246" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">甲方</span></strong>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1px 1px 1px medium; background: rgb(190, 190, 190) none repeat scroll 0% 0%;" width="236" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">乙方</span></strong>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="123" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">账户名</span></strong>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="246" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="236" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <span style="font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px">意梓（上海）电子商务有限公司</span><span style="font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">]</span>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="123" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">账户号码</span></strong>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="246" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="236" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[98140155300001179]</span>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="123" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">开户行</span></strong>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="246" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="236" valign="center">
                <p style=";text-align:center;line-height:150%;background:rgb(255,255,255)">
                    <span style="font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[</span><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-size:14px">浦发银行上海普陀支行</span><span style="font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">]</span>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1px 1px;" width="123" valign="center">
                <p style=";text-align:center;line-height:150%">
                    <strong><span style=";font-family:宋体;line-height:150%;color:rgb(0,0,0);font-weight:bold;font-size:14px">税号</span></strong>
                </p>
            </td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="246" valign="center"></td>
            <td style="padding: 0px 7px; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1px 1px medium;" width="236" valign="center">
                <p style=";text-align:center;line-height:150%;background:rgb(255,255,255)">
                    <span style=";font-family:&#39;Times New Roman&#39;;line-height:150%;color:rgb(0,0,0);font-size:14px">[91310115350882250N]</span>
                </p>
            </td>
        </tr>
    </tbody>
</table>
<p>
    <br/>
</p>
<p>
    <br/>
</p>

		</div>
	</div>	
</div>
<div class="container" style="background-color: #f5f5f5">
<div class="row">
		<div class="span12">
			<div class="yiwu">
				
			</div>
			<div class="luichi navbar-fixed-bottom">
				逸务(上海)电子商务有限公司  沪ICP备14024312号  Copyright©2014-2016
			</div>
		</div>
</div>
</div>

<div class="moreuser" style="display:none;">
	<table style="align:center;margin:auto" class="moreusertable"></table>
</div>

<div id="dialog-message" class="hide" title="<?php echo L('ANNOUNCEMENT');?>">loading...</div>
<input type="hidden"  id="manager" value="<<?php echo ($url); ?>>">
<script type="text/javascript">
//判断是否签署协议
 $('.btn-primary').on('click',function(){
	 $(".moreusertable").empty();
 
	var formdata = $('.form-signin').serialize();
	$.post('<?php echo U("User/login");?>',formdata,function(atm){
		
	//	$.post('/crm/207/index.php?m=user&a=login',formdata,function(atm){
		if(atm.success == 1 ){
			$('.form-signin .message').html("<font color='green'>"+atm.message+'</a>')
			window.location.href= atm.url;
		}else{
			
			if(atm.message == 'moreuser'){
				
				for(var i = 0 ; i < atm.userList.length ; i++){
					$(".moreusertable").append("<tr width='100%' class='userinfo'> <td width='40%' class='img'><img height='50' width='50' src=" + atm.userList[i]['img'] + " /></td><td  width='40%' class='username'>" + atm.userList[i]['name']+ "</td><td width='40%'><input type='button' class='intoshop' value='进入' /></td></tr>");
				}
				
				layer.open({
					type: 1,
					title: "<h4 style='text-align:center'>请选择你要管理的店铺</h4>",
					content: $(".moreuser").html()+'<span class="save-agree" style="float:left;width:100%;text-align: center;"><button style="background:#029be1;color:white;height:43px;width:115px;margin-top:100px;padding:10px;border-radius:5px" type="button" class="btn closelogin">取消登录</button></span>',
					skin: 'layer-ext-moon',
					area: ['30%','40%'],
					resize: false,
					shadeClose: true,
					success:function(){				
						$(".intoshop").on("click",function(){
							var newname = $(this).parent().prev().text();
							$(this).parent().prev().addClass("newname");
							var newpwd = $(".password").val();
							var selectshop = 1;
							//debugger
							$.post('<?php echo U("User/login");?>',{'name':newname,'password':newpwd,'selectshop':selectshop},function(result){
								if(result.success == 1){
									window.location.href = result.url;
									
								}else{
									
									if(result.message == 'noSign'){
									
										//noSignAjax--start
										layer.open({
											type: 1,
											title: '',
											content: $('.agreement').html()+'<span class="save-agree" style="float:left;width:100%;text-align: center;"><button style="background:#029be1;color:white;height:43px;width:115px;margin:40px;padding:10px;border-radius:5px" type="button" class="btn agreementsubmit">同意协议去发布</button></span>',
											skin: 'layer-ext-moon',
											area: ['80%','90%'],
											resize: false,
											shadeClose: true,
											success:function(){
												$('.agreementsubmit').on('click',function(){
													var newname = $(".newname").text();
													var newpwd = $(".password").val();
													$.post('<?php echo U("User/agreeagrenment");?>',{'name':newname,'password':newpwd},function(result){
													//$.post('/crm/207/index.php?m=user&a=agreeagrenment',data,function(result){
											//debugger
														if(result.success == 1){
															window.location.href = result.url;
															
														}else{
															alert(result.message);
															window.location.href = window.location.href;
														}
													},'json')
												});
											}
										});
										
									//noSignAjax--end

									}else{
										alert(result.message);
										window.location.href = window.location.href;
									}
									
								}
							})
							
						})
						
						$('.closelogin').on('click',function(){
							layer.closeAll();
							window.location.href = window.location.href
							
						});
					}
				});
				
				
			}else{
				if(atm.message == 'noSign'){

					//noSignAjax--start
					layer.open({
						type: 1,
						title: '',
						content: $('.agreement').html()+'<span class="save-agree" style="float:left;width:100%;text-align: center;"><button style="background:#029be1;color:white;height:43px;width:115px;margin:40px;padding:10px;border-radius:5px" type="button" class="btn agreementsubmit">同意协议去发布</button></span>',
						skin: 'layer-ext-moon',
						area: ['80%','90%'],
						resize: false,
						shadeClose: true,
						success:function(){
							$('.agreementsubmit').on('click',function(){
								data = $('.form-signin').serialize();
								$.post('<?php echo U("User/agreeagrenment");?>',data,function(result){
								//$.post('/crm/207/index.php?m=user&a=agreeagrenment',data,function(result){
									if(result.success == 1){
										window.location.href = result.url;
										
									}else{
										alert(result.message);
										window.location.href = window.location.href;
									}
								},'json')
							});
						}
					});
					
				//noSignAjax--end

				}else{
					$('.form-signin .message').html("<font color='red'>"+atm.message+'</a>')
				}
				
				
			}
		}

	})
} )

//回车触发登录
$(document).keyup(function(event){
 if(event.keyCode ==13){
  $(".btn-primary").trigger("click");
 }
});


$('#dialog-message').dialog({
	autoOpen: false,
	modal: true,
	width: 600,
	maxHeight: 400,
	position :["center",100]
});
function show(id) {
	$('#dialog-message').dialog('open');
	content = $("#content" + id).html();
	$('#dialog-message').html(content);
}
</script>
</body>
</html>