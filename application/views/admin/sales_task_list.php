
<div id="page-wrapper" >
	<div class="row">
		<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			?>
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Task List - <?=$list_task['user_name_join']['email']?>
				</div>
				<div class="panel-body">
					
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="50%">Task Details</th>
									<th width="10%">End Date</th>
									<th width="10%">File Attach</th>
									<th width="10%">Create Date</th>
									<th width="10%">Status/Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach($list_task['sales_task'] as $v_task) { ?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$v_task['task_description']?></td>
									<td><?=$v_task['end_date']?></td>
									<td>
										<?php
										$filename = 'uploads/'.$v_task['attachment'];
										if (file_exists($filename)) 
										{
										?>
										<a  target="_blank" href="<?=base_url().$filename?>" style="font-size: 30px;" download>
											<i class="fa fa-download"></i>
										</a>
										
										<?php
										}
										?>
									</td>
									<td><?=$v_task['crdate']?></td>
									<td>
										<?php if($v_task['status'] == 1){
                                        	 echo '<div class="btn-group">
													<button type="button" class="btn btn-success">Completed</button>            
												</div>';                                       	
										}else{
											echo ' <div class="btn-group">
													<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
														Pendding
														<span class="caret"></span>
													</button>            
												<ul class="dropdown-menu" role="menu">
													<li>
													<form action="" method="post">
													<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="completed" value="'.$v_task['id'].'" id="active" data-id="'.$v_task['id'].'" class="js-user-disable">
													<i class="fa fa-minus-circle"></i>  Completed
													</button>
													</form>
												</li>
											</ul>
										</div>';
										}?>
										
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<br><br>
					<?php 
						$user_type =$list_task['user_name_join']['user_type'];
						if($user_type == 0 || $user_type =='1'|| $user_type =='2'|| $user_type =='3')
						{
					?>
					<a  href="<?=base_url()?>panels/supermacdaddy/dashboard/users" class="btn-green" style="text-decoration: none;color: #fff;">Back</a>
					<?php } else { ?>
						<a  href="<?=base_url()?>panels/supermacdaddy/dashboard/sales" class="btn-green" style="text-decoration: none;color: #fff;">Back</a>
					<?php } ?>
				
				</div>
			</div>
		</div>
	</div>
