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
    		<?php }?>
    	</div>
    </div>
 	<?php $this->load->view('sales_templates/new-sidebar'); ?>
	<div class="row-fluid sortable">		
		<div class="box span12">		
			<div class="row">
                <div class="col-lg-12">
                					  <ul class="nav nav-tabs" style="margin-bottom: 7px;border-bottom: 0px solid;">
								    <li style="margin-right: 5px;"><button type="button" class="storefront btn btn-success" >Storefront</button></li>
								    <li style="margin-right: 5px;"><button type="button" class="ondemand btn btn-success" >Ondemand</button></li>
									<li><button type="button" class="doctor btn btn-success">Industry Doctor</button></li>
								  </ul>

								 


				    <div class="panel panel-default">
	                    <div class="panel-heading title-bar-blue">
		                 	<p><i class="fa fa-shopping-cart" aria-hidden="true"></i> General Sales <span class="sectionName"></span></p>
		                </div> 
	                	<!-- /.panel-heading -->
                        <div class="panel-body">
                        		<div class="row">
	                        				<div class="col-sm-4">
					                			<form class="form-inline paginationResult" style="margin-bottom: -31px;" action="<?php echo base_url(); ?>sales-general-sales/" method="get" >
					                				<div class="form-group"> 
					                					<label>Show:</label>
					                					
						                					<select id="cars" name="limit" class="form-control" style="width: 150px;">
							                					<?php for ($i=1; $i <= $countData; $i++) { 
								                				?>
								                				<option <?php if(!empty($_REQUEST['limit'])) { ?> <?php if($_REQUEST['limit'] == $i){ echo "selected"; } ?> <?php } ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option>
								                				<?php
								                					} ?>
						                					</select>
						                				
					               						<input type="submit" id="submit" style="display: none;">
					               					</div>
					                			</form>
					                			<script type="text/javascript">
								                	$(document).ready(function() {
													   	$('#cars').on('change', function() {
													    $('#submit').click();
													   });
													});
								                </script>
								            </div>
								        </div>
								          <div  class="storefront1">
        		     	 	<form  method="post" action="<?php echo base_url('panels/supermacdaddy/sales/generalTrashAll');?>">
                        		<div class="table-responsive" >
                        			<!-- <div class="paginations col-sm-6">
                        			
			            			</div> -->
		                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example">
		                                <thead>
											<tr class="first-row">
												<th><input type="checkbox"  id="bookid"></th>
											 <th class="br-n">S.No.</th> 
											 <th class="br-n">Provider Id</th>
											 	<th class="br-n">Location Name</th>
												<th class="br-n">Email</th>
												<th class="br-n">Contact No.</th>
												<th class="br-n">Zip Code</th>
												<th class="br-n">State</th>
												<th class="br-n">City</th>
												<th class="br-n">Provider Type</th>
												<th class="br-n">Uploaded oN</th>
												<th class="br-n">Start Date/Time</th>
												<th class="br-n">End Date/Time</th>
												<th class="br-n">2 Week Comp</th>
												<th class="br-n">Notes</th>
												<th class="br-n">Contact</th>
												<th class="br-n">Trash</th>
												<th class="br-n">Actions</th>
											</tr>
		                                </thead>
		                                <tbody>
											<?php $i = 1;
												foreach ($storefronts as $row) {
												$id=$row['id'];
											?>

												<tr style="display: none;"><td class="sorting_1"><input type="checkbox" class="check" name="book[]" value="34"></td><td>1</td> <td>mdcN0Ji-thcsd420</td><td>THCSD</td><td>thcsd420@gmail.com</td><td>858-324-2420</td><td>92108</td><td>CA</td><td>San Diego</td><td>Store</td><td>24/01/19</td><td> </td><td> </td><td>No</td><td><a class="btn btn-info notes_genral" href="javascript:void(0);" data-toggle="modal" data-target="#note34"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td><td><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable">1st Contact</button></td><td><input type="hidden" name="id" value="34"><button type="button" name="delete" data-id="34" class="btn btn-danger trashData"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td><td><div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><form action="" method="post" style="margin: 0px;"><input type="hidden" name="email" value="thcsd420@gmail.com"><button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="34" id="disable" data-id="' . $val['id'] . '" class="js-user-disable"><i class="fa fa-minus-circle"></i>Disable</button></form></li><li><a class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord134"><i class="fa fa-edit"></i> Edit provider</a></li><li><a href="javascript:void(0);" data-id="34" data-target="#sendmail34" data-toggle="modal"><i class="fa fa-envelope-o"></i> Send mail</a></li><li><a href="javascript:;" data-toggle="modal" data-target="#payment34"><i class="fa fa-credit-card"></i> Payment</a></li><li><a href="#" data-toggle="modal" data-target="#2weekComp34">2 Week Comp</a></li><li><form action="" method="post"><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable"><i class="fa fa-minus-circle"></i> 1st Contact</button></form></li></ul></div></td></tr>







											<tr>
												<td><input type="checkbox" class="check" name="book[]" value="<?=$id?>" ></td>
												 <td><?php echo $i++; ?></td> 


												 <td><?php  $sql = "select randomId from uf_user where  email = '".$row['email']."'";
		$query = $this->db->query($sql);
		$res = $query->row();

												  echo $res->randomId; ?></td>
												<td><?php echo $row['location_name']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['contact_no']; ?></td>
												<td><?php echo $row['zip_code']; ?></td>
												<td><?php echo $row['state']; ?></td>
												<td><?php echo $row['city']; ?></td>
										<!-- 		<td><?php echo $row['provider_type']; ?></td> -->
											<td><?php echo 'Store'; ?>
												</td>
												<td><?php echo $row['create_date']; ?></td>
												<td><?php echo $row['compStartDate']; ?> <?php echo $row['comstartendtime']; ?></td>
												<!-- 	<td><?php echo $row['compEndDate']; ?> <?php echo $row['comstartendtime']; ?></td> -->
												<td><?php echo $row['compEndDate']; ?> <?php
												$selectedTime = $row['comstartendtime'];
													$endTime = strtotime("-1 minutes", strtotime($selectedTime));
													if(!empty($row['compEndDate'])){
														echo date('h:i:s', $endTime);

													}
													
												?></td>
												<td><?php if($row['comp'] == 1) { echo "Yes"; } else { echo "No"; }  ?></td>
												<td>
													<a class="btn btn-info notes_genral" href="javascript:void(0);"  data-toggle="modal" data-target="#note<?=$row['id']?>" >
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</a>
												</td>
												<td>			<form action="" method="post">
																		
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
												<td>
													<!-- <form action="<?php echo base_url('panels/supermacdaddy/sales/');?>" method="post" > -->
													<input type="hidden" name="id" value="<?=$row['id']?>">
													<button  type="button"  name="delete" data-id="<?=$row['id']?>"  class="btn btn-danger trashData">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
													<!-- 	</form> -->
												</td>
												<td>
													<div class="btn-group">
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
																<li>
																	<a  class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord1<?php echo $row['id']; ?>">
																		<i class="fa fa-edit"></i> Edit provider
																	</a>
																</li>
																<li>
																	<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#sendmail<?php echo $row['id']; ?>"  data-toggle="modal">
																		<i class="fa fa-envelope-o"></i> Send mail
																	</a>
																</li>
																<!-- 
																<li>
																	<a  class=""  href="javascript:;" data-id="<?php echo $row['ad_id']; ?>">
																		<i class="fa fa-book"></i> Notes
																	</a>
																</li> -->
																<li>
																	<a  href="javascript:;"    data-toggle="modal" data-target="#payment<?php echo $row['id']; ?>">
																		<i class="fa fa-credit-card"></i> Payment
																	</a>
																</li>
																<?php if($row['comp'] == 0) { ?> <li>
																	<a  href="#"   data-toggle="modal" data-target="#2weekComp<?php echo $row['id']; ?>">
																		 2 Week Comp
																	</a>
																</li> <?php }  ?>
																</li>
																
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
																<input type="hidden" name="statusContact" value="3">
																		<button style="padding: 1px 20px;border: none;background: #FFA500;" type="button" name="contact" class="js-user-disable">
															 3rd Contact
															</button>
																<?php
															} 
															?>
																	
															
																	
																	
																	</form>
																</li>
																<!-- <li>
																	<a class="" onclick="return confirm('Are you sure you want to delete?');" href="<?php echo base_url(); ?>panels/supermacdaddy/sales/<?php echo $row['id']; ?>">
																		<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
																	</a>
																</li> -->
															</ul>
														</ul>
													</div>
												</td>
											</tr>
											<div class="modal fade" id="note<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header title-bar-orange">
															<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Notes</h5>
															<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<!--<form name="user" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/updateSales" novalidate="novalidate">-->
															<form name="user" method="post" action="">
																<div id="form-alerts"></div>
																<!-- 	<div class="row"> -->
																<div class="form-group">
																	<input type="hidden" name="id" value="<?=$row['id']?>">
																	<label>Note</label>
																	<div class="input-group">
																		<textarea class="form-control ckeditor"  name="notes" rows="4" cols="10" style="width:530% !important; height:100%;"> <?=$row['notes']?> </textarea>
																	</div>
																</div>
																<!-- </div> -->
																<br>
																<div class="modal-footer">
																	<div class="row">
																		<button type="submit" name="updatenote" class="btn btn-success btn-green">Update</button>
																		<button type="submit"  class="btn btn-warning btn-grey" data-dismiss="modal" style="margin-top:0px;">Cancel</button>
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
																		<input type="hidden" name="useremail" class="useremail"  value="<?php echo $row['email']; ?>">
																		<button type="button"  data-id="<?=$row['id']?>"  data-email="<?=$row['email']?>"  class="btn-green compUpdate">Ok</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															<!-- </form> -->
														</div>
													</div>
												</div>
											</div>
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
															<form name="user" method="post" action="<?php echo base_url(); ?>sales/general_sales" enctype="multipart/form-data" novalidate="novalidate">
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
																		<div class="creatUserBottom sss">
																			<button type="submit" name="update" value="1" class="btn btn-success btn-green">Update</button>
																			<button type="button" class="btn btn-warning btn-grey canclegeneral" data-dismiss="modal" >Cancel</button>
																		</div>
																	</div>
																</div>
															</form>
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
															<form method="post" action="<?php echo base_url('sales/twoweekCompEmail');?>" enctype="multipart/form-data">
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
																				<textarea class="ckeditor" id="composmail" name="send_message" rows="4" ></textarea>

																			</div>
																		</div>
																		
																	</div>

																</div><br>
																<div class="row modal-footer">
																	<div class="creatUserBottom ">
																		<button type="submit"  class="btn-green">Send Message</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="payment<?php echo $row['id']; ?>" role="dialog">
											    <div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Payment</h4>
														</div>
														<div class="modal-body">
															<div align="center" style="margin: 20px;">
																<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment" class="btn-green" style="color:#fff;padding: 11px 46px ;margin: 20px;">PayPal</a>
															<!-- 	<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment"  class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">Payoneer</a> -->
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
											    </div>
											</div>
											<?php } ?>
		                                </tbody>
		                            </table>
		                            <input type="submit" class="btn btn-danger" value="Trash" name="booked">
		                        </div>
	                        </form>
	                    </div>
