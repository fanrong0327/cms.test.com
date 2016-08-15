<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Common Class
 *
 * @Copyright
 * @author
 */
class Common {
	
	static private $debugInfo = array(
			'title'=>array('type', 'count', 'time'),
			'mc'=>array('mc', 'count'=>0, 'time'=>0),
			'db'=>array('db', 'count'=>0, 'time'=>0),
			'request'=>array('request', 'count'=>0, 'time'=>0),
	);
	
	/**
	 * 获取调试信息
	 */
	static public function getDebugInfo() {
		return self::$debugInfo;
	}
	
	/**
	 * 转码函数
	 * @param Mixed $data 需要转码的数组
	 * @param String $dstEncoding 输出编码
	 * @param String $srcEncoding 传入编码
	 * @param bool $toArray 是否将stdObject转为数组输出
	 * @return Mixed
	 */
	static public function convertEncoding($data, $dstEncoding, $srcEncoding, $toArray=false) 
	{
		if ($toArray && is_object($data)) 
		{
			$data = (array)$data;
		}
		
		if (!is_array($data) && !is_object($data)) 
		{
			$data = mb_convert_encoding($data, $dstEncoding, $srcEncoding);
		} 
		else 
		{
			if (is_array($data)) 
			{
				foreach($data as $key=>$value) 
				{
					if (is_numeric($value)) 
					{
						continue;
					}
					
					$keyDstEncoding = self::convertEncoding($key, $dstEncoding, $srcEncoding, $toArray);
					$valueDstEncoding = self::convertEncoding($value, $dstEncoding, $srcEncoding, $toArray);
					unset($data[$key]);
					$data[$keyDstEncoding] = $valueDstEncoding;
				}
			} 
			else if(is_object($data)) 
			{
				$dataVars = get_object_vars($data);
				foreach($dataVars as $key=>$value) 
				{
					if (is_numeric($value)) 
					{
						continue;
					}
					
					$keyDstEncoding = self::convertEncoding($key, $dstEncoding, $srcEncoding, $toArray);
					$valueDstEncoding = self::convertEncoding($value, $dstEncoding, $srcEncoding, $toArray);
					unset($data->$key);
					$data->$keyDstEncoding = $valueDstEncoding;
				}
			}
		}
		
		return $data;
	}
	
	/**
	 * 调试信息打印
	 * @param mixed $value 需要打印的调试信息
	 * @param string $type 需要打印的调试信息的类型，默认为：DEBUG
	 * @param string $encoding 指定传入编码
	 * @return void
	 */
	static public function debug($value, $type = 'DEBUG', $encoding = 'UTF-8') 
	{
		if (defined('FIREPHP_DEBUG') && FIREPHP_DEBUG) 
		{
			if (strtoupper($encoding) != 'UTF-8') 
			{
				$value = self::convertEncoding($value, 'utf-8', $encoding);
				$type = self::convertEncoding($type, 'utf-8', $encoding);
			}
			
// 			// mc 信息统计
// 			if (strpos($type, 'mc_') === 0) 
// 			{ 
// 				$type === 'mc_connect' || self::$debugInfo['mc']['count']++;
			
// 			} 
// 			// db 信息统计
// 			else if (strpos($type, 'db_') === 0) 
// 			{
// 				in_array($type, array('db_sql','db_sql_master'), true) && self::$debugInfo['db']['count']++;
// 				$type === 'db_sql_result' && self::$debugInfo['db']['time'] += $value[1][0];
// 			} 
			// request 信息统计
			else if (strpos($type, 'request_') === 0) 
			{
				in_array($type, array('request_url'), true) && self::$debugInfo['request']['count']++;
				$type === 'request_return' && self::$debugInfo['request']['time'] += $value[1][0];
			}
			
			//调试时正则匹配需要输出的内容
			$debugTypeFilter = isset($_GET[DEBUG_ARG_NAME]) ? $_GET[DEBUG_ARG_NAME] : '';
			$debugArgs = array_filter(explode(';', $debugTypeFilter));
			if (empty($debugArgs)) 
			{
				$output = true;
			} 
			else 
			{
				foreach ($debugArgs as $arg) 
				{
					$output = ($arg{0} === '!') && $arg = ltrim($arg, '!');
					if (preg_match("/^{$arg}/", $type)) 
					{
						$output = !$output;
						break;
					}
				}
			}
			
			if ($output) 
			{
				if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'FirePHP') !== false) 
				{
					if ($type === 'db_sql_master') 
					{
						FirePHP::getInstance(true)->warn($value, 'db_sql');
					} 
					elseif (in_array($type, array('db_sql_result','request_return', 'all_info', 'dagger_error_trace'), true)) 
					{
						FirePHP::getInstance(true)->table($type, $value);
					} 
					elseif (substr($type, -5) === 'trace') 
					{
						FirePHP::getInstance(true)->trace($value);
					} 
					elseif (substr($type, -5) === 'error') 
					{
						FirePHP::getInstance(true)->error($value);
					} 
					elseif (substr($type, -4) === 'info') 
					{
						FirePHP::getInstance(true)->info($value);
					} 
					elseif (substr($type, -4) === 'warn') {
						FirePHP::getInstance(true)->warn($value);
					} 
					else 
					{
						FirePHP::getInstance(true)->log($value, $type);
					}
				} else {
					// 预留debug信息输出
				}
			}
		}
	}
	
	/*
	 * ------------------------------------------------------------
	* @function        getDbConnect             获取数据库连接操作
	* @param           $group_name        master:主数据库，
	*                                     slave:从数据库，读操作
	*                                     $params:数据库连接值，用数组或DSN字符串传递。
	*
	*                  $db_object         是否返回DB对象
	*                  $params            补充参数数组
	* ------------------------------------------------------------
	* @做成    付晓君    2013-03-29    1.0
	* @修改    范容      2013-04-11
	* ------------------------------------------------------------
	*/
	
	static public function getDbConnect($group_name, $db_object = FALSE, $params = array()) {
		$CI = & get_instance();
		$group_name = strtoupper($group_name);
	
		do {
			if(empty($params))
			{
				continue;
			}
			 
			if ( ! file_exists($file_path = APPPATH.'config/database.php'))
			{
				show_error('The configuration file database.php does not exist.');
			}
			 
			include($file_path);

			$group_name = isset($db[$group_name]) ? $db[$group_name] : array();
			$group_name = array_merge($group_name, $params);
		} while (0);

		if ($db_object == TRUE)
		{
			return $CI->load->database($group_name, TRUE);
		} else
		{
			$CI->load->database($group_name);
		}
	}
        
    static public function writeLog($rel_file = '/', $arr = array()) {
       
          $rel_path = LOG_PATH . dirname($rel_file);
          if (!is_dir($rel_path))
          {
              mkdir($rel_path, 0755, TRUE);
          }
          //文件夹创建失败则直接写入根目录下的fail_create_path.log文件
          $abs_path = is_dir($rel_path) ? LOG_PATH . $rel_file : LOG_PATH . "edit.log";
          //合成需要记录的log信息
          $log_info = (is_array($arr) ? implode("\t", $arr) : $arr) . "\n";
          //log信息写入文件
          return error_log($log_info, 3, $abs_path);
  }
    
}
// END Common Class

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */