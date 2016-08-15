<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Memcache Class
 *
 * @Copyright		www.kanshuwnag.com
 * @author			fanrong
 * @time            2013/04/18
 * @version         1.0
 */

class MY_Memcache {

    /**
     * 主动刷新时间key后缀
     * @var string
     */
    const CACHE_TIME_CTL = '_@t';

    /**
     * 锁key后缀
     * @var string
     */
    const CACHE_LOCK_CTL = '_@l';

    
    /**
     * MC连接池
     * @var array
     */
    static private $memcache = array();

    /**
     * 当前MC链接
     * @var resource
     */
    private $mc;
    
    /**
     * 当前MC键值前缀
     * @var str
     */
    private $mc_key_prefix;
    
    /**
     * 当前MC集群
     * @var string
     */
    private $servers;

    /**
     * 构造函数
     * @params string $mcName MC名称
     * @params array $mcConfig eg:array('servers'=>'192.168.1.1:7600 192.168.1.2:7700');
     */
    public function __construct($config = array()) 
    {
    	$mcName = isset($config['mcName']) ? $config['mcName'] : ''; 
    	$servers = isset($config['servers']) ? $config['servers'] : ''; 
    	$mc_key_prefix = isset($config['mc_key_prefix']) ? $config['mc_key_prefix'] : ''; 
    			
        empty($mcName) && $mcName = MC_DEFAULT;
        $this->mc_key_prefix = empty($mc_key_prefix) ? MC_KEY_PREFIX : $mc_key_prefix;
        $this->servers = empty($servers) ? constant(strtoupper("MC_{$mcName}_SERVERS")) : $servers;
        $mcKey = md5($this->servers);
        if (isset(self::$memcache[$mcKey]) && self::$memcache[$mcKey] instanceof Memcache) 
        {
            $this->mc = self::$memcache[$mcKey];
        } 
        else 
        {
            self::$memcache[$mcKey] = new Memcache();
            $serverArr = explode (' ', $this->servers);
            foreach ($serverArr as $v) 
            {
                list($server, $port) = explode(':', $v);
                self::$memcache[$mcKey]->addServer($server, $port, FALSE);
            }
            $this->mc = self::$memcache[$mcKey];
            defined('FIREPHP_DEBUG') && Common::debug($this->servers, 'mc_connect');
        }
        $this->checkConnection();
    }
    
    /**
     * 设置缓存
     * @param string $key 缓存键
     * @param mixed $value 缓存值
     * @param int $time 缓存时间
     * @param bool $compress 是否启用压缩
     * @retrun bool
     */
    public function set($key, $value, $time = 0, $compress = MEMCACHE_COMPRESSED) 
    {
        $key = $this->mc_key_prefix . $key;
        defined('FIREPHP_DEBUG') && Common::debug($value, "mc_set({$key}),ttl({$time})");
        $this->mc->set($key.self::CACHE_TIME_CTL, 1, 0, $time);
        $ret = $this->mc->set($key, $value, $compress, $time + 86400);
        $this->releaseLock($key);
        return $ret;
    }

