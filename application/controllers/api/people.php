<?php

/*
 * ------------------------------------------------------------
 * @class  People  人民网发布系统接口
 * ------------------------------------------------------------
 * @做成    刘刚    2012-12-06 
 * ------------------------------------------------------------
 */

class People extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelsite');
        $this->load->model('modeltemplate');
        $this->load->model('modelfield');
        $this->load->model('modelcontent');
        $siteid = 7;        //站点id
        $this->DB = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
    }

    /*
     * ------------------------------------------------------------
     * @function  index  入口文件
     * @param      act     index?act=1 
     * ------------------------------------------------------------
     * @做成    刘刚    2012-12-06 
     * ------------------------------------------------------------
     */

    public function index() {
        $act = $_REQUEST['act'];
        switch ($act) {
            case 1:
                $this->add_book();   //添加书
                break;
            case 2:
                $this->add_charpter();   //添加章节
                break;
            case 3:
                $this->top();   //添加排行
                break;
            case 4:
                $this->getbook();   //获取一本书的数据
                break;
            case 5:
                $this->gettop();   //获取排行榜数据
                break;
            case 6: 
                $this->free();   // 免费
                break;
            case 7:
                $this->sales();   //促销
                break;
            default :
                return $this->jsonCode(10000);  //no act
        }
    }

    /*
     * ------------------------------------------------------------
     * @function  add_book  添加书信息
     * @param      bid        书id
     * @param      bname      书名
     * @param      bcover     封面
     * @param      author     作者
     * @param      intro      简介
     * @param      writing    写作状态 1.完本 0 连载
     * @param      btype      书分类
     * @param      ctype      频道
     * ------------------------------------------------------------
     * @做成    刘刚    2012-12-06 
     * ------------------------------------------------------------
     */

    private function add_book() {
        $bid = $this->input->post('bid') ? $this->input->post('bid') : 0;    //书id
        $bname = $this->input->post('bname') ? $this->input->post('bname') : ''; //书名
        $bcover = $this->input->post('bcover') ? $this->input->post('bcover') : ''; //封面
        $author = $this->input->post('author') ? $this->input->post('author') : ''; //作者
        $intro = $this->input->post('intro') ? $this->input->post('intro') : '';  //简介
        $writing = $this->input->post('writing') ? $this->input->post('writing') : 0; //写作状态 1.完本 0 连载
        $btype = $this->input->post('btype') ? $this->input->post('btype') : 0; //书分类
        $ctype = $this->input->post('ctype') ? $this->input->post('ctype') : 0; //频道
        if (!empty($bid) && !empty($bname) && !empty($bcover) && !empty($author) && !empty($intro) && !empty($btype) && !empty($ctype)) {
            $templateid = 1001; //模板id  
            $sql = "select id from cms_7.cms_t_{$templateid} where field_1 = {$bid}";
            $query = $this->DB->query($sql);
            if ($query->num_rows() > 0) {
                return $this->jsonCode(10001); // book isset
            } else {
                $m = $bid % 10;
                $upTime = date('Y-m-d H:i:s');
                $sql = "INSERT INTO  `cms_7`.`cms_t_{$templateid}` (
                    `siteid` ,`templateid` ,`otype` , `url`,`creater`, `createtime`, `publisher`,`publishtime`,
                    `field_1`, `field_2`,`field_3`,`field_4`, `field_5`, `field_6`,`field_7`, `field_8`,`field_15`
                    )
                    VALUES (
                      '7','$templateid','UTF-8','4g/book/$m/$bid.html','admin','$upTime','','',
                      '$bid','$bname', '$bcover','$author', '$intro','$writing', '$btype' , '$ctype', '$m'
                    ); ";
                $query = $this->DB->query($sql);

                $this->addothor(1012, '3g', $m, $bid, $upTime);
                $this->addothor(1013, 'wml', $m, $bid, $upTime);

                if ($query) {
                    return $this->jsonCode(array('succ', $this->DB->insert_id()));
                } else {
                    return $this->jsonCode(10002); //insert db error
                }
            }
        } else {
            return $this->jsonCode(10003); //param  error
        }
    }

    /*
     * ------------------------------------------------------------
     * @function  addothor         添加附表书信息
     * @param      $templateid     模板id
     * @param      $type           4g/3g/wml
     * @param      $m              模
     * @param      $bid            书id
     * @param      $upTime         录入时间
     * ------------------------------------------------------------
     * @做成    刘刚    2012-12-06 
     * ------------------------------------------------------------
     */

    private function addothor($templateid, $type, $m, $bid, $upTime) {
        $sql = "INSERT INTO  `cms_7`.`cms_t_{$templateid}` (
                    `siteid` ,`templateid` ,`otype` , `url`,`creater`, `createtime`, `publisher`,`publishtime`,`field_1`,`field_2`)
                    VALUES (
                      '7','{$templateid}','UTF-8','$type/book/$m/$bid.html','admin','$upTime','','', '$bid','$m'
                    ); ";
        $this->DB->query($sql);
    }

    /**
     * 添加书章节信息
      1    书id	 单行文本框	 启用	 不显示	 0
      2	 章节id	 单行文本框	 启用	 不显示	 0
      3	 章节名称
     */
    private function add_charpter() {
        $bid = $this->input->post('bid') ? $this->input->post('bid') : 0; //书id
        $cid = $this->input->post('cid') ? $this->input->post('cid') : 0; //章节id
        $ctitle = $this->input->post('ctitle') ? $this->input->post('ctitle') : 0;   //章节名称
        if (!empty($bid) && !empty($cid) && !empty($ctitle)) {
            $templateid = 1002; //模板id
            $sql = "select id from `cms_7`.`cms_t_{$templateid}` where   `field_1` = {$bid} and  `field_2` = {$cid}";
            $query = $this->DB->query($sql);
            if ($query->num_rows() > 0) {
                $this->jsonCode(10004); //章节存在
            } else {
                $upTime = date('Y-m-d H:i:s');
                $sql = " INSERT INTO  `cms_7`.`cms_t_{$templateid}` (
                    `siteid` ,`templateid` ,`otype` , `url`,`creater`, `createtime`, `publisher`,`publishtime`,
                    `field_1`, `field_2`,`field_3`
                    )
                    VALUES (
                      '7','$templateid','UTF-8','','admin','$upTime','','',
                      '$bid','$cid', '$ctitle'
                    ); ";
                $query = $this->DB->query($sql);
                if ($query) {
                    return $this->jsonCode(array('succ', $this->DB->insert_id()));
                } else {
                    return $this->jsonCode(10005); //insert db error
                }
            }
        } else {
            return $this->jsonCode(10006);  //param error
        }
    }

    /**
     * 榜单
     */
    private function top() {
        $ctype = $this->input->post('ctype') ? $this->input->post('ctype') : 0; //频道
        $ttype = $this->input->post('ttype') ? $this->input->post('ttype') : 0; //榜单类型
        $cdate = $this->input->post('tdata') ? $this->input->post('tdata') : 0; //榜单数据
        if (!empty($ctype) && !empty($ttype) && !empty($cdate)) {
            $templateid = 1003;
            $sql = "SELECT `id`  FROM `cms_7`.`cms_t_{$templateid}` WHERE  `field_1`={$ctype} AND  `field_2`={$ttype}";
            $query = $this->DB->query($sql);
            if ($query->num_rows() > 0) {
                $this->edit_top($ctype, $ttype, $cdate);
            } else {
                $this->add_top($ctype, $ttype, $cdate);
            }
        } else {
            $this->jsonCode(10009);  // top param error
        }
    }

    /**
     * 添加榜单
     * @param 频道	
     * @param 榜单类型	
     * @param 榜单数据
     * 排行  //w
     */
    private function add_top($ctype, $ttype, $cdate) {
        $upTime = date('Y-m-d H:i:s');
        $templateid = 1003; //模板id  
        $sql = " INSERT INTO  `cms_7`.`cms_t_{$templateid}` (
                    `siteid` ,`templateid` ,`otype` , `url`,`creater`, `createtime`, `publisher`,`publishtime`,
                    `field_1`, `field_2`,`field_3`
                    )
                    VALUES (
                      '7','$templateid','UTF-8','','admin','$upTime','','',
                      '$ctype','$ttype', '$cdate'
                    ); ";
        $query = $this->DB->query($sql);
        if ($query) {
            return $this->jsonCode(array('succ', $this->DB->insert_id()));
        } else {
            return $this->jsonCode(10007); //insert db error
        }
    }

    /**
     * 修改榜单
     */
    private function edit_top($ctype, $ttype, $cdate) {
        $tims = date('Y-m-d H:i:s');
        $sql = "update cms_7.cms_t_1003 set createtime = '{$tims}',field_3 = '{$cdate}' where field_1 = {$ctype} and field_2 = {$ttype}";
        $query = $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return $this->jsonCode(array('succ'));
        } else {
            return $this->jsonCode(10008); //adddown error
        }
    }

    /**
     * 获取一本书的数据
     * @param type $result
     */
    private function getbook() {
        $bid = $this->input->get('tdata') ? $this->input->get('tdata') : '';
        $field_str = $this->input->get('field_str') ? $this->input->get('field_str') : '';
        if (!empty($bid)) {
            if (!empty($field_str)) {
                $field_str = ',' . $field_str;
            }
            $templateid = 1001; //模板id  
            $sql = "select id,url,field_1,field_2,field_3 {$field_str} from cms_7.cms_t_{$templateid} where field_1 in ({$bid}) order by field(field_1,{$bid})";
            $query = $this->DB->query($sql);
            if ($query->num_rows() > 0) {
                echo json_encode(array('result' => array('status' => array('msg' => 'succ'), 'data' => $query->result_array())));
            } else {
                echo json_decode(1009);
            }
        } else {
            echo json_decode(1010);
        }
    }

    /**
     * 获取一个排行数据
     */
    private function gettop() {
        $type = $this->input->get('type') ? $this->input->get('type') : '';
        $templateid = 1003;
        $num = 1;
        switch ($type) {
            case 1:  //首屏热播
                $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_1 in (1,2,3,4,5,6,7,8,9,10) and field_2=1";
                $num = 2;
                break;
            case 2:  //精彩分类
                $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_1 in (1,2,3,4,5,6,7,8,9,10) and field_2=2";
                $num = 2;
                break;
            case 3:  //促销专区
                $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_1 in (1,2,3,4,5,6,7,8,9,10) and field_2=3";
                $num = 2;
                break;
            case 4:  //免费小说
                $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_1=13 and field_2=1";
                $num = 2;
                break;
            default:
                echo json_decode(1012);
                exit;
                break;
        }
        $result = $this->get_db_result($sql);
        $arr = $this->get_res_str($result, $num);
        $_GET['tdata'] = $this->arrTostr($arr);
        $this->getbook();
    }
    
    private function free(){
        $templateid =1001;
        $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_8=13 order by createtime desc limit 20";
        $result = $this->get_db_result($sql);
        echo json_encode(array('result' => array('status' => array('msg' => 'succ'), 'data' => $result)));
    }
    private function sales(){
        $templateid =1001;
        $sql = "select id,url,field_1,field_2,field_3 from cms_7.cms_t_{$templateid} where field_8=12 order by createtime desc limit 20";
        $result = $this->get_db_result($sql);
        echo json_encode(array('result' => array('status' => array('msg' => 'succ'), 'data' => $result)));
    }

    private function get_db_result($sql) {
        $query = $this->DB->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            echo json_decode(1013);
            exit;
        }
    }

    private function get_res_str($res, $num = 1) {
        $_arr = array();
        if (is_array($res) && !empty($res)) {
            foreach ($res as $key => $value) {
                $t_arr = explode(',', $value['field_3']);
                for ($i = 0; $i < $num; $i++) {
                    array_push($_arr, $t_arr[$i]);
                }
            }
        }
        return $_arr;
    }

    private function arrTostr($arr) {
        $str = '';
        foreach ($arr as $k => $items) {
            $str .= $items . ',';
        }
        return substr($str, 0, strlen($str) - 1);
    }

    private function jsonCode($result) {
        echo json_encode($result);
    }

}

?>
