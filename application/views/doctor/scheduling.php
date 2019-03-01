<style>
	.panel-heading{
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
			
			<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if (!empty(@$error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('error_msg') . "</div>";
			}
			?>
			
			
			
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="font-weight:bold;height:45px;">
					Scheduling List
				</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Full Name </th>
								<th>Email </th>
								<th>contact </th>
								<th>Preferred Date </th>
								<th>Preferred Time </th>
								<th>Created By </th>
								<th>Status  </th>
								<th>Actions  </th> 
							</tr>
						</thead>
						<tbody>
							<?php foreach ($getscheduling as $row) { ?>
								<tr class="odd">
									<td><?php echo $row->full_name; ?></td>
									<td><?php echo $row->email; ?></td>
									<td><?php echo $row->phone; ?></td>
									<td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
									<td><?php echo date('h:i A', strtotime($row->time)); ?></td>
										<td><?php echo $row->display_name; ?></td>
									<?php if ($row->accepted == '1') { ?>
										<td class="center btn-success">Approved</td>
									<?php } else { ?>
										<td class="center btn-warning">Pending</td>
									<?php } ?>
									<td class="center">
									<a class="btn btn-info edit_scheduling" href="javascript:;" data-id="<?=$row->id;?>">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
									<a class="btn btn-danger"  onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/delSchedule/<?php echo $row->id; ?>"><i class="fa fa-trash-o"></i></a>
									<i class="fa fa-skype hastooltip" title="" style="cursor:pointer" ></i>
									<i class="fa fa-envelope hastooltip" title="<?=$row->email?>" style="cursor:pointer"></i>
									<i class="fa fa-phone hastooltip" title="<?=$row->phone?>" style="cursor:pointer"></i>
									
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


<!--/Edit data/-->
<div class="modal fade" id="edit_sche_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Scheduling</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="edit_ticket_form" id="" method="post" action=""   >
					<div id="form-alerts"></div>
					<div class="row">
						<div id="edit_scheduling_list"></div>
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatescheduling" class="btn-green" >Update Scheduling</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>
<script>
	$('.edit_scheduling').click(function(){
		var id = $(this).attr('data-id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/edit_scheduling",
			data: "&id="+id,
			success: function(response){
				$("#edit_scheduling_list").html(response);
				$('#edit_sche_popup').modal('show')   
				$(".datetimepicker4").datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
				});
			} 
		});
	})
</script>