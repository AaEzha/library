<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class initial_desk_assesment extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('master_form_model','mdl');
		$this->load->model('master_model');
		$this->load->model('initial_model');
    }

	public function index()
	{
		// echo "<pre>";
		// print_r($_POST);
		// die;
		$fields = $this->db->field_data('initial_desk_assesment');
		$data['copy_basic_license'] = $this->mdl->getByAttribute(array("code='COPY_BASIC_LICENSE'"));
		$data['FORM_DAAO_6502'] = $this->mdl->getByAttribute(array("code='FORM_DAAO_65-02'"));
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
			// echo "<pre>";
			// print_r($post);
			// die;
			$this->form_validation->set_rules('id_initial', 'ID Initial', 'required');
			$this->form_validation->set_rules('interoffice_letter', 'Interoffice Letter', 'required');
			$this->form_validation->set_rules('form_daao', 'Form DAAO', 'required');
			$this->form_validation->set_rules('current_human_factor', 'Current Human Factor', 'required');
			if($post['category']!='AP' && $post['category']=='EA'){
				$this->form_validation->set_rules('rating', 'Rating', 'required');
			}else if($post['category']!='AP' && $post['category']!='EA'){
				$this->form_validation->set_rules('category', 'Category', 'required');
			}
			$this->form_validation->set_message('required', '%s harap diisi.');
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			}else{
				$upload_copy_basic_license = $this->upload('copy_basic_license');
				$upload_photo = $this->upload('photo');
				$upload_copy_ktp = $this->upload('copy_ktp');
				$upload_copy_kk = $this->upload('copy_kk');
				if($upload_copy_basic_license['status'] == '1' && $upload_photo['status'] == '1' && $upload_copy_ktp['status'] == '1' && $upload_copy_kk['status'] == '1'){
					$post['ptl'] = $post['log1'];
					$post['pel'] = $post['log2'];
					unset($post['log1']);
					unset($post['log2']);
					if(!empty($post['ste_book'])){
						unset($post['ptl']);
						unset($post['pel']);
					}
					if($post['category']=='EA'){
						foreach($post['EA'] as $data_ea){
							$sub_category .= $data_ea.",";
						}
						$post['sub_category'] = $sub_category;
						// $post['sub_category'] = $post['EA']['0'];
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
					$post['copy_basic_license'] = $upload_copy_basic_license['message']['file_name'];	
					$post['photo'] = $upload_photo['message']['file_name'];					
					$post['copy_ktp'] = $upload_copy_ktp['message']['file_name'];
					$post['copy_kk'] = $upload_copy_kk['message']['file_name'];
					$post['tanggal_dibuat'] = date('Y-m-d');
					$post['dibuat_oleh'] = $this->session->userdata('users')['nama'];
					// echo "<pre>";
					// print_r($post);
					// die;
					$this->db->insert('initial_desk_assesment',$post);
					$data = $this->initial_model->getById($this->uri->segment(3));
					send_email($data['nama'], $data['email'], "waiting", "Initial");
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
					redirect(strtolower(__CLASS__) .'/thank_you');
				}else{
					$data['upload_error'] = $this->upload->display_error();
					$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
					$this->load->view('layout/template_admin',$data);
				}
			}
		} else {
			$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
			$this->load->view('layout/template_admin',$data);
		}
	}
	
	public function get_list(){
		// echo "<pre>";
		// print_r($_POST);
		$data_type = explode(',',$this->input->post('type'));
		$sql = "select * from (";
		if (in_array("Electrical", $data_type)) {
			$sql .= " SELECT tipe_electrical as 'tipe' FROM master_electrical
					union ";
		}
		if (in_array("Airframe", $data_type)) {
			$sql .= " SELECT tipe_airframe as 'tipe' FROM master_airframe
					union ";
		}
		if (in_array("Engine", $data_type)) {
			$sql .= " SELECT tipe_engine as 'tipe' FROM master_engine
					union ";
		}
		if (in_array("Instrument", $data_type)) {
			$sql .= " SELECT tipe_instrument as 'tipe' FROM master_instrument
					union ";
		}
		if (in_array("Radio", $data_type)) {
			$sql .= " SELECT tipe_radio as 'tipe' FROM master_radio
					union ";
		}
		$sql .= " select '' as 'tipe' from dual ";
		$sql .= ") as a where tipe<>''";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $value) {
				echo "<option value='".$value->tipe."'>".$value->tipe."</option>";
			}
		}else{
			echo "<option value=''>Pilih Rating</option>";
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
		$config['max_size']	= '10000';
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
		$config['max_size']	= '1000';
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