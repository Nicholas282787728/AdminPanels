<style>
	.panel-heading{
		height: 80px;
		max-height: 80px;
	}	
	li form{
		margin:2px;
		padding:2px;
	}
</style>
<div id="page-wrapper">
<?php $this->load->view('doctor_templates/new-sidebar'); ?>

	<div class="row">
		<div class="col-lg-12">
	
				<div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="font-weight:bold;height:45px;">
					<!--Pending Approvals-->
				<i class="fa fa-clock-o"></i>
					Scheduling
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					<table width="100%" class="table table-striped table-bordered table-hover medconnex23" id="dataTables-example">
						<thead>
							<tr class="first-row">
								<th>Full Name </th>
								<th>Email </th>
								<th>contact </th>
								<th>Preferred Date </th>
								<th>Preferred Time </th>
								<th>Created By </th>
								<th>Actions  </th> 
							</tr>
						</thead>
						<tbody>
							<?php foreach ($getpendingApproval as $row) { ?>
								<tr class="odd">
									<td><?php echo $row->full_name; ?></td>
									<td><?php echo $row->email; ?></td>
									<td><?php echo $row->phone; ?></td>
									<td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
									<td><?php echo date('h:i A', strtotime($row->time)); ?></td>
										<td><?php echo $row->display_name; ?></td>
									<td class="center">
										<?php
										if($row->accepted == 0)
										{
											echo ' <div class="btn-group">
													<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
														Unapproved
														<span class="caret"></span>
													</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="" method="post" >
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="approved_btn" value="'.$row->id.'" id="disable" data-id="'.$row->id.'" class="js-user-disable">
															<i class="fa fa-minus-circle"></i> Approved
															</button>
															</form>
														</li>
														<li>
															<form action="" method="post" >
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="reject_btn" value="'.$row->id.'" id="disable" data-id="'.$row->id.'" class="js-user-disable">
															<i class="fa fa-minus-circle"></i> Reject
															</button>
															</form>
														</li>
														<li>
															<form action="" method="post">
															<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete ?\');" type="submit" name="delete" value="'.$row->id.'" id="disable" class="js-user-delete" >
															<i class="fa fa-trash-o"></i> Delete user</button>
															</form>
														</li>
													</ul>
												</div>';
										}
										elseif($row->accepted == 2)
										{
											echo ' <div class="btn-group">
													<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
														Reject
														<span class="caret"></span>
													</button>            
													<ul class="dropdown-menu" role="menu">
														<li>
															<form action="" method="post">
															<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete ?\');" type="submit" name="delete" value="'.$row->id.'" id="disable" class="js-user-delete" >
															<i class="fa fa-trash-o"></i> Delete user</button>
															</form>
														</li>
													</ul>
												</div>';
										}
//										else
//										{
//											echo	'<div class="btn-group">
//													<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
//														Approved
//														<span class="caret"></span>
//													</button>            
//													<ul class="dropdown-menu" role="menu">
//														<li>
//															<form action="" method="post" >
//															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="unapproved_btn" value="'.$row->id.'" id="disable" data-id="'.$row->id.'" class="js-user-disable">
//															<i class="fa fa-minus-circle"></i> Unapproved
//															</button>
//															</form>
//														</li>
//														<li>
//															<form action="" method="post" >
//															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="expired_btn" value="'.$row->id.'" id="disable" data-id="'.$row->id.'" class="js-user-disable">
//															<i class="fa fa-minus-circle"></i> Expired
//															</button>
//															</form>
//														</li>
//														<li>
//															<form action="" method="post">
//															<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete ?\');" type="submit" name="delete" value="'.$row->id.'" id="disable" class="js-user-delete" >
//															<i class="fa fa-trash-o"></i> Delete user</button>
//															</form>
//														</li>
//													</ul>
//												</div>';
//										}
										?>
									<i class="fa fa-skype hastooltip" title="" style="cursor:pointer; font-size: 25px;" ></i>
									<i class="fa fa-envelope hastooltip" title="<?=$row->email?>" style="cursor:pointer; font-size: 25px;"></i>
									<i class="fa fa-phone hastooltip" title="<?=$row->phone?>" style="cursor:pointer; font-size: 25px;"></i>
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