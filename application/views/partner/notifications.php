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
                    <i class="fa fa-folder mr-5"></i>Notifications
				</div>
                <div class="panel-body">
				    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>S.No </th>
									<th>Display Name / Title </th>
									<th>Message</th>
									<th>Created</th>
									<th>Status/Action</th>
                                </tr>
                            </thead>
						     <tbody>
								 <?php 
								 $sno=1;

								 foreach($notification as $noti) { ?>
								 <tr>
								 	 <td><?=$sno?></td>
									 <td width="13%"><?=!empty($noti['display_name'])?$noti['display_name']:$noti['title']?></td>
									 <td><?=$noti['message']?></td>
									 <td width="13%"><?=$noti['created_at']?></td>
									 <td width="10%">
										 <?php if($noti['read_status']==0){ ?>
										 <form method="post" action="">
											 <button style="background-color:#ec971f;" type="submit" name="update_read_status" value="<?=$noti['notification_id']?>" class="btn-green udate_promocode">Un Read</button>
										 </form>
										 <?php } else { echo ' <button  class="btn-green">Read</button>' ;} ?>
									 </td>
								 </tr>
								 <?php $sno++;} ?>
						    </tbody>
                        </table>
                    </div>    
                 </div>
            </div>
        </div>
    </div>
</div>