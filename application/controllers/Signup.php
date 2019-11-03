<?php
class Signup extends AUTH_Controller {
    public function index() {
        if( $this->form_validation->run()==FALSE ) {
            $data['title'] = 'Welcome to the FriendsBook';
            $this->load->view('templates/header',$data);
            $this->load->view('homepage');
            $this->load->view('templates/footer');
        } else {
            $message = "Hi ".$this->input->post('fname')." ".$this->input->post('lname').",\nWelcome to friendsbook! Your account is successfully registered with the\nEmail ID: ".$this->input->post('email');
            $this->email->from('friendsbook@noreply.com','FriendsBook');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Account Information');
            $this->email->message($message);
            if( $this->Insertdata->signupdata() ) {
                $this->email->send();
                $success_message = "<div class='success_msg'>
                                        Account is created Successfully
                                    </div>";
                $this->session->set_flashdata('success', $success_message);
                redirect('/');
            }
        }
    }
}
?>