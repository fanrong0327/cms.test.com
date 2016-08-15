<?php

/*
 * ------------------------------------------------------------
 * @CLASS    Cmread    抓取移动基地数据
 * ------------------------------------------------------------
 * @做成		 刘刚			2014-08-19    1.0
 * @变更
 * ------------------------------------------------------------
 */

class Cmread extends MY_Controller {

    private $img_host = "http://img.kanshu.com/2013";

    public function __construct() {
        parent::__construct();
    }

    /*
     * ------------------------------------------------------------
     * @FUNC    index    抓取基地数据
     * ------------------------------------------------------------
     * @做成		 刘刚			2014-08-19    1.0
     * @变更
     * ------------------------------------------------------------
     */

    public function index() {
        $book_id = $this->input->get('book_id');
        //$cp_id = $this->input->get($cp_id); // 1：古羌 2：丹鼎 3：聚点
        if ($book_id) {
            $get_url = "http://wap.cmread.com/r/p/viewdata.jsp?bid={$book_id}&cm=M3530002&vt=9";
            $data = $this->HttpGet($get_url, TRUE);
            if(!empty($data)){
                print_r($data);
                
            }
        }
    }

    /*
     * ------------------------------------------------------------
     * @FUNC    HttpGet    CURL
     * ------------------------------------------------------------
     * @做成		 刘刚			2014-08-19    1.0
     * @变更
     * ------------------------------------------------------------
     */

    private function HttpGet($url, $is_json = false) {

        $header[] = 'Connection: Keep-Alive';
        $header[] = 'Content-Type: application/x-www-form-urlencoded';
        $header[] = 'Accept-Encoding: gzip, deflate';
        $header[] = 'Accept-Language: zh-CN,zh;q=0.9,en;q=0.8';
        $header[] = 'Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $agents = array(
            'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16 FirePHP/0.7.4'
        );
        $agent_count = count($agents);
        $user_agent = $agents[rand(0, $agent_count - 1)];
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $body = curl_exec($ch);	
        curl_close($ch);
        if ($is_json) {
            $body = json_decode($body, true);
        }
        return $body;
    }

}
