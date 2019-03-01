

<div id="page-wrapper">
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
			<div id="msg_success_ajaxs"></div>
			<div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
					<h3 class="panel-title pull-left"><i class="fa fa-users"></i> User's Verfications</h3>
				</div>
                <div class="panel-body">
					<div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                	<th><input type="checkbox" ></th>
                                	<th>Date</th>
									<th>User/Info</th>
									
									<th>User Type</th>
									<th>Registered Since</th>
									<th>Document Link</th>
									<th>Status/action</th>                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($alluser as $val){?>


											<?php 




                                					$query = $this->db->query("SELECT distinct (user_id),created_at from `uf_user_documents`  where user_id = '".$val['id']."'"); 
			$docresult=$query->row(); 


				 ?>

                                <tr class="odd gradeX" id="rejectremove_<?=$val['id']?>">
                                	<td><input type="checkbox" name="book[]"></td>
                                
								<td><?php if(!empty($docresult)) { echo $docresult->created_at; } else {  echo '';}  ?></td>
									<td>
										<?php echo $val['display_name'];?><br>
										<?php echo $val['mob_number'];?><br>
										<?php echo $val['email'];?></td>
	
									<td><?php

											echo 'User';
									?></td>
									
									<td><?php echo $val['created_at'];?></td>
									<td>
									<?php 
									
									$sql  = $this->db->query("SELECT * FROM `uf_user_documents` WHERE `user_id` = '".$val['id']."' ");
									$resultarray = $sql->result_array();
									foreach ($resultarray as $document_view) 
									{
									?>
									<img width="50" src="<?php echo $document_view['document'] ?>" >
										 <a href="<?php echo $document_view['document'] ?>" target="_blank"> View Document</a>	<br> 
									
									<?php
									} 
									 ?>
									</td>

									<?php 
									if($val['service_type'] == 'Premium'){
											$btncls='btn';
										$style=' style="color: #333 !important; background-color: pink !important;border-color: pink !important;"';
									}else{
									
										$btncls='btn btn-warning';
										$style='';
									}
									?>
									<td class="center">
                                        <?php if($val['is_verify']==1){
                                        	 echo '<div class="btn-group">
            							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
											Activate User
											<span class="caret"></span>
										</button>            
								<ul class="dropdown-menu" role="menu">
									<li>
										<form action="" method="post">
										<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="deactive" value="'.$val['id'].'" id="deactive" data-id="'.$val['id'].'" class="js-user-disable">
										<i class="fa fa-minus-circle"></i>  Deactivate User
										</button>
										</form>
									</li>
								</ul>
							</div>';                                       	
									}else{
										 echo ' <div class="btn-group">
										<button type="button" class="'.$btncls.'" dropdown-toggle" data-toggle="dropdown" '.$style.'>
											Unactivated
											<span class="caret"></span>
										</button>            
									<ul class="dropdown-menu" role="menu">
										<li>
											<form action="" method="post">
											<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$val['id'].'" id="active" data-id="'.$val['id'].'" class="js-user-disable">
											<i class="fa fa-minus-circle"></i>  Activate User
											</button>
											</form>
										</li>
										<li>
											<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="reject"  data-id="'.$val['id'].'" data-email="'.$val['email'].'" class="reject_user">
												<i class="fa fa-minus-circle"></i>  Reject User
											</button>
										</li>
								</ul>
							</div>';
                                        	}?>
									</td>
									

                                </tr>
                                    <?php }?>
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
 </div>


<div id="reject_user_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject Reason : <span id="reject_email"></span> </h4>
      </div>
      <div class="modal-body">
        <div class="form-group ">
				<label>Reason Details</label>
				<input type="hidden" name="user_id_reject" id="user_id_reject">
				<input type="hidden" name="user_email_reject" id="user_email_reject">
				<textarea class="form-control" rows="8" id="user_reason_msg" required=""></textarea>
			</div>
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-info" id="btn_reject_conform">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
$('.reject_user').click(function(){
	var user_id		= $(this).attr('data-id');
	var user_email	= $(this).attr('data-email');
	$('#reject_email').html(user_email);
	$('#user_id_reject').val(user_id);
	$('#user_email_reject').val(user_email);
	$('#reject_user_modal').modal('show');
})	
$('#btn_reject_conform').click(function(){
	var user_id			= $('#user_id_reject').val();
	var user_email		= $('#user_email_reject').val();
	var user_reason_msg	= $('#user_reason_msg').val();
	
	$.ajax({
		type:"post",
		url: "<?=base_url()?>panels/supermacdaddy/Dashboard/reject_pending_providers",
		data: "user_id="+user_id+"&user_email="+user_email+"&user_reason_msg="+user_reason_msg,
		dataType:"JSON",
		success: function(data){
			$('#rejectremove_'+user_id).remove();
			$('#msg_success_ajax').html(data.msg);
			$('#reject_user_modal').modal('hide');
		}
	});
	
	
	
	$('#reject_user_modal').modal('hide');
	
})	





</script>
