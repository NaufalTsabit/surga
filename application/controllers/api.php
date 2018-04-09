<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		// if ($this->session->userdata('data_petugas')) redirect('petugas');
		$this->load->model(array('statistik_model', 'sms_model', 'aduan_model', 'pengaturan_model', 'departemen_model', 'petugas_model'));
		$this->load->library('Curl');
    }

    public function get_aduan_stat($bulan, $tahun)
    {
        $data = $this->statistik_model->get_statistik_pelayanan($bulan, $tahun);
        echo json_encode($data);
    }

    public function get_aduan_by_year($tahun)
    {
        $data = $this->petugas_model->all_aduan_by_year($tahun);
        echo json_encode($data);
    }

    public function get_longlat_by_month_year($bulan, $tahun, $kategori='semua', $status='semua')
    {
        $data = $this->aduan_model->get_longlat_by_month_year($bulan, $tahun, $kategori, $status);
        echo json_encode($data);
    }

    public function read_inbox_sms()
    {
        $this->read_inbox_sms_aduan();
        $this->read_inbox_sms_jawaban();
    }

    private function read_inbox_sms_aduan()
    {
        $text_sms_err = "Aduan TIDAK diterima, mohon cek kembali format aduan anda. Format Aduan: NIK#Nama#Isi Aduan. Pastikan NIK dan Nama anda sesuai KTP.";
        $data = $this->sms_model->get_inbox();
        foreach ($data as $key => $value) {
            if (!$this->sms_model->sms_not_processed($value['ID'])) continue;
            $sms_valid = true;
            $sender_number = $value['SenderNumber'];
            $info = explode('#', $value['TextDecoded']);
            if (count($info) < 2) {
                $this->kirim_pesan_error($text_sms_err, $sender_number);
                $this->sms_model->flag_as_processed($value['ID']);
                continue;
                $sms_valid = false;
            }

            // pengecekan nomor ktp dan nama
            if ($sms_valid) {
                foreach ($info as $key2 => &$value2) {
                    $value2 = trim($value2);
                }
                if (!is_numeric($info[0])) $sms_valid = false;
                else if (strlen($info[0]) != 16) $sms_valid = false;
                $tmp = str_replace(' ', '', $info[1]);
                $tmp = str_replace('.', '', $tmp);
                $tmp = str_replace("'", '', $tmp);
                $tmp = str_replace(",", '', $tmp);
                if (!ctype_alpha($tmp)) $sms_valid = false;
            }

            // cek data di db apakah ada?
            if ($sms_valid) {
                $data_db = $this->aduan_model->cek_ktp_db($info[0], $info[1]);
                if ($data_db == array()) $sms_valid = false;
            }

            // cek isi sms
            if ($sms_valid) {
                $isi_sms = '';
                if ($value['UDH']) {
                    $isi_sms = $this->sms_model->get_full_text_sms($value['ID']);
                } else {
                    $ctr = 0;
                    foreach ($info as $key2 => &$value2) {
                        $value2 = $this->security->xss_clean($value2);
                        $ctr++;
                        if ($ctr > 2) {
                            $isi_sms .= $value2;
                        }
                    }
                }
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
                $insert_data['waktu'] = $value['ReceivingDateTime'];
                $insert_data['prioritas'] = '3';
                $insert_data['status'] = '1';
                $insert_data['departemen'] = '1';
                $insert_data['kategori'] = null;
                $insert_data['via_sms'] = '1';
                $insert_data['no_hp'] = $sender_number;

                if ($this->sms_model->sms_not_processed($value['ID'])) {
                    if ($nomor_aduan = $this->aduan_model->add($insert_data)) {
						$nomor_aduan -= $this->petugas_model->get_last_aduan_by_year(date("Y") - 1);
                        $text_sms = "Terima Kasih atas Aduan Anda, Nomor Aduan anda adalah #$nomor_aduan. Silakan cek aduan anda di alamat http://surga.kedirikota.go.id";
                        $balasan_sms = array();
                        $balasan_sms['DestinationNumber'] = $sender_number;
                        $balasan_sms['TextDecoded'] = $text_sms;
                        $this->sms_model->send_sms($balasan_sms);
						//$this->linkSMS($sender_number,$text_sms);

			$sms_text = "Telah masuk aduan baru dengan nomor aduan=".$nomor_aduan.' silahkan cek aduan tersebut ke website surga.kedirikota.go.id';
			$nomor_hp = $this->aduan_model->get_nomor_hp(1,$insert_data['departemen']); //role 1,departemen humas id=1
			foreach($nomor_hp as $nomor)
			{
				$balasan_sms = array();
				$balasan_sms['DestinationNumber'] = $nomor->no_hp_petugas;
				$balasan_sms['TextDecoded'] = $sms_text;
				$this->sms_model->send_sms($balasan_sms);
			}

                        $this->sms_model->flag_as_processed($value['ID']);
                    } else {
                        $this->kirim_pesan_error($text_sms_err, $sender_number);
                        $this->sms_model->flag_as_processed($value['ID']);
                    }
                }
            }

            // kirim sms peringatan format salah dsb
            if (!$sms_valid) {
                $this->kirim_pesan_error($text_sms_err, $sender_number);
				$this->sms_model->flag_as_processed($value['ID']);
             }
        }
    }

    private function read_inbox_sms_jawaban()
    {
        $text_sms_err = "Aduan TIDAK diterima, mohon cek kembali format aduan anda. Format Aduan: NIK#Nama#Isi Aduan. Pastikan NIK dan Nama anda sesuai KTP.";
        $data = $this->sms_model->get_inbox();
        foreach ($data as $key => $value) {
            if (!$this->sms_model->sms_not_processed($value['ID'])) continue;
            $sms_valid = true;
            $sender_number = $value['SenderNumber'];
            $info = explode('#', $value['TextDecoded']);
            if (count($info) < 3) {
                if ($this->sms_model->sms_not_processed($value['ID'])) {
                    // get full text untuk flag true pada semua chunk messagenya
                    if ($value['UDH']) $this->sms_model->get_full_text_sms($value['ID'], true);
                    $this->kirim_pesan_error($text_sms_err, $sender_number);
                    $this->sms_model->flag_as_processed($value['ID']);
                }
                continue;
            }

            foreach ($info as $key2 => &$value2) {
                $value2 = trim($value2);
            }
            // pengecekan apakah no hp berhak menjawab
            $alt_hp = str_replace('+62', '0', $sender_number);
            $alt_hp = $this->db->escape($alt_hp);
            $this->db->join('petugas', 'petugas.id_petugas = aduan.petugas');
            $this->db->where('aduan.id_aduan', $info[1]);
            $this->db->where('(no_hp_petugas', $sender_number);
            $this->db->or_where("no_hp_petugas = $alt_hp)");
            $query = $this->db->get('aduan');
            if ($query->num_rows() == 0) {
                $sms_valid = false;
            }
            $tmp = $query->row_array();

            // cek isi sms
            if ($sms_valid) {
                $isi_sms = '';
                if ($value['UDH']) {
                    $isi_sms = $this->sms_model->get_full_text_sms($value['ID']);
                } else {
                    $ctr = 0;
                    foreach ($info as $key2 => &$value2) {
                        $value2 = $this->security->xss_clean($value2);
                        $ctr++;
                        if ($ctr > 2) {
                            $isi_sms .= $value2;
                        }
                    }
                }
                if (!$isi_sms) $sms_valid = false;
            }

            if ($sms_valid) {
                $detail_jawaban = array();
                $detail_jawaban['waktu_detail'] = date('Y-m-d H:i:s', time());
                $detail_jawaban['aduan'] = $info[1];
                $detail_jawaban['isi_detail'] = $isi_sms;
                $detail_jawaban['petugas_detail'] = $tmp['id_petugas'];

                if ($this->sms_model->sms_not_processed($value['ID'])) {
                    if ($this->aduan_model->jawab($detail_jawaban, true)) {
                        $text_sms = "Terima Kasih atas jawaban Anda untuk nomor aduan #".$info[1].". Jawaban berhasil diterima.";
                        $balasan_sms = array();
                        $balasan_sms['DestinationNumber'] = $sender_number;
                        $balasan_sms['TextDecoded'] = $text_sms;
                        $this->sms_model->send_sms($balasan_sms);
						//$this->linkSMS($sender_number,$text_sms);
                        $this->sms_model->flag_as_processed($value['ID']);
                    } else {
                        $sms_valid = false;
                    }
                }
            }

            if (!$sms_valid && $this->sms_model->sms_not_processed($value['ID'])) {
                // get full text untuk flag true pada semua chunk messagenya
                if ($value['UDH']) $this->sms_model->get_full_text_sms($value['ID'], true);
                $this->kirim_pesan_error($text_sms_err, $sender_number);
                $this->sms_model->flag_as_processed($value['ID']);
            }
        }
    }

    function get_all_sms()
    {
        $this->sms_model->get_all_sms();
    }

    public function kirim_pesan_error($text_sms, $number)
    {
        $balasan_sms = array();
        $balasan_sms['DestinationNumber'] = $number;
        $balasan_sms['TextDecoded'] = $text_sms;
        $this->sms_model->send_sms($balasan_sms);
        //$this->linkSMS($number, $text_sms);
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('dmy', $date);
        return $d && $d->format('dmy') == $date;
    }

    function cek_notif()
    {
        $now_date = date("Y-m-d");
        $list_aduan = $this->aduan_model->get_aduan_belum_selesai();
        $pengaturan = $this->pengaturan_model->get_all();
        $days_limit = $pengaturan['selang_hari'];
        $no_hp_walikota = $pengaturan['no_hp_walikota'];
        $pesanD = "";
        $pesanW = "";
        $sPesan = array();
        // if (!$days_limit) return;
        foreach ($list_aduan as $key => $value) {
            $wkt = $value['waktu'];
            $dt = new DateTime($wkt);
            $weekday = date('N', strtotime($wkt));
            if ($weekday == 6 || $weekday == 7) {
                $dt->setISODate($dt->format('o'), $dt->format('W') + 1);
            }
            $aduan_date = $dt->format("Y-m-d");
            $query = "SELECT ((DATEDIFF('$now_date', '$aduan_date') - 1) -
                ((WEEK('$now_date') - WEEK('$aduan_date')) * 2) -
                (case when weekday('$now_date') = 6 then 1 else 0 end) -
                (case when weekday('$aduan_date') = 5 then 1 else 0 end)) as DifD";
            $result = $this->db->query($query);
            $diff = $result->row_array();
            $diff = $diff['DifD'];
            if ($diff >= $days_limit) {
                $tgl = new DateTime($value['waktu']);
                $tgl = $tgl->format("d-m");
                $departemen = $this->departemen_model->get_row($value['departemen']);
                if(count($departemen)){
                    $no_hp_departemen_terkait = $departemen["no_hp"];
                    //$pesan = "SURGA: Aduan no ".$value['id_aduan']." tgl ".$tgl." pada ".$departemen['nama_departemen']." belum diselesaikan";
                    $index = $departemen["nama_departemen"];
                    if(!array_key_exists($index, $sPesan)){
                        $sPesan[$index] = array("count" => 1, "no_hp" => $no_hp_departemen_terkait);
                    }
                    else{
                        $sPesan[$index]["count"] = $sPesan[$index]["count"]+1;
                    }
                }
            }
            // print_r($weekday . ' | ' . $wkt . ' | ' . $dt->format("Y-m-d") . ' | '. $diff . '<br>');
        }
        $pesanW .= "SURGA: Rekap aduan belum terjawab:\r\n";
        foreach ($sPesan as $key => $value) { //pesan masuk ke kepala skpd
            //var_dump($sPesan);
            $pesanW .= $key .":".$value["count"]."\r\n";
            $pesanD = "SURGA : Terdapat " .$value["count"]. " aduan belum terjawab pada Departemen anda ($key) http://surga.kedirikota.go.id/login";
            if($value["no_hp"] != null){
                $this->kirim_pesan($pesanD, $value["no_hp"]);
            //    $this->linkSMS($value["no_hp"], $pesanD);
            } 
        }
	//$no_hp_walikota = "085645272715"; 082136631707
        $this->kirim_pesan($pesanW, $no_hp_walikota);
       // $this->linkSMS($no_hp_walikota, $pesanW);
    }

	
