<?php
 
class download_file extends CI_Controller {
 
	function __construct(){
		parent::__construct();
	}
 
	function index(){
		$this->load->helper('download');
		$name = $this->uri->segment(2);
		$file_data = file_get_contents(base_url()."uploads/".$name);
		$file_name = $name;
		force_download($file_name, $file_data);
	}
}
?>