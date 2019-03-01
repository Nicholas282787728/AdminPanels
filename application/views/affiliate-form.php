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
        <script>/*<![CDATA[*/
               window.zEmbed || function (e, t) {
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
    
    	<div class="col-md-12">
        	<div class="d1">
            	<h2><strong>Med Connex License Application</strong></h2>
            </div>
        
        
       		<div class="row d5">
        	
            	<div class="d4">
                	<h3>Contact Information</h3>
                </div>
                
                <div class="cls5">
                	<form>
                			<div class="col-md-4 col-sm-12 col-xs-12 cls4">
                		
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Legal First Name :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder=" Legal First Name :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Mobile Number :</label>
                                <input type="phone" class="form-control" id="exampleInputEmail1" placeholder="Mobile Number :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Street Number :</label>
                                <input type="street" class="form-control" id="exampleInputEmail1" placeholder="Street Number :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> State / Number :</label>
                                <select class="form-control">
                                    <option value="Select State">Select State</option>
                                    <option value="AP">AP</option>
                                    <option value="TP">TP</option>
                                    <option value="UP">UP</option>
                                </select>
                              </div>
                        
                        
                </div>
                
                                <div class="col-md-4 col-sm-12 col-xs-12 cls4">
                                    
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                                <label for="exampleInputEmail1"><sup>*</sup> Legal Middle Name :</label>
                                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder=" Legal Middle Name :">
                                              </div>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                                <label for="exampleInputEmail1"><sup>*</sup> Alternate Number :</label>
                                                <input type="phone" class="form-control" id="exampleInputEmail1" placeholder="Alternate Number :">
                                              </div>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                                <label for="exampleInputEmail1"><sup>*</sup> Street Name :</label>
                                                <input type="street" class="form-control" id="exampleInputEmail1" placeholder="Street Name :">
                                              </div>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                                <label for="exampleInputEmail1"><sup>*</sup> Country :</label>
                                                <select class="form-control">
                                                    <option>USA</option>
                                                    <option>INDIA</option>
                                                    <option>AUSTRALIA</option>
                                                    <option>PAKISTAN</option>
                                                </select>
                                              </div>
                                       
                                </div>
                
                			<div class="col-md-4 col-sm-12 col-xs-12  cls4">
                
                			  <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Legal last Name :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder=" Legal last Name :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Email :</label>
                                <input type="phone" class="form-control" id="exampleInputEmail1" placeholder="Email :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> City :</label>
                                <input type="street" class="form-control" id="exampleInputEmail1" placeholder="City :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Zip / PostalCode :</label>
                                <input type="street" class="form-control" id="exampleInputEmail1" placeholder="Zip / PostalCode :">
                              </div>
                        
                </div>
                </form>
            	
            	</div>
        	</div>
            
            <div class="row D7">
            	<div class="d6">
                	<h3>Tell Us About Yourself</h3>
                </div>
                <form>
                <div class="cls6">
                
                
                  	  <div class="col-md-6 col-sm-6 col-xs-12">
                    	
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Resume upload (optional):</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" placeholder=" Legal First Name :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> US Residency State :</label>
                                   <select class="form-control">
                                    <option>USA</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Are you a U.S. military veteran?  :</label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              	<label class="radio-inline">
  								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Military Status  :</label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> How many years of retail experience do you have?  </label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> How many years of management experience do you have?  </label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Do you have firing or hiring experience?  </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              	<label class="radio-inline">
  								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Describe how you will operate your business :  </label>
                                <textarea class="form-control" rows="3" placeholder="Describe how you will operate your business :"></textarea>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Describe your experience and qualification  :   </label>
                                <textarea class="form-control" rows="3" placeholder="Describe your experience and qualification  : "></textarea>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> What is the maximum you are able to invest in this business
opportunity? (i.e. 401K)  :   </label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> How much of the investment is liquid? (cash or checking or saving
 account) :      </label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Are you able to dedicate full-time managing and working at the
store?  :   </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              	<label class="radio-inline">
  								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Area of interest  : </label>
                                   <select class="form-control">
                                    <option>Select</option>
                                    <option>INDIA</option>
                                    <option>AUSTRALIA</option>
                                    <option>PAKISTAN</option>
                                    </select>
                              </div>
                    </div>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                    		  <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Date of Birth (mm/dd/yyyy) </label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder="mm/dd/yyyy">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Have you ever  been contracted by Med ConnixApp?:   </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              	<label class="radio-inline">
  								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Address of store or store number(s)  :    </label>
                                <textarea class="form-control" rows="3" placeholder="Address of store or store number(s)  :  "></textarea>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Employment details (location and title)  :  </label>
                                <textarea class="form-control" rows="3" placeholder="Employment details (location and title)  : "></textarea>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              <label for="exampleInputEmail1"><sup>*</sup> Will your spouse be on  Med ConnixApp?   </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                              	<label class="radio-inline">
  								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                </label>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"> Spouse First Name  :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder="Spouse First Name  :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"> SpouseMiddle Name  :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder="SpouseMiddle Name  :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"> Spouse Last Name  :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder="Spouse Last Name  :">
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Spouse’s Date of Biirth (mm/dd/yyyy)  :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder="mm/dd/yyyy">
                              </div>
                    </div>
                </div>
                
                <div class="cls7">
              		<h3>Acknowledgement</h3>
                </div>
                <div class="cls8">
                <p>I/WE recognize that Med Connex., is not in any way obligated to franchise a Med Connex store to ME/US because of MY/OUR execution of this document.  
I/WE acknowledge that any false statement on this application shall be considered sufficient cause to deny any further consideration or cause revocation 
of any signed agreement with Med Connex.  I/WE understand that any inquiry regarding MY/OUR character, general reputation, personal characteristics, 
financial background and general fitness for being a Med Connex Franchisee may be made as a result of this application. In addition, by signing below 
I/WE release any and all former and/or present employers, and any other personal or business references, from any liability whatsoever in connection with 
Med Connex;s attempt to investigate MY/OUR background and determine MY/OUR fitness to become a Med Connex Franchisee.  I/WE specifically authorize 
Med Connex to obtain credit reports from one or more credit bureaus and background check on ME/US and MY/OUR business(es).  A copy of this authorization 
may be used in place of and shall be valid as the original.  I/WE understand that this application is considered active for 180 days from the date below. By
 submitting this application I/WE agree that this information is correct and I/WE give Med Connex., permission to obtain a Credit Report and Background 
Report for the individuals listed on this application. I understand and acknowledge that if I am married but do not provide complete information for myself 
and my spouse, 7-Eleven, Inc. cannot process this application.</p>

<label>
              <input type="checkbox"> *I/WE Agree
            </label>
            
            				   <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
                                <label for="exampleInputEmail1"><sup>*</sup> Applicant’s Signature  :</label>
                                <input type="fname" class="form-control" id="exampleInputEmail1" placeholder=" Applicant’s Signature  :">
                              </div>
                              
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group d6cls6">
   
      <button type="submit" class="btn btn-default cls9">Submit</button> <button type="submit" class="btn btn-default cls10">Reset</button>
   
  </div>

</div>

</form>

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