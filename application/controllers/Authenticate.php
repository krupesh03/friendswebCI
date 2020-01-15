<?php
class Authenticate extends CI_controller {

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

}