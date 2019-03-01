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
                    <i class="fa fa-folder mr-5"></i>Tasks
				</div>
                <div class="panel-body">
				    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>Task Name </th>
									<th>Task Description</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status/Action</th>
                                </tr>
                            </thead>
						     <tbody>
								 <?php foreach($tasks as $noti) { ?>
								 <tr>
									 <td width="13%"><?=!empty($noti['task_name'])?$noti['task_name']:$noti['task_name']?></td>
									 <td><?=$noti['task_description']?></td>
									 <td width="13%"><?=$noti['start_date']?></td>
									 <td width="13%"><?=$noti['end_date']?></td>
									 <td width="10%">
										 <?php if($noti['read_status']==0){ ?>
										 <form method="post" action="">
											 <button style="background-color:#ec971f;" type="submit" name="update_read_status" value="<?=$noti['id']?>" class="btn-green udate_promocode">Un Read</button>
										 </form>
										 <?php } else { echo ' <button  class="btn-green">Read</button>' ;} ?>
									 </td>
								 </tr>
								 <?php } ?>
						    </tbody>
                        </table>
                    </div>    
                 </div>
            </div>
        </div>
    </div>
</div>