<?php
/**
 * User Related
 * 用户相关模块
 *
 **/

class UserAction extends Action {


//账号: 第三方可以多个账号登录(权限问题)
//问题:添加用户时验证用户名是否重复,第三方多账号登录,此时的用户名应可以重复,但是同一家公司的用户名不能重复(困难,已废弃)
//方案:新增一个第三方公司的字段,登录用户名不能重复.

//问题:第三方自己添加用户(用户名 密码 ) parent_id
//第三方快速添加用户->用户名 密码  隐藏写入 公司名称 权限 地址 经纬度 position_id

//岗位问题
//直接写公司名称
//2.1 公司名称必填  登录时写入SESSION中

//用户名和手机号唯一,不可重复

//数据同步(安全符)

//登录新增手机号登录
//user_id 加密生成,所有和user_id相关的都需要修改

//经纬度问题

    public function _initialize(){
   //echo 1;exit;
    
        $action = array(
            'permission'=>array('checkuser','ida','login','lostpw','resetpw','active','weixinbinding','notice','agreeagrenment','generalagent','areashop','areaagent'),
            'allow'=>array('lorizhi','checkuser','ida','logout','role_ajax_add','getrolebydepartment','dialoginfo','edit', 'listdialog', 'mutilistdialog', 'getrolelist', 'getpositionlist',  'weixin','changecontent','agreeagrenment','generalagent','areashop','areaagent')
            );
        B('Authenticate', $action);
      	//echo ACTION_NAME;exit;
        // echo date('Y-m-d H:i:s',(strtotime('2016-10-28 13:00:42')+(180*24*60*60)));
    }

    
    public function lorizhi(){
    	//1504080453
    	$user = M('loginHistory');
    	$list = $user->where(['user_id'=>'f19f174808d343bdb22bd2cd49211120'])->select();
    	foreach ($list as $k=>$v){
    		$list[$k]['login_time'] = date('Y-m-d H:m:s',$v['login_time']);
    	}
    	$this->assign('list',$list);
    	$this->display();
    
    }
    
    
    //签署协议
 public function agreeagrenment(){
    	$m_loghistory = M('loginHistory');//用户登录历史表
    	$data = array(
    			'name'=>trim($_POST['name']),
    			'telephone'=>trim($_POST['name']),
    			'_logic'=>'or',
    	);
    	
    	$user = M('user')->where($data)->find();

    	$userId = $user['user_id'];
    	$signData= send_post(C('URL').'/manager/user/sginProtocol',['userId' =>$userId]);
    	if($signData == null)
    		return $this->ajaxReturn(['success' => 0, 'message' =>'接口访问失败']);
    	//var_dump($signData);exit;
    	$signData = get_object_vars($signData);
    	if($signData['success'] || $signData['message'] == '已签署协议'){
    		$d_role = D('RoleView');
    		$role = $d_role->where("user.user_id = '%s'",$user['user_id'])->find();
    		if ($_POST['autologin'] == 'on') {
    			session(array('expire'=>259200));
    			cookie('user_id',$user['user_id'],259200);
    			cookie('name',$user['name'],259200);
    			cookie('salt_code',md5(md5($user['user_id'] . $user['name']).$user['password']),259200);
    		}else{
    			session(array('expire'=>3600));
    		}
    		if (!is_array($role) || empty($role)) {
    			return  $this->ajaxReturn(['success' => 0, 'message' =>  L('HAVE_NO_POSITION')]);
    			//alert('error', L('HAVE_NO_POSITION'));
    		} else {
    			if($user['category_id'] == 1){
    				session('admin', 1);
    			}
    			$record['login_status'] = 1;
    			cookie('runtime',$user['name'],36000);
    			session('role_id', $role['role_id']);
    			session('user_img', $user['img']);
    			session('position_id', $role['position_id']);
    			session('role_name', $role['role_name']);
    			session('department_id', $role['department_id']);
    			session('name', $user['name']);
    			session('user_id', $user['user_id']);
    			session('company',$user['company']);
    			session('parent_id',$user['parent_id']);
    			$username = $user['name'];
    			$upload = $user['img'];
    			F('img_id_'.$user['user_id'],$upload);
    			// G('end');
    			// echo G('begin','end').'s';
    			//添加登录日志
    			$record['login_status'] = 1;
    			$record['user_id'] = $user['user_id'];
    			$record['login_time'] = time();
    			$record['login_ip'] = get_client_ip();
    			$m_loghistory->add($record);
    			return $this->ajaxReturn(['success' => 1, 'message' =>$signData['message'],'url' => U('dynamic/index')]);
    		}
    	}else{
    			return $this->ajaxReturn(['success' => 0, 'message' =>$signData['message']]);
    		}
    }
    

