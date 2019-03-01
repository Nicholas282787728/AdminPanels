<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticket Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/sales-design/assests/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/sales-design/assests/css/home-page.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link href="<?php echo base_url(); ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/dist/css/custom.css" rel="stylesheet">
    
	<style>
        a {
            color: #10b1ac;
        }
        #home {
            height: 280px;
        }
        #home button.btn.btn-default.tic-btn.pull-right {
            margin-top: 23px;
            color: #fff;
            font-size: 18.7px;
            border-radius: 0px;
            border-color: #10B1AC;
            background: #10B1AC;
            width: 196px;
        }
        #home button.btn.btn-default.status-btn.pull-right {
            margin-top: 3px;
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #FE8860;
            background: #FE8860;
        }
        @media (max-width: 767px) and (min-width: 240px) {
            #home {
                height: 456px;
            }
            #home button.btn.btn-default.tic-btn.pull-right {
                float: left !important;
            }
            #home button.btn.btn-default.status-btn.pull-right {
                float: left !important;
                margin-top: 14px;
            }
        }
        @media (max-width: 980px) and (min-width: 768px) {
            #home button.btn.btn-default.tic-btn.pull-right {
                float: left !important;
            }
            #home button.btn.btn-default.status-btn.pull-right {
                float: left !important;
                margin-top: 23px;
                margin-left: 10px;
            }
        }
        #menu1 .form-control {
            width: 40%;
            border-radius: 0px;
        }
        #menu1 .signin-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #10B1AC;
            background: #10B1AC;
        }
        #menu1 .cancel-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #9B9B9B;
            background: #9B9B9B;
        }
        #menu1 .reset-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #9B9B9B;
            background: #9B9B9B;
        }
        @media (max-width: 767px) and (min-width: 240px) {
            #menu1 .form-control {
                width: 90%;
                border-radius: 0px;
            }
        }
        #menu2 .form-control {
            width: 40%;
            border-radius: 0px;
        }
        #menu2 .signin-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #10B1AC;
            background: #10B1AC;
        }
        @media (max-width: 767px) and (min-width: 240px) {
            #menu2 .form-control {
                width: 90%;
                border-radius: 0px;
            }
        }
        .nav-pills>li.active>a:focus {
            color: #fff;
            background-color: #56BDDC;
        }
        #check-status {
            background: #EDEDED;
            background-repeat: no-repeat;
            border-top: 1px solid #D0CCCC;
        }
        #check-status .check-status-box {
            border: 1px solid #D0CCCC;
            box-shadow: 2px 2px 3px #D0CCCC;
            background: #fff;
            background-repeat: no-repeat;
            padding: 18px 20px 35px 20px;
        }
        #check-status .check-status-content {
            padding-bottom: 15px;
        }
        #check-status .check-status-content h1 {
            font-size: 24px;
            font-weight: normal;
            color: #222222;
        }
        .check-status-content p {
            color: #616161;
        }
        .check-status-form {
            padding-bottom: 15px;
        }
        .check-status-form label {
            color: #222222;
            font-weight: normal;
        }
        .check-status-form .form-control {
            width: 40%;
            border-radius: 0px;
        }
        .check-status-form .signin-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #10B1AC;
            background: #10B1AC;
        }
        #check-status .check-status-content h1 {
            font-size: 24px;
            font-weight: normal;
            color: #222222;
        }
        #log-page {
            background: #EDEDED;
            background-repeat: no-repeat;
            border-top: 1px solid #D0CCCC;
        }
        .log-box {
            border: 1px solid #D0CCCC;
            box-shadow: 2px 2px 3px #D0CCCC;
            background: #fff;
            background-repeat: no-repeat;
            padding: 18px 20px 35px 20px;
        }
        .log-content {
            padding-bottom: 15px;
        }
        .log-content h1 {
            font-size: 24px;
            color: #222222;
        }
        .log-content h1 {
            font-size: 24px;
            font-weight: normal;
            color: #222222;
        }
        .log-content p {
            color: #616161;
        }
        .log-form {
            padding-bottom: 15px;
        }
        .log-form .form-control {
            width: 40%;
            border-radius: 0px;
        }
        .log-form .signin-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #10B1AC;
            ;
            background: #10B1AC;
        }
        #log-page label {
            color: #222222;
            font-weight: normal;
        }
        .log-cont-lst h5 {
            color: #616161;
        }
        #log-page .log-cont-lst h5 span {
            color: #10B1AC;
        }
        #log-page .log-cont-lst p {
            padding-top: 20px;
            color: #616161;
        }
        #log-page .log-cont-lst p span {
            color: #10B1AC;
        }
        h1 {
            font-size: 24px;
            font-weight: normal;
            color: #222222;
        }
        .cancel-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #9B9B9B;
            background: #9B9B9B;
        }
        .signin-btn {
            color: #fff;
            font-size: 18px;
            border-radius: 0px;
            border-color: #10B1AC;
            background: #10B1AC;
        }
        .primary-color {
            color: #10b1ac;
        }
        .form-control {
            width: 40%;
            border-radius: 0px;
        }
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #cacaca;
        }
        .select {
            width: 100%;
        }
        .select-col {
            padding-left: 0px;
        }
        .auto-button {
            line-height: 84px;
        }
        .auto-button button {
            background-color: #56bddc;
            border-radius: 5px;
            border: none;
        }
        @font-face {
            font-family: 'Century Gothic';
            src: url('CenturyGothic.eot');
            src: url('CenturyGothic.eot?#iefix') format('embedded-opentype'), url('CenturyGothic.woff') format('woff'), url('CenturyGothic.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Century Gothic';
        }
    </style>

</head>

<body>
    <header id="ticket-head">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="sup-head">
                        <div class="support-img pull-left">
                            <img src="http://theoasisfest.com/wp-content/uploads/2016/10/O17-Tickets-Button-2-copy.png" alt="" style="width: 150px;">
                        </div>
<!--                        <div class="user-log pull-right">
                            <h4>Hi Guest User&nbsp;&nbsp;&nbsp;
                           <button type="button" data-toggle="tab" href="#menu3" class="btn btn-default sign-in-btn">Sign In
                           </button>
                        </h4>
                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="open-ticket">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="menu-bd">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a>
                                </li>
                                <li class="active">Ticket Management</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="sup-menu">
                            <ul class="nav nav-pills">
                                <li><a data-toggle="pill" href="#home" class="active"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Home</a>
                                </li>
                                <li><a data-toggle="pill" href="#menu1"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;Open a New Ticket</a>
                                </li>
                                <li><a data-toggle="tab" href="#menu2"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;Check Ticket Status</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="tab-content open-status-box">
                            <div id="home" class="tab-pane fade in active">
                                <div class="col-md-9">
                                    <h3 class="pull-left">
										Welcome to the Support Center
									 </h3>
                                    <p class="pull-left">
                                        In order to streamline support requests and better serve you,we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket.
                                    </p>
                                </div>
                                <div class="col-md-1"> </div>
                                <div class="col-md-2">
					                <button class="btn btn-default tic-btn pull-right"  data-toggle="modal" data-target="#create_ticket_form">Open a New Ticket</button>
                                    <button class="btn btn-default status-btn pull-right" data-toggle="modal" data-target="#check_status_popup">Check Ticket Status</button>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div>
							      <div class="open-status-content">
                                        <h1>
											Open a New Ticket
										 </h1>
                                        <p>Please fill in the form below to open a new ticket.</p>
								</div>

                                    <div class="open-status-form">
                                     	<form name="create_ticket" id="create_ticket" method="post" action=""  enctype="multipart/form-data" >
											<div class="form-group">
												<label>Ticket No </label>
												<input type="text" class="form-control"  name="ticket_no" value="<?=$last_ticket_no?>" required="" readonly="">
											</div>
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" class="form-control"  name="ticket_email" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Subject</label>
                                                <input type="name" class="form-control"  name="ticket_sub" required="">
                                            </div>
                                            	<div class="form-group">
													<label>Message</label>
													<div class="input-group">
														<textarea class="form-control" name="message_ticket" rows="4" cols="20" style="width:190% !important; height:100%;" required=""></textarea>
													</div>
												</div>
												<div class="form-group">
													<label>Attach File </label>
													<div class="input-group">
														<input type="file" name="image" required="">
													</div>
												</div>
                                            <button type="submit" class="btn btn-default signin-btn" name="btn_save_ticket">Created Ticket</button>
                                            <button type="reset" class="btn btn-default reset-btn">Reset</button>
                                            <button type="reset" class="btn btn-default cancel-btn">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div>
                                    <div class="check-status-content">
                                        <h1>
											Check Ticket Status
									   </h1>
                                        <p>Please provide your email address and a ticket number. An access link will be emailed to</p>
                                    </div>
                                    <div class="check-status-form">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control"  name="chk_Email" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Ticket Number</label>
                                                <input type="text" class="form-control"  name="chk_ticketno" required="">
                                            </div>
                                            <button type="submit" class="btn btn-default signin-btn" id="check_status" name="check_status">Check Ticket</button>
                                        </form>
                                    </div>
<!--                                    <div class="check-status-cont-lst">
                                        <h5>
											- Have an account with us?<span> <a href="#">Sign In </a> </span> or<span> <a data-toggle="pill" href="#register"> register for an account </a></span> to access your tickets. 
									   </h5>
                                        <p>- If this is your first time contacting us or you've last the ticket number, please <span><a data-toggle="pill" href="#menu1">open a new ticket</a></span>
											 
                                        </p>
                                    </div>-->
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div>
                                    <div class="log-content">
                                        <h1>
											Sign in to Medconnex
										</h1>
                                        <p>To better serve you, we encourage our Clients to register for an account.</p>
                                    </div>
                                    <div class="log-form">
                                        <form>
                                            <div class="form-group">
                                                <label for="email">Email or Username</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Password</label>
                                                <input type="password" class="form-control" id="pwd" name="pwd">
                                            </div>
                                            <button type="submit" class="btn btn-default signin-btn">Sign In</button>
                                        </form>
                                    </div>
                                    <div class="log-cont-lst">
                                        <h5>
											- Not yet registered?<span> <a data-toggle="pill" href="#register"> Create an account </a></span>
										 </h5>
                                        <h5>- I'm an agent -<span><a href="#"> Sign in here </a></span></h5>
                                        <p>- If this is your first time contacting us or you've last the ticket number, please <span><a data-toggle="pill" href="#menu1">open a new ticket</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="register" class="tab-pane fade">
                                <h1>
									Account Registration
								 </h1>
                                <p>Use the forms below to create or update the information we have on file for your account</p>
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="name" class="form-control" id="nm" name="nm" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-number">Phone Number</label>
                                        <input type="phone-number" class="form-control" id="pnm" placeholder="Enter Phone Number" name="pnm" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="extra">Ext.</label>
                                        <input type="ext" class="form-control" id="ext" name="ext">
                                    </div>
                                    <hr>
                                    <b class="primary-color">Preferences </b>
                                    <br/>
                                    <br/>

                                    <div class="form-group">
                                        <div class="col-md-5 select-col">
                                            <label for="seltop">Timezone</label>
                                            <select class="form-control select" id="seltop">
                                                <option>Asia/Kolkata</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 auto-button">
                                            <button type="submit" class="btn btn-default signin-btn"><i class="fa fa-map-marker" aria-hidden="true"></i> Auto Detext</button>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <hr/>

                                        <b class="primary-color">Access Credentials </b>
                                        <br/>
                                        <br/>
                                        <div class="form-group">
                                            <label for="extra">Create Password</label>
                                            <input type="ext" class="form-control" id="ext" name="ext">
                                        </div>
                                        <div class="form-group">
                                            <label for="extra">Confirm Password</label>
                                            <input type="ext" class="form-control" id="ext" name="ext">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default signin-btn">Register</button>
                                    <button type="submit" class="btn btn-default cancel-btn">Cancel</button>
                                </form>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
					
				</div>
				 
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12" align="center">
					<?php
					@$success_msg = $this->session->flashdata('success_msg');
					if (!empty($success_msg)) {
						echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;width: 40%;' id='success-alert'>";
						echo $this->session->flashdata('success_msg') . "</div>";
					}
					@$error_msg = $this->session->flashdata('error_msg');
					if (!empty(@$error_msg)) {
						echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;width: 40%;' id='success-alert'>";
						echo $this->session->flashdata('error_msg') . "</div>";
					}
					?>
			</div>
    </section>
	<br><br>
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 copy-right" align="center">
                    <p>Copyright @ 2017 Medconnex - All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
	
	
	
<!--/Send message Modal/-->
<div class="modal fade" id="create_ticket_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Created New Ticket</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="create_ticket_form" id="create_ticket_form" method="post" action=""  enctype="multipart/form-data" >
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Ticket No </label>
								<div class="input-group">
									<input class="form-control" type="text" name="ticket_no" readonly="" value="<?=$last_ticket_no?>" required="" >
								</div>
							</div>
							 <div class="form-group">
								<label for="email">Email Address</label>
								<div class="input-group">
								<input type="email" class="form-control" id="email" name="ticket_email" style="width:530px !important;"  required="">
								</div>
							</div>
							
							<div class="form-group">
								<label>Subject </label>
								<div class="input-group">
									<input class="form-control" type="text" name="ticket_sub" style="width:530px !important;" required="">
								</div>
							</div>
							<div class="form-group">
								<label>Message</label>
								<div class="input-group">
									<textarea class="form-control" id="message_ticket" name="message_ticket" rows="4" cols="20" style="width:530px !important; height:100%;" required=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label>Attach File </label>
								<div class="input-group">
									<input type="file" name="image" required="">
								</div>
							</div>
						</div>
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="btn_save_ticket" class="btn-green">Created Ticket</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>
	
<!--/Send message Modal/-->
<div class="modal fade" id="check_status_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Check Ticket Status </h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form method="post" action="" >
					<div class="row">
						<div class="col-sm-12">
							
							 <div class="form-group">
								<label for="email">Email Address</label>
								<div class="input-group">
								<input type="email" class="form-control" name="chk_Email" style="width:530px !important;"  required="">
								</div>
							</div>
							<div class="form-group">
								<label>Ticket Number </label>
								<div class="input-group">
									<input class="form-control" type="text" name="chk_ticketno"  style="width:530px !important;" required="" >
								</div>
							</div>
						
					</div><br>
					</div>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="check_status" class="btn-green">Check Ticket</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>

</body>
<script src="<?php echo base_url(); ?>public/sales-design/assests/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/sales-design/assests/js/bootstrap.min.js"></script>
</html>