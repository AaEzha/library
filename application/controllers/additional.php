<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Additional extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('additional_model', 'mdl');
    }

	public function index()
	{
		$this->db->order_by("id_initial", "desc");
		$this->db->limit(1);
		$query = $this->db->get("initial");
		$data = $query->result_array();
		$data[0]['status'];

		
		$fields = $this->db->field_data('additional');
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
			}else{
				$post['id_pengguna'] = $this->session->userdata('users')['id_pengguna'];
				$data = $this->mdl->getLastId($post['id_pengguna']);
				if(($data['status']!=0 && $data['id_additional_desk_assesment']!="")||(count($data)==0)){
					$this->db->insert('additional',$post);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
					redirect( 'additional_desk_assesment/'. strtolower(__FUNCTION__).'/'.$this->db->insert_id() );
				}else if($data['status']==0 && $data['id_additional_desk_assesment']==""){
					redirect( 'additional_desk_assesment/'. strtolower(__FUNCTION__).'/'.$data['id_additional']);
				}else{
					echo "<script>
							alert('Data masih diproses');
							window.location.replace('".base_url()."');
						</script>";
				}
			}
		}		
		else{
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
		$data = $this->mdl->getById($id);
		if($this->input->post('submit')<>''){
			$this->form_validation->set_rules('certificate_legalisir', 'Certificate Legalisir', 'required');
			if ($this->form_validation->run() == FALSE){
				$data['data'] = $this->mdl->getById($id);
				$data['content'] = 'additional_desk_assesment/'. strtolower(__FUNCTION__);
				$this->load->view('layout/template_admin',$data);
			}else{
				$post = ($this->input->post());
				unset($post['process']);
				unset($post['submit']);
				$status = $post["certificate_legalisir"]=="true"?"1":"2";
				$post["tanggal_selesai"] = date("Y-m-d H:i:s");
				$this->db->where("id_additional",$id);
				$this->db->update("additional_desk_assesment",$post);
				if($post["certificate_legalisir"]=="true" && $post["cost_check"]!=""){
					send_email($data['nama'], $data['email'], "done", "Additional");
				}
				$post_additional["cost_check"] = $post["cost_check"];
				$post_additional["status"] = $status;
				$this->db->where("id_additional",$id);
				$this->db->update("additional",$post_additional);
				redirect(strtolower(__CLASS__) ."/data");
			}
		}else if($this->input->post('process')){
			$post = ($this->input->post());
			unset($post['process']);
			unset($post['submit']);
			$post["certificate_legalisir"] = '3';
			$post["tanggal_diproses"] = date("Y-m-d H:i:s");
			$status = $post["certificate_legalisir"];
			$this->db->where("id_additional",$id);
			$this->db->update("additional_desk_assesment",$post);
			send_email($data['nama'], $data['email'], "process", "Additional");
			$post_additional["status"] = $status;
			$this->db->where("id_additional",$id);
			$this->db->update("additional",$post_additional);
			redirect(strtolower(__CLASS__) ."/data");
		}else{
			$data['data'] = $this->mdl->getById($id);
			$data['content'] = 'additional_desk_assesment/'. strtolower(__FUNCTION__);
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