     public function login1(){
    	ob_start();
    	//G('begin');
    	//$m_announcement = M('announcement'); //存放知识文章信息
    	$m_loghistory = M('loginHistory');//用户登录历史表
    	$where['status'] = array('eq', 1);
    	$where['isshow'] = array('eq', 1);
    	//$this->announcement_list = $m_announcement->where($where)->order('order_id')->select();
    	if (session('?name')){
    		$this->redirect('index/index',array(), 0, '');
    	}elseif($_POST['submit']){
    //var_dump($_POST);exit;
    		if((!isset($_POST['name']) || $_POST['name'] =='')||(!isset($_POST['password']) || $_POST['password'] =='')){
    			alert('error', L('INVALIDATE_USER_NAME_OR_PASSWORD'));
    		}elseif (isset($_POST['name']) && $_POST['name'] != ''){
    			//dump($_POST['name']);
    			//判断数据来源
    			// if($_POST['name'] == cookie('runtime')){
    			// 	$user = S('user');
    			// }else{
    			$m_user = M('user');
    			$data = array(
    					'name'=>trim($_POST['name']),
    					'telephone'=>trim($_POST['name']),
    					'_logic'=>'or',
    			);
    			$user = $m_user->where($data)->find();
    			//dump($user);
    			//S('user',$user,36000);
    			if(!$user){
    				alert('error',L('INCORRECT_USER_NAME_OR_PASSWORD'),$_SERVER['HTTP_REFERER']);
    			}
    		

    
    			$login_where['user_id'] = $user['user_id'];
    			$login_where['login_status'] = 2;
    			$login_where['login_time'] = array('gt', time()-10*60);
    			$login_count = $m_loghistory->where($login_where)->count();
    			if($login_count >= 3){
    				$login_time = $m_loghistory->where(array('user_id'=>$user['user_id'],'login_status'=>2))->order('login_time desc')->getField('login_time');
    				$point_time = 10 - (round((time() - $login_time)/60));
    				alert('error', '您登录的错误次数过于频繁，请'.$point_time.'分钟后再试。或点击忘记密码重置', $_SERVER['HTTP_REFERER']);
    			}
    	
    			//记入登录记录
    			$record['user_id'] = $user['user_id'];
    			$record['login_time'] = time();
    			$record['login_ip'] = get_client_ip();
    
    			//查询登录记录防止短时间大量攻击
    			$atime = (time()-60);
    			$btime =time();
    			$num = $m_loghistory->where('user_id = "%s" and login_time > "%d" and login_time < "%d"',$record['user_id'],$atime,$btime)->count();
    			if($num > 30){
    				$login_time = $m_loghistory->where(array('user_id'=>$user['user_id']))->order('login_time desc')->getField('login_time');
    				$point_time = 10 - (round((time() - $login_time)/60));
    				alert('error', '您登录的次数过于频繁，请'.$point_time.'分钟后再试');
    			}
    			
    			
    			if ($user['password'] == md5(md5(trim($_POST['password'])) . $user['salt']) ||$user['password']== bmd5(trim($_POST['password']))) {
    				if (-1 == $user['status']) {
    					alert('error', L('YOU_ACCOUNT_IS_UNAUDITED'));
    				} elseif (0 == $user['status']) {
    					alert('error', L('YOU_ACCOUNT_IS_AUDITEDING'));
    				}elseif (2 == $user['status']) {
    					alert('error', L('YOU_ACCOUNT_IS_DISABLE'));
    				}else {
    					
    					
     		$d_role = D('RoleView');
     		$role = $d_role->where("role.user_id = '%s'",$user['user_id'])->find();
    					if ($_POST['autologin'] == 'on') {
    						session(array('expire'=>259200));
    						cookie('user_id',$user['user_id'],259200);
    						cookie('name',$user['name'],259200);
    						cookie('salt_code',md5(md5($user['user_id'] . $user['name']).$user['password']),259200);
    					}else{
    						session(array('expire'=>3600));
    					}
    					
    					
    					
    					if (!is_array($role) || empty($role)) {
    						alert('error', L('HAVE_NO_POSITION'));
    					} else {
    						if($user['category_id'] == 1){
    							session('admin', 1);
    						}
    						//var_dump($_POST);exit;
    						
    						$record['login_status'] = 1;
    						
 				//$m_loghistory->add($record);
    						cookie('runtime',$user['name'],36000);
    						session('role_id', $role['role_id']);
    						session('user_img', $user['img']);
    						session('position_id', $role['position_id']);
    						session('role_name', $role['role_name']);
    						session('department_id', $role['department_id']);
    						session('name', $user['name']);
    						session('user_id', $user['user_id']);
    						session('company',$user['company']);
    						session('parent_id',$user['parent_id']);
    						$username = $user['name'];
    						$upload = $user['img'];
    						F('img_id_'.$user['user_id'],$upload);
    						// G('end');
    						// echo G('begin','end').'s';
    				//var_dump($_POST);exit;
    						alert('success', L('LOGIN_SUCCESS'), U('dynamic/index'));
    					}
    				}
    			} else {
    				$record['login_status'] = 2;
    				$m_loghistory->add($record);
    				alert('error', L('INCORRECT_USER_NAME_OR_PASSWORD'),$_SERVER['HTTP_REFERER']);
    			}
    		}
    		$this->alert = parseAlert();
    		$this->display();
    	}else{
    		$this->alert = parseAlert();
    		$this->display();
    	}
    } 
    

    
    //登录
    public function login(){
    	header("Access-Control-Allow-Origin:*");
    	$this->assign('url',C('URL'));
        ob_start();
        //G('begin');
        //$m_announcement = M('announcement'); //存放知识文章信息
        $m_loghistory = M('loginHistory');//用户登录历史表
        $where['status'] = array('eq', 1);
        $where['isshow'] = array('eq', 1);
        //$this->announcement_list = $m_announcement->where($where)->order('order_id')->select();
        if (session('?name')){

            return $this->redirect('index/index',array(), 0, '');
        }elseif(isset($_POST) && $_POST){

            if((!isset($_POST['name']) || $_POST['name'] =='')||(!isset($_POST['password']) || $_POST['password'] =='')){
                //alert('error', L('INVALIDATE_USER_NAME_OR_PASSWORD'));
                return $this->ajaxReturn(['success' => 0, 'message' => L('INVALIDATE_USER_NAME_OR_PASSWORD')]);
            }elseif (isset($_POST['name']) && $_POST['name'] != ''){
                //dump($_POST['name']);
                //判断数据来源
                // if($_POST['name'] == cookie('runtime')){
                // 	$user = S('user');
                // }else{
                $m_user = M('user');
                $data = array(
                    'name'=>trim($_POST['name']),
                    'telephone'=>trim($_POST['name']),
                    '_logic'=>'or',
                    );
                
                $user = $m_user->where($data)->find();
                session('userTelphone',$user['telephone']);
                //var_dump($user);exit;
                //S('user',$user,36000);
                if(!$user){
                	
                	return $this->ajaxReturn(['success' => 0, 'message' => "该用户名不存在",'url' => $_SERVER['HTTP_REFERER']]);
                	//alert('error',L('INCORRECT_USER_NAME_OR_PASSWORD'),$_SERVER['HTTP_REFERER']);
                    
                }
      
                // }

                $login_where['user_id'] = $user['user_id'];
                $login_where['login_status'] = 2;
                $login_where['login_time'] = array('gt', time()-10*60);
                $login_count = $m_loghistory->where($login_where)->count();
                if($login_count >= 3){
                    $login_time = $m_loghistory->where(array('user_id'=>$user['user_id'],'login_status'=>2))->order('login_time desc')->getField('login_time');
                    $point_time = 10 - (round((time() - $login_time)/60));
                    return $this->ajaxReturn(['success' => 0, 'message' => '您登录的错误次数过于频繁，请'.$point_time.'分钟后再试。或点击忘记密码重置','url' => $_SERVER['HTTP_REFERER']]);
                    //alert('error', '您登录的错误次数过于频繁，请'.$point_time.'分钟后再试。或点击忘记密码重置', $_SERVER['HTTP_REFERER']);
                }

                //记入登录记录
                $record['user_id'] = $user['user_id'];
                $record['login_time'] = time();
                $record['login_ip'] = get_client_ip();

                //查询登录记录防止短时间大量攻击
                $atime = (time()-60);
                $btime =time();
                $num = $m_loghistory->where('user_id = "%s" and login_time > "%d" and login_time < "%d"',$record['user_id'],$atime,$btime)->count();
                if($num > 30){
                    $login_time = $m_loghistory->where(array('user_id'=>$user['user_id']))->order('login_time desc')->getField('login_time');
                    $point_time = 10 - (round((time() - $login_time)/60));
                   return $this->ajaxReturn(['success' => 0, 'message' => '您登录的次数过于频繁，请'.$point_time.'分钟后再试']);
                    //alert('error', '您登录的次数过于频繁，请'.$point_time.'分钟后再试');
                }
                
                
                if ($user['password'] == md5(md5(trim($_POST['password'])) . $user['salt']) ||$user['password']== bmd5(trim($_POST['password']))) {
                    if (-1 == $user['status']) {
                    	return $this->ajaxReturn(['success' => 0, 'message' =>  L('YOU_ACCOUNT_IS_UNAUDITED')]);
                        //alert('error', L('YOU_ACCOUNT_IS_UNAUDITED'));
                    } elseif (0 == $user['status']) {
                    	return $this->ajaxReturn(['success' => 0, 'message' =>  L('YOU_ACCOUNT_IS_AUDITEDING')]);
                        //alert('error', L('YOU_ACCOUNT_IS_AUDITEDING'));
                    }elseif (2 == $user['status']) {
                    	return $this->ajaxReturn(['success' => 0, 'message' =>  L('YOU_ACCOUNT_IS_DISABLE')]);
                        //alert('error', L('YOU_ACCOUNT_IS_DISABLE'));
                    }else {
                    	//判断是否是已选择店铺
                    	if(!$_POST['selectshop']){
                    		//判断是否是多个店铺
                    		if(preg_match("/^1[34578]{1}\d{9}$/",trim($_POST['name']))){
                    			$userList = M("User")->where(['telephone' => $user['telephone']])->select();
                    			if(count($userList) > 1){
                    				return 	$this->ajaxReturn(['success' => 0, 'message' =>'moreuser',userList =>$userList]);
                    			}
                    		}
                    	
                    	}
                    	//判断用户是否同意协议start
                    	$signPositionIdArr = [17,22];//需要同意协议的position_id集合
                    	$option_id = M('Role')->where(['user_id' => $user['user_id']])->getField('position_id');
                    	//dump($option_id);exit;
                    	if(in_array($option_id, $signPositionIdArr)){
                    	//if($option_id == 17){
                    		$isSignData = [
                    				'userId' => $user['user_id'],
                    				'telephone' => $user['telephone']
                    		];
                    		$isSign = send_post(C('URL').'/manager/user/getIsSign',$isSignData);
                    		$isSign = get_object_vars($isSign);
                    		$isSign['data'] = get_object_vars($isSign['data']);
                    //dump($isSign['data']['isSign']);exit;
                    		if(!$isSign['data']['isSign']){
                    			return 	$this->ajaxReturn(['success' => 0, 'message' =>'noSign']);
                    		}
                    	}
                    		
                        $d_role = D('RoleView');
                        $role = $d_role->where("user.user_id = '%s'",$user['user_id'])->find();
                        if ($_POST['autologin'] == 'on') {
                            session(array('expire'=>259200));
                            cookie('user_id',$user['user_id'],259200);
                            cookie('name',$user['name'],259200);
                            cookie('salt_code',md5(md5($user['user_id'] . $user['name']).$user['password']),259200);
                        }else{
                            session(array('expire'=>3600));
                        }
                        if (!is_array($role) || empty($role)) {
                        	 return  $this->ajaxReturn(['success' => 0, 'message' =>  L('HAVE_NO_POSITION')]);
                            //alert('error', L('HAVE_NO_POSITION'));
                        } else {
                            if($user['category_id'] == 1){
                                session('admin', 1);
                            }
                            $record['login_status'] = 1;
               // var_dump($record);exit;
                           
     						 $m_loghistory->add($record);
            
                            cookie('runtime',$user['name'],36000);
                            session('role_id', $role['role_id']);
                            session('user_img', $user['img']);
                            session('position_id', $role['position_id']);
                            session('role_name', $role['role_name']);
                            session('department_id', $role['department_id']);
                            session('name', $user['name']);
                            session('user_id', $user['user_id']);
                            session('company',$user['company']);
                            session('parent_id',$user['parent_id']);
                            $username = $user['name'];
                            $upload = $user['img'];
                            F('img_id_'.$user['user_id'],$upload);
                            return $this->ajaxReturn(['success' => 1, 'message' =>L('LOGIN_SUCCESS'),'url' => U('dynamic/index')]); 
                        }
                    }
                } else {
                    $record['login_status'] = 2;
                  //  echo 1;exit;
              		$m_loghistory->add($record);
                    //alert('error',  L('INCORRECT_USER_NAME_OR_PASSWORD'),$_SERVER['HTTP_REFERER']);
                   return  $this->ajaxReturn(['success' => 0, 'message' => L('INCORRECT_USER_NAME_OR_PASSWORD'),'url' => $_SERVER['HTTP_REFERER']]);
                }
            }
            $this->alert = parseAlert();
            $this->display();
        }else{
        	$this->alert = parseAlert();
            $this->display();
        }
     }

  
//     //找回密码
//     public function lostpw() {
//     	//var_dump($_POST);
//         if($_POST['submit']){
//         	//var_dump($_POST);exit;
//             if ($_POST['name'] || $_POST['email']){
//                 $user = M('User');
//                 if ($_POST['name']){
//                     $info = $user->where('name = "%s"',trim($_POST['name']))->find();
//                     if(!isset($info) || $info == null){
//                         $this->error(L('NOT_FIND_USER_NAME'));
//                     }
//                 } elseif ($_POST['email']){
//                     $info = $user->where('email = "%s"',trim($_POST['email']))->find();
//                     if (ereg('^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+.[a-zA-Z]{2,3}$',$_POST['email'])){
//                         if (!isset($info) || $info == null){
//                             $this->error(L('EMAIL_NOT_BE_USEED'));
//                         }
//                     }else{
//                         $this->error(L('INVALIDATE_EMAIL'));
//                     }
//                 }
//                 $time = time();

//                 // 手动进行令牌验证
//                 if (!$user->autoCheckToken($_POST)){
//                     $this->error(L('FORM_REPEAT_SUBMIT'), U('user/login'));
//                 }
//                 $user->where('user_id = ' . "'$info[user_id]'")->save(array('lostpw_time' => $time));
//                 $verify_code = md5(md5($time) . $info['salt']);
//                 //dump($verify_code);exit;
//                 C(F('smtp'),'smtp');
//                 import('@.ORG.Mail');
//                 $url = U('user/resetpw', array('user_id'=>$info['user_id'], 'verify_code'=>$verify_code),'','',true);
//                 $content = L('FIND_PASSWORD_EMAIL' ,array($_POST['name'] , $url));
//                 if (SendMail($info['email'],L('FIND_PASSWORD_LINK'),$content,L('5KCRM_ADMIN'))){
//                     $this->success(L('SEND_FIND_PASSWORD_EMAIL_SUCCESS'));
//                 }
//             } else {
//                 $this->error(L('INPUT_USER_NAME_OR_EMAIL'));
//             }
//         } else{
//             if (!F('smtp')) {
//                 $this->error(L('CAN_NOT_USER_THIS_FUNCTION_FOR_NOT_SET_SMTP'));
//             }
//             $this->alert = parseAlert();
//             $this->assign('url',C('URL'));
            
//             $this->display();
//         }
//     }
    
