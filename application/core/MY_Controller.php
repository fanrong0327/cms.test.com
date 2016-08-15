<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 * @Copyright
 * @author fanrong@
 * @createtime     2013/03/30
 */
class MY_Controller extends CI_Controller {

    private $_admin_id;
    private $_act_arr = array();
    public $cur_act = array();
    public $all_act = array();
    public $act_verify;

    function __construct() {
        parent::__construct();
        $this->load->library('smarty');
        $this->smarty->assign('baseurl', base_url());
        $this->smarty->assign('title', $this->config->item('admin_title'));
        $this->smarty->assign('path_info', str_replace('//', '/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/'));
        $this->_admin_id = $this->session->userdata('admin_id');
        $this->all_act = $this->getAllAdminActions();

        if ($this->_admin_id > 0) {
            $this->cur_act = $this->getCurrentRoleActions();
            $this->smarty->assign('all_act_arr', $this->cur_act);
        } else {
            $this->cur_act = array();
            $this->smarty->assign('all_act_arr', $this->cur_act);
        }
    }

    protected function checkCurrentActionByToken($id, $verify) {
        $mreturn = 'FALSE';
        $this->db->select('r.actid');
        $this->db->from('admin_role_act as r');
        $this->db->where('r.roleid', $id);
        $query = $this->db->get();
        $list = $query->result_array();
        //array();
        //if ($query->num_rows() > 0) {
        //    $act = $query->row()->act;
        //    $list = unserialize($act);
        //}
        $this->db->select('a.id');
        $this->db->from('admin_action as a');
        $this->db->where('a.verify', $verify);
        $query = $this->db->get();
        $actioninfo = $query->row_array();
        if (!empty($actioninfo)) {
            foreach ($list as $item) {
                if ($item['actid'] == $actioninfo['id']) {
                    $mreturn = 'TRUE';
                }
            }
        }
        return $mreturn;
    }

    protected function checkCurrentAction() {
        $role_status = false;
        if ($this->act_verify) {
            $cur_role = $this->cur_act;
            foreach ($cur_role as $value) {
                foreach ($value['subact'] as $act) {
                    if ($act['verify'] == $this->act_verify) {
                        $role_status = true;
                    }
                }
            }
        }
        if (!$role_status) {
        	if($this->act_verify=='ADMIN_INDEX'){
        		header('Location: /');
        		exit();
        	}
        	else{
	            header("Content-type:text/html;charset=utf-8");
	            exit('无权限访问');
        	}
        }
    }

    private function getCurrentRoleActions() {
        $act_arr = $this->getAdminUserActions();
        $all_act = $this->all_act;
        foreach ($all_act as $key => &$val) {
            if (!empty($val['subact'])) {
                foreach ($val['subact'] as $k => &$v) {
                    if (is_array($act_arr) && !in_array($v['id'], $act_arr)) {
                        unset($val['subact'][$k]);
                    }
                }
            }
            if (empty($val['subact'])) {
                unset($all_act[$key]);
            }
        }
        return $all_act;
    }

    private function getAdminUserActions() {

        $mreturn = $this->_getPrivById($this->_admin_id);
        if (empty($mreturn)) {
            header('Location: /');
            exit;
        }
        return $mreturn;
    }

