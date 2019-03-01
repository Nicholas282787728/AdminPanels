<style>

.myclass {
    width: 20% !important;
} 
</style>
<div id="page-wrapper">
	<div class="row dash-icon">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i  style="color:#FF8961;"class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count(@$salcount['sales']);?></div>
                           <div class="font-small">Sales Staff Panel</div>
						</div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer adi-head-orange">
                        <span class="pull-left"><a href='panels/supermacdaddy/sales'>View Details</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i  style="color:#56BDDC;"class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo @$salcount['users'];?></div>
                            <div class="font-small">Certified Providers Panel</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                     <div class="panel-footer adi-head-blue">
						<span class="pull-left"><a href='#' class="" data-toggle="modal" data-target="#exampleModal">View Details</a></span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i  style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
                        </div>
                         <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div class="font-small">Affiliate Partners Panel</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer adi-head-per">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div class="font-small">Support Tickets!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer adi-head-green">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
     </div>
<!-- Button trigger modal -->
		<?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
		?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Task List
                </div>
                <div class="panel-body">
					<button type="button" class="btn-green btn-success " data-toggle="modal" data-target="#exampleModal">
						Add New Task
					</button><br><br>
                    <div class="table-responsive">                        	
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
								<tr>
									<th>Staff Name</th>
									<th>Task Name</th>
									<th>Description</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Close Date</th>
									<th>Status/Actions</th>
								   
								</tr>
                            </thead>
							<tbody>
								<?php if(!empty($sales_task)){ //echo '<pre/>';print_r($sales_task); die('data');
										$i = 1;
										foreach($sales_task as $hoval){
											
								 ?>
								<tr class="odd gradeX">
									<td><?php echo $hoval['firstname'].' '.$hoval['lastname'];?></th>
									<td><?php echo $hoval['task_name']; ?></td>
									<td><?php echo $hoval['task_description']; ?></td>
									<td><?php echo $hoval['start_date']; ?></td>
									<td class="center"><?php echo $hoval['end_date']; ?></td>
									<td class="center"><?php echo $hoval['close_date']; ?></td>
									<td class="center"><form method="post">
										<?php
										if($hoval['status'] == 0){
											echo '<div class="btn-group">
												
													<button type="submit" name="" value="'.$hoval['staff_id'].'" class="btn btn-warning dropdown-toggle js-location-create" data-toggle="dropdown">
												Deactivated
												 <span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													<li>
														<form method="post">
														<button type="submit" name="deactive" value="'.$hoval['staff_id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-bolt"></i> Activate Task
														</a>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button type="button" data-id="'.$hoval['id'].'" class="edit_task" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete" value="'.$hoval['id'].'"  class="js-user-delete" >
														<i class="fa fa-trash-o"></i> Delete </button>
														</form>
													</li>
												</ul>
												</div>';
										}else{
											echo '<div class="btn-group">
											
												<button type="submit" name=""  value="'.$hoval['staff_id'].'" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
															Active
												<span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													 <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$hoval['staff_id'].'"  class="js-user-disable">
														<i class="fa fa-minus-circle"></i>  Disable Task
														</button>
														</form>
														
													</li> 
													<li>
														<form action="" method="post">
														<button type="button" data-id="'.$hoval['id'].'" class="edit_task" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete" value="'.$hoval['id'].'"  class="js-user-delete" >
														<i class="fa fa-trash-o"></i> Delete </button>
														</form>
													</li>
												</ul>
											</div>';
										}
									 ?>
									 </form>
 
									</td>
								</tr>
							<?php 
								$i++; } }
							?> 
							</tbody>
						</table>
					</div>
					<button type="button" class="btn-green btn-success js-location-create" data-toggle="modal" data-target="#exampleModal">
						Add New Task
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create User</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="" novalidate="novalidate">
    				<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale">Select Staff Member</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-language"></i></span>
									<select id="input_locale" class="form-control" name="staff_id" title="staff_id" required>
										<?php foreach($all_staff as $val){?>
											<option value="<?php echo  $val['uid'];?>"><?php echo  $val['firstname'].' '. $val['lastname'];?></option>               
										<?php }?> 
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Task Name</label>
                				<div class="input-group">
                    				<span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    				<input class="form-control" name="task_name" autocomplete="off" value="" placeholder="Enter task name" type="text">
                				</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Task Description</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="task_description" autocomplete="off" value="" placeholder="Enter task description" type="text">
								</div>
							</div>
						</div>               
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Start date</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="start_date" autocomplete="off" value="" placeholder="Enter start date" type="text">
								</div>
							</div>
						</div>
                        <div class="col-sm-6">
							<div class="form-group ">
								<label>End date</label>
								<div class="input-group">
									<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
									<input class="form-control" name="end_date" autocomplete="off" value="" placeholder="Enter end date" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group ">
								<div class="creatUserBottom">
									<div class="">
										<div class="vert-pad">
											<button type="submit" name="save" class="btn-green">Create Task</button>
										</div>          
									</div>
								</div>
							</div>  
						</div><br>
					</div>
				</form>
        	</div>
		</div>
	</div>  
</div> 
<!-- edit task modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create User</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="" id="task_modal" novalidate="novalidate">
    				<div id="form-alerts"></div>
					<div class="row">
						<div class="taskdiv">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale">Select Staff Member</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-language"></i></span>
									<select id="input_locale" class="form-control" name="staff_id" title="staff_id" required>
										<?php foreach($all_staff as $val){?>
											<option value="<?php echo  $val['uid'];?>" id="staffname" ><?php echo  $val['firstname'].' '. $val['lastname'];?></option>               
										<?php }?> 
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Task Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="task_name" id="taskname" autocomplete="off" value="" placeholder="Enter task name" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Task Description</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" id="taskdescription" name="task_description" autocomplete="off" value="" placeholder="Enter task description" type="text">
								</div>
							</div>
						</div>               
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Start date</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" id="startdate" name="start_date" autocomplete="off" value="" placeholder="Enter start date" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label>End date</label>
								<div class="input-group">
									<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
									<input class="form-control" id="enddate" name="end_date" autocomplete="off" value="" placeholder="Enter end date" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group ">
								<div class="creatUserBottom">
									<div class="">
										<div class="vert-pad">
											<button type="submit"  name="update_task" class="btn-green">Edit Task</button>
										</div>          
									</div>
								</div>
							</div>  
						</div><br>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>  
</div>   

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 


<script>
$(document).ready(function(){
	$(".edit_task").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/sales/edit_staff_task",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".taskdiv").html(response);
				$('#editModal').modal('show')   
			} 
	 
		});
	});
});
</script>