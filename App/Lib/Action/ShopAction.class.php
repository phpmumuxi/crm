<?php
class ShopAction extends Action{
    public function _initialize(){
        $action = array(
            'permission'=>array(),
            'allow'=>array('shop','shopdetail','setshop')
        );
        B('Authenticate', $action);
    }

    //店铺列表
    public function shop(){
        set_time_limit(800);
        //print_r($_GET);exit;
        $data['telephone']=isset($_POST['telephone'])?$_POST['telephone']:$_GET['telephone'];
        $data['userNickName']=isset($_POST['userNickName'])?$_POST['userNickName']:$_GET['userNickName'];
        $data['companyName']=isset($_POST['companyName'])?$_POST['companyName']:$_GET['companyName'];
        $data['pageSize']=10;
        $data['start']=!isset($_GET['p'])?0:($_GET['p']-1)*$data['pageSize'];
        $list=send_post(C('URL').'/manager/seUserExpand/selectUserInfoList',$data);
        //print_r($list);exit;
        $list=json_decode(json_encode($list),TRUE);
        import("@.ORG.Page");
        $Page = new Page($list['data']['count'],$data['pageSize']);				//实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list['data']['list']);
        $this->display();
    }


    //店铺详情
    public function shopdetail(){
        $data['userId']=isset($_GET['userId'])?$_GET['userId']:"";
        $data['companyId']=isset($_GET['companyId'])?$_GET['companyId']:"";
        //print_r($data);exit;
        $list=send_post(C('URL').'/manager/seUserExpand/selectDetail',$data);
        $list=json_decode(json_encode($list),TRUE);
        if($data['userId']==""){
            $list['data']['type']=2;//贸易
        }
        if($data['companyId']==""){
            $list['data']['type']=1;//社区
        }
        //print_r($list['data']);exit;
        $this->assign('shop',$list['data']);
        $this->display();
    }


    //设置店铺等级
    public function setshop(){
        $userId=$_GET['userId'];
        $userShopLevel=$_GET['userShopLevel'];//店铺等级
        $userShopType=$_GET['userShopType'];//店铺类型
        if($this->isPost()){
            $data['userId']=$_POST['userId'];
            $data['userShopLevel']=$_POST['level'];
            $status=send_post(C('URL').'/manager/seUserExpand/updateUserExpand',$data);
            if ($status) {
                $this->success('提交成功','__APP__/shop/shop',2);
            }else {
                $this->error('提交失败');
            }
        }else{
            $this->assign('userShopLevel',$userShopLevel);
            $this->assign('userShopType',$userShopType);
            $this->assign('userId',$userId);
            $this->display();
        }
    }
}