    private function _getPrivById($id) {
        $this->db->select('actid');
        $this->db->from('admin_role_act');
        $this->db->where('roleid', $id);
        $query = $this->db->get();
        $useract = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $act) {
                $useract[] = $act['actid'];
            }
        }
        return $useract;
    }

    public function getAllAdminActions($pid = 0) {
        $this->db->select('id,pid,icon,title,target,verify,display,orderby');
        $this->db->from('admin_action');
        $this->db->where('pid', $pid);
        $this->db->order_by('orderby', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $act) {
                if ($this->session->userdata('admin_token') != '') {
                    if (strpos($act['target'], '?') === FALSE) {
                        $act['target'].='?token=' . $this->session->userdata('admin_token');
                    } else {
                        $act['target'].='&token=' . $this->session->userdata('admin_token');
                    }
                }
                if (0 == $act['pid']) {
                    $act['subact'] = array();
                    $this->_act_arr[$act['id']] = $act;
                } else {
                    $this->_act_arr[$act['pid']]['subact'][] = $act;
                }
                $this->getAllAdminActions($act['id']);
            }
        }
        return $this->_act_arr;
    }

    public function getActionInfo($id) {
        $this->db->select('id,pid,icon,title,target,verify,display,orderby');
        $this->db->from('admin_action');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    public function getUserinfo($username) {
        $sql = "SELECT `id`,`username`,`password`,`name` FROM `admin_role` WHERE `username`=? LIMIT 1";
        $data[] = $username;
        $query = $this->db->query($sql, $data);
        return $query->row_array();
    }

    public function getUserLocal($username, $password) {
        $sql = "SELECT `id`,`username`,`password`,`name` FROM `admin_role` WHERE `username`=? AND `password`=? LIMIT 1";
        $data[] = $username;
        $data[] = $password;
        $query = $this->db->query($sql, $data);
        return $query->row_array();
    }

    public function getPrivate() {
        $mreturn = 'FALSE';
        $token = '';
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
        }
        $vstr = '';
        if (isset($_GET['vstr'])) {
            $vstr = $_GET['vstr'];
        }

        $this->load->library('Redis');
        $tokens = $this->redis->get($token);
        $tokens = unserialize($tokens);
        if (!empty($tokens) && is_array($tokens) && $tokens['uid'] > 0) {
            $uid = intval($tokens['uid']);
            $mreturn = $this->checkCurrentActionByToken($uid, $vstr);
        }
        if (isset($_GET['more']) && $_GET['more'] == '1') {
            if ($mreturn == 'TRUE') {
                $tokens['actions'] = $this->getPrivList($tokens['uid']);
                $ret = array('result' => array('status' => array('code' => 0, 'msg' => 'succ'), 'userinfo' => $tokens));
            } else {
                $ret = array('result' => array('status' => array('code' => 1, 'msg' => 'fail')));
            }

            echo json_encode($ret);
        } else {
            echo $mreturn;
        }
    }

    /**
     * 添加网编功能 
     */
    public function getEditor() {
        $name = isset($_GET['name']) ? $_GET['name'] : '';   //登陆名字
        $upaw = isset($_GET['paw']) ? $_GET['paw'] : '';     //登陆密码
        $uname = isset($_GET['uname']) ? $_GET['uname'] : ''; //真实姓名
        $token = isset($_GET['token']) ? $_GET['token'] : '';  //toekn md5($key.$name.$upaw.$uname)
        if ($name && $upaw && $uname && $token) {
            if ($token == md5('kscms' . $name . $upaw . $uname)) {
                $act = 'a:2:{i:0;s:2:"17";i:1;s:3:"191";}'; //网编 序列化
                $sql = "SELECT `id` FROM `admin_role` WHERE username = '{$name}'";
                $query = $this->db->query($sql);
                $_is = $query->row_array();
                if (empty($_is)) {
                    //add
                    $data = array('username' => $name, 'password' => $upaw, 'name' => $uname, 'act' => $act);
                    $this->db->insert('admin_role', $data);
                    $inster_id = $this->db->insert_id();
                    $this->db->query("insert into admin_role_act (roleid,actid) value({$inster_id},17)");
                    $this->db->query("insert into admin_role_act (roleid,actid) value({$inster_id},191)");
                } else {
                    //updata
                    $data = array('act' => $act);
                    $this->db->where('id', $_is['id']);
                    $this->db->update('admin_role', $data);
                }
                $ret = array('result' => array('status' => array('code' => 0, 'msg' => 'succ')));
            } else {
                $ret = array('result' => array('status' => array('code' => 10002, 'msg' => 'token fail')));
            }
        } else {
            $ret = array('result' => array('status' => array('code' => 10001, 'msg' => 'pamam fail')));
        }
        echo json_encode($ret);
    }

    public function getEditorDel() {
        $name = isset($_GET['name']) ? $_GET['name'] : '';   //登陆名字
        $upaw = isset($_GET['paw']) ? $_GET['paw'] : '';     //登陆密码
        $token = isset($_GET['token']) ? $_GET['token'] : '';  //toekn md5($key.$name.$upaw)
        if ($name && $upaw && $token) {
            //print_r(md5('kscms' . $name . $upaw));
            if ($token == md5('kscms' . $name . $upaw)) {
                $sql = "SELECT `id` FROM `admin_role` WHERE username = '{$name}' and password = '{$upaw}'";
                $query = $this->db->query($sql);
                $_is = $query->row_array();
                if (!empty($_is)) {
                    $this->db->delete('admin_role', array('username' => $name, 'password' => $upaw));
                    $ret = array('result' => array('status' => array('code' => 0, 'msg' => 'succ')));
                } else {
                    $ret = array('result' => array('status' => array('code' => 10003, 'msg' => 'del fail')));
                }
            } else {
                $ret = array('result' => array('status' => array('code' => 10002, 'msg' => 'token fail')));
            }
        } else {
            $ret = array('result' => array('status' => array('code' => 10001, 'msg' => 'pamam fail')));
        }
        echo json_encode($ret);
    }

    public function getEditorUpdate() {
        $name = isset($_GET['name']) ? $_GET['name'] : '';   //登陆名字
        $upaw = isset($_GET['paw']) ? $_GET['paw'] : '';     //登陆密码 
        $newpaw = isset($_GET['newpaw']) ? $_GET['newpaw'] : '';     //登陆密码 
        $token = isset($_GET['token']) ? $_GET['token'] : '';  //toekn md5($key.$name.$upaw.$newpaw)
        if ($name && $upaw && $newpaw && $token) {
            print_r(md5('kscms' . $name . $upaw . $newpaw));
            if ($token == md5('kscms' . $name . $upaw . $newpaw)) {
                $sql = "SELECT `id` FROM `admin_role` WHERE username = '{$name}' and password = '{$upaw}'";
                $query = $this->db->query($sql);
                $_is = $query->row_array();
                if (!empty($_is)) {
                    $data = array('password' => $newpaw);
                    $this->db->where('id', $_is['id']);
                    $this->db->update('admin_role', $data);
                    $ret = array('result' => array('status' => array('code' => 0, 'msg' => 'succ')));
                } else {
                    $ret = array('result' => array('status' => array('code' => 10003, 'msg' => 'paw fail')));
                }
            } else {
                $ret = array('result' => array('status' => array('code' => 10002, 'msg' => 'token fail')));
            }
        } else {
            $ret = array('result' => array('status' => array('code' => 10001, 'msg' => 'pamam fail')));
        }
        echo json_encode($ret);
    }

    private function getPrivList($uid) {
        $return = array();
        $acts = $this->_getPrivById($uid);
        foreach ($this->all_act as $act) {
            if (!empty($act['subact'])) {
                foreach ($act['subact'] as $item) {
                    if (!empty($item['verify']) && in_array($item['id'], $acts)) {
                        $return[] = array('id' => $item['id'], 'verify' => $item['verify']);
                    }
                }
            }
        }
        return $return;
    }

    /**
     * 设置分页,基础模块的分页;
     * @param array $result
     * @param ing $offset
     * @param int $limit
     */
    protected function setPages($url, $count, $page, $num, $query_string = '') {
        if ($count > $num) {
            if (!empty($query_string)) {
                $query_string = '&' . $query_string;
            }
            $pages = '';
            $total_page = ceil($count / $num);
            $tpage = $total_page;

            if ($page == 1) {
                $pages .= "<div class='page nohref'>共" . $count . "条 &nbsp;&nbsp;<span>" . $tpage . "页&nbsp;</span>";
                $pages .= "<a href='" . $url . "?page=" . ($page + 1) . "" . $query_string . "'>下一页</a>";
            } else {
                if ($page == $total_page) {
                    $pages .= "<div class='page'>共" . $count . "条&nbsp;&nbsp;<span>" . $tpage . "页&nbsp;</span><a href='" . $url . "?page=" . ($page - 1) . "" . $query_string . "'>上一页</a>&nbsp;";
                    $pages .= "";
                } else {
                    $pages .= "<div class='page'>共" . $count . "条&nbsp;&nbsp;<span>" . $tpage . "页&nbsp;</span><a href='" . $url . "?page=" . ($page - 1) . "" . $query_string . "'>上一页</a>&nbsp;";
                    $pages .= "<a href='" . $url . "?page=" . ($page + 1) . "" . $query_string . "'>下一页</a>";
                }
            }
            $pages .='&nbsp;&nbsp;<select id="selectpage" onchange="gopage()">';
            for ($i = 1; $i <= $tpage; $i++) {
                $show = ($page==$i) ? "selected" : "";
                $pages .= "<option value='{$i}' {$show} >{$i}</option>";
            }
            $pages .="</select></div>";
            $pages .="<script type=\"text/javascript\">function gopage(){var hpage = $(\"#selectpage\").val();window.location.href=\"{$url}?page=\"+hpage+"."'".$query_string."'}</script>";
            return $pages;
        }
    }

    protected function setPages1($url, $count, $page, $num, $query_string = '') {
    	if ($count > $num) {
    		if (!empty($query_string)) {
    			$query_string = '&' . $query_string;
    		}
    		$pages = '';
    		$total_page = ceil($count / $num);
    		$tpage = $total_page;
    		if($total_page>1){
	    		$pages.='<tr class="last">
			    <td colspan="9">
			    <div class="toolbar-pagination">
			    <span class="pagebox">';
			    if($page==1){
			    	$pages .='<span class="pagebox_pre_nolink" style="background: none;">首页</span>	<span class="pagebox_pre_nolink">上一页</span>';
			    }else{
			    	$pages .='<span class="pagebox_next" style="background: none;"><a href="' . $url . '?page=1' .$query_string . '" >首页</a></span>	<span class="pagebox_next" style="background: none;"><a href="'.$url.'?page='.($page - 1).$query_string.'">上一页</a></span>';
			    }
			    
			    if($tpage>10){
			    	if($page>5){
			    		if($page+5<=$tpage){
				    		for($i=$page-5;$i<$page+5;$i++){
				    			if($page==$i){
				    				$pages .='<span class="pagebox_num_nonce" href="' . $url . '?'.$query_string . '">'.$i.'</span>';
				    			}else{
				    				$pages .='<span class="pagebox_num"><a href="' . $url . '?page=' . $i.$query_string . '">'.$i.'</a></span>';
				    			}
				    		}
			    		}else{
			    			for($i=$tpage-10;$i<=$tpage;$i++){
			    				if($page==$i){
			    					$pages .='<span class="pagebox_num_nonce" href="' . $url . '?'.$query_string . '">'.$i.'</span>';
			    				}else{
			    					$pages .='<span class="pagebox_num"><a href="' . $url . '?page=' . $i.$query_string . '">'.$i.'</a></span>';
			    				}
			    			}
			    		}
			    	}else{
			    		for($i=1;$i<11;$i++){
			    			if($page==$i){
			    				$pages .='<span class="pagebox_num_nonce" href="' . $url . '?'.$query_string . '">'.$i.'</span>';
			    			}else{
			    				$pages .='<span class="pagebox_num"><a href="' . $url . '?page=' . $i.$query_string . '">'.$i.'</a></span>';
			    			}
			    		}
			    	}
			    }else{
			    	for ($i = 1; $i <= $tpage; $i++){
			    		if($page==$i){
			    			$pages .='<span class="pagebox_num_nonce" href="' . $url . '?' .$query_string . '">'.$i.'</span>';
			    		}else{
			    			$pages .='<span class="pagebox_num"><a href="' . $url . '?page=' . $i.$query_string . '">'.$i.'</a></span>';
			    		}
			    	}
			    }
			    if($page==$tpage){
			    	$pages .='<span class="pagebox_pre_nolink" style="background: none;">下一页</span><span class="pagebox_pre_nolink" style="background: none;">尾页</span>';
			    }else{
			    	$pages .='<span class="pagebox_next"><a href="'.$url.'?page='.($page + 1).$query_string.'">下一页</a></span><span class="pagebox_next" style="background: none;"><a href="'.$url.'?page='.$total_page.$query_string.'">尾页</a></span>';
			    }
			    $pages .= ' &nbsp;&nbsp;跳转到：<input class="to_page" max_page="7062" type="text" value="'.$page.'"/>&nbsp;页&nbsp;';
			    $pages .= '<span>共<b>'.$tpage.'</b>页&nbsp;&nbsp;共<b>'.$count.'</b>条数据</span>';
	   
	    		$pages .= '</span>
	    
	    		</div>
	    		</td>
	    		</tr>';
    		}
    		return $pages;
    	}
    }
    
    public function loginCheck()
    {   
    	
        $admin_token = $this->session->userdata('admin_token');
//         $admin_id = $this->session->userdata('admin_id');
//         $admin_name = $this->session->userdata('realname');
//         $this->session->sess_destroy();
// 		var_dump($admin_token,$admin_id);
        if(!$admin_token){
        	$this->session->sess_destroy();
        	header('Location: /');
        }
    }
    
    public function __destruct() {

    }

}

// END MY_Controller Class
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */