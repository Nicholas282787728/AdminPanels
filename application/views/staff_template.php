<?php 
$this->load->view('staff_templates/header');
$this->load->view('staff_templates/sidebar');
$this->load->view(@$file);
$this->load->view('staff_templates/footer');
?>