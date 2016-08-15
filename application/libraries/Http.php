<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Http Class
 *
 * @Copyright
 * @author
 */
class Http extends CI_Controller {

    const HTTP_TIMEOUT       = 3; // curl超时设置，单位是秒。基类方法可自定义重试次数，故而如果接口超时，最大重试次数倍此设置时间。
    const HTTP_MAXREDIRECT   = 2; // 301、302、303、307最大跳转次数。
    const HTTP_REDO          = 0; // 访问失败后的重试次数, 默认0次为不重试。

    protected $http_useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0';
    
    public function __construct()
    {
//     	$ci =& get_instance();
//     	$ci->load->library("common");
    }

    /**
     * 发送post请求获取结果
     * @param $args['req'] mix 发送请求url，必传参数 **
     * @param $args['post'] mix 发送请求post数据
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host: 127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @return mix 失败返回false，成功返回array(抓取结果已解析成数组)
     */
    public function post($req, $post, array $header = array(), $timeout = self::HTTP_TIMEOUT, $cookie = '', $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['req'] = $req;
        $args['post'] = $post;
        $args['header'] = $header;
        $args['timeout'] = $timeout;
        $args['cookie'] = $cookie;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        return self::_http_exec($args);
    }

    /**
     * 发送get请求获取结果
     * @param $args['req'] mix 发送请求url，必传参数 **
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host: 127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @param $args['headOnly'] bool 发送请求是否只抓取header头
     * @return mix 失败返回false，成功返回抓取结果
     */
    public function get($req, array $header = array(), $timeout = self::HTTP_TIMEOUT, $cookie = '', $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['req'] = $req;
        $args['header'] = $header;
        $args['timeout'] = $timeout;
        $args['cookie'] = $cookie;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        return self::_http_exec($args);
    }

    /**
     * 发送请求获取header头信息，兼容久函数，不推荐使用
     * @param $args['req'] mix 发送请求url，必传参数 **
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @return mix 失败返回false，成功返回array(抓取结果已解析成数组)
     */
    public function head($req, $timeout = self::HTTP_TIMEOUT, $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['req'] = $req;
        $args['timeout'] = $timeout;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        $args['headOnly'] = true;
        return self::_http_exec($args);
    }

    /**
     * 发送请求获取header头信息，推荐使用
     * @param $args['req'] mix 发送请求url，必传参数 **
     * @param $args['post'] mix 发送请求post数据
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host: 127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @param $args['headOnly'] bool 发送请求是否只抓取header头
     * @return mix 失败返回false，成功返回array(抓取结果已解析成数组)
     */
    public function header($req, $post = array(), array $header = array(), $timeout = self::HTTP_TIMEOUT, $cookie = '', $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['req'] = $req;
        $args['post'] = $post;
        $args['header'] = $header;
        $args['timeout'] = $timeout;
        $args['cookie'] = $cookie;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        $args['headOnly'] = true;
        return self::_http_exec($args);
    }

    /**
     * 发送get/post请求获取结果
     * by xuyan4
     * @param $args['urls'] array 发送请求urls，必传参数 **
     * @param $args['post'] array 发送请求post数据,无post数据可传array(),为get请求
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host' => '127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['redo'] int 发送请求最大重试次数
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @return mix 失败返回false，成功返回array(抓取结果已解析成数组)
     */
    public function multiRequest(array $urls, $post = array(), array $header = array(), $timeout = self::HTTP_TIMEOUT, $cookie = '', $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['urls'] = $urls;
        $args['post'] = $post;
        $args['header'] = $header;
        $args['timeout'] = $timeout;
        $args['cookie'] = $cookie;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        return self::_multi_http_exec($args);
    }

