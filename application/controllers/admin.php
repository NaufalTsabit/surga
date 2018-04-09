<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if ($this->session->userdata('data_petugas')['role'] != '4' ) redirect('login');
        $this->load->model(array('petugas_model','log_model','departemen_model','pengaturan_model','kategori_model'));
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');

    }

    public function index()
    {
        //$coba = "asd";
        redirect('admin/dashboard');
    }

    public function kategori()
    {
        UserAuth::cek_authorize($this);
		
        if(isset($_POST["add"])) 
        {
            $data = $this->input->post();
            unset($data['add']);

            $id_kategori = $this->kategori_model->tambah_kategori($data);
            $this->log_model->set_log("menambah kategori $id_kategori");
            redirect('admin/kategori');
        }
        else if(isset($_POST["edit"])) 
        {
            $data = $this->input->post();
            $id_kategori = $this->input->post("id_kategori");
            unset($data['edit']);

            $status = $this->kategori_model->update_kategori($id_kategori, $data);
            $this->log_model->set_log("mengupdate kategori $id_kategori");
            redirect('admin/kategori');
        }
        else if(isset($_POST["delete"])) 
        {
            $id_kategori = $this->input->post("id_kategori");
            $this->kategori_model->hapus_kategori($id_kategori);            
            $this->log_model->set_log("menghapus kategori $id_kategori");
            redirect('admin/kategori');
        }
        else
        {
            $this->log_model->set_log("melihat manajemen kategori");
            $data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_kategori'] = $this->kategori_model->get_all();

            $this->template->display_full('admin/kategori', $data);
            
        }
        
    }

    public function dashboard($tahun = 0)
    {
        //UserAuth::cek_authorize($this);
        $this->log_model->set_log("melihat dashboard");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
        $data['list_aduan'] = $this->petugas_model->all_aduan();

        if($tahun == 0)
        {
            $tahun = date('Y');
        }

        $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun- 1);
        //$data['coba'] = 0;

        $data['tahun_ini'] = $tahun;
        //echo $data['temp'];
        $this->template->display_full('admin/dashboard', $data);
    }

    public function user()
    {
        UserAuth::cek_authorize($this);

       // redirect('admin/user2');       
     //   $data = array();

        if(isset($_POST["add"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            unset($data['add']);
            unset($data['app']);

            $id_petugas = $this->petugas_model->tambah_petugas($data);

           // echo $id_petugas;
            $dataApp = array();

            foreach($_POST['app'] as $selected){
                //echo $selected."</br>";

                
                $dataApp['id_user_app'] = $selected - 1;
                $dataApp['id_app'] = $selected;
                $dataApp['petugas'] = $id_petugas;
                //echo $dataApp['id_user_app'];
                $this->petugas_model->tambah_app($dataApp);

            }
            // dummy
            $dataApp['id_user_app'] = 0;
            $dataApp['id_app'] = 1;
            $dataApp['petugas'] = $id_petugas;
               
            $this->petugas_model->tambah_app($dataApp);

            //////////////
            $this->log_model->set_log("menambah Petugas $id_petugas");
            //print_r($data);
            //$status = $this->petugas_model->tambah_petugas($data);
            redirect('admin/user');
        }
        else if(isset($_POST["edit"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            $id_petugas = $this->input->post("id_petugas");
            //echo $id_departemen;
            unset($data['edit']);
            unset($data['id_petugas']);
            unset($data['app']);

            $status = $this->petugas_model->update_petugas($id_petugas, $data);

            $this->petugas_model->hapus_app($id_petugas);

            $dataApp = array();
             foreach($_POST['app'] as $selected){

                $dataApp['id_user_app'] = $selected - 1;
                $dataApp['id_app'] = $selected;
                $dataApp['petugas'] = $id_petugas;

                $this->petugas_model->tambah_app($dataApp);
            }
            $this->log_model->set_log("mengupdate Petugas $id_petugas");
            redirect('admin/user');
        }
        else if(isset($_POST["delete"])) 
        {
            
            //echo $data['nama_departemen'];
            $id_petugas = $this->input->post("id_petugas");
            $this->petugas_model->hapus_all_app($id_petugas);
            $this->petugas_model->hapus_petugas($id_petugas);
            
            $this->log_model->set_log("menghapus Petugas $id_petugas");
            redirect('admin/user');
        }
        else
        {
            $this->log_model->set_log("melihat manajemen Petugas");
            $data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_petugas'] = $this->petugas_model->get_all_petugas();
            $data['list_departemen'] = $this->departemen_model->get_all();
            $data['list_role'] = $this->petugas_model->get_role();
            $data['list_app'] = $this->petugas_model->get_app();
            $data['list_user_app'] = $this->petugas_model->get_user_app();

            $this->template->display_full('admin/user', $data);
            
        }
        
    }

    public function departemen()
    {
        UserAuth::cek_authorize($this);
        $data = array();
        $data['nama_departemen'] = '';
        if(isset($_POST["add"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            $this->log_model->set_log("menambah departemen");
            unset($data['add']);
            $status = $this->departemen_model->tambah_departemen($data);
            redirect('admin/departemen');
        }
        else if(isset($_POST["edit"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            $id_departemen = $this->input->post("id_departemen");
            //echo $id_departemen;
            $this->log_model->set_log("mengedit departeman $id_departemen");
            unset($data['edit']);
            unset($data['id_departemen']);
            $status = $this->departemen_model->update_departemen($id_departemen, $data);
            redirect('admin/departemen');
        }
        else if(isset($_POST["delete"])) 
        {
            
            //echo $data['nama_departemen'];
            $id_departemen = $this->input->post("id_departemen");
            $this->log_model->set_log("menghapus departeman $id_departemen");
            $status = $this->departemen_model->hapus_departemen($id_departemen);
            redirect('admin/departemen');
        }
        else
        {
            $this->log_model->set_log("melihat departeman");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_departemen'] = $this->departemen_model->get_all();

            
            $data['list_departemen2'] = array();
            $konten_dept = array();
            foreach ($data['list_departemen'] as $key => $value)
            {
                $konten_dept['id_departemen'] = $value['id_departemen'];
                $konten_dept['nama_departemen'] = $value['nama_departemen'];
                $konten_dept['nama_kepala'] = $value['nama_kepala'];
                $konten_dept['no_hp'] = $value['no_hp'];
                $konten_dept['apakah_mitra'] = $value['apakah_mitra'];
                $konten_dept['induk_departemen'] = $value['induk_departemen'];

                $nama_induk = $this->departemen_model->get_nama_departemen($value['induk_departemen']);

                if($nama_induk == null || $nama_induk == 'Semua')
                {
                    $konten_dept["nama_induk"] = "-";
                }
                else
                {
                    $konten_dept["nama_induk"] = $nama_induk;
                }
                array_push($data['list_departemen2'], $konten_dept);
                
            }
            //print_r($data['list_departemen2']);
            //echo $data['temp'];
            $this->template->display_full('admin/departemen', $data);
        }
       
    }

    public function pengaturan()
    {
        //redirect('admin/option');
        $data = array();

        if(isset($_POST["notif"])) 
        {
            redirect('admin/notifikasi');
        }
        else if(isset($_POST["option"])) 
        {
            redirect('admin/option');
        }
        else if(isset($_POST["option_jawaban"])) 
        {
            redirect('admin/option_jawaban');
        }
        else if(isset($_POST["maintance"])) 
        {
            redirect('admin/maintance');
        }
        else
        {
            $this->log_model->set_log("melihat pengaturan");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            //$data['nilai_option'] = $this->pengaturan_model->get_value(1);

           // echo $data['nilai_option'];
            $this->template->display_full('admin/pengaturan', $data);
        }

    }

    public function maintance()
    {
        //UserAuth::cek_authorize($this);
        $data = array();

        if(isset($_POST["update"])) 
        {
            $this->log_model->set_log("Mengupdate Maintance");
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            unset($data['update']);
            $status = $this->pengaturan_model->update_option(3,$data);

            redirect('admin/pengaturan');
        }
        else
        {
            $this->log_model->set_log("melihat Pengaturan Maintance");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['nilai_option'] = $this->pengaturan_model->get_value(3);
            $data['info_option'] = $this->pengaturan_model->get_info(3);

           // echo $data['nilai_option'];
            $this->template->display_full('admin/maintance', $data);
        }
    }

    public function notifikasi()
    {
       // UserAuth::cek_authorize($this);
        //UserAuth::cek_authorize($this);
        
        $data = array();


        if(isset($_POST["add"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];

            //echo $data['tgl_start_notif'];
            $this->log_model->set_log("menambah data notifikasi");
            unset($data['add']);
            $status = $this->pengaturan_model->tambah_notifikasi($data);

            redirect('admin/notifikasi');
        }
        else if(isset($_POST["edit"])) 
        {
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            $id_pengaturan = $this->input->post("id_pengaturan");
            //echo $id_departemen;
            $this->log_model->set_log("mengedit data $id_pengaturan");
            unset($data['edit']);
            unset($data['id_pengaturan']);
            $status = $this->pengaturan_model->update_notifikasi($id_pengaturan, $data);
            redirect('admin/notifikasi');
        }
        else if(isset($_POST["delete"])) 
        { 
            
            $id_pengaturan = $this->input->post("id_pengaturan");

            $this->log_model->set_log("menghapus data $id_pengaturan");

            $status = $this->pengaturan_model->hapus_notifikasi($id_pengaturan);
            redirect('admin/notifikasi');
        }
        else
        {
            $this->log_model->set_log("melihat notifikasi");
            //$data = array();
            //$data['js_files'] = array('assets/new/js/bootstrap-datetimepicker.min.js','assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            //$data['css_files'] = array('assets/new/css/bootstrap-datetimepicker.min.css','assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            
            $data['js_files'] = array('assets/timepicker/jquery.timepicker.min.js','assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/timepicker/jquery.timepicker.css','assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            


            //$data['nilai_option'] = $this->pengaturan_model->get_value(1);
            $data['list_notif'] = $this->pengaturan_model->get_all_notifikasi();
            //echo $data['list_notif'];
            $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $data['tgl_skr'] = $dt->format('Y-m-d');
            
            $this->template->display_full('admin/notifikasi', $data);
        }
    }

    
    public function option()
    {
        //UserAuth::cek_authorize($this);
        $data = array();

        if(isset($_POST["update"])) 
        {
            $this->log_model->set_log("Mengedit option SMS Gateway");
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            unset($data['update']);
            $status = $this->pengaturan_model->update_option(1,$data);

            redirect('admin/pengaturan');
        }
        else
        {
            $this->log_model->set_log("melihat Option SMS Gateway");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['nilai_option'] = $this->pengaturan_model->get_value(1);

           // echo $data['nilai_option'];
            $this->template->display_full('admin/option', $data);
        }
    }

    public function option_jawaban()
    {
        //UserAuth::cek_authorize($this);
        $data = array();

        if(isset($_POST["update"])) 
        {
            $this->log_model->set_log("Mengedit option Menjawab Aduan");
            $data = $this->input->post();
            //echo $data['nama_departemen'];
            unset($data['update']);
            $status = $this->pengaturan_model->update_option(2,$data);

            redirect('admin/pengaturan');
        }
        else
        {
            $this->log_model->set_log("melihat Option Menjawab Aduan");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['nilai_option'] = $this->pengaturan_model->get_value(2);

           // echo $data['nilai_option'];
            $this->template->display_full('admin/option_jawaban', $data);
        }
    }

    public function aktivitas()
    {
        UserAuth::cek_authorize($this);

        $data = array();


        if(isset($_POST["deleteAll"])) 
        { 

            $status = $this->log_model->hapus_all_log();
            $this->log_model->set_log("menghapus Semua data Aktivitas");
            redirect('admin/aktivitas');
        }
        else if(isset($_POST["delete"])) 
        { 
            
            $id_aktivitas = $this->input->post("id_aktivitas");

            $this->log_model->set_log("menghapus data $id_aktivitas");

            $status = $this->log_model->hapus_log($id_aktivitas);
            redirect('admin/aktivitas');
        }
        else
        {
            $this->log_model->set_log("melihat aktivitas/log");
            //$data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            //$data['nilai_option'] = $this->pengaturan_model->get_value(1);
            $data['list_aktivitas'] = $this->log_model->get_all();
           // echo $data['nilai_option'];
            $this->template->display_full('admin/log', $data);
        }
    }

/*
       // manajemen petugas
    public function user2()
    {
        UserAuth::cek_authorize($this);
        $this->log_model->set_log("melihat Pengaturan user");
        try{
            $crud = new grocery_CRUD();
            $crud->set_table('petugas');
            $crud->set_subject('Petugas');
            $crud->set_relation('departemen', 'departemen', 'nama_departemen');
            $crud->set_relation('role', 'role', 'nama_role');
            $crud->change_field_type('bisa_sms', 'true_false', array('Tidak', 'Ya'));
            $crud->set_relation_n_n('Aplikasi', 'user_app', 'all_app', 'petugas', 'id_app', 'desc_app','id_user_app');
            

            $crud->callback_column('departemen', array($this, '_full_text_Departemen'));
            $crud->callback_column('Aplikasi', array($this, '_full_text_Aplikasi'));


            $crud->display_as('username_petugas','Username');
            $crud->display_as('password_petugas','Password');
            $crud->display_as('nama_petugas','Nama');
            $crud->display_as('email_petugas','Email');
            $crud->display_as('no_hp_petugas','No HP');
            $crud->display_as('jobdesc_petugas','Dekripsi Kerja');
            $crud->display_as('departemen','Departemen');
            $crud->display_as('role','Jabatan');


            $crud->unset_fields('bisa_sms');          
            $crud->unset_columns('bisa_sms');
            //$crud->unset_columns('bisa_sms');
            //$crud->display_as('"abscdasd"');
            // $coba = "asdasd";

            $output = $crud->render();
            $this->template->display_full('admin/user', (array)$output);


        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    public function aktivitas2()
    {
        UserAuth::cek_authorize($this);
        $this->log_model->set_log("melihat aktivitas/log");
        try{
            
            $crud = new grocery_CRUD();

            $crud->set_table('aktivitas');
            $crud->set_subject('Aktivitas');


            $crud->set_relation('id_petugas', 'petugas', 'username_petugas');

            $crud->columns('tanggal_aktivitas','waktu_aktivitas','id_petugas','nama_user','nama_aktivitas');

            $crud->display_as('tanggal_aktivitas','Tanggal');
            $crud->display_as('waktu_aktivitas','Pukul');

          
            $crud->display_as('id_petugas','ID Petugas');
            $crud->display_as('nama_user','Nama Petugas');
            
            $crud->display_as('nama_aktivitas','Aktivitas');

            //$crud->set_add_value
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $output = $crud->render();
            $this->template->display('blank', (array)$output);

            
        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function _full_text_Aplikasi($value, $row)
    {
        return $value = wordwrap($row->Aplikasi, 30, "<br>", true);
    }

    function _full_text_Departemen($value, $row)
    {
        return $value = wordwrap($row->departemen, 5, "<br>", true);
    }


    function amount_callback($post_array) {
        
        $pass = $post_array['password_petugas'];
        $val_pass = $post_array['validasi'];

        $post_array['email_petugas'] = $pass;
        $post_array['jobdesc_petugas'] = $val_pass;

        unset($post_array['validasi']);
          
        return $post_array;
       

    }
*/
    /*
    public function dashboard2($tahun)
    {
        UserAuth::cek_authorize($this);

        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
        $data['list_aduan'] = $this->petugas_model->all_aduan();

        $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);


        $data['tahun_ini'] = $tahun;

        $this->template->display_full('admin/dashboard', $data);
    }
*/
/*
    public function departemen2()
    {
        UserAuth::cek_authorize($this);
        try{
            $this->log_model->set_log("melihat departement");
            $crud = new grocery_CRUD();
            $crud->set_table('departemen');
            $crud->set_subject('Departemen');
            $crud->change_field_type('apakah_mitra', 'true_false', array('Tidak', 'Ya'));
            $crud->display_as('nama_departemen','Nama Departemen');

            $output = $crud->render();
            $this->template->display('blank', (array)$output);

        } catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
*/

}
