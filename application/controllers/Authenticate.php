<?php
class Authenticate extends AUTH_controller {

	public function index() {

		if( $this->Getdata->signin() ) {
            $user_data = $this->Getdata->signin();
            $user_data['logged_in'] = TRUE;
            $this->Insertdata->status_update($user_data['id']);
            $this->session->set_userdata($user_data);
            redirect('myaccount');
        } else {
            $login_failed=" <div class='login_failed_msg'>
                                Invalid Email ID or Password
                            </div>";
            $this->session->set_flashdata('login_failed',$login_failed);
            redirect('/');
        }

	}

	public function logout() {
        $unset_data = array('id', 'dob', 'logged_in', 'unique_id');
        $this->Insertdata->logout_func();
        $this->session->unset_userdata($unset_data);
        redirect('/');
    }
}