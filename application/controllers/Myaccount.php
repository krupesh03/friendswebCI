<?php
class Myaccount extends BASE_controller {

	public function index($page='accountpage') {

		if(!file_exists(APPPATH.'/views/'.$page.'.php')) {
			show_404();
		}

		$values = $this->Getdata->getuserdata();
		$data = $this->headerfunction();
		$data['title'] = 'Home | '.ucfirst($values['fname']).' '.ucfirst($values['lname']);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/leftbar');
		$this->load->view($page);
		$this->load->view('templates/rightbar');
		$this->load->view('templates/footer');
	}

	public function myprofile($page='myprofilepage') {

		if(!file_exists(APPPATH.'/views/'.$page.'.php')) {
			show_404();
		}

		$values = $this->Getdata->getuserdata();
		$data = $this->headerfunction();
		$data['title'] = 'Profile | '.ucfirst($values['fname']).' '.ucfirst($values['lname']);
		$this->load->view('templates/header',$data);
		$this->load->view($page);
		$this->load->view('templates/rightbar');
		$this->load->view('templates/footer');
	}
}