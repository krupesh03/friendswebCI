<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_controller {

	public function __construct() {

        parent::__construct();
        if( $this->session->userdata('logged_in') ) {
            redirect('myaccount');
        }
    }

	public function index($page='homepage') {

		global $site_title;
		
		if( !file_exists(APPPATH.'/views/'.$page.'.php') ) {
			show_404();
		}
		
		$data['title'] = 'Welcome to the '.$site_title;
		$this->load->view('templates/header',$data);
		$this->load->view($page);
		$this->load->view('templates/footer');
	}
}
