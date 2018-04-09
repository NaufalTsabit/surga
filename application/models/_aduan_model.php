<?php

class Aduan_model extends CI_Model  {

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
        $this->load->model(array('petugas_model','log_model'));
    }

    function get_all()
    {
        //$this->log_model->set_log("Melihatasksafskjfsdjkk Aduan");
        $this->db->where('spam', '0');
        $query = $this->db->get('aduan');
        return $query->result_array();
    }

    function get_longlat_by_month_year($month, $year, $kategori, $status)
    {
        $this->db->where('spam', '0');
		$this->db->where("date_format(waktu,'%Y') =","$year");
		if( strlen($month) == 1) {
			$month = '0' . $month;
		}
		$this->db->where("date_format(waktu,'%m') =","$month");
		//$this->db->where('longitude !=', '');
		//$this->db->where('latitude !=', '');
		if($kategori != 'semua') { 
			$this->db->where('kategori =', $kategori);
		}
		if($status == 'terjawab') { 
			$this->db->where('status =', '4');
		} elseif($status == 'belum') { 
			$this->db->where('status !=', '4');
		}  
		$this->db->join('kategori', 'kategori.id_kategori = aduan.kategori', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');

        $query = $this->db->get('aduan');
        return $query->result_array();
    }

    function add($data)
    {
        $this->db->trans_start();

        $uploaded_file = $data['uploaded_file'];
        unset($data['uploaded_file']);
        $this->db->insert('aduan', $data);
        $nomor_aduan = $this->db->insert_id();

        $data_detail = array();
        $data_detail['isi_detail'] = $data['isi'];
        $data_detail['waktu_detail'] = $data['waktu'];
        $data_detail['aduan'] = $nomor_aduan;
        $this->db->insert('detail_aduan', $data_detail);
        $id_detail_aduan = $this->db->insert_id();

        $data_status = array();
        $data_status['status_id_status'] = $data['status'];
        $data_status['aduan_id_aduan'] = $nomor_aduan;
        $data_status['waktu_status_aduan'] = $data['waktu'];
        $this->db->insert('status_aduan', $data_status);

        foreach ($uploaded_file as $key => $value) {
            $data_upload = array();
            $data_upload['id_upload'] = $value['raw_name'];
            $data_upload['orig_name'] = $value['orig_name'];
            $data_upload['path_upload'] = $value['file_name'];
            $data_upload['file_type'] = $value['file_type'];
            $data_upload['detail_aduan'] = $id_detail_aduan;
            $this->db->insert('upload', $data_upload);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return 0;
        return $nomor_aduan;
    }

    function kembali($nomor_aduan, $alasan)
    {
        $data_petugas = $this->session->userdata('data_petugas');
        $nama_petugas = $data_petugas['nama_petugas'];
        $user_name = $data_petugas['username_petugas'];
        $nama_departemen = $data_petugas['nama_departemen'];
        $data = array();
        $data['departemen'] = '1';
        $data['info'] = '2';
        $data['status'] = '6';
        $data['info_detail'] = "Aduan Dikembalikan oleh $nama_petugas ($user_name) dari $nama_departemen, dengan alasan: $alasan";
        $this->db->where('id_aduan', $nomor_aduan);
        $this->db->update('aduan', $data);

        $this->update_info($nomor_aduan, $data);
    }

    function update_info($nomor_aduan, $data)
    {
        $data_petugas = $this->session->userdata('data_petugas');

        $this->db->trans_start();

        $nama_departemen = $this->get_nama_department($data['departemen']);

        
        //echo $temp;
        
        // if ($data_petugas['role'] == '1') $data['petugas'] = null;
        if($data['info'] != '2')
        {


            $this->db->where('id_aduan', $nomor_aduan);
            $this->db->update('aduan', $data);
        }


        $this->db->where('aduan_id_aduan', $nomor_aduan);
        $this->db->order_by('waktu_status_aduan', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('status_aduan');
        if ($query->num_rows()) {
            $temp = $query->row_array();
            if ($temp['status_id_status'] != $data['status']) {
                $data_status_detail = array();
                $data_status_detail['waktu_status_aduan'] = date('Y-m-d H:i:s', time());
                $data_status_detail['status_id_status'] = $data['status'];
                $data_status_detail['aduan_id_aduan'] = $nomor_aduan;
                

                //print_r($temp);
                if($nama_departemen && $data['status'] != '5' && $data['status'] != '6')
                {
                    $data_status_detail['info_status_aduan'] = $nama_departemen;
                }
                else
                {
                    $data_status_detail['info_status_aduan'] = "";
                }
                
                

                
                $this->db->insert('status_aduan', $data_status_detail);
            }
        }

        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) return false;
        return true;
        
        

    }

    function list_chat($nomor_aduan)
    {
        $this->db->select('*, petugas.departemen as departemen_petugas');
        $this->db->join('aduan', 'aduan.id_aduan = detail_aduan.aduan');
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        // $this->db->join('status', 'status.id_status = aduan.status', 'left');
        // $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('petugas', 'petugas.id_petugas = detail_aduan.petugas_detail', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = petugas.departemen', 'left');
        $this->db->where('detail_aduan.aduan', $nomor_aduan);
        $this->db->order_by('detail_aduan.waktu_detail', 'asc');
        $query = $this->db->get('detail_aduan');

        if ($query->num_rows()) {
            $retval = $query->result_array();
            foreach ($retval as $key => &$value) {
                $this->db->where('upload.detail_aduan', $value['id_detail_aduan']);
                $query = $this->db->get('upload');
                $value['upload'] = $query->result_array();
            }
            return $retval;
        }
        return array();
    }

    function jawab($jawaban, $selesai = false, $kirim_sms = false)
    {
        $this->db->insert('detail_aduan', $jawaban);
        $status = ($this->db->affected_rows() != 1) ? false : true;
        if ($status && $selesai) {
            $this->db->where('id_aduan', $jawaban['aduan']);
            $this->db->update('aduan', array('status' => '4'));
        }
        if ($status && $kirim_sms) {
            $this->db->select('no_hp');
            $this->db->where('id_aduan', $jawaban['aduan']);
            $query = $this->db->get('aduan');
            if ($query->num_rows()) {
                $sender_number = $query->row_array();
                $sender_number = $sender_number['no_hp'];
				$nomor_aduan = $jawaban['aduan'] - $this->petugas_model->get_last_aduan_by_year(date("Y") - 1);
                $text_sms = "Jawaban Aduan #".$nomor_aduan.": ".$jawaban['isi_detail'];
                $balasan_sms = array();
                $balasan_sms['DestinationNumber'] = $sender_number;
                $balasan_sms['TextDecoded'] = $text_sms;
                $this->load->model('sms_model');
                $this->sms_model->send_sms($balasan_sms);
	   
            }
        }
        return $status;
    }

    function berhak($nomor_aduan)
    {
        $data_petugas = $this->session->userdata('data_petugas');
        if (!$data_petugas) return false;
        // kalau staff hanya boleh jawab pertanyaan yg buat dia, kalau tidak cari yg satu departemen boleh jawab semua (admin, supervisor, dll)
        $this->db->where('id_aduan', $nomor_aduan);

        if ($data_petugas['id_role'] == '3') {
            $this->db->where('(aduan.status = 7 OR aduan.status = 4 OR aduan.status = 8)');
            //$this->db->where('aduan.departemen', $data_petugas['departemen']);


            //$this->db->where('petugas', $data_petugas['id_petugas']);
           
            //$this->db->where('spam', '0');
        } else if ($data_petugas['id_role'] == '4') {
         //   $this->db->where('departemen', $data_petugas['id_departemen']);

        } 
          //  $this->db->where('spam', '0');
        
        


        $query = $this->db->get('aduan');

        if ($query->num_rows()) return true;
        return false;
    }

    function flag_spam($nomor_aduan)
    {
        $data = array('spam' => '1');
        $this->db->where('id_aduan', $nomor_aduan);
        $this->db->update('aduan', $data);
    }

    function hapus_aduan($nomor_aduan)
    {

        $this->db->trans_start();

        $this->db->where('id_aduan', $nomor_aduan);
        $this->db->delete('aduan');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function cek_aduan($nomor_aduan, $tgl_lahir, $no_hp)
    {
        if (!$no_hp) $no_hp = 'xxx';
        $alt_hp = "+62" . substr($no_hp, 1);
        $alt_hp = $this->db->escape($alt_hp);
        $this->db->where('id_aduan', $nomor_aduan);
        $this->db->where('spam', '0');
        $this->db->where('(tgl_lahir', $tgl_lahir);
        $this->db->or_where('no_hp', $no_hp);
        $this->db->or_where("no_hp = $alt_hp)");
        $query = $this->db->get('aduan');

        if ($query->num_rows()) {
            $this->session->set_userdata('id_aduan', $nomor_aduan);
            return true;
        }
        return false;
    }

    function get_department()
    {
        $this->db->order_by("nama_departemen", "asc");
        $query = $this->db->get('departemen');

        if($query->num_rows())
        {
            return $query->result_array();
        }
        return array();
    }

    function get_nama_department($id_departemen)
    {
        $this->db->where('id_departemen', $id_departemen);
        $query = $this->db->get('departemen');

        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['nama_departemen'] = $row->nama_departemen;
            return $data['nama_departemen'];
        }
        return array();
    }

    function get_kategori()
    {
        $this->db->order_by("nama_kategori", "asc");
        $query = $this->db->get('kategori');

        if($query->num_rows())
        {
            return $query->result_array();
        }
        return array();
    }

    function get_nama_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get('kategori');

        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['nama_kategori'] = $row->nama_kategori;
            return $data['nama_kategori'];
        }
        return '';
    }

    function get_priority()
    {

        $query = $this->db->get('prioritas');
        if($query->num_rows())
        {
            return $query->result_array();
        }
        return array();
    }

    function get_tahun($id_aduan)
    {

        $data = array();
        $sql = "select * from aduan where id_aduan = $id_aduan";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

            //$data['nama_lgkp'] = $row->nama_lgkp;
            //$data['alamat'] = $row->alamat;
           
            $date = $row->waktu;


            list($year, $month, $day) = explode('-', $date);

            $data['day'] = $day;
            $data['month'] = $month;
            $data['year'] = $year;
        } 
               
        return $year;
    }

    function get_status()
    {

        $query = $this->db->get('status');
        if($query->num_rows())
        {
            return $query->result_array();
        }
        return array();
    }


    function get_nama_status($id_status)
    {
        $this->db->where('id_status', $id_status);
        $query = $this->db->get('status');
        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['nama_status'] = $row->nama_status;
            return $data['nama_status'];
        }
        else
        {
            return "Semua";
        }
        return array();
    }
    


    function get_petugas($departemen = null)
    {
        $this->db->where('role', '3');
        if ($departemen) $this->db->where('departemen', $departemen);
        $query = $this->db->get('petugas');

        if($query->num_rows())
        {
            return $query->result_array();
        }
        return array();
    }

    function get_id_petugas($departemen = null)
    {
        $data = array();
        $sql = "select id_petugas from petugas where departemen = $departemen";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

           // $data['nama_lgkp'] = $row->nama_lgkp;
            //$data['alamat'] = $row->alamat;
           // $data['tgl_lhr'] = $row->tgl_lhr;

           return $row->id_petugas;
        } 
               
        return array();
    }

    function history_status($nomor_aduan)
    {
        $this->db->join('status', 'status.id_status = status_aduan.status_id_status');
        $this->db->join('aduan', 'aduan.id_aduan = status_aduan.aduan_id_aduan');
        $this->db->where('status_aduan.aduan_id_aduan', $nomor_aduan);
        $this->db->order_by('waktu_status_aduan', 'asc');
        $query = $this->db->get('status_aduan');
        // print_r($query->result_array());
        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function get_aduan($nomor_aduan = 0)
    {
        $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori', 'left');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        $this->db->join('petugas', 'petugas.id_petugas = aduan.petugas', 'left');
        $data_petugas = $this->session->userdata('data_petugas');
        if ($data_petugas['role'] != 4) $this->db->where('spam', '0');
        if ($nomor_aduan) {
            $this->db->where('id_aduan', $nomor_aduan);
            $query = $this->db->get('aduan');
            $result = $query->row_array();
            $result['list_chat'] = $this->list_chat($nomor_aduan);
        } else {
            $query = $this->db->get('aduan');
            $result = $query->result_array();
            foreach ($result as $key => &$value) {
                $value['list_chat'] = $this->list_chat($value['id_aduan']);
            }
        }
		
        return $result;
    }

    function cek_ktp_db($nik = '', $nama = '', $tgl_lahir = '')
    {
        $nik_asli = $nik;
        $nama_asli = $nama;
        $nik = $this->db->escape($nik);
        $nama = $this->db->escape_str($nama);
        $tgl_lahir = $this->db->escape($tgl_lahir);
        if($nama == ''){
            $sql = "select nama_lgkp from pengadu where nik = $nik";
        } else {
            $sql = "select * from pengadu where nik = $nik and (nama_lgkp like \"%$nama%\" or tgl_lhr = $tgl_lahir)";
            
        }
        
        $query = $this->db->query($sql);
        $data = $query->row_array();
        if ($data == array()) {
            $this->db->where('nik', $nik_asli);
            $query = $this->db->get('pengadu');
            $tmp = $query->row_array();
            if ($tmp == array()) return array();
            $nama_db = $tmp['nama_lgkp'];
            $nama_db = explode(' ', $nama_db);
            $nama_asli = strtoupper($nama_asli);
            foreach ($nama_db as $key => $value) {
                $value = strtoupper($value);
                // echo $value . ' ' . $nama_asli . '<br>';
                $pos = strpos($nama_asli, $value);
                if ($pos === false) continue;
                // echo "string";
                return $tmp;
            }
        }
        return $data;
    }

    function get_nomor_hp($role = 1, $departemen = null, $id_aduan = null)
    {
        $data = array();
        if($departemen == null)
        {
            $data = $this->db->query('select no_hp_petugas from petugas where role = '
                .$role.' and no_hp_petugas is not null')->result();
        }
        else if($departemen != null && $id_aduan!= null)
        {
            // under dev jika diadukan langsung menuju ke departemen yang dituju, akan ada sms ke
            // role 1 dan role 2 departemen bersangkutan
        }
        return $data;
    }

    function get_aduan_belum_selesai()
    {
        $this->load->model('pengaturan_model');
        $pengaturan = $this->pengaturan_model->get_all();
        $this->db->where('spam', '0');
        $this->db->where('status <>', '4');
        // $this->db->where('waktu >=', $pengaturan['tgl_start_notif']);
        $query = $this->db->get('aduan');
        return $query->result_array();
    }
    
    function cek_ktp_identitas($nik)
    {
        $data = array();
        $sql = "select * from pengadu where nik = $nik";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

            $data['nama_lgkp'] = $row->nama_lgkp;
            //$data['alamat'] = $row->alamat;
            $data['tgl_lhr'] = $row->tgl_lhr;

            $originalDate = $data['tgl_lhr'];
            $newDate = date("d-m-Y", strtotime($originalDate));
            $data['tgl_lhr'] = $newDate;
            $date = $row->tgl_lhr;

            //$orderdate = explode('-', $orderdate);
            //$month = $orderdate[0];
            //$day   = $orderdate[1];
            //$year  = $orderdate[2];
            //$date = '08/05/2010';
            list($year, $month, $day) = explode('-', $date);
            //list($data['tgl_lhr_temp'], $data['bln_lhr_temp'], $data['thn_lhr_temp']) = split('[/.-]', $date);
            //echo "Month: $month; Day: $day; Year: $year<br />\n";

            //$data['tmpt_lhr'] = $row->tgl_lhr;
            //$data['tmpt_lhr'] = $month;
            $data['day'] = $day;
            $data['month'] = $month;
            $data['year'] = $year;
        } 
               
        return $data;
    }
    
}
