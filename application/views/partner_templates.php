<?php 
$this->load->view('partner_templates/header');
$this->load->view('partner_templates/sidebar');
$this->load->view(@$file);
$this->load->view('partner_templates/footer');
?>