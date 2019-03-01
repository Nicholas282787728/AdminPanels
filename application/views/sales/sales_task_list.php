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
		
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Task List - <?=$this->session->userdata('username');?>
					<b style=" margin-left:20%;">Completed Task :  
						<?php
								$total_task =$count_task_sales['totals'];
								$total_comple=$count_task_sales['completed'];
								$persatage_completed='0';
								if(!empty($total_task))
								{
									$persatage_completed=(100/$total_task)*$total_comple;
								}
								echo round($persatage_completed,2).'%';
						?>
					</b>
					<b style=" margin-left:10%;">Pendding Task :  
						<?php
								$total_task =$count_task_sales['totals'];
								$total_pennding=$count_task_sales['pendding'];
								$persatage_completed='0';
								if(!empty($total_task))
								{
									$persatage_completed=(100/$total_task)*$total_pennding;
								}
								echo round($persatage_completed,2).'%';
						?>
					</b>
				</div>
			
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr class="first-row">
									<th width="5%">S.NO</th>
									<th width="30%">Task Details</th>
									<th width="10%">End Date</th>
									<th width="10%">Create Date</th>
									<th width="10%">File Attach</th>
									<th width="10%">Status/Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach($all_task_sales as $v_task) { ?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$v_task['task_description']?></td>
									<td><?=$v_task['end_date']?></td>
									<td><?=$v_task['crdate']?></td>
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
				</div>
			</div>
		</div>
	</div>