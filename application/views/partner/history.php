
<div id="page-wrapper">
	 <?php $this->load->view('partner/new-sidebar'); ?>
	   <div class="row">
            <div class="col-lg-12">  <!-- <h1 class="page-header">Products</h1> -->
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
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
			   <div class="panel-heading" style="font-weight:bold;height:45px;">
					My History
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					<table width="100%" class="table table-striped table-bordered table-hover medconnex20" id="dataTables-example">
						<thead>
							<tr class="first-row">
								<th>S.No </th>
								<th>User Activity Message</th>
								<th>Date </th>
								<th>Time  </th>
								<th>Action  </th>
							</tr>
						</thead>
						<tbody>

						<?php 
						 if(count($historyData) > 0){
						 	$i=1;
						foreach ($historyData as $h ) { ?>
							<tr class="odd">
								<td><?=$i?></td>
								<td><?=$h->message?></td>
								<td><?php echo  date('d-m-Y',strtotime($h->created_at));  ?></td>
								<td> <?php echo  date('h:i',strtotime($h->created_at));  ?> </td>
								<td><form action="" method="post">
					 									<button  onclick="return confirm('Are you sure want to delete?');" type="submit" name="delete_history" value="<?php echo $h->id; ?>"   class="btn btn-danger">
														<i class="fa fa-trash-o"></i>  </button>
														</form></td>
							</tr>
						<?php $i++; } }?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>