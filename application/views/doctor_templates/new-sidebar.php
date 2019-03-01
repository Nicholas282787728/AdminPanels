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

            <div class="row dash-icon doctor-pnl">
				
               <div class="col-lg-3 col-md-6">
                   <a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/signupdocuments">
                  <div class="panel panel-primary ">
                     <div class="panel-heading">
                        <div class="row"  style="color:#FF8961;" >
							<div class="col-xs-3">
								<i class="fa fa-users fa-3x"></i>
							</div>
                           <div class="col-xs-9 text-right">
                              
                              <div class="font-small">Sign Up Documents</div>
                           </div>
                        </div>
                     </div>
                         <div class="panel-footer adi-head-orange">
                           <span class="pull-left">View Details
                     </span>
                     <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                     <div class="clearfix"></div>
                     </div>
                  </div>
				</a>
               </div>
               <div class="col-lg-3 col-md-6">
					<a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/promo_list">
						<div class="panel panel-primary">
						   <div class="panel-heading">
							  <div class="row"  style="color:#56BDDC;">
								  <div class="col-xs-3">
									  <i  class="fa fa-user fa-3x"></i>
								  </div>
								 <div class="col-xs-9 text-right">
									
									<div class="font-small">Promo Codes</div>
								 </div>
							  </div>
						   </div>
						<div class="panel-footer adi-head-blue">
						<span class="pull-left"> View Details </span>
						   <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						   <div class="clearfix"></div>
						   </div>
						</div>
					</a>
			   </div>

               <div class="col-lg-3 col-md-6">
					<a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/payouts">
					  <div class="panel panel-primary">
						 <div class="panel-heading">
							<div class="row" style="color:#BAA2E0;" >
								<div class="col-xs-3">
                                    <i class="fa fa-globe fa-3x"></i>
                                </div>
							   <div class="col-xs-9 text-right">
								
								  <div class="font-small">Payout Details</div>
							   </div>
							</div>
						 </div>
							<div class="panel-footer adi-head-per">
							   <span class="pull-left">View Details</span>
							   <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
							   <div class="clearfix"></div>
							</div>
					  </div>
					</a>
               </div>

				<div class="col-lg-3 col-md-6">
					<a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/complimentaryAd">
					  <div class="panel panel-primary">
						 <div class="panel-heading">
							<div class="row" style="color:#10B1AC ;">
								<div class="col-xs-3">
                                    <i  class="fa fa-support fa-3x"></i>
                                </div>
							   <div class="col-xs-9 text-right">
								  
								   <div class="font-small">Complimentary Ad</div>
							   </div>
							</div>
						 </div> 
							<div class="panel-footer adi-head-green">
							   <span class="pull-left">View Details</span>
							   <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
							   <div class="clearfix"></div>
							</div>
					  </div>
					</a>
				</div>
			</div>