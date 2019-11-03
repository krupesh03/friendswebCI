<?php
class AUTH_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->config->item('base_url');
        if( !$CI->session->userdata('logged_in') ) {
            //redirect('/');
        }
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function headerfunction() {
        $CI =& get_instance();
        $CI->load->model('Getdata');
        $data['userdata'] = $CI->Getdata->getuserdata();
        $data['friendData'] = $CI->Getdata->get_friend_bday();
        $data['friendRequest'] = $CI->Getdata->get_friend_request();
        $data['friendResponse'] = $CI->Getdata->get_friend_response();
        return $data;
    }
}
?>