<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('petugas_model','log_model'));
	}

	public function index()
	{
		//if($this->session->userdata('data_petugas'))
			//$this->log_model->set_log("Logout");
		$this->session->sess_destroy();
		
		redirect('login');
	}
}