    /**
     * 发送get/post请求获取header头
     * by xuyan4
     * @param $args['urls'] array 发送请求urls，必传参数 **
     * @param $args['post'] array 发送请求post数据,无post数据可传array(),为get请求
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host' => '127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['redo'] int 发送请求最大重试次数
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @return mix 失败返回false，成功返回array(抓取结果已解析成数组)
     */
    public function multiHeader($urls, $post = array(), array $header = array(), $timeout = self::HTTP_TIMEOUT, $cookie = '', $redo = self::HTTP_REDO, $maxredirect = self::HTTP_MAXREDIRECT) 
    {
        $args['urls'] = $urls;
        $args['post'] = $post;
        $args['header'] = $header;
        $args['timeout'] = $timeout;
        $args['cookie'] = $cookie;
        $args['redo'] = $redo;
        $args['maxredirect'] = $maxredirect;
        $args['headOnly'] = true;
        return self::_multi_http_exec($args);
    }

    /**
     * 设置User-Agent头信息
     * by xuyan4
     * @param $userAgent string 发送请求url的User-Agent头,default = ''
     * @return void
     */
    public function setUserAgent($userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0') 
    {
        $this->http_useragent = $userAgent;
    }

    /**
     * 发送GET请求不等待接收（兼容旧项目）
     * by wangxin3
     * @param $req string 发送请求url
     * @return void
     */
    public function sendRequest($req, $host = '') 
    {
        $header = array();
        if(!empty($host)) {
            $header['Host'] = $host;
        }
        self::sendPostRequest($req, array(), $header);
    }
    
    /**
     * 发送请求不等待接收（支持post）
     * by xuyan4
     * @param $req string 发送请求url
     * @param $post string or array 发送post数据
     * @param $header array 发送header头, array('Host' => '127.0.0.1', 'Referer' => 'http://127.0.0.1')
     * @return boolen
     */
    public function sendPostRequest($req, $post = array(), $header = array()) 
    {
        $url = self::_makeUri($req);
        $urlArr = parse_url($url);
        if(empty($urlArr['host'])) {
            return self::_error(90402, 'url参数错误');
        }
        $port = isset($urlArr['port']) ? $urlArr['port'] : ($urlArr['scheme'] === 'https' ? 443 : 80);
        $fp = @fsockopen($urlArr['host'], $port, $errno, $error, 1); 
        if ($fp) {
            $out = array();
            empty($urlArr['path']) && $urlArr['path'] = '';
            $urlArr['query'] = empty($urlArr['query']) ? '' : '?' . $urlArr['query'];
            stream_set_timeout($fp, 1);
            $out[] = (empty($post) ? 'GET' : 'POST') . " {$urlArr['path']}{$urlArr['query']} HTTP/1.1";
            $out['host'] = "Host: {$urlArr['host']}";
            $out['user-agent'] = "User-Agent: " . $this->http_useragent;
            if (!empty($header) && is_array($header)) {
                foreach($header as $k => $v) {
                    $out[strtolower($k)] = is_numeric($k) ? $v : "$k: $v";
                }
            }
            if(!empty($post) && is_array($post)) {
                $post = http_build_query($post);
            }
            empty($post) || $out[] = 'Content-Length: ' . strlen($post);
            $out = implode("\r\n", $out) . "\r\nConnection: Close\r\n\r\n" . (empty($post) ? '' : $post . "\r\n");
            fwrite($fp, $out);
            fclose ($fp);
            return true;
        } else {
            defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug('[errno] ' . $errno . ' [error] ' . $error, 'request_send_error');
            return false;
        }
    }

    /**
     * 发送请求获取结果
     * @param $args['req'] mix 发送请求url，必传参数 **
     * @param $args['post'] mix 发送请求post数据
     * @param $args['header'] array 发送请求自定义header头，$args['header'] = array('Host: 127.0.0.1')
     * @param $args['timeout'] int 发送请求超时设定
     * @param $args['cookie'] string 发送请求cookie
     * @param $args['maxredirect'] int 发送请求最大跳转次数
     * @param $args['headOnly'] bool 发送请求是否只抓取header头
     * @return mix 失败返回false，成功返回抓取结果
     */
    private function _http_exec($args) 
    {

        if (!function_exists('curl_init')) {
            return self::_error(90400, '服务器没有安装curl扩展！');
        }

        // $args['req'] = isset($args['req']) ? $args['req'] : array(); // 必传
        $args['post'] = isset($args['post']) ? $args['post'] : array();
        $args['header'] = isset($args['header']) ? $args['header'] : array();
        $args['timeout'] = isset($args['timeout']) ? intval($args['timeout']) : self::HTTP_TIMEOUT;
        $args['cookie'] = isset($args['cookie']) ? $args['cookie'] : '';
        $args['redo'] = isset($args['redo']) ? $args['redo'] : self::HTTP_REDO;
        $args['maxredirect'] = isset($args['maxredirect']) ? intval($args['maxredirect']) : null;
        $args['headOnly'] = isset($args['headOnly']) ? $args['headOnly'] : false;

        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && $startRunTime = microtime(true);
        $url = self::_makeUri($args['req']);
        if (empty($url)) {
            return self::_error(90401, '页面抓取请求url缺失');
        }

        $args['header'][] = 'Expect:'; // 解决100问题
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $args['header']);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->http_useragent);
        curl_setopt($ch, CURLOPT_TIMEOUT, $args['timeout']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, true);

