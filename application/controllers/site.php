<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * 站点管理
 */
class Site extends MY_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->model('modelsite');
	
    }

    public function index()
    {
    	$this->loginCheck();
	$this->act_verify = 'ACTION_LIST';
        $this->checkCurrentAction();
        $data = array(
            'title'=>'站点管理',
            'subtitle'=>'站点列表',
        );
        
        //取得站点列表
	$data['lists'] = $this->modelsite->getSite();
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/site/index.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
	
    }
    
    //添加站点
    public function add()
    {
    	$this->loginCheck();
	$this->act_verify = 'SITE_ADD';
        $this->checkCurrentAction();
	if(isset($_POST['submit'])){
	    $this->modelsite->createSite($_POST);
	    header('Location: /site');
	    exit;
	}
	$siteinfo = array('id'=>0,'name'=>'','url'=>'','dbhost'=>'','dbport'=>'','dbuser'=>'','dbpass'=>'','isuse'=>'1','ishide'=>'0');
	$data = array(
            'title'=>'站点管理',
            'subtitle'=>'添加站点',
	    'content'=>$siteinfo,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/site/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
	
    }
    
    //编辑站点
    public function edit()
    {
    	$this->loginCheck();
	$this->act_verify = 'SITE_EDIT';
        $this->checkCurrentAction();
	if(isset($_POST['submit'])){
	    $siteid = intval($_POST['id']);
	    $this->modelsite->updateData($_POST);
	    header('Location: /site');
	    exit;
	}
	if(isset($_GET['id'])){
	    $id = intval($_GET['id']);
	}
	else{
	    $id = 0;
	}
	
	$siteinfo = $this->modelsite->getSiteInfo($id);
	if($siteinfo['id'] ==0){
	    header('Location: /site');
	    exit;
	}

	$data = array(
            'title'=>'站点管理',
            'subtitle'=>'编辑站点',
	    'content'=>$siteinfo,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/site/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }
    
    
    //自动发布
    public function autopub(){
    	echo date('Y-m-d H:i:s').'|autopub start<br/>'."\n";
    	set_time_limit(0);
    	$this->load->library("Http");
		$lists = $this->_getPublishList();
		foreach($lists as $item){
			if(isset($item['site']) && isset($item['tplid']) && isset($item['contentid'])){
				$url = "http://cms.lingyun5.com/content/publish?auto=true&siteid=".$item['site']."&tplid=".$item['tplid']."&id=".$item['contentid']."";
				$result = $this->http->get($url,array(),0);
				if($result!='success'){
					$result = $this->http->get($url,array(),0);
				}
				echo date('Y-m-d H:i:s').'|'.$item['site'].'|'.$item['tplid'].'|'.$item['contentid'].'|'.$result.'<br/>'."\n";
				
			}
		}
		echo date('Y-m-d H:i:s').'|autopub end<br/>'."\n";
    }
    
    //获取发布文档列表
    private function _getPublishList(){
    	$mreturn1 = array();
    	$this->load->model('modeltemplate');
    	$sitelist = $this->modelsite->getSite();
    	foreach($sitelist as $site){
    		if($site['id'] >0){
    			$tpl_array = $this->modeltemplate->getTemplate($site['id']);
    			foreach($tpl_array as $tpl){
    				if($tpl['condition']!=''){
	    				$contents = eval($tpl['condition']);
	    				if(is_array($contents) && !empty($contents)){
	    					foreach($contents as $content)
	    					{
	    						$mreturn1[] = array('site'=>$site['id'],'tplid'=>$tpl['id'],'contentid'=>$content);
	    					}
	    				}
    				}
    			}
    		}
    	}
    	return $mreturn1;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */