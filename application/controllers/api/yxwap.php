<?php

/*
 * ------------------------------------------------------------
 * @class  Yxwap  营销wap
 * ------------------------------------------------------------
 * @做成    刘刚    2014-02-19 
 * ------------------------------------------------------------
 */

class Yxwap extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->DB = Common::getDbConnect('default', true, array('database' => 'cms_9'));
    }

    public function index() {
        echo 'OK';
    }

    public function bookinfo() {
        $data = array();
        $t = $this->input->get('t') ? $this->input->get('t') : 1;   //1 移动  2电信 3联通
        $bid = $this->input->get('bid') ? $this->input->get('bid') : 0;
        $cd = $this->input->get('cd') ? $this->input->get('cd') : 2;  //1. 正常  2.大尺度
        if ($bid) {
            switch ($t) {
                case 1:
                    $table = 'cms_t_1001';
                    break;
                case 2:
                    $table = 'cms_t_1007';
                    break;
                case 3:
                    $table = 'cms_t_1013';
                    break;
                default:
                    break;
            }
            $sql = "select * from {$table} where field_1 in ({$bid}) order by field(field_1,{$bid})";
            $query = $this->DB->query($sql);
            $data = $query->result_array();
            if ($cd == 1) { //正常尺度
                foreach ($data as $key => &$value) {
                    $value['field_2'] = $value['field_10'];
                    $value['field_4'] = $value['field_11'];
                    if ($t == 3) { 
                        $value['field_9'] = $value['field_12'];
                    } else {
                        $value['field_8'] = $value['field_12'];
                    }
                }
            }
        }
        $this->_jsonCode($data);
    }

    //分类               
    function typebooks() {
        $t = $this->input->get('t') ? $this->input->get('t') : 1;
        $type = $this->input->get('type') ? $this->input->get('type') : 1;
        $field = $this->input->get('field') ? $this->input->get('field') : 0;
        switch ($t) {
            case 1:  //移动
                $btable = 'cms_t_1001';
                $ttable = 'cms_t_1003';
                break;
            case 2: //电信
                $btable = 'cms_t_1007';
                $ttable = 'cms_t_1009';
                break;
            case 3:  //联通
                $btable = 'cms_t_1013';
                $ttable = 'cms_t_1015';
                break;
            default:
                break;
        }
        $sql = "select {$field} from {$ttable} where field_4 = {$type}";
        $query = $this->DB->query($sql);
        $res = $query->result_array();
        $data = $this->getbooks($btable, $res[0][$field]);
        $this->_jsonCode($data);
    }

    //导航
    function navi() {
        $t = $this->input->get('t') ? $this->input->get('t') : 1;
        $type = $this->input->get('type') ? $this->input->get('type') : 1;
        switch ($t) {
            case 1:  //移动
                $btable = 'cms_t_1001';
                $ntable = 'cms_t_1005';
                break;
            case 2:
                $btable = 'cms_t_1007';
                $ntable = 'cms_t_1011';
                break;
            case 3:
                $btable = 'cms_t_1013';
                $ntable = 'cms_t_1017';
                break;
            default:
                break;
        }
        $sql = "select * from {$ntable} where field_1 = {$type}";
        $query = $this->DB->query($sql);
        $res = $query->result_array();

        $data[0] = $this->getbooks($btable, $res[0]['field_2']);
        $data[1] = $this->getbooks($btable, $res[0]['field_3']);
        $data[2] = $this->getbooks($btable, $res[0]['field_4']);
        $data[3] = $this->getbooks($btable, $res[0]['field_5']);
        $data['word'] = $this->words($type);
        $this->_jsonCode($data);
    }

    private function getbooks($btable, $bids) {
        $sql = "select * from {$btable} where field_1 in ({$bids}) order by field(field_1,{$bids})";
        $query = $this->DB->query($sql);
        $idata = $query->result_array();
        return $idata;
    }

    private function _jsonCode($data, $code = '0', $msg = 'succ') {
        $result = array(
            'result' => array(
                'status' => array('code' => $code, 'msg' => $msg),
                'data' => $data
        ));
        echo json_encode($result);
    }

    private function words($type) {
        $word = array(
            1 => array('男性小说排行榜', '女性小说排行榜', '火爆网友推荐', '最爽小说排行'), //排行
            3 => array('重磅推荐', '畅销排行', '火爆网友推荐', '最爽小说排行'), //全本
            4 => array('重磅推荐', '畅销排行', '火爆网友推荐', '最爽小说排行'), //精品
        );
        return $word[$type];
    }

}
