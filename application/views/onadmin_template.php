<?php 
$this->load->view('onadmin_templates/header');
$this->load->view('onadmin_templates/sidebar');
$this->load->view(@$file);
$this->load->view('onadmin_templates/footer');
?>