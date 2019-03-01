 <div id="page-wrapper">

	<div class="row dash-icon">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
			 <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i  style="color:#FF8961;" class="fa fa-users fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<!-- <div class="huge"><?php echo count(@$salcount['sales']);?></div> -->
							<div class="font-small">Dashboard</div>
						</div>
					</div>
				</div>
				<div class="panel-footer adi-head-orange">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
			 <a href="#" class="" data-toggle="modal" data-target="#exampleModal">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							 <i  style="color:#56BDDC;" class="fa fa-user fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<span><?php echo @$salcount['users'];?></span>
							<div class="font-small">Certified Providers Panel</div>
						</div>
					</div>
				</div>

					<div class="panel-footer adi-head-blue">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/affiliate">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
							   <i  style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
							
								<div class="font-small">Affiliate Partners Panel</div>
							</div>
						</div>
					</div>
					<div class="panel-footer adi-head-per">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		  <div class="col-lg-3 col-md-6">
                     <a href='<?php echo base_url(); ?>panels/supermacdaddy/storefronts/support_tickets'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <span><?php echo $supportCount; ?></span>
                                    <div class="font-small">Support Tickets! </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/support_tickets">
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </a>
                </div>
	</div>
	 
	<div class="row">
		<div class="col-lg-12 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="huge">Under Construction</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Pannel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-primary">On-Demand</button></a>
		<a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-info">Storefronts</button></a>
		<a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-success">Industry Doctors</button></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>     