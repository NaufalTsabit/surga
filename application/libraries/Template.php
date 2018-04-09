<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {
    
    protected $_ci;
    
    function __construct()
    {
        $this->_ci = &get_instance();
        header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
        header("Pragma: no-cache"); //HTTP 1.0
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
         $this->_ci->load->model(array('petugas_model'));
    }

    function display($page, $data)
    {
        if (!array_key_exists('css_files', $data)) $data['css_files'] = array();
        if (!array_key_exists('js_files', $data)) $data['js_files'] = array();
        $data['jum_0'] = count($this->_ci->petugas_model->list_aduan(0));
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header_new', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer_new', $data, true);
        // $data['_sidebar']=$this->_ci->load->view('base/sidebar', $data, true);

        $this->_ci->load->view('base/template_default.php',$data);
    }

    function display_no_footer($page, $data)
    {
        if (!array_key_exists('css_files', $data)) $data['css_files'] = array();
        if (!array_key_exists('js_files', $data)) $data['js_files'] = array();
        $data['jum_0'] = count($this->_ci->petugas_model->list_aduan(0));
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header_new', $data, true);
        $data['_footer']=NULL;
        // $data['_sidebar']=$this->_ci->load->view('base/sidebar', $data, true);

        $this->_ci->load->view('base/template_default.php',$data);
    }

    function display_full($page, $data)
    {
        if (!array_key_exists('css_files', $data)) $data['css_files'] = array();
        if (!array_key_exists('js_files', $data)) $data['js_files'] = array();
        $this->_ci->load->model(array('petugas_model'));
        $data['jum_0'] = count($this->_ci->petugas_model->list_aduan(0));
        $data['jum_1'] = count($this->_ci->petugas_model->list_aduan(1));
        $data['jum_2'] = count($this->_ci->petugas_model->list_aduan(2));
        $data['jum_3'] = count($this->_ci->petugas_model->list_aduan(3));

        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header_new', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer_new', $data, true);
        // $data['_sidebar']=$this->_ci->load->view('base/sidebar', $data, true);

        $this->_ci->load->view('base/template_full.php',$data);
    }

    function display_chat($page, $data)
    {
        if (!array_key_exists('css_files', $data)) $data['css_files'] = array();
        if (!array_key_exists('js_files', $data)) $data['js_files'] = array();
        $this->_ci->load->model(array('petugas_model'));
        $data['jum_0'] = count($this->_ci->petugas_model->list_aduan(0));
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header_new', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer_new', $data, true);
        $data['_sidebar']=$this->_ci->load->view('aduan/sidebar', $data, true);

        $this->_ci->load->view('base/template_sidebar.php',$data);
    }

    function display_petugas($page, $data)
    {
        if (!array_key_exists('css_files', $data)) $data['css_files'] = array();
        if (!array_key_exists('js_files', $data)) $data['js_files'] = array();
        
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer', $data, true);
        $data['_sidebar']=$this->_ci->load->view('petugas/sidebar', $data, true);

        $this->_ci->load->view('base/template_sidebar.php',$data);
    }

    function display_home($page, $data)
    {
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer', $data, true);

        if($page=="umum/beranda")
            $data['_sidebar']=$this->_ci->load->view('base/sidebar_home', $data, true);
        else
            $data['_sidebar']=$this->_ci->load->view('base/sidebar', $data, true);

        $this->_ci->load->view('base/template_home.php',$data);
    }

    function display_daftar($page, $data)
    {
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer', $data, true);

        $this->_ci->load->view('base/template_daftar.php',$data);
    }

    function display_error($page, $data)
    {
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer', $data, true);
        $data['_sidebar']=$this->_ci->load->view('base/sidebar', $data, true);

        $this->_ci->load->view('base/template_error.php',$data);
    }

    function display_rekap($page, $data)
    {
        $data['_content']=$this->_ci->load->view($page, $data, true);
        $data['_header']=$this->_ci->load->view('base/header', $data, true);
        $data['_footer']=$this->_ci->load->view('base/footer', $data, true);
        $data['_sidebar']=$this->_ci->load->view('base/sidebar_rekap', $data, true);

        $this->_ci->load->view('base/template_default.php',$data);
    }
}