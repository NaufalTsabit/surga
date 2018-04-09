<?php

class Statistik_model extends CI_Model  {

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function get_statistik_pelayanan($bulan = NULL, $tahun = NULL, $via_sms = 0)
    {
        $this->db->select("id_departemen, nama_departemen, 0 as masuk, 0 as terjawab, 0 as belum_terjawab", FALSE);
        $this->db->join("departemen", "aduan.departemen = departemen.id_departemen", "right outer");
        $this->db->group_by("nama_departemen");
        $this->db->order_by("id_departemen");
        $query = $this->db->get("aduan");

        $res = $query->result_array();

        $this->db->select("departemen.nama_departemen, count(*) as masuk");
        $this->db->join("departemen", "aduan.departemen = departemen.id_departemen", "left");
        if (empty($bulan)) {
            $this->db->where("date_format(waktu,'%Y') =","$tahun");
        }
        else {
            $this->db->where("aduan.waktu >","$tahun-$bulan-1");
            $this->db->where("aduan.waktu <","$tahun-".($bulan+1)."-1");
        }
        $this->db->where('via_sms',$via_sms);
        $this->db->where('spam', '0');
        $this->db->group_by("nama_departemen");
        $query = $this->db->get("aduan");
        $query = $query->result_array();

        for($i=0;$i<sizeof($res);$i++)
        {
            for($j=0;$j<sizeof($query);$j++)
            {
                if($res[$i]['nama_departemen'] == $query[$j]['nama_departemen'])
                {
                    $res[$i]['masuk']=$query[$j]['masuk'];
                }
            }
        }
        $this->db->select("departemen.nama_departemen, count(*) as terjawab");
        $this->db->join("departemen", "aduan.departemen = departemen.id_departemen", "left");
        if (empty($bulan)) {
            $this->db->where("date_format(waktu,'%Y') =","$tahun");
        }
        else {
            $this->db->where("aduan.waktu >","$tahun-$bulan-1");
            $this->db->where("aduan.waktu <","$tahun-".($bulan+1)."-1");
        }
        $this->db->where('via_sms',$via_sms);
        $this->db->where("aduan.status", "4");
        $this->db->where('spam', '0');
        $this->db->group_by("nama_departemen");
        $query = $this->db->get("aduan");
        $query = $query->result_array();

        for($i=0;$i<sizeof($res);$i++)
        {
            for($j=0;$j<sizeof($query);$j++)
            {
                if($res[$i]['nama_departemen'] == $query[$j]['nama_departemen'])
                {
                    $res[$i]['terjawab']=$query[$j]['terjawab'];
                }
            }
            $res[$i]['belum_terjawab'] = $res[$i]['masuk']-$res[$i]['terjawab'];
        }

        if (sizeof($res)>0) return $res;
        return array();
    }

    function get_statistik_waktu()
    {
        $this->db->select("nama_departemen, 0 as waktu", FALSE)
            ->join("departemen", "aduan.departemen = departemen.id_departemen", "right outer")
            ->where('departemen.id_departemen not in (1)')
            ->group_by("nama_departemen")
            ->order_by("id_departemen");
        $query = $this->db->get("aduan");
        $res = $query->result_array();

        $this->db->select("nama_departemen, round(avg(TIMESTAMPDIFF(HOUR,aduan.waktu, detail_aduan.waktu_detail)),2) as waktu", FALSE)
            ->join("departemen", "aduan.departemen = departemen.id_departemen", "left")
            ->join("detail_aduan", "detail_aduan.aduan = aduan.id_aduan", "left")
            ->where("aduan.`status`", "4")
            ->where('spam', '0')
            ->where("detail_aduan.waktu_detail","(select waktu_detail from detail_aduan where detail_aduan.aduan = aduan.id_aduan order by waktu_detail desc limit 1)", FALSE)
            ->group_by("nama_departemen");
        $query = $this->db->get("aduan");
        $query = $query->result_array();

        for($i=0;$i<sizeof($res);$i++)
        {
            for($j=0;$j<sizeof($query);$j++)
            {
                if($res[$i]['nama_departemen'] == $query[$j]['nama_departemen'])
                {
                    $res[$i]['waktu']=$query[$j]['waktu'];
                }
            }
        }
        
        if (sizeof($res)>0) return $res;
        return array();
    }

    function get_statistik_rating()
    {
        // rerata rating per departemen
        $query = $this->db->query("SELECT round(AVG(a.rating),1) AS rerata, b.nama_departemen
        FROM aduan a,departemen b
        WHERE a.`status` = 4 AND a.departemen=b.id_departemen AND a.rating != 0 AND a.departemen <> 1
        GROUP BY a.departemen order by rerata desc");
        return $query->result_array();
    }

    function get_statistik_all_time($via_sms = NULL)
    {
        $data = array();
        if ($via_sms !== NULL) {
            $this->db->where('via_sms',$via_sms);
            $this->db->where('via_sms is not null');
        }
        $this->db->where('spam', '0');
        $data['masuk'] = $this->db->count_all_results('aduan');
        if ($via_sms !== NULL) {
            $this->db->where('via_sms',$via_sms);
            $this->db->where('via_sms is not null');
        }
        $this->db->where('spam', '0');
        $this->db->where('status', '4');
        $data['terjawab'] = $this->db->count_all_results('aduan');
        $data['belum_terjawab'] = $data['masuk'] - $data['terjawab'];
        return $data;
    }

    function get_statistik_based_by_time($via_sms = NULL, $tahun = NULL, $bulan = NULL) {
        $data = array();
        $query = "SELECT COUNT(*) as jumlah FROM aduan WHERE spam = 0";
        if ($via_sms !== ' ') {
            $query .= " AND via_sms is not null AND via_sms = ".$via_sms;
        }
        if (!is_null($tahun)) {
            $query .= " AND DATE_FORMAT(waktu,'%Y') = ".$tahun;
            if ($bulan !== ' ') {
                $query .= " AND DATE_FORMAT(waktu,'%c') = ".$bulan;
            }
        }
        $data['masuk'] = (int)$this->db->query($query)->row_array()['jumlah'];
        $query .= " AND status = 4";
        $data['terjawab'] = (int)$this->db->query($query)->row_array()['jumlah'];
        $data['belum_terjawab'] = $data['masuk'] - $data['terjawab'];
        return $data;
    }

    function get_statistik_by_skpd($via_sms = NULL)
    {
        $this->db->select("departemen, count(*) as done, NULL as undone",FALSE);
        $this->db->where('spam',0);
        if ($via_sms !== NULL) {
            $this->db->where('via_sms',$via_sms);
        }
        $this->db->where('status',4);
        $this->db->group_by('departemen');
        $query = $this->db->get("aduan");
        $done = $query->result_array();

        $this->db->select("departemen, count(*) as undone, NULL as done",FALSE);
        $this->db->where('spam',0);
        if ($via_sms !== NULL) {
            $this->db->where('via_sms',$via_sms);
        }
        $this->db->where('status !=',4);
        $this->db->group_by('departemen');
        $query = $this->db->get("aduan");
        $undone = $query->result_array();

        $this->db->select('*');
        $query = $this->db->get("departemen");
        $departemen = $query->result_array();

        $new = array(array());
        for ($i=0; $i < sizeof($departemen); $i++) { 
            $new[$i]['id_departemen'] = $departemen[$i]['id_departemen'];
            $new[$i]['nama_departemen'] = $departemen[$i]['nama_departemen'];
            $new[$i]['done'] = 0;
            $new[$i]['undone'] = 0;
        }
        for ($i=0; $i < sizeof($done); $i++) {
            $new[($done[$i]['departemen'])-1]['done'] = (int)$done[$i]['done'];
        }
        for ($i=0; $i < sizeof($undone); $i++) {
            $new[($undone[$i]['departemen'])-1]['undone'] = (int)$undone[$i]['undone'];
        }

        return $new;
    }

    function get_statistik_by_kecamatan($via_sms = NULL, $tahun = NULL, $bulan = NULL) {
        $data = array();
        $query_sms = $query_tahun = $query_bulan = '';
        if ($via_sms !== ' ') {
            $query_sms = " AND via_sms is not null AND via_sms = ".$via_sms;
        }
        if (!is_null($tahun)) {
            $query_tahun = " AND DATE_FORMAT(waktu,'%Y') = ".$tahun;
            if ($bulan !== ' ') {
                $query_bulan = " AND DATE_FORMAT(waktu,'%c') = ".$bulan;
            }
        }
        $query = "select id_kecamatan, sum(temp2.jumlah) as masuk from 
                    (select pengadu.nik, kecamatan.id_kecamatan, temp.jumlah from pengadu, kecamatan,
                        (select aduan.no_identitas, count(*) as jumlah from aduan where spam = 0".$query_sms.$query_bulan.$query_tahun." group by aduan.no_identitas) temp
                    where pengadu.nik = temp.no_identitas and kecamatan.kode_kecamatan = pengadu.no_kec) temp2
                group by id_kecamatan";
        $this->db->query($query);
        $masuk = $this->db->query($query)->result_array();

        $query_terjawab = " AND status = 4";
        $query = "select id_kecamatan, sum(temp2.jumlah) as terjawab from 
                    (select pengadu.nik, kecamatan.id_kecamatan, temp.jumlah from pengadu, kecamatan,
                        (select aduan.no_identitas, count(*) as jumlah from aduan where spam = 0".$query_sms.$query_bulan.$query_tahun.$query_terjawab." group by aduan.no_identitas) temp
                    where pengadu.nik = temp.no_identitas and kecamatan.kode_kecamatan = pengadu.no_kec) temp2
                group by id_kecamatan";
        $terjawab = $this->db->query($query)->result_array();

        $this->db->select('*');
        $query = $this->db->get("kecamatan");
        $kecamatan = $query->result_array();

        $new = array(array());
        for ($i=0; $i < sizeof($kecamatan); $i++) { 
            $new[$i]['id_kecamatan'] = $kecamatan[$i]['id_kecamatan'];
            $new[$i]['nama_kecamatan'] = $kecamatan[$i]['nama_kecamatan'];
            $new[$i]['masuk'] = 0;
            $new[$i]['terjawab'] = 0;
        }
        for ($i=0; $i < sizeof($masuk); $i++) {
            $new[($masuk[$i]['id_kecamatan'])-1]['masuk'] = (int)$masuk[$i]['masuk'];
        }
        for ($i=0; $i < sizeof($terjawab); $i++) {
            $new[($terjawab[$i]['id_kecamatan'])-1]['terjawab'] = (int)$terjawab[$i]['terjawab'];
        }
        return $new;
    }

    function get_statistik_by_kelurahan($via_sms = NULL, $tahun = NULL, $bulan = NULL) {
        $data = array();

        //$this->db->join('kecamatan', 'kecamatan.id_kecamatan = kelurahan.kecamatan', 'left');

        $query_sms = $query_tahun = $query_bulan = '';
        if ($via_sms !== ' ') {
            $query_sms = " AND via_sms is not null AND via_sms = ".$via_sms;
        }
        if (!is_null($tahun)) {
            $query_tahun = " AND DATE_FORMAT(waktu,'%Y') = ".$tahun;
            if ($bulan !== ' ') {
                $query_bulan = " AND DATE_FORMAT(waktu,'%c') = ".$bulan;
            }
        }
        $query = "select id_kelurahan, sum(temp2.jumlah) as masuk from 
                    (select pengadu.nik, kelurahan.id_kelurahan, temp.jumlah from pengadu, kelurahan,
                        (select aduan.no_identitas, count(*) as jumlah from aduan where spam = 0".$query_sms.$query_bulan.$query_tahun." group by aduan.no_identitas) temp
                    where pengadu.nik = temp.no_identitas and kelurahan.kode_kelurahan = pengadu.no_kel and kelurahan.kode_kecamatan = pengadu.no_kec) temp2
                group by id_kelurahan";
        $this->db->query($query);
        $masuk = $this->db->query($query)->result_array();

        $query_terjawab = " AND status = 4";
        $query = "select id_kelurahan, sum(temp2.jumlah) as terjawab from 
                    (select pengadu.nik, kelurahan.id_kelurahan, temp.jumlah from pengadu, kelurahan, 
                        (select aduan.no_identitas, count(*) as jumlah from aduan where spam = 0".$query_sms.$query_bulan.$query_tahun.$query_terjawab." group by aduan.no_identitas) temp
                    where pengadu.nik = temp.no_identitas and kelurahan.kode_kelurahan = pengadu.no_kel and kelurahan.kode_kecamatan = pengadu.no_kec) temp2
                group by id_kelurahan";
        $terjawab = $this->db->query($query)->result_array();

         //print_r($masuk);
        // where pengadu.nik = temp.no_identitas and kelurahan.refer_kelurahan = pengadu.no_kel and kelurahan.kecamatan = pengadu.no_kec) temp2
 
        $this->db->select('*');
        $query = $this->db->get("kelurahan");
        $kelurahan = $query->result_array();

       
        
        $new = array(array());
        for ($i=0; $i < sizeof($kelurahan); $i++) { 
            $new[$i]['id_kelurahan'] = $kelurahan[$i]['id_kelurahan'];
            $new[$i]['nama_kelurahan'] = $kelurahan[$i]['nama_kelurahan'];
            $new[$i]['masuk'] = 0;
            $new[$i]['terjawab'] = 0;
        }
        for ($i=0; $i < sizeof($masuk); $i++) {
            $new[($masuk[$i]['id_kelurahan'])-1]['masuk'] = (int)$masuk[$i]['masuk'];
        }
        for ($i=0; $i < sizeof($terjawab); $i++) {
            $new[($terjawab[$i]['id_kelurahan'])-1]['terjawab'] = (int)$terjawab[$i]['terjawab'];
        }
        return $new;
        
    }
    
    public function get_statistik_petugas()
    {
        $retval = array();
        $tmp = $this->db->query('select concat(nama_petugas," (",username_petugas, ")") as nama_petugas, 0 as `tuju`, 0 as `jawab`, 0 as `belum`
            from petugas
            order by id_petugas asc', false)->result();
        foreach ($tmp as $value) {
            $dd = array();
            $dd['nama_petugas'] = $value->nama_petugas;
            $dd['tuju'] = (int)$value->tuju;
            $dd['jawab'] = (int)$value->jawab;
            $dd['belum'] = (int)$value->belum;
            $retval[] = $dd;
        }
        
        $tmp = $this->db->query('select concat(nama_petugas," (",username_petugas, ")") as nama_petugas, count(*) `tuju`
            from aduan left join petugas on aduan.petugas = petugas.id_petugas
            group by concat(nama_petugas," (",username_petugas, ")")
            order by id_petugas asc', false)->result();
        
        foreach($tmp as $value)
        {
            for($i=0 ; $i<count($retval);$i++){
                if($retval[$i]['nama_petugas'] == $value->nama_petugas){
                    $retval[$i]['tuju'] = (int)$value->tuju;
                }   
            }
        }
        $tmp = $this->db->query('select concat(nama_petugas," (",username_petugas, ")") as nama_petugas, count(*) `jawab`
            from aduan left join petugas on aduan.petugas = petugas.id_petugas
            and status = 4
            group by concat(nama_petugas," (",username_petugas, ")")
            order by id_petugas asc', false)->result();
        
        foreach($tmp as $value)
        {
            for($i=0 ; $i<count($retval);$i++){
                if($retval[$i]['nama_petugas'] == $value->nama_petugas){
                    $retval[$i]['jawab'] = (int)$value->jawab;
                }
                $retval[$i]['belum'] = $retval[$i]['tuju']-$retval[$i]['jawab'];
            }
        }
        return $retval;
    }
}

