<?php

return array(
	//支付宝配置参数
	'alipay_config'=>array(
// 		'partner' =>'2088121410963779',   //这里是你在成功申请支付宝接口后获取到的PID；
// 		'key'=>'6c79qboj8qvk4t4ws1kk9zzq6bd4jpig',//这里是你在成功申请支付宝接口后获取到的Key
			'partner' =>'2088821612694490',   //这里是你在成功申请支付宝接口后获取到的PID；
			'key'=>'pb46lb0dglsnn7wk1yi2b8sv0jfotgus',//这里是你在成功申请支付宝接口后获取到的Key
		'sign_type'=>strtoupper('MD5'),
		'input_charset'=> strtolower('utf-8'),
		'cacert'=> getcwd().'\alipay'.'\\cacert.pem',
		'transport'=> 'http',
	),

	'alipay'   =>array(
		//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		//'seller_email'=>'2088121410963779',
			'seller_email'=>'2088821612694490',
	
		//这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		'notify_url'=>'http://192.168.1.209:7000/crm/207/index.php/Pay/notifyurl',
	
		//这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		'return_url'=>'http://192.168.1.209:7000/crm/207/index.php/Pay/returnurl',
	
		//支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
		'successpage'=>'Order/back?ordtype=payed',
	
		//支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
		'errorpage'=>'Order/back?ordtype=unpay',
	),

);