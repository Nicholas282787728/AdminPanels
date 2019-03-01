<style>
	.panel-heading
	{
		height:80px; 
		max-height: 80px;
	}
</style>
<div id="page-wrapper">
	<?php $this->load->view('doctor_templates/new-sidebar'); ?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="font-weight:bold;height:45px;">
					<i class="fa fa-history"></i> History
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					<table width="100%" class="table table-striped table-bordered table-hover medconnex24" id="dataTables-example">
						<thead>
							<tr class="first-row">
								<th>S.No </th>
								<th>Product Purchased</th>
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
								<button  onclick="return confirm('Are you sure want to delete?');" type="submit" name="delete_history" value="<?php echo $h->id; ?>" class="btn btn-danger">
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