<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct(){
        parent::__construct();		$this->load->model('initial_model');		$this->load->model('additional_model');		$this->load->model('basic_license_model');
    }
	public function index(){		$data['data_initial'] = $this->initial_model->get_data();		$data['data_additional'] = $this->additional_model->get_data();		$data['data_basic_license'] = $this->basic_license_model->get_data();
		$data['content'] = 'dashboard/dashboard';
		$this->load->view('layout/template_user_dashbord',$data);
	}
	public function admin(){
		$data['content'] = 'dashboard/dashboard_admin';
		$this->load->view('layout/template_admin2',$data);
	}		public function detail(){		if($this->uri->segment(3)=='initial'){			$data['data'] = $this->initial_model->getById($this->uri->segment(4));		}else if($this->uri->segment(3)=='additional'){			$data['data'] = $this->additional_model->getById($this->uri->segment(4));		}else if($this->uri->segment(3)=='basic_license'){			$data['data'] = $this->basic_license_model->getById($this->uri->segment(4));		}		$data['content'] = 'dashboard/detail';		$this->load->view('layout/template_admin',$data);	}
}