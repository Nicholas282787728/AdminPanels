<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
		</div>
	</div>
	<style>
		label.error{
			color:red;
			font-size: 11px;
		}
	</style>
	
	<div class="row">
		
		<div class="col-lg-12">
			<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			?>
						<?php 
		 $this->load->view('admin/top_tab_header');
	?>
</div>
         <div class="box span12 col-md-12" style="padding-bottom: 8px;">
		  <button type="button" id="faqAddSection" class="btn btn-success">Add Referral Code</button> 	<button type="button" id="faqShowSection" class="btn btn-success">Enteries</button>
	</div>

	

			<div class="col-md-12 faqAddSection" >
	
				<div class="panel panel-default">
			<!-- 	<div class="panel-heading" style="font-weight:bold;">
					<i class="fa fa-edit"></i> Referral Code
				</div> -->
				<div class="panel-body">
				<!-- 	<?php 
					$userId = $this->session->userdata('id');


					 ?> -->
					<form  method="post" enctype="multipart/form-data" action="" novalidate="novalidate">
					
						<input type="hidden" name="userId" value="<?php echo $userId; ?>">
						<div id="form-alerts"></div>
						<div class="row">
						<!-- 	<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Ad Referral Code</label>
										<input class="form-control" name="referralCode"   type="text">
									</div>
								</div>
								              
							</div> -->
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Description</label>
										<input class="form-control" name="description" maxlength="75"  type="text">
									</div>
								</div>
								              
							</div>
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Amount</label>
										<input class="form-control" name="amount"   type="text">
									</div>
								</div>
								              
							</div>
						</div><br>
						<div class="row">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
						
												<button type="submit" name="save" class="btn-green">Save</button>
								
									</div>          
								</div>

								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey cancel"  >Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>


			</div>
					<div class="col-md-12 faqShowSection">
	
				<div class="panel panel-primary">
					<!-- <div class="panel-heading panel-heading-buttons clearfix title-bar-green">
						<h3 class="panel-title pull-left"><i class="fa fa-cut"></i> R Codes </h3>
					</div> -->
					<div class="panel-body">
						<!-- <button type="button" class="btn-green js-code-create" data-toggle="modal" data-target="#exampleModal"> Create New Code </button> -->

						<div class="table-responsive">
							<table width="100%" class="table table-striped table-bordered table-hover medconnex11" id="dataTables-example">
								<thead>
									<tr class="first-row">
										  <th>Date</th>
                                        <!-- <th>Ad Referral Code</th> -->
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <!-- <th>Status</th> -->
                                        <th style="width: 200px !important"> Actions </th>
                                    </tr>
								</thead>
								<tbody aria-live="polite" aria-relevant="all">
									<?php
									//echo "<pre>"; print_r($getReferralCode);
									foreach ($getReferralCode as $val) {
											?>
											<tr>
												<td><?php echo $val['date']; ?></td>
								<!-- 		<td><?php echo $val['referralCode']; ?></td> -->
										<td><?php echo $val['description']; ?></td>
										<td><?php echo $val['amount']; ?></td>
										<!-- <td><?php if ($val['status'] == 1){
												?>
		Active
												<?php
											}
											else{
												?>
												Deactivate
												<?php
											} ?></td> -->
									<!-- 	<td><?php if ($val['status'] == 1){
												?>
												<form action="https://medconnex.net/demonil/referralCode/" method="post" style="text-align: center; ">
													<input type="hidden" name="status" value="0">
													<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
													<button type="submit" name="statusUpdate">Change status</button>
												</form>

												<?php
											}
											else{
												?>
											<form action="https://medconnex.net/demonil/referralCode/" method="post" style="text-align: center; ">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
													<button type="submit" name="statusUpdate">Change status</button>
												</form>
												<?php
											} ?>
										</td> -->
										<td><div class="btn-group">
														<?php if ($val['status'] == '0') { ?>
														<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
															Deactivate
															<span class="caret"></span>
														</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<a  data-toggle="modal" data-target="#editreferralCode<?php echo $val['id']; ?>">
																	<i class="fa fa-edit"></i> edit 
																</a>
														</li>
														<li>
															<form action="<?php echo base_url(); ?>referralCode/" method="post" style="margin: 0px;">
																<input type="hidden" name="status" value="1">
													<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="statusUpdate"   class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Activate 
															</button>
															</form>
															<li>
																<form action="<?php echo base_url(); ?>referralCode/" method="post" style="margin: 0px;">
																
													<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm('Are you sure you want to delete this item?');" type="submit" name="DeleteReferral"   class="js-user-disable">
															<i class="fa fa-trash-o"></i>  Delete 
															</button>
															</form>
																
															</li>
														</li>

													<?php } else { ?>

													<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
														Activate
														<span class="caret"></span>
													</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<a  data-toggle="modal" data-target="#editreferralCode<?php echo $val['id']; ?>">
																	<i class="fa fa-edit"></i> edit 
																</a>
														</li>
														<li>
															<form action="<?php echo base_url(); ?>referralCode/" method="post" style="margin: 0px;">
																<input type="hidden" name="status" value="0">
													<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="statusUpdate"  class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Deactivate
															</button>
															</form>

														</li> 
												


													
														</li>
														
													</ul>

											



  
  

														<?php } ?>
												</div>
											</td>
									</tr>
									<!-- Modal -->

								
  <div class="modal fade" id="editreferralCode<?php echo $val['id']; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Referral Code Update</h4>
        </div>
        <div class="modal-body">
          	<form  method="post" enctype="multipart/form-data" action="" novalidate="novalidate">
					
						<input type="hidden" name="userId" value="<?php echo $userId; ?>">
						<div id="form-alerts"></div>
						<div class="row">
						<!-- 	<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Ad Referral Code</label>
										<input class="form-control" name="referralCode"  value="<?php echo $val['referralCode']; ?>"  type="text">
									</div>
								</div>
								              
							</div> -->
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Description</label>
										<input class="form-control" name="description" maxlength="75" value="<?php echo $val['description']; ?>"  type="text">
									</div>
								</div>
								              
							</div>
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Amount</label>
										<input class="form-control" name="amount" value="<?php echo $val['amount']; ?>"   type="text">
										<input class="form-control" name="id" value="<?php echo $val['id']; ?>"   type="hidden">
									</div>
								</div>
								              
							</div>
						</div><br>
						<div class="row">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
						
												<button type="submit" name="update"  class="btn-green">Update</button>
								
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

										<?php
										
						}
						
					
					?>
								</tbody>
							</table>
						</div>
					<!-- 	<div class="row">
							<div class="col-md-6 ">
								<button type="button" class="btn-green js-code-create" data-toggle="modal" data-target="#exampleModal"> Create New Code
								</button>
							</div>
						</div> -->
					</div>
				
		</div>
		
	
		</div>
		


		
		
	
	</div>
</div>
	<!-- Modal -->

	<!-- EDIT PROMO CODE MODAL -->
	<script type="text/javascript">
$('.btn-grey.cancel').click(function(){

	$('#faqShowSection').trigger('click');
});

			$(document).ready(function(){
		$('.faqAddSection').css('display','none');

		$('#faqAddSection').click(function(){
			$('.faqAddSection').css('display','block');
			$('.faqShowSection').css('display','none');

		})

		$('#faqShowSection').click(function(){
			$('.faqAddSection').css('display','none');
			$('.faqShowSection').css('display','block');

		})

	})
	</script>
