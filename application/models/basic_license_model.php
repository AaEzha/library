<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class basic_license_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_data()
	{
		$query = $this->db->query("SELECT b.nama, b.nomor_id, b.unit, b.nomor_telpon, b.status, a.* FROM basic_license_desk_assesment as a left join basic_license as b on a.id_basic_license=b.id_basic_license order by a.tanggal_dibuat desc");
		return $query->result_array();
	}
	
	function delete($id)
	{
		//Delete table basic_license
		$this->db->where('id_basic_license', $id);
		$this->db->delete('basic_license');
		
		//Delete table basic_license_desk_assesment
		$this->db->where('id_basic_license', $id);
		$this->db->delete('basic_license_desk_assesment');
	}
	
	function getById($id)
	{
		$query = $this->db->query("SELECT a.nama, a.cost_check as cost_check1, a.nomor_id, a.unit, a.nomor_telpon, a.status, b.* FROM basic_license as a left join basic_license_desk_assesment as b on a.id_basic_license=b.id_basic_license where a.id_basic_license='".$id."'");
		return $query->row_array();
	}
	
	function getLastId($id){
		$query = $this->db->query("Select a.*, b.id_basic_license_desk_assesment from (SELECT * FROM `basic_license` WHERE id_pengguna=".$id." order by id_basic_license desc limit 1)as a left join basic_license_desk_assesment as b on a.id_basic_license=b.id_basic_license");
		return $query->row_array();
	}
}
?>