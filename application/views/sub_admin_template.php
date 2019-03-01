<?php 
$this->load->view('subadmin_templates/header');
$this->load->view('subadmin_templates/sidebar');
$this->load->view(@$file);
$this->load->view('subadmin_templates/footer');
?>