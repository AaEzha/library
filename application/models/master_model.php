<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class master_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_master_airframe()
	{
		$q = $this->db->get('master_airframe');
		$result = $q->result();
		foreach($result as $item){
			$master_airframe[$item->id_master_airframe] = $item->tipe_airframe;
		}
		return $master_airframe;
	}
	
	function get_master_electrical()
	{
		$q = $this->db->get('master_electrical');
		$result = $q->result();
		foreach($result as $item){
			$master_electrical[$item->id_master_electrical] = $item->tipe_electrical;
		}
		return $master_electrical;
	}
	
	function get_master_engine()
	{
		$q = $this->db->get('master_engine');
		$result = $q->result();
		foreach($result as $item){
			$master_engine[$item->id_master_engine] = $item->tipe_engine;
		}
		return $master_engine;
	}
	
	function get_master_instrument()
	{
		$q = $this->db->get('master_instrument');
		$result = $q->result();
		foreach($result as $item){
			$master_instrument[$item->id_master_instrument] = $item->tipe_instrument;
		}
		return $master_instrument;
	}
	
	function get_master_radio()
	{
		$q = $this->db->get('master_radio');
		$result = $q->result();
		foreach($result as $item){
			$master_radio[$item->id_master_radio] = $item->tipe_radio;
		}
		return $master_radio;
	}
}