   public function checkuser(){
   	if($_POST && isset($_POST)){
   		if ($_POST['telephone']){
   			$user = M('User');
   			if ($_POST['telephone']){
   				$info = $user->where('telephone = "%s"',trim($_POST['telephone']))->find();
   				if(!isset($info) || $info == null){
   					$this->ajaxReturn(['isUser' => 0,'message' =>'该用户不存在']);
   				}else{
   					$this->ajaxReturn(['isUser' => 1,'message' =>'用户验证成功']);
   				}
   			}
   		}
   	}
   }

    //短信找回密码
    public function lostpw() {
    	//var_dump($_POST);
    	if($_POST && isset($_POST)){
    		//var_dump($_POST);exit;
    		if ($_POST['telephone']){
    			$user = M('User');
    			$info = $user->where('telephone = "%s"',trim($_POST['telephone']))->select();
    			if(!isset($info) || $info == null)
    				$this->ajaxReturn(['error' => 1,'message' =>'该用户不存在']);

				$time = time();
			
				//修改所有ton用户密码
				if(count($info) > 0){
					foreach ($info as $vo){
						$userPwd = md5(md5(trim($_POST["password"])) . $vo['salt']);
						$save = M('user')->save(["user_id" => $vo['user_id'],"password" =>$userPwd,'lostpw_time' => $time]);
					}
				}
				
				
				if($save === false){
    					$this->ajaxReturn(['error' => 1,'message' => "更改密码失败"]);
					}else{
    					$this->ajaxReturn(['error' => 0,'message' => "更改成功，请登录"]);
    			}
    		}
    	} else{
    		if (!F('smtp')) {
    			$this->error(L('CAN_NOT_USER_THIS_FUNCTION_FOR_NOT_SET_SMTP'));
    		}
    		$this->alert = parseAlert();
    		$this->assign('url',C('URL'));
    		$this->display();
    	}
    }
    
    
    //密码重置
    public function resetpw(){
        $verify_code = trim($_REQUEST['verify_code']);
        $user_id = ($_REQUEST['user_id']);
        $m_user = M('User');
        $user = $m_user->where("user_id = '%s'", $user_id)->find();

        // 手动进行令牌验证
        if (!$m_user->autoCheckToken($_POST)){
            $this->error(L('FORM_REPEAT_SUBMIT'), U('user/login'));
        }
        if (is_array($user) && !empty($user)) {
            if ((time()-$user['lostpw_time'])>86400){
                alert('error', L('LINK_DISABLE_PLEASE_FIND_PASSWORD_AGAIN'),U('user/lostpw'));
            }elseif (md5(md5($user['lostpw_time']) . $user['salt']) == $verify_code) {
                if ($_REQUEST['password']) {
                    $password = md5(md5(trim($_REQUEST["password"])) . $user['salt']);
                    $m_user->where("user_id = '%s'", $user_id)->save(array('password'=>$password, 'lostpw_time'=>0));
                    alert('success', L('EDIT_PASSWORD_SUCCESS_PLEASE_LOGIN'), U('user/login'));
                } else {
                    $this->alert = parseAlert();
                    $this->display();
                }
            } else{
                $this->error(L('FIND_PASSWORD_LINK_DISABLE'));
            }
        } else {
            $this->error(L('FIND_PASSWORD_LINK_DISABLE'));
        }
    }

    //退出
    public function logout() {
        session(null);
        cookie('user_id',null);
        cookie('name',null);
        cookie('salt_code',null);
        cookie('companyUser',null);
        cookie('orderStatus',null);
        F('img_id',null);
        $this->redirect(L('LOGIN_OUT_SUCCESS'), U('User/login'));
    }

    public function listDialog() {
        //1表示所有人  2表示下属
        if($_GET['by'] == 'task'){
            $all_or_below = C('defaultinfo.task_model') == 2 ? 1 : 0;
        }else{
            $all_or_below = $_GET['by'] == 'all' ? 1 : 0;
        }
        $d_role_view = D('RoleView');
        $where = '';
        //岗位信息
        $all_role = M('role')->where('user_id <> 0')->select();
        //echo M('role')->getLastSql();
        $below_role = getSubRole(session('role_id'), $all_role);
        if(!$all_or_below){
            $below_ids[] = session('role_id');
            foreach ($below_role as $key=>$value) {
                $below_ids[] = $value['role_id'];
            }
            $where = 'role.role_id in ('.implode(',', $below_ids).')';
        }
        $where = 'user.status = 1';
        //where条件加入公司字段 进行筛选当前公司的员工
        //$where['user.company'] = $_SESSION['company'];
        $role_list = $this->role_list = $d_role_view->where($where." and user.company ='%s'",$_SESSION['company'])->select();
        //echo $d_role_view->getLastSql();
        $count =  $d_role_view->where($where." and user.company ='%s'",$_SESSION['company'])->count();
        // echo $d_role_view->getLastSql();
        // dump($count);
        $this->count = $count;
        $this->total = $count%10 > 0 ? ceil($count/10) : $count/10;
        $departments = M('roleDepartment')->select();
        $department_id = M('position')->where('position_id = %d', session('position_id'))->getField('department_id');
        $departmentList[] = M('roleDepartment')->where('department_id = %d', $department_id)->find();
        $departmentList = array_merge($departmentList, getSubDepartment($department_id,$departments,''));
        $this->assign('departmentList', $departmentList);

        $this->display();
    }



    //任务/负责人/相关任务人
    public function mutiListDialog(){
        //1表示所有人  2表示下属
        if($_GET['by'] == 'task'){
            $all_or_below = C('defaultinfo.task_model') == 2 ? 1 : 0;
        }else{
            $all_or_below = $_GET['by'] == 'all' ? 1 : 0;
        }

        $d_role = D('RoleView');
        $sub_role_id = getSubRoleId(false);
        //dump($_SESSION);exit;

        //判断用户()
        //问题   admin不查询公司分类 第三方公司只查询公司分类 admin的子账号无法使用
        //方案   根据公司来判断(已解决)
        //dump($_SESSION);
        if($_SESSION['user_id'] == 1){
            $departments_list = M('roleDepartment')->where('department_id <> 12')->select();
        }else{
            $departments_list = M('roleDepartment')->where('department_id = 12')->select();
        }

        //echo M('roleDepartment')->getLastSql();
        foreach($departments_list as $k=>$v){
            $where = array();
            if(!$all_or_below)
                $where['role_id'] = array('in', $sub_role_id);
            $where['status'] = 1;
            $where['position.department_id'] =  $v['department_id'];
            $where['company'] = $_SESSION['company'];
            $roleList = $d_role->where($where)->select();
            //echo $d_role->getLastSql();
            $departments_list[$k]['user'] = $roleList;
        }
        $this->departments_list = $departments_list;

        $this->display();
    }


    //删除员工,用户(批量删除暂时屏蔽)
    public function delete(){
//      dump($_POST);exit;
//		alert('error', L('CAN_NOT_DELETE_USER'), U('user/index'));
        $m_user = M('user');
        $r_module = array('Log'=>'RLogUser', 'File'=>'RFileUser');
        if($this->isPost()){
            $user_ids = is_array($_POST['user_id']) ? implode(',', $_POST['user_id']) : '';
            if(in_array(session('user_id'), $_POST['user_id'])) alert('error', L('CAN_NOT_DELETE_YOURSELF'), U('user/index'));

            if ('' == $user_ids) {
                alert('error', L('NOT CHOOSE ANY'), U('user/index'));
            } else {
                if($m_user->where('user_id in (%s) and user_id <> 1 and user_id <> %s', $user_ids, session('user_id'))->delete()){
                    if(M('role')->where('user_id in (%s)', $user_ids)->delete()){
                        foreach ($_POST['user_id'] as $value) {
                            foreach ($r_module as $key2=>$value2) {
                                $module_ids = M($value2)->where('user_id = %s', $value)->getField($key2 . '_id', true);
                                M($value2)->where("user_id = '%s'", $value) -> delete();
                                if(!is_int($key2)){
                                    M($key2)->where($key2 . '_id in (%s)', implode(',', $module_ids))->delete();
                                }
                            }
                        }
                        alert('success', L('DELETED SUCCESSFULLY'),$_SERVER['HTTP_REFERER']);
                    } else {
                        alert('error', L('DELETE FAILED CONTACT THE ADMINISTRATOR'), U('user/index'));
                    }
                } else {
                    alert('error', L('DELETE FAILED CONTACT THE ADMINISTRATOR'), U('user/index'));
                }
            }
        } elseif($_GET['id']) {
            if(session('user_id') == intval($_GET['id'])) alert('error', L('CAN_NOT_DELETE_YOURSELF'), U('user/index'));
            $user = $m_user->where("user_id = '%s'", $_GET['id'])->find();
            if (is_array($user)) {
                if($m_user->where("user_id = '%s' and user_id <> 1 and user_id <> '%s'", $_GET['id'], session('user_id'))->delete()){
                    if(M('role')->where("user_id = '%s'", $_GET['id'])->delete()){
                        foreach ($r_module as $key2=>$value2) {
                            $module_ids = M($value2)->where("user_id = '%s'", $_GET['id'])->getField($key2 . '_id', true);
                            M($value2)->where("user_id = '%s'", $_GET['id']) -> delete();
                            if(!is_int($key2)){
                                M($key2)->where($key2 . '_id in (%s)', implode(',', $module_ids))->delete();
                            }
                        }
                        alert('success', L('DELETED SUCCESSFULLY'), U('user/index'));
                    } else {
                        alert('error', L('DELETE FAILED CONTACT THE ADMINISTRATOR'), U('user/index'));
                    }
                }else{
                    alert('error', L('DELETE FAILED CONTACT THE ADMINISTRATOR'), U('user/index'));
                }
            } else {
                alert('error', L('RECORD NOT EXIST' ,array('')), U('user/index'));
            }
        } else {
            alert('error', L('SELECT_RECORD_TO_DELETE'),$_SERVER['HTTP_REFERER']);
        }
    }



