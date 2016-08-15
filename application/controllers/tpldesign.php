<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tpldesign extends MY_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->library('smarty');
	$this->load->model('modelsite');
	$this->load->model('modeltemplate');
	$this->load->model('modelfield');
	$this->smarty->assign("title", 'cms');
	$this->smarty->assign("Name", 'cms1');
	$this->loginCheck();
    }

    public function index()
    {   
          $this->act_verify = 'TPL_INDEX';
          $this->checkCurrentAction();
        
	if(isset($_POST['submit'])){
	    $this->modeltemplate->updateDesignData($_POST);
	    header('Location: /template?siteid='.$_POST['siteid']);
	    exit;
	}
	if(isset($_GET['siteid'])){
	    $siteid = intval($_GET['siteid']);
	}
	else{
	    $siteid = 0;
	}
	if(isset($_GET['tplid'])){
	    $tplid = intval($_GET['tplid']);
	}
	else{
	    $tplid = 0;
	}
	
	$siteinfo = $this->modelsite->getSiteInfo($siteid);
	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	$fieldlist = $this->modelfield->getUsingFields($siteid,$tplid);
	$fieldlist[] = array('id'=>10000,'name'=>'---系统变量---');
	$fieldlist[] = array('id'=>1,'name'=>'文档编号');
	$fieldlist[] = array('id'=>1,'name'=>'模板编号');
	$fieldlist[] = array('id'=>1,'name'=>'项目编号');
	$fieldlist[] = array('id'=>1,'name'=>'创建者');
	$fieldlist[] = array('id'=>1,'name'=>'创建时间');
	$fieldlist[] = array('id'=>1,'name'=>'发布者');
	$fieldlist[] = array('id'=>1,'name'=>'发布时间');
	
	$globallist[] = array('id'=>1,'name'=>'通用头部');
	$globallist[] = array('id'=>1,'name'=>'通用底部');

	
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407001-->');
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407002-->');
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407003-->');
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407004-->');
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407005-->');
	$adlist[] = array('id'=>1,'name'=>'<!--AD:20130407006-->');

	$this->smarty->assign("fieldlist",$fieldlist);
	$this->smarty->assign("globallist",$globallist);
	$this->smarty->assign("adlist",$adlist);
	
	$this->smarty->assign("siteinfo", $siteinfo);
	$this->smarty->assign("tplinfo", $tplinfo);
	$this->smarty->display('cms/tpldesign.tpl');
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */