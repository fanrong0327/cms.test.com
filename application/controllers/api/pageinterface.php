<?php

/**
 * ajax 分页后台接口
 *
 * @author 刘刚
 */
class pageinterface extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelsite');
        $this->load->model('modeltemplate');
        $this->load->model('modelfield');
        $this->load->model('modelcontent');
    }

    /**
     * 看书网新闻分页
     */
    public function ksnewpage() {
        $page = $this->input->get('page') ? $this->input->get('page') : 0;
        $offset = $this->input->get('offset') ? $this->input->get('offset') : 20;
        $callback = $this->input->get('callback');
        $limit = $page * $offset;
        $fileStr = ' url,field_1,publishtime,createtime ';
        $where = '';
        $orderby = ' ORDER BY `createtime` DESC ';
        $siteid = 5;        //站点id  5
        $templateid = 1050; //模板id 1050
        $count = $this->getListsSql($siteid, $templateid, $fileStr, $where, $orderby);
        $res = $this->getListsSql($siteid, $templateid, $fileStr, $where, $orderby, $limit, $offset, true);
        echo $callback . '(' . $this->jsonCode($res, $count) . ')';
    }

    /**
     * 分页list
     * @param type $fileStr 字段
     * @param type $where  条件
     * @param type $orderby 排序
     * @param type $limit  
     * @param type $offset
     * @param type $rows 
     * @return  data
     */
    function getListsSql($siteid, $templateid, $fileStr = '*', $where = '', $orderby = '', $limit = 0, $offset = 20, $rows = false) {
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        $sql = "SELECT {$fileStr} FROM `cms_t_{$templateid}` WHERE 1=1  {$where} {$orderby}";
        if ($rows) {//分页结果集 
            $sql .= " LIMIT {$limit},{$offset}";
            $query = $db->query($sql);
            return $query->result_array();
        } else {//总行数
            $query = $db->query($sql);
            return $query->num_rows();
        }
    }

    function jsonCode($res, $count) {
        $status = array();
        $data = array();
        if (empty($res)) {
            $status = array('code' => 36001, 'msg' => 'result is empty');
        } else {
            $status = array('code' => 0, 'msg' => 'succ');
            $data = array('count' => $count, 'lists' => $res);
        }
        $result = array('status' => $status, 'data' => $data);
        return json_encode(array('result' => $result));
    }

}

?>
