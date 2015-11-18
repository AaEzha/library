<?php
class Realdream_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	public function desc_table($tbl)
	{
	
		$data = ($this->db->query("DESC $tbl")->result_array());
		
		for($i=0; $i<count($data); $i++){
			
			$data2 = (explode('(',$data[$i]['Type']));
			if(isset($data2[1]))
			$data[$i]['_length'] = substr($data2[1],0,strlen($data2[1])-1)*1 ;
			else
			$data[$i]['_length'] = 1;
			
			$data2="";
		}
		
		
		foreach($data as $val){
			$data2[($val['Field'])] = $val;
		}
		return $data2;
		
	}

}
?>