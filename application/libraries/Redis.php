<?php
class MY_Redis {
	private $redis = null;
	function __construct() {
		$this->connect ();
	}
	public function connect() {
		$this->redis = new Redis ();
		$serverArr = explode(' ',$_SERVER['KSSRV_RS_SERVERS']) ;
		//print_r($serverArr) ;exit;
		$server = explode(':',$serverArr[0]);
		//print_r($server) ;
		$this->redis->connect ( $server[0], $server[1] );
	}
	
	/**
	 * 设置值
	 *
	 * @param $key KEY名称        	
	 * @param $value 获取得到的数据        	
	 * @param $timeOut 时间        	
	 */
	public function set($key, $value, $timeOut = 0) {
		$value = @serialize ( $value );
		$retRes = $this->redis->set ( $key, $value );
		if ($timeOut > 0)
			$this->redis->setTimeout ( $key, $timeOut );
		
		return $retRes;
	}
	
	/**
	 * 通过KEY获取数据
	 *
	 * @param $key KEY名称        	
	 */
	public function get($key) {
		$retRes = $this->redis->get ( $key );
		$result = unserialize ( $retRes );
		
		return $result;
	}
	
	/**
	 * 删除一条数据
	 *
	 * @param $key KEY名称        	
	 */
	public function delete($key) {
		$this->redis->delete ( $key );
		
		return true;
	}
	
	/**
	 * 清空数据
	 */
	public function flushAll() {
		$this->redis->select ( self::$currentdb );
		$result = $this->redis->flushAll ();
		
		return $result;
	}
	
	/**
	 * 数据入队列
	 *
	 * @param $key KEY名称        	
	 * @param $value 获取得到的数据        	
	 * @param $right 是否从右边开始入        	
	 */
	public function push($key, $value, $right = true) {
		$value = @serialize ( $value );
		
		$result = $right ? $this->redis->rPush ( $key, $value ) : $this->redis->lPush ( $key, $value );
		
		return $result;
	}
	
	/**
	 * 数据出队列
	 *
	 * @param $key KEY名称        	
	 * @param $left 是否从左边开始出数据        	
	 */
	public function pop($key, $left = true) {
		$val = $left ? $this->redis->lPop ( $key ) : $this->redis->rPop ( $key );
		
		return unserialize ( $val );
	}
	public function __destruct() {
		$this->redis->close ();
		unset ( $this->redis );
	}
	
	/**
	 * 数据自增
	 *
	 * @param $key KEY名称        	
	 */
	public function increment($key) {
		$result = $this->redis->incr ( $key );
		return $result;
	}
	
	/**
	 * 数据自减
	 *
	 * @param $key KEY名称        	
	 */
	public function decrement($key) {
		$result = $this->redis->decr ( $key );
		
		return $result;
	}
	
	/**
	 * key是否存在，存在返回ture
	 *
	 * @param $key KEY名称        	
	 */
	public function exists($key) {
		$result = $this->redis->exists ( $key );
		
		return $result;
	}
}
?>