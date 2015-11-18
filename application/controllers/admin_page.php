<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_page extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		
		if(! $this->session->userdata('logged_in')){
			redirect('login');
		}
    }
	
	public function index()
	{	
		echo "Admin_page<pre><a href='login/logout'>Logout</a>";
		
		print_r($this->session->all_userdata());
		
	}
	
}
