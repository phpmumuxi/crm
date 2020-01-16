<?php
class CompanyAction extends Action{
	public function _initialize(){
		$action = ACTION_NAME;
		$controll = MODULE_NAME;
		$this->assign('action',$action);
		$this->assign('controll',$controll);
		$action = array(
			'permission'=>array(),
			'allow'=>array('index','permit','crmloginssl','delbank','validatepassword','transferbalance','addbankcard','recordlist','staff','banklist','passwordreset','cash','impUser','phone','updatastatus','addbusiness','seeevidence','editcompanyname')
		);
		B('Authenticate', $action);
	}


	public function index(){
		if($_SESSION['position_id'] == '18'){
			return  $this->display('permit');
		}
		//查询数据
		$data['crmUserId'] = $_SESSION['user_id'];

		$data = http_build_query($data);
		$opts = array (
			'http' => array (
				'method' => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $data
			)
		);
		$context = stream_context_create($opts);
		$html = file_get_contents(C('URL').'/manager/companyInfo/getTradeCompanyInfo', false, $context);
		$html = json_decode($html,true);
		//dump($html['data']);
		$city = explode(" ",$html['data']['companyAddress']);
		$fax = explode(" ",$html['data']['companyFax']);
		$scope = $html['data']['businessScope'];
		$scope2 = explode("-",$html['data']['businessScope']);
		$countscope = count($scope2);
		//dump($countscope);
		$this->assign('sid',$html['data']['sid']);
		$this->assign('types',$html['data']);
		// $this->assign('companytype',$html['data']['companyName']);
		//dump($_SESSION);
		// $this->assign('company',$_SESSION['company']);
		$this->assign('company',$html['data']['companyName']);
		$this->assign('url',C('URl'));
        $this->assign('userId',$_SESSION['user_id']);
		$this->assign('area',$city);
		$this->assign('fax',$fax);
		$this->assign('name',$_SESSION['name']);
		$this->assign('scope',$scope);
		$this->assign('scope2',$scope2);
		$this->assign('countscope',$countscope);
		$this->display();
	}

	//修改公司名称
	public function editCompanyName(){
		$data['userId']=I('post.userId','');
		$data['companyName']=I('post.companyName','');
		if($data['userId'] && $data['companyName']){
			if(M('user')->where('company = "%s"',$data['companyName'])->getField('name')){
				$jsonData = ['success' =>false , "message" => "公司名称已被注册" ];
				exit(json_encode($jsonData, JSON_UNESCAPED_UNICODE));                        
            }
			$result = M("user")->where('user_id = "%s"',$data['userId'])->setField('company', $data['companyName']);
			if($result){
				$jsonData = ['success' =>true , "message" => "更新成功" ];
				exit(json_encode($jsonData, JSON_UNESCAPED_UNICODE));
			}else{
				$jsonData = ['success' =>false , "message" => "更新失败"];
				exit(json_encode($jsonData, JSON_UNESCAPED_UNICODE));
			}
		}else{
			$jsonData = ['success' =>false , "message" => "参数不完整"];
			exit(json_encode($data, JSON_UNESCAPED_UNICODE));
		}
	}

