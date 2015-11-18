<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		$this->load->model('Users_model', 'mdl');
		$this->load->model('Realdream_model', 'r_mdl');
		$this->load->helper(array('url'));
		
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
		
			// $this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required|min_length[5]|max_length[32]|alpha_dash|is_unique[pengguna.nama_pengguna]');
			$this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'required|alpha_dash');
			$this->form_validation->set_rules('ukata_sandi', 'Konfirmasi Kata Sandi', 'required|alpha_dash|matches[kata_sandi]');			
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('nomor_id', 'Nomor ID', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');

			if ($this->form_validation->run() == FALSE){
				$data['content'] = 'users/add';
				$this->load->view('layout/template_admin2',$data);
			}else{
				$post['tipe'] = 'enginer';
				$post['tanggal_dibuat'] = date('Y-m-d');
				$post['dibuat_oleh'] = $post['nama'];
				$post['kata_sandi'] = md5($post['kata_sandi']);
				$this->db->insert('pengguna',$post);
				$this->session->set_flashdata('message', 'Success Registration');
				redirect('');
			}
		}else{
			$data['content'] = 'users/add';
			$this->load->view('layout/template_admin2',$data);
		}
	}

	function daftarnama()
	{
		$get = ($this->input->get());
		$id = $get['id'];
		$sql = "select nama from karyawan where nomor_id='$id'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $value)
			{
				echo $value->nama;
			}
			
		}
	}

	function daftarunit()
	{
		$get = ($this->input->get());
		$id = $get['id'];
		$sql = "select unit from karyawan where nomor_id='$id'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $value)
			{
				echo $value->unit;
			}
			
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

}
