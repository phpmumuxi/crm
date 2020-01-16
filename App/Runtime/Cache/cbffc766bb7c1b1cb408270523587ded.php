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
<link type="text/css" href="__PUBLIC__/js/select2/select2.css" rel="stylesheet" />
<script src="__PUBLIC__/js/select2/select2.js" type="text/javascript"></script>
<style>
.subbtn{width:76px;}
.table th, .table td{text-align: center;vertical-align:middle;}
</style>
<div class="container">
    <div class="page-header">
        <h4>订单管理</h4>
    </div>
    <?php if(is_array($alert)): foreach($alert as $k=>$v): if(is_array($v)): foreach($v as $kk=>$vv): ?><div class="alert alert-<?php echo ($k); ?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo ($vv); ?>
		</div><?php endforeach; endif; endforeach; endif; ?>
    <div class="row">
        <div class="span2 knowledgecate">
            <ul class="nav nav-list">
                <li class="active">
                    <a href="<?php echo U('Order/send');?>">发货管理</a>
                </li>
            </ul>
        </div>
        <div class="span2"></div>
        <div class="span8">
            <input type="hidden" name="" value="<?php echo U('Order/index');?>" class="url">
            <input type="hidden" value="<?php echo $_GET['payNo']?>" id="payNo">
            <input type="hidden" value="<?php echo $_GET['orderNo']?>" id="orderNo">
            <input type="hidden" value="<?php echo $_GET['orderChangeDatetime']?>" id="orderChangeDatetime">
            快递公司:&nbsp;&nbsp;&nbsp;
         <!--    <input type="text" name="courier" value="" placeholder="" class="courier"><br><br> -->
            <select class="selectAchieve" id="ems" style="width:auto" name="ems">
                <!-- <option expressNumber='<?php echo ($vo["member"]); ?>' expressTelphone="<?php echo ($vo["tel"]); ?>" expressCompanycCode="<?php echo ($vo["type"]); ?>"><?php echo ($vo["name"]); ?></option> -->
            <?php if(is_array($ems)): $i = 0; $__LIST__ = $ems;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option expressNumber='' expressTelphone="" expressCompanycCode="<?php echo ($vo["no"]); ?>"><?php echo ($vo["com"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>    
            </select>&nbsp;<br><br>
            物流单号:&nbsp;&nbsp;&nbsp;
            <input type="text" name="" value="" id="numbers"/><br><br>
            <span type="" class="btn btn-primary subbtn" value="" onclick="submit();">提交</span>
            <span type="" class="btn btn-primary " onclick="noSendEms();">我已发货,但提供不了上面信息</span>
            <span type=""  class="btn btn-primary subbtn" value="" onclick="back();">取消</span>
        </div>
    </div>

    <script type="text/javascript">
    $('.selectAchieve').select2({
        placeholder: "请选择所属选项",
        allowClear: true
    });  

        // $.ajax({
        //         type: "POST",
        //         cache: true,
        //         async: true,
        //         ifModified:true,
        //         timeout:120000,
        //         url:'<?php echo ($url); ?>/manager/order/express/queryExpressCompanyInfo',
        //         data:{},
        //         dataType:'json',
        //         success:function(data){
        //             console.log(data);
        //         },
        //         error:function(){
        //             alert('网络异常!');
        //         }
        //     });


        var payNo = $("#payNo").val();
        var orderNo = $("#orderNo").val();
        var orderChangeDatetime= $("#orderChangeDatetime").val();
        function submit(){
            //var courier = $('#courier option:selected').text();
            var url = $('.url').val();
            var expressNumber = $('#numbers').val();
           
            // console.log(numbers);
            var expressCompanyName  =  $("#ems").find("option:selected").text();
            var expressTelphone = $("#ems").find("option:selected").attr("expressTelphone");
            var expressCompanycCode = $("#ems").find("option:selected").attr("expressCompanycCode");
            
            if (expressNumber == '') {
                alert('请输入物流单号');
                return;
            }
            if(payNo == ''){
                alert('缺少参数!');
                return;
            }
            $.ajax({
                type: "POST",
                cache: true,
                async: true,
                ifModified:true,
                timeout:12000,
                url:'<?php echo ($url); ?>/manager/order/express/save',
                data:{mainTradeNo:payNo,orderNo:orderNo,expressNumber:expressNumber,expressCompanyName:expressCompanyName,expressTelphone:expressTelphone,expressCompanycCode:expressCompanycCode},
                dataType:'json',
                success:function(json){
                    var orderNo = $("#orderNo").val();
                    // console.log(json);return;
                    if(json.code == 2000){
                        $.ajax({
                            type: "POST",
                            cache: true,
                            async: true,
                            ifModified:true,
                            timeout:12000,
                            url:'<?php echo ($url); ?>/manager/order/megerOrderStatusChange',
                            data:{orderNo:orderNo,orderStatusChanged:'F14',childOrderStatusChanged:'14',orderType:1,orderChangeDatetime:orderChangeDatetime},
                            dataType:'json',
                            success:function(data){
                                alert(data.message);
                                window.location.href = url;
                            },
                            error:function(){
                                alert('异常!');
                            }
                        });
                       
                    }
                 
                },
                error:function(){
                    alert('异常!');
                }
            });
        }


        function noSendEms(){
            var url = $('.url').val();
            var orderNo = $("#orderNo").val(); 
            $.ajax({
                type: "POST",
                cache: true,
                async: true,
                ifModified:true,
                timeout:12000,
                url:'<?php echo ($url); ?>/manager/order/megerOrderStatusChange',
                data:{orderNo:orderNo,orderStatusChanged:'F14',childOrderStatusChanged:'14',orderType:1,orderChangeDatetime:orderChangeDatetime},
                dataType:'json',
                success:function(json){
                 //console.log(json);
                 if (json.code == 2000) {
                    alert(json.message);
                    window.location.href = url;

                 }
                },
                error:function(){
                    alert('异常!');
                }
            });
            
        }

        function back(){
            var url = $('.url').val();
            window.location.href = url;
        }


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