	//添加行业资质证照	 
	public function addbusiness(){
		$data['industry']=I('get.industry','');
		$typeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证","4"=>"食品生产许可证","5"=>"全国工业生产许可证","6"=>"医疗机械生产许可证","7"=>"医疗器械经营许可证","8"=>"二类医疗机械经营备案凭证","9"=>"出版物经营许可证"];
		if($data['industry']=='医疗机械'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","6"=>"医疗机械生产许可证","7"=>"医疗器械经营许可证","8"=>"二类医疗机械经营备案凭证"];
		}elseif($data['industry']=='酒类'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证"];
		}elseif($data['industry']=='预包装及散装食品'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证","4"=>"食品生产许可证","5"=>"全国工业生产许可证"];
		}elseif($data['industry']=='乳制品（含婴儿奶粉）'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证"];
		}elseif($data['industry']=='保健食品'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证"];
		}elseif($data['industry']=='餐饮'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证"];
		}elseif($data['industry']=='书籍音像制品'){
			$listTypeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","9"=>"出版物经营许可证"];
		}else{
			$listTypeArr=$typeArr;
		}
		$this->assign('industry',$data['industry']);
		$this->assign('listTypeArr',$listTypeArr);
		if($data['industry']){ //从分类入口添加才显示列表	
			
			$positionId = $_SESSION['position_id'];
			switch($positionId)
			{
			    case '17':
			        $data['userId'] = $_SESSION['user_id']; 
			        break;
			    case '18':
			    	$data['userId'] = $_SESSION['parent_id'];
			        break;
			    case '22':
			        $data['userId'] = $_SESSION['user_id']; 
			        break;
			    default:
			    	$data['userId'] = '';
			        break;
			}
			$statusArr=["1"=>"待审核","2"=>"审核通过","3"=>"审核失败"];
			$res = httpRequest(C('URL').'/manager/businessQualification/recordlist',30,$data);
			if($res['code'] == 2000){
				$len=$res['data']['listSize'];
				if($len > 0){
					$datas=$res['data']['objectList'];		
					foreach ($datas as $k=> $va) {				  
					  if($va['isForever']=='1'){
					  	$datas[$k]['vldTime']='永久';
					  	$datas[$k]['checkStatus']=$statusArr[$va['checkStatus']];
					  }else{
					  	$datas[$k]['vldTime']=date('Y-m-d',strtotime($va['vldTime']));
					  	if($datas[$k]['vldTime'] < date('Y-m-d')){
					  		$datas[$k]['checkStatus']='已过期';
						}else{
						  	$datas[$k]['checkStatus']=$statusArr[$va['checkStatus']];
						}
					  }					  
					  $datas[$k]['licenceType']=$typeArr[$va['licenceType']];
					}
				  $this->assign('recordlist',$datas);
				}else{
					$empty="<tr><td colspan='6'>暂时没有数据</td></tr>";
					$this->assign('empty',$empty);
				}
			}else{
				echo "<script>alert(\"接口请求异常\");</script>";
				return;
			}
		}
		$this->display();
	}

	//查看证照详情	
	public function seeevidence(){
		$data['sid']=I('get.sid');
		$statusArr=["1"=>"待审核","2"=>"审核通过","3"=>"审核失败"];
		$typeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证","4"=>"食品生产许可证","5"=>"全国工业生产许可证","6"=>"医疗机械生产许可证","7"=>"医疗器械经营许可证","8"=>"二类医疗机械经营备案凭证","9"=>"出版物经营许可证"];
		if($data['sid']){
			$res = httpRequest(C('URL').'/manager/businessQualification/detail',30,$data);			
		}else{
			echo "<script>alert(\"非法请求异常\");</script>";
			return;
		}
		if($res['code'] == 2000){
			$datas=$res['data'];
			$datas['licenceType']=$typeArr[$datas['licenceType']];
			if($datas['isForever']=='1'){
			  	$datas['vldTime']='永久';
			  	$datas['checkStatus']=$statusArr[$datas['checkStatus']];
			}else{
			  	$datas['vldTime']=date('Y-m-d',strtotime($datas['vldTime']));
			  	if($datas['vldTime'] < date('Y-m-d')){
			  		$datas['checkStatus']='已过期';
				}else{
				  	$datas['checkStatus']=$statusArr[$datas['checkStatus']];
				}
			}
			$this->assign('info',$datas);
		}else{
			echo "<script>alert(\"接口请求异常\");</script>";
			return;
		}
		$this->display();
	}

	public function staff(){
		ini_set('max_execution_time','0');
		//根据ip解析经纬度
		$getIp = $_SERVER["REMOTE_ADDR"];
		//$getIp = '117.89.130.57';
		//dump($getIp);exit();
		$ips = file_get_contents("http://api.map.baidu.com/location/ip?ak=YfrMk3eIKhguMXWprcGSHyr6VSY9V6MO&ip={$getIp}&coor=bd09ll");
		//dump($ips);
		//dump(json_decode($content,true)['content']['point']);
		$ips2 = json_decode($ips,true);
		//dump($ips2);
		$this->assign('staff',$ips2['content']['point']);
		$this->assign('userid',$_SESSION['user_id']);



		//重组$data
		$data['pageNum'] = isset($_GET['p'])?(string)$_GET['p']:'1';
		$data['pageSize'] = '10';
		$data['crmUserId'] = $_SESSION['user_id'];
		//dump($data);
		//请求列表
		$data = http_build_query($data); 
		$opts = array ( 
				'http' => array ( 
							'method' => 'POST', 
					        'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $data
		         ) 
		); 
		 
		$context = stream_context_create($opts); 
		$html = file_get_contents(C('URL').'/manager/trade/queryAppCrmRel', false, $context);
		//echo (C('URl'));
		$html = json_decode($html,true);
		$list = $html['data']['dataList']; 
		$count = $html['data']['totalRowNumber'];
		//dump($html);

		import("@.ORG.Page");
		$Page = new Page($count,10);				//实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('list',$list);


		$this->assign('url',C('URL'));
		$this->display();
	}
    
	/**
	 * 用户鉴权。凡是ssl登录都要鉴权,鉴权的时候判断cookie文件userid
	 */
	public function crmloginssl(){
		$data['sid'] = $_SESSION['user_id'];
		$str = file_get_contents(C('SSLCOOKIE'));//将整个文件内容读入到一个字符串中
		$str = str_replace("\r\n","<br />",$str);
		$str = explode("_j_user_id",$str);
		$str = explode("<br />",trim($str['1']));
		$cookieUserid = $str[0];
		//var_dump($str);exit;
		
		if($cookieUserid != $data['sid']){
			file_put_contents(C('SSLCOOKIE'),'');
		} 

		$reuslt = httpRequest(C('HTTPSAPPURL').'/appserver/account/crmlogin',30, $data);//登录鉴权
		if(!$reuslt['success']){
			echo "<script>alert(\"用户登录鉴权失败！\");history.back();</script>";
			return;
		}
	}
	/**
	 * 用户资质
	 * @author zyl
	 * $type 
	 */
	public function permit(){
		$positionId = $_SESSION['position_id'];
		switch($positionId)
		{
		    case '17':
		        $data['userId'] = $_SESSION['user_id']; 
		        break;
		    case '18':
		    	$data['userId'] = $_SESSION['parent_id'];
		        break;
		    case '22':
		        $data['userId'] = $_SESSION['user_id']; 
		        break;
		    default:
		    	$data['userId'] = '';
		        break;
		}
		$data['industry']='';		
		$statusArr=["1"=>"待审核","2"=>"审核通过","3"=>"审核失败"];
		$typeArr=["0"=>"请选择要添加的证照","1"=>"营业执照","2"=>"食品流通许可证","3"=>"食品经营许可证","4"=>"食品生产许可证","5"=>"全国工业生产许可证","6"=>"医疗机械生产许可证","7"=>"医疗器械经营许可证","8"=>"二类医疗机械经营备案凭证","9"=>"出版物经营许可证"];
		$res = httpRequest(C('URL').'/manager/businessQualification/recordlist',30,$data);
		if($res['code'] == 2000){
			$len=$res['data']['listSize'];
			if($len > 0){
				$datas=$res['data']['objectList'];						
				foreach ($datas as $k=> $va) {
					if($va['isForever']=='1'){
					  	$datas[$k]['vldTime']='永久';
					  	$datas[$k]['checkStatus']=$statusArr[$va['checkStatus']];
				  	}else{
				  		$datas[$k]['vldTime']=date('Y-m-d',strtotime($va['vldTime']));					  	
					  	if($datas[$k]['vldTime'] < date('Y-m-d')){
					  		$datas[$k]['checkStatus']='已过期';
						}else{
						  	$datas[$k]['checkStatus']=$statusArr[$va['checkStatus']];
						}
				  	} 
					$datas[$k]['licenceType']=$typeArr[$va['licenceType']];
				}
			  	$this->assign('recordlist',$datas);			  
			}else{
				$empty="<tr><td colspan='7'>暂时没有数据</td></tr>";
				$this->assign('empty',$empty);
			}
		}else{
			echo "<script>alert(\"接口请求异常\");</script>";
			return;
		}		
		$this->display();
	}
	/**
	 * 交易提现
	 * @author zyl
	 * $type 1:没卡 2：有卡
	 */
	public function cash(){
		if($_GET['type'] == 3){
			$orderInfo['tradeOrderNo']=$_GET['orderno'];
			$orderInfo['userId'] = $_SESSION['user_id'];
			$orderInfoReturn = httpRequest(C('HTTPSAPPURL').'/appserver/trade/queryRecordDetail',30, $orderInfo);
			//默认从提现当时起30天内到账
			if($orderInfoReturn['success']){
				if(empty($orderInfoReturn['data']['tradeFinishTime']))
					$finshTime = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($orderInfoReturn['data']['tradeTime'])));
				$this->assign('type',$_GET['type']);
				$this->assign('finshTime',$finshTime);
				$this->assign('orderInfo',$orderInfoReturn['data']);
				$this->assign('get',$_GET);

			}else{
				echo "<script>alert(\"请求异常\");</script>";
				return;
			}
				
		}else{
			$data['sid'] = $_SESSION['user_id'];
			//用户ssl鉴权
			$this->crmloginssl();
			//echo 1;exit;
			//余额:exit;
			$turnover = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/myWallet');
			if($turnover['code'] == 2000){
				$this->assign('turnover',$turnover['data']);
			}else{
				echo "<script>alert(\"请求异常,请联系逸管家客服\");</script>";
				return;
			}
		
			//判断客户是否已持卡
			$hasBankResult = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/myBankCards');
			if($hasBankResult['success']){
				//type 1:没卡 2：有卡
				if(empty($hasBankResult['data']['bankCards'])){
					$this->assign('type','1');	
				}else {
					$this->assign('type','2');
					$this->assign('bankcardList',$hasBankResult['data']['bankCards']);
				}
					
			}else{
				echo "<script>alert(\"请求异常,信息获取失败\");</script>";
				return;
			}		
		}
	
		$this->assign('url',C('URL'));
		$this->assign('urlHttps',C('HTTPSAPPURL'));
		$this->assign('userTelephone', session('userTelphone'));
		$this->assign('urlApp',C('URLAPP'));
		$this->display();
	}
	

	/**
	 * 银行卡管理
	 * @author zyl
	 */
	public function banklist(){
		//用户ssl鉴权
		$this->crmloginssl();
		//查询银行卡列表信息
		$bankListReturn = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/myBankCards');
		//var_dump($bankListReturn);exit;
		if($bankListReturn['success']){
			//请求成功的时候 
			$this->assign("bankList",$bankListReturn['data']['bankCards']);
			$this->assign('type',3);
			$this->assign('urlHttps',C('HTTPSAPPURL'));
			$this->display();
				
		}else{
			//获取银行卡失败返回
			echo "<script>alert("."\"".$bankInfo['message']."获取银行卡列表请求失败"."\"".");history.back();</script>";
			return;
		}
	}
	
	/**
	 * @author zyl
	 * 删除银行卡
	 */
	public function delbank(){
		if($_POST && $_POST['sid']){
			$data['sid']	= $_POST['sid'];
			$result = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/deleteBindCard',30,$data);
			$this->ajaxReturn($result);
		}else{
			$this->ajaxReturn(['success' => false,'message' => '没有参数']);
		}
		
		
	}
	/**
	 * 交易密码设置
	 */
	public function passwordreset(){
		//用户ssl鉴权
		$this->crmloginssl();
		//查询数据
		$data['sid'] = $_SESSION['user_id'];
		if($_POST){
			$checkCodeData['telephone'] =  session('userInfo')["userTelephone"];
			$checkCodeData['verificationCode'] = $_POST['code'];
			$checkInfo = httpRequest(C('ONLINEURL').'/manager/account/checkCode',30,$checkCodeData);
			if($checkInfo['success']){
				//短信验证成功后开始设置密码，此处为重置密码不需要校验旧密码
	
				$passwdData['tradePassword'] = strtoupper(md5(htmlspecialchars(trim($_POST['password']))));
				$passwdReturn = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/setPassword',30,$passwdData);
				if($passwdReturn['success']){
					echo "<script>alert(\"密码重置成功\");history.back();</script>";
					return;
				}else{
					echo "<script>alert("."\"".$passwdReturn['message']."\"".");history.back();</script>";
					return;
				}
			} else{
				//短信验证失败
				echo "<script>alert("."\"".$checkInfo['message']."\"".");history.back();</script>";
				return;
			}
				
		}else{
			$userInfo = httpRequest(C('url').'/manager/user/getUserDetail',30,$data);
		
			if($userInfo['success']){
				$this->assign('userInfo',$userInfo['data']);
				session('userInfo',$userInfo['data']);
				$this->display();
					
			}else{
				echo "<script>alert(\"请求异常,用户信息获取失败\");history.back();</script>";
				return;
			}
		}
	}
	/**
	 * validatePassword
	 */
	public function validatepassword(){
		$data['tradePassword'] =	strtoupper(md5(htmlspecialchars(trim($_POST['tradePassword']))));
		$validateInfo = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/validateTradePassword',30,$data);
		//var_dump($validateInfo);
		if($validateInfo){
			$this->ajaxReturn($validateInfo);
			//return json_encode($validateInfo);
		}
	}
	
	/**
	 * transferBalance
	 */
	public function transferbalance(){
	
		$data['money'] =	$_POST['money'];
		$data['cardId'] =	 $_POST['cardId'];
		$transferBalance = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/transferBalance',30,$data);
		$this->ajaxReturn($transferBalance);
	
	}
	/**
	 * zyl
	 * 没有银行卡页面
	 */
	public function nobankcard(){
		//查询数据
		$data['crmUserId'] = $_SESSION['user_id'];
	
		$data = http_build_query($data);
		$opts = array (
				'http' => array (
						'method' => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => $data
				)
		);
		$context = stream_context_create($opts);
		$html = file_get_contents(C('URL').'/manager/companyInfo/getTradeCompanyInfo', false, $context);
		$html = json_decode($html,true);
		//dump($html['data']);
		$city = explode(" ",$html['data']['companyAddress']);
		$fax = explode(" ",$html['data']['companyFax']);
		$scope = $html['data']['businessScope'];
		$scope2 = explode("-",$html['data']['businessScope']);
		$countscope = count($scope2);
		//dump($countscope);
		$this->assign('sid',$html['data']['sid']);
		$this->assign('types',$html['data']);
		// $this->assign('companytype',$html['data']['companyName']);
		//dump($_SESSION);
		$this->assign('company',$_SESSION['company']);
		$this->assign('url',C('URl'));
		$this->assign('userId',$_SESSION['user_id']);
		$this->assign('area',$city);
		$this->assign('fax',$fax);
		$this->assign('name',$_SESSION['name']);
		$this->assign('scope',$scope);
		$this->assign('scope2',$scope2);
		$this->assign('countscope',$countscope);
		$this->display();
	}
	
	/**
	 * zyl
	 * 添加银行卡页面    功能步骤——>先验证手机验证码——>请求第三方接口获取银行卡信息——>绑定银行卡信息到数据库
	 */
	public function addbankcard(){
		$data['sid'] = $_SESSION['user_id'];
	
		if($_POST){
				
			$checkCodeData['telephone'] =  $_POST['bankTelephone'];
			$checkCodeData['verificationCode'] = $_POST['code'];
			$checkInfo = httpRequest(C('ONLINEURL').'/manager/account/checkCode',30,$checkCodeData);////手机信息验证
				
			if($checkInfo['success']){
				//手机验证成功后开始获取银行卡信息
				//智能验证银行卡账号信息
	
				$bankData['cardNo']	 =	 $_POST['cardNo'];
				$bankData['userRealName']	= $_POST['userRealName'];
				//获取银行卡信息接口
				$bankInfo = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/getBasicCardMsg',30,$bankData);
				$cardInfo = $bankInfo['data']['bankCard'];
				if($bankInfo['success']){
					//银行卡信息获取成功后开始添加绑定卡号信息
					$addBankData['userId']			= 	$_SESSION['user_id'];
					$addBankData['userRealName']	= $_POST['userRealName'];
					$addBankData['bankname']		= $cardInfo['bankname'];
					$addBankData['cardNo']			= $_POST['cardNo'];
					$addBankData['bankBranchName']	= $_POST['bankBranchName'];
					$addBankData['province']		= $cardInfo['province'];
					$addBankData['city']			= $cardInfo['city'];
					$addBankData['cardtype']		= $cardInfo['cardtype'];
					$addBankData['cardprefixnum']	= $cardInfo['cardprefixnum'];
					$addBankData['banknum']			= $cardInfo['banknum'];
					$addBankData['logourl']			= $cardInfo['logourl'];
					$addBankData['bankTelephone']	= 	$_POST['bankTelephone'];
					$addBankRturn = httpRequest(C('HTTPSAPPURL').'/appserver/wallet//bindCard',30,$addBankData);
					if($addBankRturn['success']){
						//添加银行卡成功 type=1
						$this->assign('type',1);
						$this->display('banklist');
					}else{
						//添加银行卡成失败 type=1
						$this->assign('type',2);
						$this->assign('errorMessage',$addBankRturn['message']);
						$this->display('banklist');
					}
						
				}else{
					//获取银行卡失败返回
					echo "<script>alert("."\"".$bankInfo['message']."获取银行卡信息失败"."\"".");history.back();</script>";
					return;
				}
	
			}else{
				echo "<script>alert("."\"".$checkInfo['message']."\"".");history.back();</script>";
				return;
			}
				
		}else{
			$userInfo = httpRequest(C('url').'/manager/user/getUserDetail',30,$data);
				
			//$userInfo = json_decode($userInfo,true);
			if(!$userInfo['data']['userApproveStatus']){
				echo "<script>alert(\"该用户未认证，请登录APP进行实名认证\");history.back();</script>";
				return;
			}else{
				//实名认证后才可以添加银行卡
				//var_dump($userInfo['data']);
				$this->assign('userInfo',$userInfo['data']);
				$this->display();
			}
		}
	
	
	}
	
	/**
	 * 提现记录
	 */
	public function recordlist(){
		//查询数据
	
		$data['userId'] = $_SESSION['user_id'];
		//$data['userId'] ='beccc56afe324250b82eb39dad7c5262';
		if($_POST){
			$data['strStartTime'] =$_POST['beginTime'];
			$data['strEndTime'] =$_POST['endTime'];
			$data['bankName'] =$_POST['bankName'];
			$this->assign('post',$_POST);
		}
		
		isset($_GET['page'])?$data['start']	= $_GET['page']:$data['start']	= 0;
		$page_row = 10;//每页显示条数
		$data['pageSize'] = $page_row ;
		
		$result = httpRequest(C('HTTPSAPPURL').'/appserver/trade/queryCrmTradeRecord',30,$data);
		// dump(C('URLAPP').'/appserver/trade/queryCrmTradeRecord');exit();
		if($result){
			$count = $result['data']['sumNum'];
			import("@.ORG.Pages");
			
			//dump($count);
			$p = new Pages ($count, $page_row, 8);
			
			$p->isJumpPage = true;
			$p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
			$show = $p->show();
			$this->assign('pages', $show);
			$this->assign('recordlist',$result['data']['dataList']);
			$this->display();
		}else{
			echo "<script>alert(\"接口请求异常\");</script>";
			return;
		}

	}
	
	
	//导入excel数据
	public function impUser(){
		ini_set('max_execution_time','0');
		//dump($_FILES);exit;
		//判断有无文件上传
		if ($this->isPost()) {
			if (isset($_FILES['excel']['size']) && $_FILES['excel']['size'] != null) {
				import('@.ORG.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize = 20000000;
				$upload->allowExts = array('xls');
				$dirname = UPLOAD_PATH . date('Ym', time()) . '/' . date('d', time()) . '/';
				if (!is_dir($dirname) && !mkdir($dirname, 0777, true)) {
					alert('error', L('ATTACHMENTS_TO_UPLOAD_DIRECTORY_CANNOT_WRITE'), $_SERVER['HTTP_REFERER']);
				}
				$upload->savePath = $dirname;
				if (!$upload->upload()) {
					$this->error('上传失败!');
				} else {
					$info = $upload->getUploadFileInfo();
				}

				if (is_array($info[0]) && !empty($info[0])) {
					$savePath = $dirname . $info[0]['savename'];
				} else {
					alert('error', L('UPLOAD_FAILED'), $_SERVER['HTTP_REFERER']);
				}

				import("ORG.PHPExcel.PHPExcel");
				$file_name=$info[0]['savepath'].$info[0]['savename'];
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				$telphone = array();
				$telphone2 = array();
				
				for($i=3;$i<=$highestRow;$i++)
				{
					$data =(string)trimall($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue());
					if($data){
						if(!preg_match("/^1[34578]{1}\d{9}$/",$data)){  
							 $this->error('表格数据有误,请重新上传表格!',U('Company/staff'),3);
							 @unlink($file_name);
							 exit();
						}
						if(count($telphone)<=50){
							array_push($telphone,$data);
						}
					}
					//dump($data);exit;
					//echo M('user')->getLastSql();
					$where['telephone'] = $data;
					
					if ($tel = M('user')->where($where)->getField('telephone')) {
						array_push($telphone2,$tel);
					}
				}
					$telphone3 = implode(",", $telphone2);
					//dump($telphone);exit;
					if($telphone3){
						echo "<script>alert(\"您无法关联逸管家智能数据账号,请重新上传表格:$telphone3\");</script>";
						@unlink($file_name);	
						$this->error('关联失败!',U('Company/staff'),3);
						exit();
					}
					//根据ip解析经纬度
					$getIp = $_SERVER["REMOTE_ADDR"];
					//$getIp = '117.89.130.57';
					//dump($getIp);exit();
					$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=YfrMk3eIKhguMXWprcGSHyr6VSY9V6MO&ip={$getIp}&coor=bd09ll");
					//dump(json_decode($content,true)['content']['point']);
					$cong['jsonStr'] = json_encode($telphone);

					$cong['crmUserId'] = $_SESSION['user_id'];

					$ips3 = json_decode($content,true);
					$cong['lo'] = $ips3['content']['point']['x'];
					$cong['la'] = $ips3['content']['point']['y'];

					//dump($cong);exit;
					//发送数据
					$cong = http_build_query($cong);
					$opts = array (
						'http' => array (
							'method' => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $cong
						)
					);
					$context = stream_context_create($opts);
					$html = file_get_contents(C('URL').'/manager/trade/relEmpInfo', false, $context);
					$html = json_decode($html,true);
					//dump($html);exit;
					if($html['code'] == '2000'){
						@unlink($file_name);
						if($html['data']['code'] == '-1'){
							// alert('error', '账号异常请联系路启客服', U('company/staff'));
							$this->error('账号存在异常,请联系逸管家客服!',U('Company/staff'),3);
						}else if($html['data']['code'] == '-2' && $html['data']['relPhone'] ==''){
							$this->error('关联失败!',U('Company/staff'),3);
						}else if($html['data']['relPhone']){
								$val = (implode(",", $html['data']['relPhone']));
								echo "<script>alert(\"以下账号已被关联:$val\");</script>";
								//$this->success("以下手机号已被关联:$val",'Company/staff',5);
								$this->success("部分关联成功",U('Company/staff'),2);
						}else if($html['data']['code'] == '-3'){
								$this->error('关联员工账号前，请先发布产品信息!',U('Company/staff'),3);
						}else{
							$this->success('关联成功!',U('Company/staff'),3);
						}
					}

			} else {
				$this->error('表格数据有误,请重新上传表格!',U('Company/staff'),1);
			}
		}
	}

	public function phone(){
		//检测关联账号是否为公司账号(单个关联)
		$where['telephone'] = $_POST['tel'];
		// M('user as u')->where($where)->join('crm_role as r on r.user_id = u.user_id')->find();
		// echo M('user as u')->getLastSql();exit;
		if( M('user')->where($where)->find()){
			$this->ajaxReturn('0','您无法关联逸管家智能数据账号','0');
		}else{
			$this->ajaxReturn('1','正常关联','1');
		}
	}

}