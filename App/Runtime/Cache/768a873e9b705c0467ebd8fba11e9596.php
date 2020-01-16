<?php if (!defined('THINK_PATH')) exit();?><ul class="dropdown-menu">
							<li><a href="<?php echo U('dynamic/index');?>">动态信息</a></li>
							<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["title"] != ''): ?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo U('user/logout');?>"><?php echo L('EXIT');?></a></li>
						</ul>