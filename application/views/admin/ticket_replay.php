	<div id="page-wrapper">
	<div class="row">
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
			<div id="msgsuccess"></div>
			<?php //print_r($ticket_file); ?>
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Comment Ticket No - <?=$ticket_no?>  
				</div>
				<div class="panel-body">
					<div class="col-sm-12">
						<?php 
						   $filename = 'uploads/'.$ticket_file->attach;
						   if (file_exists($filename) && !empty($ticket_file->attach)) {
						   	 $myfile=fopen(base_url('uploads/'.$ticket_file->attach), "r");
						   	
						?>

						<p><a href="<?php echo base_url('uploads/'.$ticket_file->attach)?>">Open Attached Dcoument</a></p>
						<?php }?>
						<form method="post" action="">
							<div class="form-group medconnex10-grp">
								<label>Replay Comment</label>
								<div class="input-group medconnex10-inputgrp">
									<textarea class="form-control" id="comment_ticket" name="comment_ticket" rows="4" cols="20" style="width:100% !important; height:100%;" required=""></textarea>
								</div>
							</div>
							<button type="submit" class="btn-green" name="replay_btn">Send</button>
						</form>
					</div>
				</div>
				<div class="panel-body">
					<?php foreach($list_ticket_comment as $v_comm) { ?>
					<div class="col-sm-12">
						<div class="col-sm-12">
							<span class="pull-left text-muted">
								<em><?=$v_comm['display_name']?></em><br>
								<em><?=$v_comm['created_date']?></em>
							</span>
						</div>	
						<div class="col-sm-12">
							<p><?=$v_comm['comment']?></p>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>