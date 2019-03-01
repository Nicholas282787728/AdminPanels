<script>
	//   bkLib.onDomLoaded(function() {
	//       new nicEditor().panelInstance('task_details');
	//       new nicEditor().panelInstance('message_details');
	// });
	var area1, area2;
	function toggleArea1() {
		area1 = new nicEditor({fullPanel: true}).panelInstance('task_details', {hasPanel: true});
	}
	function toggleArea2() {
		area2 = new nicEditor({fullPanel: true}).panelInstance('message_details', {hasPanel: true});
	}
	bkLib.onDomLoaded(function () {
		toggleArea1();
	});
	bkLib.onDomLoaded(function () {
		toggleArea2();
	});
	$(document).resize(function () {
		toggleArea1();
		toggleArea2();
	});
</script>
<style>
	label.error{
		color:red;
		font-weight: 400;
	}
	.radio label.error{
		position: absolute;
		right: 100px;
		top: 25px;
	}
</style>

<div id="page-wrapper">
	<?php
	$this->load->view('admin/top_tab_header');
	?>
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
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


        	<div class="panel panel-default medconnex5-panel">
				
				<div class="panel-body medconnex3-panelbody">
					<form action='' method='post' >
					<button type="submit" name='type' value="0" class="btn-green adi-head-blue js-location-create" style="background: #dadc88 !important; color: black !important;">Mobile App Users</button><br>
				</form>
					<button type="button" class="btn-green adi-head-per js-location-create" data-toggle="modal" data-target="#exampleModal" style="background: #f5d9a2 !important; color: black !important;">Create New Providers</button>
					<button type="button" class="btn-green adi-head-per " data-toggle="modal" data-target="#create_authorized_task" style="background: #f5d9a2 !important; color: black !important;">Create Task</button>
					<button type="button" class="btn-green adi-head-per " data-toggle="modal" data-target="#send_authorized_message" style="background: #f5d9a2 !important; color: black !important;">Send Message</button><br>
					<button type="button" class="btn-green" data-toggle="modal" data-target="#upload_ondemand_model" style="background: #f0a367; color: black !important;">Bulk On-Demands</button>
					<button type="button" class="btn-green " data-toggle="modal" data-target="#upload_storefornt_model" style="background: #f0a367; color: black !important;">Bulk StoreFronts</button>
