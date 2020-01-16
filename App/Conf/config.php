<?php
return array(
	'URL_MODEL'=>0,
	'URL_CASE_INSENSITIVE' =>true,
	'URL_HTML_SUFFIX'=>'html|shtml|xml',
	'SSLFILEPEM' => 'D:\wamp64\web\crm207\cert\jks\cacert.pem',//测试环境ssl的公钥文件
	'SSLCOOKIE' => 'D:\wamp64\web\crm207\logs\cookie.txt',//访问ssl后的cookie文件
	
	//'配置项'=>'配置值'
	// 'URL_PATHINFO_DEPR' => '/',								//修改分隔符
	// 'URL_ROUTER_ON' => true,								//开启路由功能
	// 'URL_CASE_INSENSITIVE' =>true,
	//sql解析缓存
	// 'DB_SQL_BUILD_CACHE' => true,
	// 'DB_SQL_BUILD_QUEUE' => 'xcache',
	// 'DB_SQL_BUILD_LENGTH' => 20,
	//缓存方式
	//'DATA_CACHE_TYPE'=>'Xcache',

	//缓存S
	// 'DATA_CACHE_SUBDIR'=>true,  
	// 'DATA_PATH_LEVEL'=>1,

//    'DATA_CACHE_TYPE' => 'Memcache',
//    'MEMCACHE_HOST' => 'tcp://127.0.0.1:11211',

	'TMPL_ACTION_ERROR' => 'Public:message', 
	'TMPL_ACTION_SUCCESS' => 'Public:message',
	'TMPL_EXCEPTION_FILE'=>'./App/Tpl/Public/exception.html',
	'DEFAULT_TIMEZONE' => 'PRC',
	'LOAD_EXT_CONFIG' => 'db,alipay',  //加载数据库
	'LOG_RECORD' => false,
	'LOG_LEVEL'  =>'EMERG',
	'OUTPUT_ENCODE' => false,
    'LANG_SWITCH_ON' => true,          //开启多语言
    'LANG_AUTO_DETECT' => true,        //切换语言
	'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_LIST' => 'zh-cn',
    'VAR_LANGUAGE' => '1',
    'COOKIE_PATH' => __ROOT__,
    'SESSION_OPTIONS'=>array('cookie_path'=>__ROOT__),
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'URL' => 'http://192.168.1.207:8003',
	// 'URL' => 'http://192.168.1.189:8003',
	'URLAPP' => 'http://192.168.1.207:8001',
	// 'URLAPP' => 'http://192.168.1.189:8001',
	'HTTPSAPPURL' => 'https://mail.luichi.info:8884',//app端https请求
	"ONLINEURL" => 'http://aps.eachonline.com:8002',//线上的接口
	'YIGUANJIACLUB' => 'http://180.76.140.84',//逸管家club
	'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	//路由
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
    'appservice/apply' => array('Appserver/apply'),
    'appservice/checkapply' => array('Appserver/checkapply'),
	),

	'TMPL_PARSE_STRING' => array(
		'__APP__' => __ROOT__.'/index.php',					// 更改默认的__APP__ 替换规则
	)
);
?>
