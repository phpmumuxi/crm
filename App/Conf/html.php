<?php
 return array(
	//静态缓存
	'HTML_CACHE_ON'=> true,
	'HTML_CACHE_RULES'   => array(
    	'product:analytics'=>array('Product/{:action}','1'),
    	'order:analytics'=>array('Order/{:action}','1'),
    	'customer:analytics'=>array('Customer/{:action}','1'),
	),
 );

?>