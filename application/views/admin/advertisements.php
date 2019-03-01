
<style type="text/css">
    .right-upload-box {
      padding-top: 10px;
    }  
    </style>
    
 <div id="page-wrapper">
	 <?php 
		 $this->load->view('admin/top_tab_header');
	?>
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
    <!-- Main content -->
   <div class="row-fluid sortable">		
				<div class="box span12">
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                          <div class="panel-heading title-bar-blue">
	                    <p><i class="fa fa-file" aria-hidden="true"></i> Advertisement Sales</p>
	                     </div> <!-- /.panel-heading -->
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                        	<div class="table-responsive">
                           <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="dataTables-example">
                                <thead>
								 <tr class="first-row">
							   <!--     <th class="br-n">S.No.</th> -->
							   
							     <th class="br-n">Contractor Name</th>
							         <th class="br-n">Email</th>
							         <th class="br-n">Phone</th>
								  <th class="br-n">Ad Type</th>
								   <th class="br-n">Payment submitted</th> 
								    <th class="br-n">Date & Time</th> 
								  <th class="br-n">File</th> 
								  <th class="br-n" >Status </th>
								  <th class="br-n" >Actions</th> 
								
							  </tr>
                                </thead>
                                <tbody>
							<?php $i='1';
							// echo "<pre>"; print_r($advertisements);
							// die();

							 foreach ($advertisements as $row) { ?>
					          <tr>
							<!--   	<td><?php echo $i++; ?></td> -->
							<td><?php echo $row['providername']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td></td>
								<td><?php echo $row['ad_type']; ?></td>
								<td>No</td>
                     <!--      <td><?php echo $row['description']; ?></td> -->
                          <td><?php echo $row['insert_date']; ?></td>
                                 <td>
                                 	<img width="150px" src="https://medconnex.net/demonil/uploads/<?php echo $row['ad_image']; ?>"></td>
                                 	<td><?php if($row['status'] == 1){ echo 'Approved'; } else { echo 'Disapproved'; } ?></td>
								<!-- 	<td><?php if ($row['status'] == 1){
												?>
												<form action="https://medconnex.net/demonil/Dashboard/advertisements/" method="post" style="text-align: center; ">
													<input type="hidden" name="status" value="0">
													
													<input type="hidden" name="userEmail" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">
													<button type="submit" name="statusUpdate" class="btn btn-warning">Disapprove</button>
												</form>

												<?php
											}
											else{
												?>
											<form action="https://medconnex.net/demonil/Dashboard/advertisements/" method="post" style="text-align: center; ">
													<input type="hidden" name="status" value="1">
														<input type="hidden" name="userEmail" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">

													<button type="submit" name="statusUpdate" class="btn btn-success">Approve</button>
												</form>
												<?php
											} ?></td> -->

												<td><div class="btn-group">
														<?php if ($row['status'] == '0') { ?>
														<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
															Denied
															<span class="caret"></span>
														</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="https://medconnex.net/demonil/Dashboard/advertisements/" method="post" style="text-align: center; ">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">
													<input type="hidden" name="ad_type" value="<?php echo $row['ad_type']; ?>">
													
														<input type="hidden" name="userEmail" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">
												<!-- 	<button type="submit" name="statusUpdate" class="btn btn-warning">Disapprove</button> -->
												
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="statusUpdate"  class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Approve 
															</button>
															</form>
														</li>
													<?php } else { ?>

													<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
														Approve
														<span class="caret"></span>
													</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
																<form action="https://medconnex.net/demonil/Dashboard/advertisements/" method="post" style="text-align: center; ">
															<input type="hidden" name="status" value="0">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">
													<input type="hidden" name="ad_type" value="<?php echo $row['ad_type']; ?>">
													<input type="hidden" name="userEmail" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
													<input type="hidden" name="created_by" value="<?php echo $row['created_by']; ?>">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="statusUpdate"  class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Denied
															</button>
															</form>

														</li>
													<?php } ?>

								
							</tr>
							<?php } ?>
							 
                                </tbody>
                            </table>
                        </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
					
				</div><!--/span-->
				
				
		
				
				
			</div><!--/row-->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



							