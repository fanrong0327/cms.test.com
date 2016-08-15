<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| FirePHP Print Modes
|--------------------------------------------------------------------------
|
| FirePHP调试时需要输出的内容控制参数
|
*/
define('DEBUG_ARG_NAME', 'debug');
if(in_array($_SERVER['SERVER_ADDR'], array("127.0.0.1","192.168.112.135"))) 
{
	define('FIREPHP_DEBUG', '1');
} 
else 
{
	define('FIREPHP_DEBUG', '0');
}

/*
 |--------------------------------------------------------------------------
| memcache Modes
|--------------------------------------------------------------------------
|
| 默认memcache组控制参数
|
*/
define('MC_DEFAULT', 'default');
define('MC_DEFAULT_SERVERS', $_SERVER['KSSRV_MC_SERVERS']);
define('MC_KEY_PREFIX', 'cmyd-cms-');
//log 地址
define("LOG_PATH", "/data/cmslog/");
/* End of file constants.php */
/* Location: ./application/config/constants.php */