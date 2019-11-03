<?php
class Getcontroller extends AUTH_Controller {

    public function getfriendlist() {
        if( $this->input->is_ajax_request() ) {
            $data['friends_list'] = $this->Getdata->getmodels_friends();
            $this->load->view('ajax/getfriends',$data);
        }
    }

    public function loadRecord($rowno=0) {
        if ($this->input->is_ajax_request()){
            $rowperpage = 10;
            if( $rowno!=0 ){
                $rowno = ($rowno-1) * $rowperpage;
            }
            $allcount = $this->Getdata->getstories_count();
            
            $userDATA = $this->Getdata->getstories($rowno, $rowperpage);
            
            if( count($userDATA) > 0 ) {
                for( $i=0; $i<count($userDATA); $i++ ){
                    $userDATA[$i]['elapsed_time'] = $this->time_elapsed_string($userDATA[$i]['time']);
                    $userDATA[$i]['ldata'] = unserialize($userDATA[$i]['likes_data']);
                }
            }

            $config['base_url'] = site_url('Getcontroller/loadRecord');
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $allcount;
            $config['per_page'] = $rowperpage;
            $config['full_tag_open'] = "<div class='page-links'>";
            $config['full_tag_close'] = "</div>";
            $config['cur_tag_open'] = "<div class='cur-links'>";
            $config['cur_tag_close'] = "</div>";
            $config['num_tag_open'] = "<div class='other-links'>";
            $config['num_tag_close'] = "</div>";
            $config['first_tag_open'] = "<div class='first-links'>";
            $config['first_tag_close'] = "</div>";
            $config['prev_tag_open'] = "<div class='other-links'>";
            $config['prev_tag_close'] = "</div>";
            $config['next_tag_open'] = "<div class='other-links'>";
            $config['next_tag_close'] = "</div>";
            $config['last_tag_open'] = "<div class='first-links'>";
            $config['last_tag_close'] = "</div>";

            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            $data['result'] = $userDATA;
            $data['row'] = $rowno;

            echo json_encode($data);

        }
    }
}
?>