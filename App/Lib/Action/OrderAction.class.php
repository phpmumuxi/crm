<?php
class OrderAction extends Action{
	public function _initialize(){
		$action = array(
			'permission'=>array(),
			'allow'=>array('back','send','view','view2','zuhewhere','service','viewback','analytics','viewservice','managerservice','viewmanager','exchange','getcompany','evaluateinfo')
		);
		B('Authenticate', $action);
	}

	//已卖出商品
	public function index(){
		$data = $this->zuhewhere();
		if(session('position_id') == 13 || session('position_id') == 14 || session('position_id') == 15 || session('position_id') == 16 || session('position_id') == 1){
            $userType = $_GET['userType']?$_GET['userType']:0;
			if($_GET['userId']){
				cookie('companyUser',$_GET['userId']);
                $data['userId'] = cookie('companyUser');
            }else{
                $data['userId'] = '';
            }
			if(!$data['userId']){
				$data['userId'] = $_SESSION['user_id'];
			}
            $this->assign('newUserId',$data['userId']);
			if(session('position_id') == 13){
                if($userType==0){
				    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id,u.company')->select();
                }elseif($userType==1){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"',$data['userId'])->field('u.user_id,u.company')->select();
                }elseif($userType==2){
                    $parentId = $_GET['parentId']?$_GET['parentId']:$data['userId'];
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(17,22)',$parentId)->field('u.user_id,u.parent_id,u.company')->select();
                    $this->assign('newParentId',$parentId);
                }
                $this->assign('userType',$userType);
            }else if(session('position_id') == 14){
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"',session('user_id'))->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("r.position_id = 17 or r.position_id = 22")->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==1) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $company=$_GET['search_company']?$_GET['search_company']:"";
                $where['u.company'] = array('like','%'.$company.'%');
                $offset=$_GET['page']==0?0:($_GET['page']-1)*10;
                $limit=10;
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->limit($offset,$limit)->field('u.user_id as user_id,name,company')->select();
                $userIds = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==15 ){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(17,22)',session('user_id'))->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id') == 16){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(16,19)',session('parent_id'))->field('u.user_id as user_id,name,company')->select();
            }
            if(session('position_id')==1) {
                $count = count($userIds);
                import("@.ORG.Pages");
                $page_row = 10;
                $p = new Pages ($count, $page_row, 8);

                $p->isJumpPage = true;
                $p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
                $show = $p->show();
                $this->assign('pages', $show);
            }
                if($userId){
                    $this->assign('user',$userId);
                }else{                    
                    $this->assign('empty',"<span style='margin:45%'>暂无用户数据</span>");                    
                }
		}else{
            if(session('position_id') == 17 || session('position_id') == 22){
                $data['userId'] = session('user_id');
            }else{
                $data['userId'] = $_SESSION['parent_id'];
            }

		}

		//组合$data
		$data['payMent'] = isset($data['payMent'])?$data['payMent']:null;
		$data['beginTime'] = isset($data['beginTime'])?$data['beginTime']:null;
		$data['endTime'] = isset($data['endTime'])?$data['endTime']:null;
		$data['beginMoney'] = isset($data['beginMoney'])?$data['beginMoney']:null;
		$data['endMoney'] = isset($data['endMoney'])?$data['endMoney']:null;
		$data['orderName'] = $data['orderName']?$data['orderName']:null;
		$data['start'] = $data['start']?$data['start']:0;
		$data['pageSize'] = 5;
		$data['orderStatus'] = isset($data['orderStatus'])?$data['orderStatus']:'0';
		$data['orderCategory'] = 0;
		// if($data['orderStatus'] == 6){
		// 	$data['orderStatus'] = 1;
		// }
		if($_GET['tebSort']){
			$data['tebSort'] = $_GET['tebSort'];
		}else{
			$data['tebSort'] = '1';
		}

		$html = send_post(C('URL').'/manager/order/getOrderList',$data);
        $html = json_decode(json_encode($html,true),true);
		//echo '此处写判断  当数据变化时刷新列表';
		if($html['code'] == 5000){
			echo '<script>location.reload();</script>';
		}

		$count = $html['data']['allCount'];
		import("@.ORG.Page");
		$Page = new Page($count,5);
		$show = $Page->show();
		$this->assign('page',$show);//var_dump($html['data']['objectList']);exit;
        if($html['data']['objectList']){
            $this->assign('order',$html['data']['objectList']);
        }else{
            $this->assign('orderEmpty',true);
        }
		$this->assign('url',C("URL"));
		$payment = $this->zuhewhere();
		if($payment['payMent'] == ''){
			$payment['payMent'] = 99;
		}
		$payment['orderStatus'] = $_COOKIE['orderStatus'];
		$this->assign('data',$payment);
		$this->display();
	}

    //订单评价详情
    public function evaluateinfo(){
        $data['orderNo'] = $_GET['ordreNo'];
        if($data['orderNo']){
            $html = send_post(C('URL').'/manager/orderEvaluate/getEvaluateOrderList',$data);
            $html = json_decode(json_encode($html,true),true);
            if(!$html['success']){
                echo "<script>alert('接口请求失败');history.back();</script>";
            }
            $data['orderType'] = $_GET['orderType'];
            $this->assign('info',$data);
            $this->assign('order',$html['data']);
            $this->display();
        }else{
            echo "<script>alert('非法请求！');history.back();</script>";
        }
    }

	//收到退货申请
	public function back(){
		$data = $this->zuhewhere();
		if(session('position_id') == 13 || session('position_id') == 14 || session('position_id') == 15 || session('position_id') == 16 || session('position_id') == 1) {
            $userType = $_GET['userType']?$_GET['userType']:0;
            if($_GET['userId']){
                cookie('companyUser',$_GET['userId']);
                $data['userId'] = cookie('companyUser');
            }else{
                $data['userId'] = '';
            }
            if(!$data['userId']){
                $data['userId'] = $_SESSION['user_id'];
            }
            $this->assign('newUserId',$data['userId']);
            if(session('position_id') == 13){
                if($userType==0){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id,u.company')->select();
                }elseif($userType==1){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"',$data['userId'])->field('u.user_id,u.company')->select();
                }elseif($userType==2){
                    $parentId = $_GET['parentId']?$_GET['parentId']:$data['userId'];
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(17,22)',$parentId)->field('u.user_id,u.parent_id,u.company')->select();
                    $this->assign('newParentId',$parentId);
                }
                $this->assign('userType',$userType);                
            }else if (session('position_id') == 14) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"', session('user_id'))->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val) {
                    array_push($map, $val['user_id']);
                }
                $where['u.parent_id'] = array(in, $map);
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("r.position_id = 17 or r.position_id = 22")->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==1) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $company=$_GET['search_company']?$_GET['search_company']:"";
                $where['u.company'] = array('like','%'.$company.'%');
                $offset=$_GET['page']==0?0:($_GET['page']-1)*10;
                $limit=10;
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->limit($offset,$limit)->field('u.user_id as user_id,name,company')->select();
                $userIds = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->field('u.user_id as user_id,name,company')->select();
        	}else if(session('position_id')==15 ){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(17,22)',session('user_id'))->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id') == 16){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(16,19)',session('parent_id'))->field('u.user_id as user_id,name,company')->select();
            }
            if(session('position_id')==1) {
                $count = count($userIds);
                import("@.ORG.Pages");
                $page_row = 10;//每页显示条数
                $p = new Pages ($count, $page_row, 8);

                $p->isJumpPage = true;
                $p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
                $show = $p->show();
                $this->assign('pages', $show);
            }
            if($userId){
                $this->assign('user',$userId);
            }else{                    
                $this->assign('empty',"<span style='margin:45%'>暂无用户数据</span>");                    
            }
		}else{
            if(session('position_id') == 17 || session('position_id') == 22){
                $data['userId'] = session('user_id');
            }else{
                $data['userId'] = $_SESSION['parent_id'];
            }
		}
		//组合$data
		$data['payMent'] = isset($data['payMent'])?$data['payMent']:null;
		$data['beginTime'] = isset($data['beginTime'])?$data['beginTime']:null;
		$data['endTime'] = isset($data['endTime'])?$data['endTime']:null;
		$data['beginMoney'] = isset($data['beginMoney'])?$data['beginMoney']:null;
		$data['endMoney'] = isset($data['endMoney'])?$data['endMoney']:null;
		$data['orderName'] = $data['orderName']?$data['orderName']:null;
		$data['start'] = $data['start']?$data['start']:0;
		$data['pageSize'] = 5;
		$data['orderStatus'] = isset($data['orderStatus'])?$data['orderStatus']:'0';

		$html = send_post(C('URL').'/manager/order/afterSale/getOrderList',$data);
        $html = json_decode(json_encode($html,true),true);
		if($html['code'] == 5000){
			echo '<script>location.reload();</script>';
		}
		$count = $html['data']['listSize'];
		import("@.ORG.Page");
		$Page = new Page($count,5);
		$show = $Page->show();
		$this->assign('page',$show);
        if($html['data']['objectList']){
            $this->assign('order',$html['data']['objectList']);
        }else{
            $this->assign('orderEmpty',true);
        }
		$this->assign('url',C("URL"));
		$payment = $this->zuhewhere();
		if($payment['payMent'] == ''){
			$payment['payMent'] = 99;
		}
		$payment['orderStatus'] = $_COOKIE['orderStatus'];
		$this->assign('data',$payment);
		$this->display();
	}


	//已卖出服务
	public function service(){
		$data = $this->zuhewhere();
		if(session('position_id') == 13 || session('position_id') == 14 || session('position_id') == 15 || session('position_id') == 16 || session('position_id') == 1) {
            $userType = $_GET['userType']?$_GET['userType']:0;
            if($_GET['userId']){
                cookie('companyUser',$_GET['userId']);
                $data['userId'] = cookie('companyUser');
            }else{
                $data['userId'] = '';
            }
            if(!$data['userId']){
                $data['userId'] = $_SESSION['user_id'];
            }
            $this->assign('newUserId',$data['userId']);
            if(session('position_id') == 13){
                if($userType==0){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id,u.company')->select();
                }elseif($userType==1){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id ="15"',$data['userId'])->field('u.user_id,u.company')->select();
                }elseif($userType==2){
                    $parentId = $_GET['parentId']?$_GET['parentId']:$data['userId'];
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(16,19,17)',$parentId)->field('u.user_id,u.parent_id,u.company')->select();
                    $this->assign('newParentId',$parentId);
                }
                $this->assign('userType',$userType);                
            }else if (session('position_id') == 14) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in (15,21)', session('user_id'))->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val) {
                    array_push($map, $val['user_id']);
                }
                $where['u.parent_id'] = array(in, $map);
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("r.position_id in(16,19,17)")->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==1) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $company=$_GET['search_company']?$_GET['search_company']:"";
                $where['u.company'] = array('like','%'.$company.'%');
                $offset=$_GET['page']==0?0:($_GET['page']-1)*10;
                $limit=10;
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->limit($offset,$limit)->field('u.user_id as user_id,name,company')->select();
                $userIds = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==15 ){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(17,22)',session('user_id'))->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id') == 16){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(16,19)',session('parent_id'))->field('u.user_id as user_id,name,company')->select();
            }

            if(session('position_id')==1) {
                $count = count($userIds);
                import("@.ORG.Pages");
                $page_row = 10;
                $p = new Pages ($count, $page_row, 8);

                $p->isJumpPage = true;
                $p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
                $show = $p->show();
                $this->assign('pages', $show);
            }
            if($userId){
                $this->assign('user',$userId);
            }else{                    
                $this->assign('empty',"<span style='margin:45%'>暂无用户数据</span>");                    
            }
		}else{
            if(session('position_id') == 19 || session('position_id') == 17 || session('position_id') == 22){
                $data['userId'] = session('user_id');
            }else{
                $data['userId'] = $_SESSION['parent_id'];
            }
		}
		//组合$data
		$data['payMent'] = isset($data['payMent'])?$data['payMent']:null;
		$data['beginTime'] = isset($data['beginTime'])?$data['beginTime']:null;
		$data['endTime'] = isset($data['endTime'])?$data['endTime']:null;
		$data['beginMoney'] = isset($data['beginMoney'])?$data['beginMoney']:null;
		$data['endMoney'] = isset($data['endMoney'])?$data['endMoney']:null;
		$data['orderName'] = $data['orderName']?$data['orderName']:null;
		$data['start'] = $data['start']?$data['start']:0;
		$data['pageSize'] = 5;
		$data['orderStatus'] = isset($data['orderStatus'])?$data['orderStatus']:'0';
		$data['tebSort'] = 3;
		$data['orderCategory'] = 1;
		$html = send_post(C('URL').'/manager/order/getOrderList',$data);
        $html = json_decode(json_encode($html,true),true);
		//echo '此处写判断  当数据变化时刷新列表';
		if($html['code'] == 5000){
			echo '<script>location.reload();</script>';
		}

		$count = $html['data']['allCount'];
		import("@.ORG.Page");
		$Page = new Page($count,5);
		$show = $Page->show();
		$this->assign('page',$show);
        if($html['data']['objectList']){
            $this->assign('order',$html['data']['objectList']);
        }else{
            $this->assign('orderEmpty',true);
        }
		$this->assign('url',C("URL"));
		$payment = $this->zuhewhere();
		if($payment['payMent'] == ''){
			$payment['payMent'] = 99;
		}
		$payment['orderStatus'] = $_COOKIE['orderStatus'];
		$this->assign('data',$payment);
		$this->display();
	}

	//发货
	public function send(){
		$ems = cache('emscache');
		if($ems){
			$this->assign('ems',$ems);
		}else{
			$ch = curl_init();
		    // $url = 'http://apis.baidu.com/netpopo/express/express2';
		    $url = 'http://v.juhe.cn/exp/com?key=ad9c61660a536376dee51fc9ef80ae8f';
		    // $header = array(
		    //     // 'apikey: 5b8ee92f5d5d6dfd0dd29e0371401dfd',
		    //     'key:ad9c61660a536376dee51fc9ef80ae8f',
		    // );
		    // 添加apikey到header
		    // curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    // 执行HTTP请求
		    curl_setopt($ch , CURLOPT_URL , $url);
		    $res = curl_exec($ch);
			$ems = json_decode($res,true);
			// var_dump($ems);exit;
			S('emscache',$ems['result'],60*60*24*100,'File');
			$this->assign('ems',$ems['result']);
		}
		
		$this->assign('url',C('URL'));
		$this->display();
	}

	//订单详情
	public function view(){
		// G('begin');
		$data['totalOrderNo'] = $_GET['ordreNo'];
		$data['orderType'] = '1';
		//dump($data);
		$html = send_post(C('URL').'/manager/order/getOrderRecordByParams',$data);
        $html = json_decode(json_encode($html,true),true);
		if($html['code'] == 5000){
			echo '<script>location.reload();</script>';
		}
		$this->assign('order',$html['data']);
		$this->assign('shop',$html['data']['childOrderList']);
		$this->assign('url',C("URL"));
		// G('end');
		// echo G('begin','end').'s';
		$this->display();
	}

	//服务订单详情
	public function viewservice(){
		// G('begin');
		$data['totalOrderNo'] = $_GET['ordreNo'];
		$data['orderType'] = '1';
		//dump($data);
		$html = send_post(C('URL').'/manager/order/getOrderRecordByParams',$data);
        $html = json_decode(json_encode($html,true),true);
		if($html['code'] == 5000){
			echo '<script>location.reload();</script>';
		}
		//dump($html);
		$this->assign('order',$html['data']);
		$this->assign('shop',$html['data']['childOrderList']);
		$this->assign('url',C("URL"));
		// G('end');
		// echo G('begin','end').'s';
		$this->display();
	}

	//售后订单详情
	public function viewback(){

		$data['sid'] = I('get.sid');
		$data['orderChangeDatetime'] = empty(I('get.orderChangeDatetime'))?null:I('get.orderChangeDatetime');
		$html = send_post(C('URL').'/manager/order/afterSale/queryById',$data);
        $html = json_decode(json_encode($html,true),true);
		if($html['code'] == '5000'){
			echo "<script>alert('订单状态已改变,返回列表页'); window.location.href='http://crm.yiguanjiaclub.net/index.php?m=order&a=back';</script>";
		}
		$this->assign('order',$html['data']);
		$this->assign('url',C("URL"));
		$this->display();

	}
	
	//筛选条件
	public function zuhewhere(){
		$data = array();
		//分页
		if(isset($_GET['p']) && intval($_GET['p']) >= 0){
			$data['start'] =  (intval($_GET['p'])-1)*5;
		} 
		//支付方式
		if(isset($_GET['payMent']) && intval($_GET['payMent']) >= 0){
			if($_GET['payMent'] == 99){
				$_GET['payMent'] = null;
			}
			$data['payMent'] = $_GET['payMent']; 
		}

		//时间
		if(isset($_GET['beginTime']) && intval($_GET['beginTime']) >= 0){
			$data['beginTime'] =  $_GET['beginTime'];
		}
		if(isset($_GET['endTime']) && intval($_GET['endTime']) >= 0){
			$data['endTime'] =  $_GET['endTime'];
		}

		//金额
		if(isset($_GET['beginMoney']) && intval($_GET['beginMoney']) >= 0){
			$data['beginMoney'] =  $_GET['beginMoney'];
		}
		if(isset($_GET['endMoney']) && intval($_GET['endMoney']) >= 0){
			$data['endMoney'] =  $_GET['endMoney'];
		}

		//状态
		if(isset($_GET['orderStatus'])){
			$data['orderStatus'] =  $_GET['orderStatus'];
			cookie('orderStatus',$_GET['orderStatus'],3600);
		}

		if(isset($_GET['k'])){
			//过滤KEY
			$key = trim($_GET['k']);
			if (!get_magic_quotes_gpc()){
				$key = addslashes($key);
			}
			$key = str_replace('_', '', $key);
			$key = str_replace('%', '', $key);
			$key = str_replace('-', '', $key);
			$key = str_replace('*', '', $key);
			$encode = mb_detect_encoding($key, array("ASCII","UTF-8","GB2312","GBK","BIG5"));//mb_detect_encoding检测不准,用这句可以准确检测
			if($encode == "UTF-8"){
				$this->assign('searchkey',$key);
			}else{
				$this->assign('searchkey',iconv('gbk','utf-8',$key));
				$key = iconv('gbk','utf-8',$key);
			}
			if($key != '')
				$data['orderName'] = $key;
				if($data['orderName'] !== $_COOKIE['orderName']){
					$data['start'] = 0;
					unset($_REQUEST['page']);
				}
				cookie('orderName',$key);
		}
		return $data;
	}

    public function getcompany(){
        if($_GET['userId']){
            $data=array();
            $data['tradeagent'] = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 15 and u.parent_id = '%s'",$_GET['userId'])->field('u.user_id,u.name,u.role_id')->select();            
            $data['shopsagent'] = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 21 and u.parent_id = '%s'",$_GET['userId'])->field('u.user_id,u.name')->select();
            $this->ajaxReturn($data,'查询成功', 1);
        }else{
            $this->ajaxReturn('','查询失败', 0);
        }   
    }

	public function analytics(){
         if(session('position_id')==13){
            $areaAllAgent = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 14 and u.parent_id = '%s'",session('user_id'))->field('u.user_id,u.name,u.role_id')->select();
            $map = array();
            foreach ($areaAllAgent as $val){
                array_push($map,$val['user_id']);
            }
            $where['u.parent_id'] = array(in,$map);
            $this->assign('areaAllAgent',$areaAllAgent);
            $tradeagent = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 15")->where($where)->field('u.user_id,u.name,u.role_id')->select();
            $this->assign('tradeagent',$tradeagent);
            $shopsagent = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 21")->where($where)->field('u.user_id,u.name,u.role_id')->select();
            $this->assign('shopsagent',$shopsagent);
        }else if(session('position_id')==14){
            $tradeagent = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 15 and u.parent_id = '%s'",session('user_id'))->field('u.user_id,u.name,u.role_id')->select();
            $this->assign('tradeagent',$tradeagent);
            $shopsagent = M('user as u')->join("INNER JOIN crm_role as r on r.user_id = u.user_id")->where("r.position_id = 21 and u.parent_id = '%s'",session('user_id'))->field('u.user_id,u.name,u.role_id')->select();
            $this->assign('shopsagent',$shopsagent);
        }else if(session('position_id') == 15){
            $this->assign('gAgent', M('user')->where("user_id = '%s'",session('parent_id'))->getField('name'));
            $this->assign('company', M('user')->where("parent_id = '%s'",session('user_id'))->field('name,user_id,company')->select());
        }else if(session('position_id') == 16){
            $this->assign('gAgent', M('user')->where("user_id = '%s'",M('user')->where("user_id = '%s'",session('parent_id'))->getField('parent_id'))->getField('name'));
            $this->assign('shopagent',M('user')->where('user_id = "%s"',session('parent_id'))->getField('name'));
            $this->assign('company',M('user')->where("parent_id = '%s'",session('parent_id'))->field('company,user_id,name,parent_id,role_id')->select());
        }else if(session('position_id') == 19 || session('position_id') == 17 || session('position_id') == 22){
            $this->assign('gAgent', M('user')->where("user_id = '%s'",M('user')->where("user_id = '%s'",M('user')->where('user_id = "%s"',session('parent_id'))->getField('parent_id'))->getField('parent_id'))->getField('name'));
            $this->assign('shopagent',M('user')->where('user_id = "%s"',session('parent_id'))->getField('name'));
        }else if(session('position_id') == 18 || session('position_id') == 20){
            $this->assign('gAgent', M('user')->where("user_id = '%s'",M('user')->where("user_id = '%s'",M('user')->where('user_id = "%s"',session('parent_id'))->getField('parent_id'))->getField('parent_id'))->getField('name'));
            $this->assign('shopagent',M('user')->where('user_id = "%s"', M('user')->where('user_id = "%s"',session('parent_id'))->getField('parent_id'))->getField('name'));
        }

        $data['company'] = I('get.company','all');
        $data['tradeagent'] = I('get.tradeagent','all');
        $data['shopsagent'] = I('get.shopsagent','all');
        $data['areaAllAgent'] = I('get.areaAllAgent','all');

        if(session('position_id')==13){
            if( $data['company'] !== 'all'){            
                $position = M('role')->where('user_id = "%s"',I('get.company'))->find();
                $this->assign('companyName',M('user')->where('user_id = "%s"',I('get.company'))->getField('company'));
            }else{
                if($data['tradeagent'] !== 'all'){
                    $position = M('role')->where('user_id = "%s"',I('get.tradeagent'))->find();       
                }else if($data['shopsagent'] !== 'all'){
                    $position = M('role')->where('user_id = "%s"',I('get.shopsagent'))->find();
                }else{
                    if($data['areaAllAgent'] !== 'all'){
                        $position['position_id'] = 13;
                        $position['user_id'] = I('get.areaAllAgent');     
                    }else{
                        $position['position_id'] = 13;
                        $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id')->select();
                        $mapId =  array();
                        foreach ($userId as $val){
                            array_push($mapId,$val['user_id']);
                        }
                        $position['user_id'] = $mapId;
                    }
                }
            }
        }elseif (session('position_id')==14) {
            if( $data['company'] !== 'all'){            
                $position = M('role')->where('user_id = "%s"',I('get.company'))->find();
                $this->assign('companyName',M('user')->where('user_id = "%s"',I('get.company'))->getField('company'));
            }else{      
                if($data['tradeagent'] !== 'all'){
                    $position = M('role')->where('user_id = "%s"',I('get.tradeagent'))->find();
                }else if($data['shopsagent'] !== 'all'){
                    $position = M('role')->where('user_id = "%s"',I('get.shopsagent'))->find();
                }else{                       
                    $position['position_id'] = 14;                    
                }
            }
        }elseif (session('position_id')==15) {
            if( $data['company'] !== 'all'){            
                $position = M('role')->where('user_id = "%s"',I('get.company'))->find();
                $this->assign('companyName',M('user')->where('user_id = "%s"',I('get.company'))->getField('company'));
            }else{      
                $position['position_id'] = 15;
                $position['user_id'] = session('user_id');
            }
        }else{

        }


        // if( $data['company'] !== 'all'){            
        //     $position = M('role')->where('user_id = "%s"',I('get.company'))->find();
        // }else{
        //     if(I('get.company') == 'all'){
        //         if(session('position_id')==15){
        //             $position = M('role')->where('user_id = "%s"',session('user_id'))->find();
        //         }
        //     }else{

        //         if(I('get.tradeagent') && I('get.tradeagent')!== 'all'){
        //             $position = M('role')->where('user_id = "%s"',I('get.tradeagent'))->find();       
        //         }else if(I('get.shopsagent') && I('get.shopsagent')!== 'all'){
        //             $position = M('role')->where('user_id = "%s"',I('get.shopsagent'))->find();
        //         }else{
        //             if(I('get.areaAllAgent') && I('get.areaAllAgent')!== 'all'){
        //                 $position['position_id'] = 13;
        //                 $position['user_id'] = I('get.areaAllAgent');     
        //             }else{
        //                 $position['position_id'] = 13;
        //                 $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id')->select();
        //                 $mapId =  array();
        //                 foreach ($userId as $val){
        //                     array_push($mapId,$val['user_id']);
        //                 }
        //                 $position['user_id'] = $mapId;
        //             }
        //         }

        //     }
        // } 


            // $this->assign('companySelect',$data['company']);
            // $this->assign('tradeagentSelect',$data['tradeagent']);
            // $this->assign('shopsagentSelect',$data['shopsagent']);
            // $this->assign('areaAllAgentSelect',$data['areaAllAgent']);

        // if(I('get.company') && I('get.company') !== 'all'){
        //     $position = M('role')->where('user_id = "%s"',I('get.company'))->find();
        //     $this->assign('company',I('get.company'));
        //     $this->assign('areaagent',I('get.areaagent'));
            
        // }else if(I('get.tradeagent') && I('get.tradeagent')!== 'all'){
        //     $position = M('role')->where('user_id = "%s"',I('get.tradeagent'))->find();
            
        //     $this->assign('tradeagent',I('get.tradeagent'));
        // }else if(I('get.shopsagent') && I('get.shopsagent')!== 'all'){
        //     $position = M('role')->where('user_id = "%s"',I('get.shopsagent'))->find();
          
        //     $this->assign('areaagent',I('get.tradeagent'));
        // }else{
        //     $position = array('role_id'=>$_SESSION['role_id'],'position_id'=>$_SESSION['position_id'],'user_id'=>$_SESSION['user_id']);
        // }

        // if($_GET['role']) {
        //     $role_id = ($_GET['role']);
        // }else{
        //     $role_id = 'all';
        // }

        // if($_GET['department'] && $_GET['department'] != 'all'){
        //     $department_id = ($_GET['department']);
        // }else{
        //     //$department_id 部门信息id
        //     $department_id = D('RoleView')->where('role.role_id = %d', session('role_id'))->getField('department_id');
        //     //echo D('RoleView')->getLastSql();
        // }

        // $start_time = $_GET['start_time'] ? strtotime(date('Y-m-d',strtotime($_GET['start_time']))) : '';
        // $end_time = $_GET['end_time'] ?  strtotime(date('Y-m-d 23:59:59',strtotime($_GET['end_time']))) : strtotime(date('Y-m-d 23:59:59',time()));

        $start_time = $_GET['start_time'] ? $_GET['start_time'] : '';
        $end_time = $_GET['end_time'] ?  $_GET['end_time']: '';

        // if($role_id == "all") {
            if(session('position_id')==13 || session('position_id')==14 || session('position_id') == 15 ||session('position_id')== 16 || session('position_id') == 21){
                //$roleList = getuser3($type,$typeid,'four');
                $roleList = getTJ($position,false);
            }else{
                $roleList = getTJ('',false);
            }
            // dump($roleList);exit;
            // $role_id_array = array();
            // foreach($roleList as $v2){
            //     $role_id_array[] = $v2['role_id'];
            // }
            // $where_role_id = array('in', implode(',', $role_id_array));
            // $where_source['creator_role_id'] = $where_role_id;
            // $where_industry['owner_role_id'] = $where_role_id;
            // $where_renenue['creator_role_id'] = $where_role_id;
            // $where_employees['creator_role_id'] = $where_role_id;
        // }else{
        // 	$roleList['0']['role_id'] = $role_id;
        //     $where_source['creator_role_id'] = $role_id;
        //     $where_industry['owner_role_id'] = $role_id;
        //     $where_renenue['creator_role_id'] = $role_id;
        //     $where_employees['creator_role_id'] = $role_id;
        // }
        // if($start_time){
        //     $where_create_time = array(array('elt',$end_time),array('egt',$start_time), 'and');
        //     $where_source['create_time'] = $where_create_time;
        //     $where_industry['create_time'] = $where_create_time;
        //     $where_renenue['create_time'] = $where_create_time;
        //     $where_employees['create_time'] = $where_create_time;

        // }else{
        //     $where_source['create_time'] = array('elt',$end_time);
        //     $where_industry['create_time'] = array('elt',$end_time);
        //     $where_renenue['create_time'] = array('elt',$end_time);
        //     $where_employees['create_time'] = array('elt',$end_time);
        // }

		foreach($roleList as $v){
			$user = getUserByRoleId2($v['role_id']);
			if($user['position_id'] == '18' || $user['position_id'] == '20'){
				$order['userId'] = $user['user_parent_id'];
			}else{
				$order['userId'] = $user['user_id'];
			}
			$order['beginTime'] = $start_time;
			$order['endTime'] = $end_time;
// var_dump($order);exit;
			$reportList[] = array("user"=>$user,"ordernum"=>orderAna($order));
		}
        // var_dump($reportList);exit;
		$this->reportList = $reportList;
		$this->display();
	}

    //管家券订单服务
    public function managerservice(){
        $data = $this->zuhewhere();
        if(session('position_id') == 13 || session('position_id') == 14 || session('position_id') == 15 || session('position_id') == 16 || session('position_id') == 1) {
            $userType = $_GET['userType']?$_GET['userType']:0;
            if($_GET['userId']){
                cookie('companyUser',$_GET['userId']);
                $data['userId'] = cookie('companyUser');
            }else{
                $data['userId'] = '';
            }
            if(!$data['userId']){
                $data['userId'] = $_SESSION['user_id'];
            }
            $this->assign('newUserId',$data['userId']);
            if (session('position_id') == 13) {
                if($userType==0){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id,u.company')->select();
                }elseif($userType==1){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "15"',$data['userId'])->field('u.user_id,u.company')->select();
                }elseif($userType==2){
                    $parentId = $_GET['parentId']?$_GET['parentId']:$data['userId'];
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(16,19,17,22)',$parentId)->field('u.user_id,u.parent_id,u.company')->select();
                    $this->assign('newParentId',$parentId);
                }
                $this->assign('userType',$userType);            	
            }else if (session('position_id') == 14) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in (15,21)', session('user_id'))->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val) {
                    array_push($map, $val['user_id']);
                }
                $where['u.parent_id'] = array(in, $map);
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("r.position_id in(16,19,17,22)")->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==1) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $company=$_GET['search_company']?$_GET['search_company']:"";
                $where['u.company'] = array('like','%'.$company.'%');
                $offset=$_GET['page']==0?0:($_GET['page']-1)*10;
                $limit=10;
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->limit($offset,$limit)->field('u.user_id as user_id,name,company')->select();
                $userIds = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->field('u.user_id as user_id,name,company')->select();
        	}else if(session('position_id')==15 ){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(17,22)',session('user_id'))->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id') == 16){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(16,19)',session('parent_id'))->field('u.user_id as user_id,name,company')->select();
            }

            if(session('position_id')==1) {
                $count = count($userIds);
                import("@.ORG.Pages");
                $page_row = 10;
                $p = new Pages ($count, $page_row, 8);

                $p->isJumpPage = true;
                $p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
                $show = $p->show();
                $this->assign('pages', $show);
            }
            if($userId){
                $this->assign('user',$userId);
            }else{                    
                $this->assign('empty',"<span style='margin:45%'>暂无用户数据</span>");                    
            }
        }else{
            if(session('position_id') == 19 || session('position_id') == 17 || session('position_id') == 22){
                $data['userId'] = session('user_id');
            }else{
                $data['userId'] = $_SESSION['parent_id'];
            }
        }
        //组合$data
        //$data['userId']='1D9AF207FFDEBE95CC2C8DD2D150C684';
//        if(!isset($_GET['buyType'])||$_GET['buyType']==1){
//            $data['buyOrSeller']=true;
//        }else{
//            $data['buyOrSeller']=false;
//        }
        $data['buyOrSeller']=false;
        $data['payType'] = isset($data['payMent'])?$data['payMent']:null;
        $data['beginTimeStr'] = isset($data['beginTime'])?$data['beginTime']:null;
        $data['endTimeStr'] = isset($data['endTime'])?$data['endTime']:null;
        $data['beginMoney'] = isset($data['beginMoney'])?$data['beginMoney']:null;
        $data['endMoney'] = isset($data['endMoney'])?$data['endMoney']:null;
        $data['keyWord'] = $data['orderName']?$data['orderName']:null;
        $data['start'] = $data['start']?$data['start']:0;
        $data['pageSize'] = 15;
        $data['status'] = isset($data['orderStatus'])?$data['orderStatus']:'';
        $html = send_post(C('URL').'/manager/ticket/queryOrderList',$data);
        $html = json_decode(json_encode($html,true),true);
        if($html['code'] == 5000){
            echo '<script>location.reload();</script>';
        }
        foreach($html['data']['list'] as $key=>$v){
            $html['data']['list'][$key]['price']=$v['sumFee']/$v['sumCount'];
        }
        $count = $html['data']['allCount'];
        import("@.ORG.Page");
        $Page = new Page($count,5);
        $show = $Page->show();
        $this->assign('page',$show);
        if($html['data']['list']){
            $this->assign('order',$html['data']['list']);
        }else{
            $this->assign('orderEmpty',true);
        }
        $this->assign('url',C("URL"));
        $payment = $this->zuhewhere();
        if($payment['payMent'] == ''){
            $payment['payMent'] = 99;
        }
        $payment['orderStatus'] = $_COOKIE['orderStatus'];
        $this->assign('data',$payment);
        $this->assign('length',strlen($payment['payMent'])+1);
        $this->assign('userId',$data['userId']);
        $this->display();
    }

    //服务订单详情
    public function viewmanager(){
        // G('begin');
        $data['sid'] = $_GET['sid'];
        $data['userId'] = $_GET['userId'];
        $html = send_post(C('URL').'/manager/ticket/getOrderTicketRecord',$data);
        $html = json_decode(json_encode($html,true),true);
        if($html['code'] == 5000){
            echo '<script>location.reload();</script>';
        }
        //print_r($html);exit;
        $this->assign('order',$html['data']);
        $this->assign('ticket',$html['data']['tickList']);
        $this->assign('price',$html['data']['orderTicketRecord']['sumCount']*$html['data']['orderTicketRecord']['sumFee']);
        $this->display();
    }

    /**
     *
     * 管家券兑换记录
     */
    public function exchange(){
        if(session('position_id') == 13 || session('position_id') == 14 || session('position_id') == 15 || session('position_id') == 16 || session('position_id') == 1) {
            $userType = $_GET['userType']?$_GET['userType']:0;
            if($_GET['userId']){
                cookie('companyUser',$_GET['userId']);
                $data['userId'] = cookie('companyUser');
            }else{
                $data['userId'] = '';
            }
            if(!$data['userId']){
                $data['userId'] = $_SESSION['user_id'];
            }
            $this->assign('newUserId',$data['userId']);
            if (session('position_id') == 13) {
                if($userType==0){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id = "14"',session('user_id'))->field('u.user_id,u.company')->select();
                }elseif($userType==1){
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(15,21)',$data['userId'])->field('u.user_id,u.company')->select();
                }elseif($userType==2){
                    $parentId = $_GET['parentId']?$_GET['parentId']:$data['userId'];
                    $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id  in(16,19,17,22)',$parentId)->field('u.user_id,u.parent_id,u.company')->select();
                    $this->assign('newParentId',$parentId);
                }
                $this->assign('userType',$userType);
            }else if (session('position_id') == 14) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in (15,21)', session('user_id'))->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val) {
                    array_push($map, $val['user_id']);
                }
                $where['u.parent_id'] = array(in, $map);
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where("r.position_id in(16,19,17,22)")->where($where)->field('u.user_id as user_id,name,company')->select();;
            }else if(session('position_id')==1) {
                $parentid = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->field('u.user_id')->select();
                $map = array();
                foreach ($parentid as $val){
                    array_push($map,$val['user_id']);
                }
                $where['u.parent_id'] = array(in,$map);
                $offset=$_GET['page']==0?0:($_GET['page']-1)*10;
                $limit=10;
                $userId = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->limit($offset,$limit)->field('u.user_id as user_id,name,company')->select();
                $userIds = M('user as u')->join('crm_role as r on r.user_id = u.user_id')->where($where)->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id')==15 ){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(17,22)',session('user_id'))->field('u.user_id as user_id,name,company')->select();
            }else if(session('position_id') == 16){
                $userId = M('user as u')->join('INNER JOIN crm_role as r on r.user_id = u.user_id')->where('u.parent_id = "%s" and r.position_id in(16,19)',session('parent_id'))->field('u.user_id as user_id,name,company')->select();
            }

            if(session('position_id')==1) {
                $count = count($userIds);
                import("@.ORG.Pages");
                $page_row = 10;//每页显示条数
                //dump($count);
                $p = new Pages ($count, $page_row, 8);

                $p->isJumpPage = true;
                $p->setConfig('theme', '%totalRow% %header% %nowPage%/%totalPage% 页%first% %upPage% %linkPage% %downPage% %end% %jump%');
                $show = $p->show();
                $this->assign('pages', $show);
            }
            if($userId){
                $this->assign('user',$userId);
            }else{                    
                $this->assign('empty',"<span style='margin:45%'>暂无用户数据</span>");                    
            }
        }else{
            if(session('position_id') == 19 || session('position_id') == 17 || session('position_id') == 22){
                $data['userId'] = session('user_id');
            }else{
                $data['userId'] = $_SESSION['parent_id'];
            }
        }

        if($this->isPost()){
            //$datas['sellerId']='1D9AF207FFDEBE95CC2C8DD2D150C684';
            $datas['sellerId']=$data['userId'];
            $datas['ticketNo']=$_POST['id'];
            $status=send_post(C('URL').'/manager/ticket/checkOrderTicketRecord',$datas);
            $status=json_decode(json_encode($status,true),true);
            if($status['success']==true) {
                return $this->ajaxReturn(1);
            }else{
                return $this->ajaxReturn(0);
            }
        }
        //$datas['userId']='1D9AF207FFDEBE95CC2C8DD2D150C684';
        $data['pageSize']=10;
        $data['start']=$_GET['p']==0?0:($_GET['p']-1)*$data['pageSize'];
        $list=send_post(C('URL').'/manager/ticketLog/queryTicketLogList',$data);
        $list=json_decode(json_encode($list),TRUE);
        import("@.ORG.Page");
        $Page = new Page($list['data']['count'],$data['pageSize']);
        $show = $Page->show();
        $this->assign('page',$show);
        if($list['data']['ticketLogList']){
            $this->assign('list',$list['data']['ticketLogList']);
        }else{
            $this->assign('orderEmpty',true);
        }
        $this->display();
    }

}