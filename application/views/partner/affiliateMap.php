<?php
//require 'vendor/autoload.php'; //2017-04-06 has been commented by farshad
use Zendesk\API\HttpClient as ZendeskAPI;
$subdomain = "medonnex";
$username = "sureshvermaaa@gmail.com"; // replace this with your registered email
$token = "mcov5xSAoZAfqmAJqBAQlsfDe2ggQF53vsNSq7VQ";
$term_link = "<br><a href='".base_url()."term-condition'>Terms & Conditions</a>";
?>
<!DOCTYPE html>
<html lang="en" class=" js csstransforms csstransforms3d csstransitions">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Med Connex</title>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <!--   <link href="<?php echo base_url(); ?>/public/front/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" />
 -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>public/front/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/owl.carousel.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/owl.theme.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/owl.transitions.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/res.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/front.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>public/front/css/sidebar.css" rel="stylesheet" />
        <script>
            var basehostname = window.location.hostname; //Domain name.
        </script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="<?php echo base_url(); ?>public/front/scripts/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front/validation/jquery.validate.css" />

        <script type="text/javascript" src="<?php echo base_url(); ?>public/front/validation/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/front/validation/jquery.validation.functions.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    <style type="text/css">
            #loader {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                animation: spin 2s linear infinite;
                border-color: #e03d80 #f3f3f3 #f3f3f3;
                border-image: none;
                border-radius: 50%;
                border-style: solid;
                border-width: 16px;
                height: 120px;
                left: 50%;
                margin: -75px 0 0 -75px;
                position: absolute;
                top: 50%;
                width: 120px;
                z-index: 1;
            }
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

.side-menumedconnex {
    position: relative;
    display: inline-block;
    float: left;
}

