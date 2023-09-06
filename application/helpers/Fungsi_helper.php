<?php

function check_has_login(){
	$ci =& get_instance();
	$user_session = $ci->session->userdata('id_user');
	if ($user_session) {
		redirect('homepage');
	}
}

function check_not_login(){
	$ci =& get_instance();
	$user_session = $ci->session->userdata('id_user');
	if (!$user_session) {
		redirect('auth/login');
	}
}

function check_admin_jr(){
	$ci =& get_instance();
	$user_session = $ci->session->userdata('role');
	if ($user_session != 1) {
		redirect('homepage');
	}
}
