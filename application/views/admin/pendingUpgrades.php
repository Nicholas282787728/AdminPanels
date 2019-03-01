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
    <style type="text/css">
.panel-heading.title-bar-blue
{
    display: flex;
    align-items: center;
    justify-content: space-between;

}

    	a.exportpendingUpgrades.btn {
  
    background: #fff;
        /*float: right;*/
   /* padding-top: 2px;*/
}
    </style>
    </div>
     <?php 
		 $this->load->view('admin/top_tab_header');
	?>
	<div class="row-fluid sortable">		
		<div class="box span12">
		
			<div class="row">
                <div class="col-lg-12">
				
                    <div class="panel panel-default">
                    <div class="panel-heading title-bar-blue">
	                  <p><i class="fa fa-shopping-cart" aria-hidden="true"></i> Pending Upgrades</p>
	                  <span class="exportpendingUpg">
	                  <a class="exportpendingUpgrades btn" href="<?php echo base_url(); ?>dashboard/exportpendingUpgrades">Export</a>
	                  </span>
	                </div> 
	                <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <form method="post" action="">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" >
                                <thead>
									<tr class="first-row">
									<!-- 	<th><input type="checkbox"  id="bookid"></th> -->
										<th class="br-n">S.No.</th>
									<th class="br-n">Name</th>
									<th class="br-n">State ID</th>
										<th class="br-n">Email</th>
										<th class="br-n">Monthly Bill</th>
										<th class="br-n">Social Media Link</th>
										<th class="br-n">Reference link of current panel</th>
										<th class="br-n">Document</th>
							
									
								
										
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
										
										<!-- <td><input type="checkbox" class="check" name="book[]" value="" ></td> -->
											<td><?php echo $i++; ?></td>
											<td><?php echo $row['display_name']; ?></td>
											<td><?php echo $row['state']; ?></td>
										
											<td><?php echo $row['email']; ?></td>
											<td></td>
											<td><?php echo $row['socialid']; ?></td>
											<td></td>
										<!-- 	<td><img width="50px" src="<?php echo base_url(); ?>uploads/<?php echo $row['document']; ?>"></td> -->
										<td>
										<?php 
									
									$get_query  = $this->db->query("SELECT * FROM `uf_user_documents` WHERE `user_id` = '".$row['id']."' AND pendingUpgrades='1' ");

									foreach ($get_query->result() as $document_view) 
									{


										$owned_urls	= $document_view->document;
										$link_name	= explode( '.', $owned_urls);
										$filename	= 'uploads/'.$document_view->document;
										if (file_exists($filename)) {
									?>

									<img width="70px" src="<?php echo base_url();?>uploads/<?=$document_view->document;?>">
										<a href="<?php echo base_url();?>uploads/<?=$document_view->document;?>" target="_blank"> <?= $link_name[0] ?></a>	<br>
									
									<?php }  } ?>
									</td>
											
									
											
											


											
												<td><div class="btn-group">
														<?php if ($row['document_status'] == '0') { ?>
														<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
															Disabled
															<span class="caret"></span>
														</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="" method="post" style="margin: 0px;">
																<input type="hidden" name="document_status" value="1">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="<?=$row['id']?>"   class="js-user-disable">
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
																<input type="hidden" name="document_status" value="1">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="<?=$row['id']?>"   class="js-user-disable">
															<i class="fa fa-minus-circle"></i>  Disable
															</button>
															</form>

														</li>
													<?php } ?>

													<li>
																<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#sendmail<?php echo $row['id']; ?>"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> send mail
																</a>
															</li>
																<li>
																<a  href="javascript:void(0);" data-id="<?php echo $row['id']; ?>"  data-target="#convertmembership<?php echo $row['id']; ?>"  data-toggle="modal">
																	Convert Membership
																</a>
															</li>


													
														
														
															
														

															
													</ul>
												</div>
											</td>
							
										</tr>
										

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
				<form method="post" action="<?php echo base_url('dashboard/pendingUpgradesEmail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php echo $row['email']; ?>" class="form-control" required="" >
								</div>
							</div>
							<!-- <div class="form-group">
								<label>CC</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="cc" class="form-control" >
								</div>
							</div> -->
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
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit"  class="btn-green">Send Message</button>
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









 <div class="modal fade" id="convertmembership<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i>Convert To Storefront Membership</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('dashboard/convertmembership');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
							
						
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit"  class="btn-green">Convert</button>
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
									<?php } ?>
                                </tbody>
                            </table>
                        

                        </from>
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





