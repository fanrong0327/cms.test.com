<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    
    //功能列表
    function index()
    {
        $this->act_verify = 'ACTION_LIST';
        $this->checkCurrentAction();
        $data = array(
            'title'=>'操作管理',
            'subtitle'=>'操作列表',
        );
	$data['lists'] = $this->getAllAdminActions();
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/action/index.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    
    //编辑功能
    function edit($id)
    {
        $this->act_verify = 'ACTION_EDIT';
        $this->checkCurrentAction();
        $id = isLegalId($id);

        // for save
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'pid'=>$this->input->post('pid'),
                'icon'=>$this->input->post('icon'),
                'title'=>$this->input->post('title'),
                'target'=>$this->input->post('target'),
                'verify'=>$this->input->post('verify'),
                'display'=>$this->input->post('display'),
                'orderby'=>$this->input->post('orderby'),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_action', $save_data);
            header('Location: /action/index');
        }

        $data = array(
            'title'=>'操作管理',
            'subtitle'=>'操作编辑',
        );
        $data['act'] = $this->getActionInfo($id);
        $data['top_act'] = $this->getAllAdminActions();
	$this->smarty->assign('data',$data);
	$this->smarty->assign('icon_arr',listActionIcon());
	$main = $this->smarty->fetch('cms/action/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }

    
    //添加功能
    function add()
    {
        $this->act_verify = 'ACTION_ADD';
        $this->checkCurrentAction();
        // for save
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'pid'=>$this->input->post('pid'),
                'icon'=>$this->input->post('icon'),
                'title'=>$this->input->post('title'),
                'target'=>$this->input->post('target'),
                'verify'=>$this->input->post('verify'),
                'display'=>$this->input->post('display'),
                'orderby'=>$this->input->post('orderby'),
            );
            $this->db->insert('admin_action', $save_data);
            header('Location: /action/index');
        }

        $data = array(
            'title'=>'操作管理',
            'subtitle'=>'添加操作',
        );
        $data['act'] = array('title'=>'', 'icon'=>'', 'target'=>'', 'verify'=>'', 'display'=>'', 'orderby'=>'','pid'=>'');
        $data['top_act'] = $this->getAllAdminActions();

	$this->smarty->assign('data',$data);
	$this->smarty->assign('icon_arr',listActionIcon());
	$main = $this->smarty->fetch('cms/action/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    
    //删除功能
    function delete($id)
    {
        $this->act_verify = 'ACTION_DELETE';
        $this->checkCurrentAction();
        $id = isLegalId($id);
        $this->db->where('id', $id);
        $this->db->or_where('pid', $id);
        $this->db->delete('admin_action');
         header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}
