<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {
    function index()
    {
    	$image = new Imagick( '/data/www/test/test.jpg' );
	    $image->resizeimage( 200, 200,  imagick::FILTER_LANCZOS, 1, FALSE);
	    $image->writeImage( '/data/www/test/test.jpg');
	
    }
    function moveUsers(){
        $sql = "SELECT `id`,`username`,`name`,`act` FROM `admin_role` ";
        $query = $this->db->query($sql);
        $users = $query->result_array();
        foreach($users as $user){
		echo $user['username']."\n";
                $acts = unserialize($user['act']);
		foreach($acts as $act){
			$sql_ins = "insert into admin_role_act(`roleid`,`actid`) values('".$user['id']."','".$act."')";
			//echo $sql_ins."<br/>";
			$this->db->query($sql_ins);
		}
        }
    }
}
