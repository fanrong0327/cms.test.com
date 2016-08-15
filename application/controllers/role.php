<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 角色管理
 */
class Role extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->act_verify = 'ROLE_LIST';
        $this->checkCurrentAction();
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'权限列表',
        );
	$roles = $this->db->get('admin_role')->result_array();
	$mcount = count($roles);
	//for($i = 0; $i<$mcount; $i++){
	//    $roles[$i]['act'] = implode(',', unserialize($roles[$i]['act']));
	//}
    $data['lists'] = $roles;
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/role/index.html');
	
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }

    function edit($id)
    {
        $this->act_verify = 'ROLE_EDIT';
        $this->checkCurrentAction();
        $id = isLegalId($id);
        if ( $this->input->post('submit') ) {
        	$this->_updateActs($id, $this->input->post('roleAct'));
            $save_data = array(
                'name'=>$this->input->post('roleName'),
				'username'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
//                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_role', $save_data);
            
            header('Location: /role/index');
        }
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'权限编辑',
        );
    $data['act'] = $this->getAllAdminActions();
	$data['role'] = $this->db->get_where('admin_role', array('id'=>$id), 1)->row_array();
	$this->db->select('actid');
	$this->db->from('admin_role_act');
	$this->db->where('roleid',$id);
	$query = $this->db->get();
	$useract=array();
	if ($query->num_rows() > 0)
	{
		foreach($query->result_array() as $act){
			$useract[]=$act['actid'];
		}
	}

	$data['role']['act'] = $useract;
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/role/add.html');
	
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }

    function add()
    {
        $this->act_verify = 'ROLE_ADD';
        $this->checkCurrentAction();
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
				'username'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
                //'act'=>serialize($this->input->post('roleAct')),
            );
            $result = $this->db->insert('admin_role', $save_data);
            if($result){
            	$insertid = $this->db->insert_id();
            	$this->_updateActs($insertid, $this->input->post('roleAct'));
            }

            header('Location: /role/index');
        }
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'添加权限',
        );
        $data['act'] = $this->getAllAdminActions();
        $data['role'] = array('name'=>'','username'=>'', 'password'=>'', 'act'=>'');
	
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/role/add.html');
	
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function delete($id)
    {
        $this->act_verify = 'ROLE_DELETE';
        $this->checkCurrentAction();
        $id = isLegalId($id);
        $this->db->where('id', $id);
        $this->db->delete('admin_role');

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    function _updateActs($roleid,$acts){
    	
    	if(!empty($acts)){
    		//删除用户权限
    		$tmpacts = implode(',', $acts);
    		$this->db->query("delete from admin_role_act where `roleid`=$roleid and `actid` not in ($tmpacts)");
   	
	    	//更新用户权限
	    	foreach($acts as $act){
	    		$result = $this->db->get_where('admin_role_act', array('roleid'=>$roleid,'actid'=>$act), 1)->row_array();
				if(empty($result)){
					$this->db->insert('admin_role_act',array('roleid'=>$roleid,'actid'=>$act));
	    		}
	    	}
    	}
    }

}
