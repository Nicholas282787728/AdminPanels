<?php 
$this->load->view('doctor_templates/header');
$this->load->view('doctor_templates/sidebar');
$this->load->view(@$file);
$this->load->view('doctor_templates/footer');
?>