    //修改自己的信息
    public function edit(){
    	//echo 1;exit;
        if ($this->isPost()) {
        	//var_dump($_POST);exit;
            if(!session('?admin') && session('user_id') != $_POST['user_id']){
                $permission = getpermission(MODULE_NAME,ACTION_NAME);
                if($permission['edit'] != 1){
                    alert('error',L('YOU_DO_NOT_HAVE_THIS_RIGHT'),$_SERVER['HTTP_REFERER']);
                }
            }

            $m_user = M('user');
            $m_role = M('role');

            $user=M('user')->where("user_id = '%s'", $_POST['user_id'])->find();

//            //更改用户角色
//            //查询原来角色
//            $position = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("u.user_id = '%s'",$_POST['user_id'])->getField('r.position_id');
//            if($position == 19 && $_POST['position_id'] == 16){
//
//            }
//            dump($position);exit;

            //编辑头像
    /*         if (isset($_FILES['img']['size']) && $_FILES['img']['size'] > 0) {
                import('@.ORG.UploadFile');
                $upload = new UploadFile();
                $upload->maxSize = 20000000;
                $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
                $dirname = UPLOAD_PATH . date('Ym', time()).'/'.date('d', time()).'/';
                if (!is_dir($dirname) && !mkdir($dirname, 0777, true)) {
                    alert('error',L("ATTACHMENTS TO UPLOAD DIRECTORY CANNOT WRITE"),U('user/edit'));
                }
                $upload->savePath = $dirname;
                if(!$upload->upload()) {
                    alert('error',$upload->getErrorMsg(),U('user/edit'));
                }else{
                    $info =  $upload->getUploadFileInfo();
                }
                if(is_array($info[0]) && !empty($info[0])){
                    $upload = $dirname . $info[0]['savename'];
                }else{
                    alert('error',L('LOGO EDIT FAILED'),U('user/edit'));
                }
            } */
//             if(M('user')->where("user_id != '%s' and email = '%s'", $_POST['user_id'],$_POST['email'])->find()){
//                 //echo M('user')->getLastSql();exit;
//                 alert('error', '邮箱已被使用', $_SERVER['HTTP_REFERER']);
//             }
//            if(M('user')->where("user_id != '%s' and telephone = '%s'", $_POST['user_id'],$_POST['telephone'])->find()){
//                alert('error', '手机号已被使用', $_SERVER['HTTP_REFERER']);
//            }
            // $img = C('IMGURL').$upload;
            // dump($img);exit;
  
            
		//密码转换
            if ($m_user->create()) {
                if(isset($_POST['password']) && $_POST['password']!=''){
                    $m_user->password = md5(md5(trim($_POST["password"])) . $user['salt']);
                    $vercodeData['verificationCode'] = $_POST['vercode'];
                    $vercodeData['telephone'] = $_POST['telephone'];
                    $vercodeList=send_post('http://aps.eachonline.com:8002/manager/account/checkCode',$vercodeData);
                    $vercodeList = json_decode(json_encode($vercodeList),TRUE);
                    if(!$vercodeList['success']){
                    	alert('error',$vercodeList['message'],U('user/edit'));
                    } 
                   
                } else {
                    unset($m_user->password);
                }
                $is_update = false;
                if(session('?admin')){
                    $is_update = $m_role->where("user_id = '%s'", $_POST['user_id'])->setField('position_id', $_POST['position_id']);
                }else{
                    unset($m_user->category_id);
                    unset($m_user->name);
                }
                //更换头像
                if($_POST['img'])
                {
                    $m_user->img =$_POST['img'];
                }else{
                    unset($m_user->img);
                }
                if($m_user->save() || $is_update){
                	
                    if($_POST['user_id'] == (session('user_id'))){
                        //session('name', $_POST['name']);
                        if($_POST['img']) F('img_id_'.$_POST['user_id'],$upload);
                    }
                 //添加操作日志
     				actionLog($_POST['user_id']);
                    if(strstr($_POST['r_url'],'a=')){
                        alert('success',L('EDIT_USER_INFO_SUCCESS'),U('user/edit','id='.$_POST['user_id']));
                    }else{
                        alert('success',L('EDIT_USER_INFO_SUCCESS'),U('user/edit'));
                    }
                }else{
                    alert('error',L('USER_INFO_NOT_CHANGE'),$_SERVER['HTTP_REFERER']);
                }
            } else {
                alert('error',L('EDIT_USER_INFO_FAILED'),$_SERVER['HTTP_REFERER']);
            }
            
            
            
            
            
        }else{
 //echo 1;exit;
            $user_id = isset($_REQUEST['id']) ? ($_REQUEST['id']) : session('user_id');
            //dump($user_id);exit;
            if(!session('?admin') && session('user_id') != $user_id ){
                $permission = getpermission(MODULE_NAME,ACTION_NAME);
                if($permission['edit'] != 1){
                    alert('error',L('YOU_DO_NOT_HAVE_THIS_RIGHT'),$_SERVER['HTTP_REFERER']);
                }
            }
            $d_user = D('RoleView');
            $user = $d_user->where("user.user_id = '%s'", $user_id)->find();
            
            //dump($user);
            $user['category'] = M('user_category')->where('category_id = %d', $user['category_id'])->getField('name');
            $this->categoryList = M('user_category')->select();
            $status_list = array(L('INACITVE'),L('ACITVE'),L('DISABLE'));
            $this->assign('statuslist', $status_list);
            if($user['department_id']){
                $this->position_list = M('position')->where('department_id = %d', $user['department_id'])->select();
            }
            $department_list = getSubDepartment(0, M('role_department')->select());
            $this->assign('department_list', $department_list);
            $this->assign('url',C('URL'));
            $this->user = $user;
            //var_dump($user);exit;
            $this->alert = parseAlert();
            $this->r_url = $_SERVER['HTTP_REFERER'];
            $this->display();
        }
    }

    public function dialogInfo(){
        $role_id = ($_REQUEST['id']);
        $role = D('RoleView')->where('role.role_id = %d', $role_id)->find();
        $user = M('user')->where("user_id = '%s'", $role['user_id'])->find();
        $user[role] = $role;
        $this->user = $user;
        $this->categoryList = M('user_category')->select();
        $this->alert = parseAlert();
        $this->display();
    }


    public function changeContent(){
        if($this->isAjax()){
            $d_role_view = D('RoleView');
            $p = !$_REQUEST['p']||$_REQUEST['p']<=0 ? 1 : intval($_REQUEST['p']);
            $department_id = $this->_get('department');
            if($_GET['department'] == 'all'){
                $department_id = session('department_id');
            }else{
                $department_id = $this->_get('department');
            }
            $departRoleArr = getRoleByDepartmentId($department_id);
            $departRoleIdArr = array();
            foreach($departRoleArr as $k=>$v){
                $departRoleIdArr[] = $v['role_id'];
            }
            $where['status'] = array('eq', 1);
            if($this->_get('name','trim') == ''){
                // $where['role_id'] = array('in', $departRoleIdArr);
                $where['user.company'] = $_SESSION['company'];
                $list = $d_role_view->where($where)->order('role_id')->page($p.',10')->select();
                //echo $d_role_view->getLastSql();exit();
                $data['list'] = $list;
                $count = $d_role_view->where($where)->order('role_id')->count();
            }else{
                $where['user.name'] = array('like', '%'.trim($_GET['name']).'%');
                $where['user.company'] = $_SESSION['company'];
                $list = $d_role_view->where($where)->order('role_id')->page($p.',10')->select();
                //echo $d_role_view->getLastSql();
                $count = $d_role_view->where($where)->order('role_id')->count();
                $data['list'] = $list;
            }
            $data['p'] = $p;
            $data['count'] = $count;
            $data['total'] = $count%10 > 0 ? ceil($count/10) : $count/10;
            $this->ajaxReturn($data, '', 1);
        }
    }


