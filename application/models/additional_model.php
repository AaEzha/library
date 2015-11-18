<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class additional_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_data()
	{
		$query = $this->db->query("SELECT b.nama, b.nomor_id, b.unit, b.nomor_telpon, b.status, a.* FROM additional_desk_assesment as a left join additional as b on a.id_additional=b.id_additional order by a.tanggal_dibuat desc");
		return $query->result_array();
	}
	
	function delete($id)
	{
		//Delete table additional
		$this->db->where('id_additional', $id);
		$this->db->delete('additional');
		
		//Delete table additional_desk_assesment
		$this->db->where('id_additional', $id);
		$this->db->delete('additional_desk_assesment');
	}
	
	function getById($id)
	{
		$query = $this->db->query("SELECT a.nama, a.cost_check as cost_check1, a.nomor_id, a.unit, a.nomor_telpon, a.status, b.* FROM additional as a left join additional_desk_assesment as b on a.id_additional=b.id_additional where a.id_additional='".$id."'");
		return $query->row_array();
	}
	
	function getLastId($id){
		$query = $this->db->query("Select a.*, b.id_additional_desk_assesment from (SELECT * FROM `additional` WHERE id_pengguna=".$id." order by id_additional desc limit 1)as a left join additional_desk_assesment as b on a.id_additional=b.id_additional");
		return $query->row_array();
	}
}
?>