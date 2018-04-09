<?php

class Petugas_model extends CI_Model  {

	function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function login($username, $password)
    {
    	$this->db->join('departemen', 'departemen.id_departemen = petugas.departemen');
    	$this->db->join('role', 'role.id_role = petugas.role');
    	$this->db->where('username_petugas', $username);
    	$this->db->where('password_petugas', $password);
    	$query = $this->db->get('petugas');
        $flag = 0;

    	if ($query->num_rows()) {
            $flag = 1;
			// $this->session->set_userdata('data_petugas', $query->row_array());
    		// return true;
    	} else {
            $this->db->join('departemen', 'departemen.id_departemen = petugas.departemen', 'left');
            $this->db->join('role', 'role.id_role = petugas.role');
            $this->db->where('petugas.role', '99');
            $this->db->where('username_petugas', $username);
            $this->db->where('password_petugas', $password);
            $query = $this->db->get('petugas');

            if ($query->num_rows()) {
                $flag = 2;
                // $this->session->set_userdata('petugas_stat', $query->row_array());
                // return true;
            } else {
                $this->db->join('departemen', 'departemen.id_departemen = petugas.departemen', 'left');
                $this->db->join('role', 'role.id_role = petugas.role');
                $this->db->where('petugas.role', '4');
                $this->db->where('username_petugas', $username);
                $this->db->where('password_petugas', $password);
                $query = $this->db->get('petugas');
                if ($query->num_rows()) {
                    $flag = 3;
                    // $this->session->set_userdata('petugas_admin', $query->row_array());
                    // return true;
                }
            }
        }
        if ($flag == 0) return false;
        $row = $query->row_array();
        $this->db->join('all_app', 'all_app.id_all_app = user_app.id_app');
        $this->db->where('user_app.petugas', $row['id_petugas']);
        $this->db->order_by('id_user_app', 'asc');
        $query = $this->db->get('user_app');
        $row['list_app'] = $query->result_array();
        if ($flag == 1) $this->session->set_userdata('data_petugas', $row);
        else if ($flag == 2) $this->session->set_userdata('petugas_stat', $row);
        else if ($flag == 3) $this->session->set_userdata('petugas_admin', $row);
        return true;
    }

    function getPengadu($no_ktp)
    {
        $this->db->join('pengadu', 'no_identitas = nik','left')
            ->where('nik', $no_ktp);
        $que = $this->db->get('aduan');
        return $que->result();
    }

    function getPengadu2($no_ktp)
    {
        $this->db->join('aduan', 'nik = no_identitas','left')
            ->where('no_identitas', $no_ktp);
        $que = $this->db->get('pengadu');
        return $que->result();
    }

