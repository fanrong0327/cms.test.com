<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->act_verify = 'USER_LIST';
        $this->checkCurrentAction();
        $data = array(
            'title'=>'用户管理',
            'subtitle'=>'用户列表',
        );
	$users = $this->db->get('admin_user')->result_array();
	$groups = $this->db->get('admin_role')->result_array();
        $data['lists'] = $users;
	$data['groups'] = $groups;
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/user/index.html');
	
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }

    function edit($id)
    {
        $this->act_verify = 'USER_EDIT';
        $this->checkCurrentAction();
        $id = isLegalId($id);
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_role', $save_data);
            header('Location: /role/index');
        }
        $data = array(
            'title'=>'用户管理',
            'subtitle'=>'用户编辑',
        );
        $data['act'] = $this->getAllAdminActions();
	$data['role'] = $this->db->get_where('admin_user', array('id'=>$id), 1)->row_array();
	$data['role']['act'] = unserialize($data['role']['act']);
	
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/user/add.html');
	
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
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->insert('admin_user', $save_data);
            header('Location: /role/index');
        }
        $data = array(
            'title'=>'用户管理',
            'subtitle'=>'添加用户',
        );
        $data['act'] = $this->getAllAdminActions();
        $data['role'] = array('name'=>'', 'act'=>'');
	
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/user/add.html');
	
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function delete($id)
    {
        $this->act_verify = 'USER_DELETE';
        $this->checkCurrentAction();
        $id = isLegalId($id);
        $this->db->where('id', $id);
        $this->db->delete('admin_user');

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}