    public function add(){
    	//echo 1 ;exit;
        //修改user表 废弃isagent  general_agent   area_agent
        $this->assign('url',C('URL'));
        $m_role = M('Role');
        $m_user = D('User');

      // 
        if ($this->isPost()){
 // dump($_POST);exit;
            $m_user->create();//检测用户名
            if($_POST['radio_type'] == 'email'){
            }else{
                //生成user_id
                //手机号认证是否已经注册app
                $phone['cellPhone'] = $_POST['telephone'];
                $phone = http_build_query($phone);
                $phoneopts = array(
                    'http' => array(
                        'method' => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $phone
                        )
                    );
                $phonetext = stream_context_create($phoneopts);
                $html = file_get_contents(C('URL').'/manager/syncAccount/verifyIsRegister', false, $phonetext);
                $html = json_decode($html,true);
                if($_POST['position_id']!=21) {
                    if ($html['code'] == '2000') {
                        $_POST['user_id'] = $html['data']['userId'];
                        if ($html['data']['userNickNmae']) {
                            $_POST['name'] = $html['data']['userNickNmae'];
                        }
                    } else if ($html['code'] == '4000') {
                        $_POST['user_id'] = $html['data']['userId'];
                        if ($html['data']['userNickNmae']) {
                            $_POST['name'] = $html['data']['userNickNmae'];
                        }
                        $staffapi = 1;
                    } else {
                        $_POST['user_id'] = guid();
                    }
                }else{
                    $_POST['user_id'] = guid();
                }

                //判断条件
                $this->check($_POST);
                //第三方公司自己添加用户,验证公司名称 增加parent_id  权限判断
                if($_SESSION['position_id']== 14){
                    if($_POST['position_id'] == 21 || $_POST['position_id'] == 15){
                        $_POST['parent_id'] = $_SESSION['user_id'];
                    }else if($_POST['position_id'] == 16){
                        if(M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where('r.position_id = "16" and u.parent_id = "%s"',$_POST['areashop'])->field('u.name')->find()){
                            alert('error', '已有社区代理', $_SERVER['HTTP_REFERER']);
                        }
                        $_POST['parent_id'] = $_POST['areashop'];
                    }else if($_POST['position_id'] == 19){
                        $_POST['parent_id'] = $_POST['areashop'];
                    }
                    else if($_POST['position_id'] == 17 || $_POST['position_id'] == 22){
                        $_POST['parent_id'] = $_POST['area_agent'];
                    }

                }else if($_SESSION['position_id'] == 16 ) {
                    if($_POST['position_id'] == 19){
                        $_POST['parent_id'] = session('parent_id');
                    }elseif($_POST['position_id'] == 20){
                        $_POST['parent_id'] = session('user_id');
                        $_POST['company'] = session('company');
                    }

                }else if(session('position_id') == 17 ||session('position_id') == 19 || session('position_id') == 22){
                    $_POST['parent_id'] = session('user_id');
                    $_POST['company'] = session('company');
                }else{
                    //admin添加用户
                    if ($_POST['position_id'] == 14){
                        if (session('position_id') == 13){
                            $_POST['parent_id'] = session('user_id');
                        }else{
                            $_POST['parent_id'] = $_POST['user_id'];
                        }
                    }else if($_POST['position_id'] == 15){
                        $_POST['parent_id'] = $_POST['general_agent'];
                    }else if($_POST['position_id'] == 16){
                        $_POST['parent_id'] = $_POST['areashop'];
                        //判断是否已有社区代理
                        if(M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where('r.position_id = "16" and u.parent_id = "%s"',$_POST['areashop'])->field('u.name')->find()){
                            //alert('error', '已有社区代理', $_SERVER['HTTP_REFERER']);
                        }
                    }else if($_POST['position_id'] == 17 || $_POST['position_id'] == 22){
                        $_POST['parent_id'] = $_POST['area_agent'];
                    }else if ($_POST['position_id'] == 19) {
                        $_POST['parent_id'] = $_POST['areashop'];
                    }else if($_POST['position_id'] == 21){
                        $_POST['parent_id'] = $_POST['general_agent'];
                    }else{
                        $_POST['parent_id'] = 1;
                    }

                    if(session('position_id') == 18 || session('position_id') == 20) {
                        alert('error', '用户角色选择错误', $_SERVER['HTTP_REFERER']);
                    }
                }

                if($_POST['position_id'] == 18 || $_POST['position_id'] == 20){
                }else{
                    if(M('user')->where('company = "%s"',$_POST['company'])->getField('name')){
                        alert('error', '公司名称已被注册', $_SERVER['HTTP_REFERER']);
                    }
                }
                if (!isset($_POST['name']) || $_POST['name'] == '') {
                    alert('error', L('INPUT_USER_NAME'), $_SERVER['HTTP_REFERER']);
                } elseif (!isset($_POST['password']) || $_POST['password'] == ''){
                    alert('error', L('INPUT_PASSWORD'), $_SERVER['HTTP_REFERER']);
                } elseif (!isset($_POST['company']) || $_POST['company'] == ''){
                    alert('error', '公司名称不能为空', $_SERVER['HTTP_REFERER']);
                } elseif (!isset($_POST['telephone']) || $_POST['telephone'] == ''){
                    if(!$_POST['position_id'] == 21){
                        alert('error', '手机号不能为空', $_SERVER['HTTP_REFERER']);
                    }
                } elseif ($m_user->where('telephone ='.$_POST['telephone'])->getField('name')){
                    alert('error', '手机号已被使用', $_SERVER['HTTP_REFERER']);
                } elseif ($m_user->where("name = '%s'",$_POST['name'])->getField('user_id')){
                    alert('error', '用户名称已被使用', $_SERVER['HTTP_REFERER']);
                }elseif (!isset($_POST['category_id']) || $_POST['category_id'] == ''){
                    alert('error', L('PLEASE_SELECT_USER_CATEGORY'), $_SERVER['HTTP_REFERER']);
                } elseif (!session('?admin') && intval($_POST['category_id'])==1) {
                    alert('error', L('YOU_HAVE_NO_PERMISSION_TO_ADD_ADMIN'), $_SERVER['HTTP_REFERER']);
                } elseif(!session('?admin') && intval($_POST['category_id'])==1) {
                    alert('error', L('YOU_HAVE_NO_PERMISSION_TO_ADD_ADMIN'), $_SERVER['HTTP_REFERER']);
                }
               //exit;
                //获取地址相关信息
                // $getIp = $_SERVER["REMOTE_ADDR"];
                // $getIp = '117.89.130.57';
                // $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=YfrMk3eIKhguMXWprcGSHyr6VSY9V6MO&ip={$getIp}&coor=bd09ll");
                // $json = json_decode($content,true);
                // $_POST['address'] = $json['content']['address'];
                // $_POST['lng'] = $json['content']['point']['x'];
                // $_POST['lat'] = $json['content']['point']['y'];
                $_POST['address'] = '江苏省南京市';
                $_POST['lng'] = '118.77807';
                $_POST['lat'] = '32.05724';
                $m_user->status = 1;    //启用
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
                $m_user->navigation = $navigation;
                $m_user->user_id = $_POST['user_id'];
                $m_user->address = $_POST['address'];
                $m_user->name = $_POST['name'];
                $m_user->telephone = $_POST['telephone'];
                $m_user->company = $_POST['company'];
                $m_user->category_id = $_POST['category_id'];
                $m_user->department_id = $_POST['department_id'];
                $m_user->position_id = $_POST['position_id'];
                $m_user->lng = $_POST['lng'];
                $m_user->lat = $_POST['lat'];
                $m_user->parent_id = $_POST['parent_id'];
                //print_r($_POST);exit;
                //安全符认证
                if($re_id = $m_user->add()){
                    S('commomuser',NULL);
                    S('unadmin',NULL);
                    S('listrole',NULL);
                    //解除关联
                    if($staffapi){
                        $staff['appUserId'] = $_POST['user_id'];
                        $staff = http_build_query($staff);
                        $staffopts = array(
                            'http' => array(
                                'method' => 'POST',
                                'header'  => 'Content-type: application/x-www-form-urlencoded',
                                'content' => $staff
                                )
                            );
                        $stafftext = stream_context_create($staffopts);
                        $staffhtml = file_get_contents(C('URL').'/manager/trade/delUserRelEmp', false, $stafftext);
                        $staffhtml = json_decode($staffhtml,true);

                        if($staffhtml['code'] == 2000){
                        }else{
                            if($m_user->where("user_id= '%s'",$_POST['user_id'])->delete()){
                                alert('error', '解除关联失败', $_SERVER['HTTP_REFERER']);
                            }
                        }
                    }

                    if($_POST['position_id'] == 13 || $_POST['position_id'] == 14 || $_POST['position_id'] == 15|| $_POST['position_id'] == 16|| $_POST['position_id'] == 17|| $_POST['position_id'] == 19 || $_POST['position_id'] == 22){
                        //数据同步
                        //用户角色(0.admin分账号， 1.区域总代理， 2.贸易管家代理商，3贸易管家贸易工厂，4社区管家代理商，5.社区管家商铺)
                        if($_POST['position_id'] == 13){
                            $sync['userRole'] = 0;
                        }elseif($_POST['position_id'] == 14){
                            $sync['userRole'] = 1;
                        }elseif($_POST['position_id'] == 15){
                            $sync['userRole'] = 2;
                        }elseif($_POST['position_id'] == 16){
                            $sync['userRole'] = 4;
                        }elseif($_POST['position_id'] == 17){
                            $sync['userRole'] = 3;
                        }elseif($_POST['position_id'] == 19){
                            $sync['userRole'] = 5;
                        }elseif($_POST['position_id'] == 22){
                            $sync['userRole'] = 6;
                        }

                        $sync['userId'] = $_POST['user_id'];
                        $sync['nickName'] = $_POST['company'];
                        $sync['password'] =strtoupper(md5($_POST['password']));
                        $sync['cellPhone'] = $_POST['telephone'];
                        $sync['longitude'] = $_POST['lng'];
                        $sync['latitude'] = $_POST['lat'];
                        $sync['serviceCity'] = $_POST['address'];
                        $sync['isMainAccount'] = '1';
                        $sync['userCompany'] = $_POST['company'];
                        //新增店铺等级
                        if($_POST['position_id'] == 19){
                            $sync['userShopType']=1;
                        }elseif ($_POST['position_id'] == 17){
                            $sync['userShopType']=2;
                        }elseif ($_POST['position_id'] == 22){
                            $sync['userShopType']=3;
                        }
						if($_POST['userShopType']){
							$sync['userShopType'] = $_POST['userShopType'];
						}else{
							$sync['userShopType'] = 1;
						}
                        /* if($_POST['level'] == 0 || $_POST['level'] == 1 || $_POST['level'] == 2){
                            $sync['userShopType']=1;
                        }
                        if($_POST['level'] == 3 || $_POST['level'] == 4){
                            $sync['userShopType']=2;
                        }
                        if($_POST['level'] == 5 || $_POST['level'] == 6){
                            $sync['userShopType']=3;
                        } */
                        $sync['userShopLevel']=$_POST['level'];
                        $sync = http_build_query($sync);
                        $opts = array(
                            'http' => array(
                                'method' => 'POST',
                                'header'  => 'Content-type: application/x-www-form-urlencoded',
                                'content' => $sync
                                )
                            );
                        $context = stream_context_create($opts);
                        $html = file_get_contents(C('URL').'/manager/syncAccount/crmAbsorb', false, $context);
                        $html = json_decode($html,true);
                        //dump($html);exit;
                        if($html['code'] == '2000'){
                            $company = $_POST['company'];
                            $comp['jsonStr'] = "{\"companyName\":\"$company\"}";
                            $comp['crmUserId'] = $_POST['user_id'];
                            $comp = http_build_query($comp);
                            $comopts = array(
                                'http' => array(
                                    'method' => 'POST',
                                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                                    'content' => $comp
                                    )
                                );
                            $comptext = stream_context_create($comopts);
                            $comphtml = file_get_contents(C('URL').'/manager/companyInfo/addTradeCompanyInfo', false, $comptext);
                            $comphtml = json_decode($comphtml,true);
                            if($comphtml['code'] !== '2000'){
                                //if($m_user->where("user_id= '%s'",$_POST['user_id'])->delete()){
                                    //alert('error','APP同步失败,请重试!', $_SERVER['HTTP_REFERER']);
                                //}
                            }
                        }else{
                            //if($m_user->where("user_id= '%s'",$_POST['user_id'])->delete()){
                                //alert('error','APP同步失败,请重试!', $_SERVER['HTTP_REFERER']);
                            //}
                        }
                    }
                    $data['position_id'] = $_POST['position_id'];
                    $data['user_id'] = $_POST['user_id'];
                    $re_id = $_POST['user_id'];
//var_dump($data);exit;
                    if($role_id = $m_role->add($data)){
                        $m_user->where('user_id ='."'$re_id'")->setField('role_id', $role_id);
                        actionLog($re_id);//记录操作日志
                        if($_POST['submit'] == L('ADD')){
                            alert('success', '添加成功', U('user/index'));
                        }else{
                            alert('success', L('ADD_USER_SUCCESS_USER_CAN_LOGIN_NOW'), U('user/add'));
                        }
                    }
                }else{
                    alert('error', L('ADDING FAILS CONTACT THE ADMINISTRATOR' ,array('')),$_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            $m_config = M('Config');
            $category = M('user_category');
            $m_position = M('position');
            if(!session('?admin')){
                $department_list = getSubDepartment2(session('department_id'), M('role_department')->select(), 1);

            }else{
                $department_list =  M('role_department')->select();
            }

            $where['department_id'] = session('department_id');
            $position_list = getSubPosition(session('position_id'), $m_position->where($where)->select());
            $position_id_array = array();
            $position_id_array[] = session('position_id');
            foreach($position_list as $k => $v){
                $position_id_array[] = $v['position_id'];
            }
            $where['position_id'] = array('in', implode(',', $position_id_array));
            $role_list = $m_position->where($where)->select();   //岗位权限控制

            if(empty($role_list) && !session('?admin')){
                alert('error', L('YOU_HAVE_NO_PERMISSION_TO_ADD_USER'), $_SERVER['HTTP_REFERER']);
            }else{
                if(!$m_config->where('name = "smtp"')->find())
                    alert('error', L('PLEASE_SET_SMTP_FIRST_TO_INVITATION_USER',array(U('setting/smtp'))));
                $this->categoryList = $category->select();

                //当总代理添加用户时,查询角色
                if(session('position_id') == 14){
                    $this->part = M('position')->field('position_id,name,department_id,parent_id')->where('department_id = 12 and position_id in(15,16,17,19,22)')->cache(true)->select();
                }
                //print_r($this->part);exit;

                $this->assign('department_list', $department_list);
                $this->alert = parseAlert();
                $this->display();
            }
        }
    }

    public function getPositionList() {
        if($_GET[id]){
            $m_position = M('position');
            $where['department_id'] = $_GET['id'];
            $position_list = getSubPosition(session('position_id'), $m_position->where($where)->order('position_id asc')->select());
            $position_id_array = array();
            foreach($position_list as $k => $v){
                $position_id_array[] = $v['position_id'];
            }
            if(!session('?admin')){
                $where['position_id'] = array('in', implode(',', $position_id_array));
            }
            $role_list = $m_position->where($where)->where("position_id NOT IN (18,20)")->order('position_id asc')->cache(false)->select();
   
            $this->ajaxReturn($role_list, L('GET_SUCCESS'), 1);
        }else{
            $this->ajaxReturn($role_list, L('SELECT_DEPARTMENT_FIRST'), 0);
        }

    }

    //获取总代理商
    public function generalAgent(){
        if($_GET['id']){
            if(session('position_id')==13){
                $agent = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->where('u.parent_id= "%s" AND r.position_id = 14',session('user_id'))->field('u.user_id,u.name,u.parent_id')->select();
            }else{
                $agent = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->where('r.position_id = 14')->field('u.user_id,u.name,u.parent_id')->select();
            }
            $this->ajaxReturn($agent,L('GET_SUCCESS'),1);
        }else{
            $this->ajaxReturn('null', L('SELECT_DEPARTMENT_FIRST'), 0);
        }
    }

    //获取区域划分代理
    public function areashop(){
        if($_GET['id']){
            if(session('admin') || session('position_id')==13){
                $areashop = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->field('u.user_id,u.name,u.parent_id')->where('u.parent_id = "%s" and r.position_id = 21',$_GET['parentId'])->select();
            }else if(session('position_id') == 14){
                $areashop = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->field('u.user_id,u.name,u.parent_id')->where('u.parent_id = "%s" and r.position_id = 21',$_SESSION['user_id'])->select();
            }
            if(!$areashop){
                $areashop['0']['name'] = '暂无区域划分账号';
                $areashop['0']['parent_id'] = '';
                $areashop['0']['user_id'] = '';
            }
            $this->ajaxReturn($areashop,L('GET_SUCCESS'),1);
        }else{
            $this->ajaxReturn('null', L('SELECT_DEPARTMENT_FIRST'), 0);
        }
    }
    //获取区域代理
    public function areaAgent(){
        if($_GET['id']){
            $m_user = M('user');
            if(session('admin') || session('position_id')==13){
                $agent = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->field('u.user_id,u.name,u.parent_id')->where('u.parent_id = "%s" and r.position_id = 15',$_GET['parentId'])->select();
            }else if(session('position_id') == 14){
                $agent = M('user as u')->join('INNER JOIN crm_role as r on r.role_id = u.role_id')->field('u.user_id,u.name,u.parent_id')->where('u.parent_id = "%s" and r.position_id = 15',session('user_id'))->select();
            }

            //echo $m_user->getLastSql();
            if(!$agent){
                $agent['0']['name'] = '暂无企业管家';
                $agent['0']['parent_id'] = '';
                $agent['0']['user_id'] = '';
            }
            $this->ajaxReturn($agent,L('GET_SUCCESS'),1);

        }else{
            $this->ajaxReturn($role_list, L('SELECT_DEPARTMENT_FIRST'), 0);
        }
    }
    public function active() {
        $verify_code = trim($_REQUEST['verify_code']);
        $user_id = intval($_REQUEST['user_id']);
        $m_user = M('User');
        $user = $m_user->where("user_id = '%s'", $user_id)->find();
        if (is_array($user) && !empty($user)) {
            if (md5(md5($user['reg_time']) . $user['salt']) == $verify_code) {
                if ($_REQUEST['password']) {
                    $password = md5(md5(trim($_REQUEST["password"])) . $user['salt']);
                    $m_user->where('user_id =' . "'$_REQUEST[user_id]'")->save(array('password'=>$password,'status'=>1, 'reg_time'=>time(), 'reg_ip'=>get_client_ip()));
                    alert('success', L('SET_PASSWORD_SUCCESS_PLEASE_LOGIN'), U('user/login'));
                } else {
                    $this->alert = parseAlert();
                    $this->display();
                }
            } else {
                $this->error(L('FIND_PASSWORD_LINK_DISABLE'));
            }
        } else {
            $this->error(L('FIND_PASSWORD_LINK_DISABLE'));
        }
    }

    public function view(){
        if($this->isGet()){
            $user_id = isset($_GET['id']) ? $_GET['id'] : 0;
            $p = isset($_GET['p']) ? intval($_GET['p']) : 1 ;
            $type = isset($_GET['type']) ? intval($_GET['type']) : 0 ;
            $this->assign('type',$type);
            $d_user = D('RoleView');
            $user = $d_user->where("user.user_id = '%s'", $user_id)->find();
            //echo $d_user->getLastSql();
            $log_ids = M('rLogUser')->where("user_id = '%s'", $user_id)->getField('log_id', true);
            //echo M('rLogUser')->getLastSql();
            //dump($log_ids);
            $user['log'] = M('log')->where('log_id in (%s)', implode(',', $log_ids))->select();
            $log_count = 0;
            foreach ($user['log'] as $key=>$value) {
                $user['log'][$key]['owner'] = D('RoleView')->where('role.role_id = %d', $value['role_id'])->find();
                $log_count++;
            }
            $user['log_count'] = $log_count;

            $file_ids = M('rFileUser')->where("user_id = '%s'", $user_id)->getField('file_id', true);
            $user['file'] = M('file')->where('file_id in (%s)', implode(',', $file_ids))->select();
            $file_count = 0;
            foreach ($user['file'] as $key=>$value) {
                $user['file'][$key]['owner'] = D('RoleView')->where('role.role_id = %d', $value['role_id'])->find();
                $file_count++;
            }
            $user['file_count'] = $file_count;

            import('@.ORG.Page');// 导入分页类
            $count = M('fieldtype_comment')->where(['recommend_id'=>$user_id,'is_register' => 1])->count('id');
            $Page = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
            $show  = $Page->show();// 分页显示输出       
            $user_list =  M('fieldtype_comment')->field('register_tel,create_time')->where(['recommend_id'=>$user_id,'is_register' => 1])->page($p.',15')->select();
            // dump($user_list);exit();
            $this->assign('user_list',$user_list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出

            $this->categoryList = M('UserCategory')->select();
            $this->user = $user;
            $this->alert = parseAlert();
            $this->display();
        }
    }

    public function index1(){ //一级上下级关系    
        ini_set('max_execution_time','0');
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 1, L('PLEASE_LOGIN_FIRSET'));
        }
        $type = isset($_GET['type']) ? intval($_GET['type']) : 0 ;
        $this->assign('type',$type);
        if(session('position_id')==14){
            if($type){
                $role_ids=M('role')->where("position_id = $type")->getField('role_id',true);
                if($role_ids){
                    $where['role_id'] = array('in',$role_ids);     
                }
            }           
        }
        $p = isset($_GET['p']) ? intval($_GET['p']) : 1 ;
        $status = isset($_GET['status']) ? intval($_GET['status']) : 1 ;
        $username = I('post.username','','trim');
        $this->assign('username',$username);
        $where['status'] = $status;
        $condition['user_id'] = session('user_id');
        $condition['parent_id'] = session('user_id');
        $condition['_logic'] = 'OR';
        $where['_complex'] = $condition;
        $data = M('user')->field('user_id,name,telephone,email,company,address,category_id')->where("name LIKE '%$username%' OR telephone LIKE '%$username%'")->where($where)->page($p.',15')->select();
        // var_dump($data);exit;
        // echo M('user')->getLastSql();exit;
        import('@.ORG.Page');// 导入分页类
        $count = M('user')->where("name LIKE '%$username%' OR telephone LIKE '%$username%'")->where($where)->count('user_id');
        foreach ($data as $k => $v) {            
            $sum = M('fieldtype_comment')->where(['recommend_id'=>$v['user_id']])->count('id');
            $data[$k]['counts']=  $sum; 
        }
         // var_dump($data);exit;
        $Page = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->parameter = '&status=' . $status;
        $show  = $Page->show();// 分页显示输出
        // $user_list = $d_user->where($where)->where("user.name LIKE '%$username%' OR user.telephone LIKE '%$username%'")->page($p.',15')->select();
        // echo $d_user->getLastSql();exit;
        //print_r($user_list);exit;
        // var_dump($user_list);exit;
        $this->assign('user_list',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        // $category = M('user_category');
        // $this->categoryList = $category->select();
        $this->alert = parseAlert();
        $this->display();
    }

    public function getSubRoleIds($self_id){
        $where2['parent_id'] = $self_id;
        $list=M('user')->field('user_id,role_id,parent_id')->where($where2)->select();
        static $array = array();        
        foreach($list AS $va) {
            if ($self_id == $va['parent_id']) {
                array_push($array,$va['role_id']);
                if($va['user_id'] != $va['parent_id']){
                    $this->getSubRoleIds($va['user_id']);
                }
            }
        }
        return $array;
    }

    public function index(){
        ini_set('max_execution_time','0');
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 1, L('PLEASE_LOGIN_FIRSET'));
        }
        $p = isset($_GET['p']) ? intval($_GET['p']) : 1 ;

        $type = isset($_GET['type']) ? intval($_GET['type']) : 0 ;
        $this->assign('type',$type);
        if(!session('?admin')){
            if(session('position_id')==14){
                if($type==15){
                    $role_id = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"',session('user_id'))->field('r.role_id')->select();
                    $map = array();
                    foreach ($role_id as $val){
                        array_push($map,$val['role_id']);
                    }
                    $where['role_id'] = array('in',$map);                
                }elseif ($type==16) {
                    $where2['u.parent_id'] = session('user_id');
                    $where2['r.position_id'] = array('in','16,21');
                    $role_id = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where($where2)->field('r.role_id')->select();
                   
                    $map = array();
                    foreach ($role_id as $val){
                        array_push($map,$val['role_id']);
                    }
                    $where['role_id'] = array('in',$map);
                } else{
                   $where['role_id'] = array('in',$this->getSubRoleIds(session('user_id')));
                }
            }else{                
                $where['role_id'] = array('in',$this->getSubRoleIds(session('user_id')));                   
            }
        }

        $status = isset($_GET['status']) ? intval($_GET['status']) : 1 ;
        $where['status'] = $status;
        $username = I('post.username','','trim');
        $this->assign('username',$username);
        if($username){
            $condition['name'] = array('like',"%$username%");
            $condition['telephone'] = array('like',"%$username%");
            $condition['_logic'] = 'OR';
            $where['_complex'] = $condition;
        }
        import('@.ORG.Page');// 导入分页类
        $count = M('user')->where($where)->count();
        $Page = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->parameter = "type=".$type.'&status='.$status;
        $show  = $Page->show();// 分页显示输出
        $user_list = M('user')->field('user_id,name,telephone,email,company,address,category_id')->where($where)->page($p.',15')->select();       
        if(session('position_id')==14){
            foreach ($user_list as $k => $v) {            
                $sum = M('fieldtype_comment')->where(['recommend_id'=>$v['user_id'],'is_register' => 1])->count('id');
                $user_list[$k]['counts']=  $sum; 
            }
        }
        $this->assign('user_list',$user_list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        $this->alert = parseAlert();
        $this->display();
    }

    public function index0(){//原来方法
        //echo session('position_id');exit;
        // dump($_SESSION);
        ini_set('max_execution_time','0');
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 1, L('PLEASE_LOGIN_FIRSET'));
        }
        $p = isset($_GET['p']) ? intval($_GET['p']) : 1 ;
        
        $status = isset($_GET['status']) ? intval($_GET['status']) : 1 ;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

       // $d_user = D('UserView'); // 实例化User对象
        $where2=[
        		'name'=>['like',$username],
        		'telephone' => ['like',$username],
        		'_logic' =>'OR',
        ];
        if(!session('?admin')) $where['role_id'] = array('in',getSubRoleId(true));//var_dump($where['role_id']);exit;
        $username = I('post.username','','trim');
        $this->assign('username',$username);
        $where['status'] = $status;
        if($id) $where['category_id'] = $id;
        import('@.ORG.Page');// 导入分页类
        $count = M('user as user')->where($where)->where($where2)->count();
        $Page = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->parameter = "id=".$id.'&status=' . $status;
        $show  = $Page->show();// 分页显示输出
       
//         dump($where);
        $user_list = M('user')->where($where)->where($where2)->page($p.',15')->select();
        //echo M('user')->getLastSql();
        //print_r($user_list);exit;
        //var_dump($user_list);exit;
        $this->assign('user_list',$user_list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        $category = M('user_category');
        $this->categoryList = $category->select();
        $this->alert = parseAlert();
        $this->display();
    }


    //查看部门信息
    public function department(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }elseif(!session('?admin')){
            alert('error',L('YOU_HAVE_NO_PERMISSION'),$_SERVER['HTTP_REFERER']);
        }

        $this->assign('tree_code', getSubDepartmentTreeCode(0, 1));
        $this->alert = parseAlert();
        $this->display();
    }

    //添加部门信息
    public function department_add(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }

        if($this->isPost()){
            $department = D('roleDepartment');
            if($department->create()){
                $department->name ? '' :alert('error',L('PLEASE_INPUT_DEPARTMENT_NAME'),$_SERVER['HTTP_REFERER']);
                if($department->add()){
                    alert('success',L('ADD_DEPARTMENT_SUCCESS'),$_SERVER['HTTP_REFERER']);
                }else{
                    alert('error',L('ADD_DEPARTMENT_FAILED_CONTACT_ADMIN'),$_SERVER['HTTP_REFERER']);
                }
            }else{
                alert('error',$department->getError(),$_SERVER['HTTP_REFERER']);
            }
        }else{
            $department = M('roleDepartment');
            $department_list = $department->select();
            $this->assign('departmentList', getSubDepartment(0,$department_list,''));
            $this->display();
        }
    }

    public function department_edit(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }

        if($_POST['name']){
            $department = M('roleDepartment');
            $department->create();
            if($department->save($data)){
                alert('success',L('EDIT_DEPARTMENT_SUCCESS'),$_SERVER['HTTP_REFERER']);
            }else{
                alert('error',L('DATA_NOT_CHANGED_EDIT_FAILED'),$_SERVER['HTTP_REFERER']);
            }
        }elseif($_GET['id']){
            $department = M('roleDepartment');
            $this->assign('vo',$department->where('department_id =%s', $_GET['id'])->find());

            $department_list = $department->select();

            foreach($department_list as $key=>$value){
                if($value['department_id'] == $_GET['id']){
                    unset($department_list[$key]);
                }
                if($value['parent_id'] == $_GET['id']){
                    unset($department_list[$key]);
                }
            }
            $this->assign('departmentList', getSubDepartment(0,$department_list,''));
            $this->display();
        }else{
            $this->error(L('PARAMETER_ERROR'));
        }
    }

    public function department_delete(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }
        $department = M('roleDepartment');
        if($_POST['dList']){
            if(in_array(6,$_POST['dList'],true)){
                $this->error(L('CAN_NOT_DELETE_THE_TOP_DEPARTMENT'));
            }else{
                foreach($_POST['dList'] as $key=>$value){

                    $name = $department->where('department_id = %d',$value)->getField('name');
                    if($department->where('parent_id=%d',$value)->select()){
                        alert('error',L('DELETE_SUB_DEPARTMENT_FIRST',array($name)), $_SERVER['HTTP_REFERER']);
                    }
                    $m_position = M('position');
                    if($m_position->where('department_id=%d',$value)->select()){
                        alert('error',L('DELETE_SUB_POSITION_FIRST',array($name)), $_SERVER['HTTP_REFERER']);
                    }
                }
                if($department->where('department_id in (%s)', join($_POST['dList'],','))->delete()){
                    alert('success', L('DELETED SUCCESSFULLY'),$_SERVER['HTTP_REFERER']);
                }else{
                    $this->error(L('DELETE FAILED CONTACT THE ADMINISTRATOR'));
                }
            }
        }elseif($_GET['id']){
            if(6 == intval($_GET['id'])){
                $this->error(L('CAN_NOT_DELETE_THE_TOP_DEPARTMENT'));
            }
            $department_id = intval($_GET['id']);
            $name = $department->where('department_id = %d', $department_id)->getField('name');
            if($department->where('parent_id=%d', $department_id)->select()){
                alert('error',L('DELETE_SUB_DEPARTMENT_FIRST',array($name)), $_SERVER['HTTP_REFERER']);
            }
            $m_position = M('position');
            if($m_position->where('department_id=%d', $department_id)->select()){
                alert('error',L('DELETE_SUB_POSITION_FIRST',array($name)), $_SERVER['HTTP_REFERER']);
            }
            if($department->where('department_id = %d', $department_id)->delete()){
                alert('success', L('DELETED SUCCESSFULLY'),$_SERVER['HTTP_REFERER']);
            }else{
                $this->error(L('DELETE FAILED CONTACT THE ADMINISTRATOR'));
            }
        }else{
            alert('error', L('SELECT_DEPARTMENT_TO_DELETE'),$_SERVER['HTTP_REFERER']);
        }
    }

    public function role(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }elseif(!session('?admin')){
            alert('error',L('YOU_HAVE_NO_PERMISSION'),$_SERVER['HTTP_REFERER']);
        }
        $this->assign('tree_code', getSubPositionTreeCode2(0, 1));
        $this->alert=parseAlert();
        $this->display();
    }

    public function role_ajax_add(){
        if($_POST['name']){
            $role = D('role');
            if($role->create()){
                $role->name ? '' :alert('error',L('PLEASE_INPUT_POSITION_NAME'),$_SERVER['HTTP_REFERER']);
                if($role_id = $role->add()){
                    $role_list = M('role')->select();
                    if (session('?admin')) {
                        $role_list = getSubRole(0, $role_list, '');
                    } else {
                        $role_list = getSubRole(session('role_id'), $role_list, '');
                    }
                    foreach ($role_list as $key=>$value) {
                        if ($value['user_id'] == 0) {
                            $rs_role[] = $role_list[$key];
                        }
                    }

                    $data['role_id'] = $role_id;
                    $data['role_list'] = $rs_role;
                    $this->ajaxReturn($data,L('SEND_SUCCESS'),1);
                }else{
                    $this->ajaxReturn("",L('SEND_FAILED'),0);
                }
            }else{
                $this->ajaxReturn("",L('SEND_FAILED'),0);
            }
        }else{
            $department = M('roleDepartment');
            $department_list = $department->select();
            $this->assign('departmentList', getSubDepartment(0,$department_list,''));
            $role = M('role');
            $role_list = $role->select();
            $this->assign('roleList', getSubRole(0,$role_list,''));
            $this->display();
        }
    }

    public function role_add(){
        if ($this->isPost()) {
            $d_position = D('Position');
            if($d_position->create()){
                $d_position->name ? '' :alert('error',L('PLEASE_INPUT_POSITION_NAME'),$_SERVER['HTTP_REFERER']);
                if($position_id = $d_position->add()){
                    alert('success',L('ADD_POSITION_SUCCESS'),$_SERVER['HTTP_REFERER']);
                }else{
                    $this->error(L('ADDING FAILS CONTACT THE ADMINISTRATOR' ,array('')));
                }
            }else{
                $this->error(L('ADDING FAILS CONTACT THE ADMINISTRATOR' ,array('')));
            }
        } else {
            $department_list = M('RoleDepartment')->select();
            $position_list = M('Position')->select();
            $this->assign('departmentList', getSubDepartment(0,$department_list,''));
            $this->assign('positionList', getSubPosition(0,$position_list,''));
            $this->display();
        }
    }

    public function getRoleByDepartment(){
        if($this->isAjax()) {
            $department_id = $_GET['department_id'];
            $roleList = getRoleByDepartmentId($department_id);
            $this->ajaxReturn($roleList, '', 1);
        }
    }

    public function roleEdit(){
        if($_GET['auth']){
            $per['position_id'] = intval($_GET['position_id']);
            $per['name'] = trim($_GET['name']);
            $per['description'] = trim($_GET['description']);
            $per['department_id'] = intval($_GET['department_id']);
            $per['parent_id'] = intval($_GET['parent_id']);
            $m_position = M('Position');
            if($m_position -> create($per)){
                if($m_position->save()){
                    $this->ajaxReturn(L('EDIT SUCCESSFULLY'),'info',1);
                }else{

                    $this->ajaxReturn(L('DATA_NOT_CHANGED_EDIT_FAILED'),'info',1);
                }
            }else{
                $this->ajaxReturn(L('EDIT_FAILED_CONTACT_THE_ADMIN'),'info',1);
            }
        }elseif($_GET['id']){
            $m_position = M('position');
            $department_list = M('RoleDepartment')->select();
            $position_list = $m_position->select();
            $this->assign('position', $m_position->where('position_id=%d', $_GET['id'])->find());
            $this->assign('departmentList', getSubDepartment(0,$department_list,''));
            $this->assign('positionList', getSubPosition(0,$position_list,''));
            $this->display();
        }else{
            $this->error(L('PARAMETER_ERROR'));
        }
    }


    public function role_delete(){
        $m_position = M('position');
        $d_role = D('RoleView');
        if($_POST['roleList']){
            if(in_array(1,$_POST['roleList'],true)){
                $this->error(L('CAN_NOT_DELETE_THE_TOP_PERMISSION_USER'));
            }else{
                foreach($_POST['roleList'] as $key=>$value){
                    $name = $m_position->where('role_id = %d', $value)->getField('name');
                    if($d_role->where('position_id = %d', $value)->select()){
                        alert('error',L('HAVE_USER_ON_THIS_POSITION',array($name)), $_SERVER['HTTP_REFERER']);
                    }
                }
                if($m_position->where('role_id in (%s)', join($_POST['roleList'],','))->delete()){
                    alert('success', L('DELETED SUCCESSFULLY'),$_SERVER['HTTP_REFERER']);
                }else{
                    $this->error(L('DELETE FAILED CONTACT THE ADMINISTRATOR'));
                }
            }
        }elseif($_GET['id']){
            if(1 == intval($_GET['id'])){
                $this->error(L('CAN_NOT_DELETE_THE_TOP_PERMISSION_USER'));
            }
            if($d_role->where('position.position_id = %d', intval($_GET['id']))->select()){
                alert('error', L('HAVE_USER_ON_THIS_POSITION',array($name)), $_SERVER['HTTP_REFERER']);
            }else{
                if($m_position->where('position_id = %d', intval($_GET['id']))->delete()){
                    alert('success', L('DELETED SUCCESSFULLY'),$_SERVER['HTTP_REFERER']);
                }else{
                    $this->error(L('DELETE FAILED CONTACT THE ADMINISTRATOR'));
                }
            }
        }else{
            alert('error', L('SELECT_POSITION_TO_DELETE'),$_SERVER['HTTP_REFERER']);
        }
    }

    public function user_role_relation(){
        if(!session('?name') || !session('?user_id')){
            redirect(U('User/login/'), 0, L('PLEASE_LOGIN_FIRSET'));
        }
        //用户添加到岗位
        if($_GET['by'] == 'user_role'){
            if($_GET['id']){
                $this->user = M('User')->where("user_id = '%s'", $_GET['id'])->find(); //占位符操作 %d整型 %f浮点型 %s字符串

                $department = M('roleDepartment');
                $department_list = $department->select();
                $departmentList = getSubDepartment(0, $department_list, '');

                $role = M('Role');
                foreach($departmentList as $key => $value) {
                    $roleList = $role->where('department_id =' . $value['department_id'])->select();
                    $departmentList[$key]['roleList'] = $roleList;
                }

                $this->assign('departmentList', $departmentList);
                $this->display('User:user_role');
            } elseif($_POST['user_id']){
                $m_user = M('user');
                $user = $m_user->where("user_id = '%s'" , $_POST['user_id'])->find();
                if($user['status'] == 0){
                    alert('error', L('GRANT_PERMISSION_FAILED_FOR_NOT_PASS_AUDIT', array($user['name'])),$_SERVER['HTTP_REFERER']);
                } elseif($user['status'] == -1){
                    alert('error', L('GRANT_PERMISSION_FAILED_FOR_NOT_PASS_AUDIT', array($user['name'])),$_SERVER['HTTP_REFERER']);
                } else {
                    $role_ids = is_array($_POST['role']) ? implode(',', $_POST['role']) : '';
                    $m_role = M('role');
                    $m_role->where("role_id in ('%s')", $role_ids)->setField('user_id', $_POST['user_id']);
                    $m_role->where("role_id not in ('%s') and user_id=%s", $role_ids, $_POST['user_id'])->setField('user_id', '');

                    alert('success', L('EDIT_SOMEONE_POSITION_SUCCESS', array($user['name'])),$_SERVER['HTTP_REFERER']);
                }
            }else{
                alert('error',L('PARAMETER_ERROR'),$_SERVER['HTTP_REFERER']);
            }
            //岗位添加用户
        }else if($_GET['by'] == 'role_user'){
            $role = M('role');
            if($_GET['role_id']){
                $this->role = $role->where('role_id = %d',$_GET['role_id'])->find();
                $this->userList =  M('user')->where('status = %d',1)->select();
                $this->display('User:role_user_add');
            }elseif($_POST['role_id']){
                $role->create();
                $m_user = M('user');
                $user = $m_user->where("user_id = '%s'" , $_POST['user_id'])->find();
                if (!$user['role_id']) {
                    $m_user->where("user_id = '%s'" , $_POST['user_id'])->setField('role_id', $_POST['role_id']);
                }
                if($role->save()){
                    alert('success',L('SETTING_SUCCESS'),$_SERVER['HTTP_REFERER']);
                }else{
                    alert('error',L('SETTING_FAILED'),$_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public function changRole(){

    }

    public function getRoleList(){
        $idArray = getSubRoleId();
        //print_r($idArray);
        $roleList = array();
        foreach($idArray as $roleId){
            $roleList[$roleId] = getUserByRoleId($roleId);
        }
        //print_r($roleList);
        $this->ajaxReturn($roleList, '', 1);
    }
    public function weixinbinding(){
        if($_POST['submit']){
            if(!$weixinid = trim($_POST['id'])){
                alert('error', L('PARAMETER_ERROR'),U('User/notice'));
            }
            if((!isset($_POST['name']) || $_POST['name'] =='')||(!isset($_POST['password']) || $_POST['password'] =='')){
                alert('error', L('INVALIDATE_USER_NAME_OR_PASSWORD'),U('User/weixinbinding').'&id='.$weixinid);
            }elseif (isset($_POST['name']) && $_POST['name'] != ''){
                $m_user = M('user');
                $user = $m_user->where(array('name' => trim($_POST['name'])))->find();
                if ($user['password'] == md5(md5(trim($_POST['password'])) . $user['salt'])) {
                    $m_user->where(array('user_id' => $user['user_id']))->save(array('weixinid'=>$weixinid));
                    alert('error', L('BIND_SUCCESS'),U('User/notice'));
                } else {
                    alert('error', L('INCORRECT_USER_NAME_OR_PASSWORD'),U('User/weixinbinding').'&id='.$weixinid);
                }
            }
        }else{
            if(!$weixinid = trim($_GET['id'])){
                alert('error', L('PARAMETER_ERROR'),U('user/notice'));
            }else{
                $this->assign('id',$weixinid);
            }
            $this->alert = parseAlert();
            $this->display();
        }
    }
    public function notice(){
        $this->alert = parseAlert();
        $this->display();
    }
    public function weixin(){
        $weixin = M('Config')->where('name = "weixin"')->getField('value');
        $weixin_config = unserialize($weixin);
        $this->assign('weixin_config',$weixin_config);
        $this->display();
    }


    public function adduser(){
        $this->display();
    }


    public function check($list){
    	if($list['position_id'] == 20 )//员工
    		$list['company'] = session('company');
        if(isset($list['areashop'])&&$list['areashop']==''){
            alert('error', '需要创建分账号!', $_SERVER['HTTP_REFERER']);
        }
        if($_POST['position_id']!=21){
            if(isset($list['telephone'])&&$list['telephone']=='' || isset($list['name'])&&$list['name']=='' || isset($list['password'])&&$list['password']=='' || isset($list['company'])&&$list['company']==''){
                alert('error', '信息不完整!', $_SERVER['HTTP_REFERER']);
            }
        }else {
            if (isset($list['name']) && $list['name'] == '' || isset($list['password']) && $list['password'] == '' || isset($list['company']) && $list['company'] == '') {
                alert('error', '信息不完整!', $_SERVER['HTTP_REFERER']);
            }
        }
        
//         if(($_POST['position_id']==15 || $_POST['position_id']==16 || $_POST['position_id']==17 || $_POST['position_id']==19 ||$_POST['position_id']==22 ) && !isset($_POST['level'])){
//             alert('error', '请选择店铺等级!', $_SERVER['HTTP_REFERER']);
//         }

       
        // if(M('user')->where('r.position_id = "16" and u.parent_id = "%s"',$_POST['areashop'])->field('u.name')->find()){
        //     alert('error', '已有社区代理', $_SERVER['HTTP_REFERER']);
        // }
    }
    
    
    

}