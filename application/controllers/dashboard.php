<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct(){
        parent::__construct();
    }
	public function index(){
		$data['content'] = 'dashboard/dashboard';
		$this->load->view('layout/template_user_dashbord',$data);
	}
	public function admin(){
		$data['content'] = 'dashboard/dashboard_admin';
		$this->load->view('layout/template_admin2',$data);
	}
}