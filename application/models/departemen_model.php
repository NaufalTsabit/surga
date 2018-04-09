<?php

class Departemen_model extends CI_Model  {

	function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function get_all()
    {
        $this->db->order_by("nama_departemen", "asc");
        $query = $this->db->get('departemen');
        return $query->result_array();
    }

    function get_row($id_departemen)
    {
        $this->db->where('id_departemen', $id_departemen);
        $query = $this->db->get('departemen');
        return $query->row_array();
    }

    function get_nama_departemen($id_departemen)
    {
        $this->db->where('id_departemen', $id_departemen);
        $query = $this->db->get('departemen');

        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['nama_departemen'] = $row->nama_departemen;
            return $data['nama_departemen'];
        }
        else if($id_departemen == '0')
        {
            return "Semua";
        }
        else
        {
            return "";
        }

        return array();
    }

    function cek_induk_departemen()
    {
        $data_petugas = $this->session->userdata('data_petugas');

        $this->db->where('induk_departemen', $data_petugas['departemen']);
        $query = $this->db->get('departemen');

        if($query->num_rows())
        {
            return "1";
        }
        else
        {
            return "0";
        }

    }

    function list_induk_departemen()
    {
        //$this->db->order_by("nama_departemen", "asc");

        //$this->db->where('induk_departemen = ');

       // $query = "SELECT induk_departemen FROM `departemen` WHERE `induk_departemen` is not null group by induk_departemen"

        $data = array();
        $sql = "select induk_departemen from departemen where induk_departemen is not null group by induk_departemen";
        $query = $this->db->query($sql);
        $data = $query->result_array();

        if ($query->num_rows() > 0)
        {

            //print_r($data);
            return $data;

        }
        else
        {
            return array();
        }
    }

    function tambah_departemen($data)
    {
        $this->db->trans_start();
        $this->db->insert('departemen', $data);
        $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return 0;
        return true;
    }

    function update_departemen($id_departemen, $data)
    {

        $this->db->trans_start();

        $this->db->where('id_departemen', $id_departemen);
        $this->db->update('departemen', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function hapus_departemen($id_departemen)
    {

        $this->db->trans_start();

        $this->db->where('id_departemen', $id_departemen);
        $this->db->delete('departemen');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }
}
