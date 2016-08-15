<?php

class Comquery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('comquery/modelquery', 'model');
        $this->load->library('Smarty');
    }

//---------设计模板功能---------------------------------------------------------------------------------------------------------------//
    /**
     * 模板首页
     */
    public function home() {
        $data = $this->model->tpllist();
        $this->smarty->assign('tpllist', $data);
        $this->smarty->display('comquery/home.html');
    }

    /**
     * 添加模板
     */
    public function tpladd() {
        if (isset($_POST['submit'])) {
            $tname = $this->input->post('tname') ? $this->input->post('tname') : '';
            $table = $this->input->post('table') ? $this->input->post('table') : '';
            $from = $this->input->post('from') ? $this->input->post('from') : '';
            $tmctime = $this->input->post('mctime') ? $this->input->post('mctime') : 0;

            $data = array(
                'tname' => $tname,
                'table' => $table,
                'from' => $from,
                'mctime' => $tmctime,
                'createtime' => date("Y-m-d H:i:s"),
            );
            $this->model->addtpl($data);
            header('Location: /api/comquery/home');
        } else {
            $this->smarty->assign('dbs', $this->model->dbsource());
            $this->smarty->display('comquery/addtpl.html');
        }
    }

    /**
     * 修改模板
     */
    public function tpledit() {
        $tplid = $this->input->get('tplid') ? $this->input->get('tplid') : 0;
        if ($tplid > 0) {
            if (isset($_POST['submit'])) {
                $tname = $this->input->post('tname');
                $table = $this->input->post('table');
                $from = $this->input->post('from');
                $tmctime = $this->input->post('mctime');
                $data = array(
                    'tname' => $tname,
                    'table' => $table,
                    'from' => $from,
                    'mctime' => $tmctime,
                    'createtime' => date("Y-m-d H:i:s"),
                );
                $this->model->edittpl($tplid, $data);
                header('Location: /api/comquery/home');
                exit;
            }
            $tplinfo = $this->model->tplinfo($tplid);
            $data = $tplinfo[0];
            $this->smarty->assign('dbs', $this->model->dbsource());
            $this->smarty->assign('data', $data);
            $this->smarty->display('comquery/addtpl.html');
        }
    }

    /**
     * 域列表
     */
    public function fieldslist() {
        $tplid = $this->input->get('tplid');
        $fieldslist = $this->model->fieldslist($tplid);
        $this->smarty->assign('data', $fieldslist);
        $this->smarty->assign('tplid', $tplid);
        $this->smarty->display('comquery/fields.html');
    }

    /**
     * 域添加
     */
    public function addfields() {
        if (isset($_POST['submit'])) {
            $tplid = $this->input->post('tplid') ? $this->input->post('tplid') : 0;
            $realname = $this->input->post('realname') ? $this->input->post('realname') : '';
            $name = $this->input->post('name') ? $this->input->post('name') : '';
            $cname = $this->input->post('cname') ? $this->input->post('cname') : '';
            $mem = $this->input->post('mem') ? $this->input->post('mem') : 0;

            $data = array(
                'tid' => $tplid,
                'realname' => $realname,
                'name' => $name,
                'cname' => $cname,
                'mem' => $mem,
                'createtime' => date("Y-m-d H:i:s"),
            );
            $this->model->addfields($data);
            header('Location: /api/comquery/fieldslist?tplid=' . $tplid);
        } else {
            $tplid = $this->input->get('tplid');
            $this->smarty->assign('tplid', $tplid);
            $this->smarty->display('comquery/addfields.html');
        }
    }

    /**
     * 域修改
     */
    public function editfields() {
        $fid = $this->input->get('fid');
        $tplid = $this->input->get('tplid');
        if ($fid > 0) {
            if (isset($_POST['submit'])) {
                $realname = $this->input->post('realname');
                $name = $this->input->post('name');
                $cname = $this->input->post('cname');
                $mem = $this->input->post('mem');
                $data = array(
                    'realname' => $realname,
                    'name' => $name,
                    'cname' => $cname,
                    'mem' => $mem,
                    'createtime' => date("Y-m-d H:i:s"),
                );
                $this->model->editfields($fid, $data);
                $tplid = $this->input->post('tplid');
                header('Location: /api/comquery/fieldslist?tplid=' . $tplid);
                exit;
            }
            $fieldinfo = $this->model->fieldsinfo($fid);
            $data = $fieldinfo[0];
            $this->smarty->assign('fid', $fid);
            $this->smarty->assign('tplid', $tplid);
            $this->smarty->assign('data', $data);
            $this->smarty->display('comquery/addfields.html');
        }
    }

