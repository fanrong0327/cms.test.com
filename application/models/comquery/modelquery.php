<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelquery extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    private $_avialFields;
    private $_sqlFrom;
    private $_condList = array(
        'gt' => '>',
        'egt' => '>=',
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'elt' => '<=',
    );
    private $_formulaList = array(
        'dayofyear' => 'dayofyear',
        'dayofyear' => 'dayofyear',
    );

    public function dbsource() {
        $dbs = array(
            1 => array('name' => 'cms_admin', 'db' => array('hostname' => "127.0.0.1:3306", 'username' => "math", 'password' => '19880327', 'database' => "cms_admin")),
            2 => array('name' => 'cms_1', 'db' => array('hostname' => "127.0.0.1:3306", 'username' => "math", 'password' => '19880327', 'database' => "cms_1")),
        );
        return $dbs;
    }

    private function _getFields($fields) {
        $mreturn = "";
        if ($fields != '') {
            $arrFields = explode(",", $fields);
            foreach ($arrFields as $field) {
                $item = $this->_getField($field);
                if ($item['name'] != '') {
                    $mreturn .= $item['realname'] . ' as  ' . $item['name'] . ',';
                }
            }
            $mreturn = substr($mreturn, 0, -1);
        }
        return $mreturn;
    }

    private function _getField($name) {
        $mreturn = array('realname' => '', 'name' => '', 'cname' => '', 'mem' => '');
        foreach ($this->_avialFields as $field) {
            if ($field['name'] == $name) {
                $mreturn = $field;
                break;
            }
        }
        return $mreturn;
    }

    private function _getCondition($condition) {
        $mreturn = "";
        if ($condition != '') {
            $arrCond = json_decode(urldecode($condition), true);
            foreach ($arrCond as $cond) {
                $field = $this->_getField($cond['field']);
                if ($field['name'] != '') {
                    $ret = $this->_calCondition($cond, $field);
                    if ($ret != "") {
                        $mreturn .= ' AND ' . $ret;
                    }
                }
            }
        }
        return $mreturn;
    }

    private function _getGroup($groupby) {

        $mreturn = "";
        if ($groupby != '') {
            $arrGroup = json_decode(urldecode($groupby), true);
            foreach ($arrGroup as $group) {
                $field = $this->_getField($group['field']);
                if ($field['name'] != '') {
                    $this->_updateField($group, $field);
                    $mreturn .= $field['name'] . ',';
                }
            }
            $mreturn = substr($mreturn, 0, -1);
        }
        return $mreturn;
    }

    private function _updateField($group, $field) {
        $tmpArr = array();
        foreach ($this->_avialFields as $item) {
            if ($item['name'] == $field['name'] && isset($group['formula']) && $group['formula'] != '') {
                $item['realname'] = $group['formula'] . "(" . $item['realname'] . ")";
            }
            $tmpArr[] = $item;
        }
        $this->_avialFields = $tmpArr;
    }

    private function _calCondition($cond, $field) {
        $mreturn = '';
        if (isset($cond['cond']) && isset($cond['cond']) && $cond['cond'] != '' && $cond['value'] != '') {
            if (isset($this->_condList[$cond['cond']])) {
                if (isset($cond['formula']) && $cond['formula'] != "") {
                    $mreturn = $field['realname'] . $this->_condList[$cond['cond']] . " " . $cond['formula'] . "('" . $cond['value'] . "') ";
                } else {
                    $mreturn = $field['realname'] . $this->_condList[$cond['cond']] . "'" . $cond['value'] . "' ";
                }
            }
        }
        return $mreturn;
    }

    private function _getFunc($func) {
        $mreturn = '';
        if ($func != '') {
            foreach ($func as $item) {
                $realname = $this->realname($item['field']);
                $mreturn .= $item['func'] . "(" . $realname . ") as " . $item['field'] . " ,";
            }
            $mreturn = substr($mreturn, 0, -1);
        }
        return $mreturn;
    }

    private function _getOrder($orderby) {
        return $orderby;
    }

    public function index($funcs, $fields, $where, $orderby, $groupby) {

        $field = $this->_getFields($fields);
        $func = $this->_getFunc($funcs);
        $cond = $this->_getCondition($where);
        $order = $this->_getOrder($orderby);
        $group = $this->_getGroup($groupby);

        $c = ($func != '' && $field != '') ? ',' : '';

        $pagenum = 500;
        if (isset($_POST['pagenum']) && intval($_POST['pagenum']) > 0) {
            $pagenum = intval($_POST['pagenum']);
        }
        $page = 1;
        if (isset($_POST['page']) && intval($_POST['page']) > 0) {
            $page = intval($_POST['page']);
        }
        $limit = " LIMIT " . ($page - 1) * $pagenum . "," . $pagenum;

        $sql = "SELECT SQL_CALC_FOUND_ROWS " . $field . $c . $func . ' FROM  ' . $this->_sqlFrom . ' WHERE 1=1 ' . $cond;
        if ($group != "") {
            $sql.=" GROUP BY " . $group;
        }
        if ($order != "") {
            $sql.=" ORDER BY " . $order;
        }
        $sql.= $limit;
        return $sql;
    }

    public function execute_db($sql, $tplinfo) {
        return $this->selectdb($tplinfo,$sql);
    }

    public function execute_db_rows() {
        $query = $this->db->query("SELECT FOUND_ROWS() as rows");
        $rows = $query->result_array();
        return $rows[0];
    }

    public function selectdb($tplinfo,$sql) {
        //选择数据源
        $dbs = $this->dbsource();
        $config = $dbs[$tplinfo[0]['from']]['db'];
        $conn = new mysqli($config['hostname'], $config['username'],  $config['password'], $config['database']);
        if(mysqli_connect_errno()){
            die('connect fail!');
        }

        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {
            $data[] =$row;
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        return $data;
    }

    /**
     * 获取单个模板信息
     */
    public function tplinfo($tplid) {
        $sql = "select * from ks_query_tpls where tid ={$tplid}";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $this->_sqlFrom = $res[0]['table'];
        return $res;
    }

    /**
     * 获取去模板列表
     */
    public function tpllist() {
        $sql = "select * from ks_query_tpls";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }

    /**
     * 检索字段 并获取域数据
     * @param type $tplid
     * @param type $fields_arr
     * @return boolean
     */
    public function checkfields($tplid, $fields_arr) {
        $sql = "select `realname`,`name`,`cname`,`mem` from `ks_query_fields` where `tid` = $tplid";
        $query = $this->db->query($sql);
        $querys = $query->result_array();
        if (!empty($querys)) {
            foreach ($querys as $items) {
                $f[] = $items['name'];
            }
            foreach ($fields_arr as $value) {
                if (in_array($value, $f) === FALSE) {
                    var_dump($value, $f);
                    return false;
                }
            }
            $this->_avialFields = $querys;
            return true;
        } else {
            return false;
        }
    }

    private function realname($fieldname) {
        foreach ($this->_avialFields as $item) {
            if (in_array($fieldname, $item)) {
                return $item['realname'];
            }
        }
    }

    /**
     * 添加模板记录
     */
    public function addtpl($data) {
        $sql = "insert into ks_query_tpls(`tname`,`table`,`from`,`mctime`,`createtime`) values('{$data['tname']}','{$data['table']}','{$data['from']}','{$data['mctime']}','{$data['createtime']}')";
        $this->db->query($sql);
        return $this->db->insert_id();
    }

    /**
     * 修改模板信息
     */
    public function edittpl($id, $data) {
        $sql = "update ks_query_tpls set `tname`='{$data['tname']}',`table`='{$data['table']}',`from`='{$data['from']}',`mctime`='{$data['mctime']}',`createtime`='{$data['createtime']}' where tid={$id}";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * 根据模板id获取域列表
     */
    public function fieldslist($tplid) {
        $sql = "select * from ks_query_fields where tid={$tplid} order by fid asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 添加域
     */
    public function addfields($data) {
        $sql = "insert into ks_query_fields (`tid`,`realname`,`name`,`cname`,`mem`,`createtime`) values ({$data['tid']},'{$data['realname']}','{$data['name']}','{$data['cname']}','{$data['mem']}','{$data['createtime']}')";
        $this->db->query($sql);
        return $this->db->insert_id();
    }

    /**
     * 修改域
     */
    public function editfields($id, $data) {
        $sql = "update ks_query_fields set `realname`='{$data['realname']}',`name`='{$data['name']}',`cname`='{$data['cname']}',`mem`='{$data['mem']}' where fid={$id}";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * 获取单个域信息
     */
    public function fieldsinfo($fid) {
        $sql = "select * from ks_query_fields where fid={$fid}";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