    /**
     * 设置缓存，不防雪崩
     * @param string $key 缓存键
     * @param mixed $value 缓存值
     * @param int $time 缓存时间
     * @param bool $compress 是否启用压缩
     */
    public function setPlain($key, $value, $time = 0, $compress = MEMCACHE_COMPRESSED) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        defined('FIREPHP_DEBUG') && Common::debug($value, "mc_set_plain({$key}),ttl({$time})");
        $ret = $this->mc->set($key, $value, $compress, $time);
        return $ret;
    }

    /**
     * 增加缓存
     * @param string $key 缓存键
     * @param mixed $value 缓存值
     * @param int $time 缓存时间
     * @param bool $compress 是否启用压缩
     * @retrun bool
     */
    public function add($key, $value, $time = 0, $compress = MEMCACHE_COMPRESSED) 
    {
        $key = $this->mc_key_prefix . $key;
        defined('FIREPHP_DEBUG') && Common::debug($value, "mc_add({$key}),ttl({$time})");
        if (!$this->mc->add($key.self::CACHE_TIME_CTL, 1, $compress, $time)) 
        {
            return false;
        }
        $ret = $this->mc->set($key, $value, $compress, $time + 86400);
        return $ret;
    }

    /**
     * 增加缓存
     * @param string $key 缓存键
     * @param mixed $value 缓存值
     * @param int $time 缓存时间
     * @param bool $compress 是否启用压缩
     * @retrun bool
     */
    public function addPlain($key, $value, $time = 0, $compress = MEMCACHE_COMPRESSED) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        defined('FIREPHP_DEBUG') && Common::debug($value, "mc_add_plain({$key}),ttl({$time})");
        return $this->mc->add($key, $value, $compress, $time);
    }

    /**
     * 自增
     * @param string $key 缓存键
     * @param int $incre 自增值
     * @return float
     */
    public function increment($key, $incre=1) 
    {
        $key = $this->mc_key_prefix . $key;
        if(!$this->mc->increment($key.self::CACHE_TIME_CTL, 1)) 
        {
            return false;
        }
        $ret = $this->mc->increment($key, $incre);
        defined('FIREPHP_DEBUG') && Common::debug($ret, "mc_increment({$key})");
        return $ret;
    }

    /**
     * 自增
     * @param string $key 缓存键
     * @param int $incre 自增值
     * @return float
     */
    public function incrementPlain($key, $incre=1) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        $ret = $this->mc->increment($key, $incre);
        defined('FIREPHP_DEBUG') && Common::debug($ret, "mc_increment_plain({$key})");
        return $ret;
    }

    /**
     * 自减
     * @param string $key 缓存键
     * @param int $incre 自减值
     * @return float
     */
    public function decrement($key, $incre=1) 
    {
        $key = $this->mc_key_prefix . $key;
        if(!$this->mc->decrement($key.self::CACHE_TIME_CTL, 1)) 
        {
            return false;
        }
        $ret = $this->mc->decrement($key, $incre);
        defined('FIREPHP_DEBUG') && Common::debug($ret, "mc_decrement({$key})");
        return $ret;
    }

    /**
     * 自减
     * @param string $key 缓存键
     * @param int $incre 自减值
     * @return float
     */
    public function decrementPlain($key, $incre=1) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        $ret = $this->mc->decrement($key, $incre);
        defined('FIREPHP_DEBUG') && Common::debug($ret, "mc_decrement_plain({$key})");
        return $ret;
    }

    /**
     * 获取缓存
     * @param string $key 缓存键
     * @param int $lockTime  缓存锁失效时间
     * @return mixed
     */
    public function get($key, $lockTime=3) 
    {
        if(!$this->checkConnection()) 
        {
            return false;
        }
        $key = $this->mc_key_prefix . $key;
        $outdated = $this->mc->get($key.self::CACHE_TIME_CTL);
        $data = $this->mc->get($key);
        if($data === false || $outdated === false)
        {
            if($this->getLock($key, $lockTime)) 
            {
                defined('FIREPHP_DEBUG') && Common::debug(false, "mc_get_not_lock({$key})");
                return false;
            }
            $attempt = 0;
            do {
                $dataNew = $this->mc->get($key);
                if(++$attempt >= 4) 
                {
                    break;
                }
                if($dataNew === false) 
                {
                    usleep(100000);
                } 
                else 
                {
                    return $dataNew;
                }
            } while($data === false);
        }
        defined('FIREPHP_DEBUG') && Common::debug($data, "mc_get({$key})");
        return $data;
    }
    
    /**
     *    获取缓存
     * @param string $key 缓存键
     * @param int $lockTime  缓存锁失效时间
     * @return mixed
     */
    public function getPlain($key) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        $data = $this->mc->get($key);
        defined('FIREPHP_DEBUG') && Common::debug($data, "mc_get_plain({$key})");
        return $data;
    }

    /**
     * 删除缓存
     * @param string $key 缓存键
     * @return bool 
     */
    public function delete($key) 
    {
        $key = $this->mc_key_prefix . $key;
        defined('FIREPHP_DEBUG') && Common::debug($key.self::CACHE_TIME_CTL, 'mc_delete');
        if ($this->mc->delete($key.self::CACHE_TIME_CTL)) 
        {
            return $this->mc->delete($key);
        } 
        else 
        {
            return false;
        }
    }

    public function deletePlain($key) 
    {
        $key = $this->mc_key_prefix . '_PLAIN_' . $key;
        $ret = $this->mc->delete($key);
        defined('FIREPHP_DEBUG') && Common::debug($ret, "mc_delete_plain({$key})");
        return $ret;
    }

    /**
     * 删除全部集群缓存
     * @param string $key 缓存键
     * @return bool
     */
    public static function deleteAll($key) 
    {
        $key = $this->mc_key_prefix . $key;
        defined('FIREPHP_DEBUG') && Common::debug($key, 'mc_delete_all');
        $searchMcArr = explode(' ', SEARCH_MC_ARR);
        foreach($searchMcArr as $searchMc) {
            $mc = new Memcache($searchMc);
            $mc->delete($key);
        }
    }

    /**
     * 对资源加锁
     * @param string $key 缓存锁键
     * @param int $lockTime 缓存锁失效时间
     */
    public function getLock($key, $lockTime=3) 
    {
        defined('FIREPHP_DEBUG') && Common::debug($lockTime, 'mc_lock_time');
        return $this->mc->add($key.self::CACHE_LOCK_CTL, 1, false, $lockTime);
    }

    /**
     * 释放资源锁
     * @param string $key 缓存锁键
     */
    public function releaseLock($key) 
    {
        $this->mc->delete($key.self::CACHE_LOCK_CTL);
    }

    /**
     * 检测memcache是否正常运行
     */
    private function checkConnection() 
    {
        if($this->mc->getVersion() !== false)
        {
            return true;
        }
        defined('FIREPHP_DEBUG') && Common::debug("memcache服务器: {$this->servers} 无法响应", 'error');
        //BaseModelLog::sendLog(90500, "memcache服务器: {$this->servers} 无法响应", BaseModelException::getCodeName(90500), BaseModelLog::ERROR_MODEL_ID_MC);
        return false;
    }
}
// END Memcache Class

/* End of file Memcache.php */
/* Location: ./application/libraries/Memcache.php */