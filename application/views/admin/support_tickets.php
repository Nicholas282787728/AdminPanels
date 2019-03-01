<script type="text/javascript" src="<?=base_url()?>public/js/nicEdit-latest.js"></script>
<script>
	bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('message_ticket');
	});
</script>
<div id="page-wrapper" > 
	<?php 
		 $this->load->view('admin/top_tab_header');
	?>
            <div class="row" >
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
                </div>
            </div>
	
            <div class="row dash-icon" style="display: none;"	>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$ticket_count['padding']?></div>
                                    <div>Total Pending!</div>
                                </div>
                            </div>
                        </div>
						<form method="post" action="" name="" id="pending_form" >
							<input type="hidden" value="0" name="count_list">
							<a style="cursor:pointer" id="pending">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							 </a>
						</form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-customeblue">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$ticket_count['process']?></div>
                                    <div>Total Process!</div>
                                </div>
                            </div>
                        </div>
                     <form method="post" action="" name="process_form" id="process_form" >
							<input type="hidden" value="1" name="count_list">
							<a style="cursor:pointer" id="process">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
					 </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$ticket_count['completed']?></div>
                                    <div>Total Completed!</div>
                                </div>
                            </div>
                        </div>
                         <form method="post" action="" name="completed_form" id="completed_form" >
							<input type="hidden" value="2" name="count_list">
							<a style="cursor:pointer" id="completed">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
						 </a>
						 </form>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
					
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$ticket_count['all_ticket']?></div>
                                    <div>Total Tickets!</div>
                                </div>
                            </div>
                        </div>
                      <a style="cursor:pointer" href="<?=base_url()?>panels/supermacdaddy/dashboard/support_tickets">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
			<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i>Ticket Management</p>
                </div> <!-- /.panel-heading -->
                <div class="panel-body">
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#create_ticket_form">Create New Ticket
                    </button><br><br>
                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover custom-table  medconnex9" id="dataTables-example">
                        <thead>
                            <tr class="first-row">
                                <th>Ticket No</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>File</th>
								<th>Created Date</th>  								
								<th>Status</th>  								
								<th>Action</th>  								
                            </tr>
                        </thead>
                        <tbody>	
							<?php foreach($list_ticket_data as $view_tickit){ ?>
							<tr>
								<td style="width:7%"><?=$view_tickit['ticket_id']?></td>
								<td style="width:7%"><?=$view_tickit['email']?></td>
								<td style="width:12%"><?=$view_tickit['subject']?></td>
								<td ><?=$view_tickit['message']?></td>
								<td style="width:7%">
									<?php
									$filename = 'uploads/'.$view_tickit['attach'];
									// if (file_exists($filename) && !empty($view_tickit['attach'])) {
									if (file_exists($filename) && !empty($view_tickit['attach'])) {
									?>
									<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?=base_url()?>uploads/<?=$view_tickit['attach']?>" style="color: rgb(255, 255, 255);">
										<span class="label label-success">View</span>
									</a>
									<?php } ?>
								<!-- 	<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?=base_url()?>panels/supermacdaddy/dashboard/ticket_replay/<?=$view_tickit['ticket_id']?>" style="color: rgb(255, 255, 255);">
										<span class="label label-success">Reply</span>
									</a> -->
								</td>
								<td style="width:13%"><?=$view_tickit['created_date']?></td>
								<td style="width:13%">
									<?php
										if ($view_tickit['status'] == 0) 
										{
											echo '<div class="btn-group">
												<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
														Pending
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="process" value="' . $view_tickit['ticket_id'] . '" >
														<i class="fa fa-minus-circle"></i> Process
														</button>
														</form>
													</li>
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="completed" value="' . $view_tickit['ticket_id'] . '" >
														<i class="fa fa-minus-circle"></i> Completed
														</button>
														</form>
													</li>
													<li>
									
									<button style="padding: 1px 20px;border: none;background: transparent;" type="button" data-toggle="modal" data-target="#replyticket" >
														<i class="fa fa-minus-circle"></i> Reply
														</button>

													</li>

												</ul>
											</div>';
										} 
										else if ($view_tickit['status'] == 1) 
										{
											echo '<div class="btn-group">
												<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
														Process
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="completed" value="' . $view_tickit['ticket_id'] . '" id="enable" data-id="' . $view_tickit['ticket_id'] . '" class="js-staff-enable">
															<i class="fa fa-minus-circle"></i> Completed
														</button>
														</form>
													</li>
														<li>
									
									<button style="padding: 1px 20px;border: none;background: transparent;" type="button" data-toggle="modal" data-target="#replyticket" >
														<i class="fa fa-minus-circle"></i> Reply
														</button>

													</li>
												</ul>
											</div>';
										} 
										else 
										{
											echo '<div class="btn-group">
													<button type="button" class="btn btn-success">
														Completed
													</button>
												</div>';
										} 
									
									?>
								</td>
								
								<td style="width:10%">
									<a class="btn btn-info edit_ticket" href="javascript:;" data-id="<?=$view_tickit['ticket_id']?>">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
									<a class="btn btn-danger rdbtn" onclick="return confirm('Are you sure?');" href="<?=base_url()?>dashboard/delete_ticket/<?=$view_tickit['ticket_id']?>">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>
								</td>
							
							</tr>
							<?php } ?>
                        </tbody>
                    </table> <!-- /.table-responsive -->
                </div>
                    
    				   
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#create_ticket_form">Create New Ticket
                    </button>
                <!-- /.panel-body -->
             </div><!-- /.panel -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
