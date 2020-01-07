<?php
Class Getdata extends CI_Model {
    public function _construct() {
        $this->load->database();
    }

    public function signin() {
        $this->db->select('id, dob, unique_id, creation_date');
        $this->db->from('users');
        $this->db->where('email="'.$this->input->post('login-email').'" and password="'.md5($this->input->post('login-pwd')).'" and deleted=0');
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getuserdata() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('deleted=0 and id='.$this->session->userdata('id'));
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getdata_on_email($string='') {
        $this->db->select('fname, lname, email');
        $this->db->from('users');
        $this->db->where("deleted=0 and email='".$this->input->post('email')."'".$string);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getmodels_friends() {
        $search_term = $this->input->post('search_term');
        $this->db->select('fname, lname, email, profile_pic');
        $this->db->from('users');
        $this->db->where("deleted=0 and id<>".$this->session->userdata('id')." and (fname like '%$search_term%' OR lname like '%$search_term%' OR email like '%$search_term%')");
        $this->db->order_by('id','ASC');
        $this->db->limit(5);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_friend_bday() {
        $where = " and DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(NOW(), '%m-%d')
                    OR (
                            (
                                DATE_FORMAT(NOW(), '%Y') % 4 <> 0
                                OR (
                                        DATE_FORMAT(NOW(), '%Y') % 100 = 0
                                        AND DATE_FORMAT(NOW(), '%Y') % 400 <> 0
                                    )
                            )
                            AND DATE_FORMAT(NOW(), '%m-%d') = '03-01'
                            AND DATE_FORMAT(dob, '%m-%d') = '02-29'
                        )";
        $this->db->select('users.id, users.fname, users.lname, users.profile_pic');
        $this->db->from('users');
        $this->db->join('friendlist', 'users.id = friendlist.friend_one OR users.id = friendlist.friend_two', 'inner');
        $this->db->where('(friendlist.friend_one = "'.$this->session->userdata('id').'" OR friendlist.friend_two = "'.$this->session->userdata('id').'") and users.id<>'.$this->session->userdata('id').' and users.deleted=0 and friendlist.isAccepted=1 and friendlist.isDeleted=0 and users.dob_hide=0'.$where);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_friend_request() {
        $this->db->select('users.id, users.fname, users.lname, users.profile_pic');
        $this->db->from('users');
        $this->db->join('friendlist', 'users.id = friendlist.friend_one', 'inner');
        $this->db->where('friendlist.friend_two = '.$this->session->userdata('id').' and users.deleted=0 and friendlist.isAccepted=0 and friendlist.isDeleted=0');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getstories($rowno, $rowperpage) {
        $this->load->model('Themodel');
        $data = $this->Themodel->get_friend_ids($this->session->userdata('id'));
        $this->db->select('users.id, users.profile_pic, users.fname, users.lname, stories.story, stories.file, stories.time, stories.id as sid, stories.likes, stories.likes_data');
        $this->db->from('stories');
        $this->db->join('users', 'stories.userid = users.id', 'inner');
        $this->db->where('users.deleted=0 and stories.deleted=0 and stories.userid in ('.implode(",", $data).')');
        $this->db->order_by('stories.id', 'DESC');
        $this->db->limit($rowperpage, $rowno);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getstories_count() {
        $this->load->model('Themodel');
        $data = $this->Themodel->get_friend_ids($this->session->userdata('id'));
        $this->db->select('count(users.id) as allcount');
        $this->db->from('stories');
        $this->db->join('users', 'stories.userid = users.id', 'inner');
        $this->db->where('users.deleted=0 and stories.deleted=0 and stories.userid in ('.implode(",", $data).')');
        $result = $this->db->get();
        $allcount = $result->row_array();
        return $allcount['allcount'];
    }

    public function get_friend_response() {
        $this->db->select('users.id, users.fname, users.lname, users.profile_pic');
        $this->db->from('friendlist');
        $this->db->join('users', 'users.id = friendlist.friend_two', 'inner');
        $this->db->where('users.deleted=0 and friendlist.isDeleted=0 and friendlist.isAccepted=1 and friendlist.read_status=0 and friendlist.friend_one='.$this->session->userdata('id'));
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_likes_data($storyid) {
        $this->db->select('likes_data');
        $this->db->from('stories');
        $this->db->where('deleted=0 and id='.$storyid);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_relationship_status() {
        $this->db->select('*');
        $this->db->from('relation_status');
        $this->db->where('deleted=0');
        $result = $this->db->get();
        return $result->result_array();
    }
}
?>