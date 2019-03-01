<?php 
$this->load->view('onsales_templates/header');
$this->load->view('onsales_templates/sidebar');
$this->load->view(@$file);
$this->load->view('onsales_templates/footer');
?>