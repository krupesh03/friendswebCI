<?php
class Themodel extends CI_model{

    public function _construct() {
        $this->load->database();
    }

    public function get_friend_ids($cur_id=0) {
        if($cur_id!=0) {
            $this->db->select('friendlist.friend_one, friendlist.friend_two');
            $this->db->from('users');
            $this->db->join('friendlist', 'users.id = friendlist.friend_one OR users.id = friendlist.friend_two', 'inner');
            $this->db->where('users.deleted=0 and friendlist.isAccepted=1 and friendlist.isDeleted=0 and users.id='.$cur_id);
            $query = $this->db->get();
            $result = $query->result_array();
            if(count($result)==0) {
                $result = array(
                    array(
                        'friend_one' => $cur_id,
                        'friend_two' => $cur_id,
                    ),
                );
            }
        } else {
            $result = array(
                array(
                    'friend_one' => $cur_id,
                    'friend_two' => $cur_id,
                ),
            );
        }
        $values = array();
        foreach ($result as $k=>$v) {
            array_push($values, $v['friend_one'], $v['friend_two']);
        }
        return array_unique($values);
    }
}
?>