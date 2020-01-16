<?php 

class NavigationWidget extends Widget 
{
	public function render($data)
	{
		$value = M('User')->where("user_id = '%s'", session('user_id'))->getField('navigation');
		$menu = unserialize($value);
		$list = M('Navigation')->field('id,title,url,postion,listorder,module')->cache(true)->select();
		// dump($list);exit;
		//echo M('Navigation')->getLastSql();
		
        if(session('position_id')==22 ||session('position_id')==18){
            $controls = M('Permission')->where('position_id = %d', 17)->getField('url', true);
        }else{
            $controls = M('Permission')->where('position_id = %d', session('position_id'))->getField('url', true);
        }
       // var_dump($controls);exit;
		if (session('position_id')== 14 || session('position_id') == 15 || session('position_id') == 16) {
			unset($list['8']);
		}
        if (session('position_id')== 1) {
            unset($list['0']);
            unset($list['2']);
            unset($list['4']);
            unset($list['5']);
            unset($list['6']);
            unset($list['7']);
        }
        if (session('position_id')== 13) {
            unset($list['0']);
            unset($list['1']);
            unset($list['2']);
            unset($list['4']);
            unset($list['5']);
            unset($list['6']);
            unset($list['7']);
            unset($list['8']);
            unset($list['9']);
            unset($list['13']);//权限分配
            unset($list['14']);
            unset($list['15']);
            unset($list['16']);
            unset($list['18']);
        }
  //dump(session('?admin') );exit;
		foreach($list AS $value) {
			if(empty($value['module']) or in_array(strtolower($value['module']).'/index', $controls) or session('?admin')){
				$navigationList[$value['id']] = $value;
			}
		}
//dump($navigationList);exit;
		foreach($menu AS $k=>$v) {
			foreach($v AS $kk=>$vv) {
				if (isset($navigationList[$vv])) {
					$menu[$k][$kk] = $navigationList[$vv];
					unset($navigationList[$vv]);
				} else {
					unset($menu[$k][$kk]);
				}
			}
		}

		foreach($navigationList AS $value) {
			$menu[$value['postion']][] = $value;
		}
		
		$menu['simple'] =unserialize(M('User')->where("user_id = '%s'", session('user_id'))->getField('simple_menu'));
        // dump($data);exit;
        if($data['type']==1){
        	return $this->renderFile ("user", $menu);
        }else{
			return $this->renderFile ("index", $menu);
        }
	}
}
