<style>
	.panel-heading
	{
		height:80px;
		max-height: 80px;
	}
</style>
<div id="page-wrapper">
	 <?php $this->load->view('ondemand/new-sidebar'); ?>
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
					Visiblity List
				</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>S.No </th>
								<th>Image</th>
								<th>Location Name</th>
								<th>Postal Code </th>
								<th>Email </th>
								<th>Phone Number  </th>
								<th>Longitude  </th>
								<th>Latitude  </th>
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
								<td><img src="<?php echo base_url('uploads/'.$h->logo);?>?>" width="100px" height="100px"></td>
								<td><?=$h->location_name?></td>
								<td><?=$h->postal_code?></td>
								<td><?=$h->email?></td>
								<td><?=$h->phone_number?></td>
								<td><?=$h->longitude?></td>
								<td><?=$h->latitude?></td>
							
								<td><form action="" method="post">
					 									<button  onclick="return confirm('Are you sure want to delete?');" type="submit" name="delete_history" value="<?php echo $h->loc_id; ?>"   class="btn btn-danger">
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