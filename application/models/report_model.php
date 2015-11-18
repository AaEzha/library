<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
Class report_model extends CI_Model {

    function __construct()
    {
		parent::__construct();
	}
	
	function get_data($table, $month) {
		$query = $this->db->query("SELECT date_format(tanggal_dibuat, '%d') as 'tgl',
									status, count(*) as 'jumlah'
									FROM ".$table." where tanggal_dibuat like '".$month."%' group by date_format(tanggal_dibuat, '%d'), status");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $value) {
				$data[$value->tgl][$value->status] = $value->jumlah;
			}
		}
		return $data;
	}
}
?>