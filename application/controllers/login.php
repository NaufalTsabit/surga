<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('petugas_model','log_model'));

        if($this->session->userdata('data_petugas')){
            $data_petugas = $this->session->userdata('data_petugas');

            

            
                if($data_petugas['role'] == '4')
                {
                    redirect('admin');
                }
                else
                {
                    redirect('petugas');
                }
            
           
        }
       

        
    }

    public function index()
    {
        $data = array();
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->petugas_model->login($username, $password)) {
                $this->log_model->set_log("Login");

                $data_petugas = $this->session->userdata('data_petugas');

                if($data_petugas['role'] == '4')
                {
                    redirect('admin');
                }
                else
                {
                    redirect('petugas');
                }

            } else {
                redirect('login');
            }
        } else {
            $this->template->display('login', $data);
        }
    }
}