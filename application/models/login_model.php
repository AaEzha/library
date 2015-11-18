<?php
class Login_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

	function get_users($username,$password){
		return $this->db->get_where('pengguna', array('email' => "$username",'kata_sandi'=>"$password"))->row_array();
	}

	function email_check($email){
		return $this->db->get_where('pengguna', array('email' => "$email"))->result_array();
	}
}
?>