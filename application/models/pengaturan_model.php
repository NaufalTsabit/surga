<?php

class Pengaturan_model extends CI_Model  {

	function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function get_all()
    {
        $query = $this->db->get('pengaturan');
        /*
        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['value_option'] = $row->tgl_start_notif;
            return $data['value_option'];
        }
    */
        return $query->row_array();
    }

    function get_count()
    {
        $query = $this->db->get('pengaturan');
        
        return $query->num_rows();
    }
    function get_all_notifikasi()
    {
        $query = $this->db->get('pengaturan');
        
        return $query->result_array();
    }

    function tambah_notifikasi($data)
    {
        $this->db->trans_start();
        $this->db->insert('pengaturan', $data);
        $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return 0;
        return true;
    }

    function update_notifikasi($id_pengaturan, $data)
    {

        $this->db->trans_start();

        $this->db->where('id_pengaturan', $id_pengaturan);
        $this->db->update('pengaturan', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function hapus_notifikasi($id_pengaturan)
    {

        $this->db->trans_start();

        $this->db->where('id_pengaturan', $id_pengaturan);
        $this->db->delete('pengaturan');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    function get_all_option()
    {
        $query = $this->db->get('option');
        return $query->row_array();
    }

    function get_value($id_option = null)
    {
        

        $this->db->where('id_option', $id_option);
        $query = $this->db->get('option');

        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['value_option'] = $row->nilai_option;
            return $data['value_option'];
        }

        return 0;
    }

    function get_info($id_option = null)
    {
        

        $this->db->where('id_option', $id_option);
        $query = $this->db->get('option');

        if($query->num_rows())
        {
            $row = $query->row('1');
            $data['value_option'] = $row->info_option;
            return $data['value_option'];
        }

        return 0;
    }

    function update_option($id_option, $data)
    {

        $this->db->trans_start();

        $this->db->where('id_option', $id_option);
        $this->db->update('option', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) return false;
        return true;
    }

    
}
