<?php 
$this->load->view('admin_templates/header');
$this->load->view('admin_templates/sidebar');
$this->load->view(@$file);
$this->load->view('admin_templates/footer');
?>