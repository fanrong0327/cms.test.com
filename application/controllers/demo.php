<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/index.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }

    function form()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/form.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function table()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/table.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function tab()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/tab.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function gallery()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/gallery.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function notice()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/notice.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }

    function chart()
    {
        $data = array();
        $this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/demo/chart.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');
    }
}
