<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		if (!$this->session->userdata('data_petugas')) redirect('login');
        $data_petugas = $this->session->userdata('data_petugas');
        if ($data_petugas['id_role'] != '2') redirect('login');
		$this->load->model(array('petugas_model'));
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        redirect('departemen/dashboard');
    }

    public function dashboard()
    {

    }

    public function manajemen_user()
    {
        try{
            $crud = new grocery_CRUD();
            $data_petugas = $this->session->userdata('data_petugas');

            $crud->where('departemen', $data_petugas['id_departemen']);
            $crud->set_table('petugas');
            $crud->set_subject('Petugas');
            $crud->set_relation('departemen', 'departemen', 'nama_departemen', array('id_departemen' => $data_petugas['id_departemen']));
            $crud->set_relation('role', 'role', 'nama_role', 'id_role = 2 or id_role = 3');
            $crud->change_field_type('bisa_sms', 'true_false', array('Tidak', 'Ya'));
            $crud->unset_fields('bisa_sms');
            $crud->unset_columns('bisa_sms');
            $crud->display_as('username_petugas','Username');
            $crud->display_as('password_petugas','Password');
            $crud->display_as('nama_petugas','Nama');
            $crud->display_as('email_petugas','Email');
            $crud->display_as('no_hp_petugas','No HP');
            $crud->display_as('jobdesc_petugas','Dekripsi Kerja');
            $crud->display_as('departemen','Departemen');
            $crud->display_as('role','Jabatan');

            $output = $crud->render();
            $this->template->display('blank', (array)$output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
}
