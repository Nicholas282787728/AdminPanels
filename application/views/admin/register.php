<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Register for a new UserFrosting account.">
        <meta name="author" content="Damilare Binutu">
        <meta name="csrf_token" content="5f02a2818ee51fcac316e7f8cbc70fae79cdaa3d6ada801defd78fc8abec856308ba4f29b193eadd0b4e402282d007a2b8be7a5acdd9bec834704e99b2588c6c"> 
        
        <title>MedConnex | Register</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/public/main/css/favicon.ico" />
        
        <!-- Page stylesheets -->
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/font-awesome-4.3.0.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/font-starcraft.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrap-3.3.2.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrap-modal-bs3patch.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrap-modal.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/lib/metisMenu.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrap-custom.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrap-switch.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/tablesorter/theme.bootstrap.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/tablesorter/jquery.tablesorter.pager.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/select2/select2.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/select2/select2-bootstrap.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/bootstrapradio.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/custom.css" type="text/css" >
                  <link rel="stylesheet" href="<?php echo base_url();?>public/main/css/jumbotron-narrow.css" type="text/css" >
                
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
			<h1>Let's get started!</h1>
<p class="lead">Registration is fast and simple.</p>
<div id="userfrosting-alerts">
    </div>
<form name="register" method="post" action="" class="form-horizontal">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label  col-sm-4">Username</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                        <input type="text" class="form-control" name="user_name" autocomplete="off" value="" required placeholder="User name">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Display Name</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-edit"></i></span>
                        <input type="text" class="form-control" name="display_name" autocomplete="off" required value="" placeholder="Display name">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Email</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" required placeholder="Email address" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Registering as : </label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                        <select class="form-control" name="provider_type">
                            <option value="1">Industry Doctor</option>
                            <option value="2">On-Demand Driver</option>
                            <option value="3">StoreFront</option>
                            <option value="4">Sales</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>		  
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Password</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                        <input type="password" class="form-control" name="password" required autocomplete="off" value="" placeholder="8-50 characters">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Confirm password</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                        <input type="password" class="form-control" name="passwordc" required autocomplete="off" value="" placeholder="Re-enter your password">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Confirm captcha code</label>
                <div class="col-sm-8">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-fw fa-eye"></i></span>
                        <input type="text" class="form-control" id="captcha-input" name="captcha" required autocomplete="off" value="" placeholder="Organics only!">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAeCAIAAABBgHAAAAAE00lEQVRogb1babLkIAiGOZk5eY7G
/HBDNpfYj7Jqug18Ishi+g3QEkH5B2CNfwZnwaSUluB3dNAK39rClFJKWhsK1Pce5Hn2FAA4OLAt
RXszFLrEHJO5r6kb1K43FjyQWUaAG0uAQAC9UdMBAMUke+5h4J5gmbfs7YnEvoFTB7blvgUq/PGA
lNJoKVv9/V3pDCY3mVI60LhJ5bRk7wrEV8kpGLQmAXgZYAgCGCExs4/mrzPQF1Kjs5WFQfGtzJyO
rujmwd8+R7+kiTJHh96zVSedmZCqD5/nAYD3fSEgRCBC7I7/Qg3neZ7JuoHwBa6vImuwSESI6IP7
q/o6IfZsQMQ/D6fp9OwfnMO4Z7PouIBd7LkE6ZLhBda5bbt4heAVcbE6BsA0GKiLf7Xa2Fj7XPLR
tIH9ohQDmaXBZYdNGMdLRU+kUHMpALzvy/NqTgKbmcPNADbaUWI8VyxaImMiz2xsXXSUOUmDW+SW
m9G7PSjLx+nBEQy3L86wFnlcIn68kwmW+ouq2+pkbQwXFfCf1YdRQCw1OCY5566VdCg1bw8hC2ri
UBrcW45FcAEe45vGr47Oswj7UXM04E6OwdWoEhHgvkMIpdiNjcQW+B7FZPumxyBlmURjWmof9G7b
4iaXWUtqGeCuvnecLh5MHhzW57Ic+yy326RaiBMNe+eh34QPbkGY23/aq99eOuOl958lxm77jQ6u
Vw6l9MQMyys0P2H5DACAAFgdyZsPQuyc+QH3eosGnlWttAxgFhfE1gyaVOFnFURIFT3VNO+qFhHb
ubvRBLJDxFs9ZPogotzssA9m58HWDc8LLy9wK2wc1itlbwiRiSFGY57lJyMKtWbAzh0NFo9InEpE
rDJ2cLPyhkBAhNV0WO1SRvUfaWN5JmhqD6Fm6dm1DX0me6v+2sVqeRwS+CU/LYmOKF6dXK2n52R2
7UBh68/VDiaFjc4eeeYSImLmwnufnbvc1awYMNnvBmeCKrMEwWHkPQCw7jAH2XLpIrRDvCGStans
ejUht0S62Vz0CDcb2tw19EHU0iCwlDijJf+hcENLcSiYaj/DQFBIrTiJ4wQUdze8ISKigZmaldac
QmIQmwzvK9ZvbO6vZQHOnI21i1MczdNmuMmmUmL9laUDze9RN0VL12Ei9Q8aApE+Iw7UdqM1FSi/
eZ2/a/17+qBXlFGf5xEd6ZD9htgU/YaYBAAiyD2nGpSzjvnUJCLwE9HzPAhk3NKZrCfozXy+o9rE
YUWx26HI8+/7Qs1exi+Fk5BWSYL9dAdixuSvGYqGozKWSpXn3VQdaba7I5h0xZdJZv5NaWkjZcc8
UkoG5+fB/Xe2xFwqb/NvyXbD/dJIVGvhxgsFk3hZitrlzr9dGLSIB2L06B7RdideIM1WYB9/FSek
f3WpVRLNdC4n3GTv+8pXxooOCru+ShDZnT2xl2pFUg+o8T/MQ3/axXNToObGJdFcSOL3kd8/tZbi
ScnjtHoROXOL5u1+/jCtMS3fqMTTW2o+GwPmgxSveEDDX5b0M8ZPR1ie7lHH0s3IPphVeDbQPm0s
r/OxB1kSX94Rt6S06m7V95RkuHO19PbsDf+maJv0dSmn6zgA+qaHhbjmcoBftWoerDFvB/1mtlkM
PvG/SUyebBlbfkWlPzzBmf4DTZHUaVcofgYAAAAASUVORK5CYII=
" id="captcha" data-target="#captcha-input">
        </div>
    </div>
            <div class="row">
        <div class="col-sm-12">
             By registering an account with MedConnex, you accept the <a href="#" data-toggle="modal" data-target="#tos">terms and conditions</a>.
        </div>
    </div>
        <br>
    <div class="row">
        <div class="col-sm-12">
            <div>  
                <!--button type="submit" name="btn_register" class="btn btn-success">Register</button-->
				<input type="submit" name="btn_register" class="btn btn-success" value="Register">
            </div>
        </div>
    </div>
    <div class="collapse">
      <label>Spiderbro: Don't change me bro, I'm tryin'a catch some flies!</label>
      <input name="spiderbro" id="spiderbro" value="http://"/>
    </div>          
