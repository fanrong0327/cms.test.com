<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ctest extends MY_Controller
{

    public function __construct()
    {
	parent::__construct();
    }


    public function index()
    {
		$this->act_verify = 'CONTENT_CTEST';
        $this->checkCurrentAction();
		if(isset($_POST['submit'])){
            echo "test over.";
		    exit;
		}

        $siteinfo = array();
        $data = array(
                'title'=>'发布系统',
                'subtitle'=>'内容测试',
                'content'=>$siteinfo,
            );

        $this->smarty->assign('data',$data);
        $main = $this->smarty->fetch('cms/ctest/index.html');

        $this->smarty->assign('content',$main);
        $this->smarty->display('cms/content.html');
	
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */