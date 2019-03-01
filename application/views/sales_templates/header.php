<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
		<title>MedConnex</title>
		<link href="<?php echo base_url(); ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/vendor/morrisjs/morris.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/dist/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/dist/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/front/css/res.css" rel="stylesheet" />
 
		<link href="<?php echo base_url(); ?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/fullcalendar.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/fullcalendar.print.min.css" media="print">
		<link href="<?=base_url()?>public/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
		   <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>
		
   </head>
   <body>
      <div id="wrapper">
         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="<?php echo base_url('/'); ?>">MedConnex </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
               <li class="dropdown notify">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-bell fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
                     <h5>Notifications</h5>
                     <span class="count" id='notificationcount'>0</span>
                  </a>
                  <ul class="dropdown-menu dropdown-alerts" id="notifications">
                     <li>
                        <a class="text-center brdr-0" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                        </a>
                     </li>
                  </ul>
               </li>
			   
              <li class="dropdown msgs">
                  <a class="dropdown-toggle tasks" data-toggle="dropdown" href="#">
                   <i class="fa fa-envelope fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
                     <h5>&nbsp&nbsp Tasks &nbsp&nbsp</h5>
                     <span class="count" id='task_msgcount'>0</span>
                  </a>
                  <ul class="dropdown-menu dropdown-messages" id="task_messages_list">
                     <li>
                        <a href="#">
                           <div>
                              <strong>John Smith</strong>
                             <span class="pull-right text-muted">
                              <em>Yesterday</em>
                              </span>
                           </div>
                          <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                     </li>
                  </ul>
               </li>
			   
			   
			   
               <li class="dropdown msgs">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-envelope fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->
                     <h5>Message</h5>
                     <span class="count" id='msgcount'>0</span>
                  </a>
				   <ul class="dropdown-menu dropdown-messages" id="messages_list" style="max-height: 400px;overflow: auto;padding: 10px;">
                     <li>
                         <a href="#">
                           <div>
                              <strong>John Smith</strong>
                              <span class="pull-right text-muted">
                             <em>Yesterday</em>
                              </span>
                           </div>
                          <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                          <div>
                             <strong>John Smith</strong>
                              <span class="pull-right text-muted">
                              <em>Yesterday</em>
                              </span>
                           </div>
                           <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                     <li>
                        <a href="#">
                           <div>
                              <strong>John Smith</strong>
                              <span class="pull-right text-muted">
                              <em>Yesterday</em>
                              </span>
                           </div>
                           <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                     </li>
                     <li>
                        <a class="text-center brdr-0" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                        </a>
                     </li>

                  </ul>
		      </li>

               <li class="dropdown user settings" style="border-right:1px solid #e7e7e7;">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-cog" aria-hidden="true"></i>
                     <h5>Settings <i class="fa fa-caret-down" aria-hidden="true"></i></h5>
					 
                  </a>
				   	<ul class="dropdown-menu medconnex16profile">
						<li><a href="<?php echo base_url('sales-setting'); ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp Profile</a></li>
						<li><a href="<?php echo base_url('sales-logout'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i>  &nbsp Logout</a></li>
					</ul>
               </li>

			    <li class="dropdown user user-menu ">
				<a href="#" class="dropdown-toggle medconnex16user" data-toggle="dropdown">
				  <i class="fa fa-user fa-fw" aria-hidden="true"></i>
				  <span class="hidden-xs1"><?php echo $this->session->userdata('name'); ?> &nbsp &nbsp</span>
				  <!--<i class="fa fa-caret-down" aria-hidden="true"></i>-->
				</a>
<!--				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>panels/supermacdaddy/sales/setting"><i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp Profile</a></li>
					<li><a href="<?php echo base_url(); ?>panels/supermacdaddy/sales/logout"><i class="fa fa-power-off" aria-hidden="true"></i>  &nbsp Logout</a></li>
				</ul>-->
			  </li>
            </ul>
         
         <style type="text/css">
          .table tbody tr td{
            font-size: 14px;
          }
        </style>