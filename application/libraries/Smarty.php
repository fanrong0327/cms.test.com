<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Smarty Class
 *
 * @Copyright
 * @author
 */
require('smarty/Smarty.class.php');
class MY_Smarty extends Smarty{
	
	function __construct() 
	{
		parent::__construct();
		$this->template_dir         =  APPPATH."views"; //模板存放目录
		$this->compile_dir          = APPPATH."templates_c"; //编译目录，在application下需要新建此目录
		$this->cache_dir            = APPPATH."cache"; //缓存目录。
		$this->caching              = 0;
		//$this->cache_lifetime       = 120; //缓存更新时间
		$this->debugging            = FALSE;
		$this->compile_check        = TRUE; //检查当前的模板是否自上次编译后被更改，如果被更改了，它将重新编译该模板。
		//$this->force_compile        = TRUE; //强制重新编译模板
		$this->left_delimiter       = "{="; //左定界符
		$this->right_delimiter      = "=}"; //右定界符
		$this->escape_html     = TRUE; //必须开启自动转义html标签，防止xss，不转义使用{=$data nofilter=}
	}
}
// END Smarty Class

/* End of file Smarty.php */
/* Location: ./application/libraries/Smarty.php */