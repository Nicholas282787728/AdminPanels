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
     <?php 
		 $this->load->view('admin/top_tab_header');
	?>
	<div class="row-fluid sortable">		
		<div class="box span12">
		
			<div class="row">
                <div class="col-lg-12">
				 <div class="panel panel-default medconnex5-panel">
					<div class="panel-body medconnex5-body">
						<div class="pull-left medconnex5-left">
						<button type="button" class="btn-green" data-toggle="modal" data-target="#bulkGeneralSales">Bulk upload General sales</button>
						</div>
					</div>
				 </div>
                    <div class="panel panel-default">
                    <div class="panel-heading title-bar-blue">
	                  <p><i class="fa fa-shopping-cart" aria-hidden="true"></i> General Sales</p>
	                </div> 
	                <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <form method="post" action="">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" >
                                <thead>
									<tr class="first-row">
										<th><input type="checkbox"  id="bookid"></th>
										<th class="br-n">S.No.</th>
										<th class="br-n">Provider Id</th>
										<th class="br-n">Location Name</th>
										<th class="br-n">Contact #</th>
										<th class="br-n">Email</th>
										<th class="br-n">Provider Type</th>
										<th class="br-n">Zip Code</th>
										<th class="br-n">State</th>
										<th class="br-n">City</th> 
										
										<th class="br-n">Uploaded oN</th>
										<th class="br-n">Start Date/Time</th>
										<th class="br-n">End Date/Time</th>
											<th class="br-n">2 Week Comp</th>

										<th class="br-n">Notes</th>
										<th class="br-n">Contact</th>
										<!-- 	<th class="br-n">Notes Date & Time</th> -->
										<th class="br-n">Trash</th>
										
										<th class="br-n">Actions</th>
									</tr>
                                </thead>
                                <tbody>
									<?php $i = 1;
									// echo "<pre>"; print_r($all_staff);
									// 	die();
									foreach ($all_staff as $row) {
										
										$id=$row['id'];
										?>
										<tr>
										
										<td><input type="checkbox" class="check" name="book[]" value="<?=$id?>" ></td>
											<td><?php echo $i++; ?></td>
											<td><?php  $sql = "select randomId from uf_user where  email = '".$row['email']."'";
		$query = $this->db->query($sql);
		$res = $query->row();

												  echo $res->randomId; ?></td>
											<td><?php echo $row['location_name']; ?></td>
											<td><?php echo $row['contact_no']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td>
												<?php if ($row['provider_type'] == 3) {
													echo 'Store';
												}
												else if($row['provider_type'] == 1) {
													echo 'On-Demand';
												}

												?></td>
											<td><?php echo $row['zip_code']; ?></td>
											<td><?php echo $row['state']; ?></td>
										 	<td><?php echo $row['city']; ?></td> 
											
											<td><?php echo $row['create_date']; ?></td>
											<td><?php echo $row['compStartDate']; ?> <?php echo $row['comstartendtime']; ?></td>

										

											<td><?php echo $row['compEndDate']; ?> <?php
											$selectedTime = $row['comstartendtime'];
												$endTime = strtotime("-1 minutes", strtotime($selectedTime));
												if(!empty($row['compEndDate'])){
													echo date('h:i:s', $endTime);

												}
												
											 ?></td> 
											 <td><?php if($row['comp'] == 1) { echo 'Yes'; } else { echo 'No'; }  ?></td>

											<td><a class="btn btn-info notes_genral" href="javascript:void(0);" data-id="<?=$row['id']?>">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											</td>
											<!-- <td><?php echo $row['notesupdate']; ?></td> -->
											<td>		<form action="" method="post">
																		
																	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															
															<?php if($row['statusContact'] == 0){
																?>
																<input type="hidden" name="statusContact" value="1">
																
																		<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="contact" class="js-user-disable">
															  Contact
															</button>
																<?php
															} 
															else if ($row['statusContact'] == 1){
																?>
																<input type="hidden" name="statusContact" value="2">
																		<button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable">
														 1st Contact
															</button>
																<?php
															} 

																else if ($row['statusContact'] == 2){
																?>
																<input type="hidden" name="statusContact" value="3">
																		<button style="padding: 1px 20px;border: none;background: #10b1ac;" type="submit" name="contact" class="js-user-disable">
													 2nd Contact
															</button>
																<?php
															} 

																else if ($row['statusContact'] == 3){
																?>
																<input type="hidden" name="statusContact" value="2">
																		<button style="padding: 1px 20px;border: none;background: #FFA500;" type="button" name="contact" class="js-user-disable">
															 3rd Contact
															</button>
																<?php
															} 
															?>
																	
															
																	
																	
																	</form></td>
											<td><a class="btn btn-danger rdbtn" onclick="return confirm('Are you sure?');" href="<?=base_url('general-sales-trash/'.$row['id'])?>">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
											</td>

											
												<td><div class="btn-group">
														<?php if ($row['is_verify'] == '0') { ?>
														<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
															Disabled
															<span class="caret"></span>
														</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="" method="post" style="margin: 0px;">
																<input type="hidden" name="email" value="<?=$row['email']?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="<?=$row['id']?>" id="enable"  class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Enable 
															</button>
															</form>
														</li>
													<?php } else { ?>

													<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
														Enabled
														<span class="caret"></span>
													</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="" method="post" style="margin: 0px;">
																<input type="hidden" name="email" value="<?=$row['email']?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="<?=$row['id']?>" id="disable" data-id="' . $val['id'] . '" class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Disable
															</button>
															</form>

														</li>
													<?php } ?>


													
														</li>
														<li>
								<a  class="gn-GenSales-edit"    data-toggle="modal" data-target="#testRecord1<?php echo $row['id']; ?>">
																	<i class="fa fa-edit"></i> edit provider
																</a>
															</li>
															<li>
																<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#sendmail<?php echo $row['id']; ?>"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> send mail
																</a>
															</li>
															<li>
																<form action="<?=base_url('general-sales-trash/'.$row['id'])?>" method="post">
															
																

																<span style="padding: 3px 20px;"><i class="fa fa-trash-o" aria-hidden="true"></i>
																	<input type="submit" value="delete provider" onclick="return confirm('Are you sure you want to delete?');" style="background: none; border: none;">
																</span>
															</form>	
															</li>
																<?php if($row['comp'] == 0) { ?> <li>
																	<a  href="#"   data-toggle="modal" data-target="#2weekComp<?php echo $row['id']; ?>">
																		 2 Week Comp
																	</a>
																</li> <?php }  ?>
																<li>
																	<form action="" method="post">
																		
																	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															
															<?php if($row['statusContact'] == 0){
																?>
																<input type="hidden" name="statusContact" value="1">
																
																		<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="contact" class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Contact
															</button>
																<?php
															} 
															else if ($row['statusContact'] == 1){
																?>
																<input type="hidden" name="statusContact" value="2">
																		<button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable">
															<i class="fa fa-minus-circle"></i> 1st Contact
															</button>
																<?php
															} 

																else if ($row['statusContact'] == 2){
																?>
																<input type="hidden" name="statusContact" value="3">
																		<button style="padding: 1px 20px;border: none;background: #10b1ac;" type="submit" name="contact" class="js-user-disable">
															<i class="fa fa-minus-circle"></i> 2nd Contact
															</button>
																<?php
															} 

																else if ($row['statusContact'] == 3){
																?>
																<input type="hidden" name="statusContact" value="2">
																		<button style="padding: 1px 20px;border: none;background: #FFA500;" type="button" name="contact" class="js-user-disable">
															 3rd Contact
															</button>
																<?php
															} 
															?>
																	
															
																	
																	
																	</form>
																</li>

															
													</ul>
												</div>
											</td>
							
										</tr>
										<div class="modal fade" id="testRecord1<?php echo $row['id']; ?>"  role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">General sales</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="user" method="post" action="<?php echo base_url(); ?>dashboard/general_sales" enctype="multipart/form-data" novalidate="novalidate">
					<div id="form-alerts">
					</div>
					<div class="row">
						<!-- <div class="updateadvr">
												</div> -->
												<input type="hidden" name="id" value="<?php  echo $row['id'] ; ?>">

        <div class="col-sm-6">
            <div class="form-group">
                <label>Location name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="location_name" autocomplete="off" value="<?php  echo $row['location_name'] ; ?>" placeholder="Please enter the location" type="text" required>
                </div>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="email" autocomplete="off" value="<?php echo  $row['email']; ?>" placeholder="Email address" type="text" readonly>
                </div>
            </div>
        </div>
		
		<div class="col-sm-6">
            <div class="form-group">
                <label>Contact</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="id"  value="<?php echo  $row['id']; ?>"  type="hidden">
                    <input class="form-control" name="contactno" autocomplete="off" value="<?php echo $row['contact_no'] ; ?>" placeholder="Please enter the contact no." type="text" required>
                </div>
            </div>
        </div>
		 <div class="col-sm-6">
            <div class="form-group ">
                <label>Zip code</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="zip" value="<?php echo $row['zip_code'] ; ?>" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>





	 <div class="col-sm-6">
            <div class="form-group ">
                <label>State</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="state" value="<?php echo $row['state'] ; ?>" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>

        	 <div class="col-sm-6">
            <div class="form-group ">
                <label>City</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="city" value="<?php echo $row['city'] ; ?>" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>


        	 <div class="col-sm-6">
            <div class="form-group ">
                <label>Provider type</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="provider_type" value="<?php echo $row['provider_type'] ; ?>" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>

        	 <div class="col-sm-6">
            <div class="form-group ">
                <label>2 week comp</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select class="form-control" name="comp" >
                    	<option <?php if($row['comp'] == 1) { echo "selected"; } ?> value="1" >Yes</option>
                    	   	<option <?php if($row['comp'] == 0) { echo "selected"; } ?> value="0" >No</option>
                    </select>
                   <!--  <input class="form-control" name="comp" value="<?php echo $row['comp'] ; ?>" autocomplete="off" placeholder="" type="text" required> -->
                </div>
            </div>
        </div>


					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="creatUserBottom creatUserBottom-2">
								<button type="submit" name="update" value="1" class="btn btn-success btn-green">Update</button>
								<button type="button" class="btn btn-warning btn-grey canclegeneral" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>


	<div class="modal fade" id="2weekComp<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header title-bar-orange">
															<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"> 2 Weeks Comp</h5>
															<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<!-- <form method="post" action="<?php echo base_url('sales/composemail');?>" enctype="multipart/form-data"> -->
																<div id="form-alerts"></div>
																<div class="row">
																	<div class="col-sm-12">
																		<div class="form-group">
																		<!-- 	<label>To</label> -->
																			<div class="input-group" style="width: 100%;">
																				<h2>Please remind client at end of 2 weeks provider panel will FREEZE unit account is activated by our sales Department</h2>
																			</div>
																		</div>
																		
																		
																	</div>

																</div><br>
																<div class="row modal-footer">
																	<div class="creatUserBottom ">
																		<input type="hidden" name="useremail" class="useremail" value="<?php echo $row['email']; ?>">
																		<button type="button"  data-id="<?=$row['id']?>"  data-email="<?=$row['email']?>"  class="btn-green compUpdate">Ok</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															<!-- </form> -->
														</div>
													</div>
												</div>
											</div>

 <div class="modal fade" id="sendmail<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('dashboard/twoweekCompEmail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php echo $row['email']; ?>" class="form-control" required="" >
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
									<input type="text" name="send_subject" value="Provider Email Notice" class="form-control" required="" readonly="">
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

									<?php } ?>
                                </tbody>
                            </table>
                            <input type="submit" class="btn btn-danger" value="Trash" name="booked">

                        </from>
                        </div>
                        </div>

						<div class="row">
						<div class="col-sm-6"><div class="dataTables_info" id="dataTables-example_info" role="status">Total Entires <?php echo $total_rows;?> entries</div>
						</div>
						<div class="col-sm-6">  <?php echo $links;?>
						</div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div><!--/row-->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->







