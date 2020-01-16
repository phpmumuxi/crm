<?php 
	class UserViewModel extends ViewModel{
		public $viewFields = array(
			'user'=>array('user_id','name','sex','img','email','telephone','address', 'company','_type'=>'INNER'),
			'user_category'=>array('name'=>'category_name','category_id', '_on'=>'user.category_id=user_category.category_id', '_type'=>'INNER'),
			'role'=>array('user_id', 'role_id', 'position_id', '_on'=>'user.user_id=role.user_id', '_type'=>'INNER'),
			'position'=>array('name'=>'role_name', 'parent_id',  'department_id', 'description', '_on'=>'position.position_id=role.position_id', '_type'=>'INNER'),
			'role_department'=>array('name'=>'department_name', '_on'=>'role_department.department_id=position.department_id')
			);
	}