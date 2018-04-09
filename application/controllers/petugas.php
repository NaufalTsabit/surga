<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas extends CI_Controller {

    //var $tahun = "";

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('data_petugas') ) redirect('login');
        $this->load->model(array('aduan_model','petugas_model','log_model','departemen_model','pengaturan_model'));
        //$this->load->controler(array('api'));
        $this->load->library('form_validation');
		$this->load->helper('simple_html_dom');
    }

    public function index()
    {
        $data_petugas = $this->session->userdata('data_petugas');
        if (!$data_petugas) $data_petugas = $this->session->userdata('petugas_stat');
        if (!$data_petugas) {
            $data_petugas = $this->session->userdata('petugas_admin');
            if ($data_petugas) redirect('admin');
        }

        if (count($data_petugas['list_app'])) {
            foreach ($data_petugas['list_app'] as $key => $value) {
                if (strpos($value['url_app'], 'petugas') !== false) {
                    redirect('petugas/inbox');
                }
            }
            redirect('petugas/inbox');
        }
        else redirect('logout');
    }

    public function news()
    {
        //UserAuth::cek_authorize($this);

       // redirect('petugas/viewFacebook');

        
        $this->log_model->set_log("melihat Home");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');

        $data['list_konten'] = array();
		


        $html = file_get_html('http://www.tribunnews.com/tag/kediri');
		
		foreach ($html->find('li[class=ptb15] div[class=mr140]') as $element) {
            $konten = array();

            foreach ($element->find('a') as $element2) {
                $konten["title"] = $element2->title;
                $konten["url"] = $element2->href;
            }

            foreach ($element->find('h4[class=grey2 pt5]') as $element3) {
				//print_r($element3); exit;
		
                $konten["desc"] = $element3->plaintext;
                
            }

            foreach ($element->find('div[class=grey]') as $element4) {

                $konten["waktu"] = $element4->plaintext;
                
                //$konten["temp_waktu"] = $element4->plaintext;
                $pieces = explode(" ", $konten["waktu"]);
                //$temp1 = "";
                if(strlen($pieces[2]) == 1)
                {
                    $pieces[2] = "0$pieces[2]";
                }
                //echo $pieces[2];

                $pieces[3] = $this->get_bulan_angka($pieces[3]);

                //echo $pieces[3];

                $konten["temp_waktu"] = "$pieces[4]$pieces[3]$pieces[2]";
                //echo $konten["temp_waktu"];
                //echo "<br>";
            }
            
            array_push($data["list_konten"], $konten);
        }
		
       // print_r($data['list_konten']); exit;

      

        $this->template->display_full('petugas/news', $data);
        

    }

    public function viewFacebook()
    {
        //UserAuth::cek_authorize($this);

        $this->log_model->set_log("Melihat Posting Facebook");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');

        $data['list_konten'] = array();



        
        $html = file_get_html('http://www.facebook.com');
        echo $html;
        /*
        foreach ($html->find('li[class=ptb15] div[class=mr140]') as $element) {
            $konten = array();

            foreach ($element->find('a') as $element2) {
                $konten["title"] = $element2->title;
                $konten["url"] = $element2->href;
            }

            foreach ($element->find('div[class=grey2]') as $element3) {

                $konten["desc"] = $element3->plaintext;
                
            }

            foreach ($element->find('div[class=grey]') as $element4) {

                $konten["waktu"] = $element4->plaintext;
                
                //$konten["temp_waktu"] = $element4->plaintext;
                $pieces = explode(" ", $konten["waktu"]);
                //$temp1 = "";
                if(strlen($pieces[2]) == 1)
                {
                    $pieces[2] = "0$pieces[2]";
                }
                //echo $pieces[2];

                $pieces[3] = $this->get_bulan_angka($pieces[3]);

                //echo $pieces[3];

                $konten["temp_waktu"] = "$pieces[4]$pieces[3]$pieces[2]";
                //echo $konten["temp_waktu"];
                //echo "<br>";
            }
            
            array_push($data["list_konten"], $konten);
        }
        */
        //print_r($data['list_konten']);

      

        //$this->template->display_full('petugas/news', $data);


    }

    // Tidak Dipakai
    public function dashboard($tipe = null)
    {
        if ($tipe == null) redirect('petugas/dashboard/0');
        UserAuth::cek_authorize($this);
        $this->log_model->set_log("melihat dashboard");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
        $data['list_aduan'] = $this->petugas_model->list_aduan($tipe);

        $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year(date('Y') - 1);

        

        $data['coba'] = 0;
        $data['tipe'] = $tipe;
        $data['tahun_ini'] = date('Y');
        $this->template->display_full('petugas/dashboard', $data);
    }


    public function dashboard2($tipe = null , $tahun)
    {
        if ($tipe == null) redirect('petugas/dashboard2/0');
       // UserAuth::cek_authorize($this);
       // $this->log_model->set_log("melihat dashboard");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
        $data['list_aduan'] = $this->petugas_model->list_aduan($tipe);

        $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);

        //$data['coba'] = 0;
        

        $data['tipe'] = $tipe;
        $data['tahun_ini'] = $tahun;

        $this->template->display_full('petugas/dashboard', $data);
    }
    // Sampai sini


    public function inbox($tahun = null, $tipe = null )
    {


        if ($tahun == null) 
        {
            $tahun = date('Y');
        }


        $data = array();
        $data['data_petugas'] = $this->session->userdata('data_petugas');

       // print_r($this->input->post());

       // if($this->input->post('tahun'))
        //{
            
        //}
        if($this->input->post('tahun'))
        {
            $tahun = $this->input->post('tahun');
        }

        if($this->input->post('arsip') || $tipe == 1)
        {
            //echo "wkwkwkwkwkwkwkwkw";

            $this->log_model->set_log("melihat Arsip");
           // $data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_aduan'] = $this->petugas_model->list_inbox_arsip();

            $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);

            $data['tahun_ini'] = $tahun;

            $data['cek_induk'] = $this->departemen_model->cek_induk_departemen();

            
            $this->template->display_full('petugas/arsip', $data);

        }
        else if($this->input->post('monitor') || $tipe == 2)
        {
            //echo "wkwkwkwkwkwkwkwkw";

            $this->log_model->set_log("melihat Monitoring");
           // $data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_aduan'] = $this->petugas_model->list_inbox_monitor();

            $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);

            $data['tahun_ini'] = $tahun;
            $this->template->display_full('petugas/monitor', $data);

        }
        else
        {
            $this->log_model->set_log("melihat inbox Aduan");
            //UserAuth::cek_authorize($this);
            $this->log_model->set_log("melihat dashboard");
            
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
            $data['list_aduan'] = $this->petugas_model->list_inbox_all();

            $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);

            $data['tahun_ini'] = $tahun;

            $data['cek_induk'] = $this->departemen_model->cek_induk_departemen();
            $this->template->display_full('petugas/inbox', $data);
        }
        

    }
    


    public function getPengadu($no_ktp = null)
    {
        if($no_ktp == null) echo "Pengadu tidak Ditemukan";
        else
        {
            $data = @$this->petugas_model->getPengadu($no_ktp)[0];
            // var_dump($data);
            $html = "";
            $html .= "<p> Data Aduan";
            $html .= "<table>  
                        <tr>
                            <td>No. KTP<td/>
                            <td>&nbsp;: ".@$data->no_identitas."<td/>
                        </tr>  
                        <tr>
                            <td>Nama<td/>
                            <td>&nbsp;: ".@$data->nama."<td/>
                        </tr>  
                        <tr>
                            <td>Nomor HP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td/>
                            <td>&nbsp;: ".@$data->no_hp."<td/>
                        </tr>  
                        <tr>
                            <td>Email<td/>
                            <td> &nbsp;: ".@$data->email."<td/>
                        </tr>  
                        <tr>
                            <td>Tgl Lahir<td/>
                            <td> &nbsp;: ".@$data->tgl_lahir."<td/>
                        </tr>  
                        <tr>
                            <td>Alamat<td/>
                            <td>&nbsp;: ".@$data->alamat."<td/>
                        </tr>
                      </table>";
            $html .= "</p>";
            
            echo $html;

            $data = @$this->petugas_model->getPengadu2($no_ktp)[0];
            // var_dump($data);

            if(@$data->jenis_klmin == '1')
            {
                @$data->jenis_klmin = 'Laki-Laki';
            }
            else if(@$data->jenis_klmin == '2')
            {
                @$data->jenis_klmin = 'Perempuan';
            }

            //echo @$data->no_kec;
            $nama_kecamatan = @$this->petugas_model->get_nama_kecamatan(@$data->no_kec);
            $nama_kelurahan = @$this->petugas_model->get_nama_kelurahan(@$data->no_kec, @$data->no_kel);

            //print_r($nama_kelurahan);

            $html = "<br>";
            $html .= "<p> Data Kependudukan";
            $html .= "<table>  
                        <tr>
                            <td>No. KTP<td/>
                            <td>&nbsp;: ".@$data->nik."<td/>
                        </tr>  
                        <tr>
                            <td>Nama<td/>
                            <td>&nbsp;: ".@$data->nama_lgkp."<td/>
                        </tr>  
                        <tr>
                            <td>Jenis Kelamin &nbsp;&nbsp;&nbsp;<td/>
                            <td>&nbsp;: ".@$data->jenis_klmin."<td/>
                        </tr>  
                        <tr>
                            <td>Tempat Lahir<td/>
                            <td>&nbsp;: ".@$data->tmpt_lhr."<td/>
                        </tr>  
                        <tr>
                            <td>Tgl Lahir<td/>
                            <td>&nbsp;: ".@$data->tgl_lhr."<td/>
                        </tr>  
                        <tr>
                            <td>Kecamatan<td/>
                            <td>&nbsp;: ".$nama_kecamatan."<td/>
                        </tr>  
                        <tr>
                            <td>Kelurahan<td/>
                            <td>&nbsp;: ".$nama_kelurahan."<td/>
                        </tr>  
                      </table>";
            $html .= "</p>";
            echo $html;
        }
    }

    public function sms()
    {
        UserAuth::cek_authorize($this);
        $this->log_model->set_log("masuk menu sms");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js', 'assets/new/select2/select2.min.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
        if ($this->input->post()) {
            $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
            $this->form_validation->set_rules('isi', 'Isi Pesan', 'trim|required');
            $this->form_validation->set_message('required', '%s belum diisi');
            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
            } else {
                $this->load->model('sms_model');
                $tujuan_arr = $this->input->post('tujuan');
                $isi = $this->input->post('isi');
                foreach ($tujuan_arr as $key => $value) {
                    $sms = array();
                    $value = explode('_', $value);
                    $value = $value[1];
                    // $info = $this->petugas_model->get_info_petugas($value);
                    // if ($info == array()) continue;
                    // if (!$info['no_hp_petugas']) continue;
                    if (!$value) continue;
                    $sms['DestinationNumber'] = $value;
                    $sms['TextDecoded'] = $isi;
                    $this->sms_model->send_sms($sms);
                    //$this->linkSMS($value,$isi);
                }
                $data['success'] = 'Pesan berhasil dikirim';
            }
        }
        $data['all_hp'] = $this->petugas_model->all_hp();
        $this->template->display_full('petugas/sms', $data);
    }