<!--  end storefront -->
<div  class="ondemand1">
		     	 	<form  method="post" action="<?php echo base_url('panels/supermacdaddy/sales/generalTrashAll');?>">
                        		<div class="table-responsive" >
                        			<!-- <div class="paginations col-sm-6">
                        			
			            			</div> -->
		                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example1">
		                                <thead>
											<tr class="first-row">
												<th><input type="checkbox"  id="bookid"></th>
											 <th class="br-n">S.No.</th> 
											 <th class="br-n">Provider Id</th>
											 	<th class="br-n">Location Name</th>
												<th class="br-n">Email</th>
												<th class="br-n">Contact No.</th>
												<th class="br-n">Zip Code</th>
												<th class="br-n">State</th>
												<th class="br-n">City</th>
												<th class="br-n">Provider Type</th>
												<th class="br-n">Uploaded oN</th>
												<th class="br-n">Start Date/Time</th>
												<th class="br-n">End Date/Time</th>
												<th class="br-n">2 Week Comp</th>
												<th class="br-n">Notes</th>
												<th class="br-n">Contact</th>
												<th class="br-n">Trash</th>
												<th class="br-n">Actions</th>
											</tr>
		                                </thead>
		                                <tbody>
											<?php $i = 1;
												foreach ($ondemands as $row) {
												$id=$row['id'];
											?>

												<tr style="display: none;"><td class="sorting_1"><input type="checkbox" class="check" name="book[]" value="34"></td><td>1</td> <td>mdcN0Ji-thcsd420</td><td>THCSD</td><td>thcsd420@gmail.com</td><td>858-324-2420</td><td>92108</td><td>CA</td><td>San Diego</td><td>Store</td><td>24/01/19</td><td> </td><td> </td><td>No</td><td><a class="btn btn-info notes_genral" href="javascript:void(0);" data-toggle="modal" data-target="#note34"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td><td><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable">1st Contact</button></td><td><input type="hidden" name="id" value="34"><button type="button" name="delete" data-id="34" class="btn btn-danger trashData"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td><td><div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><form action="" method="post" style="margin: 0px;"><input type="hidden" name="email" value="thcsd420@gmail.com"><button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="34" id="disable" data-id="' . $val['id'] . '" class="js-user-disable"><i class="fa fa-minus-circle"></i>Disable</button></form></li><li><a class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord134"><i class="fa fa-edit"></i> Edit provider</a></li><li><a href="javascript:void(0);" data-id="34" data-target="#sendmail34" data-toggle="modal"><i class="fa fa-envelope-o"></i> Send mail</a></li><li><a href="javascript:;" data-toggle="modal" data-target="#payment34"><i class="fa fa-credit-card"></i> Payment</a></li><li><a href="#" data-toggle="modal" data-target="#2weekComp34">2 Week Comp</a></li><li><form action="" method="post"><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable"><i class="fa fa-minus-circle"></i> 1st Contact</button></form></li></ul></div></td></tr>







											<tr>
												<td><input type="checkbox" class="check" name="book[]" value="<?=$id?>" ></td>
												 <td><?php echo $i++; ?></td> 


												 <td><?php  $sql = "select randomId from uf_user where  email = '".$row['email']."'";
													$query = $this->db->query($sql);
													$res = $query->row();

												  echo $res->randomId; ?></td>
												<td><?php echo $row['location_name']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['contact_no']; ?></td>
												<td><?php echo $row['zip_code']; ?></td>
												<td><?php echo $row['state']; ?></td>
												<td><?php echo $row['city']; ?></td>
										<!-- 		<td><?php echo $row['provider_type']; ?></td> -->
											<td>
												<?php 
													echo 'On-Demand';
												

												?></td>
												<td><?php echo $row['create_date']; ?></td>
												<td><?php echo $row['compStartDate']; ?> <?php echo $row['comstartendtime']; ?></td>
												<!-- 	<td><?php echo $row['compEndDate']; ?> <?php echo $row['comstartendtime']; ?></td> -->
												<td><?php echo $row['compEndDate']; ?> <?php
												$selectedTime = $row['comstartendtime'];
													$endTime = strtotime("-1 minutes", strtotime($selectedTime));
													if(!empty($row['compEndDate'])){
														echo date('h:i:s', $endTime);

													}
													
												?></td>
												<td><?php if($row['comp'] == 1) { echo "Yes"; } else { echo "No"; }  ?></td>
												<td>
													<a class="btn btn-info notes_genral" href="javascript:void(0);"  data-toggle="modal" data-target="#note<?=$row['id']?>" >
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</a>
												</td>
												<td>			<form action="" method="post">
																		
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
												<td>
													<!-- <form action="<?php echo base_url('panels/supermacdaddy/sales/');?>" method="post" > -->
													<input type="hidden" name="id" value="<?=$row['id']?>">
													<button  type="button"  name="delete" data-id="<?=$row['id']?>"  class="btn btn-danger trashData">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
													<!-- 	</form> -->
												</td>
												<td>
													<div class="btn-group">
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
																<li>
																	<a  class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord1<?php echo $row['id']; ?>">
																		<i class="fa fa-edit"></i> Edit provider
																	</a>
																</li>
																<li>
																	<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#sendmail<?php echo $row['id']; ?>"  data-toggle="modal">
																		<i class="fa fa-envelope-o"></i> Send mail
																	</a>
																</li>
																<!-- 
																<li>
																	<a  class=""  href="javascript:;" data-id="<?php echo $row['ad_id']; ?>">
																		<i class="fa fa-book"></i> Notes
																	</a>
																</li> -->
																<li>
																	<a  href="javascript:;"    data-toggle="modal" data-target="#payment<?php echo $row['id']; ?>">
																		<i class="fa fa-credit-card"></i> Payment
																	</a>
																</li>
																<?php if($row['comp'] == 0) { ?> <li>
																	<a  href="#"   data-toggle="modal" data-target="#2weekComp<?php echo $row['id']; ?>">
																		 2 Week Comp
																	</a>
																</li> <?php }  ?>
																</li>
																
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
																<input type="hidden" name="statusContact" value="3">
																		<button style="padding: 1px 20px;border: none;background: #FFA500;" type="button" name="contact" class="js-user-disable">
															 3rd Contact
															</button>
																<?php
															} 
															?>
																	
															
																	
																	
																	</form>
																</li>
																<!-- <li>
																	<a class="" onclick="return confirm('Are you sure you want to delete?');" href="<?php echo base_url(); ?>panels/supermacdaddy/sales/<?php echo $row['id']; ?>">
																		<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
																	</a>
																</li> -->
															</ul>
														</ul>
													</div>
												</td>
											</tr>
											<div class="modal fade" id="note<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header title-bar-orange">
															<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Notes</h5>
															<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<!--<form name="user" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/updateSales" novalidate="novalidate">-->
															<form name="user" method="post" action="">
																<div id="form-alerts"></div>
																<!-- 	<div class="row"> -->
																<div class="form-group">
																	<input type="hidden" name="id" value="<?=$row['id']?>">
																	<label>Note</label>
																	<div class="input-group">
																		<textarea class="form-control ckeditor"  name="notes" rows="4" cols="10" style="width:530% !important; height:100%;"> <?=$row['notes']?> </textarea>
																	</div>
																</div>
																<!-- </div> -->
																<br>
																<div class="modal-footer">
																	<div class="row">
																		<button type="submit" name="updatenote" class="btn btn-success btn-green">Update</button>
																		<button type="submit"  class="btn btn-warning btn-grey" data-dismiss="modal" style="margin-top:0px;">Cancel</button>
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
																		<input type="hidden" name="useremail" class="useremail"  value="<?php echo $row['email']; ?>">
																		<button type="button"  data-id="<?=$row['id']?>"  data-email="<?=$row['email']?>"  class="btn-green compUpdate">Ok</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															<!-- </form> -->
														</div>
													</div>
												</div>
											</div>
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
															<form name="user" method="post" action="<?php echo base_url(); ?>sales/general_sales" enctype="multipart/form-data" novalidate="novalidate">
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
																		<div class="creatUserBottom sss">
																			<button type="submit" name="update" value="1" class="btn btn-success btn-green">Update</button>
																			<button type="button" class="btn btn-warning btn-grey canclegeneral" data-dismiss="modal" >Cancel</button>
																		</div>
																	</div>
																</div>
															</form>
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
															<form method="post" action="<?php echo base_url('sales/twoweekCompEmail');?>" enctype="multipart/form-data">
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
																				<textarea class="ckeditor" id="composmail" name="send_message" rows="4" ></textarea>

																			</div>
																		</div>
																		
																	</div>

																</div><br>
																<div class="row modal-footer">
																	<div class="creatUserBottom ">
																		<button type="submit"  class="btn-green">Send Message</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="payment<?php echo $row['id']; ?>" role="dialog">
											    <div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Payment</h4>
														</div>
														<div class="modal-body">
															<div align="center" style="margin: 20px;">
																<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment" class="btn-green" style="color:#fff;padding: 11px 46px ;margin: 20px;">PayPal</a>
															<!-- 	<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment"  class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">Payoneer</a> -->
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
											    </div>
											</div>
											<?php } ?>
		                                </tbody>
		                            </table>
		                            <input type="submit" class="btn btn-danger" value="Trash" name="booked">
		                        </div>
	                        </form>