//---------API功能---------------------------------------------------------------------------------------------------------------//

    /**
     * aip请求url
     */
    public function query() {
        $tplid = isset($_POST['tplid']) && !empty($_POST['tplid']) ? $_POST['tplid'] : 0;
        $fields = isset($_POST['fields']) && !empty($_POST['fields']) ? $_POST['fields'] : '';
        $funcs = isset($_POST['func']) && !empty($_POST['func']) ? $_POST['func'] : '';
        $where = isset($_POST['where']) && !empty($_POST['where']) ? $_POST['where'] : '';
        $orderby = isset($_POST['orderby']) && !empty($_POST['orderby']) ? $_POST['orderby'] : '';
        $groupby = isset($_POST['groupby']) && !empty($_POST['groupby']) ? $_POST['groupby'] : '';

        //聚合函数拼接
        if ($funcs != '') {
            $field_func = '';
            $funcs = json_decode(urldecode($funcs), true);
            foreach ($funcs as $items) {
                $field_func .= $items['field'] . ',';
            }
            $fields = substr($fields . ',' . $field_func, 0, -1);
        }



        if ($tplid > 0) {
            //检索字段
            if ($fields != '') {
                $fields_arr = explode(',', $fields);
            }
            if ($this->model->checkfields($tplid, $fields_arr)) {
                //获取模板数据
                $tplinfo = $this->model->tplinfo($tplid);
                $data['sql'] = $this->model->index($funcs, $fields, $where, $orderby, $groupby);
                $data['data'] = $this->model->execute_db($data['sql'], $tplinfo);
                //$data['rows'] = $this->model->execute_db_rows();
                echo json_encode($data);
            } else {
                echo 'fields is error';
            }
        } else {
            echo 'tplid is error';
        }
    }

//---------通用查询页功能---------------------------------------------------------------------------------------------------------------//
    public function queryhome() {
        $data = $this->model->tpllist();
        $this->smarty->assign('tpllist', $data);
        $this->smarty->display('comquery/queryhome.html');
    }

    public function ajaxwhere() {
        $tplid = $this->input->get('tplid');
        $data = $this->model->fieldslist($tplid);
        echo json_encode($data);
    }

    public function ajaxquery() {
        $post = $this->input->post('data');
        parse_str($post, $ajax_arr);
        $tplid = $ajax_arr['tplid'];
        unset($ajax_arr['tplid']);
        $where = array();
        foreach ($ajax_arr['field'] as $key => $itmes) {
            if (!empty($ajax_arr['value'][$key]) && !empty($ajax_arr['option'][$key])) {
                $where[$key]['field'] = $itmes;
                $where[$key]['cond'] = $ajax_arr['option'][$key];
                $where[$key]['value'] = trim($ajax_arr['value'][$key]);
            }
        }
        if (!empty($where)) {
            //获取所有能显示的字段
            $fields = $this->model->fieldslist($tplid);
            $show_field = '';
            foreach ($fields as $itmes) {
                $show_field .= $itmes['name'] . ',';
                $cname[] = $itmes['cname'];
            }
            $show_field = substr($show_field, 0, strlen($show_field) - 1);
            $curl_data = array(
                'tplid' => $tplid, //模板id
                'fields' => $show_field, //分装字段
                'where' => urlencode(json_encode($where)), //where 条件
            );

            $url = "http://cms.test.com/api/comquery/query";
            $this->load->library("Http");
            $rs_json = $this->http->post($url, $curl_data);
            $json_arr = json_decode($rs_json, true);
            $json_arr['title'] = $cname;
            $res = json_encode($json_arr);
            echo $res;
        }
    }

//---------API测试---------------------------------------------------------------------------------------------------------------//
    public function test() {
        $_POST['tplid'] = 1;
        $_POST['fields'] = "orderid,uid,time,cfrom,money";
        $arrCond = array(
            array('field' => 'uid', 'cond' => 'eq', 'value' => '7610528'),
        );
        $_POST['where'] = urlencode(json_encode($arrCond));
//        $arrGroup = array(
//            array('field' => 'bclassid'),
//        );
//        //$_POST['groupby'] = urlencode(json_encode($arrGroup));
//        $_POST['orderby'] = "bid desc";
//        $_POST['page'] = 1;
//        $_POST['pagenum'] = 20;
//
//        $_POST['func'] = array(
//            array('field' => 'bclassid', 'func' => 'sum'),
//            array('field' => 'bid', 'func' => 'max'),
//        );
        $this->query();
    }
    
    public function conn() {
        $conn = mysql_connect('183.203.14.72:3307','kspub','Z5X(("6D.ghDIDRm#1c<EW>QlynGGI',''); 
        if($conn){
            echo 'yes';
        }else{
            echo 'no';
        }
        
    }

}