/*
    function linkSMS($numb,$sms){
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
    function kirim_pesan($pesan, $no_hp_walikota)
    {
        $jmlSMS = ceil(strlen($pesan)/153);
        if ($jmlSMS == 1) {
            $balasan_sms = array();
            $balasan_sms['DestinationNumber'] = $no_hp_walikota;
            $balasan_sms['TextDecoded'] = $pesan;
            $this->sms_model->send_sms($balasan_sms);
			//$this->linkSMS($no_hp_walikota,$pesan);
            return;
        }
        $pecah  = str_split($pesan, 153);
        $query = "SHOW TABLE STATUS LIKE 'outbox'";
        $sms_conn = $this->load->database('sms', true);
        $result = $sms_conn->query($query);
        $data = $result->row_array();
        $newID = $data['Auto_increment'];
        for ($i=1; $i<=$jmlSMS; $i++) {
            $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);
            $msg = $pecah[$i-1];
            if ($i == 1) {
                $data_insert = array(
                    'DestinationNumber' => $no_hp_walikota,
                    'UDH' => $udh,
                    'TextDecoded' => $msg,
                    'ID' => $newID,
                    'MultiPart' => 'true',
                    'CreatorID' => 'Gammu'
                );
                $sms_conn->insert('outbox', $data_insert);
            } else {
                $data_insert = array(
                    'UDH' => $udh,
                    'TextDecoded' => $msg,
                    'ID' => $newID,
                    'SequencePosition' => $i
                );
                $sms_conn->insert('outbox_multipart', $data_insert);
            }
        }
    }
}
