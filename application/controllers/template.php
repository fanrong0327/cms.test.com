<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * 模板管理
 */
class Template extends MY_Controller
{

    public function __construct()
    {
	parent::__construct();
	$this->load->model('modelsite');
	$this->load->model('modeltemplate');
	$this->loginCheck();
    }

    public function index()
    {
	
	if(isset($_GET['siteid'])){
	    $siteid = intval($_GET['siteid']);
	}
	else{
	    $siteid = 0;
	}
          switch ($siteid) {
            case 1:
                $this->act_verify = 'SITE_MANAGE_WWW';
                break;

            case 2:
                $this->act_verify = 'SITE_MANAGE_WAP';
                break;
            case 3:
              	$this->act_verify = 'SITE_MANAGE_JINGWEI';
               	break;
                
                
            default:
                die('无此站点');
                break;
        }
        $this->checkCurrentAction();
        
        
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
	$query_array = $this->modeltemplate->getTemplate($siteinfo['id']);
	
	//$this->act_verify = 'ACTION_LIST';
        //$this->checkCurrentAction();
        $data = array(
            'title'=>'模板管理',
            'subtitle'=>'模板列表',
	    'siteid' =>$siteinfo['id'],
        );
	$data['lists'] = $query_array;
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/template/index.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }
    public function add()
    {
	$this->act_verify = 'TEMPLATE_ADD';
        $this->checkCurrentAction();
	if(isset($_POST['submit'])){
	    $siteid = intval($_POST['siteid']);
	    $this->modeltemplate->insertData($_POST);
	    header('Location: /template?siteid='.$siteid);
	    exit;
	    
	}
	if(isset($_GET['siteid'])){
	    $siteid = intval($_GET['siteid']);
	}
	else{
	    $siteid = 0;
	}
	$tplinfo = array('id'=>0,'name'=>'','sortid'=>'');
	$data = array(
            'title'=>'站点管理',
            'subtitle'=>'修改模板',
	    'siteid'=>$siteid,
	    'content'=>$tplinfo,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/template/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }
    
    
    public function edit()
    {
	$this->act_verify = 'TEMPLATE_EDIT';
        $this->checkCurrentAction();
	if(isset($_POST['submit'])){
	    $siteid = intval($_POST['siteid']);
	    $this->modeltemplate->updateData($_POST);
	    header('Location: /template?siteid='.$siteid);
	    exit;
	}
	if(isset($_GET['siteid'])){
	    $siteid = intval($_GET['siteid']);
	}
	else{
	    $siteid = 0;
	}
	if(isset($_GET['id'])){
	    $id = intval($_GET['id']);
	}
	else{
	    $id = 0;
	}
	
	$tplinfo = $this->modeltemplate->getData($siteid,$id);
	if($tplinfo['id'] ==0){
	    header('Location: /template?siteid='.$siteid);
	    exit;
	}

	$data = array(
            'title'=>'站点管理',
            'subtitle'=>'修改模板',
	    'siteid'=>$siteid,
	    'content'=>$tplinfo,
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/template/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
	
	
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */