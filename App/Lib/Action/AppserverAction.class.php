<?php
class AppserverAction extends Action {

	/**
	 * 测试https请求
	 */
		public function innn(){
			
		$data['sid'] = $_SESSION['user_id'];
		
		$reuslt = httpRequest(C('url').'/appserver/account/crmlogin',50, $data);
		$turnover = httpRequest(C('HTTPSAPPURL').'/appserver/wallet/myWallet');
		var_dump($reuslt);exit;
	}
	
	/**
	 * @author zyl
	 * 图片上传接口
	 */
	public function uploadImg(){
		$imgFormatArr = ["jpeg","jpg","bmp","png"];
		header('Content-Type:application/json; charset=utf-8');  
		if($_FILES){
			if(!is_dir('./Uploads/imgs')){
				mkdir('./Uploads/imgs');
			}
			$oldName = $_FILES["file"]["name"];
			$imgFormat =  substr(strrchr($oldName, '.'), 1);//图片格式(只允许gps)
			if(!in_array(strtolower($imgFormat), $imgFormatArr)){
				$data = ['success' =>false , "message" => "图片格式不正确,支持格式为（jpeg,jpg,bmp,png）"];
				exit(json_encode($data, JSON_UNESCAPED_UNICODE));
			}	
		
			$imgName = time().".".$imgFormat;//把名称格式化为时间戳
			$path = "Uploads/imgs/".$imgName;
			
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$path)){
				$data = ['success' =>true , "message" => "上传成功" ,"data" => ['imagePath' => __ROOT__.'/'.$path]];
				//exit(urldecode(json_encode()));
				exit(json_encode($data, JSON_UNESCAPED_UNICODE));
			}else{
				$data = ['success' =>false , "message" => "上传失败"];
				exit(json_encode($data, JSON_UNESCAPED_UNICODE));
				$this->ajaxReturn(['success' =>false , "message" => "上传失败"]);
			}
	
			
		}
	}
	
	/**调试所用接口
	 * 
	 */
	static $num=1;
	public function __call($method, $args){
		echo $method.'不存在';
		echo "参数：";
		var_dump($args);
	}
	public function ceshi(){
		header("Content-Type:text/html;charset:utf-8");
		$host = 'localhost';
		$dbname = 'zhangyaole';
		$dbns = 'mysql';
		try {
			$pdo = new PDO("$dbns:host=$host;dbname=$dbname",'root','123456');
			$pdo->beginTransaction();
			$sql = "insert into users (name,password)values('aazhanssg','123'),('aazhanasag','ssa123')";
			$res = $pdo->prepare($sql);
			if($res->execute()){
				echo '添加成功';
			}else{
				echo "添加失败";
			}
			$pdo->commit();
			
		}catch (PDOException $e){
			$pdo->rollBack();
			die("error:".$e->getMessage());
		}

		
	
		/* $connect = mysql_connect("localhost",'root','123456') or die("无法连接到数据库".mysql_errno());
		$select_deb = mysql_select_db('zhangyaole',$connect);
		$query_db = mysql_query('use zhangyaole',$connect);

		if($query_db){
			$sql = "insert into users (name,password,email)values('z','123456','z@ssa'),('z3','1234563','z3@ssa'),('z4','1423456','4z@ssa')";
			$user = mysql_query($sql);
			//$res = mysql_fetch_array($user);
			var_dump($res);exit;
		}
		var_dump($select_deb);var_dump($query_db);exit; */
		$title = "萨顶as顶的sa顶顶as顶as顶顶asd顶sa顶asd顶sa顶顶sa顶顶as顶as顶顶asdaasdsada";
		///$title = sha1($title);
		//$title = md5($title,0);
		//$title = strtoupper(crypt($title,'tm'));
		var_dump($title);
		echo '<br/>';
		echo substr($title,6,12)."....<br/>";
		echo mbsubstr($title,5);
// 		/$this->assaa(15452);
		echo "你是第".self::$num.'个'.'<br/>';
		self::$num++;
		
		header("Content-type:image/jpeg");
		$b = "aa";
		cookie('aa',$b);
		echo cookie('aa');
		$this->aa = "111";
		setcookie('ass','ssss',1527232702+600);
		session($name);
		//phpinfo();
		$im = imagecreate(200,60);
	    imagecolorallocate($im, 225, 66, 159) ;
		imagegif($im);
	//dump($_COOKIE);
	//	echo __FILE__;
// 		echo '<br/>'.__LINE__;
// 		echo '<br/>'.PHP_VERSION;
// 		echo '<br/>'.PHP_OS;
// 		echo '<br/>'.E_ERROR;
// 		echo '<br/>'.$_SERVER['SERVER_ADDR'];
// 		echo '<br/>'.$_SERVER['SERVER_NAME'];
// 		echo '<br/>'.$_SERVER["SERVER_ADMIN"];
// 		echo '<br/>'.$_SERVER["SERVER_PORT"];
// 		echo '<br/>'.$_SERVER["REMOTE_ADDR"];
// 		echo '<br/>'.$_SERVER["REMOTE_PORT"];
// $array = [
// 		"a" =>1,
// 		"b" =>2,
// 		"c" =>3,
// 		"d" =>4,
// 		"e" =>5,
// 		"f" =>6,
// 		"g" =>9,
// ];
// 		$a = "/^1(3|8|5|8|4)\d{9}$/";
// 		$c = "/^\d{3,4}-?\d{7,8}$/";
// 		$b['s']= "1368414784";
// 		$b['d']= "13685478747";
// 		$b['f']= "18974787477";
// 		$b['g']= "15451";
// 		$res = preg_grep($c, $b);
// 		$res1 = preg_match($c, $b['1'],$d);

// 		//echo "<script>var a = /^\d{3,4}-?\d{7,8}$/;var b= new RegExp(a);alert(b.test('112-24444444'))</script>";
// 		if(preg_match($a,'13861048784')){
// 			echo '匹配成功';
// 		}else{
// 			echo '匹配失败';
// 		}	
// 		echo "<br/>";
// 		echo '127.0.0.1的键值是:'.array_search('127.0.0.1', $_SERVER)."<br/>";
// 		echo implode('@', $array);
// 		dump(explode( '@',implode('@', $array)));
// 		echo  array_pop($array);
// 		array_push($array, 7);
// 		array_push($array, 7);
// 		$arr = ['1','1',2,2,'3'];
// 		dump($arr);
// 		array_unique($arr);
		if($_POST){
			dump($_POST);
			$_POST["select"];
			echo $_POST["select"][0]."<br/>";
			if(!is_dir('./uploadddd')){
				mkdir('./uploadddd');
			}
			array_push($_FILES["pic"]["name"], "");
			$array = array_unique($_FILES["pic"]["name"]);
			
			array_pop($array);
			
			for($i=0;$i<count($array);$i++){
				$path = "uploadddd/".$_FILES["pic"]["name"][$i];
				echo $path;
				if(move_uploaded_file($_FILES["pic"]["tmp_name"][$i],$path)){
					$res =true;
				}else{
					$res =false;
				}
			}
			if($res =true){
				echo "上传成功";
				
			}else{
				echo "上传失败";
			}
		}
		$this->display();
	}
	
	
	/**@author zyl
	 * 新增推荐关系
	 */
	public function addRecommend(){
		$data['register_user_id'] = $_POST['registerUserId'];
		$data['register_tel'] = $_POST['registerTel'];
		$data['is_register'] = $_POST['isRegister'];
		$data['create_time'] = $_POST['createTime'];
		$data['recommend_tel'] = $_POST['recommendTel'];
		$data['recommend_id'] = $_POST['recommendId'];
		$data['id'] = $_POST['id'];
		$field_recommend = M('fieldtype_comment');
		$isAdd = $field_recommend->add($data);
		if($isAdd){
			$this->ajaxReturn(['success' => true,'message' => '同步成功']);
		}else{
			$this->ajaxReturn(['success' => false,'message' => '同步失败']);
		}
	}
	
	/**@author zyl
	 * 推荐关系关系更新
	 */ 
	public function updateRecommend(){
		$data['register_user_id'] = $_POST['registerUserId'];
		$data['register_tel'] = $_POST['registerTel'];
		$data['create_time'] = $_POST['createTime'];
		$data['is_register'] = $_POST['isRegister'];//必填是否推荐
		$data['recommend_tel'] = $_POST['recommendTel'];//必填推荐者号码
		$data['recommend_id'] = $_POST['recommendId'];//必填推荐者id
		$data['id'] = $_POST['id'];//必填该信息
		//判断是否含有推荐信息的id
		if(!$data['id'])
			$this->ajaxReturn(['success' => false,'message'=>'缺少推荐关系id信息']);
		
		$field_recommend = M('fieldtype_comment');
		$isSave= $field_recommend->save($data);
		if($isSave == false){
			$this->ajaxReturn(['success' => false,'message' => '更新失败']);
		}else{
			$this->ajaxReturn(['success' => true,'message' => '更新成功']);
		}
	}

	/**
	 * 修改用户为管家经理
	 */

	public function userTomanager(){
		$isHouseManager = $_POST["is_house_manager"];
		$userId = $_POST["userId"];
		$result = M("User")->save(["is_house_manager" => $isHouseManager ,"user_id" =>$userId]);
		if( $result > 0 || $result ===0){
			$this->ajaxReturn(["message" => "操作成功","success" =>true]);
		}else{
			$this->ajaxReturn(["message" => "操作失败","success" =>false]);
		}
	}
	//修改用户名
	public function updateName() {
		$output = array();
		$m_user = M('User');
		//接受数据
		$img['name'] = $_REQUEST['nickName'];
		$user_id = $_REQUEST['userId'];
		// $img['name'] ='小时前';
		// $user_id ="E2B7B6D3D562E2A0D032D982C4D053D2";
		// $_REQUEST['userId'] = '小时前';
		// $_REQUEST['nickName'] = "E2B7B6D3D562E2A0D032D982C4D053D2";
		

		if ($_REQUEST['nickName']==''||$_REQUEST['userId']=='') {
			$output = array('data'=>NULL, 'message'=>'参数不完整!', 'code'=>5000);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}

		$user = $m_user->where("user_id = '%s'",$_REQUEST['userId'])->find();
		if(empty($user)){
			$output = array('data'=>NULL,'message'=>'用户ID不存在','code'=>5000);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}

		// $m_user->where("name = '%s' and user_id !='%s' ",$_REQUEST['nickName'],$_REQUEST['userId'])->select();
		// echo $m_user->getLastSql();exit;

		if($m_user->where("name = '%s' and user_id !='%s' ",$_REQUEST['nickName'],$_REQUEST['userId'])->select()){
			$output = array('data'=>NULL,'message'=>'用户名已被注册','code'=>5000);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}

		if($m_user->where("name = '%s' and user_id ='%s' ",$_REQUEST['nickName'],$_REQUEST['userId'])->select()){
			$output = array('data'=>NULL,'message'=>'修改成功','code'=>2000);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}

		$imgupdate = $m_user->where("user_id = '%s'",$_REQUEST['userId'])->save($img);
		if($imgupdate>0 || $imgupdate ===0){
			//输出数据
			$output = array(
				'code' => 2000, 
				'message' => '修改成功', 
				'data' => null,
			);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}else{
			$output = array('data'=>NULL,'message'=>'修改失败','code'=>5000);
			foreach ( $output as $key => $value ) {
				$output[$key] = urlencode ( $value );
			}
			exit(urldecode(json_encode($output)));
		}
	}

	//申请成为代理商
	public function doapply(){
		$apply = M("apply");
		$apply->name = $_REQUEST['name'];
		$apply->telephone = $_REQUEST['telephone'];
		$apply->email = $_REQUEST['email'];
		$apply->area = $_REQUEST['area'];
		$apply->comment = isset($_REQUEST['comment'])?$_REQUEST['comment']:'';
		if($_REQUEST['name'] && $_REQUEST['telephone'] && $_REQUEST['email'] && $_REQUEST['area']){
			$apply->create();
			$apply->add();
			echo $apply->getLastSql();

			// $db = M();
			// $sql = "INSERT INTO `crm_apply` (`id`,`name`,`telephone`,`email`,`area`,`comment`) VALUES (\"$id\",\"$_REQUEST[name]\",\"$_REQUEST[telephone]\",\"$_REQUEST[email]\",\"$_REQUEST[area]\",\"$_REQUEST[comment]\")";
			// dump($sql);
			// $db->execute($sql);
			// if($apply->add()){
			// 	$output = array('data'=>NULL,'message'=>'添加成功','code'=>2000);
			// 	exit(json_encode($output));
			// }else{
			// 	$output = array('data'=>NULL,'message'=>'添加失败','code'=>5000);
			// 	exit(json_encode($output));
			// }
		}else{
			$output = array('data'=>NULL,'message'=>'参数不完整','code'=>5000);
			exit(json_encode($output));
		}
	}


	//搜索代理商
	public function apply(){
		$data['name'] = array('like',"%$_REQUEST[name]%");
		//$Model = new Model();
		$users = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->where('r.position_id = 21')->where($data)->field('u.user_id as userId,u.name')->select();
		//$sql = "SELECT u.user_id as userId,u.name FROM crm_user u,crm_role r WHERE r.role_id = u.role_id AND r.position_id = 21 AND u.name like '%$_REQUEST[name]%'";
		//$users = $Model->query($sql);
		//dump($sql);exit;
		if($users){
			$output = array(
				'code' => 2000, 
				'message' => 'success', 
				'data' => $users,
			);
			exit(json_encode($output));
		}else{
			$output = array('data'=>NULL,'message'=>'error','code'=>5000);
			exit(json_encode($output));
		}
	}

	//判断代理是否已经被申请
	public function checkapply(){
		$user = M('user')->where("parent_id = '%s'",$_REQUEST['user_id'])->field('name')->find();
		if($user){
			$output = array(
				'code' => 2000, 
				'message' => '该区域已有代理商', 
				'data' => $users,
			);
			exit(json_encode($output));
		}else{
			$output = array(
				'code' => 2000, 
				'message' => 'success', 
				'data' => null,
			);
			exit(json_encode($output));
		}
	}

	// public function addUser(){
	// 	$m_role = M('Copyrole');
	// 	$m_user = M('Copyuser');
		
	// 	// $m_role = M('Role');
	// 	// $m_user = D('User');

	// 	$output = array();
	// 	$_POST['user_id'] = $_REQUEST['userId'];
	// 	$_POST['parent_id'] = $_REQUEST['userId'];
	// 	$_POST['name'] = $_REQUEST['nickName'];
	// 	$_POST['telephone'] = $_REQUEST['telephone'];
	// 	$_POST['reg_ip'] = $getIp = '117.89.130.57';
	// 	$_POST['company'] = $_REQUEST['company'];
	// 	$_POST['position_id'] = 6; //第三方主账号
	// 	$_POST['category_id'] = 2;
	// 	$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=YfrMk3eIKhguMXWprcGSHyr6VSY9V6MO&ip={$getIp}&coor=bd09ll");
	// 	$json = json_decode($content,true);
	// 	$_POST['address'] = $json['content']['address'];
	// 	$_POST['lng'] = $json['content']['point']['x'];
	// 	$_POST['lat'] = $json['content']['point']['y'];

	// 	//dump($_POST);
	// 	//为用户设置默认导航（根据系统菜单设置中的位置）
	// 	$m_navigation = M('navigation');
	// 	$navigation_list = $m_navigation->order('listorder asc')->select();
	// 	//dump($navigation_list);exit;
	// 	$menu = array();
	// 	foreach($navigation_list as $val){
	// 		if($val['postion'] == 'top'){
	// 			$menu['top'][] = $val['id'];
	// 		}elseif($val['postion'] == 'user'){
	// 			$menu['user'][] = $val['id'];
	// 		}else{
	// 			$menu['more'][] = $val['id'];
	// 		}
	// 	}
	// 	$navigation = serialize($menu);
		
	// 	if($_POST['user_id']==''|| $_POST['name']=='' || $_POST['telephone']==''|| $_POST['company']==''){
	// 		$output = array('data'=>NULL, 'message'=>'参数不完整!', 'code'=>5000);
	// 		exit(json_encode($output));
	// 	}

	// 	//验证用户名手机号是否重复
	// 	if($m_user->where("name = '%s'",$_POST['name'])->select()){
	// 		//echo $m_user->getLastSql();exit;
	// 		$output = array('data'=>NULL, 'message'=>'用户名已有注册!', 'code'=>5000);
	// 		exit(json_encode($output));
	// 	}
	// 	if($m_user->where("telephone = '%s' ",$_POST['telephone'])->select()){
	// 		//echo $m_user->getLastSql();exit;
	// 		$output = array('data'=>NULL, 'message'=>'手机号已有注册!', 'code'=>5000);
	// 		exit(json_encode($output));
	// 	}
	// 	if($m_user->where("company='%s'",$_POST['company'])->select()){
	// 		//echo $m_user->getLastSql();exit;
	// 		$output = array('data'=>NULL, 'message'=>'公司名称已有注册!', 'code'=>5000);
	// 		exit(json_encode($output));
	// 	}
	// 	$m_user->navigation = $navigation;
	// 	$m_user->user_id = $_POST['user_id'];
	// 	$m_user->name = $_POST['name'];
	// 	$m_user->telephone = $_POST['telephone'];
	// 	$m_user->company = $_POST['company'];
	// 	$m_user->category_id = $_POST['category_id'];
	// 	$m_user->department_id = $_POST['department_id'];
	// 	$m_user->position_id = $_POST['position_id'];
	// 	$m_user->lng = $_POST['lng'];
	// 	$m_user->lat = $_POST['lat'];
	// 	$m_user->address = $_POST['address'];
	// 	$m_user->parent_id = $_POST['parent_id'];
	// 	$m_user->reg_time = time();
	// 	$m_user->reg_ip = $_POST['reg_ip'];
	// 	$m_user->password = bmd5(123456);
	// 	$m_user->status = 1;
	// 	// dump($_POST['user_id']);exit;
	// 	if($re_id = $m_user->add()){
	// 		//echo $m_user->getLastSql();exit;
	// 		$data['user_id'] = $_POST['user_id'];
	// 		$data['position_id'] = '6';
	// 		if($role_id = $m_role->add($data)){
	// 			// dump($role_id);
	// 			$m_user->where("user_id = '%s'",$_POST['user_id'])->setField('role_id', $role_id);
	// 			// echo $m_user->getLastSql();exit;
	// 			$output = array('data'=>NULL,'message'=>'添加成功','code'=>2000);
	// 			exit(json_encode($output));
	// 		}else{
	// 			$m_user->where("user_id = '%s'",$_POST['user_id'])->delete();
	// 			$output = array('data'=>NULL,'message'=>'添加失败','code'=>5000);
	// 			exit(json_encode($output));
	// 		}
	// 	}

	// }
	public function addUser(){
		ini_set('memory_limit', '1024M');
		set_time_limit(0);
		 
		$m_role = M('Copyrole');
		$m_user = M('Copyuser');
		//var_dump($_POST);exit;
		//var_dump($_FILES);exit;
		if($this->isPost()){
			//echo 1;exit;
			//为用户设置默认导航（根据系统菜单设置中的位置）
			$m_navigation = M('navigation');
			$navigation_list = $m_navigation->order('listorder asc')->select();
			$menu = array();
	
			foreach($navigation_list as $val){
				if($val['postion'] == 'top'){
					$menu['top'][] = $val['id'];
				}elseif($val['postion'] == 'user'){
					$menu['user'][] = $val['id'];
				}else{
					$menu['more'][] = $val['id'];
				}
			}
			
			$navigation = serialize($menu);
		
			if (isset($_FILES['excel']['size']) && $_FILES['excel']['size'] != null) {
				//	var_dump($_FILES);exit;
				G('begin');
				ini_set('max_execution_time','0');
	
				$m_role = M('Copyrole');
				$m_user = M('Copyuser');
				import('@.ORG.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize = 20000000;
				$upload->allowExts = array('xls');
				$dirname = UPLOAD_PATH . date('Ym', time()) . '/' . date('d', time()) . '/';
				if (!is_dir($dirname) && !mkdir($dirname, 0777, true)) {
					alert('error', L('ATTACHMENTS_TO_UPLOAD_DIRECTORY_CANNOT_WRITE'), $_SERVER['HTTP_REFERER']);
				}
				//var_dump($dirname);exit;
				$upload->savePath = $dirname;
				if (!$upload->upload()) {
					//$this->error($upload->getError());
					$this->error('上传失败!');
				} else {
					$info = $upload->getUploadFileInfo();
				}
				//echo 1;exit;
				if (is_array($info[0]) && !empty($info[0])) {
					$savePath = $dirname . $info[0]['savename'];
				} else {
					alert('error', L('UPLOAD_FAILED'), $_SERVER['HTTP_REFERER']);
				}
				//echo 1;
				import("ORG.PHPExcel.PHPExcel");
	
				//echo 1;exit;
				$file_name=$info[0]['savepath'].$info[0]['savename'];
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				$j=0;
				$f =0;
				
				// 				$model = new Model();
				// 				$model->startTrans();//事务开启
				for($i=2;$i<=$highestRow;$i++)
				{	
					$regTime = (string)trimall($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue());
					$userId =(string)trimall($objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue());
					$ninckName = (string)trimall($objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue());
					$companyName = (string)trimall($objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue());
					$telphone = (string)trimall($objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue());
					
					//验证用户名手机号是否重复
						
					// 					if($m_user->where("name = '%s'",$ninckName)->select()){
					// 						//echo $m_user->getLastSql();exit;
					// 						$output = array('data'=>NULL, 'message'=>$i.'记录用户名已有注册!', 'code'=>5002);
					// 						exit(json_encode($output));
					// 					}
					// 					if($m_user->where("telephone = '%s' ",$telphone)->select()){
					// 						//echo $m_user->getLastSql();exit;
					// 						$output = array('data'=>NULL, 'message'=>$i.'行记录手机号已有注册!', 'code'=>5003);
					// 						exit(json_encode($output));
					// 					}
					// 					if($m_user->where("company='%s'",$companyName)->select()){
					// 						//echo $m_user->getLastSql();exit;
					// 						$output = array('data'=>NULL, 'message'=>$i.'行记录公司名称已有注册!', 'code'=>5004);
					// 						exit(json_encode($output));
					// 					}
					$userdata['navigation'] = $navigation;
					$userdata['user_id'] = $userId;
					$userdata['name'] = $ninckName;
					$userdata['company'] = $companyName;
					$userdata['telephone'] = $telphone;
					$userdata['category_id'] = 2;
					$userdata['position_id'] = 17;
					$userdata['parent_id'] = $userId;
					$userdata['reg_time'] = time();
					$userdata['password'] = bmd5(123456);
					$userdata['status'] = 1;
					$userdata['reg_time'] = time();
						
	
					$user_id = $m_user->add($userdata);
					//var_dump($user_id);exit;
					// echo $m_user->getLastSql();
					// echo "<hr/>";
					$data['user_id'] = $userId;
					$data['position_id'] = 17; //新增用户用17
						
					if($user_id){
						$role_id = $m_role->add($data);
						//var_dump($role_id);exit;
						$j++;
						//					$model->commit();//事务执行
					}else{
						$userdata['dberror'] = $m_user->getDbError();//添加数据库失败返回的错误信息
						$faileList[] = $userdata;//失败的记录集合
						$f++;//失败数
						//		$model->rollback();//事务回滚
					}
	
					// echo $m_role->getLastSql();
					// echo "<hr/>";
					$m_user->where("user_id = '%s'",$userId)->setField('role_id', $role_id);
					// echo $m_user->getLastSql();
					// echo "<hr/>";
				}
				unlink($file_name);
				$output = array('data'=>NULL, 'message'=>'导入成功！本次导入联系人数量：'.$j.'失败数'.$f, 'code'=>2000,'fail' =>$faileList );
				G('end');
				//$this->assign('fail',$faileList); //显示失败记录到页面
				//$this->display();//显示失败记录到页面
				exit(urldecode(json_encode($output,JSON_UNESCAPED_UNICODE)));
				//$this->success('导入成功！本次导入联系人数量：'.$j);
	
			} else {
				$this->error('表格数据有误,请重新上传表格!',U('Appserver/adduser'),1);
	
				// 						$output = array('data'=>NULL, 'message'=>'导入成功！本次导入联系人数量：'.$j, 'code'=>2000);
				// 						exit(json_encode($output));
			}
	
			$output = array();
			$_POST['user_id'] = $_REQUEST['userId'];
			$_POST['parent_id'] = $_REQUEST['userId'];
			$_POST['name'] = $_REQUEST['nickName'];
			$_POST['telephone'] = $_REQUEST['telephone'];
			$_POST['reg_ip'] = $getIp = '117.89.130.57';
			$_POST['company'] = $_REQUEST['company'];
			$_POST['position_id'] = 17; //第三方主账号
			$_POST['category_id'] = 2;
			$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=YfrMk3eIKhguMXWprcGSHyr6VSY9V6MO&ip={$getIp}&coor=bd09ll");
			$json = json_decode($content,true);
			$_POST['address'] = $json['content']['address'];
			$_POST['lng'] = $json['content']['point']['x'];
			$_POST['lat'] = $json['content']['point']['y'];
	
			//dump($_POST);
			//为用户设置默认导航（根据系统菜单设置中的位置）
			$m_navigation = M('navigation');
			$navigation_list = $m_navigation->order('listorder asc')->select();
			//dump($navigation_list);exit;
			$menu = array();
			foreach($navigation_list as $val){
				if($val['postion'] == 'top'){
					$menu['top'][] = $val['id'];
				}elseif($val['postion'] == 'user'){
					$menu['user'][] = $val['id'];
				}else{
					$menu['more'][] = $val['id'];
				}
			}
			$navigation = serialize($menu);
	
			if($_POST['user_id']==''|| $_POST['name']=='' || $_POST['telephone']==''|| $_POST['company']==''){
				$output = array('data'=>NULL, 'message'=>'参数不完整!', 'code'=>2000);
				exit(json_encode($output));
			}
	
			//验证用户名手机号是否重复
			if($m_user->where("name = '%s'",$_POST['name'])->select()){
				//echo $m_user->getLastSql();exit;
				//$output = array('data'=>NULL, 'message'=>'用户名已有注册!', 'code'=>5002);
				//exit(json_encode($output));
			}
			if($m_user->where("telephone = '%s' ",$_POST['telephone'])->select()){
				//echo $m_user->getLastSql();exit;
				//$output = array('data'=>NULL, 'message'=>'手机号已有注册!', 'code'=>5003);
				//exit(json_encode($output));
			}
			if($m_user->where("company='%s'",$_POST['company'])->select()){
				//echo $m_user->getLastSql();exit;
				//$output = array('data'=>NULL, 'message'=>'公司名称已有注册!', 'code'=>5004);
				//exit(json_encode($output));
			}
			$m_user->navigation = $navigation;
			$m_user->user_id = $_POST['user_id'];
			$m_user->name = $_POST['name'];
			$m_user->telephone = $_POST['telephone'];
			$m_user->company = $_POST['company'];
			$m_user->category_id = $_POST['category_id'];
			$m_user->department_id = $_POST['department_id'];
			$m_user->position_id = $_POST['position_id'];
			$m_user->lng = $_POST['lng'];
			$m_user->lat = $_POST['lat'];
			$m_user->address = $_POST['address'];
			$m_user->parent_id = $_POST['parent_id'];
			$m_user->reg_time = time();
			$m_user->reg_ip = $_POST['reg_ip'];
			$m_user->password = bmd5(123456);
			$m_user->status = 1;
			// dump($_POST['user_id']);exit;
			if($re_id = $m_user->add()){
				//echo $m_user->getLastSql();exit;
				$data['user_id'] = $_POST['user_id'];
				$data['position_id'] = '17';
				if($role_id = $m_role->add($data)){
					// dump($role_id);
					$m_user->where("user_id = '%s'",$_POST['user_id'])->setField('role_id', $role_id);
					// echo $m_user->getLastSql();exit;
					$output = array('data'=>NULL,'message'=>'添加成功','code'=>2000);
					exit(json_encode($output));
				}else{
					$m_user->where("user_id = '%s'",$_POST['user_id'])->delete();
					$output = array('data'=>NULL,'message'=>'添加失败','code'=>5000);
					exit(json_encode($output));
				}
			}else{
				$output = array('data'=>NULL,'message'=>'数据添加失败','code'=>5005);
				exit(json_encode($output));
			}
		}else{
			//echo 1;
			$this->display();
		}
	}
	
	public function userinfo(){
		echo '添加用户';
	}

	//导入excel数据
	public function impUser(){
		ini_set('max_execution_time','0');
		G('begin');
 		$m_role = M('Role');
	 	$m_user = M('User');

	 	//为用户设置默认导航（根据系统菜单设置中的位置）
		$m_navigation = M('navigation');
		$navigation_list = $m_navigation->order('listorder asc')->select();
		$menu = array();
		foreach($navigation_list as $val){
			if($val['postion'] == 'top'){
				$menu['top'][] = $val['id'];
			}elseif($val['postion'] == 'user'){
				$menu['user'][] = $val['id'];
			}else{
				$menu['more'][] = $val['id'];
			}
		}

		$navigation = serialize($menu);
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
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				for($i=3;$i<=$highestRow;$i++)
				{
					$userId = guid();
					$name =(string)trimall($objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue());
					$m_user->navigation = $navigation;
					$m_user->user_id = $userId;
					$m_user->name = $name;
					$m_user->company = $name;
					$m_user->category_id = 2;
					$m_user->position_id = 21;
					$m_user->parent_id = $_POST['parentId'];
					$m_user->reg_time = time();
					$m_user->password = bmd5(123456);
					$m_user->status = 1;
					$m_user->add();
					// echo $m_user->getLastSql();
					// echo "<hr/>";
					$data['user_id'] = $userId;
					$data['position_id'] = 21;
					$role_id = $m_role->add($data);
					// echo $m_role->getLastSql();
					// echo "<hr/>";
					$m_user->where("user_id = '%s'",$userId)->setField('role_id', $role_id);
					// echo $m_user->getLastSql();
					// echo "<hr/>";
				}
				echo "<br/>";
				G('end');
		        echo G('begin','end').'s';
			} else {
				$this->error('表格数据有误,请重新上传表格!',U('user/adduser'),1);
			}
		}
	}
	
	
	
