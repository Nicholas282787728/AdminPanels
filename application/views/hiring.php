<?php

//require 'vendor/autoload.php'; //2017-04-06 has been commented by farshad
use Zendesk\API\HttpClient as ZendeskAPI;
$subdomain = "medonnex";
$username = "sureshvermaaa@gmail.com"; // replace this with your registered email
$token = "mcov5xSAoZAfqmAJqBAQlsfDe2ggQF53vsNSq7VQ";
?>
<!DOCTYPE html>
<html lang="en" class=" js csstransforms csstransforms3d csstransitions">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Med Connex</title>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>/public/front/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>/public/front/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/public/front/css/owl.carousel.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/public/front/css/owl.theme.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/public/front/css/owl.transitions.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/public/front/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/public/front/css/sidebar.css" rel="stylesheet" />
		<style>

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
		</style>
        <script>
            var basehostname = window.location.hostname; //Domain name.
        </script>
		<script type="text/javascript" src="<?php echo base_url(); ?>/public/front/scripts/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/front/validation/jquery.validate.css" />

        <script type="text/javascript" src="<?php echo base_url(); ?>/public/front/validation/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/public/front/validation/jquery.validation.functions.js"></script>
        <script type="text/javascript" src="common/validsubmit.js"></script>
        <script type="text/javascript" src="common/login.js"></script>
        <script>/*<![CDATA[*/window.zEmbed || function (e, t) {
                var n, o, d, i, s, a = [], r = document.createElement("iframe");
                window.zEmbed = function () {
                    a.push(arguments)
                }, window.zE = window.zE || window.zEmbed, r.src = "javascript:false", r.title = "", r.role = "presentation", (r.frameElement || r).style.cssText = "display: none", d = document.getElementsByTagName("script"), d = d[d.length - 1], d.parentNode.insertBefore(r, d), i = r.contentWindow, s = i.document;
                try {
                    o = s
                } catch (e) {
                    n = document.domain, r.src = 'javascript:var d=document.open();d.domain="' + n + '";void(0);', o = s
                }
                o.open()._l = function () {
                    var o = this.createElement("script");
                    n && (this.domain = n), o.id = "js-iframe-async", o.src = e, this.t = +new Date, this.zendeskHost = t, this.zEQueue = a, this.body.appendChild(o)
                }, o.write('<body onload="document._l();">'), o.close()
            }("https://assets.zendesk.com/embeddable_framework/main.js", "medonnex.zendesk.com");
            /*]]>*/</script>
    </head>
    <body data-spy="scroll" data-target=".main-nav">
		<div id="loaderbg" style="position: fixed; top: 0px; left: 0px; background: rgba(0, 0, 0, 0.6) none repeat scroll 0% 0%; z-index:1999; width: 100%; height: 100%; display: none;">
			<div id="loader"></div>
		</div>

        <div id="wrapper" class="toggled">
			
			<?php $this->load->view('side_menu'); ?> 
			
		
			   <section class="home" id="home" data-stellar-background-ratio="0.4">
                <div id="slider12">

					<div class="overlay"></div>
                   <figure>
						<?php
						$result = $this->db->query("select * from cp_banner_slider where status ='1'");
						$data = $result->result();
						foreach ($data as $row) {
							?>
							<img src="<?php echo base_url('public/images/coverImages/'.$row->img_url);?>" />
						<?php } ?>
                    </figure>
                </div>

				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="st-home-unit">
								<a class="main-logo" href="<?=base_url()?>"><img src="<?php echo base_url(); ?>/public/images/medco-logo.png" alt="" class="img-responsive">
								</a>

							</div>
						</div>
					</div>
				</div>
				<!--Tool Kit Email-->
				<div class="modal fade" id="toolKitRequest" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content mainbox" id="">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Email Request</h4>
							</div>
							<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;"><img src='<?php echo $base_url; ?>images/ajax-loader.gif' width="64" height="64" /> <br>
								Please wait...</div>

							<div class="modal-body field">
								<div class="col-md-12">
									<form action="" method="post" class="LoginForm" enctype="multipart/form-data">
										<h4>Are you interested in receiving more information about Med Connex?</h4>
										<div class="form-group">
											<input type="email" class="form-control" id="loginValidEmail" placeholder="Email">
										</div>
										<input type="submit" name="signup" id="FormSubmit" value="Send" class="btn btn-main btn-lg btn-success btn-info " data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">
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
							<h4 class="modal-title" align='center'>LOG IN</h4>
						</div>
						<div id="wait_login" style="display:none;position:fixed;height:89px;padding-left:328px; margin: 0 auto; zoom: 1; z-index: 999;"><img src='<?php echo $base_url; ?>images/ajax-loader.gif' width="64" height="64" /> <br>
							Please wait...</div>
						<span id="error-message-checklogin" style="font-size: 12px; color: #D00; padding-left:262px; font-style: italic;"></span>
						<div class="modal-body field" style="height: 350px;overflow-y: auto;">
							<div class="col-md-12">
								<form id="LoginForm" action="<?php echo base_url(); ?>" method="post" class="LoginForm">
									<div class="form-group">
										<input type="email" name="login_email" class="form-control" id="login_email" placeholder="Email" required="">
									</div>
									<div class="form-group">
										<input type="password" name="login_password" class="form-control" id="loginValidPassword" placeholder="Password" required="">
									</div>
									<div class="form-group">
										<a href="forget.php"> Forgot password?</a>
									</div>
									<input type="submit" name="login_btn" id="login_btn" style="width: 100% !important;border-radius: 0 !important;" value="Log in"  onMouseOver="this.style.color = '#000', this.style.background - color = '#fff;'" class="btn btn-main btn-lg btn-success btn-info " data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Searching...">
								</form>
								<div class="form-group">
									<div class="col-md-12 control">
										<div style="padding-top:15px; font-size:85%;text-align: center;display:none;">
											Don't have an account?
											<a href="#" id="btnlogindiffrent" >
												<!--<a href="#" id="btnlogindiffrent" onclick="$('#logindiffernt').hide();$('#log-in').hide(); $('#sign-up').show()">-->
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

			</section>


			<section class="contact" id="">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title st-center">
								<!-- <h3>Careers</h3> -->
								<p class="trn">Careers</p>
							</div>
						</div>
					</div>
					<div class="block">
						<?php if ($this->session->flashdata('errormessage')) { ?>
								<div role="alert" class="alert alert-danger" style="width: 50%;margin-left: 25%;">
									<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
									<?= $this->session->flashdata('errormessage') ?>
								</div>
							<?php } ?>
							<?php if ($this->session->flashdata('successmessage')) { ?>
								<div role="alert" class="alert alert-success"style="width: 50%;margin-left: 25%;">
									<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
									<?= $this->session->flashdata('successmessage') ?>
								</div>
							<?php } ?>
				<?php 
				if($config_on_off == 1)
				{
				?>
					<form  method="post" action="<?= base_url() ?>home/careers" enctype="multipart/form-data">
                        <div class="row">
						  <div class="col-md-6">
								<div class="form-group">
									<label for="email">First Name:</label>
									<input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" required>
								</div>
                                <div class="form-group">
									<label for="email">Last Name:</label>
									<input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" required>
								</div>
								<div class="form-group">
									<label for="email">Identification Document or  Driver Licence</label>
									<input type="file" class="form-control" name="img"  required>
								</div>
						  </div>
                            <div class="col-md-6">
								<div class="form-group">
									<label for="email">Mobile:</label>
									<input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>"  required>
								</div>
								<div class="form-group">
									<label for="email">E-mail:</label>
									<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
								</div>								
								<div class="form-group">
									<label for="email">Social Links: Facebook or Instagram</label>
									<input type="url" class="form-control" id="sociallinks" name="sociallinks" value="<?php echo set_value('sociallinks'); ?>" required>
								</div>
						  </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
									<h4 class="careerH4">Emergency Contact 1</h4>
									<label for="email">Name</label>
									<input type="text" class="form-control" name="emergencyname1"  required>
								</div>
								<div class="form-group">
									<label for="email">Phone</label>
									<input type="number" class="form-control" name="emergencyphone1"  required>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="emergencyemail1"  required>
								</div>
								<div class="form-group">
									<label for="text">Relationship</label>
									<input type="text" class="form-control" name="emergencyrelation1"  required>
								</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
									<h4 class="careerH4">Emergency Contact 2</h4>
									<label for="text">Name</label>
									<input type="text" class="form-control" name="emergencyname2"  required>
								</div>
								<div class="form-group">
									<label for="text">Phone</label>
									<input type="number" class="form-control" name="emergencyphone2"  required>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" class="form-control" name="emergencyemail2"  required>
								</div>
								<div class="form-group">
									<label for="email">Relationship</label>
									<input type="text" class="form-control" name="emergencyrelation2"  required>
								</div>
                            </div>
							<div class="col-md-12" align='center'>
							     <button class="btn btn-main btn-lg" type="submit" id="hiring_form_btn" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt; Sending..."> Submit</button>
							</div>
                        </div>
                        </form>
				<?php 
				}
				else 
				{
					echo "<h4 align='center' style='color:red;'>Not Attend</h4>";
				}
				?>
					</div>
				</div>
			</section>

			<!--Footer-->
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					© Copyright
					<script>
						document.write(new Date().getFullYear())
					</script> www.medconnex.net
				</div>
			</div>
		</div>
	</footer>

</div>
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

<script>
	function showPageloader() {
		document.getElementById("loaderbg").style.display = "";
	}
	function hidePageloader() {
		document.getElementById("loaderbg").style.display = "none";
	}


	// $("#menu-toggle").click(function (e) {
	// 	e.preventDefault();
	// 	$("#wrapper").toggleClass("toggled");
	// 	if ($(".menuChange").hasClass("fa-bars")) {
	// 		$(".menuChange").removeClass("fa-bars");
	// 		$(".menuChange").addClass("fa-times");
	// 	} else {
	// 		$(".menuChange").removeClass("fa-times");
	// 		$(".menuChange").addClass("fa-bars");
	// 	}
	// });
	
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
</script>
	</body>
</html>