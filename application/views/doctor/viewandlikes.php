<style>
	.panel-heading
	{
		height: 80px;
		max-height: 80px;
	}
</style>
<div id="page-wrapper">
	   <div class="row dash-icon doctor-pnl">
			   <div class="col-lg-3 col-md-6">
                   <a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/signupdocuments">
                  <div class="panel panel-primary ">
                     <div class="panel-heading">
                        <div class="row"  style="color:#FF8961;" >
							<div class="col-xs-3">
								<i class="fa fa-file fa-3x"></i>
							</div>
                           <div class="col-xs-9 text-right">
                              <div class="huge">Your Documents</div>
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
								  <i  class="fa fa-tags fa-3x"></i>
							  </div>
							 <div class="col-xs-9 text-right">
								<div class="huge">Promo Codes</div>
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
                                    <i class="fa fa-credit-card fa-3x"></i>
                                </div>
							   <div class="col-xs-9 text-right">
								  <div class="huge">Payout Details</div>
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
                                    <i  class="fa fa-bullhorn fa-3x"></i>
                                </div>
							   <div class="col-xs-9 text-right">
								  <div class="huge">Complimentary Ad</div>
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
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="font-weight:bold;height:45px;">
					Views & Likes
				</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>S.No </th>
								<th>Name</th>
								<th>Email </th>
								<th>Contact  </th>
								<th>Product Type</th>
								<th>Product Name</th>
								<th>File</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<?php $i = '1';
								foreach ($viewLikes as $row) {
									?>
									<td><?php echo $i++; ?></td>
									<td><?php echo $row->display_name; ?></td>
									<td><?php echo $row->email; ?></td>
									<td> <?php echo $row->mob_number; ?> </td>
									<td> <?php echo $row->product_type; ?> </td>
									<td> <?php echo $row->product_name; ?> </td>
									<td style="width:7%">
										<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?=$row->image;?>" style="color: rgb(255, 255, 255);">
											<span class="label label-success">View</span>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>