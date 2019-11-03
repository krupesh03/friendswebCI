<?php
class Insertcontrol extends AUTH_Controller {

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
                redirect('Forgotpassword/resetpwd');
            } else {
                $failed_message = "<div class='login_failed_msg'>
                                        Email ID does not exists or Password reset link is not valid
                                    </div>";
                $this->session->set_flashdata('msg',$failed_message);
                redirect('Forgotpassword/resetpwd');
            }
        }
    }

    public function upload_story() {
        $config['upload_path'] = './assets/images/uploads/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = 0;
        $config['max_height'] = 0;
        $config['max_width'] = 0;
        $config['remove_spaces'] = true;
        $config['max_filename'] = 0;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        $this->upload->do_upload('story_file');
        if( $this->Insertdata->save_story() ) {
            $msg = "<div class='success_msg'>
                        Story has been uploaded
                    </div>";
        } else {
            $msg = "<div class='login_failed_msg'>
                        Failed! Something went wrong...
                    </div>";
        }
        $this->session->set_flashdata('storymsg', $msg);
        redirect('Myaccount');
    }

    public function update_profile() {
        $update = 0;
        if($this->input->post('uflag')==1 || $this->input->post('uflag')==2){
            if($this->input->post('uflag')==1){
                $fieldname = 'profile';
                $max_size = 2048;
            } else {
                $fieldname = 'cover';
                $max_size = 0;
            }
            $config['upload_path'] = './assets/images/'.$fieldname.'/';
            $config['allowed_types'] = 'png|gif|jpg';
            $config['max_size'] = $max_size;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['remove_spaces'] = TRUE;
            $config['max_filename'] = 0;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            if($this->upload->do_upload($fieldname)) {
                $update = 1;
            } else {
                $error = array(
                    'error' => $this->upload->display_errors()
                );
                $upload_error_msg = "<div class='login_failed_msg'>
                                        ".$error['error']."
                                    </div>";
                $this->session->set_flashdata('upload_error', $upload_error_msg);
                redirect('Myaccount/myprofile');
            }
        }
        if ($update==1) {
            $this->Insertdata->update_profile_m();
            redirect('Myaccount/myprofile');
        } 
    }

    public function update_like_counts() {
        if($this->input->is_ajax_request()){
            $this->Insertdata->update_lcounts();
        }
    }
}
?>