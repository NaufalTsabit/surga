<?php

class Kategori_model extends CI_Model  {

	function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function get_all()
    {
        $query = $this->db->get('kategori');
        return $query->result_array();
    }

    function tambah_kategori($data)
    {
        $this->db->insert('kategori', $data);
        $id_kategori = $this->db->insert_id();
        return $id_kategori;
    }

    function update_kategori($id_kategori, $data)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori', $data);
        return true;
    }

    function hapus_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete('kategori');
        return true;
    }
}
