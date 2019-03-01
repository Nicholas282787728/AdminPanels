<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login to your UserFrosting account.">
        <meta name="author" content="Damilare Binutu">
        <meta name="csrf_token" content="5f02a2818ee51fcac316e7f8cbc70fae79cdaa3d6ada801defd78fc8abec856308ba4f29b193eadd0b4e402282d007a2b8be7a5acdd9bec834704e99b2588c6c"> 

        <title>MedConnex | Login</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>public/main/css/favicon.ico" />

        <!-- Page stylesheets -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/font-awesome-4.3.0.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/font-starcraft.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrap-3.3.2.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrap-modal-bs3patch.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrap-modal.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/lib/metisMenu.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrap-custom.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrap-switch.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/tablesorter/theme.bootstrap.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/tablesorter/jquery.tablesorter.pager.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/select2/select2.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/select2/select2-bootstrap.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/bootstrapradio.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/custom.css" type="text/css" >
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/main/css/jumbotron-narrow.css" type="text/css" >

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Header javascript (not recommended) -->

    </head>
	<body>
		<div class="bgImage">
			<div class="container">
				<div class="col-md-2"></div>
				<div class="signInHome text-center col-md-8">
					<img src="<?php echo base_url(); ?>public/images/medco-logo.png" />
					<!--	<div id="userfrosting-alerts">
						</div>-->
					<?php if ($this->session->flashdata('errormessage')) { ?>
						<div role="alert" class="alert alert-danger">
							<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
							<?= $this->session->flashdata('errormessage') ?>
						</div>
					<?php } ?>
					<?php if ($this->session->flashdata('successmessage')) { ?>
						<div role="alert" class="alert alert-success">
							<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
							<?= $this->session->flashdata('successmessage') ?>
						</div>
					<?php } ?>
					<form name="login" method="post" action="" class="form-horizontal loginForm">
						<div class="row">
							<div class="col-md-offset-3 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control " name="user_name" autocomplete="off" value="" placeholder="Username or Email">
								</div>
							</div>
							<div class="col-md-offset-3 col-md-6">
								<div class="form-group">
									<input type="password" class="form-control " name="password" autocomplete="off" value="" placeholder="Password">
								</div>
							</div>
							<div class="col-md-offset-3 col-md-6">
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="rememberme"> Remember me
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<!--button type="submit" class="btn btn-main btn-lg left-btn">
									LOGIN
								</button-->
								<input type="submit" name="login_btn" class="btn btn-main btn-lg left-btn" value="LOGIN">
							</div> 
						</div>
					</form>
<!--					<div class="loginBottomSection text-center grey">
						Not a member yet? 
						<a href="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/register" class="green">
							Register here.
						</a></br>
						<a href="/public/main/account/forgot-password" class="grey">
							Forgot password?
						</a></br></br>
						<a href="/public/main/account/resend-activation" class="grey">
							Resend activation email.
						</a>
					</div>-->
				</div>
				<div class="col-md-2"></div>	
			</div> <!-- /container -->

			<footer>
				<div class="container">
					<div class="row">
						<div class="text-center" style="position: relative;">
							<div class="text-center copyRights">
								&copy;2017 <a href="<?php echo base_url();?>">MedConnex</a>. All rights reserved.
							</div>     
						</div>
					</div>
				</div>
			</footer>

			<script src="<?php echo base_url(); ?>public/main/js/config.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/jquery-1.11.2.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/bootstrap-3.3.2.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/bootstrap-modal.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/bootstrap-modalmanager.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/sb-admin-2.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/lib/metisMenu.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/jqueryValidation/jquery.validate.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/jqueryValidation/additional-methods.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/jqueryValidation/jqueryvalidation-methods-fortress.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/moment.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/tablesorter/jquery.tablesorter.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/tablesorter/tables.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/tablesorter/jquery.tablesorter.pager.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/tablesorter/jquery.tablesorter.widgets.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/tablesorter/widgets/widget-sort2Hash.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/select2/select2.min.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/bootstrapradio.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/bootstrap-switch.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/handlebars-v1.2.0.js" ></script>
			<script src="<?php echo base_url(); ?>public/main/js/userfrosting.js" ></script>
		</div>
	</body>
</html>