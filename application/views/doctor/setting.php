    <br>
       <div class="content-wrapper" style="min-height: 551px;">
       <div class="row-fluid sortable">
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
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if (!empty($error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('error_msg') . "</div>";
			}
			?>
            <form class="form-horizontal" role="form" name="settings" action="<?php echo base_url(); ?>panels/supermacdaddy/doctor/updatePassword" method="post" >

                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Email</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
								<input type="email" id="input_site_title" class="form-control" name="email" value="<?php if(isset($profile->email)){ echo $profile->email; } ?>" readonly="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">User Name</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
								<input type="text" id="input_site_title" class="form-control" name="user_name" value="<?php if(isset($profile->user_name)){ echo $profile->user_name; } ?>" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_site_location" class="col-xs-4 col-sm-4 col-lg-4 control-label">New Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="password" id="input_site_location" class="form-control" name="password" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_author" class="col-xs-4 col-sm-4 col-lg-4 control-label">Confirm Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                              <input type="password" id="input_author" class="form-control" name="confirmPass" value="" required="">

                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <div class="col-xs-8 col-sm-9 col-lg-7">
                              <input type="submit" id="input_author" class="btn btn-info" name="submit" value="Submit">

                            </div>
                        </div>
                </form>
        </div>
        </div>
        </div>
    </div>
	</div>
 </div>
</div>
