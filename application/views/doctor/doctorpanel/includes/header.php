<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <!--title>SB Admin 2 - Bootstrap Admin Theme</title-->
      <title>MedConnex</title>
      <!-- Bootstrap Core CSS -->
      <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- MetisMenu CSS -->
      <link href="public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="public/dist/css/sb-admin-2.css" rel="stylesheet">
      <!-- Morris Charts CSS -->
      <link href="public/vendor/morrisjs/morris.css" rel="stylesheet">
      <!-- Custom style -->
		<link href="public/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="public/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
      <link href="public/dist/css/style.css" rel="stylesheet">
      <link href="public/dist/css/custom.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="public/dist/css/fullcalendar.min.css">
  <link rel="stylesheet" href="public/dist/css/fullcalendar.print.min.css" media="print">
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

               <a class="navbar-brand" href="index.php">MedConnex </a>

            </div>

            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

               <li class="dropdown notify">

                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                     <i class="fa fa-bell fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->

                     <h5>Notifications</h5>

                     <span class="count" id='notificationcount'>20</span>

                  </a>

                  <ul class="dropdown-menu dropdown-alerts" id="notifications">

                     <li>

                        <a href="#">

                           <div>

                              <i class="fa fa-comment fa-fw"></i> New Comment

                              <span class="pull-right text-muted small">4 minutes ago</span>

                           </div>

                        </a>

                     </li>

                     <li>

                        <a href="#">

                           <div>

                              <i class="fa fa-twitter fa-fw"></i> 3 New Followers

                              <span class="pull-right text-muted small">12 minutes ago</span>

                           </div>

                        </a>

                     </li>

                     <li>

                        <a href="#">

                           <div>

                              <i class="fa fa-envelope fa-fw"></i> Message Sent

                              <span class="pull-right text-muted small">4 minutes ago</span>

                           </div>

                        </a>

                     </li>

                     <li>

                        <a href="#">

                           <div>

                              <i class="fa fa-tasks fa-fw"></i> New Task

                              <span class="pull-right text-muted small">4 minutes ago</span>

                           </div>

                        </a>

                     </li>

                     <li>

                        <a href="#">

                           <div>

                              <i class="fa fa-upload fa-fw"></i> Server Rebooted

                              <span class="pull-right text-muted small">4 minutes ago</span>

                           </div>

                        </a>

                     </li>

                     <li>

                        <a class="text-center brdr-0" href="#">

                        <strong>See All Alerts</strong>

                        <i class="fa fa-angle-right"></i>

                        </a>

                     </li>

                  </ul>

                  <!-- /.dropdown-alerts -->

               </li>

              <li class="dropdown msgs">

                  <a class="dropdown-toggle tasks" data-toggle="dropdown" href="#">

                     <i class="fa fa-envelope fa-fw"></i> <!--<i class="fa fa-caret-down"></i>-->

                     <h5>&nbsp&nbsp Tasks &nbsp&nbsp</h5>

                     <span class="count" id='msgcount'>20</span>

                  </a>

                  <ul class="dropdown-menu dropdown-messages" id="messages_list">

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

                     <span class="count" id='msgcount'>20</span>

                  </a>

                  <ul class="dropdown-menu dropdown-messages" id="messages_list">

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

                  <!-- /.dropdown-messages -->

               </li>

               <li class="dropdown settings" style="border-right:1px solid #e7e7e7;">

                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                     <i class="fa fa-cog" aria-hidden="true"></i>

                     <!--span class="count">20</span-->                     <!--<i class="fa fa-caret-down"></i>-->

                     <h5>Settings</h5>

                  </a>

                  

               </li>

               <!-- /.dropdown -->

               <!-- /.dropdown -->

               <!-- /.dropdown -->

                <li class="dropdown settings">

                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                     <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" width="30" height="30" class="user-image" alt="User Image">

                     <h5>Admin <i class="fa fa-caret-down"></i></h5>

                  </a>

                  <ul class="dropdown-menu dropdown-user">

                     <li><a href="#"><i class="fa fa-user fa-fw"></i>Profile</a>

                     </li>

                     <li><a href="" class="brdr-0"><i class="fa fa-sign-out fa-fw"></i> Logout</a>

                     </li>

                  </ul>

                  <!-- /.dropdown-messages -->

               </li>



              <!--  <li class="dropdown">

                  <a class="dropdown-toggle"  href="#">

                     <i class="fa fa-user fa-fw"></i>

                     <h5>dbinutu</h5>

                  </a>

               </li> -->

               <!-- /.dropdown -->

            </ul>

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">

               <div class="logo">

                  <a href="index.php"><img src="public/images/logo.png"/></a>

               </div>

               <div class="sidebar-nav navbar-collapse collapse">

                  <ul class="nav" id="side-menu">

                   

                     <li>

                        <a href="visibility.php">Visibility </a>

                     </li>

                     <li>

                        <a href="viewandlikes.php">Views & Likes</a>

                     </li>

                     <li>

                        <a href="scheduling.php">Scheduling</a>

                     </li>

                     <li>

                        <a href="pending-approval.php">Pending Approvals</a>

                     </li>

                     <li>

                        <a href="#">Ticket Management </a>

                     </li>

                     <li>

                        <a href="history.php">History </a>

                     </li>

                    <!--  <li>

                        <a href="/users">Views & Likes<i class="fa fa-angle-right pull-right" aria-hidden="true"></i></a>

                     </li>

                     <li>

                        <a href="/sales">Authorized Users</a>

                     </li> -->

                    

                        </ul>

                        <!-- /.nav-second-level -->

                     </li>

                   

                     

                  </ul>

               </div>

               <!-- /.sidebar-collapse -->

            </div>

            <!-- /.navbar-static-side -->

         </nav> 