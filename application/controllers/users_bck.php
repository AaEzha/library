<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		$this->load->model('Users_model', 'mdl');
		$this->load->model('Realdream_model', 'r_mdl');
		
    }	
	
	public function add()
	{	
		error_reporting(E_ALL ^ E_NOTICE);
		// echo "<pre>";
						
		$fields = $this->db->field_data('pengguna');
		foreach($fields as $val){
			$fields2[($val->name)] = (array) $val;
		}
		$data['desc_table'] = $fields2;
		$data['error'] = '';
		
		
		
		
		
		if($this->input->post('submit')<>''){
			$post = ($this->input->post());
			unset($post['submit']);
			unset($post['ukata_sandi']);
			unset($post['uemail']);
		
			$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required|min_length[5]|max_length[12]|alpha_dash|is_unique[pengguna.nama_pengguna]');
			$this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'required|alpha_dash');
			$this->form_validation->set_rules('ukata_sandi', 'Konfirmasi Kata Sandi', 'required|alpha_dash|matches[kata_sandi]');			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
			$this->form_validation->set_rules('uemail', 'Konfirmasi Email', 'required|valid_email|matches[email]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');
			$this->form_validation->set_rules('tentang_saya', 'Tentang Saya', 'max_length[12]');

			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = 'users/add';
				$this->load->view('layout/template_admin2',$data);
			}
			else
			{
				$upload = $this->upload();
				if($upload['status'] <> '0'){
					if($upload['status'] == '1'){
						$post['foto'] = $upload['message']['file_name'];		
					}										
					$this->db->insert('pengguna',$post);
					$this->session->set_flashdata('message', 'Success');
					redirect('users/add');
				}
				else{
					$this->session->set_flashdata('message', $upload['message']['error']);
					redirect('users/add');
				}
			}
				
			
			
		}		
		else{
			$data['content'] = 'users/add';
			$this->load->view('layout/template_admin2',$data);
		}
	}
	
	function upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			if(strip_tags($error['error']) == 'You did not select a file to upload.'){
				return array('status'=>'2','message'=>'');
			}
			else{
				return array('status'=>'0', 'message'=>$error);
			}			
		}
		else
		{
			return array('status'=>'1', 'message'=>$this->upload->data());
		}
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
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
	
	function email_test(){
		

		// mail("andyrienauld@gmail.com", "Subject Test11","Comment test11", "From: andyrienauld@gmail.com" );	
		$this->load->library('email');

		$this->email->from('andyrienauld@gmail.com', 'Your Name');
		$this->email->to('andyrienauld@gmail.com');
		$this->email->cc('andyrienauld@gmail.com');
		$this->email->bcc('andyrienauld@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();
		
		echo "Email test";
	}
}
