<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class master_form_model extends CI_Model {

    function __construct(){
		parent::__construct();
	}
	
	function get_data(){
		$query = $this->db->query("SELECT * FROM lookup order by id_lookup");
		return $query->result_array();
	}
	
	function delete($id){
		//Delete table initial
		$this->db->where('id_initial', $id);
		$this->db->delete('initial');
		
		//Delete table initial_desk_assesment
		$this->db->where('id_initial', $id);
		$this->db->delete('initial_desk_assesment');
	}
	
	function getById($id){
		$query = $this->db->query("SELECT * FROM lookup where id_lookup='".$id."'");
		return $query->row_array();
	}
	
	function getByAttribute($filter){
		if(is_array($filter) && count($filter)>0){
	        foreach ($filter as $item){
	            $sql = "( ".$item." )";
	            $where = empty($where)? $sql : $where." AND ".$sql;
	        }
		}
		$query = $this->db->query("SELECT * FROM lookup where ".$where."");
		return $query->row_array();
	}
}
?>