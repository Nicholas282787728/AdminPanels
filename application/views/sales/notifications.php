		<style>
			#dataTables-example2_length,#dataTables-example1_length
			{
				display:none !important;
			}
		</style>
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
     <?php $this->load->view('sales_templates/new-sidebar'); ?>
    <div class="row">
        <div class="col-lg-12">
			
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
                    <i class="fa fa-folder mr-5"></i>All Notifications
				</div>
				    <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#all_notifications" data-toggle="tab">&nbsp; Notifications</a>
                                </li>
                              <!--   <li><a href="#task_notifications" data-toggle="tab">&nbsp; Task Notifications</a>
                                </li>
                                <li><a href="#message_notifications" data-toggle="tab">&nbsp; Message notifications</a>
                                </li> -->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
								<br><br>
                                <div class="tab-pane fade in active" id="all_notifications">
                                   <div id="calendars" class="tab-pane fade in active">
										 <div class="table-responsive">
											<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover medconnex17" id="dataTables-example">
												<thead>
													<tr>
														<th>Subject Name  <i class="fa fa-sort"></i></th>
														<th>Message<i class="fa fa-sort"></i></th>
														<th>Date & Time<i class="fa fa-sort"></i></th> 
													<th>Sent By<i class="fa fa-sort"></i></th>
														<th>Action<i class="fa fa-sort"></i></th>
													</tr>
												</thead>
												 <tbody>
													 <?php 

													 	// echo "<pre>"; print_r($notifiy_list);
													 	// die();
													 foreach($notifiy_list as $noti) { 
														if($noti['type_read']==0 || $noti['type_read']=="00") {
														?>
													 <tr>
														 <td><?=!empty($noti['display_name'])?$noti['display_name']:$noti['title']?></td>
														 <td><?=$noti['message']?></td>

														 <td><?=$noti['created_at']?>
														 	
														 </td>
														 <?php
														  $sender_id =	$noti['sender_id'];
														 	 $query=$this->db->query("select user_name,email from uf_user where id = $sender_id");
   								 							$result=$query->row(); 
   								 							//echo "<pre>"; print_r($result);

   								 							?>
														 <td><?php if(!empty($result)){ echo $result->user_name; } ?></td>
														 <td>
															<!--  <?php
															 if($noti['type_read'] === "0"){ ?>
																<form method="post" action="">
																	<input type="hidden" name="type_read" value="00">
																	<button style="background-color:#ec971f;" type="submit" name="update_read_notifiy" value="<?=$noti['notification_id']?>" class="btn-green udate_promocode">Un Read</button>
																</form>
															 <?php } else { echo ' <button  class="btn-green">Read</button>' ;} ?> -->

				<div class="btn-group">
				<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				View
				<span class="caret"></span>
				</button>            
				<ul class="dropdown-menu" role="menu" style="min-width: 100px !important;">
				


				<li>
				<a class="gn-GenSales-edit" data-toggle="modal" data-target="#replyMail<?php echo $noti['id']; ?>">
				<i class="fa fa-edit"></i> Reply
				</a>
				</li>






				</ul>
				</div>


<!-- 
															  <button style="background-color:#ec971f;" type="button" class="btn-green udate_promocode"  data-toggle="modal" data-target="#replyMail<?php echo $noti['id']; ?>">Reply2</button> -->
														 </td>
													 </tr>
													 <div class="modal fade" id="replyMail<?php echo $noti['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('sales/composemail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php if(!empty($result)){ echo $result->email; } ?>" class="form-control" required="" >
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
													 <?php }}?>
												</tbody>
											</table>
											 <br><br>
										</div>    
									</div>
                                </div>
						
                                <div class="tab-pane fade" id="task_notifications">
                                   <div class="center-box text-center">
									 <div class="table-responsive">
										<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover medconnex17" id="dataTables-example1">
											<thead>
												<tr>
													<th>Subject Name  <i class="fa fa-sort"></i></th>
													<th>Message<i class="fa fa-sort"></i></th>
														<th>Date & Time<i class="fa fa-sort"></i></th> 
													<th>Sent By<i class="fa fa-sort"></i></th>
														<th>Action<i class="fa fa-sort"></i></th>
												</tr>
											</thead>
											 <tbody>
												 <?php foreach($notifiy_list as $noti) {
													 if($noti['type_read']==2 || $noti['type_read']==22)
													 {
													 ?>
												 <tr>
													 <td><?=!empty($noti['display_name'])?$noti['display_name']:$noti['title']?></td>
													 <td><?=$noti['message']?></td>
													 <td><?=$noti['created_at']?></td>
													 	 <?php
														  $sender_id =	$noti['sender_id'];
														 	 $query=$this->db->query("select user_name,email from uf_user where id = $sender_id");
   								 							$result=$query->row(); 
   								 							//echo "<pre>"; print_r($result);

   								 							?>
														 <td><?php if(!empty($result)){ echo $result->user_name; } ?></td>
													 <td>
														<!--  <?php if($noti['type_read']==2){ ?>
														 <form method="post" action="">
															 <input type="hidden" name="type_read" value="22">
																<button style="background-color:#ec971f;" type="submit" name="update_read_notifiy" value="<?=$noti['notification_id']?>" class="btn-green udate_promocode">Un Read</button>
															</form> -->
													
													<!-- 		<ul class="dropdown-menu" role="menu">
														
													

													<li>
								<a class="gn-GenSales-edit" data-toggle="modal" data-target="#reply">
																	<i class="fa fa-edit"></i> Reply
																</a>
															</li>
														</ul> -->

													<!-- 	 <?php } else { echo ' <button  class="btn-green">Read</button>' ;} ?> -->
														 <button style="background-color:#ec971f;" type="button" class="btn-green udate_promocode"  data-toggle="modal" data-target="#replyMail<?php echo $noti['id']; ?>">Reply</button>

													 </td>
												 </tr>
												 <?php
												 	 }
												 	 ?>
												 	  <div class="modal fade" id="replyMail<?php echo $noti['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('sales/composemail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php if(!empty($result)){ echo $result->email; } ?>" class="form-control" required="" >
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
												 	 <?php
													} 
												?>
											</tbody>
										</table>
										 <br><br>
									</div>    
								</div>
                                </div>
                                <div class="tab-pane fade" id="message_notifications">
                                   <div class="center-box text-center">
									 <div class="table-responsive">
										<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover medconnex17"id="dataTables-example2">
											<thead>
												<tr>
													<th>Subject Name  <i class="fa fa-sort"></i></th>
													<th>Message<i class="fa fa-sort"></i></th>
														<th>Date & Time<i class="fa fa-sort"></i></th> 
													<th>Sent By<i class="fa fa-sort"></i></th>
														<th>Action<i class="fa fa-sort"></i></th>
												</tr>
											</thead>
											 <tbody>
												<?php foreach($notifiy_list as $noti) {
													 if($noti['type_read']==3 || $noti['type_read']==33)
													 {
														$sql = "select * from uf_user where id = '" .$noti['created_by']. "'";
														$query = $this->db->query($sql);
														$resultarray = $query->row_array();
												?>
												 <tr>
													 <td width="13%"><?=!empty($resultarray['display_name'])?$resultarray['display_name']:$resultarray['title']?></td>
													 <td width="60%"><?=$noti['message']?></td>
													 <td width="10%"><?=$noti['created_at']?></td>

													 	 <?php
														  $sender_id =	$noti['sender_id'];
														 	 $query=$this->db->query("select user_name,email from uf_user where id = $sender_id");
   								 							$result=$query->row(); 
   								 							//echo "<pre>"; print_r($result);

   								 							?>
														 <td><?php if(!empty($result)){ echo $result->user_name; } ?></td>
													 <td width="10%">
														 <?php if($noti['type_read']==3){ ?>
														 <form method="post" action="">
															 <input type="hidden" name="type_read" value="33">
																<button style="background-color:#ec971f;" type="submit" name="update_read_notifiy" value="<?=$noti['notification_id']?>" class="btn-green udate_promocode">Un Read</button>
															</form>
														 <?php } else { echo ' <button  class="btn-green">Read</button>' ;} ?>
														  <button style="background-color:#ec971f;" type="button" class="btn-green udate_promocode"  data-toggle="modal" data-target="#replyMail<?php echo $noti['id']; ?>">Reply</button>
													 </td>
												 </tr>
												 											 	  <div class="modal fade" id="replyMail<?php echo $noti['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('sales/composemail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php if(!empty($result)){ echo $result->email; } ?>" class="form-control" required="" >
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
												 <?php
												 	 }
													} 
												?>
											</tbody>
										</table>
										<br><br>
									</div>    
								</div>
                                </div>
                            </div>
                        </div>
			</div>
        </div>
    </div>
</div>












