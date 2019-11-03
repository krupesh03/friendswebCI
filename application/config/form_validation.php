<?php
$config = array(
    array(
        'field' => 'fname',
        'label' => 'First Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'lname',
        'label' => 'Last Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'date',
        'label' => 'Date',
        'rules' => 'required'
    ),
    array(
        'field' => 'month',
        'label' => 'Month',
        'rules' => 'required'
    ),
    array(
        'field' => 'year',
        'label' => 'Year',
        'rules' => 'required'
    ),
    array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[users.email]'
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
    ),
    array(
        'field' => 'gender',
        'label' => 'Gender',
        'rules' => 'required'
    )
);
?>