</div>
<!--  end ondemand -->

<div  class="doctor1">
	
		     	 	<form  method="post" action="<?php echo base_url('panels/supermacdaddy/sales/generalTrashAll');?>">
                        		<div class="table-responsive" >
                        			<!-- <div class="paginations col-sm-6">
                        			
			            			</div> -->
		                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example2">
		                                <thead>
											<tr class="first-row">
												<th><input type="checkbox"  id="bookid"></th>
											 <th class="br-n">S.No.</th> 
											 <th class="br-n">Provider Id</th>
											 	<th class="br-n">Location Name</th>
												<th class="br-n">Email</th>
												<th class="br-n">Contact No.</th>
												<th class="br-n">Zip Code</th>
												<th class="br-n">State</th>
												<th class="br-n">City</th>
												<th class="br-n">Provider Type</th>
												<th class="br-n">Uploaded oN</th>
												<th class="br-n">Start Date/Time</th>
												<th class="br-n">End Date/Time</th>
												<th class="br-n">2 Week Comp</th>
												<th class="br-n">Notes</th>
												<th class="br-n">Contact</th>
												<th class="br-n">Trash</th>
												<th class="br-n">Actions</th>
											</tr>
		                                </thead>
		                                <tbody>
											<?php $i = 1;
												foreach ($doctors as $row) {
												$id=$row['id'];
											?>

												<tr style="display: none;"><td class="sorting_1"><input type="checkbox" class="check" name="book[]" value="34"></td><td>1</td> <td>mdcN0Ji-thcsd420</td><td>THCSD</td><td>thcsd420@gmail.com</td><td>858-324-2420</td><td>92108</td><td>CA</td><td>San Diego</td><td>Store</td><td>24/01/19</td><td> </td><td> </td><td>No</td><td><a class="btn btn-info notes_genral" href="javascript:void(0);" data-toggle="modal" data-target="#note34"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td><td><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable">1st Contact</button></td><td><input type="hidden" name="id" value="34"><button type="button" name="delete" data-id="34" class="btn btn-danger trashData"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td><td><div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><form action="" method="post" style="margin: 0px;"><input type="hidden" name="email" value="thcsd420@gmail.com"><button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="34" id="disable" data-id="' . $val['id'] . '" class="js-user-disable"><i class="fa fa-minus-circle"></i>Disable</button></form></li><li><a class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord134"><i class="fa fa-edit"></i> Edit provider</a></li><li><a href="javascript:void(0);" data-id="34" data-target="#sendmail34" data-toggle="modal"><i class="fa fa-envelope-o"></i> Send mail</a></li><li><a href="javascript:;" data-toggle="modal" data-target="#payment34"><i class="fa fa-credit-card"></i> Payment</a></li><li><a href="#" data-toggle="modal" data-target="#2weekComp34">2 Week Comp</a></li><li><form action="" method="post"><input type="hidden" name="id" value="34"><input type="hidden" name="statusContact" value="2"><button style="padding: 1px 20px;border: none;background: #e03d80;" type="submit" name="contact" class="js-user-disable"><i class="fa fa-minus-circle"></i> 1st Contact</button></form></li></ul></div></td></tr>







											<tr>
												<td><input type="checkbox" class="check" name="book[]" value="<?=$id?>" ></td>
												 <td><?php echo $i++; ?></td> 


												 <td><?php  $sql = "select randomId from uf_user where  email = '".$row['email']."'";
		$query = $this->db->query($sql);
		$res = $query->row();

												  echo $res->randomId; ?></td>
												<td><?php echo $row['location_name']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['contact_no']; ?></td>
												<td><?php echo $row['zip_code']; ?></td>
												<td><?php echo $row['state']; ?></td>
												<td><?php echo $row['city']; ?></td>
										<!-- 		<td><?php echo $row['provider_type']; ?></td> -->
											<td>
												<?php 
													echo 'Doctor';

												?></td>
												<td><?php echo $row['create_date']; ?></td>
												<td><?php echo $row['compStartDate']; ?> <?php echo $row['comstartendtime']; ?></td>
												<!-- 	<td><?php echo $row['compEndDate']; ?> <?php echo $row['comstartendtime']; ?></td> -->
												<td><?php echo $row['compEndDate']; ?> <?php
												$selectedTime = $row['comstartendtime'];
													$endTime = strtotime("-1 minutes", strtotime($selectedTime));
													if(!empty($row['compEndDate'])){
														echo date('h:i:s', $endTime);

													}
													
												?></td>
												<td><?php if($row['comp'] == 1) { echo "Yes"; } else { echo "No"; }  ?></td>
												<td>
													<a class="btn btn-info notes_genral" href="javascript:void(0);"  data-toggle="modal" data-target="#note<?=$row['id']?>" >
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</a>
												</td>
												<td>			<form action="" method="post">
																		
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
												<td>
													<!-- <form action="<?php echo base_url('panels/supermacdaddy/sales/');?>" method="post" > -->
													<input type="hidden" name="id" value="<?=$row['id']?>">
													<button  type="button"  name="delete" data-id="<?=$row['id']?>"  class="btn btn-danger trashData">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
													<!-- 	</form> -->
												</td>
												<td>
													<div class="btn-group">
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
																<li>
																	<a  class="gn-GenSales-edit" data-toggle="modal" data-target="#testRecord1<?php echo $row['id']; ?>">
																		<i class="fa fa-edit"></i> Edit provider
																	</a>
																</li>
																<li>
																	<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#sendmail<?php echo $row['id']; ?>"  data-toggle="modal">
																		<i class="fa fa-envelope-o"></i> Send mail
																	</a>
																</li>
																<!-- 
																<li>
																	<a  class=""  href="javascript:;" data-id="<?php echo $row['ad_id']; ?>">
																		<i class="fa fa-book"></i> Notes
																	</a>
																</li> -->
																<li>
																	<a  href="javascript:;"    data-toggle="modal" data-target="#payment<?php echo $row['id']; ?>">
																		<i class="fa fa-credit-card"></i> Payment
																	</a>
																</li>
																<?php if($row['comp'] == 0) { ?> <li>
																	<a  href="#"   data-toggle="modal" data-target="#2weekComp<?php echo $row['id']; ?>">
																		 2 Week Comp
																	</a>
																</li> <?php }  ?>
																</li>
																
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
																<input type="hidden" name="statusContact" value="3">
																		<button style="padding: 1px 20px;border: none;background: #FFA500;" type="button" name="contact" class="js-user-disable">
															 3rd Contact
															</button>
																<?php
															} 
															?>
																	
															
																	
																	
																	</form>
																</li>
																<!-- <li>
																	<a class="" onclick="return confirm('Are you sure you want to delete?');" href="<?php echo base_url(); ?>panels/supermacdaddy/sales/<?php echo $row['id']; ?>">
																		<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
																	</a>
																</li> -->
															</ul>
														</ul>
													</div>
												</td>
											</tr>
											<div class="modal fade" id="note<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header title-bar-orange">
															<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Notes</h5>
															<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<!--<form name="user" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/updateSales" novalidate="novalidate">-->
															<form name="user" method="post" action="">
																<div id="form-alerts"></div>
																<!-- 	<div class="row"> -->
																<div class="form-group">
																	<input type="hidden" name="id" value="<?=$row['id']?>">
																	<label>Note</label>
																	<div class="input-group">
																		<textarea class="form-control ckeditor"  name="notes" rows="4" cols="10" style="width:530% !important; height:100%;"> <?=$row['notes']?> </textarea>
																	</div>
																</div>
																<!-- </div> -->
																<br>
																<div class="modal-footer">
																	<div class="row">
																		<button type="submit" name="updatenote" class="btn btn-success btn-green">Update</button>
																		<button type="submit"  class="btn btn-warning btn-grey" data-dismiss="modal" style="margin-top:0px;">Cancel</button>
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
																		<input type="hidden" name="useremail" class="useremail"  value="<?php echo $row['email']; ?>">
																		<button type="button"  data-id="<?=$row['id']?>"  data-email="<?=$row['email']?>"  class="btn-green compUpdate">Ok</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															<!-- </form> -->
														</div>
													</div>
												</div>
											</div>
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
															<form name="user" method="post" action="<?php echo base_url(); ?>sales/general_sales" enctype="multipart/form-data" novalidate="novalidate">
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
																		<div class="creatUserBottom sss">
																			<button type="submit" name="update" value="1" class="btn btn-success btn-green">Update</button>
																			<button type="button" class="btn btn-warning btn-grey canclegeneral" data-dismiss="modal" >Cancel</button>
																		</div>
																	</div>
																</div>
															</form>
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
															<form method="post" action="<?php echo base_url('sales/twoweekCompEmail');?>" enctype="multipart/form-data">
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
																				<textarea class="ckeditor" id="composmail" name="send_message" rows="4" ></textarea>

																			</div>
																		</div>
																		
																	</div>

																</div><br>
																<div class="row modal-footer">
																	<div class="creatUserBottom ">
																		<button type="submit"  class="btn-green">Send Message</button>
																		<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="payment<?php echo $row['id']; ?>" role="dialog">
											    <div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Payment</h4>
														</div>
														<div class="modal-body">
															<div align="center" style="margin: 20px;">
																<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment" class="btn-green" style="color:#fff;padding: 11px 46px ;margin: 20px;">PayPal</a>
															<!-- 	<a href="<?= base_url() ?>panels/supermacdaddy/sales/payment"  class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">Payoneer</a> -->
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
											    </div>
											</div>
											<?php } ?>
		                                </tbody>
		                            </table>
		                            <input type="submit" class="btn btn-danger" value="Trash" name="booked">
		                        </div>
	                        </form>
