<?php
class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function get_users($username,$password){
		return $this->db->get_where('users', array('username' => $username,'password'=>$password))->row_array();
	}

	function daftar($nomor_id)
	{
        $query = $this->db->query("SELECT * FROM karyawan where nomor_id='$nomor_id'");
 
        //cek apakah ada data
        if ($query->num_rows() > 0) { //jika ada maka jalankan
            return $query->row_array();
        }else{
        	return "kosong";
        }
	}


}
?>