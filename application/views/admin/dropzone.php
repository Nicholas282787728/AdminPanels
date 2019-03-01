
 <script type="text/javascript" src="<?=base_url()?>public/js/nicEdit-latest.js"></script>
 <script>
	   bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('task_details');
        new nicEditor().panelInstance('message_details');
  });
</script>
<style>
	label.error{
		color: red;
		font-weight: 400;
	}
</style>
 
<div id="page-wrapper">
	<?php 
		 $this->load->view('admin/top_tab_header');
	?>
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
			<div id="msgsuccess"></div>
			<div class="panel panel-default medconnex5-panel">
				
				<div class="panel-body medconnex5-body">
					<div class="pull-left medconnex5-left">

						<form method="post" accept="<?php echo base_url(); ?>distribution-zone" >
							<button type="button" class="btn-green" data-toggle="modal" data-target="#exampleModal">Add New Affiliates</button> 
					<!-- 		<button type="submit" name="delete_all" class="btn-green" onclick="return confirm('Are you sure you want to remove all data');">Remove All</button> -->
<button type="button"  class="btn-green delete">Delete</button>

						

								</form>


							
					
					</div>
					
					
				
				</div>

			</div>
				<form method="post" accept="<?php echo base_url(); ?>distribution-zone" >
							<button type="submit" name="delete_chekbox" style="display: none;" class="btn-green delete1" onclick="return confirm('Are you sure you want to delete this record');">Delete</button>
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue medconnex5-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Affiliates Info
					<div class="pull-right medconnex5-blueright">
						
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover medconnex5" id="dataTables-example">
							<thead>
								<tr class="first-row">
									<th><input type="checkbox"  ></th>
									<th>Affiliate Partner Id <i class="fa fa-sort"></i></th>
									<th>Affiliate Business Name <i class="fa fa-sort"></i></th>
									<th>Affiliate Full Name <i class="fa fa-sort"></i></th>
							<!-- 		<th>Contact # <i class="fa fa-sort"></i></th> -->
									<th>Affiliate Email <i class="fa fa-sort"></i></th> 
											<th>Assignee Name<i class="fa fa-sort"></i></th>
									<th>Assignee Email<i class="fa fa-sort"></i></th>
								
									<th>State <i class="fa fa-sort"></i></th>
									<th>County <i class="fa fa-sort"></i></th>
									<th>Zip Codes <i class="fa fa-sort"></i></th>
									
									
								<!-- 	<th>Zip Code<i class="fa fa-sort"></i></th> -->
									<!-- <th>Contracted Date<i class="fa fa-sort"></i></th> -->
									
									<th>Action <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($all_staff as $val) {
								?>
									<tr class="odd gradeX">
										<td><input type="checkbox" class="check" name="check[]"  value="<?php echo $val['id']; ?>"></td>
										<td><?php echo $val['affiliatePartnerId']; ?></td>
											<td><?php echo $val['business_name']; ?></td>
										<td><?php echo $val['affiliateFullName']; ?></td>
										<!-- <td><?php echo $val['contact']; ?></td> -->
										<td><?php echo $val['email']; ?></td>
												<td><?php echo $val['assign_affiliate_name']; ?></td>
											<td><?php echo $val['assign_affiliate']; ?></td>
								
										<td><?php echo $val['state']; ?></td>
										<td><?php echo $val['city']; ?></td>
										<!-- <td><?php echo $val['community_name']; ?></td> -->
									


									
										
										<td><a href="" data-toggle="modal" data-target="#zipcodes<?php echo $val['id']; ?>">zip codes</td>
										<!-- 	<?php 

										$query = $this->db->query("select approvedDate from uf_affiliate where current_email = '$val[assign_affiliate]' ");
										$result = $query->row();
		
										 ?>
										 	<td><?php echo $result->approvedDate; ?></td> -->
									

										
										
										<td class="center">
										<form action='' method='post'>
										<?php
										if ($val['flag_enabled'] == 0) {
											echo '<div class="btn-group">
												<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
													Unactivated
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">
												  <li>
													<a href="javascript:void(0)" data-id="' . $val['id'] . '" class="js-staff-edit"  data-toggle="modal">
														<i class="fa fa-edit"></i> Edit Affiliate
														</a>
													</li>
													<li>
													<a href="javascript:void(0)" data-toggle="modal" data-target="#edit_territories' . $val['id'] . '"   >
														<i class="fa fa-edit"></i> Edit Territories
														</a>
													</li>
												   <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="' . $val['id'] . '" id="enable" data-id="' . $val['id'] . '" class="js-staff-enable">
														<i class="fa fa-minus-circle"></i> Enable 
														</button>
														</form>
													</li>


														 <li>
													<form action="" method="post">
													<input type="hidden" name="id" value="' . $val['id'] . '">
													<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" onclick="return confirm(\'Are you sure you want to delete this record ?\');"  name="delete" value="' . $val['id'] . '"  class="js-staff-disable">
													<i class="fa fa-trash-o"></i>  Delete 
													</button>
													</form>

												</li>
												<li>
																<a  href="javascript:void(0);" data-target="#sendmail'.$val['id'].'"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> send mail
																</a>
															</li>
												</ul>
											</div>';
										} else {
											echo '<div class="btn-group">
											<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
												Active
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
                                                    <li>
													<a href="javascript:void(0)" data-id="' . $val['id'] . '" class="js-staff-edit"  data-toggle="modal">
														<i class="fa fa-edit"></i> Edit Affiliate
														</a>
													</li>
													<li>
													<a href="javascript:void(0)" data-toggle="modal" data-target="#edit_territories' . $val['id'] . '"   >
														<i class="fa fa-edit"></i> Edit Territories
														</a>
													</li>
											  
												 <li>
													<form action="" method="post">
													<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="' . $val['id'] . '" id="disable" data-id="' . $val['id'] . '" class="js-staff-disable">
													<i class="fa fa-minus-circle"></i>  Disable 
													</button>
													</form>

												</li>
												 <li>
													<form action="" method="post">
													<input type="hidden" name="id" value="' . $val['id'] . '">

													<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" onclick="return confirm(\'Are you sure you want to delete this record ?\');"   name="delete"   class="js-staff-disable">
													<i class="fa fa-trash-o"></i>  Delete 
													</button>
													</form>

												</li>
											

											</ul>
										</div>';
										}
										?>

										</form>
										</td>
										
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

									 <div class="modal fade" id="sendmail<?php echo $val['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('dashboard/affiliatesComposemail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php echo $val['assign_affiliate']; ?>" class="form-control" required="" >
								</div>
							</div>
							<div class="form-group">
								<label>CC</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="cc" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<div class="input-group" style="width: 100%;" >
									<input type="text" name="send_subject"  class="form-control" required="" >
								</div>
							</div>


							<div class="form-group"  >
								<label>Message</label>
								<div class="input-group"  style="width: 100%;" >
									<textarea class="form-control ckeditor" id="composmails" name="send_message" rows="4" ></textarea>

								</div>
							</div>
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom creatUserBottom-2">
							<button type="submit"  class="btn-green">Send Message</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="edit_territories<?php echo $val['id']; ?>" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Territories Info</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="">
					<div id="form-alerts"></div>
					<div class="territories">
						<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Partner Id</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="affiliatePartnerId" autocomplete="off" value="<?php echo $val['affiliatePartnerId']; ?>"   placeholder="" type="text">
						</div>
					</div>
				</div>
					<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Business Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="business_name" autocomplete="off" value="<?php echo $val['business_name']; ?>"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Full Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="affiliateFullName" autocomplete="off" value="<?php echo $val['affiliateFullName']; ?>"   placeholder="" type="text">
						</div>
					</div>
				</div>
			<!-- 	 <div class="col-sm-6">
							<div class="form-group">
								<label>Affiliate Email</label>
								<input class="form-control" name="email" autocomplete="off" value="<?php echo $val['email']; ?>"  placeholder="Please enter the Email" required="required" type="text">
							</div>
						</div>  -->
		






				<!-- <div class="col-sm-6">
							<div class="form-group">
								<label>Assignee Name</label>
									<input class="form-control"  name="assign_affiliate_name" value="<?php echo $val['assign_affiliate_name']; ?>" autocomplete="off"   type="text">
							</div>
						</div>   -->

			

				<div class="col-sm-6">
					<div class="form-group">
						<label>State</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="state" autocomplete="off" value="<?php echo $val['state']; ?>"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>County</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="city" autocomplete="off" value="<?php echo $val['city']; ?>"   placeholder="" type="text">
						</div>
					</div>
				</div>
				
					<div class="col-sm-6">
					<div class="form-group">
						<label>Zip Code</label>
				
						<div class="input-group addNewZipDiv">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<!-- <input class="form-control zip_code"   value="<?php echo $val['zip_code']; ?>"    type="" > -->
							<textarea class="form-control" name="zip_code" cols="50" rows="5"><?php echo $val['zip_code']; ?></textarea>
							
						</div>
					<!-- 		<div class="addNewZipDiv"></div> -->
					</div>
					
				</div>

					
<!-- 
				<input type="button" name="addZip" class="addZip" value="add zip" data-idzip="<?php echo $val['id']; ?>" > -->


				
				
					
			</div><br>

		
						
						<div class="row modal-footer">
							<div class="creatUserBottom ">
								
										<button type="submit" name="edit_territories" value="<?php echo $val['id']; ?>" class="btn-green">Update Territories</button>
									
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									
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
					<button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">Add New Territories</button>
					
				</div>
			</div>
		</form>
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
								<label>Affiliate Partner Id </label>
								<input class="form-control" name="affiliatePartnerId" autocomplete="off" value=""  placeholder="Please enter the Affiliate Partner Id " required="required" type="text">
							</div>
						</div>

					   <div class="col-sm-6">
							<div class="form-group">
								<label>Affiliate Business Name</label>
								<input class="form-control" name="business_name" autocomplete="off" value=""  placeholder="Please enter the Business Name" required="required" type="text">
							</div>
						</div>
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Affiliate Full Name</label>
								<input class="form-control" name="affiliateFullName" autocomplete="off" value=""  placeholder="Please enter the Affiliate Full Name" required="required" type="text">
							</div>
						</div>
					<!-- 	 <div class="col-sm-6">
							<div class="form-group">
								<label>Contact #</label>
								<input class="form-control" name="contact" autocomplete="off" value=""  placeholder="Please enter the Contact #" required="required" type="text">
							</div>
						</div> -->
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Affiliate Email</label>
								<input class="form-control" name="email" autocomplete="off" value=""  placeholder="Please enter the Email" required="required" type="text">
							</div>
						</div> 
							<div class="col-sm-6">
							<div class="form-group">
								<label>Assignee Name</label>
									<input class="form-control"  name="assign_affiliate_name" autocomplete="off"  required=""  type="text">
							</div>
						</div> 
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Assignee Email</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<select id="input_locale" class="form-control" name="assign_affiliate" title="status" required>
											<option value="">--select assign affiliate--</option>
											<?php 
											foreach ($affiliate_partners as $a) { ?>
											<option value="<?php echo $a['current_email'];?>"><?php echo $a['current_email'];?></option>
											<?php } ?>
											
										</select>
									</div>
								</div>
							</div>   


							 <div class="col-sm-6">
							<div class="form-group">
								<label>Zip Code</label>
								<input class="form-control" name="zip_code" autocomplete="off" value=""  placeholder="Please enter the zip code" required="required" type="text">
							</div>
						</div>
							 <div class="col-sm-6">
							<div class="form-group">
								<label>State</label>
								<input class="form-control" name="state" autocomplete="off" value=""  placeholder="Please enter the State" required="required" type="text">
							</div>
						</div>
							 <div class="col-sm-6">
							<div class="form-group">
								<label>County</label>
								<input class="form-control" name="city" autocomplete="off" value=""  placeholder="Please enter the City" required="required" type="text">
							</div>
						</div>





<!-- 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Zip Code</label>
									<input class="form-control"  name="zip_code" autocomplete="off" value="" placeholder="Please enter the zipcode" type="text">
							</div>
						</div>  -->
					 

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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Affiliate Info</h5>
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
								
										<button type="submit" name="updateTerritories" class="btn-green">Update Territories</button>
									
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>













<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			$(".js-staff-edit").click(function(){
			 var id =$(this).attr("data-id");
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>dashboard/getDropzone",
				data: "&id="+id,
				success: function(response){
					$(".territories").html(response);
					$('#edit_sale_Modal').modal('show')   
				} 

			});
		});
		
$(".delete").click(function(){
	setTimeout(function() { $('.delete1').trigger('click'); }, 100);
	///alert('dsfgbnm');
	

	});




		var i = 1;
		$(".addZip").click(function(){

				var data = `<input class="form-control zip_code"   type="text">`;
			$('.addNewZipDiv').append(data);




			 // var id =$(this).attr("data-idzip");
			 // var zipcode = $('.zip_code').val();
		
			// $.ajax({
			// 	type: "post",
			// 	url:"<?php echo base_url();?>dashboard/getDropzone",
			// 	data: {id:id,zipcode:zipcode},
			// 	success: function(response){
			// 		$(".territories").html(response);
			// 		$('#edit_sale_Modal').modal('show')   
			// 	} 

			// });
		});
	});
	getVal(i) {

	}




</script>