</div>
<!--  end doctor -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<!--/row-->
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
<!-- bulk upload -->
<div class="modal fade" id="bulkGeneralSales" tabindex="-1" role="dialog" aria-labelledby="upload_storefornt" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Bulk Upload General Sales</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
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
						<div class="creatUserBottom ">
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
	        <form name="user" method="post" action="<?php echo base_url('panels/supermacdaddy/sales/mailSendGeneralSales') ?>">
		    	<div class="modal-body">
	        		<div class="col-sm-12">
						<div class="form-group ">
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript">
	$(".trashData").click( function(){
		var id = $(this).attr('data-id');

		$.ajax({
		
			type: "POST",
        url: "https://medconnex.net/demonil/sales/generalTrash/",             
        data:{id:id},   //expect html to be returned                
        success: function(response){ 
        	 //alert(response);
			     window.location.href = "https://medconnex.net/demonil/sales-general-sales";
			    
				
			}
		});
	}); 

	$(".compUpdate").click( function(){
		var id = $(this).attr('data-id');
			var useremail = $(this).attr('data-email');
		
		///var useremail = $('.useremail').val();
		///alert(useremail);
	var compStatus = 1;
		$.ajax({
		
			type: "POST",
        url: "https://medconnex.net/demonil/sales/general_sales/",             
        data:{id:id,compStatus:compStatus,useremail:useremail},   //expect html to be returned                
        success: function(response){ 
        	// alert(response);
			     window.location.href = "<?php echo base_url(); ?>sales-general-sales";
			    
				
			}
		});
	}); 


	</script>
