<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aduan extends CI_Controller {

	// fungsi construct
	public function __construct()
    {
		parent::__construct();
		$this->load->model(array('aduan_model', 'departemen_model', 'sms_model', 'log_model', 'petugas_model','pengaturan_model'));
		$this->load->library('form_validation');
		$this->load->library('Curl');
    }

    // awal kali masuk halaman, controller akan masuk dan melihat index terlebih dahulu
    public function index()
    {
    	redirect('aduan/buat');
    }



	public function baru()
	{
		$data = array();
		$js_files = array('assets/js/bootstrap-datepicker.js', 'https://maps.googleapis.com/maps/api/js?sensor=false', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
		$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
		$data['js_files'] = $js_files;
		$data['css_files'] = $css_files;
		$data['departemen'] = $this->departemen_model->get_all();
		$this->template->display('aduan/aduan_baru', $data);
	}

	// fungsi untuk membuat aduan
	public function buat()
	{
		$data = array();
		$data['cur_page'] = '1';
		$data['landing_topik'] = 'topik aduan';
		$data['landing_departemen'] = '';
		$data['landing_isi'] = '';
		$data['nama'] = '';
		$data['alamat'] = '';
		$data['no_hp'] = '';
		$data['email'] = '';
		$data['day'] = '';
		$data['tgl_lahir'] = '';
		$data['flag'] = 0;
		$data['maintance'] = $this->pengaturan_model->get_value(3);
		$data['info_maintance'] = $this->pengaturan_model->get_info(3);

		if ($this->session->flashdata('departemen') && $this->session->flashdata('topik') && $this->session->flashdata('isi')) {
			$data['landing_topik'] = $this->session->flashdata('topik');
			$data['landing_departemen'] = $this->session->flashdata('departemen');
			$data['landing_isi'] = $this->session->flashdata('isi');
			$data['cur_page'] = '2';
		}
		$js_files = array('assets/new/js/jquery.easing.min.js', 'assets/js/bootstrap-datepicker.js', 'http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
		$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css', 'assets/new/css/aduan.css');

		$data['js_files'] = $js_files;
		$data['css_files'] = $css_files;
		$data['departemen'] = $this->departemen_model->get_all();
		$data['no_identitas'] = $this->aduan_model->get_all();
		//$data['nama'] = "asdasdsa";
		//$this->template->display('aduan/tambah_aduan', $data);
		$this->template->display('aduan/tambah_aduan', $data);
	}

	public function add_landing()
	{
		if ($this->input->post()) {
			$data = array();
			$this->form_validation->set_rules('topik', 'Topik', 'trim|required');
			$this->form_validation->set_rules('isi', 'Isi Aduan', 'trim|required');
			$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
			$this->form_validation->set_message('required', '%s belum diisi');

			if ($this->form_validation->run() == FALSE) {
				$js_files = array('assets/new/select2/select2.min.js');
				$css_files = array('assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
				$this->form_validation->set_error_delimiters('', '');
				$data['error'] = validation_errors();
				$data['js_files'] = $js_files;
				$data['css_files'] = $css_files;
				$data['departemen'] = $this->departemen_model->get_all();
				$this->template->display('aduan/landing_page', $data);
				return;
			}
			$this->session->set_flashdata('departemen', $this->input->post('departemen'));
			$this->session->set_flashdata('topik', $this->input->post('topik'));
			$this->session->set_flashdata('isi', $this->input->post('isi'));
			redirect('aduan/buat');
		} else {
			redirect('aduan');
		}
	}

	public function beranda()
	{
		$data = array();
		$js_files = array('assets/new/select2/select2.min.js');
		$css_files = array('assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
		$data['js_files'] = $js_files;
		$data['css_files'] = $css_files;
		$data['departemen'] = $this->departemen_model->get_all();
		$this->template->display('aduan/landing_page', $data);
	}

	public function add()
	{
		
		if ($this->input->post()) {

			$data = array();
			$data['cur_page'] = '1';
			$data['landing_topik'] = 'topik aduan';
			$data['landing_departemen'] = '';
			$data['landing_isi'] = '';
			$data['uploaded_file'] = array();
			$data['nama'] = '';
			$data['alamat'] = '';
			$data['no_hp'] = '';
			$data['email'] = '';
			$data['flag'] = 1;
			$data['tgl_lahir'] = '';
			$data['maintance'] = $this->pengaturan_model->get_value(3);
			$data['info_maintance'] = $this->pengaturan_model->get_info(3);
			//$data['day'] = '';
			//$data['tgl_lahir'] = '';
			if(isset($_POST["reset"])){

				redirect('aduan/buat');
			}
			else if(isset($_POST["cek_ktp"])){
				
				//$data['nama'] = '';

				$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required|exact_length[16]|numeric|callback_ktp_kediri_identitas');
				$this->form_validation->set_message('ktp_kediri_identitas', '%s anda tidak ditemukan/sesuai dengan data kami. Pastikan isian NIK, Nama, dan Tanggal Lahir sesuai dengan KTP anda');
				$this->form_validation->set_message('required', '%s belum diisi');
				//$this->form_validation->set_message('valid_email', 'Email anda tidak valid');
				$this->form_validation->set_message('numeric', '%s harus angka');
				//$this->form_validation->set_message('tgl_lahir', 'Tanggal Lahir tidak valid');
				$this->form_validation->set_message('exact_length', '%s KTP harus %s karakter');
				$this->form_validation->set_rules('topik', 'Topik', 'trim|required');
				$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
				$this->form_validation->set_rules('isi', 'Isi Pengaduan', 'trim|required');
				//$this->form_validation->set_message('nama', '%s harus huruf alfabet');
				//$this->template->display('aduan/tambah_aduan', $data);
				//unset($data['nama']);
				$data['flag'] = 0;
				if ($this->form_validation->run() == TRUE) {
		
					
            		//$data['tgl_lahir'] = $data_db['tgl_lhr'];
            		$js_files = array('assets/new/js/jquery.easing.min.js', 'assets/js/bootstrap-datepicker.js', 'http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
					$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css', 'assets/new/css/aduan.css');
					$data['js_files'] = $js_files;
					$data['css_files'] = $css_files;
					$data['departemen'] = $this->departemen_model->get_all();
					
					//$data['nama'] = 'ASDW';
					$data['cur_page'] = '2';
					$data['no_identitas'] = $this->input->post('no_identitas');
					$data_db = array();
					$data_db = $this->aduan_model->cek_ktp_identitas($data['no_identitas']);
            		$data['nama'] = $data_db['nama_lgkp'];
            		
            		//$data['alamat'] = $data_db['alamat'];
            		//$data['no_hp'] = $data_db['month'];
            		//$data['email'] = $data_db['year'];
            		//$data['day'] = ((int)$data_db['day']) ;
            		//$data['day'] = $data_db['day'];
            		//$data['month'] = $data_db['month'];
            		//$data['year'] = $data_db['year'];
            		$data['tgl_lahir'] = $data_db['tgl_lhr'];
            		$data['flag'] = 1;
					$this->template->display('aduan/tambah_aduan', $data);

					//redirect('aduan/buat');
					return;
				}
			
			}
			else{
				$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required|exact_length[16]|numeric|callback_ktp_kediri');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_nama');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|numeric');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required');
				//$this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'trim|required|callback_tgl_lahir');
				//$this->form_validation->set_rules('bulan', 'Bulan Lahir', 'trim|required');
				//$this->form_validation->set_rules('tahun', 'Tahun Lahir', 'trim|required');
				$this->form_validation->set_rules('topik', 'Topik', 'trim|required');
				$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
				$this->form_validation->set_rules('isi', 'Isi Pengaduan', 'trim|required');
				$this->form_validation->set_message('required', '%s belum diisi');
				$this->form_validation->set_message('valid_email', 'Email anda tidak valid');
				$this->form_validation->set_message('numeric', '%s harus angka');
				//$this->form_validation->set_message('tgl_lahir', 'Tanggal Lahir tidak valid');
				$this->form_validation->set_message('exact_length', '%s KTP harus %s karakter');
				$this->form_validation->set_message('nama', '%s harus huruf alfabet');
				$this->form_validation->set_message('ktp_kediri', '%s anda tidak ditemukan/sesuai dengan data kami. Pastikan isian NIK, Nama, dan Tanggal Lahir sesuai dengan KTP anda');
			}
			// jika gagal, maka akan menampilkan sesuai kondisi
			if ($this->form_validation->run() == FALSE) {
				//log_message('debug', 'asehejfefjnfkdfkjfjk.');

				$data['error'] = validation_errors();
				if (form_error('topik') || form_error('departemen') || form_error('isi')) {
					$data['cur_page'] = '1';
				} else {
					$data['cur_page'] = '2';
				}
				$js_files = array('assets/new/js/jquery.easing.min.js', 'assets/js/bootstrap-datepicker.js', 'http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
				$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css', 'assets/new/css/aduan.css');
				$data['js_files'] = $js_files;
				$data['css_files'] = $css_files;
				$data['departemen'] = $this->departemen_model->get_all();
				//$data['no_identitas'] = $this->aduan_model->get_all();
				//$data['nama'] = "asdasdsa";
				$this->template->display_no_footer('aduan/tambah_aduan', $data);
				return;
			}

			if (count($_FILES['files']['name']) && $_FILES['files']['name'][0]) {
				if (count($_FILES['files']['name']) > 5) {
					$data['error'] = '<br>Unggah Berkasi Maksimal 5 buah';
					$data['cur_page'] = '3';
					$js_files = array('assets/new/js/jquery.easing.min.js', 'assets/js/bootstrap-datepicker.js', 'http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
					$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css', 'assets/new/css/aduan.css');
					$data['js_files'] = $js_files;
					$data['css_files'] = $css_files;
					$data['departemen'] = $this->departemen_model->get_all();
					$this->template->display_no_footer('aduan/tambah_aduan', $data);
					return;
				}


				$config = array();
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|doc|docx';
				$config['max_size']	= '1000';
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);

				print_r($_FILES);

				if (!$this->upload->do_multi_upload('files')) {
					$data['error'] = $this->upload->display_errors();
					$data['cur_page'] = '3';
					$js_files = array('assets/new/js/jquery.easing.min.js', 'assets/js/bootstrap-datepicker.js', 'http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed', 'assets/js/ckeditor/ckeditor.js', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/new/select2/select2.min.js');
					$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css', 'assets/new/css/aduan.css');
					$data['js_files'] = $js_files;
					$data['css_files'] = $css_files;
					$data['departemen'] = $this->departemen_model->get_all();
					$this->template->display_no_footer('aduan/tambah_aduan', $data);
					return;
				} else {
					$data['uploaded_file'] = $this->upload->get_multi_upload_data();
				}
			}

			foreach ($this->input->post() as $key => $value) {
				if ($key == 'tanggal') {
					$tanggal = $value;
					// $value = date('Y-m-d', strtotime($value));
				} else if ($key == 'bulan') {
					$bulan = $value;
				} else if ($key == 'tahun') {
					$tahun = $value;
				} else {
					$data[$key] = $value;
				}
			}

			if (checkdate($bulan, $tanggal, $tahun)) {
				$data['tgl_lahir'] = date('Y-m-d', mktime(0, 0, 0, $bulan, $tanggal, $tahun));
			}
			$data['alamat_ip'] = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
            $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $data['waktu'] = date('Y-m-d H:i:s', time());
            $data['prioritas'] = '3';
            $data['via_sms'] = '0';
            if ($data['departemen'] == '1') $data['status'] = '1';
            else $data['status'] = '1';

            //print_r($data['status']);
            //$data['petugas'] = '4';
           // $data['petugas'] = $this->aduan_model->get_id_petugas($data['departemen']);
            //echo $data['departemen'];
            
            $data['kategori'] = null;
            unset($data['landing_departemen']);
            unset($data['landing_topik']);
            unset($data['landing_isi']);
            unset($data['submit']);
            unset($data['cur_page']);
            unset($data['flag']);
            unset($data['maintance']);
            unset($data['info_maintance']);
            
            $data_db = $this->aduan_model->cek_ktp_db($data['no_identitas'], $data['nama'], $data['tgl_lahir']);
            $data['nama'] = $data_db['nama_lgkp'];
            $data['tgl_lahir'] = $data_db['tgl_lhr'];
			if ($nomor_aduan = $this->aduan_model->add($data)) {
				$this->session->set_userdata('nomor_aduan_sukses', $nomor_aduan);
				redirect('aduan/sukses');
			} else {
				echo "failed";
			}
			
		} else {
			redirect('aduan/buat');
		}
	}

	public function jawab($nomor_aduan = 0)
	{
		$data = array();
        $data_petugas = $this->session->userdata('data_petugas');
		if ($this->input->post()) {
			$nomor_aduan = $this->input->post('nomor_aduan');
			if (!$this->aduan_model->berhak($nomor_aduan)) {
				$this->session->set_flashdata('msg', 'Anda tidak berhak menjawab aduan ini.');
				$this->session->set_flashdata('class', 'danger');
				redirect('aduan/jawab/'.$nomor_aduan);
			}
			$valid_sms = true;
			$is_sms = false;
			$isi_detail = $this->input->post('isi_detail');
			if ($this->input->post('tipe_jawaban') == 'sms') {
				$is_sms = true;
				$isi_detail = $this->input->post('isi_detail_sms');
				if (strlen($isi_detail) > 140) $valid_sms = false;
			}
			$this->log_model->set_log("menjawab Aduan $nomor_aduan");
			$detail_jawaban = array();
			$detail_jawaban['waktu_detail'] = date('Y-m-d H:i:s', time());
			$detail_jawaban['aduan'] = $nomor_aduan;
			$detail_jawaban['isi_detail'] = $isi_detail;
			if ($data_petugas) {
				$detail_jawaban['petugas_detail'] = $data_petugas['id_petugas'];
			}
			if ($valid_sms && $isi_detail && $this->aduan_model->jawab($detail_jawaban, false, $is_sms)) {
				// update status menjadi sukses
				$data_update = array('status' => '4');
				$this->aduan_model->update_info($nomor_aduan, $data_update);
				// end
				$this->session->set_flashdata('msg', 'Jawaban Berhasil Dikirim');
				$this->session->set_flashdata('class', 'success'); echo 'ya';
			} else {
				$this->session->set_flashdata('msg', 'Jawaban Gagal Dikirim, Coba cek kembali masukan anda.');
				$this->session->set_flashdata('class', 'danger'); echo 'else';
			}
			redirect('aduan/jawab/'.$nomor_aduan);
		} else {
			//print_r($data_petugas);
			if ($data_petugas) {
				if (!$this->aduan_model->berhak($nomor_aduan)) $this->template->display('404',$data);
			} else {
				if ($this->session->userdata('petugas_admin')) $data;
				else if ($this->session->userdata('id_aduan') != $nomor_aduan) $this->template->display('404',$data);
			}

			
			$data['js_files'] = array('assets/js/ckeditor/ckeditor.js', 'https://maps.googleapis.com/maps/api/js?sensor=false', 'assets/js/ckeditor/config.js', 'assets/js/ckeditor/adapters/jquery.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js', 'assets/new/select2/select2.min.js');
			$data['css_files'] = array('assets/css/chat.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
			$data['nomor_aduan'] = $nomor_aduan;
			$data['aduan'] = $this->aduan_model->get_aduan($nomor_aduan);
			$data['kategori'] = $this->aduan_model->get_nama_kategori($data['aduan']['kategori']);

			$data['tahun_aduan'] = $this->aduan_model->get_tahun($nomor_aduan);

			//echo $data['tahun_aduan'];
			$data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($data['tahun_aduan'] - 1);
			//echo $data['max_aduan'];
			$data['get_department'] = $this->aduan_model->get_department();
			$data['get_kategori'] = $this->aduan_model->get_kategori();
			$data['get_priority'] = $this->aduan_model->get_priority();
			$data['get_status'] = $this->aduan_model->get_status();
			$data['role_petugas'] = $data_petugas['role'];

			$data['option_jawaban'] = $this->pengaturan_model->get_value(2);
			//echo $data['role_petugas'];
			if ($data_petugas['id_role'] == '1') {
				$data['get_petugas'] = $this->aduan_model->get_petugas();
			} else {
				$data['get_petugas'] = $this->aduan_model->get_petugas($data_petugas['departemen']);
			}
			// print_r($data['get_petugas']);
			$data['history_status'] = $this->aduan_model->history_status($nomor_aduan);
			if ($data['aduan'] == array()) redirect('aduan/baru');
			$this->template->display_chat('aduan/chat', $data);
		}
	}

	public function kembali($nomor_aduan = 0)
	{
		$this->log_model->set_log("mengembalikan Aduan ke pool $nomor_aduan");
		if (!$this->aduan_model->berhak($nomor_aduan)) show_404();
		if (!$this->input->post()) show_404();
		$alasan = $this->input->post('alasan');
		$data = array();
		if (!$alasan) {
			$data['msg'] = 'Alasan belum diisi';
			$data['class'] = 'danger';
			echo json_encode($data);
			return;
		}
		$this->aduan_model->kembali($nomor_aduan, $alasan);
		echo json_encode($data);
	}

	public function cek()
	{
		$data = array();
		$js_files = array('assets/js/bootstrap-datepicker.js', 'assets/new/select2/select2.min.js');
		$css_files = array('assets/css/datepicker3.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
		$data['js_files'] = $js_files;
		$data['css_files'] = $css_files;
		if ($this->input->post()) {
			$tahun_aduan = $this->input->post('tahun_aduan');
			$nomor_aduan = $this->input->post('nomor_aduan');
			$tanggal = $this->input->post('tanggal');
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$no_hp = $this->input->post('nomor_hp');

			$max_aduan = $this->petugas_model->get_last_aduan_by_year($tahun_aduan - 1);

			$nomor_aduan = $nomor_aduan + $max_aduan;

			//print_r($max_aduan);

			
			if (checkdate($bulan, $tanggal, $tahun)) {
				$tgl_lahir = date('Y-m-d', mktime(0, 0, 0, $bulan, $tanggal, $tahun));
			}
			// $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));

			if ($this->aduan_model->cek_aduan($nomor_aduan, $tgl_lahir, $no_hp)) {
				redirect('aduan/jawab/'.$nomor_aduan);
			} else {
				$this->session->set_flashdata('msg', 'Data Aduan tidak ada atau anda salah memasukkan tanggal lahir/no hp');
				$this->session->set_flashdata('class', 'danger');
			}
			redirect('aduan/cek');
			
		} else {
			$this->template->display('aduan/cek', $data);
		}
	}

	public function update_info($nomor_aduan = 0)
	{
		if ($this->input->post()) {

			$temp = $this->input->post();
			$data_petugas = $this->session->userdata('data_petugas');
			$data = array();
			foreach ($this->input->post() as $key => $value) {
				if ($key == 'sms_notif') continue;
				$data[$key] = $value;
			}
			$data['info'] = '1';
			$data['info_detail'] = '';

			if (isset($_POST["diterima"])) {

				$this->log_model->set_log("menerima Aduan $nomor_aduan");
				$data['status'] = '5';

				unset($data['diterima']);
			}

			if (isset($_POST["diteruskan"])) {
				$this->log_model->set_log("meneruskan Aduan $nomor_aduan");
				$data['status'] = '7';
				$data['info'] = '4';
				//echo "diteruskan";

				unset($data['diteruskan']);
			}

			if (isset($_POST["diterimaDpt"])) {
				$this->log_model->set_log("menerima Aduan $nomor_aduan");
				$data['status'] = '8';
				$data['info'] = '4';
				//echo "diteruskan";
				
				$temp['departemen'] = $data_petugas['departemen'];

				unset($data['diterimaDpt']);
			}

			//print_r($this->input->post());

			//$data['nama_departemen'] = $this->departemen_model->get_nama_departemen($temp['departemen']);
			
			//print_r($data['nama_departemen']);

			
			$data['departemen'] = $temp['departemen'];
			$data['kategori'] = $temp['kategori'];

			$this->aduan_model->update_info($nomor_aduan, $data);

			
			$departemen = $this->departemen_model->get_row($data['departemen']);

			//print_r($departemen);
			
			$aduan = $this->aduan_model->get_aduan($nomor_aduan);
			if ($departemen['apakah_mitra'] == '1' && $this->input->post('sms_notif') == '1' && $departemen['no_hp']) {
				$text_sms = "Terdapat Aduan Masuk dengan Nomor Aduan #$nomor_aduan dan password ";
				if ($aduan['via_sms'] == '1') {
					$text_sms .= "no hp " . $aduan['no_hp'];
				} else {
					$text_sms .= "tanggal lahir " . $aduan['tgl_lahir'];
				}
				$text_sms .= ". Untuk lebih detail silakan kunjungi http://surga.kedirikota.go.id/aduan/cek";
				$balasan_sms = array();
				$balasan_sms['DestinationNumber'] = $departemen['no_hp'];
				$balasan_sms['TextDecoded'] = $text_sms;
				$this->sms_model->send_sms($balasan_sms);
			} else {

			}
			redirect('aduan/jawab/'.$nomor_aduan);
			
		}
	}

	public function spam($nomor_aduan = 0)
	{
		$this->log_model->set_log("menandai Spam Aduan $nomor_aduan");
		if ($this->session->userdata('petugas_admin')) $nomor_aduan;
		else if (!$this->aduan_model->berhak($nomor_aduan)) show_404();
		$this->aduan_model->flag_spam($nomor_aduan);
		redirect('login');
	}

	public function hapus($nomor_aduan = 0)
	{

		$this->log_model->set_log("menghapus Aduan $nomor_aduan");
		if ($this->session->userdata('petugas_admin')) $nomor_aduan;
		else if (!$this->aduan_model->berhak($nomor_aduan)) show_404();
		$this->aduan_model->hapus_aduan($nomor_aduan);
		redirect('login');
	}

	public function sukses()
	{
		$nomor_aduan = $this->session->userdata('nomor_aduan_sukses');

		$tahun = date('Y');
		$max_aduan = $this->petugas_model->get_last_aduan_by_year($tahun - 1);
		$nomor_aduan_info = $nomor_aduan - $max_aduan;

		if (!$nomor_aduan) redirect('aduan/baru');
		$tmp = $this->aduan_model->get_aduan($nomor_aduan);
		$sms_text = "Telah masuk aduan baru dengan nomor aduan=".$nomor_aduan_info.' silahkan cek aduan tersebut ke website surga.kedirikota.go.id';
		$nomor_hp = $this->aduan_model->get_nomor_hp(1);
		foreach($nomor_hp as $nomor)
		{
			$balasan_sms = array();
			$balasan_sms['DestinationNumber'] = $nomor->no_hp_petugas;
			$balasan_sms['TextDecoded'] = $sms_text;
			$this->sms_model->send_sms($balasan_sms);
		}
		$this->template->display('aduan/add_sukses', array('nomor_aduan' => $nomor_aduan_info));
	}

	function tgl_lahir()
	{
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		return checkdate($bulan, $tanggal, $tahun);
	}

	function nama($param)
	{
		$tmp = str_replace(' ', '', $param);
		$tmp = str_replace('.', '', $tmp);
		$tmp = str_replace("'", '', $tmp);
		$tmp = str_replace(",", '', $tmp);
		return ctype_alpha($tmp);
	}

	function ktp_kediri($param)
	{
		$nik = $this->input->post('no_identitas');
		$nama = $this->input->post('nama');
		$tgl_lahir = date('Y-m-d', mktime(0, 0, 0, $this->input->post('bulan'), $this->input->post('tanggal'), $this->input->post('tahun')));
		if ($this->aduan_model->cek_ktp_db($nik, $nama, $tgl_lahir)) return true;
		return false;
	}

	function ktp_kediri_identitas($param)
	{
		//$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required|exact_length[16]|numeric|callback_ktp_kediri');
		//$this->form_validation->set_message('ktp_kediri', '%s anda tidak ditemukan/sesuai dengan data kami. Pastikan isian NIK, Nama, dan Tanggal Lahir sesuai dengan KTP anda');

		$nik = $this->input->post('no_identitas');
		//$nama = $this->input->post('nama');
		//$tgl_lahir = date('Y-m-d', mktime(0, 0, 0, $this->input->post('bulan'), $this->input->post('tanggal'), $this->input->post('tahun')));
		if ($this->aduan_model->cek_ktp_identitas($nik)) return true;
		return false;
	}
}