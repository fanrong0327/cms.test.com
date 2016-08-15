<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Field extends MY_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->model('modelsite');
	$this->load->model('modeltemplate');
	$this->load->model('modelfield');
    }

    public function index()
    {
    	
        $this->act_verify = 'FIELD_INDEX';
        $this->checkCurrentAction();
        
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;

    	
    	//取得站点信息
	$sitelist = $this->modelsite->getSite();
	$siteinfo = array();
	foreach($sitelist as $site)
	{
	    if($siteid >0 && $site['id'] == $siteid)
	    {
		$siteinfo = $site;
		break;
	    }
	}
	
	if($siteinfo['dbname'] == ''){
	    echo '无此站点';
	    return;
	}
	$db = Common::getDbConnect('default', true,array('database'=>$siteinfo['dbname']));
	
	//取得域信息
	$fieldlist = $this->modelfield->getAllFields($siteid,$tplid);
	
	//取得域类型
	$fieldtype = $this->modelfield->getFieldtype();
	
	
	//$this->act_verify = 'FIELD_LIST';
        //$this->checkCurrentAction();
        $data = array(
            'title'=>'模板域管理',
            'subtitle'=>'模板域列表',
	    'siteid' =>$siteinfo['id'],
	    'tplid' =>$tplid,
	    'lists' =>$fieldlist,
	    'fieldtype' => $fieldtype,
        );
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/field/index.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
	
	
    }
    
    
    public function add()
    {
    	
    	//插入数据
	if(isset($_POST['submit'])){
	    $siteid = intval($_POST['siteid']);
	    $tplid = intval($_POST['tplid']);
	    $this->modelfield->insertData($_POST);
	    header('Location: /field?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
   	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
	
    	
    	//取得模板信息
	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	
	//取得域类型
	$fieldtype = $this->modelfield->getFieldtype();
	if($tplinfo['id']==0){
	    header('Location: /field?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	$fieldinfo = array('id'=>0,'name'=>'','fieldtype'=>'','status'=>0,'isdisplay'=>0,'rules'=>'','promote'=>'','mem'=>'','morder'=>0);

	$data = array(
            'title'=>'模板域管理',
            'subtitle'=>'添加模板域',
	    'siteid'=>$siteid,
	    'tplid'=>$tplid,
	    'fieldinfo'=>$fieldinfo,
	    'tplinfo'=>$tplinfo,
	    'fieldtype' => $fieldtype,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/field/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
	
	
    }
    
    
    public function edit()
    {
    	
    	//存入数据库
	if(isset($_POST['submit'])){
	    print_r($_POST);
	    $siteid = intval($_POST['siteid']);
	    $tplid = intval($_POST['tplid']);
	    $this->modelfield->updateData($_POST);
	    header('Location: /field?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
  	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    	$id = isset($_GET['id'])?intval($_GET['id']):0;
	
    	
    	//取得模板信息
	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	if($tplinfo['id']==0){
	    header('Location: /field?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	
	//取得域信息
	$fieldinfo = $this->modelfield->getData($siteid,$tplid,$id);
	
	//取得域类型
	$fieldtype = $this->modelfield->getFieldtype();
	if($fieldinfo['id'] ==0){
	    header('Location: /field?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}

	$data = array(
            'title'=>'模板域管理',
            'subtitle'=>'添加模板域',
	    'siteid'=>$siteid,
	    'tplid'=>$tplid,
	    'fieldinfo'=>$fieldinfo,
	    'tplinfo'=>$tplinfo,
	    'fieldtype' => $fieldtype,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/field/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */