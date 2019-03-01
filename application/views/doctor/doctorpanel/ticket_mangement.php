<?php include_once 'includes/header1.php'; ?>

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
                                <li ><a data-toggle="pill" href="#menu1"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;Open a New Ticket</a>
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
  
  
  
    <div id="home" class="tab-pane fade in active" >
      
<div class="col-md-9">
<h3 class="pull-left">
                              Welcome to the Support Center
                           </h3>
						   
						   
						   <p class="pull-left par-w">
                                    In order to streamline support requests and better serve you,we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket.
                                </p>
						   
						   
</div>
<div class="col-md-1"> </div>
<div class="col-md-2">
<button class="btn btn-default tic-btn pull-right">Open a New Ticket</button>

<button class="btn btn-default status-btn pull-right">Check Ticket Status</button>
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
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="name" class="form-control" id="nm" name="nm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-number">Phone Number</label>
                                        <input type="phone-number" class="form-control" id="pnm" placeholder="Enter Phone Number" name="pnm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="extra">Ext.</label>
                                        <input type="ext" class="form-control" id="ext" name="ext">
                                    </div>
                                    <div class="form-group">
                                        <label for="seltop">Help Topic</label>
                                        <select class="form-control" id="seltop">
                                            <option>Select a Help Topic</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default signin-btn">Email-Access Link</button>
                                    <button type="submit" class="btn btn-default reset-btn">Reset</button>
                                    <button type="submit" class="btn btn-default cancel-btn">Cancel</button>
                            </form></div>
                            


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
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Ticket Number</label>
                                        <input type="password" class="form-control" id="pwd" name="pwd">
                                    </div>

                                    <button type="submit" class="btn btn-default signin-btn">Email-Access Link</button>
                                </form>


                            </div>
                            <div class="check-status-cont-lst">
                                <h5>
                            - Have an account with us?<span> <a href="#">Sign In </a> </span> or<span> <a data-toggle="pill" href="#register"> register for an account </a></span> to access your tickets. 
                           </h5>
                                <p>- If this is your first time contacting us or you've last the ticket number, please <span><a href="#">open a new ticket</a></span></p>

                            </div>





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
                                <p>- If this is your first time contacting us or you've last the ticket number, please <span><a href="#">open a new ticket</a></span>
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
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="name" class="form-control" id="nm" name="nm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-number">Phone Number</label>
                                        <input type="phone-number" class="form-control" id="pnm" placeholder="Enter Phone Number" name="pnm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="extra">Ext.</label>
                                        <input type="ext" class="form-control" id="ext" name="ext">
                                    </div>
									<hr>
									<b class="primary-color">Preferences </b>
									<br/><br/>
									
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
										
										<div class="col-md-4 auto-button"> <button type="submit" class="btn btn-default signin-btn"><i class="fa fa-map-marker" aria-hidden="true"></i>
Auto Detext</button></div>
										<div style="clear:both;"></div>
										<hr/>
									  
									  <b class="primary-color">Access Credentials </b><br/><br/>
									  
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
    </section>
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 copy-right">
                    <p>Copyright @ 2017 Medconnex - All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="assests/js/jquery.min.js"></script>
<script src="assests/js/bootstrap.min.js"></script>

</html>