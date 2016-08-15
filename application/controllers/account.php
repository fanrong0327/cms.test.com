<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
    }

    //检查邮件登录
    private function checkMail($username,$password)
    {
	$password = str_replace('"', '\"', $password);
	$root = dirname(BASEPATH);
	
	//return $root.'/shell/' . $dir . '/' . $server . '.' . $site . '.sh';
	$command = 'python '.$root.'/shell/pop.py '.$username.' "'.$password.'"';

	$result = shell_exec($command);
	if($result == 1){
	    return TRUE;
	}
	return FALSE;
	
    }
    function login()
    {
        $this->load->library('Redis');
        if($_POST['username'] == '' || $_POST['password'] == ''){
                $this->logout();
                exit;
        }
        $userinfo = $this->getUserLocal($_POST['username'], $_POST['password']);
            
        if ($userinfo['id'] < 1)
        {
                $userinfo = $this->getUserinfo($_POST['username']);
                
                //添加登录日志 
                $this->login_log($userinfo['id'],$_POST['username'], $_POST['password']);
                
                if (!$this->checkMail($_POST['username'], $_POST['password']))
                {
                        $this->logout();
                        exit;
                }

        }
        $this->admin_id = $userinfo['id'];

        //写入SESSION
        $this->session->set_userdata('admin_id', $this->admin_id);
        $this->session->set_userdata('realname',$userinfo['name']);
        $time=time();
        $tokenarray = serialize(array('uid'=>$this->admin_id,'username'=>$_POST['username'],'realname'=>$userinfo['name'],'time'=>$time));
        $token = md5($tokenarray);
        $this->redis->set($token,$tokenarray);
        $this->session->set_userdata('admin_token', $token);
        header('Location: /index');
    }
    //退出登录
    function logout()
    {
        $this->session->sess_destroy();
        header('Location: /');
    }
    //用户登录日志
    private function login_log($uid,$username,$password){
        //用户名 密码 登录时间  用户表信息 email验证信息
        $email = $this->checkMail($username, $password) == 1 ? 'true' : 'false';
        $str = date('Y-m-d H:i:s') ."\t" .$uid ."\t" . $username . "\t" . $password . "\t" .$email ."\n";
        error_log($str,3,'/data/cmslog/login.log');
    }
    
}
