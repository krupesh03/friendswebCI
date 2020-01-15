<?php
class Insert extends BASE_controller {

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
        redirect('myaccount');
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
                redirect('myprofile');
            }
        }
        if ($update==1) {
            $this->Insertdata->update_profile_m();
            redirect('myprofile');
        } 
    }

    public function update_like_counts() {

        if($this->input->is_ajax_request()){
            $this->Insertdata->update_lcounts();
        }
    }
}
?>