<!-- 					<button type="button" class="btn-green " data-toggle="modal" data-target="#upload_products_model" style="background: #f00;">Bulk Uploads Products</button> -->
					
						<button type="button" class="btn-green" data-toggle="modal" data-target="#upload_doctor_model" style="background: #f0a367; color: black !important;">Bulk Doctors</button>
					
					
					<form action='' method='post' >
						
						<button type="submit" name='type' value="1" class="btn-green adi-head-blue js-location-create" style="background: #04040433 !important; color: black !important;">On-Demand Drivers </button>
						<button type="submit" name='type' value="3" class="btn-green adi-head-blue js-location-create" style="background: #04040433 !important; color: black !important;">Storefront </button>
						<button type="submit" name='type' value="2" class="btn-green adi-head-blue  js-location-create" style="background: #04040433 !important; color: black !important;">Doctors</button>
						
					</form>
				</div>
			</div>
			<div class="panel panel-default medconnex3-panel">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue medconnex3-panelblue">
                	<?php $usertype = $alluser[0]['user_type']; ?>

					<h3 class="panel-title pull-left medconnex3-left"><i class="fa fa-users"></i> 	<?php if($usertype == '0'){
										?>
										<th>Mobile App Users</th>
											<?php
									}else{
										?>
										Authorized Users
										<?php
									}  ?>
								

							</h3>
					<div class="pull-right">
					</div>
				</div>
                <div class="panel-body medconnex3-panelbody">
					
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover medconnex3-table" id="dataTables-example">
                            <thead>
                                <tr class="first-row">
									<th>Location Name</th>
									<th>Open/ Close</th>
									<?php if($usertype != '0'){
										?>
										<th>Provider Type</th>
											<?php
									}  ?>

										
									
									<th>Phone #</th>
									<th>Email</th>
									<th>Facebook</th>
									<th>Instagram</th>
									<th>Twitter</th>
									
									<th>City, State</th>
										<th>Zip Code</th>
										
										<th>Registered Since</th>
										<th>Last Sign-In</th>
									<!-- 	<th>Title</th>
										<th>Title</th>
									

									<th>Title</th> -->
									
								<!-- 	<th>Registered Since</th> -->
									
									<th>Status/action</th>
					 		<!-- 		<th>Rating</th> -->
					 				<?php if($usertype != '0'){
										?>
									<th>Visit Panel</th>
									<th>Completed Task</th>
										<?php
									}  ?>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach ($alluser as $val) { ?>
									<tr class="odd gradeX">
										<td><?php echo $val['display_name']; ?></td>
										<td><?php
										if ($val['opt_in_out'] == 1) {
												echo "Open";
											} else{

												echo "Close";
											}
												  ; ?></td>

												  	<?php if($usertype != '0'){
										?>
											
											<td>
											<?php
											if ($val['user_type'] == 0) {
												echo "User";
											} elseif ($val['user_type'] == 1) {
												echo "Driver";
											} elseif ($val['user_type'] == 2) {
												echo "Doctor";
											} elseif ($val['user_type'] == 3) {
												echo "Storefront";
											}
											?>
										</td>
										<?php
									}  ?>
										<td><?php echo $val['mob_number']; ?></td>
										<td><?php echo $val['email']; ?></td>
										<td><?php echo $val['facebook']; ?></td>
										<td><?php echo $val['instagram']; ?></td>
										<td><?php echo $val['twitter']; ?></td>
										<td><?php echo $val['city'].' '.$val['state']; ?></td>
										<td><?php echo $val['zip']; ?></td>
										
										<td><?php echo $val['member_since']; ?></td>
										<td><?php echo $val['last_login']; ?></td>
									<!-- 	<td><?php echo $val['title']; ?></td>
										<td><?php echo $val['title']; ?></td> -->
									
										<!-- <td><?php echo $val['created_at']; ?></td> -->
										
										<td class="center">
											<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><?php echo ($val['flag_enabled'] == 1) ? 'Active' : 'De-active'; ?> <span class="caret"></span></button>
												<ul class="dropdown-menu" role="menu">
													<li>
														<a href="#" data-id="<?php echo $val['id']; ?>" class="js-user-edit"><i class="fa fa-edit"></i> Edit user</a>
													</li>
													<li>
														<a href="<?php echo base_url() . 'panels/supermacdaddy/dashboard/staff_tasklist?staff_id=' . $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
															<i class="fa fa-eye"></i> Task Details
														</a>
													</li>
													<?php if ($val['flag_enabled'] == 1) { ?>
														<li>
															<form action="" method="post">
																<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>" class="js-user-disable">
																	<i class="fa fa-minus-circle"></i>  De-activate User
																</button>
															</form>
														</li>
													<?php } else { ?>
														<li>
															<form action="" method="post">
																<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>" class="js-user-disable">
																	<i class="fa fa-minus-circle"></i> Activate User
																</button>
															</form>
														</li>
													<?php } ?>
													<li>
														<a href="#" data-id="<?php echo $val['id']; ?>" class="change_password" data-target="#dialog-user-password" data-toggle="modal"><i class="fa fa-key"></i> Change password</a>
													</li>
													<li>
														<form action="" method="post">
															<button style="padding: 1px 20px;border: none;background: transparent;"
																	onclick="return confirm('Are you sure you want to delete the user <?php echo $val['display_name']; ?> ?');" type="submit" name="delete" value="<?php echo $val['id']; ?>"  class="js-user-delete">
																<i class="fa fa-trash-o"></i> Delete user</button>
														</form>
													</li>
												</ul>
											</div>
										</td>
										<!--<td><a href="<?php echo base_url() ?>panels/supermacdaddy/dashboard/ratings" class="btn btn-success" target="_blank">Rating</a></td>-->
										<!-- <td><a href="#"  class="btn btn-success" data-toggle="modal" data-target="#rating_view">Rating</a></td> -->
											<?php if($usertype != '0'){
										?>
										<td>
											<?php
											$user_type = $val['user_type'];
											$url_visit_panel = '';
											if ($user_type == '1') {
												$url_visit_panel = "panels/supermacdaddy/Ondemand";
												echo '<a href="' . base_url() . $url_visit_panel . '" class="btn btn-success" target="_blank">Visit Panel</a>';
											} elseif ($user_type == '2') {
												$url_visit_panel = "panels/supermacdaddy/doctor";
												echo '<a href="' . base_url() . $url_visit_panel . '" class="btn btn-success" target="_blank">Visit Panel</a>';
											} elseif ($user_type == '3') {
												$url_visit_panel = "panels/supermacdaddy/Storefronts";
												echo '<a href="' . base_url() . $url_visit_panel . '" class="btn btn-success" target="_blank">Visit Panel</a>';
											} elseif ($user_type == '0') {
												$url_visit_panel = "";
											}
											?>
										</td>
										<td class="center">
											<?php
											if ($user_type != 0) {
												$total_task = $val['totals'];
												$total_comple = $val['completed'];
												$persatage_completed = '0';
												if (!empty($total_task)) {
													$persatage_completed = (100 / $total_task) * $total_comple;
												}
												echo round($persatage_completed, 2) . '%';
											}
											?>
										</td>
									<?php } ?>
									</tr>
								<?php } ?>
                            </tbody>
                        </table>
                        	<div class="row">
				<div class="col-sm-6"><div class="dataTables_info"  role="status">Total Entires <?php echo $total_rows;?> entries</div>
				</div>
				<div class="col-sm-6">  <?php echo $links;?>
				</div>
				</div>
                    </div>
                <!--     <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
						Create New Providers
					</button>
					<button type="button" class="btn-green  " data-toggle="modal" data-target="#create_authorized_task">Create Task</button>
					<button type="button" class="btn-green  " data-toggle="modal" data-target="#send_authorized_message">Send Message</button> -->
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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i> Create New Providers</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="createuser" id="createuser" method="post" action="" >
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>User Name</label>
								<input class="form-control" name="user_name" autocomplete="off"  placeholder="Please enter the First Name" type="text" required="">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
								<input class="form-control" name="display_name" autocomplete="off" placeholder="Please enter the Last Name" type="text" required="">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Provider Type </label>
								<select id="input_locale2" class="form-control" name="user_type" title="Locale" required>
									<option value="">Select Provider</option>
									<option value="1">Driver</option>
									<option value="2">Doctor</option>
									<option value="3">Storefront</option>
								</select>


							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
								<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text" required="">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
								<input class="form-control" name="contact" autocomplete="off" placeholder="" type="text" required="">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale3">Locale</label>
								<select id="input_locale3" class="form-control" name="locale" title="Locale" required="">
									<option value="de_DE">de_DE</option>
									<option value="en_US" selected="">en_US</option>
									<option value="es_ES">es_ES</option>
									<option value="fr_FR">fr_FR</option>
									<option value="it_IT">it_IT</option>
									<option value="nl_NL">nl_NL</option>
									<option value="pt_BR">pt_BR</option>
									<option value="ro_RO">ro_RO</option>
									<option value="th_TH">th_TH</option>
									<option value="tr_TR">tr_TR</option>
								</select>
							</div>
						</div>

					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="creatUserBottom">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="save" class="btn-green">Create User		</button>
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
				<!-- <div class="modal-footer">
				   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				   <button type="button" class="btn btn-primary">Save changes</button>
				 </div>
			   </div>-->
			</div>
		</div>

	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Providers</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="user" method="post" action="" >
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="updatepro">

							<div class="col-sm-6">
								<div class="form-group">
									<label>User Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input readonly class="form-control" name="user_name" autocomplete="off" value="" placeholder="Please enter the First Name" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Display Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control" name="display_name" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Provider Type </label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<select id="input_locale" class="form-control" name="title" title="Locale" required>
											<option value="">Select Provider</option>
											<option value="1">Driver</option>
											<option value="2">Doctor</option>
											<option value="3">Storefront</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group ">
									<label>Email</label>
									<div class="input-group">
										<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
										<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group ">
									<label>Contact </label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control" name="contact" autocomplete="off" placeholder="" type="text">
									</div>
								</div>
							</div>



						</div>


						<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale1">Locale</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-language"></i></span>
									<select id="input_locale1" class="form-control" name="locale" title="Locale">
										<option value="de_DE">de_DE</option>
										<option value="en_US" selected="">en_US</option>
										<option value="es_ES">es_ES</option>
										<option value="fr_FR">fr_FR</option>
										<option value="it_IT">it_IT</option>
										<option value="nl_NL">nl_NL</option>
										<option value="pt_BR">pt_BR</option>
										<option value="ro_RO">ro_RO</option>
										<option value="th_TH">th_TH</option>
										<option value="tr_TR">tr_TR</option>
									</select>
								</div>
							</div>
						</div>

					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="creatUserBottom">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="update" class="btn-green">Update User		</button>
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
				<!-- <div class="modal-footer">
				   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				   <button type="button" class="btn btn-primary">Save changes</button>
				 </div>
			   </div>-->
			</div>
		</div>

	</div>
