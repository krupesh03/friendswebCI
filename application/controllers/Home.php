<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function index($page='homepage') {

		global $site_title;
		
		if( !file_exists(APPPATH.'/views/'.$page.'.php') ) {
			show_404();
		}

		if( $this->session->has_userdata('logged_in') ) {
			redirect('myaccount');
		}
		
		$data['title'] = 'Welcome to the '.$site_title;
		$this->load->view('templates/header',$data);
		$this->load->view($page);
		$this->load->view('templates/footer');
	}
}
