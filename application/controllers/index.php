<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    public function __construct()
    {
		parent::__construct();
    }
    public function index()
    {
        $this->act_verify = 'ADMIN_INDEX';
        $this->checkCurrentAction();
	//$main = $this->smarty->fetch('cms/index_main.html');

	//$this->smarty->assign('content',$main);
	$this->smarty->display('cms/index.html');
    }
    public function top()
    {
	$this->smarty->display('cms/top.html');
    }
    public function left()
    {
	$this->smarty->display('cms/left.html');
    }
    public function right()
    {
	$main = $this->smarty->fetch('cms/index_main.html');
	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }
}