</div>


<div class="modal fade" id="dialog-change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" >Change User Password</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user_password" method="post" id="user_password" action="" >
					<div class="row">
						<div class="col-sm-12">
							<div class="radio">
								<label>
									<input name="user_id" id="user_id_password" value="" type="hidden">
									<input class="change_password_mode" name="change_password_mode" id="pass_mode_link" value="link" type="radio">
									<input name="flag_password_reset" value="1" type="hidden">
									Send the user a link that will allow them to choose their own password
								</label>
							</div>
							<div class="radio">
								<label>
									<input class="change_password_mode" name="change_password_mode" id="pass_mode_input" value="manual" type="radio">
									Set the user's password as:
								</label>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Password</label>
								<input class="form-control disbled_password" id="password" name="password" autocomplete="off" value="" placeholder="password" disabled="" type="password">
							</div>
							<div class="form-group">
								<label>Confirm password</label>
								<input class="form-control disbled_password" id="passwordc" name="passwordc" autocomplete="off" value="" placeholder="Confirm password" disabled="" type="password">
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="creatUserBottom">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save_password" class="btn-green">Submit</button>
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

<!--/create task Modal/-->
<div class="modal fade" id="create_authorized_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-tasks"></i> Create Task</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="create_authorized_task_form" id="create_authorized_task" method="post" action=""  enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-6 form-group">
								<label>Select Category </label>
								<div class="input-group" style=" width: 100%;">
									<select class="form-control"  required="" id="category_provider">
										<option value="0">Users</option>
										<option value="1">Driver</option>
										<option value="2">Doctor</option>
										<option value="3">Storefront</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6 form-group">
								<label>Authorized Users </label>
								<div class="input-group" style="width: 100%;">
									<select class="form-control" name="user_id[]" required="" id="authorize_user" multiple>
									</select>
								</div>
							</div>
							<div class="col-sm-6 form-group">
								<label>Start Date</label>
								<div class="input-group">
									<input type="text" class="form-control testing datetimepicker4" name="start_date" required="">
								</div>
							</div>
							<div class="col-sm-6 form-group">
								<label>End Date</label>
								<div class="input-group">
									<input type="text" class="form-control testing datetimepicker4" name="end_date" required="">
								</div>
							</div>

							<div class="col-sm-12 form-group" style="overflow-y: auto;">
								<label>Task Details</label>
								<div class="input-group">
									<textarea class="form-control" id="task_details" name="task_details" rows="4" cols="20"  style="width:500% !important; height:100%;"></textarea>
								</div>
							</div>
							<div class="col-sm-12 form-group">
								<label>Attach File </label>
								<div class="input-group">
									<input name="image" type="file" id="create_taskimage" class="create_taskimage">
									<span id="setcreate_taskimage"></span>
									<input name="remove_image_task" type="hidden" id="get_imagetask_hidden">
								</div>
								<span class="docurl"></span>
								<img src="" id="myImg" style="max-width:100px;max-height:100px;"/>
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save_authorized_task" class="btn-green">Create Task</button>
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

