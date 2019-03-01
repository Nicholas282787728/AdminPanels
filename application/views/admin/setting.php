        <div id="page-wrapper">
           
            <div class="row panel-blue">
            <div class="col-md-2"></div>
        <div class="col-md-8">
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-globe"></i> Settings</h3>
        </div>
        <div class="panel-body">
        
                <?php
            @$success_msg = $this->session->flashdata('successmessage');
            if (!empty($success_msg)) {
                echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
                echo $this->session->flashdata('successmessage') . "</div>";
            }
            @$error_msg = $this->session->flashdata('errormessage');
            if (!empty(@$error_msg)) {
                echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
                echo $this->session->flashdata('errormessage') . "</div>";
            }
            ?>
            <form class="form-horizontal" role="form" name="settings" action="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/updatePassword" method="post" novalidate="novalidate">
                                     
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Email</label>
                            <div class="col-xs-8 col-sm-8 col-lg-8">
								<input type="email" id="input_site_title" class="form-control" name="email" value="<?php echo !empty($email)?$email:''; ?>" readonly="">
                                                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Name</label>
                            <div class="col-xs-8 col-sm-8 col-lg-8">
                             <input type="text" id="input_site_title" class="form-control" name="user_name" value="<?php echo !empty($username)?$username:''; ?>">
                                                               
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_site_location" class="col-xs-4 col-sm-4 col-lg-4 control-label">New Password</label>
                            <div class="col-xs-8 col-sm-8 col-lg-8">
                             <input type="password" id="input_site_location" class="form-control" name="password" value="" required=""> 
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_author" class="col-xs-4 col-sm-4 col-lg-4 control-label">Confirm Password</label>
                            <div class="col-xs-8 col-sm-8 col-lg-8">
                              <input type="password" id="input_author" class="form-control" name="confirmPass" value="" required="">
                                                              
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-12 col-lg-12 text-right">
                            <div class="row">
                                <input type="submit" id="input_author" class="btn btn-info" name="submit" value="Submit">
                            </div>
                        </div>
                </form>
        </div>
        </div>
        </div>
         
    </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>