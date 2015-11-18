<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class basic_license_desk_assesment extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->model('master_model');
		$this->load->model('master_form_model','mdl');
		$this->load->model('basic_license_model');
    }

	public function index()
	{
		$fields = $this->db->field_data('initial_desk_assesment');
		$data['FORM_DAAO_6501'] = $this->mdl->getByAttribute(array("code='FORM_DAAO_65-01'"));
		$data['CURRICULUM_VITEA'] = $this->mdl->getByAttribute(array("code='CURRICULUM_VITEA'"));
		$data['FORM_DAC_6510'] = $this->mdl->getByAttribute(array("code='FORM_DAC_65-10'"));
		foreach($fields as $val){
			$fields2[($val->name)] = (array) $val;
		}
		$data['desc_table'] = $fields2;
		$data['error'] = '';
		$data['data_master_engine'] = $this->master_model->get_master_engine();
		$data['data_master_airframe'] = $this->master_model->get_master_airframe();
		if($this->input->post('submit')<>''){
			$post = ($this->input->post());
			unset($post['submit']);
			$this->form_validation->set_rules('id_basic_license', 'ID Basic License', 'required');
			// if(empty($_FILES['form']['name']) || empty($_FILES['curriculum_vitea']['name'])){
				// $this->form_validation->set_rules('form', 'Form 65.01(02-10)', 'required');
				// $this->form_validation->set_rules('curriculum_vitea', 'Curriculum Vitea', 'required');
			// }
			$this->form_validation->set_rules('form_dac', 'Form DAC-65.10', 'required');
			$this->form_validation->set_rules('application_request', 'Application Requested For Examination', 'required');
			if($post['category']!='AP' && $post['category']=='EA'){
				$this->form_validation->set_rules('rating', 'Rating', 'required');
			}else if($post['category']!='AP' && $post['category']!='EA'){
				$this->form_validation->set_rules('category', 'Category', 'required');
			}
			$this->form_validation->set_message('required', '%s harap diisi.');
			$data['data_master_engine'] = $this->master_model->get_master_engine();
			$data['data_master_airframe'] = $this->master_model->get_master_airframe();
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			}else{
				$upload_form = $this->upload('form');
				$upload_curriculum_vitea = $this->upload('curriculum_vitea');
				if($upload_form['status'] == '1' && $upload_curriculum_vitea['status'] == '1'){
					if($post['category']=='EA'){
						foreach($post['EA'] as $data_ea){
							$sub_category .= $data_ea.",";
						}
						$post['sub_category'] = $sub_category;
						unset($post['EA']);
						unset($post['ap_list']);
						unset($post['engine_1']);
						unset($post['engine_2']);
						unset($post['airframe']);
					}else if($post['category']=='AP'){
						$post['sub_category'] = $post['ap_list'];
						unset($post['ap_list']);
						unset($post['AP']);
						unset($post['rating']);
						// if($post['sub_category']=='AP Double'){
							// unset($post['airframe']);
						// }else{
							// unset($post['engine_1']);
							// unset($post['engine_2']);
						// }
					}
					$post['form'] = $upload_form['message']['file_name'];
					$post['curriculum_vitea'] = $upload_curriculum_vitea['message']['file_name'];
					// echo "<pre>";
					// print_r($post);
					// die;
					$this->db->insert('basic_license_desk_assesment',$post);
					$data = $this->basic_license_model->getById($this->uri->segment(3));
					send_email($data['nama'], $data['email'], "waiting", "Basic License");
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
					redirect(strtolower(__CLASS__) .'/thank_you');
				}else{
					$data['upload_error'] = $this->upload->display_error();
					$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
					$this->load->view('layout/template_admin',$data);
				}
			}
		}
		else{
			$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
			$this->load->view('layout/template_admin',$data);
		}
	}

	public function thank_you()
	{
		$data['content'] = strtolower(__CLASS__).'/thank_you_page';
		$this->load->view('layout/template_admin', $data);
	}
	
	function upload($upload=null){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|doc|docx|gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($upload))
		{
			$error = array('error' => $this->upload->display_error());
			return array('status'=>'0', 'message'=>$error);
		}
		else
		{
			return array('status'=>'1', 'message'=>$this->upload->data());
		}
	}
	
	

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
}