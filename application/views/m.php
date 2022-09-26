<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "admin") {
	$this->load->view('m/admin/home');
} else if($ses_level == "staf"){
	$this->load->view('m/staf/home');
} else if($ses_level == "perawat"){
	$this->load->view('m/staf/home');
} else if($ses_level == "dokter"){
	$this->load->view('m/staf/home');
} else {
	$this->load->view('errors/403');
}
?>
	