/*
    function linkSMS($numb,$sms){
	
		//echo $numb;
		//echo $sms;
        $host='http://103.15.233.20:9003/bin/send';
        $username='kediri';
        $pass='kediri564';
        if($numb[0] == "+")
            $numb = substr($numb, 1);
        else if($numb[0] == "0")
            $numb = "62".substr($numb, 1);
        foreach($this->sms_model->getHLR($numb) as $s){
            //$no = $s->nomer;
            $hlr= $s->hlr;
            switch($hlr){
                case 'tsel':$username='kedtsel';
                            $pass='kediri564';
                    break;
                case 'xl'  :$username='kedxl';
                            $pass='kediri564';
                    break;
                default :$username='kediri';
                         $pass='kediri564';
            }           
        }
        echo $url=$host.'?USERNAME='.$username.'&PASSWORD='.$pass.'&SOURCEADDR=PEMKOT_KDR&DESTADDR='.
        $numb.'&MESSAGE='.str_replace(' ','+',$sms);
        echo file_get_contents($url);
        return $url;
    }
*/
    public function report($tahun = null)
    {
        UserAuth::cek_authorize($this);
        $this->log_model->set_log("melihat Report");
        $data = array();
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js', 'assets/new/select2/select2.min.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');
        $tahun = $this->input->post('tahun');
        $data['arr'] = $this->petugas_model->report_tahunan($tahun);

        if($this->input->post('tahun') && $this->input->post('excel')){
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="data-'.$tahun.'.csv');

            $now = date('l jS \of F Y h:i:s A');
            $f = fopen('php://output', 'w');
            $delimiter = ',';
            fputcsv($f,array("LAPORAN TAHUN",$tahun),$delimiter);
            fputcsv($f,array("DIGENERATE PADA", $now),$delimiter);
            foreach ($data['arr']['stat'] as $line) {
                $tmp = array_keys($line);
                $tmp[] = $line[$tmp[0]];
                fputcsv($f, $tmp, $delimiter);
            }

            fputcsv($f, [], $delimiter);

            fputcsv($f, array_keys($data['arr']['data'][0]), $delimiter);
            foreach ($data['arr']['data'] as $line) {
                $line['isi_aduan'] = str_replace("<p>", "", $line['isi_aduan']);
                $line['isi_aduan'] = str_replace("</p>", "", $line['isi_aduan']);
                fputcsv($f, $line, $delimiter);
            }
        }
        else if($this->input->post('lihat'))
        {

            $data = $this->input->post();

            if($data['periode'] == '1')
            {

                $bulan1 = $data['bulan'];
                $bulan2 = $data['bulan2'];
                $tahun1 = $data['tahun'];
                $tahun2 = $data['tahun2'];

                if($bulan2=='01' || $bulan2=='03' || $bulan2=='05' || $bulan2=='07' || $bulan2=='08' || $bulan2=='10' || $bulan2=='12')
                {
                    $maxTgl = '31';
                }
                else if($bulan2 == '02')
                {
                    $maxTgl = '28';

                    $thn = intval($tahun2);
                    if($thn%4 == 0)
                    {
                         $maxTgl = '29';
                    }
                }
                else
                {
                    $maxTgl = '30';

                    
                }

                $data['tanggal_mulai'] = "$bulan1/01/$tahun1";
                $data['tanggal_selesai'] = "$bulan2/$maxTgl/$tahun2";
            }

            if($data['periode'] == '2')
            {
                
                $tahun1 = $data['tahun'];
                $tahun2 = $data['tahun2'];
                $data['tanggal_mulai'] = "01/01/$tahun1";
                $data['tanggal_selesai'] = "12/31/$tahun2";
            }

            //print_r($data);
            $this->view_report($data);
        }
        else
        {

            $data['departemen'] = $this->departemen_model->get_all();
            $data['status'] = $this->aduan_model->get_status();

            $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $data['tgl_skr'] = $dt->format('m/d/Y');


            $data['list_induk'] =   $this->departemen_model->list_induk_departemen();
            
            $this->template->display_full('petugas/report', $data);
        }
    }

    public function view_report($data = null)
    {
        //UserAuth::cek_authorize($this);


            $this->log_model->set_log("melihat Detail Report");
           // $data = array();
            $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js', 'assets/new/select2/select2.min.js');
            $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css', 'assets/new/select2/select2.css', 'assets/new/select2/select2-bootstrap.css');

            
            
            //$data['list_aduan'] = $this->departemen_model->get_all();
            //$temp = $data['tanggal_mulai']->format('d-m-Y');

            //echo date('Y-m-d',strtotime($data['tanggal_mulai']));
            $tahun = date('Y',strtotime($data['tanggal_mulai']));
            $temp1 = date('Y-m-d',strtotime($data['tanggal_mulai']));
            $temp2 = date('Y-m-d',strtotime($data['tanggal_selesai']));
            $temp3 = $data['departemen'];
            $temp4 = $data['status'];
            $temp5 = $data['jawaban'];
            $temp6 = $data['cek_induk'];
            //echo "The string ($temp) is bogus";

            //echo $temp5;
            $data['kategori'] = "$tahun $temp1 $temp2 $temp3 $temp4 $temp5 $temp6";

            

            

            $data['list_aduan'] = $this->petugas_model->all_aduan_rekap($data['kategori']);
            $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);

            $data['aturData'] = "";

            for ($i=0; $i <8 ; $i++) { 
             
                $tempp = "app".$i; 
 

                if(!isset($data[$tempp]))
                {
                    $data[$tempp] = "0";
                }

                $data['aturData'] .= "$data[$tempp] ";
                
            }
            
            //$data['aduan'] = $this->aduan_model->get_aduan($nomor_aduan);
           //echo $data['list_aduan'];
          //  print_r($data['list_aduan']);
          
           $this->template->display_full('petugas/view_report', $data);
            
            
        
    }


    /////////////////////////////////////////////////////////
    public function doprint($pdf=false, $kategori = "", $aturData = "")
    {
        $this->log_model->set_log("mencetak report Aduan");
         $data = array();
         //$data['tahun'] = $this->tahun;
         $temp = explode("%20", $kategori);
        


         $tahun = (int)$temp[0];
         $data['kategori'] = implode(" ", $temp);
     

         $data['list_aduan'] = $this->petugas_model->all_aduan_rekap($data['kategori']);
         $data['max_aduan'] = $this->petugas_model->get_last_aduan_by_year($tahun - 1);


         $data['tanggal_mulai'] = $temp[1];

         $temptgl = explode("-", $data['tanggal_mulai']);
         $tgl = $temptgl[2];
         $bln = $this->get_bulan($temptgl[1]);
         $thn = $temptgl[0];
         $data['tanggal_mulai'] = "$tgl $bln $thn";


         $data['tanggal_selesai'] = $temp[2];

         $temptgl = explode("-", $data['tanggal_selesai']);
         $tgl = $temptgl[2];
         $bln = $this->get_bulan($temptgl[1]);
         $thn = $temptgl[0];
         $data['tanggal_selesai'] = "$tgl $bln $thn";
        
         $data['departemen'] = $this->departemen_model->get_nama_departemen((int)$temp[3]);
         $data['status'] = $this->aduan_model->get_nama_status((int)$temp[4]);
         $data['jawaban'] = $temp[5];
           // echo $data['status' [1]];
         //echo $aturData;

         $temp2 = explode("%20", $aturData);

          for ($i=0; $i <8 ; $i++) { 
             
                $tempp = "app".$i; 
 

                if(!isset($data[$tempp]))
                {
                    $data[$tempp] = "$temp2[$i]";
                }

               
                
            }

         $output = $this->load->view('petugas/download_report',$data, true);
        return $this->_gen_pdf($output);
    }

    public function _gen_pdf($html,$paper='A4-L')
    {
         ob_end_clean();
         $CI =& get_instance();
         $CI->load->library('MPDF56/mpdf');
         $mpdf=new mPDF('utf-8', $paper );

         //$mpdf->Output('filename.pdf','F');

         $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
         $waktu = $dt->format('d/m/Y H:i:s');


         $filename = "Rekap Aduan $waktu";
         //$temp = "assets/new/img/logoKota.jpg";

        // $mpdf->SetHTMLHeader('<img src="<?php echo base_url(' .$temp. '); 

         $mpdf->SetHTMLFooter('
            <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
            <td width="33%">
                <span style="font-weight: bold; font-style: italic;" Waktu Cetak : > '  .$waktu. '
                </span></td>
            <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right; ">Surga</td>
            </tr></table>
        ');

         $mpdf->WriteHTML($html);
        // $mpdf->WriteHTML('Section 2 - No Footer');
       //  $mpdf->WriteHTML('Section 1');
         
        // $mpdf->debug = true;
         $mpdf->Output($filename,'I');
     }
    


    public function sms_salah()
    {
        UserAuth::cek_authorize($this);
        $data = array();
        if($this->input->post())
        {
            $text_sms_err = "Aduan TIDAK diterima, mohon cek kembali format aduan anda. Format Aduan: NIK#Nama#Isi Aduan. Pastikan NIK dan Nama anda sesuai KTP.";
            $data = $this->input->post();
            $value = $data['nomor_ktp']."#".$data['nama']."#".$data['isi_aduan'];

            $sms_valid = true;
            $sender_number = $data['no_telp'];
            $info = explode('#', $value);
            if (count($info) < 2) {
                $sms_valid = false;
            }

            // pengecekan nomor ktp dan nama
            if ($sms_valid) {
                foreach ($info as $key2 => $value2) {  //foreach ($info as $key2 => &$value2) {
                    $value2 = trim($value2);
                }
                if (!is_numeric($info[0])) $sms_valid = false;
                else if (strlen($info[0]) != 16) $sms_valid = false;
                $tmp = str_replace(' ', '', $info[1]);
                $tmp = str_replace('.', '', $tmp);
                $tmp = str_replace("'", '', $tmp);
                $tmp = str_replace(",", '', $tmp);
                if (!ctype_alpha($tmp)) $sms_valid = false;
                if(!$sms_valid)
                    echo "<script>alert('Penulisan Nama/KTP tidak benar');
                        window.location.href='".site_url('petugas/sms_salah')."'
                    </script>";
            }

            // cek data di db apakah ada?
            if ($sms_valid) {
                $data_db = $this->aduan_model->cek_ktp_db($info[0], $info[1]);
                if ($data_db == array()) {
                    $sms_valid = false;
                    echo "<script>alert('Data KTP tidak ditemukan dalam database');
                        window.location.href='".site_url('petugas/sms_salah')."'
                    </script>";
                }
            }

            // cek isi sms
            if ($sms_valid) {
                $isi_sms = '';
                $isi_sms = $info[2];
                if (!$isi_sms) $sms_valid = false;
            }

            if ($sms_valid) {
                $insert_data = array();
                $insert_data['no_identitas'] = $info[0];
                $insert_data['nama'] = $data_db['nama_lgkp'];
                $insert_data['alamat'] = '';
                $insert_data['uploaded_file'] = array();
                $insert_data['tgl_lahir'] = $data_db['tgl_lhr'];
                $insert_data['topik'] = '';
                $insert_data['isi'] = $isi_sms;
                $insert_data['waktu'] = date('Y-m-d H:i:s', time());;
                $insert_data['prioritas'] = '3';
                $insert_data['status'] = '1';
                $insert_data['departemen'] = '1';
                $insert_data['kategori'] = null;
                $insert_data['via_sms'] = '1';
                $insert_data['no_hp'] = $sender_number;
                $no_aduan = $this->aduan_model->add($insert_data);
                if($no_aduan){
                    $this->petugas_model->delete_sms($data['id_aduan']);
                    echo "<script>alert('Aduan Sukses dimasukkan Ke database');
                        window.location.href='".site_url('petugas/sms_salah')."'
                    </script>";
                }
            }
        }
        $data['js_files'] = array('assets/datatable/media/js/jquery.dataTables.min.js', 'assets/datatable/media/js/dataTables.bootstrap.js', 'assets/timeago/jquery.timeago.js', 'assets/timeago/locales/jquery.timeago.id.js');
        $data['css_files'] = array('assets/datatable/media/css/jquery.dataTables.min.css', 'assets/datatable/media/css/dataTables.bootstrap.css');
        $data['table'] = $this->petugas_model->get_invalid_sms();
        if ($this->input->post()) {
        } else {
            $this->template->display_full('petugas/helper', $data);
        }
    }

    public function ganti_password()
    {
        $this->log_model->set_log("mengubah password");
        $data = array();
        if ($this->input->post()) {
            $this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required');
            $this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required|matches[repass_baru]');
            $this->form_validation->set_rules('repass_baru', 'Ulangi Password Baru', 'trim|required');
            $this->form_validation->set_message('required', '%s belum diisi');
            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
            } else {
                $data_petugas = $this->session->userdata('data_petugas');
                $pass_lama = $this->input->post('pass_lama');
                $pass_baru = $this->input->post('pass_baru');
                if ($this->petugas_model->ubah_password($data_petugas['id_petugas'], $pass_lama, $pass_baru)) {
                    $data['success'] = 'Password berhasil diubah';
                } else {
                    $data['error'] = "Password Lama TIDAK Cocok";
                }
            }
        }
        $this->template->display_full('petugas/ganti_password', $data);
    }


    public function get_bulan($temp)
    {
         
        $temp = (int)$temp;
        if($temp == 1)
        {
            return "Januari";
        }
        else if($temp == 2)
        {
            return "Februari";
        }
        else if($temp == 3)
        {
            return "Maret";
        }
        else if($temp == 4)
        {
            return "April";
        }
        else if($temp == 5)
        {
            return "Mei";
        }
        else if($temp == 6)
        {
            return "Juni";
        }
        else if($temp == 7)
        {
            return "Juli";
        }
        else if($temp == 8)
        {
            return "Agustus";
        }
         else if($temp == 9)
        {
            return "September";
        }
        else if($temp == 10)
        {
            return "Oktober";
        }
        else if($temp == 11)
        {
            return "November";
        }
        else if($temp == 12)
        {
            return "Desember";
        }
        else
        {
            return "0";
        }
    }

    public function get_bulan_angka($temp)
    {
         
        
        if($temp == "Januari")
        {
            return "01";
        }
        else if($temp == "Februari")
        {
            return "02";
        }
        else if($temp == "Maret")
        {
            return "03";
        }
        else if($temp == "April")
        {
            return "04";
        }
        else if($temp == "Mei")
        {
            return "05";
        }
        else if($temp == "Juni")
        {
            return "06";
        }
        else if($temp == "Juli")
        {
            return "07";
        }
        else if($temp == "Agustus")
        {
            return "08";
        }
         else if($temp == "September")
        {
            return "09";
        }
        else if($temp == "Oktober")
        {
            return "10";
        }
        else if($temp == "November")
        {
            return "11";
        }
        else if($temp == "Desember")
        {
            return "12";
        }
        else
        {
            return "99";
        }
    }

            //$url = "http://localhost/ticketing/webservice/insertHasilContent.php"; 

        // mengirim GET request ke sistem A dan membaca respon XML dari sistem A
        //$bacaxml = simplexml_load_file($url);

        // membaca data XML hasil dari respon sistem A
        //foreach($bacaxml->response as $respon)
        //{
          

          //if ($respon == "TRUE") echo "Login Sukses";
          //else if ($respon == "FALSE") echo "Login Gagal";
        //}  

        //print_r($data['list_konten']);

        //$html = file_get_html('http://aampuh.blogspot.com/feeds/posts/default');
}
