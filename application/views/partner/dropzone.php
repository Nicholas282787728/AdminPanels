
<style>
	label.error{
		color: red;
		font-weight: 400;
	}
</style>
 
<div id="page-wrapper">
	  <?php $this->load->view('partner/new-sidebar'); ?>
	<div class="row">
		<div class="col-lg-12">
	 		<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-success' style='float: center;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if (!empty(@$error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;' id='success-alert'>";
				echo $this->session->flashdata('error_msg') . "</div>";
			}
			?>
			<div id="msgsuccess"></div>
		<!-- 	<div class="panel panel-default medconnex5-panel">
				
				<div class="panel-body medconnex5-body">
					<div class="pull-left medconnex5-left">
						<button type="button" class="btn-green" data-toggle="modal" data-target="#exampleModal">Add New Territories</button>
					   
					</div>
					 <div class="pull-right medconnex5-right">
					 	<form action="" method="post">
					 		<input type="hidden" name="delete_all" value="delete_all">
						<button type="submit" class="btn-red" onclick="return confirm('Are you sure you want to delete all records ?');">Remove All</button>
						</form>
					
					</div>
					
				
				</div>
			</div> -->
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue medconnex5-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Territories
					<div class="pull-right medconnex5-blueright">
						
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover medconnex5" id="dataTables-example">
							<thead>
								<tr class="first-row">
									<th>S.No <i class="fa fa-sort"></i></th>
									<th>State Name <i class="fa fa-sort"></i></th>
									<th>County Name <i class="fa fa-sort"></i></th>
									<th>Zip Codes<i class="fa fa-sort"></i></th>
									<!-- <th>Status <i class="fa fa-sort"></i></th>
									<th>Action <i class="fa fa-sort"></i></th> -->
								</tr>
							</thead>
							<tbody>
								<?php
								$sno=1;
								// echo "<pre>"; print_r($all_staff);
								// die();
								foreach ($all_staff as $val) {
								?>
									<tr class="odd gradeX">
										<td><?php echo $sno++; ?></td>
										<td><?php echo $val['state']; ?></td>
										<td><?php echo $val['city']; ?></td>
										<td><a href="" data-toggle="modal" data-target="#zipcodes<?php echo $val['id']; ?>">Make the zip codes text a bit smaller</td>
										
									<!-- 	<td class="center">
										<form action='' method='post'> -->
										<?php
										// if ($val['flag_enabled'] == 0) {
										// 	echo '<div class="btn-group">
										// 		<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
										// 			Unactivated
										// 			<span class="caret"></span>
										// 		</button>
										// 		<ul class="dropdown-menu" role="menu">
												 
										// 		   <li>
										// 				<form action="" method="post">
										// 				<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="' . $val['id'] . '" id="enable" data-id="' . $val['id'] . '" class="js-staff-enable">
										// 				<i class="fa fa-minus-circle"></i> Enable 
										// 				</button>
										// 				</form>
										// 			</li>
										// 		</ul>
										// 	</div>';
										//} else {
										// 	echo '<div class="btn-group">
										// 	<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
										// 		Active
										// 		<span class="caret"></span>
										// 	</button>
										// 	<ul class="dropdown-menu" role="menu">
                                                    
										// 		 <li>
										// 			<form action="" method="post">
										// 			<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="' . $val['id'] . '" id="disable" data-id="' . $val['id'] . '" class="js-staff-disable">
										// 			<i class="fa fa-minus-circle"></i>  Disable 
										// 			</button>
										// 			</form>

										// 		</li>

										// 	</ul>
										// </div>';
										//}
										?>
										<!-- </form>
										</td> -->
										<!-- 	<td>
											<button  href="javascript:void(0);"  class="btn btn-success emailSend">
											<i class="fa fa-envelope-o"></i> Send mail
											</button>
											</td> -->
										
									</tr>
									<div class="modal fade" id="zipcodes<?php echo $val['id']; ?>" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Zip Codes</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="">
					<div id="form-alerts"></div>
					<div class="territoriesaa">
						<?php $zipcodes = explode(',', $val['zip_code']); 
					

							for ($i=0; $i <= sizeof($zipcodes); $i++) { 
								if(!empty($zipcodes[$i])){



							?>
							<h2><?php echo $zipcodes[$i]; ?></h2>
							<?php
							}
						}

						?>
					

						<br>
						<div class="row modal-footer">
							<div class="creatUserBottom ">
								
								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- <button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">Add New Territories</button> -->
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add New Territories</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user"  method="post" action="">
					<div id="form-alerts"></div>
					<div class="row">
					   <div class="col-sm-6">
							<div class="form-group">
								<label>Community Name</label>
								<input class="form-control" name="community_name" autocomplete="off" value=""  placeholder="Please enter the Community Name" required="required" type="text">
							</div>
						</div>
						   <div class="col-sm-6">
							<div class="form-group">
								<label>State</label>
								<input class="form-control" name="state" autocomplete="off" value=""  placeholder="Please enter the Community Name" required="required" type="text">
							</div>
						</div>
						 <div class="col-sm-6">
							<div class="form-group">
								<label>City</label>
								<input class="form-control" name="city" autocomplete="off" value=""  placeholder="Please enter the Community Name" required="required" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Zip Code</label>
									<input class="form-control"  name="zip_code" autocomplete="off" value="" placeholder="Please enter the zipcode" type="text">
							</div>
						</div> 
						<div class="col-sm-6">
								<div class="form-group ">
									<label>Status</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<select id="input_locale" class="form-control" name="flag_enabled" title="status" required>
											<option value="1">Active</option>
											<option value="0">Deactive</option>
										</select>
									</div>
								</div>
							</div>   

						

					
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save" class="btn-green">Add New Territories</button>
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

<!----------- 	EDIT SALES MODAL  ------------->	
<div class="modal fade" id="edit_sale_Modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Territories</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="">
					<div id="form-alerts"></div>
					<div class="territories">
						<br>
						<div class="row modal-footer">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="updateTerritories" class="btn-green">Update Territories</button>
									</div>          
								</div>
								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">your Questions Regarding Territory?</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user"  method="post" action="<?php echo base_url('panels/supermacdaddy/affiliatepartner/mailSendDistribution') ?>">
					<div id="form-alerts"></div>
					<div class="row">
					   <div class="col-sm-12">
							<div class="form-group">
								<label>Email ID</label>
								<input class="form-control" name="sender_email" autocomplete="off" value="nationasales@medconnex.net"  placeholder="Please Enter Your Email id" required="required" type="text" readonly="">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Subject</label>
									<input class="form-control"  name="subject" autocomplete="off" placeholder="Please Enter Subject" type="text" required="">
							</div>
						</div> 
						<div class="col-sm-12">
								<div class="form-group">
								<label>Description</label>
									<textarea  class="form-control" id="email_description" name="description" placeholder="Please Enter Description" rows="5" ></textarea>
							    </div>
							</div>   
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="sendmail" class="btn-green">Send Mail</button>
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

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'email_description' );

    </script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.emailSend').click(function(){
 			 var id =$(this).attr("data-id");
 			 $('.email').val(id);
 			 $('#emailModal').modal();
 		})

 	})
 </script>


<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			$(".js-staff-edit").click(function(){
			 var id =$(this).attr("data-id");
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/getDropzone",
				data: "&id="+id,
				success: function(response){
					$(".territories").html(response);
					$('#edit_sale_Modal').modal('show')   
				} 

			});
		});
		
	});
</script>