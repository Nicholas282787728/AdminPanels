<?php 
$this->load->view('storefronts_templates/header');
$this->load->view('storefronts_templates/sidebar');
$this->load->view(@$file);
$this->load->view('storefronts_templates/footer');
?>