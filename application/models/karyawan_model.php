<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class karyawan_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_data()
	{
		$query = $this->db->query("SELECT * from karyawan");
		return $query->result_array();
	}
	
	function delete($id)
	{
		//Delete table additional
		$this->db->where('nomor_id', $id);
		$this->db->delete('karyawan');	
	}

	function getById($id)
	{
		$query = $this->db->query("select * from karyawan where nomor_id='$id'");
		return $query->row_array();
	}
	

}
?>