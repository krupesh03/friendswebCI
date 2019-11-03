<?php
class Insertdata extends CI_Model{
    public function _construct(){
        $this->load->database();
    }

    public function signupdata(){
        $dob = date('Y-m-d',strtotime($this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('date')));
        $age = date('Y')-$this->input->post('year');
        $array = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'dob' => $dob,
            'age' => $age,
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'gender' => $this->input->post('gender'),
            'unique_id' => $this->input->post('email').'-'.rand(100,1000),
        );
        if($this->db->insert('users',$array)){
            return true;
        }else{
            return false;
        }
    }

    public function status_update($id){
        $this->db->where('id="'.$id.'" and deleted=0');
        $this->db->update('users',array('status'=>1));
    }

    public function logout_func(){
        $this->db->where('id="'.$this->session->userdata('id').'" and deleted=0');
        $this->db->update('users',array('status'=>0, 'last_seen'=>date('Y-m-d H:i:s')));
    }

    public function update_flag($email){
        $this->db->where('deleted=0 and email="'.$email.'"');
        $this->db->update('users',array('flag'=>1));
    }

    public function change_pwd($email,$flag){
        $this->db->where('deleted=0 and email="'.$email.'"');
        $array = array(
            'password' => md5($this->input->post('password'))
        );
        if($flag==0){
            $array['flag'] = 0;
        }
        $this->db->update('users',$array);
    }

    public function save_story() {
        $array = array();
        $array['userid'] =  $this->session->userdata('id');
        if(!empty($this->input->post('story_post'))) {
            $array['story'] = $this->input->post('story_post');
        }
        if(!empty($this->upload->data('file_name'))) {
            $array['file'] = '/assets/images/uploads/'.$this->upload->data('file_name');
        }
        return $this->db->insert('stories', $array);
    }

    public function update_profile_m() {
        $array = array();
        $modelFlag=0;
        if($this->input->post('uflag')==1){
            $fieldname = 'profile';
        } elseif ($this->input->post('uflag')==2) {
            $fieldname = 'cover';
        }
        if(!empty($this->upload->data('file_name'))) {
            $array[$fieldname.'_pic'] = '/assets/images/'.$fieldname.'/'.$this->upload->data('file_name');
            if($this->db->query("insert into photos_history (userid, ".$fieldname."_pic) values ('".$this->session->userdata('id')."', '".$array[$fieldname.'_pic']."')")) {
                $modelFlag=1;
            }
        }
        if($modelFlag==1) {
            $this->db->where('deleted=0 and id='.$this->session->userdata('id'));
            $this->db->update('users', $array);
        }
    }

    public function update_lcounts() {
        $counter = $this->input->post('counter');
        $pid = $this->session->userdata('id');
        $NewData = $this->Getdata->get_likes_data($this->input->post('sid'));
        $array = unserialize($NewData['likes_data']);

        if(!is_array($array)) {
            $array = array();
        } 
        
        if($counter == 1) {
            if(!in_array($pid, $array)) {
                $array[$pid] = $pid;
            }
        } else {
            if(in_array($pid, $array)) {
               unset($array[$pid]);
            }
        }
        $args = array(
            'likes' => count($array),
            'likes_data'=> serialize($array)
        );
        $this->db->where('deleted=0 and id='.$this->input->post('sid'));
        $this->db->update('stories', $args);
    }
}
?>