<?php if (!defined('THINK_PATH')) exit();?><div class="nav-collapse collapse">
	<ul class="nav" >
		<?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["title"] == '订单'): ?><li <?php if(strtolower(MODULE_NAME) == strtolower($vo['module'])): ?>class="active"<?php endif; ?>>
			<a  href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
			</li><?php endif; ?>
			
			<?php if($vo["title"] == '产品'): ?><li <?php if(strtolower(MODULE_NAME) == strtolower($vo['module'])): ?>class="active"<?php endif; ?>>
			<a  href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
			</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["title"] != '' and $vo["title"] != '订单' and $vo["title"] != '产品'): ?><li <?php if(strtolower(MODULE_NAME) == strtolower($vo['module'])): ?>class="active"<?php endif; ?>><a  href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<?php if($_SESSION['position_id']== '17' OR $_SESSION['position_id']== '18' OR $_SESSION['position_id']== '19' OR $_SESSION['position_id']== '16'): ?><li><a href="<?php echo (C("YIGUANJIACLUB")); ?>/login.html" target="view_window">聊天</a></li><?php endif; ?>
		<?php if($_SESSION['position_id']!= '13'): ?><li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo L('MORE');?> <b class="caret"></b></a>
				<ul class="dropdown-menu">					
					<?php if(is_array($more)): $i = 0; $__LIST__ = $more;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["title"] != ''): ?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<li class="divider"></li>
					<li><a href="<?php echo U('navigation/index');?>"><?php echo L('MENU_SETTINGS');?></a></li>
					<li><a href="javascript:;">客服电话 : 400-100-9293</a></li>	
				</ul>
			</li><?php endif; ?>
	</ul>

</div>

<div id="message" class="hide"><p id="tips"></p></div>
<div class="hide" id="dialog-message-send" title="<?php echo L('WRITE_LETTER');?>">loading...</div>
<script type="text/javascript">
$('#dialog-upgrade').dialog({
	autoOpen: false,
	modal: true,
	width: 600,
	maxHeight: 400,
	position :["center",100],
	buttons: { 
		"OK": function () {
			$(this).dialog("close");
		}
	}
});

$('#dialog-authorize').dialog({
	autoOpen: false,
	modal: true,
	width: 600,
	maxHeight: 400,
	position :["center",100],
	buttons: { 
		"OK": function () {
			$(this).dialog("close");
		}
	}
});
$("#dialog-message-send").dialog({
    autoOpen: false,
    modal: true,
	width: 800,
	maxHeight: 600,
	position: ["center",100]
});
function check_version() {
	$('#dialog-upgrade').dialog('open');
	$.get("<?php echo U('upgrade/index');?>", function(data){
		if (data.status) {
			info = "<span style='color:green;'>" + data.info + "</span>";
		} else {
			info = "<span style='color:red;'>" + data.info + "</span>";
		}
		$("#dialog-upgrade #info").html(info);
	});
}

a = 1;
function fn(){
	if(a == 1){
		$('#message_tips').css({color:'#fff'});
		a = 0;
	}else{
		$('#message_tips').css({color:'#D2D2D2'});
		a = 1;
	}
}
var myInterval;
</script>