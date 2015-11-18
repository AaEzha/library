<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('report_model', 'mdl');
    }

	public function index()
	{
		if(isset($_POST['submit'])){
			$this->form_validation->set_rules('month', 'Month', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			} else {
				$data_day = explode("-", $this->input->post('month'));
				$count_day = cal_days_in_month(CAL_GREGORIAN,$data_day[1],$data_day[0]);
				$data['day'] = $count_day;
				$data['data'] = $this->mdl->get_data($this->input->post('data'), $this->input->post('month'));
				$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			}
		}else{
			$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
			$this->load->view('layout/template_admin',$data);
		}
	}
}