<!--/Send message Modal/-->
<div class="modal fade" id="send_authorized_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Message</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="send_authorized_message" id="send_authorized_message" method="post" action="" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group" >
								<label>Provider Type</label>
								<div class="input-group" style="width: 50%;">
									<select class="form-control" name="" required="" id="category_provider_message">
										<option value="0">Users</option>
										<option value="1">Driver</option>
										<option value="2">Doctor</option>
										<option value="3">Storefront</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Authorized Users </label>
								<div class="input-group" style="width: 50%;">
									<select class="form-control" name="message_user_id[]" required="" id="message_user" multiple>

									</select>
								</div>
							</div>

							<div class="form-group" style="overflow-y: auto;">
								<label>Message</label>
								<div class="input-group">
									<textarea class="form-control" id="message_details" name="message_details" rows="4" style="width:500% !important; height:100%;"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label>Attach File </label>
								<div class="input-group">
									<input name="image" type="file" id="get_image" class="get_image">
									<span id="setlinkcheck"></span>
									<input name="remove_image" type="hidden" id="get_image_hidden">
								</div>
								<span class="docurl1"></span>
								<img src="" id="myImg1" style="max-width:100px;max-height:100px;"/>
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="send_authorized_message" class="btn-green">Send Message</button>
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

<div class="modal fade" id="upload_storefornt_model" tabindex="-1" role="dialog" aria-labelledby="upload_storefornt" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i>Bulk Upload Storefornts </h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="upload_storefornt" id="upload_storefornt" method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/storefrontBulkUpload');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload File </label>
								<div class="input-group">
									<input name="image" type="file" id="get_image" class="get_image">
								</div>
								<a href="<?php echo base_url('uploads/documents/user.csv');?>">Dowload Storefront sample document & upload</a>
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="upload_data" value="upload_data" class="btn-green">Upload</button>
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


