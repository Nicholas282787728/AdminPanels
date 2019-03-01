<?php 
$this->load->view('sales_templates/header');
$this->load->view('sales_templates/sidebar');
$this->load->view(@$file);
$this->load->view('sales_templates/footer');
?>