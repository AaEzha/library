<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_form extends CI_Controller {
	function __construct(){
        parent::__construct();
    }
		$data['data'] = $this->mdl->get_data();
		$this->load->view('layout/template_admin',$data);
	}
	public function update($id){
	}
}