</form>
<div class="jumbotron-links">
        <div class='row'>
        <div class='col-md-12'>
          <a href='http://imvisile.com/med/public/account/register' class='btn btn-link' role='button' value='Register'>Not a member yet?  Register here.</a>
        </div>
    </div>
        <div class='row'>
        <div class='col-md-12'>
          <a href='http://imvisile.com/med/public/account/forgot-password' class='btn btn-link' role='button' value='Forgot Password'>Forgot your password?</a>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-12'>
          <a href='http://imvisile.com/med/public/account/resend-activation' class='btn btn-link' role='button' value='Activate'>Resend activation email</a>
        </div>
    </div>
</div>
	
		  </div>
		  <div class="col-md-2"></div>	
		</div> <!-- /container -->
   
				    <div id="tos" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Terms and Conditions for MedConnex</h4>
        </div>
        <div class="modal-body">
            <!-- Generated by http://www.bennadel.com/coldfusion/privacy-policy-generator.htm -->
<h2>
	Web Site Terms and Conditions of Use
</h2>

<h3>
	1. Terms
</h3>

<p>
	By accessing this web site, you are agreeing to be bound by these 
	web site Terms and Conditions of Use, all applicable laws and regulations, 
	and agree that you are responsible for compliance with any applicable local 
	laws. If you do not agree with any of these terms, you are prohibited from 
	using or accessing this site. The materials contained in this web site are 
	protected by applicable copyright and trade mark law.
</p>

<h3>
	2. Use License
</h3>

<ol type="a">
	<li>
		Permission is granted to temporarily download one copy of the materials 
		(information or software) on MedConnex's web site for personal, 
		non-commercial transitory viewing only. This is the grant of a license, 
		not a transfer of title, and under this license you may not:
		
		<ol type="i">
			<li>modify or copy the materials;</li>
			<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
			<li>attempt to decompile or reverse engineer any software contained on MedConnex's web site;</li>
			<li>remove any copyright or other proprietary notations from the materials; or</li>
			<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
		</ol>
	</li>
	<li>
		This license shall automatically terminate if you violate any of these restrictions and may be terminated by MedConnex at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
	</li>
</ol>

<h3>
	3. Disclaimer
</h3>

<ol type="a">
	<li>
		The materials on MedConnex's web site are provided "as is". MedConnex makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, MedConnex does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
	</li>
</ol>

<h3>
	4. Limitations
</h3>

<p>
	In no event shall MedConnex or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on MedConnex's Internet site, even if MedConnex or a MedConnex authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
</p>
			
<h3>
	5. Revisions and Errata
</h3>

<p>
	The materials appearing on MedConnex's web site could include technical, typographical, or photographic errors. MedConnex does not warrant that any of the materials on its web site are accurate, complete, or current. MedConnex may make changes to the materials contained on its web site at any time without notice. MedConnex does not, however, make any commitment to update the materials.
</p>

<h3>
	6. Links