<div class="modal fade" id="upload_products_model" tabindex="-1" role="dialog" aria-labelledby="upload_products" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i>Bulk Upload Products </h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="upload_storefornt" id="upload_storefornt" method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/productsBulkUpload');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload File </label>
								<div class="input-group">
									<input name="image" type="file" id="get_image" class="get_image">
								</div>
							
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit"  value="upload_data" class="btn-green">Upload</button>
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



<div class="modal fade" id="upload_ondemand_model" tabindex="-1" role="dialog" aria-labelledby="upload_ondemand" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i>Bulk Upload ondemand</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="upload_ondemand" id="upload_ondemand" method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/ondemandBulkUpload');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload File </label>
								<div class="input-group">
									<input name="image" type="file" id="get_image" class="get_image">
								</div>
								<a href="<?php echo base_url('uploads/documents/on-demand.csv');?>">Dowload ondemand sample document & upload</a>
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="upload_ondemand" value="upload_data" class="btn-green">Upload</button>
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

<div class="modal fade" id="upload_doctor_model" tabindex="-1" role="dialog" aria-labelledby="upload_ondemand" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i>Bulk Upload Doctor's</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="upload_ondemand" id="upload_ondemand" method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/doctorBulkUpload');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload File </label>
								<div class="input-group">
									<input name="image" type="file" id="get_image" class="get_image">
								</div>
								<a href="<?php echo base_url('uploads/documents/doctor.csv');?>">Dowload doctor sample document & upload</a>
							</div>
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="upload_ondemand" value="upload_data" class="btn-green">Upload</button>
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
<script src="<?= base_url() ?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#get_image").change(function () {
//			if (this.files && this.files[0]) {
//				var reader = new FileReader();
//				reader.onload = imageIsLoaded;
//				reader.readAsDataURL(this.files[0]);
//			}
			var formData = new FormData();
			var file_data = $('#get_image').prop('files')[0];
			formData.append('image', file_data);
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(); ?>panels/supermacdaddy/dashboard/dataview",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function (data) {
					console.log(data.success);
					$('#setlinkcheck').html('<br><a href="<?= base_url() ?>uploads/tmp_file/' + data.success + '"  target="_blank" style="font-size:20px;">view attachment </a>');
					$('#get_image_hidden').val(data.success);
				},
				error: function (data) {
					console.log(data);
				}
			});

		});
		$("#create_taskimage").change(function () {
			var formData = new FormData();
			var file_data = $('#create_taskimage').prop('files')[0];
			formData.append('image', file_data);
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(); ?>panels/supermacdaddy/dashboard/dataview",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function (data) {
					console.log(data.success);
					$('#setcreate_taskimage').html('<br><a href="<?= base_url() ?>uploads/tmp_file/' + data.success + '"  target="_blank" style="font-size:20px;">view attachment </a>');
					$('#get_imagetask_hidden').val(data.success);
				},
				error: function (data) {
					console.log(data);
				}
			});

		});