<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">General sales</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--<form name="user" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/updateSales" novalidate="novalidate">-->
				<form name="user" method="post" action="">
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="updatepro">
							<!--/ajax call/-->
						</div>     
					</div><br>
					<div class="modal-footer">
						<div class="row">
							<button type="submit" name="update" class="btn btn-success btn-green">Update</button>
							<button type="submit"  class="btn btn-warning btn-grey" data-dismiss="modal" style="margin-top:0px;">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div>
</div> 
<div class="modal fade" id="editUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">General sales Note update</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<form name="user" method="post" action="<?php echo base_url('general-sales-update');?>">
					<div id="form-alerts">
					</div>
					<div class="updateNote" >
						
					</div><br>
					
				</form>
			</div>
		</div>  
	</div>
</div> 
<!-- bulk upload -->
<div class="modal fade" id="bulkGeneralSales" tabindex="-1" role="dialog" aria-labelledby="upload_storefornt" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Bulk Upload General Sales</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>]
			<div class="modal-body">
	 <form name="upload_storefornt"  method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/generalSalesBulkUpload'); ?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload File </label>
								<div class="input-group">
								<input name="image" type="file" class="form-control">
								</div>
								<a href="<?php echo base_url('uploads/uf_general_sale.csv');?>">Dowload Sample document</a>
							</div>
						</div>
					</div><br>
					<div class="row modal-footer">

						<div class="creatUserBottom creatUserBottom-2 ">
							<button type="submit" name="upload_data" value="upload_data" class="btn-green">Upload</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 <!-- end bulk upload -->


 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header title-bar-orange">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment</h4>
        </div>
        <div class="modal-body">
	
			<div align="center" style="margin: 20px;">
			<a href="<?= base_url()?>panels/supermacdaddy/sales/payment" class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">PayPal</a>
			<a href="<?= base_url()?>panels/supermacdaddy/sales/payment"  class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">Payoneer</a>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="emailModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header title-bar-orange">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Send Mail</h4>
        </div>
        <div class="modal-body">
        	<form name="user" method="post" action="<?php echo base_url('panels/supermacdaddy/sales/mailSendGeneralSales') ?>">
        	<div class="col-sm-12">
				<div class="form-group ">
	+
					<label>Sender Email</label>
					<input class="form-control email" name="email" autocomplete="off"  type="text" required="" readonly="">
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group ">
					<label>Email Subject</label>
					<input class="form-control " name="email_subject" autocomplete="off"  type="text"  required="" >
				</div>
			</div>
			  <div class="col-sm-12">
				<div class="form-group ">
					<label>Email Content</label>
					<textarea name="email_description" style="width: 100%;" rows="5" required=""></textarea>
				</div>
				</div>
        </div>
        <div class="modal-footer">
       <div class="" style="clear:both">
			<div class="creatUserBottom">
				<button type="submit" name='save' class="btn-green">Send Mail</button> 
				<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
			</div>
		</div>
        </div>
    </form>
      </div>
      
    </div>
  </div>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      // CKEDITOR.replace( 'email_description' );
      // CKEDITOR.replace( 'note' );

      


    </script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.emailSend').click(function(){
 			 var id =$(this).attr("data-id");
 			 $('.email').val(id);
 			 $('#emailModal').modal();
 		})

 	})

 		$(".compUpdate").click( function(){
		var id = $(this).attr('data-id');
		var useremail = $(this).attr('data-email');
		//var useremail = $('.useremail').val();
	var compStatus = 1;
		$.ajax({
		
			type: "POST",
        url: "https://medconnex.net/demonil/dashboard/general_sales/",             
        data:{id:id,compStatus:compStatus,useremail:useremail},   //expect html to be returned                
        success: function(response){ 
        	 //alert(response);
			     window.location.href = "https://medconnex.net/demonil/general-sales";
			    
				
			}
		});
	}); 
 </script>