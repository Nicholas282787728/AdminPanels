<?php 
$this->load->view('ondemand_templates/header');
$this->load->view('ondemand_templates/sidebar');
$this->load->view(@$file);
$this->load->view('ondemand_templates/footer');
?>