<br>
<div class="content-wrapper" style="min-height: 551px;">
	<div class="row-fluid sortable">
        <div id="page-wrapper">
        	  <div class="row">
        <div class="col-lg-12">  <!-- <h1 class="page-header">Promo Codes</h1> -->
        <?php 
        @$success_msg = $this->session->flashdata('success_msg');
        if(!empty($success_msg)) { ?>
               <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>.
              </div>
        <?php }elseif($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Danger!</strong> <?php echo $this->session->flashdata('error_msg'); ?>.
          </div>
        <?php }
    ?>
    </div>
    </div>
			<div class="row panel-blue">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-globe"></i> Sales Staff info</h3>
						</div>
						<div class="panel-body">
							
							<form class="form-horizontal" role="form" name="settings" action="<?php echo base_url('sales-updatePassword'); ?>" method="post">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_site_name" class="col-xs-4 col-sm-4 col-lg-4 control-label">Name</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="text" id="input_site_name" class="form-control" name="display_name" value="<?php if (isset($profile->display_name)) { echo $profile->display_name; } ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Email</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="email" id="input_site_title" class="form-control" name="email" value="<?php if (isset($profile->email)) { echo $profile->email; } ?>" readonly="">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">User Name</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="text" id="input_site_title" class="form-control" name="user_name" value="<?php if (isset($profile->user_name)) {echo $profile->user_name;} ?>" >
											</div>
								 		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_site_location" class="col-xs-4 col-sm-4 col-lg-4 control-label">New Password</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="password" id="input_site_location" class="form-control" name="password" value="" > 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_author" class="col-xs-4 col-sm-4 col-lg-4 control-label">Confirm Password</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="password" id="input_author" class="form-control" name="confirmPass" value="">
											</div>
										</div> 
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_phone" class="col-xs-4 col-sm-4 col-lg-4 control-label">Phone Number</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="text" id="input_phone" class="form-control" name="mob_number" value="<?php if (isset($profile->mob_number)) {echo $profile->mob_number;} ?>" required=""> 
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="input_social" class="col-xs-4 col-sm-4 col-lg-4 control-label">Social Media</label>
											<div class="col-xs-8 col-sm-8 col-lg-8">
												<input type="text" id="input_social" class="form-control" name="socialid" value="<?php if (isset($profile->socialid)) {echo $profile->socialid;} ?>" required=""> 
											</div>
										</div>
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
		</div>
	</div>
</div>