    function list_aduan($tipe = 0)
    {
        $data_petugas = $this->session->userdata('data_petugas');
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');

        if ($data_petugas['id_role'] == '3') {
            if ($tipe == 0) {
                //$this->db->where('aduan.status <> 4');
                $this->db->where('aduan.status = 7');
                //$this->db->where('aduan.info = 1');
                //$this->db->where('aduan.status = 2');
            
            } else if ($tipe == 1) {
                $this->db->where('aduan.status = 4');
            }
            //$this->db->where('aduan.info <> 2');
            $this->db->where('aduan.departemen', $data_petugas['departemen']);
            //$this->db->where('aduan.petugas', $data_petugas['id_petugas']);
        } else if ($data_petugas['id_role'] != '1') {
            if ($tipe == 0) {
                $this->db->where('aduan.status <> 4');
            } else if ($tipe == 1) {
                $this->db->where('aduan.status = 4');
            }
            $this->db->where('aduan.departemen', $data_petugas['departemen']);
        }
        if ($tipe != 3 && $data_petugas['id_role'] == '1') $this->db->where('aduan.info', $tipe);
        $this->db->where('spam', '0');
        $query = $this->db->get('aduan');

        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function list_inbox_all()
    {
        $data_petugas = $this->session->userdata('data_petugas');
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');

        if ($data_petugas['id_role'] == '3') {
            
           
            //$this->db->where('aduan.status = 4');
            $this->db->where('aduan.departemen', $data_petugas['departemen']);

            $this->db->where('(aduan.status = 7 OR aduan.status = 8)');
        } else if ($data_petugas['id_role'] == '1') {
            
            $this->db->where('aduan.status <> 4');
            //$this->db->where('aduan.departemen', $data_petugas['departemen']);

        }
        
        $this->db->where('spam', '0');
        $query = $this->db->get('aduan');

        if ($query->num_rows()) return $query->result_array();
        return array();
    }


    function list_inbox_arsip()
    {
        $data_petugas = $this->session->userdata('data_petugas');
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        //$this->db->join('petugas', 'departemen.id_departemen = aduan.departemen', 'left');

        if ($data_petugas['id_role'] == '3') {
            
            $this->db->where('aduan.status = 4');
            $this->db->where('aduan.info = 4');
            $this->db->where('aduan.departemen', $data_petugas['departemen']);
        } else if ($data_petugas['id_role'] == '1') {
            
            //$this->db->where('aduan.status = 7 OR (aduan.status = 4 && )');
            //$this->db->where('aduan.departemen', $data_petugas['departemen']);
            //$this->db->where('aduan.departemen', $data_petugas['departemen']);
            $this->db->where('aduan.status = 4');
        }
        
        $this->db->where('spam', '0');
        $query = $this->db->get('aduan');

        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function list_inbox_monitor()
    {
        $data_petugas = $this->session->userdata('data_petugas');
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        //$this->db->join('petugas', 'departemen.id_departemen = aduan.departemen', 'left');
          
        //$this->db->where('aduan.status = 4');
        //$this->db->where('aduan.info = 4');
        $this->db->where('induk_departemen', $data_petugas['departemen']);

        
        $this->db->where('spam', '0');
        $query = $this->db->get('aduan');

        //print_r($data_petugas);
        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function all_aduan_rekap($temp = "")
    {
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        
        $this->db->where('spam', '0');

        $data = explode(" ", $temp);
        //echo $data[0];

        $tglMulai = explode("-", $data[1]);
        $tglSelesai = explode("-", $data[2]);
        //echo date_format($data[0],"Y-m-d");
        //$this->db->where('waktu', $data[0]);

       // print_r($tglMulai);
        /*
        $this->db->where("date_format(aduan.waktu,'%Y') >=","$tglMulai[0]");
        $this->db->where("date_format(aduan.waktu,'%Y') <=","$tglSelesai[0]");
        $this->db->where("date_format(aduan.waktu,'%m') >=","$tglMulai[1]");
        $this->db->where("date_format(aduan.waktu,'%m') <=","$tglSelesai[1]");
        

        $this->db->where("date_format(aduan.waktu,'%d') >=","$tglMulai[2]");
        $this->db->where("date_format(aduan.waktu,'%d') <=","$tglSelesai[2]");
        */

        $this->db->where("aduan.waktu >=","$data[1]");
        $this->db->where("aduan.waktu <=","$data[2] 23:59:59");

        if($data[3] != "0")
        {
            $this->db->where('aduan.info = 4');

            if($data[6] == "1")
            {
                //echo $data[6];
                $this->db->where("(departemen.id_departemen = $data[3] OR departemen.induk_departemen = $data[3])");
            }
            else
            {
                echo "gag";
                $this->db->where("departemen.id_departemen =","$data[3]");
                
            }
            

        }
        


        if($data[4] != "0")
        {
            $this->db->where("status.id_status =","$data[4]");
        }


        //$this->db->where("date_format(waktu,'%Y%m%d') >=","$data[0]");

        //select * from *table_name* where *datetime_column* >= '01/01/2009' and *datetime_column* <= curdate()
        //$this->db->where("date_format(waktu,'%Y') =","$tahun");
        //$this->db->where("aduan.id_aduan = 1");
        //$this->db->where("aduan.via_sms = 1");
        //$this->db->where("aduan.spam = 0");

        $this->db->order_by("id_aduan", "asc");

        $query = $this->db->get('aduan');
     
        $result = $query->result_array();
        foreach ($result as $key => &$value) {
            $value['list_chat'] = $this->aduan_model->list_chat($value['id_aduan']);
        }
        
        //print_r($result);

        if ($query->num_rows()) return $result;
        return array();
    }

    function all_aduan()
    {
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        $query = $this->db->get('aduan');

        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function all_aduan_by_year($tahun = NULL)
    {
        // $this->db->join('kategori', 'kategori.id_kategori = aduan.kategori');
        $this->db->join('status', 'status.id_status = aduan.status', 'left');
        $this->db->join('prioritas', 'prioritas.id_prioritas = aduan.prioritas', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = aduan.departemen', 'left');
        $this->db->where("date_format(waktu,'%Y') =","$tahun");
        $query = $this->db->get('aduan');



        if ($query->num_rows()) return $query->result_array();
        return array();
    }

    function get_last_aduan_by_year($tahun = NULL)
    {
       
        $data = array();
        $sql = "select MAX(id_aduan) from aduan where date_format(waktu,'%Y') = '".$tahun."'";
        $query = $this->db->query($sql);
        //$data = $query->result_array();
        $data = array_shift($query->result_array());
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

            //$data['temp'] = $row->MAX(id_aduan);

            //echo $data['MAX(id_aduan)'];

            return $data['MAX(id_aduan)'];
        } 
               
        return array();

        //$query = $this->db->query("select MAX(id_aduan) from aduan where date_format(waktu,'%Y') = 2014");
   
        //if ($query->num_rows()) return $query->result_array();
        //return array();
    }

    function all_hp()
    {
        $query = $this->db->get('petugas');
        $res = $query->result_array();
        $query = $this->db->get('departemen');
        $departemen = $query->result_array();
        foreach ($departemen as $key => $value) {
            $tmp = array(
                'nama_petugas' => 'Kepala ' . $value['nama_departemen'] . ' ' . $value['nama_kepala'],
                'no_hp_petugas' => $value['no_hp']
            );
            array_push($res, $tmp);
        }
        return $res;
    }

    function get_role()
    {
        $query = $this->db->get('role');
        return $query->result_array();
    }

    function get_app()
    {
        $query = $this->db->get('all_app');
        return $query->result_array();
    }

    function get_user_app()
    {
        $query = $this->db->get('user_app');
        return $query->result_array();
    }

    function get_all_petugas()
    {
        //$this->db->where('id_petugas', $id_petugas);

       // $this->db->join('departemen', 'departemen.id_departemen = petugas.departemen');
        //$this->db->join('role', 'role.id_role = petugas.role');
       // $this->db->join('user_app', 'user_app.petugas = petugas.id_petugas');
       // $this->db->join('all_app', 'user_app.id_app = all_app.id_all_app');

        $query = "SELECT *, GROUP_CONCAT( desc_app SEPARATOR ', \n') AS aplikasi 
                FROM (`petugas`) JOIN `departemen` ON `departemen`.`id_departemen` = `petugas`.`departemen` JOIN `role` 
                ON `role`.`id_role` = `petugas`.`role` LEFT OUTER JOIN `user_app` ON `user_app`.`petugas` = `petugas`.`id_petugas` LEFT OUTER JOIN `all_app` 
                ON `user_app`.`id_app` = `all_app`.`id_all_app` group by id_petugas";
       // $this->db->group_by('user_app'); 
        
        //$query = $this->db->get('petugas');
        $data = $this->db->query($query)->result_array();

        /*
        $query = $this->db->query($query);
        
        foreach ($data as $key => $value){
            if($value['id_app'] == 1)
            {
                $value['id_app']

            }

        }
        */
        return $data;
        
    }

    function get_info_petugas($id_petugas)
    {
        $this->db->where('id_petugas', $id_petugas);
        $query = $this->db->get('petugas');
        return $query->row_array();
    }

    function get_nama_kecamatan($kode_kec = null)
    {

        $data = array();

        $sql = "select * from kecamatan where kode_kecamatan = $kode_kec";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

            $data['nama_kecamatan'] = $row->nama_kecamatan;
            
            //echo $data['nama_kecamatan'];
            return $data['nama_kecamatan'];

        } 
               
        return array();
    }

    function get_nama_kelurahan($kode_kec = null, $kode_kel = null)
    {



        $data = array();

        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = kelurahan.kecamatan', 'left');

       
        $this->db->where('kecamatan.kode_kecamatan', $kode_kec);
        $this->db->where('kelurahan.kode_kelurahan', $kode_kel);

        

        $query = $this->db->get('kelurahan');

        $data = $query->result_array();

        //print_r($data);
        if ($query->num_rows() > 0)
        {
            $row = $query->row('1');

            //$data['nama_kelurahan'] = $row->nama_kelurahan;
            $temp = $row->nama_kelurahan;

            $pieces = explode("KELURAHAN ", $temp);
            //echo $data['nama_kecamatan'];
           //print_r($pieces);

            $data['nama_kelurahan'] = $pieces[1];

            return $data['nama_kelurahan'];

        } 
               
        return "tidak terdefinisi";
    }
    
    function report_tahunan($tahun)
    {
        $retval = array();
        $awal = $tahun."-1-1";
        $akhir = ($tahun+1)."-1-1";

        #aduan masuk
        $query = $this->db->query("select count(*) as aduan_masuk from aduan where aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'");
        $retval['stat'][] = $query->result_array()[0];
        #jumlah aduan belum ditindaklanjuti
        $query = $this->db->query("select count(*) as belum_ditindak_lanjut from aduan where info <> 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'");
        $retval['stat'][] = $query->result_array()[0];
        #jumlah aduan sudah ditindaklanjuti
        $query = $this->db->query("select count(*) as sudah_ditindak_lanjut from aduan where info = 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'");
        $retval['stat'][] = $query->result_array()[0];
        #jumlah aduan yang selesai sudah tertangani
        $query = $this->db->query("select count(*) as sudah_selesai from aduan where aduan.status = 4 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'");
        $retval['stat'][] = $query->result_array()[0];
        #jumlah aduan sampah
        $query = $this->db->query("select count(*) as `sampah` from aduan where spam = 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'");
        $retval['stat'][] = $query->result_array()[0];




        $this->db->select("id_aduan, no_identitas `nik_pengadu`, aduan.nama `nama_pengadu`, waktu, nama_petugas, nama_departemen, spam, topik `topik_aduan`, isi `isi_aduan`", false)
        ->join('petugas','aduan.petugas = petugas.id_petugas', 'left')
        ->join('departemen', 'aduan.departemen = departemen.id_departemen', 'left')
        ->where('aduan.waktu >=', $awal)
        ->where('aduan.waktu <', $akhir);

        $query = $this->db->get('aduan');
        $retval['data'] = $query->result_array();

        //print_r($retval);
        return $retval;
    }

    function get_invalid_sms()
    {
        $this->db->query('set GROUP_CONCAT_MAX_LEN = 20000');
        $data = $this->db->query('
            select id, nomor_pengirim, " " as grup, " " as urutan, waktu, isi
            from sms_tidak_valid
            where length(urutan) < 1
            union
            select id,nomor_pengirim, MID(urutan,length(urutan)-5,3) as grup, right(urutan,2) as urt,
            waktu, GROUP_CONCAT(isi SEPARATOR "") isi
            from sms_tidak_valid
            where length(urutan) > 1
            group by nomor_pengirim, grup'
        );
        return $data->result();
    }

    function delete_sms($id = '')
    {
        $data = $this->db->query("
            select * from sms_tidak_valid
            where id = '".$id."';
            ")->result();
        $data2 = $this->db->query("
                select *
                from sms_tidak_valid
                where left(urutan, length(urutan)-2) = '".substr($data[0]->urutan, 0, strlen($data[0]->urutan)-2)."'
                and urutan >= '".$data[0]->urutan."'
                and nomor_pengirim = '".$data[0]->nomor_pengirim."';
            ")->result();
        $deleted_array = array();
        foreach ($data2 as $key => $value) {
            $deleted_array[]= $value->id;
        }
        $this->db->where_in('id', $deleted_array);
        $this->db->delete('sms_tidak_valid');
    }

    function ubah_password($id_petugas, $pass_lama, $pass_baru)
    {
        $data_update = array('password_petugas' => $pass_baru);
        $this->db->where('id_petugas', $id_petugas);
        $this->db->where('password_petugas', $pass_lama);
        $query = $this->db->get('petugas');
        if ($query->num_rows()) {
            $this->db->where('id_petugas', $id_petugas);
            $this->db->update('petugas', $data_update);
            return true;
        }
        return false;
    }

    function tambah_petugas($data)
    {
        $this->db->trans_start();
        $this->db->insert('petugas', $data);
        $id_petugas = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return 0;
        return $id_petugas;
    }

    function update_petugas($id_petugas, $data)
    {

        $this->db->trans_start();

        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('petugas', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function hapus_petugas($id_petugas)
    {

        $this->db->trans_start();

        $this->db->where('id_petugas', $id_petugas);
        $this->db->delete('petugas');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function tambah_app($data)
    {
        $this->db->trans_start();
        $this->db->insert('user_app', $data);
        $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return 0;
        return true;
    }
/*
    function update_app($id_petugas, $data)
    {

        $this->db->trans_start();
       // $this->db->set('name', $name);

        $this->db->where('petugas', $id_petugas);
        $this->db->where('id_app', $data['id_app']);

        //$this->db->update('user_app', $data);
        $query = $this->db->get('user_app');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }
*/
    function hapus_app($id_petugas)
    {

        $this->db->trans_start();

        $this->db->where('petugas', $id_petugas);
        $this->db->where('id_app >', 4);

        $this->db->delete('user_app');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function hapus_all_app($id_petugas)
    {

        $this->db->trans_start();

        $this->db->where('petugas', $id_petugas);

        $this->db->delete('user_app');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }
}