        if ($args['headOnly']) {
            curl_setopt($ch, CURLOPT_NOBODY, true);
        }

        if (!empty($args['post'])) {
            if (is_array($args['post'])) {
                $args['post'] = http_build_query($args['post']);
            }
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args['post']);
        }

        if (!empty($args['cookie'])) {
            curl_setopt($ch, CURLOPT_COOKIE, $args['cookie']);
        }

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        $redirect = false;

        $newurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $header = $ret = false;
        do {
            do {
                curl_setopt($ch, CURLOPT_URL, $newurl);
                $ret = curl_exec($ch);
                $curl_errno = curl_errno($ch);
                if ($curl_errno) {
                    $curl_error = curl_error($ch);
                    defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug("[errno] {$curl_errno} [error] {$curl_error}", 'request_curl_error');
                    // [7]  Failed to connect() to host or proxy.
                    // [28] Operation timeout. The specified time-out period was reached according to the conditions.
                    // [52] Nothing was returned from the server, and under the circumstances, getting nothing is considered an error. 
                    $curl_errno === 28 || self::_error(90404, "curl内部错误信息[{$curl_errno}][{$url}]");
                    break;
                } else {
                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if (in_array($code, array(301, 302, 303, 307), true)) {
                        preg_match('/Location:(.*?)\n/i', $ret, $matches);
                        $newurl = trim(array_pop($matches));
                        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($newurl, 'request_redirectUrl');
                        $redirect = true;
                    } else {
                        list($header, $ret) = explode("\r\n\r\n", $ret, 2);
                        break 2;
                    }
                }
            } while ($redirect && --$args['maxredirect']);
            defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($args['redo'], 'request_redo');
        } while ($args['redo']-- > 0);
        curl_close($ch);

        // 抓取header时，解析header头
        if ($args['headOnly'] && $header !== false) {
            $_headers = str_replace("\r", '', $header);
            $_headers = explode("\n", $_headers);
            $ret = array();
            foreach ($_headers as $value) {
                $_header = explode(': ', $value);
                if (!empty($_header[0])) {
                    if (empty($_header[1])) {
                        $ret['status'] = $_header[0];
                    } else {
                        $ret[$_header[0]] = $_header[1];
                    }
                }
            }
        }

        if (defined('FIREPHP_DEBUG') && FIREPHP_DEBUG) {
            $runTime = microtime(true) - $startRunTime;
            $runTime = sprintf("%0.2f", $runTime * 1000) . " ms";
            is_string($ret) && strlen($ret) > 2000 && $tmpret = (substr($ret, 0, 2000) . '......超长，截取2000字节');
            Common::debug(array(array('运行时间', '执行结果'), array($runTime, (empty($tmpret) ? $ret : $tmpret))), 'request_return');
        }
        return $ret;
    }

    private function _makeUri($req) 
    {
        $url = '';
        if (is_array($req)) {
            switch (count($req)) {
            case 1:
                $url = $req[0];
                break;
            case 2:
                list($url, $params) = $req;
                $paramStr = http_build_query($params);
                if (strpos($url, '?') !== false) {
                    $url .= "&{$paramStr}";
                } else {
                    $url .= "?{$paramStr}";
                }
                break;
            default:
                return self::_error(90402, 'url参数错误');
            }
        } else {
            $url = $req;
        }
        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($url, 'request_url');
        return $url;
    }

    private function _multi_http_exec($args) 
    {

        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && $startRunTime = microtime(true);

        if (!function_exists('curl_init')) {
            return self::_error(90400, '服务器没有安装curl扩展！');
        }
        if (empty($args['urls']) || !is_array($args['urls'])) {
            return self::_error(90401, '页面抓取请求url缺失');
        }

        $args['post'] = isset($args['post']) ? $args['post'] : array();
        $args['header'] = isset($args['header']) ? $args['header'] : array();
        $args['timeout'] = isset($args['timeout']) ? intval($args['timeout']) : self::HTTP_TIMEOUT;
        $args['cookie'] = isset($args['cookie']) ? $args['cookie'] : '';
        $args['redo'] = isset($args['redo']) ? $args['redo'] : self::HTTP_REDO;
        $args['maxredirect'] = isset($args['maxredirect']) ? intval($args['maxredirect']) : null;
        $args['headOnly'] = isset($args['headOnly']) ? $args['headOnly'] : false;
        $urls = $args['urls'];
        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($urls, 'request_multi_urls');

        $ch = curl_init();
        $opt = array();
        $opt[CURLOPT_RETURNTRANSFER] = true;
        $setheader = array();
        if (!empty($args['header']) && is_array($args['header'])) {
            foreach($args['header'] as $k => $v) {
                if(is_numeric($k)) {
                    if($pos = strpos($v, ':')) {
                        $setheader[strtolower(substr($v, 0, $pos))] = $v;
                    }
                } else {
                    $setheader[strtolower($k)] = "$k: $v";
                }
            }
        }
        $setheader['expect'] = 'Expect:'; // 解决100问题
        $opt[CURLOPT_HTTPHEADER] = $setheader;
        $opt[CURLOPT_TIMEOUT] = $args['timeout'];
        $opt[CURLOPT_SSL_VERIFYPEER] = false;
        $opt[CURLOPT_SSL_VERIFYHOST] = false;
        $opt[CURLOPT_HEADER] = true;
        if(!empty($this->http_useragent)) {
            $opt[CURLOPT_USERAGENT] = $this->http_useragent;
        }
        if ($args['headOnly']) {
            $opt[CURLOPT_NOBODY] = true;
        }
        if (!empty($args['post'])) {
            if (is_array($args['post'])) {
                $args['post'] = http_build_query($args['post']);
            }
            $opt[CURLOPT_POST] = true;
            $opt[CURLOPT_POSTFIELDS] = $args['post'];
        }
        if (!empty($args['cookie'])) {
            $opt[CURLOPT_COOKIE] = $args['cookie'];
        }
        curl_setopt_array($ch, $opt);

        $header = $ret = array();
        $doUrls = array_flip($urls);
        $mh = curl_multi_init();
        $_ch = array();

        do {
            do {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while($mrc === CURLM_CALL_MULTI_PERFORM);
            } while ($mrc === CURLM_OK && $active && curl_multi_select($mh) != -1);
            if ($mrc !== CURLM_OK) {
                defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug('Curl multi read error ' . $mrc, 'request_multi_curl_error');
            }

            // 获取返回结果
            foreach ($_ch as $url => $_ch_s) {
                $header[$url] = $ret[$url] = false;
                $curl_errno = curl_errno($_ch_s);
                if ($curl_errno) {
                    $curl_error = curl_error($_ch_s);
                    defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug("[errno] {$curl_errno} [error] {$curl_error}", 'request_multi_curl_error');
                    // [7]  Failed to connect() to host or proxy.
                    // [28] Operation timeout. The specified time-out period was reached according to the conditions.
                    // [52] Nothing was returned from the server, and under the circumstances, getting nothing is considered an error. 
                    $curl_errno === 28 || self::_error(90404, "curl内部错误信息[{$curl_errno}][{$url}]");
                    continue;
                }
                $ret[$url] = curl_multi_getcontent($_ch_s);
                $code = curl_getinfo($_ch_s, CURLINFO_HTTP_CODE);
                $redirect[$url] = $args['maxredirect'];
                do {
                    $redirect_ctl = false;
                    if (in_array($code, array(301, 302, 303, 307), true)) {
                        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($args['maxredirect'] - $redirect[$url] + 1, 'request_multi_redirectTimes');
                        $redirect_ctl = true;
                        preg_match('/Location:(.*?)\n/i', $ret[$url], $matches);
                        $newurl = trim($matches[1]);
                        if($newurl{0} === '/') {
                            preg_match("/^([^\/]*?:\/\/[^\/]*?)\//i", $url, $matches);
                            $newurl = $matches[1] . $newurl;
                        }
                        curl_setopt($_ch[$url], CURLOPT_URL, $newurl);
                        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($newurl, 'request_multi_redirectUrl');
                        $ret[$url] = curl_exec($_ch[$url]);
                        $curl_errno = curl_errno($_ch[$url]);
                        if ($curl_errno) {
                            $curl_error = curl_error($_ch[$url]);
                            defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug("[errno] {$curl_errno} [error] {$curl_error}", 'request_multi_curl_error');
                            // [7]  Failed to connect() to host or proxy.
                            // [28] Operation timeout. The specified time-out period was reached according to the conditions.
                            // [52] Nothing was returned from the server, and under the circumstances, getting nothing is considered an error. 
                            $curl_errno === 28 || self::_error(90404, "curl内部错误信息[{$curl_errno}][{$url}]");
                        }
                        $code = curl_getinfo($_ch[$url], CURLINFO_HTTP_CODE);
                    } else if($code !== 200) {
                        defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug("Curl code unnormal : {$code}", 'request_multi_curl_warn');
                    }
                } while($redirect_ctl && $redirect[$url]-- > 0);

                list($header[$url], $ret[$url]) = explode("\r\n\r\n", $ret[$url], 2);
                curl_multi_remove_handle($mh,$_ch[$url]);
                curl_close($_ch[$url]);
                unset($doUrls[$url]);
            }
            empty($doUrls) || defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug($doUrls, 'request_multi_redoUrl');
        } while(!empty($doUrls) && $args['redo']-- > 0);
        curl_multi_close($mh);

        // 抓取header时，解析header头
        if ($args['headOnly']) {
            foreach($header as $url => $v) {
                if($v !== false) {
                    $_headers = str_replace("\r", '', $v);
                    $_headers = explode("\n", $_headers);
                    $ret[$url] = array();
                    foreach ($_headers as $value) {
                        $_header = explode(': ', $value);
                        if (!empty($_header[0])) {
                            if (empty($_header[1])) {
                                $ret[$url]['status'] = $_header[0];
                            } else {
                                $ret[$url][$_header[0]] = $_header[1];
                            }
                        }
                    }
                } else {
                    $ret[$url] = false;
                }
            }
        }

        if (defined('FIREPHP_DEBUG') && FIREPHP_DEBUG) {
            $d = array();
            $i = 0;
            foreach($ret as $k => $v) {
                is_string($v) && strlen($v) > 2000 && $v = (substr($v, 0, 2000) . '......超长，截取2000字节');
                array_push($d, array($i++, $k, $v));
            }
            $runTime = microtime(true) - $startRunTime;
            $runTime = sprintf("%0.2f", $runTime * 1000) . " ms";
            array_unshift($d, array('', '运行时间', $runTime));
            array_unshift($d, array('序号', '请求地址', '执行结果'));
            Common::debug($d, 'request_multi_return');
        }
        return $ret;
    }

    private function _error($errno, $error) 
    {
        if(in_array($errno, array(90403, 90404), true) || defined('QUEUE') || defined('EXTERN')) {
            defined('FIREPHP_DEBUG') && FIREPHP_DEBUG && Common::debug("[errro code] {$errno}", 'request_error');
        } 
        
        return false;
    }

}
// END Http Class

/* End of file Http.php */
/* Location: ./application/libraries/Http.php */