<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistik extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('petugas_stat')) redirect('login');
        $this->load->model(array('statistik_model', 'kategori_model'));
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');

    }

    public function index()
    {
        UserAuth::cek_authorize($this);
        $data = array();
        $js_files = array('assets/datatable/media/js/jquery.dataTables.min.js', 'https://maps.googleapis.com/maps/api/js?sensor=false', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/new/select2/select2.min.js', 'assets/highcharts/js/jquery.highchartTable-min.js', 'assets/highcharts/js/highstock.js');
        $css_files = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
        $data['js_files'] = $js_files;
        $data['css_files'] = $css_files;
        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');
        $data['kategori'] = $this->kategori_model->get_all();
        $data['stat_aduan'] = $this->statistik_model->get_statistik_pelayanan($bulan_sekarang, $tahun_sekarang);
        $data['stat_petugas'] = $this->statistik_model->get_statistik_petugas();
        $data['stat_waktu'] = $this->statistik_model->get_statistik_waktu();
        $data['stat_rating'] = $this->statistik_model->get_statistik_rating();
        $data['jumlah_all'] = $this->statistik_model->get_statistik_all_time();
//        print_r($data['stat_rating']);
//        print_r($data['stat_waktu']);
//        echo '<pre>';
//        print_r($data['stat_petugas']);
        $this->template->display('statistik/main', $data);
    }

    public function tes()
    {
        $statistik_total_aduan_skpd_sms = $this->statistik_model->get_statistik_by_kelurahan(' ',2014,' ');
        var_dump($statistik_total_aduan_skpd_sms);
    }

    public function get_aduan_masuk($param = '')
    {

        //$data = array();
       // echo $param;
        try{
            //$this->log_model->set_log("melihat departement");
            $crud = new grocery_CRUD();
            //$crud->set_theme('datatables');
            $crud->set_table('aduan');
            $crud->set_subject('Aduan');
            $crud->set_relation('departemen', 'departemen', 'nama_departemen');
            $crud->set_relation('status', 'status', 'nama_status');
            $crud->set_relation('prioritas', 'prioritas', 'nama_prioritas');
            //$crud->change_field_type('apakah_mitra', 'true_false', array('Tidak', 'Ya'));
            //$crud->display_as('nama_departemen','Nama Departemen');
            //$crud->where('status','4');
            //$crud->where('(status != 4)',null,FALSE);
            $paramm = $param;
            if($paramm == 0) {
                
            } else if($paramm == 4) {
                $crud->where('(status = 4)',null,FALSE);
            } else {
               $crud->where('(status != 4)',null,FALSE);
            }

            $crud->where('spam','0');
            
            
            $crud->columns('id_aduan','nama','waktu','topik','isi','departemen','status','prioritas','via_sms');
            //$crud->unset_read_fields('no_hp');
            //$data['output'] = $crud->render();
            $crud->callback_column('via_sms',array($this,'_jalur'));

            $crud->display_as('via_sms','Jalur');
            $crud->display_as('id_aduan','No Tiket');
            //$crud->display_as('pilihan','aksi');
            $crud->unset_add();
            $crud->unset_edit();
            
            $crud->unset_delete();

            $output = $crud->render();
            $this->template->display('statistik/blank', (array)$output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }

       

        //$js_files = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/new/select2/select2.min.js', 'assets/highcharts/js/jquery.highchartTable-min.js', 'assets/highcharts/js/highstock.js');
       // $css_files = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
       // $data['js_files'] = $js_files;
      //  $data['css_files'] = $css_files;

       // $output = 'asdasd';

        //$this->template->display('statistik/blank', array($data,$output));
        
    }

    protected function _unique_join_name($field_name)
    {
        return 'j'.substr(md5($field_name),0,8); 
    }

    public function get_aduan_masuk_departemen($param = '', $param2 = '', $bulan = NULL, $tahun = NULL)
    {

        //$data = array();
       // echo $param;

        //$temp_departemen = str_replace("%20", " ", $param2);
        /*
        //$temp_departemen2 = str_replace("()", " ", $temp_departemen);
        $temp_departemen = preg_replace('/\(|\)/','',$temp_departemen);
        //$temp_departemen = str_replace(")", " ", $temp_departemen);
        //$temp_departemen = 'BADAN KEPEGAWAIAN DAERAH (BKD)';
        echo $temp_departemen;

        $test = 'BADAN KEPEGAWAIAN DAERAH (BKD)';
        //echo '\n';
        echo $test;

        if(strcmp($temp_departemen, $test) >= 0)
        {
            echo '1';
        }
        else
        {
            echo '0';
        }
        */
        try{
            //$this->log_model->set_log("melihat departement");
            $crud = new grocery_CRUD();
            //$crud->set_theme('datatables');
            $crud->set_table('aduan');
            $crud->set_subject('Aduan');
            $crud->set_relation('departemen', 'departemen', 'nama_departemen');
            $crud->set_relation('status', 'status', 'nama_status');
            $crud->set_relation('prioritas', 'prioritas', 'nama_prioritas');
           // $crud->set_relation('id_departemen', 'departemen', 'id_departemen');

            //$name_departemen = $temp_departemen;

            //echo $temp_departemen;
            //$crud->where($this->_unique_join_name('departemen').'.nama_departemen',$name_departemen);
            //$crud->where($this->_unique_join_name('departemen').'.nama_departemen', '0');
              $crud->where('departemen', $param2);
           // $crud->where('departemen.nama_departemen', "BAGIAN HUBUNGAN MASYARAKAT DAN PROTOKOL");
            
            if (empty($bulan)) {
                $crud->where("date_format(waktu,'%Y') =","$tahun");
            }
            else {
                $crud->where("aduan.waktu >","$tahun-$bulan-1");
                $crud->where("aduan.waktu <","$tahun-".($bulan+1)."-1");
            }
            //$crud->where('','0');
           // $crud->where('aduan.name_departemen', "BAGIAN HUBUNGAN MASYARAKAT DAN PROTOKOL");
            
            $paramm = $param;
            if($paramm == 0) {
                
            } else if($paramm == 4) {
                $crud->where('(status = 4)',null,FALSE);
            } else {
               $crud->where('(status != 4)',null,FALSE);
            }
            
            $crud->where('spam','0');
            
            
            $crud->columns('id_aduan','nama','waktu','topik','isi','departemen','status','prioritas','via_sms');

            $crud->callback_column('via_sms',array($this,'_jalur'));

            $crud->display_as('via_sms','Jalur');
            $crud->display_as('id_aduan','No Tiket');

            $crud->unset_add();
            $crud->unset_edit();
            
            $crud->unset_delete();

            $output = $crud->render();
            $this->template->display('statistik/blank', (array)$output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
       
    }

    public function _jalur($value, $row)
    {
        if ($value == '0') {
            return 'website';
        } elseif ($value == '1') {
            return 'sms';
        } else {
            return "-";
        }
    }

    public function download_laporan()
    {
        $this->load->helper('download');
        $tahun = (int)$this->input->post('tahun');
        $bulan = (int)$this->input->post('bulan');
        if ($tahun == 0) {
            $tahun = date('Y');
        }
        if ($bulan == 0) {
            $bulan = ' ';
        }
        require_once APPPATH."/third_party/PhpWord/Autoloader.php"; 
        \PhpOffice\PhpWord\Autoloader::register();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // $properties = $phpWord->getDocInfo();
        // $properties->setCreator('Suara Warga');
        // $properties->setCompany('Pemerintah Kota Kediri');
        // $properties->setTitle('Laporan Tahunan Suara Warga');
        // $properties->setDescription('Berisi detail laporan tahunan suara warga kota kediri');
        // $properties->setCategory('Laporan');
        // $properties->setLastModifiedBy('Suara Warga');
        // $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
        // $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
        // $properties->setSubject('Suara Warga');
        //our docx will have 'lanscape' paper orientation

        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->createSection(array('orientation'=>'landscape'));

        $phpWord->addNumberingStyle(
            'headingNumbering',
            array('type' => 'multilevel', 'levels' => array(
                array('pStyle' => 'Heading1', 'format' => 'decimal', 'text' => '%1'),
                array('pStyle' => 'Heading2', 'format' => 'decimal', 'text' => '%1.%2'),
                array('pStyle' => 'Heading3', 'format' => 'decimal', 'text' => '%1.%2.%3'),
                )
            )
        );
        $phpWord->addTitleStyle(1, array('size' => 16, 'bold' => true), array('numStyle' => 'headingNumbering', 'numLevel' => 0));
        $phpWord->addTitleStyle(2, array('size' => 14), array('numStyle' => 'headingNumbering', 'numLevel' => 1));
        $phpWord->addTitleStyle(3, array('size' => 12), array('numStyle' => 'headingNumbering', 'numLevel' => 2));

        $tableStyle = array(
            'align' => 'center',
            'borderColor' =>'000000',
            'borderSize' => 6,
            'cellMargin' => 50,
            'valign' => 'center'
        );

        $firstRowStyle = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');

        $section->addTitle('Monitor Aduan Global Kota Kediri', 1);
        $section->addTitle('Statistik Total Aduan', 2);

        $phpWord->addTableStyle('tabel1', $tableStyle);
        $table = $section->addTable('tabel1');
        $statistik_total_aduan = $this->statistik_model->get_statistik_based_by_time(' ',$tahun,$bulan);
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Masuk',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'), array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Belum Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan['belum_terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Presentase Aduan Terjawab',null,array('spaceAfter' => 0));
        $presentase = round(($statistik_total_aduan['terjawab']*100/$statistik_total_aduan['masuk']),2);
        $presentase.=' %';
        $table->addCell(1000)->addText($presentase,null,array('align'=>'center', 'spaceAfter' => 0));
        $section->addText('Tabel 1. Tabel Statistik Total Aduan',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTitle('Statistik Aduan Via SMS', 2);

        $phpWord->addTableStyle('tabel2', $tableStyle);
        $table = $section->addTable('tabel2');
        $statistik_total_aduan_sms = $this->statistik_model->get_statistik_based_by_time(1,$tahun,$bulan);
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Masuk',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_sms['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_sms['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'), array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Belum Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_sms['belum_terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Presentase Aduan Terjawab',null,array('spaceAfter' => 0));
        $presentase = round(($statistik_total_aduan_sms['terjawab']*100/$statistik_total_aduan_sms['masuk']),2);
        $presentase.=' %';
        $table->addCell(1000)->addText($presentase,null,array('align'=>'center', 'spaceAfter' => 0));
        $section->addText('Tabel 2. Tabel Statistik Total Aduan Via SMS',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTitle('Statistik Aduan Via Web', 2);

        $phpWord->addTableStyle('tabel3', $tableStyle);
        $table = $section->addTable('tabel3');
        $statistik_total_aduan_web = $this->statistik_model->get_statistik_based_by_time(0,$tahun,$bulan);
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Masuk',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_web['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_web['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'), array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Total Aduan Belum Terjawab',null,array('spaceAfter' => 0));
        $table->addCell(1500)->addText($statistik_total_aduan_web['belum_terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addRow();
        $table->addCell(6000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Presentase Aduan Terjawab',null,array('spaceAfter' => 0));
        $presentase = round(($statistik_total_aduan_web['terjawab']*100/$statistik_total_aduan_web['masuk']),2);
        $presentase.=' %';
        $table->addCell(1000)->addText($presentase,null,array('align'=>'center', 'spaceAfter' => 0));
        $section->addText('Tabel 3. Tabel Statistik Total Aduan Via Web',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTextBreak(1);

        $section->addTitle('Monitor Aduan Per Kecamatan', 1);
        $section->addTitle('Statistik Total Aduan Via SMS', 2);

        $phpWord->addTableStyle('tabel4', $tableStyle);
        $table = $section->addTable('tabel4');
        $total_done = 0;
        $total_undone = 0;
        $statistik_total_aduan_sms_kecamatan = $this->statistik_model->get_statistik_by_kecamatan(1,$tahun,$bulan);
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Kecamatan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_sms_kecamatan as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_kecamatan'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_kecamatan'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(($row['masuk']-$row['terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += ($row['masuk']-$row['terjawab']);
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText($row['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 4. Tabel Statistik Total Aduan Via SMS Per Kecamatan',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTitle('Statistik Total Aduan Via Web', 2);

        $phpWord->addTableStyle('tabel5', $tableStyle);
        $table = $section->addTable('tabel5');
        $total_done = 0;
        $total_undone = 0;
        $statistik_total_aduan_web_kecamatan = $this->statistik_model->get_statistik_by_kecamatan(0,$tahun,$bulan);
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Kecamatan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_web_kecamatan as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_kecamatan'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_kecamatan'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(($row['masuk']-$row['terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += ($row['masuk']-$row['terjawab']);
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText($row['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 5. Tabel Statistik Total Aduan Via Web Per Kecamatan',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTextBreak(1);

        $section->addTitle('Monitor Aduan Per Kelurahan', 1);
        $section->addTitle('Statistik Total Aduan Via SMS', 2);

        $phpWord->addTableStyle('tabel6', $tableStyle);
        $table = $section->addTable('tabel6');
        $total_done = 0;
        $total_undone = 0;
        $statistik_total_aduan_sms_kelurahan = $this->statistik_model->get_statistik_by_kelurahan(1,$tahun,$bulan);
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Kecamatan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_sms_kelurahan as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_kelurahan'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_kelurahan'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(($row['masuk']-$row['terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += ($row['masuk']-$row['terjawab']);
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText($row['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 6. Tabel Statistik Total Aduan Via SMS Per Kelurahan',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTitle('Statistik Total Aduan Via Web', 2);

        $phpWord->addTableStyle('tabel7', $tableStyle);
        $table = $section->addTable('tabel7');
        $total_done = 0;
        $total_undone = 0;
        $statistik_total_aduan_web_kelurahan = $this->statistik_model->get_statistik_by_kelurahan(0,$tahun,$bulan);
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Kecamatan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_web_kelurahan as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_kelurahan'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_kelurahan'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(($row['masuk']-$row['terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += ($row['masuk']-$row['terjawab']);
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText($row['masuk'],null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 7. Tabel Statistik Total Aduan Via Web Per Kelurahan',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTextBreak(1);

        $section->addTitle('Monitor Aduan Per SKPD', 1);
        $section->addTitle('Statistik Total Aduan Via SMS', 2);

        $phpWord->addTableStyle('tabel8', $tableStyle);
        $table = $section->addTable('tabel8');
        if ($bulan == ' ') {
            $statistik_total_aduan_skpd_sms = $this->statistik_model->get_statistik_pelayanan('',$tahun,1);
        }
        else {
            $statistik_total_aduan_skpd_sms = $this->statistik_model->get_statistik_pelayanan($bulan,$tahun,1);
        }
        $total_done = 0;
        $total_undone = 0;
        $max_avg = 0.0;
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Departemen',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Rerata Aduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_skpd_sms as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_departemen'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_departemen'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['belum_terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += $row['belum_terjawab'];
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText(($row['terjawab']+$row['belum_terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            if ($row['terjawab'] != 0 && $row['belum_terjawab'] != 0) {
                $temp_avg = (float)round(($row['terjawab'] / ($row['terjawab']+$row['belum_terjawab'])*100),2);
                if ($temp_avg > $max_avg) {
                    $max_avg = $temp_avg;
                }
                $temp = $temp_avg." %";
            }
            else
                $temp = "0 %";
            $table->addCell(2000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($temp,null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1000)->addText('Tertinggi:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($max_avg,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 8. Tabel Statistik Total Aduan Via SMS Per SKPD',null,array('align' => 'center', 'spaceBefore' => 24));

        $section->addTitle('Statistik Total Aduan Via Web', 2);

        $phpWord->addTableStyle('tabel9', $tableStyle);
        $table = $section->addTable('tabel9');
        if ($bulan == ' ') {
            $statistik_total_aduan_skpd_web = $this->statistik_model->get_statistik_pelayanan('',$tahun,0);
        }
        else {
            $statistik_total_aduan_skpd_web = $this->statistik_model->get_statistik_pelayanan($bulan,$tahun,0);
        }
        $total_done = 0;
        $total_undone = 0;
        $max_avg = 0.0;
        $table->addRow();
        $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Nomor',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Departemen',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Aduan Belum Terjawab',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText('Total Pengaduan',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(2000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText('Rerata Aduan',null,array('align'=>'center', 'spaceAfter' => 0));
        foreach ($statistik_total_aduan_skpd_web as $row) {
            $table->addRow();
            $table->addCell(900, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['id_departemen'],null,array('align'=>'center', 'spaceAfter' => 0));
            $table->addCell(4100, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['nama_departemen'],null,array('spaceAfter' => 0));
            $table->addCell(2700, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_done += $row['terjawab'];
            $table->addCell(3000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($row['belum_terjawab'],null,array('align'=>'center', 'spaceAfter' => 0));
            $total_undone += $row['belum_terjawab'];
            $table->addCell(2300, array('gridSpan' => 2, 'borderRightSize'=>6))->addText(($row['terjawab']+$row['belum_terjawab']),null,array('align'=>'center', 'spaceAfter' => 0));
            if ($row['terjawab'] != 0 && $row['belum_terjawab'] != 0) {
                $temp_avg = (float)round(($row['terjawab'] / ($row['terjawab']+$row['belum_terjawab'])*100),2);
                if ($temp_avg > $max_avg) {
                    $max_avg = $temp_avg;
                }
                $temp = $temp_avg." %";
            }
            else
                $temp = "0 %";
            $table->addCell(2000, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($temp,null,array('align'=>'center', 'spaceAfter' => 0));
        }
        $table->addRow();
        $table->addCell(900, array('gridSpan' => 2, 'borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText(' ',null,array('align'=>'center', 'spaceAfter' => 0));
        $table->addCell(1350)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1350, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1500)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1500, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1150)->addText('Total:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1150, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($total_done + $total_undone,null,array('align'=>'right', 'spaceAfter' => 0));
        $table->addCell(1000)->addText('Tertinggi:',null,array('align'=>'left', 'spaceAfter' => 0));
        $table->addCell(1000, array('borderRightSize'=>6, 'borderRightColor'=>'000000'))->addText($max_avg,null,array('align'=>'right', 'spaceAfter' => 0));
        $section->addText('Tabel 9. Tabel Statistik Total Aduan Via Web Per SKPD',null,array('align' => 'center', 'spaceBefore' => 24));
        
        // $styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
        // $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
        // $styleCell = array('valign'=>'center');
        // $fontStyle = array('bold'=>true, 'align'=>'center');

        // $phpWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
        // $table = $section->addTable('myOwnTableStyle');
        // $table->addRow(900);
        // $table->addCell(2000, $styleCell)->addText('ID Aduan', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('NIK Pengadu', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Nama Pengadu', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Waktu', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Nama Petugas', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Nama Departemen', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Spam', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Topik Aduan', $fontStyle);
        // $table->addCell(2000, $styleCell)->addText('Isi Aduan', $fontStyle);

        // foreach ($data['arr']['data'] as $line) {
        //     $table->addRow();
        //     $table->addCell(2000)->addText($line['id_aduan']);
        //     $table->addCell(2000)->addText($line['nik_pengadu']);
        //     $table->addCell(2000)->addText($line['nama_pengadu']);
        //     $table->addCell(2000)->addText($line['waktu']);
        //     $table->addCell(2000)->addText($line['nama_petugas']);
        //     $table->addCell(2000)->addText($line['nama_departemen']);
        //     $table->addCell(2000)->addText($line['spam']);
        //     $table->addCell(2000)->addText($line['topik_aduan']);
        //     $table->addCell(2000)->addText($line['isi_aduan']);
        //     // fputcsv($f, $tmp, $delimiter);
        // }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $filename = date('d.m.Y.H.i.s').'.docx';
        $objWriter->save($filename);
        $data = file_get_contents($filename);
        unlink(realpath($filename));
        if ($bulan = ' ') {
            $namaFile = "laporan_surga_tahun_".$tahun."docx";
        }
        else {
            $namaFile = "laporan_surga_bulan_".$bulan."tahun_".$tahun."docx";
        }
        force_download('laporan.docx', $data);
        unset($phpWord);
    }
}
