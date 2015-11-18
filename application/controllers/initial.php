<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initial extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->model('initial_model', 'mdl');
    }

	public function index()
	{
		$fields = $this->db->field_data('initial');
		foreach($fields as $val){
			$fields2[($val->name)] = (array) $val;
		}
		$data['desc_table'] = $fields2;
		$data['error'] = '';
		if($this->input->post('submit')<>''){
			$post = ($this->input->post());
			unset($post['submit']);
			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('nomor_id', 'ID Number', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('nomor_telpon', 'Phone/Number', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			} else {
				$post['id_pengguna'] = $this->session->userdata('users')['id_pengguna'];
				$post['tanggal_dibuat'] = date('Y-m-d H:i:s');
				$post['dibuat_oleh'] = $post['nama'];
				$data = $this->mdl->getLastId($post['id_pengguna']);
				if(($data['status']!=0 && $data['id_initial_desk_assesment']!="")||(count($data)==0)){
					$this->db->insert('initial',$post);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
					redirect( 'initial_desk_assesment/'. strtolower(__FUNCTION__).'/'.$this->db->insert_id() );
				}else if($data['status']==0 && $data['id_initial_desk_assesment']==""){
					redirect( 'initial_desk_assesment/'. strtolower(__FUNCTION__).'/'.$data['id_initial']);
				}else{
					echo "<script>
							alert('Data masih diproses');
							window.location.replace('".base_url()."');
						</script>";
				}
			}
		} else {
			$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
			$this->load->view('layout/template_admin',$data);
		}
	}

	public function data()
	{
		$data['data'] = $this->mdl->get_data();
		$data['content'] = strtolower(__CLASS__) .'/'. strtolower(__FUNCTION__);
		$this->load->view('layout/template_admin',$data);
	}
	
	public function update($id)
	{
		if($this->input->post('submit')<>''){
			$this->form_validation->set_rules('certificate_legalisir', 'Certificate Legalisir', 'required');
			if ($this->form_validation->run() == FALSE){
				$data['data'] = $this->mdl->getById($id);
				$data['content'] = 'initial_desk_assesment/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			}else{
				$post = ($this->input->post());
				$data = $this->mdl->getById($id);
				unset($post['process']);
				unset($post['submit']);
				$status = $post["certificate_legalisir"]=="true"?"1":"2";
				$post["tanggal_selesai"] = date("Y-m-d H:i:s");
				if($post["certificate_legalisir"]=="true" && $post["cost_check"]!=""){
					send_email($data['nama'], $data['email'], "done", "Initial");
				}
				$this->db->where("id_initial",$id);
				$this->db->update("initial_desk_assesment",$post);	

				$post_initial["cost_check"] = $post["cost_check"];
				$post_initial["status"] = $status;
				$this->db->where("id_initial",$id);
				$this->db->update("initial",$post_initial);
				redirect(strtolower(__CLASS__) ."/data");
			}			
		}else if($this->input->post('process')){
			$post = ($this->input->post());
			$data = $this->mdl->getById($id);
			/*
			 echo "<pre>";
			 print_r($post);
			 print_r($this->session->userdata('users')['nama']);
			 die;
			//*/
			unset($post['ap_list']);
			unset($post['process']);
			unset($post['submit']);
			unset($post['reject']);

			$post["tanggal_diproses"] = date("Y-m-d H:i:s");

			$post["tanggal_diperbarui"] = date('Y-m-d H:i:s');
			$post["diperbarui_oleh"] = $this->session->userdata('users')['nama'];
			$status = "3";
			$this->db->where("id_initial",$id);
			$this->db->update("initial_desk_assesment",$post);	

			$post_initial["status"] = $status;
			$this->db->where("id_initial",$id);
			$this->db->update("initial",$post_initial);
			send_email($data['nama'], $data['email'], "process", "Initial");
			redirect(strtolower(__CLASS__) ."/data");
		}else if($this->input->post('reject')){
			$post = ($this->input->post());
			$data = $this->mdl->getById($id);

			unset($post['submit']);
			unset($post['process']);
			unset($post['reject']);

			$post["tanggal_diperbarui"] = date('Y-m-d H:i:s');
			$post["diperbarui_oleh"] = $this->session->userdata('users')['nama'];

			$post["certificate_legalisir"] = '2';
			$post["tanggal_diproses"] = date("Y-m-d H:i:s");
			$status = $post["certificate_legalisir"];
			$this->db->where("id_initial",$id);
			$this->db->update("initial_desk_assesment",$post);	

			$post_initial["status"] = $status;
			$this->db->where("id_initial",$id);
			$this->db->update("initial",$post_initial);
			//send_email($data['nama'], $data['email'], "process", "Initial");
			redirect(strtolower(__CLASS__) ."/data");
			 echo "<pre>";
			 print_r($post);
			 print_r($this->session->userdata('users')['id_pengguna']);
			 die;
		}else{
			$data['data'] = $this->mdl->getById($id);
			$data['content'] = 'initial_desk_assesment/'. strtolower(__FUNCTION__);
			$this->load->view('layout/template_admin',$data);
		}
	}
	
	public function delete($id)
	{
		$delete = $this->mdl->delete($id);
		if($delete){
			redirect(strtolower(__CLASS__)."/data");
		}else{
			echo "<script>alert('Delete data gagal');</script>";
			redirect(strtolower(__CLASS__)."/data");
		}
	}
}