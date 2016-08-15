<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Input Class
 * 
 * @Copyright
 * @author fanrong@
 * @createtime     2013/03/30
 */
class MY_Input extends CI_Input {
	
	/**
	 * Constructor
	 *
	 * Sets whether to globally enable the XSS processing
	 * and whether to allow the $_GET array
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('debug', "Input Class Initialized");

		$this->_allow_get_array	= (config_item('allow_get_array') === TRUE);
		$this->_enable_xss		= (config_item('global_xss_filtering') === TRUE);
		$this->_enable_csrf		= (config_item('csrf_protection') === TRUE);
		
		//重新设置是否检测CSRF add by fanrong
		$this->resetEnableCsrf();

		global $SEC;
		$this->security =& $SEC;

		// Do we need the UTF-8 class?
		if (UTF8_ENABLED === TRUE)
		{
			global $UNI;
			$this->uni =& $UNI;
		}

		// Sanitize global arrays
		$this->_sanitize_globals();
	}
	
	/**
	 * reset enable csrf
	 */
	function resetEnableCsrf()
	{
		do {
			//关闭特殊请求URL的CSRF验证 add by fanrong
			$accept_url = (config_item('accept_url') !== FALSE) ? config_item('accept_url') : array();
			if (!empty($accept_url)) {
				$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "";
				$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
				$pos = stripos($request_uri, "?");
				$request_action = ($pos !== FALSE) ? substr($request_uri, 0, $pos) : $request_uri;
				
				foreach ($accept_url as $item) 
				{
					//如果当前请求的域名中含有字符串{$item}，则关闭CSRF验证
					if (stripos($server_name, $item) !== FALSE)
					{
						$this->_enable_csrf = FALSE;
						break 2;
					}
						
					//如果当前请求的URI中含有字符串{$item}，则关闭CSRF验证
					if (stripos($request_action, $item) !== FALSE)
					{
						$this->_enable_csrf = FALSE;
						break 2;
					}
				}
			}
			
			//关闭可信域名的CSRF验证 add by fanrong
			if (isset($_SERVER['HTTP_REFERER'])) 
			{
				$reffer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
				$accept_referer = (config_item('accept_referer') !== FALSE) ? config_item('accept_referer') : array();
				foreach (config_item('accept_referer') as $item)
				{
					if (strpos($reffer, $item) !== FALSE)
					{
						$this->_enable_csrf = FALSE;
						break 2;
					}
				}
			}
		} while (0);
	}
}
// END MY_Input Class

/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */