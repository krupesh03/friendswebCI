<?php 

class Settingsmodel extends CI_model{

	public function _construct() {
		$this->load->database();
	}

	public function profile_update($array) {

		$update_array = array(
			'fname' => $array['fname'], 
			'lname' => $array['lname'], 
			'dob' => $array['dob'], 
			'gender' => $array['gender'], 
			'rel_status' => $array['rel_status'], 
			'edu_status' => $array['edu_status'], 
			'interests' => $array['interests']
		);
		$this->db->where('deleted=0 and id='.$this->session->userdata('id'));
		$this->db->update('users', $update_array);
	}
}
?>