//		function imageIsLoaded(e) {
//		$('#setlinkcheck').html('<a href="'+e.target.result+'"  target="_blank" style="font-size:20px;">Download</a>');
//		$('#set123').html();
//		download="Viewdata"
//		};


		$(".datetimepicker4").datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		});

		$('#category_provider').change(function () {
			var user_type = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/dashboard/get_user_provider",
				data: "&user_type=" + user_type,
				dataType: "json",
				success: function (response) {
					$("#authorize_user").html(response.success);

				}
			});
		})
		$('#category_provider_message').change(function () {
			var user_type = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/dashboard/get_user_provider",
				data: "&user_type=" + user_type,
				dataType: "json",
				success: function (response) {
					$("#message_user").html(response.success);

				}
			});
		})



		$(".js-user-edit").click(function () {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/dashboard/edit_user",
				data: "&id=" + id,
				success: function (response) {
					//console.log(response['id']);
					$(".updatepro").html(response);
					$('#editprofile').modal('show')
				}

			});
		});

		$(".change_password").click(function () {
			var id = $(this).attr("data-id");
			$("#user_id_password").val(id);
			$('#dialog-change-password').modal('show')
		});
		$("#dialog-change-password").delegate(".change_password_mode", "change", function () {
			var check = $(this).val();
			$(".disbled_password").each(function () {
				this.disabled = false;
			})
			if (check == "link")
			{
				$(".disbled_password").each(function () {
					this.disabled = true;
				})
			}
		});

		$("#user_password").validate({
			rules: {
				change_password_mode: "required",
				password: "required",
				passwordc: {
					equalTo: "#password"
				}
			},
			messages: {
				change_password_mode: "Please select option",
				password: "Please enter password",
			},
			submitHandler: function (form) {
				form.submit();
			}
		});


		// $("#createuser").validate({
		// 	rules: {
		// 		user_name: "required",
		// 		display_name: "required",
		// 		user_type: "required",
		// 		email: {
		// 			required: true,
		// 			email: true,
		// 			remote: {
		// 				url: "ufuser_EmailCheck",
		// 				type: "post"
		// 			}
		// 		},
		// 		contact: "required",
		// 		locale: "required",

		// 	},
		// 	messages: {
		// 		user_name: "Please enter username",
		// 		display_name: "Please enter display name",
		// 		user_type: "Please select provider",
		// 		email: {
		// 			required: "Please provide a email",
		// 			remote: "email already in use!",
		// 		},
		// 		contact: "Please enter contact",
		// 		locale: "Please enter locale",

		// 	},
		// 	submitHandler: function (form) {
		// 		form.submit();
		// 	}
		// });

		$(".create_taskimage").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		
		function imageIsLoaded(e) {
			var dataImage = $('.create_taskimage').prop('files')[0];
			var fileName = dataImage.name;
			var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			var validExtensions = ['jpg', 'png', 'jpeg']; //array of valid extensions
			if ($.inArray(fileNameExt, validExtensions) == -1) {
				$('.docurl').html('<a href="' + e.target.result + '" target="_blank">' + dataImage.name + '</a>');
				$('#myImg').attr('src', '');
			} else {
				$('#myImg').attr('src', e.target.result);
				$('.docurl').html('');
			}
		};
		
		$(".get_image").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded1;
				reader.readAsDataURL(this.files[0]);
			}
		});
		
		function imageIsLoaded1(e) {
			var dataImage = $('.get_image').prop('files')[0];
			var fileName = dataImage.name;
			var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			var validExtensions = ['jpg', 'png', 'jpeg']; //array of valid extensions
			if ($.inArray(fileNameExt, validExtensions) == -1) {
				$('.docurl1').html('<a href="' + e.target.result + '" target="_blank">' + dataImage.name + '</a>');
				$('#myImg1').attr('src', '');
			} else {
				$('#myImg1').attr('src', e.target.result);
				$('.docurl1').html('');
			}
		};
	});
</script>