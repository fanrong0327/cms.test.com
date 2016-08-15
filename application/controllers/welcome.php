<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
    function index()
    {
	$this->smarty->display('cms/login.html');
    }

}
