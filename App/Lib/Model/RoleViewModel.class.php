<?php 
class RoleViewModel extends ViewModel{

	//role权限表 user用户表 position岗位表控制权限 role_department 部门信息
	public $viewFields = array(
		'role'=>array('user_id', 'role_id', 'position_id', '_type'=>'INNER'),
		'user'=>array('name'=>'user_name','status','weixinid','category_id', 'sex', 'address', 'email', 'img', 'telephone','company','dashboard', '_on'=>'user.user_id=role.user_id', 'parent_id'=>'user_parent_id', '_type'=>'INNER'),
		'position'=>array('name'=>'role_name', 'parent_id',  'department_id', 'description','_on'=>'position.position_id=role.position_id', '_type'=>'INNER'),
		'role_department'=>array('name'=>'department_name', '_on'=>'role_department.department_id=position.department_id')
	);
	
}