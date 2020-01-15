<?php

class Settings extends BASE_controller {

	public function index($page = 'settings_homepage') {

		if(!file_exists(APPPATH.'/views/'.$page.'.php')){
			show_404();
		}
		$values = $this->Getdata->getuserdata();
		$data = $this->headerfunction();
		$data['title'] = 'Home | '.ucfirst($values['fname']).' '.ucfirst($values['lname']);
		$data['rs'] = $this->Getdata->get_relationship_status();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/leftbar');
		$this->load->view($page, $data);
		$this->load->view('templates/rightbar');
		$this->load->view('templates/footer');
	}

	public function profile_update() {

		if($this->input->is_ajax_request()) {
			parse_str($this->input->post('formData'), $values);
			return $this->Settingsmodel->profile_update($values);
		}
	}
}
?>