<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>MedConnex</title>
    <link href="<?php echo base_url(); ?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/morrisjs/morris.css" rel="stylesheet">
	<!-- Custom style -->
	<link href="<?php echo base_url(); ?>public/dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/dist/css/custom.css" rel="stylesheet">
    <!-- Custom Fonts -->
	<link href="<?=base_url()?>public/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>public/front/css/res.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>
    <style type="text/css">
    .list-group-item {
    padding: 18px 15px;
    }
    #dataTables-example_wrapper .row .col-sm-6 #dataTables-example_filter,#dataTables-example_wrapper .pagination{
    float: right;
    }
    </style>
<script type="text/javascript" src="<?= base_url() ?>public/js/nicEdit-latest.js"></script>
<script>

    var area1, area2;
    function toggleAreaCompose() {
        area1 = new nicEditor({fullPanel: true}).panelInstance('composmail', {hasPanel: true});
    }
   
    bkLib.onDomLoaded(function () {
        toggleAreaCompose();
    });
  
    $(document).resize(function () {
        toggleAreaCompose();
       
    });
</script>
</head> 
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">MedConnex </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
				<li class="dropdown notify">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
						<h5>Notifications</h5>
						<span class="count" id='notificationcount'>0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" id="notifications">
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <li class="dropdown msgs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
						<h5>Message</h5>
						<span class="count" id='msgcount'>0</span>
                    </a>
                     <ul class="dropdown-menu dropdown-messages" id="messages_list">
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				<li class="dropdown settings">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i>
						<h5>Settings <i class="fa fa-caret-down"></i></h5>
						
                    </a>
                     <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('super-profile'); ?>"><i class="fa fa-user fa-fw"></i>Profile</a>
                        </li>
                        <li><a href="<?php echo base_url('pending-providers'); ?>"><i class="fa fa-user fa-fw"></i>Pending Providers</a>
                        </li>
                        <li><a href="<?php echo base_url('pending-interviews'); ?>"><i class="fa fa-user fa-fw"></i>Pending Interviews</a>
                        </li>
                         <li><a href="<?php echo base_url('pending-affiliate'); ?>"><i class="fa fa-user fa-fw"></i>Pending Affiliates</a>
                        </li>
                        <li> <a href="<?php echo base_url('Dashboard/advertisements'); ?>"><i class="fa fa-user fa-fw"></i>Advertisement Approvals</a></li>
                         <li><a href="<?php echo base_url('user-verification'); ?>"><i class="fa fa-user fa-fw"></i>User's Verification </a>
                        </li>
                         <li><a href="<?php echo base_url('Dashboard/pendingUpgrades'); ?>"><i class="fa fa-user fa-fw"></i>Pending Upgrades</a>
                        </li>
                        <li><a href="<?php echo base_url('logout'); ?>" class="brdr-0"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
                <!-- /.dropdown -->
                <li class="dropdown medconexx-userprofile">
                    <a class="dropdown-toggle"  href="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/setting">
                        <i class="fa fa-user fa-fw"  aria-hidden="true"></i>
						<h5><?php echo $this->session->userdata('name'); ?></h5>
						
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <style type="text/css">
          .table tbody tr td{
            font-size: 12px;
          }
        </style>
        <script type="text/javascript">
    jQuery("body").prepend('<div id="preloader" style="position: fixed;left: 0;top: 0;height: 100%;width: 100%;background: rgba(255,255,255,.9);text-align: center;z-index: 1051;align-items: center;justify-content: center;"><img src="http://medconnex.net/demonil/loader.gif"></div>');
    jQuery(document).ready(function() {
        jQuery("#preloader").remove();
    });
</script>
<!-- <div id="preloader" style="position: fixed;left: 0;top: 0;height: 100%;width: 100%;background: rgba(255,255,255,.9);text-align: center;display: none;z-index: 1051;align-items: center;justify-content: center;"><img src="http://medconnex.net/demonil/loader.gif"></div>' -->
