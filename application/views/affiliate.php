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
        <link href="<?php echo base_url(); ?>/public/front/css/psdCSS1.css" type="text/css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/public/front/css/CenturyGothicstylesheet/Centurygothi-stylesheet.css" type="text/css" rel="stylesheet">

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
						
							<img src="<?php echo base_url('public/img/affiliate-partner-panelbanner_01.png');?>" />
						
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
										<input type="email" name="login_email" class="form-control" id="loginValidEmail" placeholder="Email" required="">
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


				<section class="container-fluid bgclr">
			    
			    	<div class="col-md-12 col-xs-12">
			        	<div class="d1">
			            	<h2>Partnership Qualifications & Requirements</h2>
			            </div>
			        
			        
			       
			       
			       
			        <div class="row d2">
			        	
			            	<div class="col-md-4 col-sm-6 col-xs-12 cls1">
			                
			                	<span><img src="<?php echo base_url(); ?>/public/images/affiliate-partnerusericon_10.png" alt="icon1" class="img1"></span>
			                    <h3><strong>Support</strong></h3>
			                    <ol>
			                    	<li>1 on 1 product manager</li>
			                        <li>24 hour emergency assistance</li>
			                        <li>Access to internal admin chat</li>
			                    </ol>
			                </div>
			                <div class="col-md-4 col-sm-6 col-xs-12   cls1">
			                
			                	<span><img src="<?php echo base_url(); ?>/public/images/affiliate-partnerusericon_05.png" alt="icon1" class="img1"></span>
			                    <h3><strong>Marketing</strong></h3>
			                    <ol>
			                    	<li>Start-up co-branded designs</li>
			                        <li>Ongoing promotional materials</li>
			                        <li>Recorded audio commercials</li>
			                        <li>Recorded online commercials</li>
			                    </ol>
			                </div>
			                <div class="col-md-4 col-sm-6 col-xs-12  cls1">
			                
			                	<span><img src="<?php echo base_url(); ?>/public/images/affiliate-partnerusericon_07.png" alt="icon1" class="img1"></span>
			                    <h3><strong>Training</strong></h3>
			                    <ol>
			                    	<li>Ongoing training materials</li>
			                        <li>Quarterly affiliate meetings</li>
			                        <li>Department Training Manuals</li>
			                    </ol>
			                </div>
			            	
			            
			        </div>
			        
			        
			        <div class="row d3">
			        
			        	<div class="col-md-6 col-xs-12 cls1-passage1">
			            
			         
			                	<h1 style="color:#e03d80">Pre-Qualifications</h1>
			                   
			                <h3>Have ‘’Good’’ credit</h3>
			             <h3> Service in any branch of the U.S.<br/> 
									military is +</h3>
			                   
			              <h3>Not have filed for bankruptcy within 
									the last (7) years</h3>
							<h3>Understand the need to be involved 
									in the day-to-day operation of a small 
									business</h3>
								<h3>Must have at least (3) years’ experience 
									in running an established retail, business 
									operations or (7) years’ of management 
									experience</h3>
								<h3>Have no prior record of felony 
									convictions or other criminal record 
									that could impact your ability to 
									operate a license</h3>
								
			            
			            
			            <!--<table>
			            	<tr>
			                	<th style="color:#e03d80">Pre-Qualifications</th>
			                   
			                </tr>
			                <tr>
			                	<td>Have ‘’Good’’ credit</td>
			                   
			                </tr>
			                <tr>
			                	<td>Service in any branch of the U.S.<br/> 
									military is +</td>
			                   
			                </tr>
			                <tr>
			                	<td>Not have filed for bankruptcy within 
									the last (7) years
								</td>
			                </tr>
			                
			                <tr>
			                	<td>Understand the need to be involved 
									in the day-to-day operation of a small 
									business
								</td>
			                </tr>
			                <tr>
			                	<td>Must have at least (3) years’ experience 
									in running an established retail, business 
									operations or (7) years’ of management 
									experience
								</td>
			                </tr>
			                
			                <tr>
			                	<td>Have no prior record of felony 
									convictions or other criminal record 
									that could impact your ability to 
									operate a license
								</td>
			                </tr>
			                
			            </table>-->
			            </div>
			            <div class="col-md-6 col-xs-12 cls1-passage1">
			            
			           
			                	
			                    <h1 style="color:#26b5b0">Requirements</h1>
			               <h3>Appoint (1) assignee for all meetings, 
									conference calls, trainings and daily 
									campaign management tasks</h3>
			                        
			                        
			                       <h3> Attend company conference calls, 
									pre-scheduled meetings/gatherings 
									at least 1 per month to ensure strong 
									communication and assistance where 
									needed</h3>
							<h3>Affiliate must visit other local providers 
									registered with our platform and drop 
									off promotional and marketing materials 
									and provide minor assistance where 
									needed</h3> 
			                        
			                        
			                        <h3>Meet with local providers (4) per 
									month for quality control purposes and 
									conduct a quick 15 minute meeting 
									to address any concerns from an 
									operating standpoin</h3>
			                        
			                        
			               <h3>Organize a mixer (social gathering) 
									with local providers and interested 
									affiliate partners at least once per 
									quarter to maintain a strong and 
									informative community</h3>
			            
			            <!--<table>
			            	<tr>
			                	
			                    <th style="color:#26b5b0">Requirements</th>
			                </tr>
			                <tr>
			                	
			                    <td>Appoint (1) assignee for all meetings, 
									conference calls, trainings and daily 
									campaign management tasks</td>
			                </tr>
			                <tr>
			                	<td>Attend company conference calls, 
									pre-scheduled meetings/gatherings 
									at least 1 per month to ensure strong 
									communication and assistance where 
									needed
								</td>
			                </tr>
			                <tr>
			                	<td>Affiliate must visit other local providers 
									registered with our platform and drop 
									off promotional and marketing materials 
									and provide minor assistance where 
									needed </td>
			                </tr>
			                <tr>
			                	<td>Meet with local providers (4) per 
									month for quality control purposes and 
									conduct a quick 15 minute meeting 
									to address any concerns from an 
									operating standpoin</td>
			                </tr>
			                <tr>
			                	<td>Organize a mixer (social gathering) 
									with local providers and interested 
									affiliate partners at least once per 
									quarter to maintain a strong and 
									informative community</td>
			                </tr>
			                
			            </table>-->
			            </div>
			        
			        	
			        	
			        </div>
			        
			        <div class="row cls2">
			        	<p><strong>Applicants must complete Enrollment Application & comply with Licensing Requirements</strong></p>
			        </div>
			        
			        <div class="row d3 cls3">
			        	
			            	<p>Applicant must have experience in running an established dispensary/storefront at 
			multiple locations.</p>

			<p>Applicant must show willingness to learn and adapt to our operating procedures as 
			well as pass initial and post interviews.</p>

			<p>Applicant must provide list of previous work/ business history especially if it pertains to 
			the marijuana industry, or mobile industry.</p>

			<p>Applicant must provide full disclosure on business sales and current expenses, along 
			with information pertaining to any litigations/arbitrations including any current/active 
			business partners.</p>

			                
			                
			            	
			            
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