.quick-menu {
    position: absolute;
    z-index: 111;
    margin-left: 1.5em;
    /*left: 250px;*/
    left:0px;
    z-index: +999;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 0px;
    width: 250;
    height: 100%;
    margin-left:inherit !important;
    overflow-y: auto;
    background: #fff;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.store-btn li img{width: 200px;}
@media only screen and (max-width: 360px)
{
	.quick-menu {
    margin-left: 1em;
}
}

.widthsignup {
	width: 100%;
}

	.TermsAndCondtions{
		padding: 0;
	}
	.TermsAndCondtions li{
		display: inline-block;
		margin-right: 10px;
		list-style: none;
	}
	.agreements .tab-content{
		padding: 20px 10px;
	}
section.agreements {
    background: #fff;
    float: left;
    width: 100%;
}

h4.modal-title.trns {
    font-size: 14px;
}
h4.modal-title {
    text-align: center;
}

/*.modal-dialog {
    width: 510px !important;
    
}*/
p.trns {
    font-weight: bold;
}
    </style>


    <body data-spy="scroll" data-target=".main-nav">
		<div id="loaderbg" style="position: fixed;
    top: 0px;
    left: 0px;
    background: none 0% 0% repeat scroll rgba(0, 0, 0, 0.6);
    z-index: 1999;
    width: 100%;
    height: 100%;
    display: none;">
			<div id="loader"></div>
		</div>
    
        <div id="wrapper" class="toggled">
            <!-- Sidebar -->
         <?php $this->load->view('side_menu'); ?> 

            <section class="home main-banner-sec" id="home" style="background: url(http://medconnex.net/demonil/public/images/affiliateSignup-bg.png)no-repeat center center;background-size: 100% 100%;">
                
             


				<!--Tool Kit Email-->
				<div class="modal fade" id="toolKitRequest" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content mainbox" id="">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title trn" data-trn-key="email_request">Email Request</h4>
							</div>
							<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;">
								<img src='<?php echo base_url(); ?>public/img/ajax-loader.gif' width="64" height="64" /><br>
								<span class="trn" data-trn-key="plz_wait">Please wait...</span></div>

							<div class="modal-body field">
								<div class="col-md-12">
									<form action="" method="post" class="LoginForm" enctype="multipart/form-data">
										<h4 class="trn" data-trn-key="about_med_connex">Are you interested in receiving more information about Med Connex?</h4>
										<div class="form-group">
											<input type="email" class="form-control" id="loginValidEmail2" placeholder="Email">
										</div>
										<input type="submit" name="signup" id="FormSubmit3" value="Send" class="btn btn-main btn-lg btn-success btn-info " data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">
									</form>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>
					</div>
				</div>




				<div class="modal fade" id="logindiffernt" role="dialog">			
					<div class="modal-content mainbox" style="width: 30%;margin-left: 35%;margin-top:2%;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title trn" align='center' data-trn-key="login">LOG IN</h4>
						</div>
						<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;">
							<img src='<?php echo base_url(); ?>public/img/ajax-loader.gif' width="64" height="64" /> <br>
						<span class="trn" data-trn-key="plz_wait">Please wait...</span></div>
						<span id="error-message-checklogin" style="font-size: 12px; color: #D00; padding-left:262px; font-style: italic;"></span>
						<div class="modal-body field" style="height: 350px;overflow-y: auto;">
							<div class="col-md-12">
								<form id="LoginForm2" action="" method="post" class="LoginForm">
									<div class="form-group">
										<input type="email" name="login_email" class="form-control" id="loginValidEmail1" placeholder="Email" required="">
									</div>
									<div class="form-group">
										<input type="password" name="login_password" class="form-control" id="loginValidPassword1" placeholder="Password" required="">
									</div>
									<div class="form-group">
										<a href="forget.php" class="trn" data-trn-key="forget_pass"> Forgot password?</a>
									</div>
									<button type="submit" name="login_btn" id="login_btn1" style="width: 100% !important;border-radius: 0 !important;" data-trn-key="login"  onMouseOver="this.style.color = '#000', this.style.background - color = '#fff;'" class="btn btn-main btn-lg btn-success btn-info trn" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching..."> Log in</button>
								</form>
								<div class="form-group">
									<div class="col-md-12 control">
										<div style="padding-top:15px; font-size:85%;text-align: center;">
										<span class="trn" data-trn-key="dont_account">Don't have an account?</span>
											<a id="btnlogindiffrent"  style="cursor: pointer;">
												Sign up
											</a>
										</div>
										<div style="padding-top:15px; font-size:85%;text-align: center;">
									
											<a id="staffLogin" style="cursor: pointer;">
												Staff Login
											</a>
										</div>
									</div>
								</div>
							</div>
							<div style="clear:both;"></div>


						</div>
					</div>

				</div>


				<!-- staff login-->

                 
				<div class="modal fade" id="staffloginDiffernt" role="dialog">			
					<div class="modal-content mainbox" style="width: 30%;margin-left: 35%;margin-top:2%;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title trn" align='center' >STAFF LOG IN</h4>
						</div>
						<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;">
							<img src='<?php echo base_url(); ?>public/img/ajax-loader.gif' width="64" height="64" /> <br>
						<span class="trn" data-trn-key="plz_wait">Please wait...</span></div>
						<span id="error-message-checklogin" style="font-size: 12px; color: #D00; padding-left:262px; font-style: italic;"></span>
						<div class="modal-body field" style="height: 350px;overflow-y: auto;">
							<div class="col-md-12">
								<form id="LoginForm22" action="<?php echo base_url('staff-login'); ?>" method="post" class="LoginForm">
									<div class="form-group">
										<input type="email" name="login_email" class="form-control" id="loginValidEmail12" placeholder="Email" required="">
									</div>
									<div class="form-group">
										<input type="password" name="login_password" class="form-control" id="loginValidPassword12" placeholder="Password" required="">
									</div>
									<div class="form-group">
										<a href="forget.php" class="trn" data-trn-key="forget_pass"> Forgot password?</a>
									</div>
									<button type="submit" name="login_btn" id="login_btn12" style="width: 100% !important;border-radius: 0 !important;"   onMouseOver="this.style.color = '#000', this.style.background - color = '#fff;'" class="btn btn-main btn-lg btn-success btn-info trn" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching..."> Staff Log in</button>
								</form>
								<div class="form-group">
									<div class="col-md-12 control" style="display: none;">
										<div style="padding-top:15px; font-size:85%;text-align: center;">
										<span class="trn" data-trn-key="dont_account">Don't have an account?</span>
											<a id="btnlogindiffrent"  style="cursor: pointer;">
												Sign up
											</a>
										</div>
										
									</div>
								</div>
							</div>
							<div style="clear:both;"></div>


						</div>
					</div>

				</div>

			     <!-- 	staff close-->



				<!-- Modal -->
				<div class="modal fade" id="login" role="dialog" style="overflow-y: scroll;">
					<div class="modal-dialog">
						<!--Sign up form-->
						<!-- Modal content-->
						<div class="modal-content mainbox" id="sign-up" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><b>SIGN UP</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body" style="height: auto;">
								<div id="msg_success" align="center" style="color:green;"></div>
								<div id="msg_error" align="center" style="color:red;"></div>
								<div class="col-md-12 selectSignTypo">
									<div class="row">
										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" value="DRIVER" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup"  style="background: #E03D82; border: none; color: #fff;">
	                                          <!--   <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Affiliate Partners
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" value="DRIVER" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                          <!--   <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Standard / On-Demand
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-doctor').show()" name="signup" value="DOCTOR" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-doctor').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                         <!--    <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Standard / Doctor's
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-storefront').show()" name="signup" value="STOREFRONT" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-storefront').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                      <!--       <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                           Premium / Storefront
	                                        </button>
										</div>
										<div class="col-md-12 text-center">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-salesteam').show()" name="signup" value="SALES TEAM" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button  class="btn btn-lg btn-success btn-info" onClick="$('#sign-up').hide(); $('#sign-up-salesteam').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                     <!--        <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Community Managers
	                                        </button>
										</div>

										<div class="form-group">
											<div class="col-md-12 control">
												<div style="padding-top:15px; font-size:85%;text-align: center;">
													<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
													<a href="#" onClick="$('#sign-up').hide(); $('#log-in').show()" class="trn" data-trn-key="login">Log in</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>


						<div class="modal-content mainbox" id="sign-up-driver" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" onclick="closeModal(this);">&times;</button>
								<h4 class="modal-title"><b class="trns" data-trn-key="driver_signups">On-Demand Driver Sign Up</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<form id="drive_registration" action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Valid Driver License</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_valid_licence" required />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>

										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="vehical_reg">Vehicle Registration</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vehicle_registration" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="vehical_insurance">Vehicle Insurance</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vehicle_insurance" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label ><span class="trn" data-trn-key="vehical_insp">Vehicle Inspection </span> <br> <i>(uber or lyft copy)</i></label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
												<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vechile_inspection" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="upload_docotr">Upload Doctors Recommendation</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="upload_doctor_recommend" required />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" name="drive_email" class="form-control drive_email" id="drive_email" placeholder="Email"  required>
												<input type="hidden" name="user_type" class="form-control" value="1" required>
											</div>
											<br><br>

										</div>
										
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>

										<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;padding: 10px">
											<input href="#" type="submit" class="btn btn-main" value="Register" >
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-driver').hide(); $('#log-in').show()" class="trn" data-trn-key="login">
													Log in
												</a>
										<!-- 		<?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>

						<!--Sign Up Doctor-->
						<div class="modal-content mainbox" id="sign-up-doctor" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" onclick="closeModal(this);">&times;</button>
								<h4 class="modal-title"><b class="trn" >DOCTOR SIGN UP</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<form id="doctor_registration" action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Valid State ID</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="doctor_valid_state" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>


										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="monthly_bill">Monthly Utility Bill</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="doctor_montly_bill" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" class="form-control drive_email" name="drive_email" placeholder="Email" id="doctor_email"  required>
												<input type="hidden" name="user_type" class="form-control" value="2" required>
											</div>
											<br><br>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8 trn" data-trn-key="social_media_link">Social Media Link</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="text" class="form-control social_id" name="socialmedialink" id="doctor_social_id" placeholder="Social Media Link" required>
											</div>
											<br><br>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>
										<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;padding: 10px">
											<input  type="submit" class="btn btn-main" value="Register">
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-doctor').hide(); $('#log-in').show()" class="trn" data-trn-key="login">Log in</a>
												<!-- 	<?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>

						<!--Sign Up Storefront-->
						<div class="modal-content mainbox" id="sign-up-storefront" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" onclick="closeModal(this);">&times;</button>
								<h4 class="modal-title"><b class="trn" data-trn-key="storefront_signup">STOREFRONT SIGN UP</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<form id="storefront_registration"  action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Valid State ID</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="store_stateId" required  />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>


										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="monthly_bill">Monthly Utility Bill</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="store_monthly_until"required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" class="form-control drive_email" name="drive_email" placeholder="Email" onblur="validateEmail(this);" id="store_email" required>
												<input type="hidden" name="user_type" class="form-control" value="3" required>
											</div>
											<br><br>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8 trn" data-trn-key="social_media_link">Social Media Link</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="text" class="form-control social_id" name="socialmedialink" placeholder="Social Media Link" id="store_social_id" required>
											</div>
											<br><br>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>
										<br><br>

										<div class="text-center" style="clear: both;padding:10px">
											<input href="#" type="submit" class="btn btn-main" value="Register">
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-storefront').hide(); $('#log-in').show()" class="trn" data-trn-key="login">
													Log in
												</a>
												<!-- 	<?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>
						<!--Sign Up salesteam-->
						<div class="modal-content mainbox" id="sign-up-salesteam" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" onclick="closeModal(this);">&times;</button>
								<h4 class="modal-title"><b class="trn" data-trn-key="salesteam_signup">SALES TEAM SIGN UP</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<form id="salesteam_registration" action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Resume/Curriculum</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]"  id="sales_resume" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>References Page</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="sales_reference" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>


										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="monthly_bill">Monthly Utility Bill</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="sales_monthly_bill" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" class="form-control drive_email" name="drive_email" placeholder="Email" onblur="validateEmail(this);" id="salesteam_email" required>
												<input type="hidden" name="user_type" class="form-control" value="4" required>
											</div>
											<br><br>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8 trn" data-trn-key="social_media_link">Social Media Link</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="text" class="form-control social_id" name="socialmedialink" placeholder="Social Media Link" id="sales_social" required>
											</div>
											<br><br>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>
										<br><br>

										<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;padding: 10px">
											<input href="#" type="submit" class="btn btn-main" value="Register">
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-salesteam').hide(); $('#log-in').show()" class="trn" data-trn-key="login">
													Log in
												</a>
												<!-- 	<?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>

						<!--Login form-->
						<!-- Modal content-->
						<div class="modal-content mainbox" id="log-in">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title trn"  data-trn-key="login">LOG IN</h4>
							</div>
							<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;">
								<img src='<?php echo base_url() ?>public/img/ajax-loader.gif' width="64" height="64" /> <br>
								<span class="trn" data-trn-key="plz_wait">Please wait...</span></div>
							<span id="error-message-checklogin" style="font-size: 12px; color: #D00; padding-left:262px; font-style: italic;"></span>
							<div class="modal-body field">
								<div class="col-md-12">
									<form id="LoginForm1" action="" method="post" class="LoginForm">
										<div class="form-group">
											<input type="email" name="login_email" class="form-control" id="loginValidEmail3" placeholder="Email" required="">
										</div>
										<div class="form-group">
											<input type="password" name="login_password" class="form-control" id="loginValidPassword" placeholder="Password" required="">
										</div>
										<div class="form-group">
											<a href="forget.php" class="trn" data-trn-key="forget_pass"> Forgot password?</a>
										</div>
										<button type="submit" name="login_btn" id="login_btn"   class="btn btn-main btn-lg btn-success btn-info trn" data-trn-key="login" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">Log in </button>
									</form>
									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="dont_account">Don't have an account?</span>
												<a href="#" id="btnSigUp-modal" onClick="$('#log-in').hide(); $('#sign-up').show()">
													Sign up
												</a>
												
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>


							</div>
						</div>
						<!--//.Login form-->
						<!--Enter your info-->
						<!-- Modal content-->
						<div class="modal-content mainbox" id="enter-info" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title trn"  data-trn-key="enter_info">Enter your info</h4>
							</div>
							<div class="modal-body">

								<div class="col-md-12">
									<form action="" method="post" class="AdvancedEnterInfo">
										<input type="hidden" name="uid" id="uid" value="">
										<div class="form-group">
											<input type="text" class="form-control" name="username"  placeholder="Name" id="ValidName">
										</div>
										<div class="form-group">
											<input type="number" class="form-control" name="mob_number"  placeholder="Mobile Phone" id="ValidNumber">
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="type" id="Driver" value="Driver"><span class="trn" data-trn-key="driver">Driver</span></label>
										</div>

										<div id="driver_hide" style="display:block;">
											<div class="radio">
												<label>
													<input type="radio" name="type" value="Doctor"><span class="trn" data-trn-key="doctor">Doctor</span></label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="type" value="Storefront"><span class="trn" data-trn-key="storefront">Storefront</span></label>
											</div>
										</div>

										<div id="driver_show" style="display:none;">
											<h4 class="trn" data-trn-key="drive_vehi_doc">Driver Vehicle Documentation</h4>
											<div id="wait" style="display:none;position:fixed;height:89px;padding-left:113px; margin: 0 auto; zoom: 1; z-index: 999;">
												<img src='<?php echo base_url(); ?>public/img/ajax-loader.gif' width="64" height="64" /> <br>
												<span class="trn" data-trn-key="plz_wait">Please wait...</span></div>

											<div class="form-group">
												<label>Driver License</label>
												<input type="file" id="driver_license" name="driver_license"  />
												<input type="button" id="license_upload" value="Upload" />
											</div>

											<div class="form-group">
												<label class="trn" data-trn-key="drive_insr">Driver Insurance</label>
												<input type="file" id="driver_insurace" name="driver_insurace" class="form-control"  />
												<input type="button" id="driver_insurace_upload" value="Upload" class="form-control" />
											</div>

											<div class="form-group">
												<label  class="trn" data-trn-key="vehical_reg">Vehicle Registration</label>
												<input type="file" id="vechile_registration" name="vechile_registration"  class="form-control" />
												<input type="button" id="vechile_registration_upload" value="Upload" class="form-control" />
											</div>

											<div class="form-group">
												<label class="trn" data-trn-key="vehical_insurance">Vehicle Insurance</label>
												<input type="file" id="vehicle_insurance" name="vehicle_insurance" class="form-control"  />
												<input type="button" id="vehicle_insurance_upload" value="Upload" class="form-control" />
											</div>

											<div class="form-group">
												<label><span class="trn" data-trn-key="vehical_insp">Vehicle Inspection</span> (uber or lyft copy)</label>
												<input type="file" id="vechicle_inspection" name="vechicle_inspection" class="form-control" />
												<input type="button" id="vechicle_inspection_upload" value="Upload" class="form-control"/>
											</div>

											<div class="form-group">
												<label>Upload Recommendation  and  state ID</label>
												<input type="file" id="recommendation_state_id" name="recommendation_state_id" class="form-control" />
												<input type="button" id="recommendation_state_id_upload" value="Upload" class="form-control" />
											</div>
										</div>

										<input type="submit" name="signup" id="FormSubmit4" value="SIGN UP" class="btn btn-main btn-lg btn-success btn-info" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">

									</form>
								</div>

								<div style="clear:both;"></div>


							</div>
						</div>
						<!--//.Enter your info-->
						<!--Choose your location-->
						<!-- Modal content-->
						<div class="modal-content mainbox" id="choose-loc" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title trn" data-trn-key="choice_location">Choose your location</h4>
							</div>
							<div class="modal-body">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form  action="" method="post" class="AdvancedchooseLoc">
										<input type="hidden" name="userid" id="userid" value="">
										<div class="radio">
											<label>
												<input type="radio" name="location" value="San Diego">San Diego</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="location" value="East Bay">East Bay</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="location" value="California">California</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="location" value="San Francisco">San Francisco</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="location" value="Santa Cruz">Santa Cruz</label>
										</div>
										<input type="submit" name="signup" id="FormSubmit1" value="SIGN UP" class="btn btn-main btn-lg btn-success btn-info" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">
									</form>
								</div>
								<div class="col-md-3"></div>
								<div style="clear:both;"></div>
							</div>
						</div>
						<!--//.Choose your location-->
						<!--Agree terms and conditions-->
						<!-- Modal content-->
						<div class="modal-content mainbox" id="terms-info" style="display:none;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title trn" data-trn-key="term_cond">Terms & Conditions</h4>
							</div>
							<div class="modal-body">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form  action="" method="post" class="Advacedterminfo">
										<input type="hidden" name="user_id" id="user_id" value="">


										<div class="agreeTerms">
											<p class="trn" data-trn-key="plz_conform_msg">Please confirm that you've read, understood, and that you agree to the following:</p>
											<ul>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </li>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis. </li>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. </li>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. </li>
											</ul>
										</div>
										<input type="submit" name="signup" id="FormSubmit2" value="SIGN UP" class="btn btn-main btn-lg btn-success btn-info" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">
									</form>
								</div>
								<div class="col-md-3"></div>
								<div style="clear:both;"></div>
							</div>
						</div>
						<!--//.Agree terms and conditions-->

					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="st-home-unit-2" style="padding: 50px 0;position: relative;margin-top: 5em;margin-bottom: 8.5em;z-index: 2;">
								<a class="main-logo" href="#"><img src="<?php echo base_url(); ?>/public/images/medco-logo.png" alt="" class="img-responsive">
								</a>
								<div class="hero-txt main-nav">
									<?php if ($this->session->flashdata('errormessage')) { ?>
										<div role="alert" class="alert alert-danger" style="width: 50%;margin-left: 25%;">
											<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
											<?= $this->session->flashdata('errormessage') ?>
										</div>
									<?php } ?>
									<?php if ($this->session->flashdata('successmessage')) { ?>
										<div role="alert" class="alert alert-success" style="width: 50%;margin-left: 25%;">
											<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
											<?= $this->session->flashdata('successmessage') ?>
										</div>
									<?php } ?>
								<!-- <p class="hero-sub-title">We Provide Hight Quality Bootstrap Template</p> -->



						<!-- 			<a onclick="goToSignUp()" class="btn btn-main btn-lg left-btn">Sign Up</a> -->


									
									<!--<a href="#" class="btn btn-main btn-lg " style="width:15%;">iOS</a>
									<a href="#" class="btn btn-main btn-lg " style="width:15%;">Android</a>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="main-nav">
					<a href="#about">
						<div class="mouse-icon ">
							<div class="wheel"></div>
						</div>
					</a>
				</div>
			</section>
				<!--Services Section-->
			<section class="service" id="service">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title st-center">
								<!--<h3>What we do</h3>-->
								<p class="title-heading font-century text-capitalize" data-trn-key="menu_service">Available Market in USA</p>
								<!-- <a href="#" onclick="goToSignUp()" class="btn btn-main btn-lg left-btn">Sign Up</a> -->
							</div>
							<div class="block typeOfServices">
								<div class="signup-container">
									<div class="col-md-12">
										<div class="inner-container">
											<h3 class="fs-34">The States Where It’s Legal To Smoke Marijuana</h3>
											<br>
											<div class="map">
												<ul>
													<li>
														<span><figure class="box pink"></figure> Medical Use Only</span>
													</li>
													<li>
														<span><figure class="box green"></figure> Legalized for Recreational Use</span>
													</li>
												</ul>
											</div>
										</div>
										<br>
										<img src="<?php echo base_url('public/images/map.png');?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>


		
			<section class="service" id="socialPostings">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="block row order-list">
								<div class="signup-container">
									<div class="col-md-6 col-sm-6">
										<h3 class="font-century text-capitalize text-pink fs-28">
											Medical Use
										</h3>
										<ol>
											<li>Arizona</li>
											<li>California</li>
											<li>Connecticut</li>
											<li>Delaware</li>
											<li>Hawaii</li>
											<li>Illinois</li>
											<li>Maine</li>
											<li>Maryland</li>
											<li>Massachusetts</li>
											<li>Michigan</li>
											<li>Minnesota</li>
											<li>Montana</li>
											<li>Nevada</li>
											<li>New Hampshire</li>
											<li>New Jersey</li>
											<li>New Mexico</li>
											<li>New York</li>
											<li>Pennsylvania</li>
											<li>Rhode Islands</li>
											<li>Vermont</li>
											<li>Arkansas</li>
											<li>Florida</li>
											<li>Montana</li>
											<li>North Dakota</li>
										</ol>
									</div>
									<div class="col-md-6 col-sm-6">
										<h3 class="font-century text-capitalize text-green fs-28">
											Recreational Use
										</h3>
										<ol>
											<li>Nevada</li>
											<li>Alaska</li>
											<li>Colorado</li>
											<li>Oregon</li>
											<li>Washington</li>
											<li>California</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section><br/><br/>
			<section class="service">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title st-center">
								<p class="title-heading font-century text-capitalize dark-color" data-trn-key="Our Team">Enrollment</p>
							</div>
							<div class="block enrollment">
								<p>Med Connex is seeking affiliate partners, who understand our vision and expansion efforts. Our detailed Affiliate Partnership Program has been designed to provide ease in applying, transparency, and ability for exponential growth in selected markets.</p>
								<p>The following steps are required when applying for an Affiliate Partnership License with Med Connex Mobile App:</p>
								<ol>
									<li>Online application</li>
									<li>Our due diligence</li>
									<li>Phone interview</li>
									<li>On-Site interview</li>
									<li>Product business plan</li>
									<li>Agreement & signing</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="service">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title st-center">
								<p class="title-heading font-century text-capitalize dark-color" data-trn-key="Our Team">Go to Market</p>
							</div>
							<div class="block enrollment">
								<p>Once you have been approved for a distribution license, the following shall take place to ensure not only a dominant presence within your territory but also a successful launch in your region</p>
								<ol>
									<li>Forward Starter Kit <br> <small><i>(custom designs, promotional materials, training sessions, and more)</i></small></li>
									<li>On-line Training Schedule</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--Footer-->
			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							© Copyright
							<?php echo date('Y')?>
							 www.medconnex.net
						</div>
					</div>
				</div>
			</footer>

		</div>


		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
	             <div class="modal-content mainbox" >
						<div class="modal-body" style="height: 200px;display: flex;align-items: center;justify-content: center;">
								
								<div class="col-md-12 selectSignTypo androidIos">
									<div class="col-md-12 text-center"><h2 style="color: #e737f7;">Available On</h2></div>
									<ul class="store-btn">
										<li>
											
											<a href="https://play.google.com/store/apps/details?id=com.medconnex.pbs" target="new">
												<img src="<?php echo base_url(); ?>uploads/app-google.png" > 
										
	                                    </a>
										</li>
										<li>
											
											<a href="https://play.google.com/store/apps/details?id=com.medconnex.pbs" target="new">
												<img src="<?php echo base_url(); ?>uploads/app-mac.png" > 
										
	                                    </a>
										</li>
									</ul>
								
						
								</div>
							
								
							</div>
						</div>

			</div>
		</div>





	<div id="myModal112" class="modal fade" role="dialog">
			<div class="modal-dialog">
	             <div class="modal-content mainbox" >
							<div class="modal-body" style="height: 200px;display: flex;align-items: center;">
								<div class="col-md-12 selectSignTypo androidIos">
									<ul class="store-btn">
										<li>
											<a href="https://play.google.com/store/apps/details?id=com.medconnex.pbs" target="new">
												<img src="<?php echo base_url(); ?>uploads/app-google.png" > 
											</a>
										</li>
										<li>
											<a href="https://play.google.com/store/apps/details?id=com.medconnex.pbs" target="new">
												<img src="<?php echo base_url(); ?>uploads/app-mac.png" > 
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
			</div>
		</div>

	<div id="myModal111" class="modal fade" role="dialog">
			<div class="modal-dialog">
	             <div class="modal-content mainbox" >
	             	<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title" style="text-align: center;"><b>SIGN UP</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
						 
							<div class="modal-body" style="height: 255px; display: flex;align-items: center;">
								
								<div class="col-md-12 selectSignTypo androidIos" >
								
										<div class="modal-body" style="height: auto;">
								<div id="msg_success" align="center" style="color:green;"></div>
								<div id="msg_error" align="center" style="color:red;"></div>
								<div class="col-md-12 selectSignTypo">
									<div class="row">
										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" value="DRIVER" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup"  style="background: #E03D82; border: none; color: #fff;">
	                                          <!--   <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Affiliate Partners
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" value="DRIVER" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-driver').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                          <!--   <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Standard / On-Demand
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-doctor').show()" name="signup" value="DOCTOR" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-doctor').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                         <!--    <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Standard / Doctor's
	                                        </button>
										</div>

										<div class="col-md-6">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-storefront').show()" name="signup" value="STOREFRONT" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button class="btn btn-lg btn-success btn-info widthsignup" onClick="$('#sign-up').hide(); $('#sign-up-storefront').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                      <!--       <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                           Premium / Storefront
	                                        </button>
										</div>
										<div class="col-md-12 text-center">
											<!--<input type="button" onClick="$('#sign-up').hide(); $('#sign-up-salesteam').show()" name="signup" value="SALES TEAM" class="btn btn-main btn-lg btn-success btn-info">-->
	                                        <button  class="btn btn-lg btn-success btn-info" onClick="$('#sign-up').hide(); $('#sign-up-salesteam').show()" name="signup" style="background: #E03D82; border: none; color: #fff;">
	                                     <!--        <img src="<?php echo base_url(); ?>public/images/android.png" style="width: 45px; height: 45px;"> -->
	                                            Community Managers
	                                        </button>
										</div>

										<div class="form-group">
											<div class="col-md-12 control">
												<div style="padding-top:15px; font-size:85%;text-align: center;">
													<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
													<a href="#" onClick="$('#sign-up').hide(); $('#log-in').show()" class="trn" data-trn-key="login">Log in</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
								</div>
							
								
							</div>
						</div>

			</div>
		</div>




		<!-- On-Demand Registration Modal -->
		<!-- Modal -->
		<div id="OnDemandSignUp1" class="modal fade" role="dialog">
			<div class="modal-dialog" style="width: 510px !important;">
			
				<div class="modal-content">
				<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><b class="trns" data-trn-key="driver_signups">On-Demand Driver Sign Up</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
					<div class="modal-body">
								<div class="col-md-12">
									<form id="drive_registration1" action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Valid Driver License</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_valid_licence1" required />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>

										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="vehical_reg">Vehicle Registration</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vehicle_registration1" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="vehical_insurance">Vehicle Insurance</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vehicle_insurance1" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label ><span class="trn" data-trn-key="vehical_insp">Vehicle Inspection </span> <br> <i>(uber or lyft copy)</i></label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
												<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="driver_vechile_inspection1" required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="upload_docotr">Upload Doctors Recommendation</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="upload_doctor_recommend1" required />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" name="drive_email" class="form-control drive_email" id="drive_email1" placeholder="Email"  required>
												<input type="hidden" name="user_type" class="form-control" value="1" required>
											</div>
											<br><br>

										</div>
										
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>

										<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;padding: 10px">
											<input href="#" type="submit" class="btn btn-main" value="Register" >
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-driver').hide(); $('#log-in').show()" class="trn" data-trn-key="login">
													Log in
												</a>
												<!-- <?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
					<!-- <div class="modal-body">
						<div class="col-md-12">
							<form>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label>Valid Driver License</label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
										<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" name="upload" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label  class="trn" data-trn-key="vehical_reg">Vehicle Registration</label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" name="upload" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="vehical_insurance">Vehicle Insurance</label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
										<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" name="upload" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label><span class="trn" data-trn-key="vehical_insp">Vehicle Inspection </span> <br> <i>(uber or lyft copy)</i></label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" name="upload" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="upload_docotr">Upload Doctors Recommendation</label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" name="upload" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>
								<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;">
									<input href="#" type="submit" class="btn btn-main" value="Register">
								</div>
							</form>
						</div>
					</div> -->
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<!-- // End On-Demand Registration Modal -->


		<!-- Store fronts Registration Modal -->
		<!-- Modal -->
		<div id="storeFrontsSignUp" class="modal fade" role="dialog">
			<div class="modal-dialog"  style="width: 510px !important;">
			
				<div class="modal-content">
			<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><b class="trn" data-trn-key="storefront_signup">STOREFRONT SIGN UPs</b> <span class="colorPink trn" data-trn-key="new_account">New Account</span></h4>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<form id="storefront_registration1"  action="" method="post" enctype="multipart/form-data" novalidate="">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label>Valid State ID</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="store_stateId1" required  />
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>


										<div class="fileupload fileupload-new" data-provides="fileupload">
											<label class="trn" data-trn-key="monthly_bill">Monthly Utility Bill</label>
											<div class="uploadSectionWrap">
												<span class="btn btn-primary btn-file">
													<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
													<span class="fileupload-exists trn" data-trn-key="change">Change</span>
													<input type="file" name="upload[]" id="store_monthly_until1"required/>
												</span>
												<p style="text-align: right;">
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</p>
											</div>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8">Email</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="email" class="form-control drive_email" name="drive_email" placeholder="Email" onblur="validateEmail(this);" id="store_email1" required>
												<input type="hidden" name="user_type" class="form-control" value="3" required>
											</div>
											<br><br>
										</div>

										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding">
												<label class="padding-top-8 trn" data-trn-key="social_media_link">Social Media Link</label>
											</div>
											<div class="col-md-8 no-padding">
												<input type="text" class="form-control social_id" name="socialmedialink" placeholder="Social Media Link" id="store_social_id1" required>
											</div>
											<br><br>
										</div>
										<div class="col-md-12 no-padding">
											<div class="col-md-4 no-padding"></div>
											<div class="col-md-8 no-padding">
												<?php echo $captchdata['widget']; ?>
											</div>
											
										</div>
										<br><br>

										<div class="text-center" style="clear: both;padding:10px">
											<input href="#" type="submit" class="btn btn-main" value="Register">
										</div>
									</form>

									<div class="form-group">
										<div class="col-md-12 control">
											<div style="padding-top:15px; font-size:85%;text-align: center;">
												<span class="trn" data-trn-key="arleady_act">Already have an account!</span>
												<a href="#" onClick="$('#sign-up-storefront').hide(); $('#log-in').show()" class="trn" data-trn-key="login">
													Log in
												</a>
													<!-- <?php echo $term_link ?> -->
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
		<!-- 	<div class="modal-dialog">
			
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title trn"  data-trn-key="premum_store_title">Premium / Storefronts</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-12">
							<form>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label>Valid Proof of Storefront Location<br> <i class="trn" data-trn-key="monthy_visible_adrs">(a monthly bill with visible address)</i></label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="promot_marketing">Promotional or Marketing Material<br> <i class="trn" data-trn-key="promot_marketing_1">(w/ storefront name & address) </i></label>
									<div class="uploadSectionWrap">
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new trn" data-trn-key="select_file">Select file</span>
											<span class="fileupload-exists trn" data-trn-key="change">Change</span>
											<input type="file" required/>
										</span>
										<p style="text-align: right;">
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
										</p>
									</div>
								</div>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="provie_soicl_medi_link">Provide at least 1 Social Media Link</label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="text" required value="" placeholder="Enter here">
									</div>
								</div>

								<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;">
									<input type="submit" class="btn btn-main" value="Register">
								</div>
							</form>
						</div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div> -->
		</div>
	</div>
		</div>
		<!-- // End Store fronts Registration Modal -->

		<!-- Affiliate partners Registration Modal -->
		<!-- Modal -->
		<div id="affiliatePartnerSignUp" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title trn"  data-trn-key="affiliate_part_title">Affiliate Partners</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-12">
							<form>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="contact_name">Contact Name </label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="text" required value="" placeholder="Name">
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="location_address">Location Address  </label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="text" required value="" placeholder="Address">
									</div>
								</div>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="location_phone">Location Phone #</label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="text" required value="" placeholder="w/ storefront name & address">
									</div>
								</div>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="main_cont_phone">Main Contact Phone #</label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="text" required value="" placeholder="Enter here">
									</div>
								</div>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<label class="trn" data-trn-key="send_email">SEND EMAIL TO:</label>
									<div class="uploadSectionWrap uploadInputFields">
										<input type="email" required value="" placeholder="Email">
									</div>
								</div>

								<div class="text-center" style="clear: both;margin-bottom: 25px;margin-top: 35px;">
									<input type="submit" class="btn btn-main" value="Send">
								</div>
							</form>
						</div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<!-- // End Affiliate partners Registration Modal -->


		<!--Start download packages-->
		<div id="downloadPack1" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="OnDemandSignUpclose close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title trns" data-trn-key="stand_ondemand_title">Intended for On-Demand Drivers who are always on the GO!!</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="pricing-table">
								<div class="pricing-header">

									<div class="pt-name trns"  data-trn-key="stand_ondemand_title">Standard Membership</div>
								</div>
								<div class="pricing-body">
									<ul>
										<?php
										$resultcp_services_content = $this->db->query("SELECT * FROM cp_services_content s,cp_our_services c WHERE s.services_id_fk=c.services_id AND s.services_id_fk = 1;");
										$dataservice = $resultcp_services_content->result();
										foreach ($dataservice as $rowservice) {
											?>
											<li><i class="fa fa-check"></i> <?php echo $rowservice->services_content; ?></li>
											<?php
										}
										?>
									</ul>
									<div class="pricingWrap">
										<div class="purchase-sec">
											<input name="promotional_code" class="form-control" type="text" value="" placeholder="Promo Code" required="">
											<!--<input name="months" class="form-control" type="number" value="" placeholder="No of Months" required="">-->
											<?php $result=$this->db->query("SELECT * from cp_our_services WHERE services_id ='1'"
												);
											 $serviceResult=$result->row();
											 if(!empty($serviceResult->percentage)){ ?>
                                                <span> <?php echo $serviceResult->percentage;?>% Per Transaction Fee </span><br>
											<?php }
											 if(!empty($serviceResult->pricing)){ ?>
                                              <span><?php echo $serviceResult->pricing;?>$ <?php echo $serviceResult->membership;?></span>
											<?php }

									          	?>
											
										
										</div>
									</div>
								</div>
								<div class="pricing-footer">
									<a data-target="#OnDemandSignUp1"  data-toggle="modal" class="btn btn-main OnDemandSignUp">SIGN UP</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>

		<div id="downloadPack2" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="storeFrontsSignUpclose close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title trns"  data-trn-key="premum_storefornt_title">Intended for Storefronts with larger operations and many staff!!</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="pricing-table">
								<div class="pricing-header">

									<div class="pt-name trns" data-trn-key="premum_storefornt_title">Premium Membership</div>
								</div>
								<div class="pricing-body">
									<ul>
										<?php
										$resultcp_services_content2 = $this->db->query("SELECT * FROM cp_services_content s,cp_our_services c WHERE s.services_id_fk=c.services_id AND s.services_id_fk = 2;");
										$dataservice2 = $resultcp_services_content2->result();
										foreach ($dataservice2 as $rowservice2) {
											?>
											<li><i class="fa fa-check"></i> <?php echo $rowservice2->services_content; ?></li>
										<?php } ?>
									</ul>



									<div class="pricingWrap">
										<div class="purchase-sec">
											<input name="promotional_code" class="form-control" type="text" value="" placeholder="Promo Code" required="">
											<!--<input name="months" class="form-control" type="number" value="" placeholder="No of Months" required="">-->
										<!-- 	<span><i class="trn" data-trn-key="per_trans_fee"> 4% Per Transaction Fee</i></span><br>
											<span><i class="trn" data-trn-key="monthly_memb_fee_1"> 99$ Monthly Membership Fee</i></span> -->
											<?php $results=$this->db->query("SELECT * from cp_our_services WHERE services_id ='2'"
												);

											 $serviceResults=$results->row();
											 $premiumprice=$serviceResults->pricing;
											 if(!empty($serviceResults->percentage)){ ?>
                                               <span><?php echo $serviceResults->percentage?>% Per Transaction Fee</span><br>
											<?php }
											 if(!empty($premiumprice)){ ?>
                                              <span><?php echo $premiumprice?>$ <?php echo $serviceResults->membership?></span>
											<?php }

									          	?>
										</div>
									</div>
								</div>
								<div class="pricing-footer">
									<a data-target="#storeFrontsSignUp" data-toggle="modal" class="btn btn-main storeFrontsSignUp">SIGN UP</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>

		<div id="downloadPack3" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title trn" data-trn-key="affiliate_part_title">Affiliate Partnerships</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="pricing-table">
								<div class="pricing-header">

									<div class="pt-name trn" data-trn-key="affiliate_part_title">Affiliate Partnerships</div>
								</div>
								<div class="pricing-body">
									<ul>
										<?php
										$resultcp_Affiliate = $this->db->query("SELECT * FROM cp_services_content s,cp_our_services c WHERE s.services_id_fk=c.services_id AND s.services_id_fk = 3;");
										$data_Affiliate = $resultcp_Affiliate->result();
										foreach ($data_Affiliate as $affiliate_view) {
											?>
											<li><i class="fa fa-check"></i> <?php echo $affiliate_view->services_content; ?></li>
										<?php } ?>
									</ul>
									<div class="pricingWrap">
										<div class="purchase-sec">
											<input name="promotional_code" class="form-control" type="text" value="" placeholder="Discount Code" required="">
											<!--<input name="months" class="form-control" type="number" value="" placeholder="No of Months" required="">-->
											<!--span><i> 4% Per Transaction Fee</i></span><br>
											<span><i> 65$ Monthly Membership Fee</i></span-->
											<!--h5>4% Per Transaction Fee</h5-->
                                           <?php $results=$this->db->query("SELECT * from cp_our_services WHERE services_id ='3'"
												);

											 $serviceResults=$results->row();
											 $premiumprice=$serviceResults->pricing;
											 if(!empty($serviceResults->percentage)){ ?>
                                               <span><?php echo $serviceResults->percentage?>% Per Transaction Fee</span><br>
											<?php }
											 if(!empty($premiumprice)){ ?>
                                              <span><?php echo $premiumprice?>$ <?php echo $serviceResults->membership?></span><br/>
											<?php }

									          	?>
											<span><i> <span class="trn" data-trn-key="send_email">Send email to</span>
													<a href="mailto:affiliatesales@medconnex.net" target="_top">affiliatesales@medconnex.net</a><span class="trn" data-trn-key="contct_mail"> and will be in contact in 24hrs</span></i></span>
										</div>
									</div>
								</div>
								<!--<div class="pricing-footer">-->
								<!--    <a data-target="#affiliatePartnerSignUp" data-toggle="modal" class="btn btn-main">SIGN UP</a>-->
								<!--</div>-->
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<!-- // End download packages-->
		
		<!-- /#wrapper -->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo base_url(); ?>/public/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.easing.min.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.appear.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.countTo.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.shuffle.modernizr.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.shuffle.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/owl.carousel.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.ajaxchimp.min.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/script.js"></script>
		<!--Jssor Slider-->
		<script src="<?php echo base_url(); ?>/public/front/scripts/jssor.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jssor.slider.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.waterwheelCarousel.js"></script>
		<script src="<?php echo base_url(); ?>/public/front/scripts/jquery.waterwheelCarousel.js"></script>
		<script src="<?php echo base_url(); ?>public/js/translate_jquery.js"></script>
		<script src="<?php echo base_url(); ?>public/js/translate_value.js"></script>
		<script>
                                $(document).ready(function() {
                                var carousel = $("#carousel").waterwheelCarousel({
                                flankingItems: 3,
                                        interval: 3000,
                                        cycle: true,
                                        autoPlay: 5000,
                                        movedToCenter: function($item) {
                                        var imageID = $item.attr('id');
                                        setupSlide(imageID);
                                        },
                                        movingFromCenter: function($item) {
                                        $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
                                        },
                                        movedFromCenter: function($item) {
                                        $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
                                        },
                                        clickedCenter: function($item) {
                                        $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
                                        }
                                });
                                function setupSlide(id)
                                {
                                var ex = $('#' + id).next().attr("id");
                                if (id == ex)
                                {
                                $(".box-inner").css("display", "none");
                                $('#' + id).next().css("display", "block");
                                }
                               else
                                {

                                }
                                }
                                });
		</script>
		<?php
		if (isset($flag) && $flag == 5) {
			?>
			<script type="text/javascript">
	            $('#myModal').modal('show');
			</script>
		<?php } ?>


		<?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'index') { ?>
			<script type="text/javascript">
	            $('#login').modal('show');
	            $('#sign-up').show();
	            $('#log-in').hide();
			</script>
		<?php } ?>
		<!-- Menu Toggle Script -->

		<!-- Coding for driver options Show/Hide -->
		<script>

            function closeModal(currEl){
            $(currEl).parent().parent().hide();
            $('#login').modal('hide');
            }

            $(document).ready(function () {

            $('#Driver').change(function () {
            if (this.checked){
            $('#driver_show').fadeIn('slow');
            $('#driver_hide').fadeOut('slow');
            }
            else
            {
            $('#driver_hide').fadeIn('slow');
            $('#driver_show').fadeOut('slow');
            }
            });
            $('#logindiffernt').delegate('#btnlogindiffrent', 'click', function (event) {
            $('#logindiffernt').hide();
            goToSignUp();
            });
            });
		</script>
		<!-- Coding End for driver options Show/Hide -->

		<script>


            function showPageloader() {
            document.getElementById("loaderbg").style.display = "";
            }
            function hidePageloader() {
            document.getElementById("loaderbg").style.display = "none";
            }

            $("#menu-toggle").click(function(e) {
	            e.preventDefault();
	            $("#wrapper").toggleClass("toggled");
	            if ($(".menuChange").hasClass("fa-bars")) {
	            	$('.quick-menu').css('left','240px');
	            $(".menuChange").removeClass("fa-bars");
	            $(".menuChange").addClass("fa-times");
	            } else {
	            		$('.quick-menu').css('left','0px');
	            $(".menuChange").removeClass("fa-times");
	            $(".menuChange").addClass("fa-bars");
	            }
            });

            $("#drive_registration").on('submit', (function(e) {
	            e.preventDefault();
	            var email = $('#drive_email').val();
	            var recaptcha=$('#drive_registration .g-recaptcha-response').val();
	            var store_email=$('#store_email').val();
	            var store_social_id=$('#store_social_id').val();
	           if(recaptcha ==''){
	           	alert('please verify captcha');
	             return false
	           }else if($('#driver_valid_licence')[0].files.length === 0){
			          alert("Please upload Valid Driver License");
			          return false;
			    }else if($('#driver_vehicle_registration')[0].files.length === 0){
			          alert("Please upload Driver vechile registration");
			          return false;
			    }else if($('#driver_vehicle_insurance')[0].files.length === 0){
			          alert("Please upload  Driver vechile Insurance");
			          return false;
			    }else if($('#driver_vechile_inspection')[0].files.length === 0){
			          alert("Please upload Driver vechile inspection");
			          return false;
			    }else if($('#upload_doctor_recommend')[0].files.length === 0){
			          alert("Please upload Driver Doctor recommanded");
			          return false;
			    }
			    else if(email == ''){
			          alert("Please Enter valid Email Address");
			          return false;
			    }else{
	            showPageloader();
	           
	            $.ajax({
	            url: "home/upload_signup",
	                    type: "POST",
	                    data:  new FormData(this),
	                    contentType: false,
	                    dataType: "json",
	                    cache: false,
	                    processData:false,
	                    success: function(data)
	                    {
	                    console.log(data);
	                    if (data.success)
	                    {
	                    $('#sign-up-driver').hide();
	                    $('#sign-up').show();
	                    $('#log-in').hide();
	                    $('#msg_success').html("Successfully signup...");
	                    $('#msg_error').html("");
	                    $('.fileupload-exists').click();
	                    $('#drive_email').val('');
	                    $('.social_id').val('');
	                    setTimeout(function () {
	                    window.location.href = '';
	                    }, 2000); //will call the function after 2 secs.
	                    }
	                    else
	                    {
	                    $('#sign-up-driver').hide();
	                    $('#sign-up').show();
	                    $('#log-in').hide();
	                    $('#msg_error').html("email already...");
	                    $('#msg_success').html("");
	                    $('.fileupload-exists').click();
	                    $('#drive_email').val('');
	                    $('.social_id').val('');
	                    }
	                    hidePageloader();
	                    },
	                    error: function(){
	                    hidePageloader();
	                    alert('somthing wrong..!');
	                    }
	            });
	             }
            }));






            $("#drive_registration1").on('submit', (function(e) {
	            e.preventDefault();
	            var email = $('#drive_email1').val();
	            var recaptcha=$('#drive_registration1 .g-recaptcha-response').val();
	            var store_email=$('#store_email').val();
	            var store_social_id=$('#store_social_id').val();
	           if(recaptcha ==''){
	           	alert('please verify captcha');
	             return false
	           }else if($('#driver_valid_licence1')[0].files.length === 0){
			          alert("Please upload Valid Driver License");
			          return false;
			    }else if($('#driver_vehicle_registration1')[0].files.length === 0){
			          alert("Please upload Driver vechile registration");
			          return false;
			    }else if($('#driver_vehicle_insurance1')[0].files.length === 0){
			          alert("Please upload  Driver vechile Insurance");
			          return false;
			    }else if($('#driver_vechile_inspection1')[0].files.length === 0){
			          alert("Please upload Driver vechile inspection");
			          return false;
			    }else if($('#upload_doctor_recommend1')[0].files.length === 0){
			          alert("Please upload Driver Doctor recommanded");
			          return false;
			    }
			    else if(email == ''){
			          alert("Please Enter valid Email Address");
			          return false;
			    }else{
	            showPageloader();
	           
	            $.ajax({
	            url: "home/upload_signup",
	                    type: "POST",
	                    data:  new FormData(this),
	                    contentType: false,
	                    dataType: "json",
	                    cache: false,
	                    processData:false,
	                    success: function(data)
	                    {
	                    console.log(data);
	                    if (data.success)
	                    {
	                    $('#sign-up-driver').hide();
	                    $('#sign-up').show();
	                    $('#log-in').hide();
	                    $('#msg_success').html("Successfully signup...");
	                    $('#msg_error').html("");
	                    $('.fileupload-exists').click();
	                    $('#drive_email').val('');
	                    $('.social_id').val('');
	                    setTimeout(function () {
	                    window.location.href = '';
	                    }, 2000); //will call the function after 2 secs.
	                    }
	                    else
	                    {
	                    $('#sign-up-driver').hide();
	                    $('#sign-up').show();
	                    $('#log-in').hide();
	                    $('#msg_error').html("email already...");
	                    $('#msg_success').html("");
	                    $('.fileupload-exists').click();
	                    $('#drive_email').val('');
	                    $('.social_id').val('');
	                    }
	                    hidePageloader();
	                    },
	                    error: function(){
	                    hidePageloader();
	                    alert('somthing wrong..!');
	                    }
	            });
	             }
            }));



            $("#doctor_registration").on('submit', (function(e) {
				e.preventDefault();

				var email = $('#doctor_email').val();
				var doctor_social_id = $('#doctor_social_id').val();
				var recaptcha=$('#doctor_registration .g-recaptcha-response').val();
				if(recaptcha ==''){
				alert('please verify captcha');
				return false
				}else if($('#doctor_valid_state')[0].files.length === 0){
				alert("Please upload Valid State ID");
				return false;
				}else if($('#doctor_montly_bill')[0].files.length === 0){
				alert("Please upload Monthly until bill");
				return false;
				}else if(email == ''){
			          alert("Please Enter valid Email Address");
			          return false;
			    }else if(doctor_social_id == ''){
				          alert("Please Enter Social Media link");
				          return false;
				    }
				else{
		            showPageloader();
		            $.ajax({
		            url: "home/upload_signup",
		                    type: "POST",
		                    data:  new FormData(this),
		                    contentType: false,
		                    dataType: "json",
		                    cache: false,
		                    processData:false,
		                    success: function(data)
		                    {
		                    	console.log('doctor'+data);
		                    if (data.success)
		                    {
		                    $('#sign-up-doctor').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_error').html("");
		                    $('#msg_success').html("Successfully signup...");
		                    $('.fileupload-exists').click();
		                    $('#doctor_email').val('');
		                    $('.social_id').val('');
		                    setTimeout(function () {
		                    window.location.href = '';
		                    }, 2000); //will call the function after 2 secs.
		                    }
		                    else
		                    {
		                    $('#sign-up-doctor').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("");
		                    $('#msg_error').html("email already...");
		                    $('.fileupload-exists').click();
		                    $('#doctor_email').val('');
		                    $('.social_id').val('');
		                    }
		                    hidePageloader();
		                    },
		                    error: function(){
		                    hidePageloader();
		                    alert('somthing wrong..!');
		                    }
		            });
	             }
            }));
            $("#storefront_registration").on('submit', (function(e) {
		            e.preventDefault();
		          
		            var email = $('#store_email').val();
		            var recaptcha=$('#storefront_registration .g-recaptcha-response').val();
		            var store_email=$('#store_email').val();
		            var store_social_id=$('#store_social_id').val();
		           if(recaptcha ==''){
		           	alert('please verify captcha');
		             return false
		           }else if($('#store_stateId')[0].files.length === 0){
				          alert("Please upload Valid State ID");
				          return false;
				    }else if($('#store_monthly_until')[0].files.length === 0){
				          alert("Please upload Monthly until bill");
				          return false;
				    }
				    else if(email == ''){
				          alert("Please Enter valid Email Address");
				          return false;
				    }
				    else if(store_social_id == ''){
				          alert("Please Enter Social Media link");
				          return false;
				    }
		           else{
		           	  showPageloader();


		            $.ajax({
		            url: "home/upload_signup",
		                    type: "POST",
		                    data:  new FormData(this),
		                    contentType: false,
		                    dataType: "json",
		                    cache: false,
		                    processData:false,
		                    success: function(data)
		                    {
		                    	console.log('email'+data);
		                    if (data.success)
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("Successfully signup...");
		                    $('#msg_error').html("");
		                    $('.fileupload-exists').click();
		                    $('#store_email').val('');
		                    $('.social_id').val('');
		                    setTimeout(function () {
		                    window.location.href = '';
		                    }, 2000); //will call the function after 2 secs.
		                    }
		                    else
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("");
		                    $('#msg_error').html("email already...");
		                    $('.fileupload-exists').click();
		                    $('#store_email').val('');
		                    $('.social_id').val('');
		                    }
		                    hidePageloader();
		                    },
		                    error: function(){
		                    hidePageloader();
		                    alert('something wrong..!');
		                    }
		            });
		        }
            }));


            $("#storefront_registration1").on('submit', (function(e) {
		            e.preventDefault();
		          
		            var email = $('#store_email1').val();
		            var recaptcha=$('#storefront_registration1 .g-recaptcha-response').val();
		            var store_email=$('#store_email1').val();
		            var store_social_id=$('#store_social_id1').val();
		           if(recaptcha ==''){
		           	alert('please verify captcha');
		             return false
		           }else if($('#store_stateId1')[0].files.length === 0){
				          alert("Please upload Valid State ID");
				          return false;
				    }else if($('#store_monthly_until1')[0].files.length === 0){
				          alert("Please upload Monthly until bill");
				          return false;
				    }
				    else if(email == ''){
				          alert("Please Enter valid Email Address");
				          return false;
				    }
				    else if(store_social_id == ''){
				          alert("Please Enter Social Media link");
				          return false;
				    }
		           else{
		           	  showPageloader();


		            $.ajax({
		            url: "home/upload_signup",
		                    type: "POST",
		                    data:  new FormData(this),
		                    contentType: false,
		                    dataType: "json",
		                    cache: false,
		                    processData:false,
		                    success: function(data)
		                    {
		                    	console.log('email'+data);
		                    if (data.success)
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("Successfully signup...");
		                    $('#msg_error').html("");
		                    $('.fileupload-exists').click();
		                    $('#store_email').val('');
		                    $('.social_id').val('');
		                    setTimeout(function () {
		                    window.location.href = '';
		                    }, 2000); //will call the function after 2 secs.
		                    }
		                    else
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("");
		                    $('#msg_error').html("email already...");
		                    $('.fileupload-exists').click();
		                    $('#store_email').val('');
		                    $('.social_id').val('');
		                    }
		                    hidePageloader();
		                    },
		                    error: function(){
		                    hidePageloader();
		                    alert('something wrong..!');
		                    }
		            });
		        }
            }));




            $("#salesteam_registration").on('submit', (function(e) {
		            e.preventDefault();
		           
		            var email = $('#salesteam_email').val();
		            var recaptcha=$('#salesteam_registration .g-recaptcha-response').val();
		            var store_email=$('#store_email').val();
		            var sales_social=$('#sales_social').val();
		           if(recaptcha ==''){
		           	alert('please verify captcha');
		             return false
		           }else if($('#sales_resume')[0].files.length === 0){
				          alert("Please upload Resume/Curriculum");
				          return false;
				    }else if($('#sales_reference')[0].files.length === 0){
				          alert("Please upload References page");
				          return false;
				    }else if($('#sales_monthly_bill')[0].files.length === 0){
				          alert("Please upload Monthly bill");
				          return false;
				    }

				    else if(email == ''){
				          alert("Please Enter valid Email Address");
				          return false;
				    }
				    else if(sales_social == ''){
				          alert("Please Enter Social Media link");
				          return false;
				    }else{
				    	 showPageloader();

		            $.ajax({
		            url: "home/upload_signup",
		                    type: "POST",
		                    data:  new FormData(this),
		                    contentType: false,
		                    dataType: "json",
		                    cache: false,
		                    processData:false,
		                    success: function(data)
		                    {
		                    	console.log('sales'+data);
		                    if (data.success)
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("Successfully signup...");
		                    $('#msg_error').html("");
		                    $('.fileupload-exists').click();
		                    $('#salesteam_email').val('');
		                    $('.social_id').val('');
		                    setTimeout(function () {
		                    window.location.href = '';
		                    }, 2000); //will call the function after 2 secs.
		                    }
		                    else
		                    {
		                    $('#sign-up-storefront').hide();
		                    $('#sign-up-salesteam').hide();
		                    $('#sign-up').show();
		                    $('#log-in').hide();
		                    $('#msg_success').html("");
		                    $('#msg_error').html("email already...");
		                    $('.fileupload-exists').click();
		                    $('#salesteam_email').val('');
		                    $('.social_id').val('');
		                    }
		                    hidePageloader();
		                    },
		                    error: function(){
		                    hidePageloader();
		                    alert('something wrong..!');
		                    }
		            });
		        }
            }));
		</script>


		<script>
            //	function validateEmail(emailField){
            //			var email = emailField.value;
            //			$.ajax({
            //				type:'POST',
            //				url:"emailcheckuser.php",
            //				data: {email: email},
            //				dataType: 'JSON',
            //				success:function(data){
            //					if (data == false)
            //					{
            //						alert('Already Email Address : ' + email);
            //						$('.drive_email').val('');
            //						return false;
            //					}
            //					return true;
            //				}
            //			 });
            //	}

            //----------------------------------- Code for Upload  Driver  License --------------------------------- >
            $('#license_upload').on('click', function() {
            var file_data = $('#driver_license').prop('files')[0];
            alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('Please Select Driver License to Upload!');
            return 	false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "0.2");
            $("#wait").css("display", "block");
            $.ajax({
            url: 'upload.php', // point to server-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    //alert(php_script_response); // display response from the PHP script, if any
                    document.getElementById("driver_license").value = '';
                    return false;
                    }
            });
            });
            //			//--------------------------Code End for Upload  Driver  License---------------------------------------------->
            //			//----------------------------------- 			Code for Upload  Driver  Insurance --------------------------------- >
            $('#driver_insurace_upload').on('click', function() {
            var file_data = $('#driver_insurace').prop('files')[0];
            //alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('Please Select Driver License to Upload!');
            return false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "0.2");
            $("#wait").css("display", "block");
            $.ajax({
            url: 'upload_driver_insurance.php', // point to serve				r-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    //alert(php_script_response); // display response from the PHP script, if any
                    document.getElementById("driver_insurace").value = '';
                    return false;
                    }
            });
            });
            //--------------------------Code End for Upload Driver Insurance---------------------------			------------------->

            //----------------------------------- Code for Upload  Vehicle Registration ----------------------------			----- >
            $('#vechile_registration_upload').on('click', function() {
            var file_data = $('#vechile_registration').prop('files')[0];
            //alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('Please Select Vechicle Registration to Upload!');
            return false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "0.2");
            $("#wait").css("display", "block");
            $.ajax({
                  url: 'upload_vechile_registration.php', // point to server-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    //alert(php_script_response); // display response from the PHP script, if any
                    document.getElementById("vechile_registration").value = '';
                    return false;
                    }
            });
            });
            //--------------------------Code End for Upload Vehicle Registration------------------------------------------>


            //----------------------------------- Code for Upload  Vehicle Insurance --------------------------------- >
            $('#vehicle_insurance_upload').on('click', function	() {
            var file_data = $('#vehicle_insurance').prop('files')[0];
            //alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('Please Select Vehicle Insurance to Upload!');
            return false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "0.2");
            $("#wait").css("display", "block");
            $.ajax({
            url: 'upload_vehicle_insurance.php', // point to server-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    //alert(php_script_response); // display response from the PHP script, if any
                    document.getElementById("vehicle_insurance").value = '';
                    return false;
                    }
            });
            });
            //--------------------------Code End for Upload Vehicle Insurance------------------------------------------>

            //----------------------------------- Code for Upload Vehicle Inspection ------------------------------>
            $('#vechicle_inspection_upload').on('click', function() {
            var file_data = $('#vechicle_inspection').prop('fi			les')[0];
            //alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('				Please Select Vechile Inspection to Upload!');
            return false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "				0.2");
            $("#wait").css("display", "block");
            $.ajax({
            url: 'upload_vechicle_inspection.php', // point to s				erver-side PHP script
                    dataType: 'text', // what to expect ba				ck from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData				: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    //alert(php_script_response); // display response from the PHP script, if any
                    document.getElementById("vechicle_inspection").value = '';
                    return false;
                    }
            });
            });
            //--------------------------Code End for Upload Vehicle Inspection------------------------------------------>

            //----------------------------------- Code for Upload Recommendation & State ID ------------------------------ >
            $('#recommendation_state_id_upload').on('click', function() {
            var file_data = $('#recommendation_state_id').prop('files')[0];
            //alert(file_data);
            if (file_data == '' || file_data == undefined){
            alert('Please Select Recommendation and State ID to Upload!');
            return false;
            }
            var file_id = $('#uid').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('file_id', file_id);
            //alert(form_data);
            $(".field").css("opacity", "0.2");
            $("#wait").css("display", "block");
            $.ajax({
            url: 'upload_recommendation_state_id.php', // point to server-side PHP script
                    dataType: 'text', // w				hat to expect back from the PHP script, if any				thing
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                    $("#wait").hide();
                    document.getElementById("recommendation_state_id").value = '';
                    return false;
                    }
            });
            });
		</script>
		<script type="text/javascript">
			function onDriverPopup(){
				$('#login').modal('show');
				$('#log-in').hide(); 
				$('#sign-up').hide()
				$('#sign-up-driver').show();
			}
		</script>
		<script type="text/javascript">
			$( document ).ready(function() {
			   $('#myModal').modal('show');
               });
			function goToSignUpFlash(){
				  $('#myModal').modal('hide');
			    $('#login').modal();
			    $("#btnSigUp-modal")[0].onclick();
		        $("#sign-up-driver, #sign-up-doctor, #sign-up-storefront").hide();
			}
			
				function goToSignUpFlash1(){
				  $('#myModal').modal('hide');
			   
			}
			

		$('.androidIosButton').on('click', function() {
          $('.flashScreen').hide();
           $('.androidIos').show();
		});
		$('.androidIosButtonNew').on('click', function() {
			 $('#myModal').modal('show');
          $('.flashScreen').hide();
           $('.androidIos').show();
		});

			$('#staffLogin').on('click', function() {
				 $('#logindiffernt').modal('hide');
				 $('#staffloginDiffernt').modal('show');
			});
		</script>

		<script type="text/javascript">
			$('.storeFrontsSignUp').click(function(){
 setTimeout(function(){ $('.storeFrontsSignUpclose').trigger('click'); }, 100);

				
			})
		</script>

		<script type="text/javascript">
			$('.OnDemandSignUp').click(function(){
				  setTimeout(function(){ $('.OnDemandSignUpclose').trigger('click'); }, 100);
				// 
			})
		</script>
	</body>
</html>