</h3>

<p>
	MedConnex has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by MedConnex of the site. Use of any such linked web site is at the user's own risk.
</p>

<h3>
	7. Site Terms of Use Modifications
</h3>

<p>
	MedConnex may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
</p>

<h3>
	8. Governing Law
</h3>

<p>
	Any claim relating to MedConnex's web site shall be governed by the laws of The State of Indiana without regard to its conflict of law provisions.
</p>

<p>
	General Terms and Conditions applicable to Use of a Web Site.
</p>



<h2>
	Privacy Policy
</h2>

<p>
	Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.
</p>

<ul>
	<li>
		Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.
	</li>
	<li>
		We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.		
	</li>
	<li>
		We will only retain personal information as long as necessary for the fulfillment of those purposes. 
	</li>
	<li>
		We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned. 
	</li>
	<li>
		Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date. 
	</li>
	<li>
		We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.
	</li>
	<li>
		We will make readily available to customers information about our policies and practices relating to the management of personal information. 
	</li>
</ul>

<p>
	We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained. 
</p>		
	
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary">Got it!</button>
        </div>
    </div>
    
		<footer>
			<div class="container">
			  <div class="row">
				<div class="text-center" style="position: relative;">
				  <div class="text-center copyRights">
					  &copy;2017 <a href="http://imvisile.com/med/public">MedConnex</a>. All rights reserved.
				  </div>     
				</div>
			  </div>
			</div>
		</footer>
    
		<script src="<?php echo base_url();?>public/main/js/config.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/jquery-1.11.2.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/bootstrap-3.3.2.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/bootstrap-modal.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/bootstrap-modalmanager.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/sb-admin-2.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/lib/metisMenu.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/jqueryValidation/jquery.validate.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/jqueryValidation/additional-methods.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/jqueryValidation/jqueryvalidation-methods-fortress.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/moment.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/tablesorter/jquery.tablesorter.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/tablesorter/tables.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/tablesorter/jquery.tablesorter.pager.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/tablesorter/jquery.tablesorter.widgets.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/tablesorter/widgets/widget-sort2Hash.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/select2/select2.min.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/bootstrapradio.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/bootstrap-switch.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/handlebars-v1.2.0.js" ></script>
        <script src="<?php echo base_url();?>public/main/js/userfrosting.js" ></script>
						 
    <script>
        $(document).ready(function() {           
          /*  // Process form 
            ufFormSubmit(
                $("form[name='register']"),
                {
    "rules": {
        "user_name": {
            "rangelength": [
                1,
                50
            ],
            "noLeadingWhitespace": true,
            "noTrailingWhitespace": true,
            "required": true
        },
        "display_name": {
            "rangelength": [
                1,
                50
            ],
            "required": true
        },
        "email": {
            "required": true,
            "rangelength": [
                1,
                150
            ],
            "email": true
        },
        "provider_type": {
            "required": true
        },
        "password": {
            "required": true,
            "rangelength": [
                8,
                50
            ]
        },
        "passwordc": {
            "required": true,
            "matchFormField": "password",
            "rangelength": [
                8,
                50
            ]
        },
        "captcha": []
    },
    "messages": {
        "user_name": {
            "rangelength": "Your username must be between 1 and 50 characters in length.",
            "noLeadingWhitespace": "Username cannot begin with whitespace",
            "noTrailingWhitespace": "Username cannot end with whitespace",
            "required": "Please enter your user name."
        },
        "display_name": {
            "rangelength": "Your display name must be between 1 and 50 characters in length.",
            "required": "Please enter your display name."
        },
        "email": {
            "required": "Please enter your email address.",
            "rangelength": "Email must be between 1 and 150 characters in length.",
            "email": "Invalid email address"
        },
        "provider_type": {
            "required": "Please specify how you intend to use MedConnex."
        },
        "password": {
            "required": "Please enter your password.",
            "rangelength": "Your password must be between 8 and 50 characters in length."
        },
        "passwordc": {
            "required": "Please enter your password.",
            "matchFormField": "Your password and confirmation password must match",
            "rangelength": "Your password must be between 8 and 50 characters in length."
        }
    }
},
                $("#userfrosting-alerts"),
                function(data, statusText, jqXHR) {
                    // Forward to login page on success
                    window.location.replace(site['uri']['public'] + "/account/login");
                },
                function() {
                    // Reload captcha
                    $("#captcha").captcha();
                }
            );
        });    */
        
        // This plugin reloads the captcha in the specified field
        (function( $ ) {
            $.fn.captcha = function() {
                var field = $(this);
                console.log("Reloading captcha");
                
                var img_src = site['uri']['public'] + "/account/captcha?" + new Date().getTime();
                
                return $.ajax({  
                  type: "GET",  
                  url: img_src,  
                  dataType: "text"
                }).then(function(data, statusText, jqXHR) {  // Pass the deferral back
                    field.attr('src', data);
                    var target = field.data('target');
                    $(target).val("");
                    return data;
                });
            };
        }( jQuery ));        
        
    </script>
    
	 </div>
  </body>
</html>

