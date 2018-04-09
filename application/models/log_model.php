<?php

class Log_model extends CI_Model  {

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
        //$this->load->session('default', true);
    }

    function get_all()
    {
        $query = $this->db->get('aktivitas');
        return $query->result_array();
    }

    public function set_log($aktivitas = " ")
    {
       // $aktivitas = "aserehe";
	if ($this->session->userdata('data_petugas')) {
        $data_petugas = $this->session->userdata('data_petugas');
        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $date = $dt->format('d:m:Y');
        $time = $dt->format('H:i:s');
        //list($dt_tgl, $dt_time) = explode(' ', $dt);
    	$data = array(
		   'id_petugas' => $data_petugas['id_petugas'] ,
           'nama_user' => $data_petugas['nama_petugas'],
		   'tanggal_aktivitas' => $date,
           'waktu_aktivitas' => $time,
		   'nama_aktivitas' => $aktivitas
		);

		$this->db->insert('aktivitas', $data); 
        //$this->db->insert('aduan', $data);
		}
    }



    function hapus_log($id_aktivitas)
    {

        $this->db->trans_start();

        $this->db->where('id_aktivitas', $id_aktivitas);
        $this->db->delete('aktivitas');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function hapus_all_log()
    {

        $this->db->trans_start();

        $this->db->empty_table('aktivitas');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

}
