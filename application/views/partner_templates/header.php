 <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--title>SB Admin 2 - Bootstrap Admin Theme</title-->
	<title>MedConnex</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/dist/css/partner.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/morrisjs/morris.css" rel="stylesheet">
	<!-- Custom style -->
	<link href="<?php echo base_url(); ?>public/dist/css/style.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>public/dist/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/front/css/res.css" rel="stylesheet" />


    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
	  <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.js"></script>






        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/fullcalendar.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/fullcalendar.print.min.css" media="print">

	  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #dataTables-example_wrapper .row .col-sm-6 #dataTables-example_filter,#dataTables-example_wrapper .pagination{
            float: right;
        }
    </style>
  
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
                <a class="navbar-brand" href="">MedConnex </a>
            </div>
            <!-- /.navbar-header -->
 
            <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                                         <?php 
                                $id = $this->session->userdata('id');
                                $sql = "SELECT randomId from uf_user where id = '".$id."'";
        $query = $this->db->query($sql);
        $res = $query->row();
         ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-caret-down"></i>
                        <h5>Affiliate Id</h5>
                       
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li class="update_status_read" >
                        <a style="cursor:pointer;">
                            <div>
        
                                 <b><?php if(!empty($res)){ echo $res->randomId; } ?></b>
                                
                            </div>
                        </a>
                    </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
			
				
				<li class="dropdown notify">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" id="readCount">
                      <i class="fa fa-bell fa-fw"> </i>
			     	<h5>Notifications</h5>
						<span class="count" id='notificationcount'>0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" id="notifications">
                        
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
				
                <li class="dropdown msgs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" id="readMessageCount">
                        <i class="fa fa-envelope fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
						<h5>Message</h5>
						<span class="count" id='msgcount'> 0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" id="messages_list">
                        
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				<li class="dropdown settings">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       <!--  <i class="fa fa-cog" aria-hidden="true"></i> --> <!--<i class="fa fa-caret-down"></i>-->
                       <i class="fa fa-cog" aria-hidden="true"></i>
						<h5>Settings <i class="fa fa-caret-down"></i></h5>
						
                    </a>
                     <ul class="dropdown-menu dropdown-user medconnex16profile">
                        <li><a href="<?php echo base_url(); ?>affiliate-setting"><i class="fa fa-user fa-fw"></i>Profile</a>
                         </li>
                        <!--    <li><a href="<?php echo base_url(); ?>affiliate-pending_providers"><i class="fa fa-user fa-fw"></i>Pending Providers</a>
                         </li>
                         <li><a href="<?php echo base_url(); ?>affiliate-pending_interviews"><i class="fa fa-user fa-fw"></i>Pending Interviews</a>
                         </li>
                          <li><a href="<?php echo base_url(); ?>affiliate-pending_affiliate"><i class="fa fa-user fa-fw"></i>Pending Affiliates</a>
                        </li> -->
                        <li><a href="<?php echo base_url(); ?>affiliate-logout" class="brdr-0"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle medconnex16user"  href="javascript:;">
                        <i class="fa fa-user fa-fw"></i>
						<h5><?php echo @$this->session->userdata('name'); ?></h5>
						
                    </a>
                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->





