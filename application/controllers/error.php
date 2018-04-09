<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
    }

    public function index()
    {
    	$data = array();
        $this->template->display('404',$data);
    }

}
