<?php 
class Forgotpassword extends CI_controller {

    public function __construct() {

        parent::__construct();
        if( $this->session->userdata('logged_in') ) {
            redirect('myaccount');
        }
    }

	public function index($page='forgotpassword') {

		if(!file_exists(APPPATH.'/views/'.$page.'.php')) {
			show_404();
		}
		$data['title'] = 'Forgotten Password';
		$this->load->view('templates/header',$data);
		$this->load->view($page);
		$this->load->view('templates/footer');
	}

	public function send_link() {

        global $site_title;
        $args = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            )
        );
        $this->form_validation->set_rules($args);
        if( $this->form_validation->run()==FALSE ) {
            $data['title'] = 'Forgotten Password';
            $this->load->view('templates/header',$data);
            $this->load->view('forgotpassword');
            $this->load->view('templates/footer');
        } else {
            $values = $this->Getdata->getdata_on_email();
            if( count($values)!=0 ) {
                $site = site_url('reset_password');
                $message ="Hi ".$values['fname']." ".$values['lname']."\n\nClick on the below link to reset your password\n$site";
                $subject = "Password Reset Link";
                $this->email->from('accounts@'.strtolower($site_title).'.com', $site_title);
                $this->email->to($this->input->post('email'));
                $this->email->subject($subject);
                $this->email->message($message);
                if( $this->email->send() ){
                    $this->Insertdata->update_flag($this->input->post('email'));
                    $success_message = "<div class='success_msg'>
                                            Password reset link has been sent to your mail ID
                                        </div>";
                    $this->session->set_flashdata('msg',$success_message);
                } else {
                    $failed_message = "<div class='login_failed_msg'>
                                            Password reset link sending failed
                                        </div>";
                    $this->session->set_flashdata('msg',$failed_message);
                }
            } else {
                $failed_message = "<div class='login_failed_msg'>
                                        Email ID does not exist
                                    </div>";
                $this->session->set_flashdata('msg',$failed_message);
            }
            redirect('forgot_password');
        }
    }

    public function resetpwd($page='resetpassword') {

        if(!file_exists(APPPATH.'/views/'.$page.'.php')) {
            show_404();
        }

        $data['title'] = 'Reset Your Password';
        $this->load->view('templates/header',$data);
        $this->load->view($page);
        $this->load->view('templates/footer');
    }

    public function resetpass_control() {
        $args = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'cpassword',
                'label' => 'Confirm-Password',
                'rules' => 'required|min_length[8]|matches[password]'
            )
        );
        $this->form_validation->set_rules($args);
        if( $this->form_validation->run()==FALSE ){
            $data['title'] = 'Reset Your Password';
            $this->load->view('templates/header',$data);
            $this->load->view('resetpassword');
            $this->load->view('templates/footer');
        } else {
            $values = $this->Getdata->getdata_on_email("and flag='1'");
            if( count($values)!=0 ){
                $this->Insertdata->change_pwd($this->input->post('email'),'0');
                $success_message = "<div class='success_msg'>
                                        Password has been reset
                                    </div>";
                $this->session->set_flashdata('msg',$success_message);
                redirect('reset_password');
            } else {
                $failed_message = "<div class='login_failed_msg'>
                                        Email ID does not exists or Password reset link is not valid
                                    </div>";
                $this->session->set_flashdata('msg',$failed_message);
                redirect('reset_password');
            }
        }
    }
}