<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Login_model', 'mdl');
    }

	public function index()
	{
		$data['desc_table'] = $this->desc_table('pengguna');
		if($this->input->post('submit')<>''){
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('kata_sandi', 'Password', 'required|alpha_dash');

			if ($this->form_validation->run() == FALSE){
				$data['content'] = 'welcome_message';
				$this->load->view('layout/template',$data);
			}
			else{
				$username = $this->input->post('email');
				$password = md5($this->input->post('kata_sandi'));
				
				$get_users = $this->mdl->get_users($username,$password);
				if(count($get_users) > 0 ){
					if($get_users['tanda_hapus'] == 0){
						if($get_users['tanda_aktif'] == 1){							
							$this->session->set_userdata('logged_in',true);
							$this->session->set_userdata('users',$get_users);
							if($this->session->userdata('users')['tipe']=='admin'){
								redirect('dashboard/admin');
							}else{
								redirect('dashboard');
							}
						}
						else{
							$this->session->set_flashdata('message', 'Account not activated');
							redirect('');					
						}
					}
					else{
						$this->session->set_flashdata('message', 'Account has been deleted');
						redirect('');					
					}
				}
				else{
					$this->session->set_flashdata('message', 'Account not found');
					redirect('');
				}
			}
		}	
		else{
			if($this->session->userdata('users')['tipe']=='admin' && $this->session->userdata('logged_in')==true){
				redirect('dashboard/admin');
			}else if($this->session->userdata('users')['tipe']!='admin' && $this->session->userdata('logged_in')==true){
				redirect('dashboard');
			}else{
				$data['content'] = 'welcome_message';
				$this->load->view('layout/template',$data);
			}
		}
	}
	
	public function desc_table($tbl)
	{
		$fields = $this->db->field_data($tbl);
		foreach($fields as $val){
			$fields2[($val->name)] = (array) $val;
		}
		return $fields2;	
	}
	
	public function logout(){
	
		$this->session->sess_destroy();
		redirect('');
	
	}
	
	function test(){
		$this->load->view('test');
	}
}