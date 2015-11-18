<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class initial_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_data()
	{
		$query = $this->db->query("SELECT b.nama, b.nomor_id, b.unit, b.nomor_telpon, b.status, a.* FROM initial_desk_assesment as a left join initial as b on a.id_initial=b.id_initial order by b.tanggal_dibuat desc");
		return $query->result_array();
	}
	
	function delete($id)
	{
		//Delete table initial
		$this->db->where('id_initial', $id);
		$this->db->delete('initial');
		
		//Delete table initial_desk_assesment
		$this->db->where('id_initial', $id);
		$this->db->delete('initial_desk_assesment');
	}
	
	function getById($id)
	{
		$query = $this->db->query("SELECT a.nama, c.email, a.cost_check as cost_check1, a.nomor_id, a.unit, a.nomor_telpon, a.status, b.* FROM initial as a left join initial_desk_assesment as b on a.id_initial=b.id_initial left join pengguna as c on a.id_pengguna=c.id_pengguna where a.id_initial='".$id."'");
		return $query->row_array();
	}
	
	function getLastId($id){
		$query = $this->db->query("Select a.*, b.id_initial_desk_assesment from (SELECT * FROM `initial` WHERE id_pengguna=".$id." order by id_initial desc limit 1)as a left join initial_desk_assesment as b on a.id_initial=b.id_initial");
		return $query->row_array();
	}
}
?>