</div><!--/.page wrapper-->
           





<div class="modal fade" id="replyticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Reply Ticket</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="replyticket" id="replyticket" method="post" action=""  enctype="multipart/form-data" >
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Ticket No </label>
								<div class="input-group">
									<input class="form-control" type="text" name="ticket_no" readonly="" value="<?=$last_ticket_no?>" required="" >
								</div>
							</div>
							 <div class="form-group">
								<label for="email">Email Address</label>
								<div class="input-group textgroup">
									<input class="form-control" type="email" name="ticket_email" value="support@medconnex.net" readonly="" style="width:94% !important;" required="">
								</div>
							</div>
							 <div class="form-group">
								<label for="email">CC</label>
								<div class="input-group textgroup">
									<input class="form-control" type="email" name="cc"   style="width:94% !important;" required="">
								</div>
							</div>

							<div class="form-group">
								<label>Subject </label>
								<div class="input-group textgroup">
									<input class="form-control" type="text" name="ticket_sub" style="width:94% !important;" required="">
								</div>
							</div>
							<div class="form-group" style="overflow-y: auto;">
								<label>Message</label>
								<div class="input-group textgroup">
								<textarea class="form-control" id="message_ticket" name="message_ticket" rows="4" cols="20" style="height:100%;"></textarea>
								</div>
							</div>
							
						</div>
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="replyticket" class="btn-green">Reply Ticket</button>
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
<div class="modal fade" id="create_ticket_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Created New Ticket</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="create_ticket_form" id="create_ticket_form" method="post" action=""  enctype="multipart/form-data" >
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Ticket No </label>
								<div class="input-group">
									<input class="form-control" type="text" name="ticket_no" readonly="" value="<?=$last_ticket_no?>" required="" >
								</div>
							</div>
							 <div class="form-group">
								<label for="email">Email Address</label>
								<div class="input-group textgroup">
									<input class="form-control" type="email" name="ticket_email" value="support@medconnex.net" readonly="" style="width:94% !important;" required="">
								</div>
							</div>
							 <div class="form-group">
								<label for="email">CC</label>
								<div class="input-group textgroup">
									<input class="form-control" type="email" name="cc"   style="width:94% !important;" required="">
								</div>
							</div>

							<div class="form-group">
								<label>Subject </label>
								<div class="input-group textgroup">
									<input class="form-control" type="text" name="ticket_sub" style="width:94% !important;" required="">
								</div>
							</div>
							<div class="form-group" style="overflow-y: auto;">
								<label>Message</label>
								<div class="input-group textgroup">
								<textarea class="form-control" id="message_ticket" name="message_ticket" rows="4" cols="20" style="height:100%;"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label>Attach File </label>
								<div class="input-group">
									<input type="file" name="image" id="create_new_ticket" >
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
									<button type="submit" name="createdticket" class="btn-green">Created Ticket</button>
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

<!--/Edit data/-->
<div class="modal fade" id="edit_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="edit_ticket_form" id="edit_ticket_form" method="post" action=""  enctype="multipart/form-data" >
					<div id="form-alerts"></div>
					<div class="row">
						<div id="edit_tickit_data" class="col-md-12"></div>
					</div
					><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updateticket" class="btn-green" >Update Ticket</button>
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
		$('#pending').click(function(){
			document.getElementById('pending_form').submit();
		});
		$('#process').click(function(){
			document.getElementById('process_form').submit();
		});
		$('#completed').click(function(){
			document.getElementById('completed_form').submit();
		});
		
		
	$('.edit_ticket').click(function(){
		var ticket_id=$(this).attr('data-id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_ticket",
			data: "&ticket_id="+ticket_id,
			success: function(response){
				$("#edit_tickit_data").html(response);
				new nicEditor().panelInstance('edit_message_ticket');
				$('#edit_ticket').modal('show')   
			} 
		});
	});
	$("#create_new_ticket").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded(e) {
			  var dataImage= $('#create_new_ticket').prop('files')[0];
			  var fileName = dataImage.name;
			  var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			  var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
			   if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurl').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                  $('#myImg').attr('src', '');
                }else{
                    $('#myImg').attr('src', e.target.result);
                    $('.docurl').html('');
               }
   }

   $(document).on('change', '.create_new_ticket',function() {
   if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoadedClass;
				reader.readAsDataURL(this.files[0]);
			}
     });
   function imageIsLoadedClass(e) {
			  var dataImage= $('.create_new_ticket').prop('files')[0];
			  var fileName = dataImage.name;
			  var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			  var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
			   if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurlUpdate').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                  $('.myImgUpdate').attr('src', '');
                }else{
                    $('.myImgUpdate').attr('src', e.target.result);
                    $('.docurlUpdate').html('');
               }
   }


		
</script>