/**
 * 测试excel
 */
	
	/**
	 * @author zyl
	 * 导入excel表格用户
	 */
	function addexceluser(){
		//echo 12;exit;
		$m_role = M('role');
		$m_user = M('user');
		//var_dump($_POST);exit;
		//var_dump($_FILES);exit;
		if($this->isPost()){
				//echo 1;exit;
				//为用户设置默认导航（根据系统菜单设置中的位置）
				$m_navigation = M('navigation');
				$navigation_list = $m_navigation->order('listorder asc')->select();
				$menu = array();
			
				foreach($navigation_list as $val){
					if($val['postion'] == 'top'){
						$menu['top'][] = $val['id'];
					}elseif($val['postion'] == 'user'){
						$menu['user'][] = $val['id'];
					}else{
						$menu['more'][] = $val['id'];
					}
				}
					
				$navigation = serialize($menu);
			
			if (isset($_FILES['excel']['size']) && $_FILES['excel']['size'] != null) {
				$excelName = $_FILES['excel']['name'];
				G('begin');
				ini_set('max_execution_time','0');
				import('@.ORG.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize = 20000000;
				$upload->allowExts = array('xls');
				$dirname = UPLOAD_PATH . date('Ym', time()) . '/' . date('d', time()) . '/';
				if (!is_dir($dirname) && !mkdir($dirname, 0777, true)) {
					alert('error', L('ATTACHMENTS_TO_UPLOAD_DIRECTORY_CANNOT_WRITE'), $_SERVER['HTTP_REFERER']);
				}
				//var_dump($dirname);exit;
				$upload->savePath = $dirname;
				if (!$upload->upload()) {
					//$this->error($upload->getError());
					$this->error('上传失败!');
				} else {
					$info = $upload->getUploadFileInfo();
				}
				//echo 1;exit;
				if (is_array($info[0]) && !empty($info[0])) {
					$savePath = $dirname . $info[0]['savename'];
				} else {
					alert('error', L('UPLOAD_FAILED'), $_SERVER['HTTP_REFERER']);
				}
				//echo 1;
				import("ORG.PHPExcel.PHPExcel");
			
				//echo 1;exit;
				$file_name=$info[0]['savepath'].$info[0]['savename'];
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			
				//echo 1;exit;
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				$j=0;
				$f =0;
			/* 	echo 'a';
				echo $highestRow.'<br/>';
				echo $highestColumn;exit; */
				$model = new Model();
				$model->startTrans();//事务开启
				for($i=2;$i<=$highestRow;$i++)
				{
					$userId =(string)trimall($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue());
					$ninckName = (string)trimall($objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue());
					$telphone = (string)trimall($objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue());
					$companyName = (string)trimall($objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue());
					$userdata['navigation'] = $navigation;
					$userdata['user_id'] = $userId;
					$userdata['name'] = $ninckName;
					$userdata['company'] = $companyName;
					$userdata['telephone'] = $telphone;
					$userdata['category_id'] = 2;
					$userdata['position_id'] = 17;
					$userdata['parent_id'] = $userId;
					$userdata['reg_time'] = time();
					$userdata['password'] = bmd5(123456);
					$userdata['status'] = 1;
					//var_dump($userdata);exit;
					$user_id = $m_user->add($userdata);
					//var_dump($user_id);exit;
					// echo $m_user->getLastSql();
					// echo "<hr/>";
					$data['user_id'] = $userId;
					$data['position_id'] = 17; //新增用户用17
					if($user_id){
						$role_id = $m_role->add($data);
						//var_dump($role_id);exit;
						$j++;
						//					$model->commit();//事务执行
					}else{
						$userdata['dberror'] = $m_user->getDbError();//添加数据库失败返回的错误信息
						$faileList[] = $userdata;//失败的记录集合
						$f++;//失败数
						//		$model->rollback();//事务回滚
					}
			
					// echo $m_role->getLastSql();
					// echo "<hr/>";
					$m_user->where("user_id = '%s'",$userId)->setField('role_id', $role_id);
					// echo $m_user->getLastSql();
					// echo "<hr/>";
				}
				
				unlink($file_name);
				//$output = array('data'=>NULL, 'message'=>'导入成功！本次导入联系人数量：'.$j.'失败数'.$f, 'code'=>2000,'fail' =>$faileList );
				G('end');
				$this->assign('fail',$faileList); //显示失败记录到页面
				$this->assign('j',$j);
				$this->assign('f',$f);
				$this->assign('filename',$excelName);
				
				$this->display();//显示失败记录到页面
				exit(urldecode(json_encode($output,JSON_UNESCAPED_UNICODE)));
				//$this->success('导入成功！本次导入联系人数量：'.$j);
			
			} else {
				$this->error('表格数据有误,请重新上传表格!',U('Appserver/adduser'),1);
			
				// 						$output = array('data'=>NULL, 'message'=>'导入成功！本次导入联系人数量：'.$j, 'code'=>2000);
				// 						exit(json_encode($output));
			}
		}else{
			$this->display();
		}
	}


	//修改用户号码
	public function updateTel() {
		$output = array();
		$m_user = M('User');
		//接受数据
		$img['telephone'] = $_REQUEST['telephone'];
		$user_id = $_REQUEST['userId'];

		if ($_REQUEST['telephone']==''||$_REQUEST['userId']=='') {
			$output = array('data'=>NULL, 'message'=>'参数不完整!', 'code'=>5000);
			exit(json_encode($output));
		}

		$user = $m_user->where("user_id = '%s'",$_REQUEST['userId'])->find();
		if(empty($user)){
			$output = array('data'=>NULL,'message'=>'用户ID不存在','code'=>2000);
			exit(json_encode($output));
		}


		if($m_user->where("telephone = '%s'",$_REQUEST['telephone'])->select()){
			$output = array('data'=>NULL,'message'=>'该号码已被关联','code'=>5000);
			exit(json_encode($output));
		}

		if($imgupdate = $m_user->where("user_id = '%s'",$_REQUEST['userId'])->save($img)){
			//输出数据
			$output = array(
				'code' => 2000,
				'message' => '修改成功',
				'data' => null,
			);
			exit(json_encode($output));
		}else{
			$output = array('data'=>NULL,'message'=>'修改失败','code'=>5000);
			exit(json_encode($output));
		}
	}

}
?>







