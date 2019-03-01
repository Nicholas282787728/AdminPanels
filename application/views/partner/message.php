<div id="page-wrapper">
	 <?php $this->load->view('partner/new-sidebar'); ?>
    <div class="row">
        <div class="col-lg-12">
			<?php 
				@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) { ?>
					<div class="alert alert-success alert-dismissable">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>.
					  </div>
				<?php }
			?>
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
                    <i class="fa fa-folder mr-5"></i>Messages
				</div>
                <div class="panel-body">
				    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>S.No </th>
									<th>Sender Email </th>
									<th>Subject title</th>
									<th>Message</th>
									<th>Date</th>
									<th>Action</th>
                                </tr>
                            </thead>
						     <tbody>
								 <?php 
								 $sno=1;

								 foreach($message as $noti) {

								  ?>

								 <tr>
								 	 <td><?=$sno?></td>
									 <td width="13%"><?=$noti['senderemail']?></td>
									 <td><?=$noti['subject']?></td>
									 <td><?=$noti['message']?></td>
									 <td width="13%"><?=$noti['date']?></td>
								<!--   <td width="10%">
									
										 <form method="post" action="">
											 <button style="background-color:#ec971f;" type="submit" name="update_read_status" value="<?=$noti['id']?>" class="btn-green udate_promocode">Un Read</button>
										 </form>
								 <form method="post" action="">
											 <button style="background-color:#ec971f;" type="submit" name="delete" value="<?=$noti['id']?>" class="btn-green">Delete</button>
										 </form>
									 </td>  -->
									 <td class="center">
                                        <div class="btn-group">
            							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
											Actions
											<span class="caret"></span>
										</button>            
								<ul class="dropdown-menu" role="menu">
									<li>
									
										<button style="padding: 1px 20px;border: none;background: transparent;"  data-toggle="modal" data-target="#reply<?=$noti['id']?>"  type="button"  class="js-user-delete">
                                                         Reply </button>
										
									</li>
									<li>
										<form action="" method="post">
											<input type="hidden" name="id" value="<?=$noti['id']?>">
										<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm('Are you sure you want to delete this record ');" type="submit" name="delete" class="js-user-delete">
                                                        <i class="fa fa-trash-o"></i> Delete </button>
										</form>
									</li>
								</ul>
							</div>                                      	
									
                                        
									</td>
								 </tr>
<div class="modal fade" id="reply<?=$noti['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header title-bar-orange">
                <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Reply Mail</h5>
                <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('panels/supermacdaddy/affiliatepartner/composemail');?>" enctype="multipart/form-data">
                    <div id="form-alerts"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>To</label>
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" name="send_to" readonly="" class="form-control" value="<?=$noti['senderemail']?>"  required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Subject</label>
                                <div class="input-group" style="width: 100%;" >
                                    <input type="text" name="send_subject" class="form-control" required="" >
                                </div>
                            </div>


                            <div class="form-group" style="overflow-y: auto;">
                                <label>Message</label>
                                <div class="input-group" style="width: 100%">
                                    <textarea class="form-control" id="composmail" name="send_message" rows="4" ></textarea>
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
								 <?php $sno++;} ?>
						    </tbody>
                        </table>
                    </div>    
                 </div>
            </div>
        </div>
    </div>
</div>