<!-- 	<script type="text/javascript">
			$(document).on('click', '#testRecord1', function () {
		var id = $(this).attr("data-id");
//alert(id);
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>sales/edit_general_sale",
			data: "&id=" + id,
			success: function (response) {
				//console.log(response['id']);
				$(".updateadvr").html(response);
				$('#editadv1').modal('show');
				// $(".datetimepicker4").datepicker({
				// 	format: 'yyyy-mm-dd',
				// 	autoclose: true,
				// });
			}

		});
	});
	</script> -->


<!-- 	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> -->
 <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<!-- <script>
      CKEDITOR.replace("notes");

    </script> -->
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false
    } );
} );


$(document).ready(function() {
    $('#example1').DataTable( {
        "paging":   false
    } );
} );
$(document).ready(function() {
    $('#example2').DataTable( {
        "paging":   false
    } );
} );


$(document).ready(function(){

	$('.sectionName').append('Storefront');
	$('.ondemand1').css('display','none');
		$('.doctor1').css('display','none');

})


$('.storefront').click(function(){
		$('.sectionName').empty();

	$('.sectionName').append('Storefront');
		$('.paginationResult').css('display','block');
	$('.storefront1').css('display','block');
$('.ondemand1').css('display','none');
		$('.doctor1').css('display','none');

})



$('.ondemand').click(function(){
		$('.sectionName').empty();
	$('.sectionName').append('On-Demand');

	
	$('.paginationResult').css('display','none');
	
	$('.storefront1').css('display','none');
$('.ondemand1').css('display','block');
		$('.doctor1').css('display','none');

})



$('.doctor').click(function(){
	$('.sectionName').empty();
	$('.sectionName').append('Doctor');

		$('.paginationResult').css('display','none');

	$('.storefront1').css('display','none');
$('.ondemand1').css('display','none');
		$('.doctor1').css('display','block');

})
</script>