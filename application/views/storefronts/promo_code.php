<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12"><h1 class="page-header">Promo Codes</h1></div>
	
	<?php 
		@$success_msg = $this->session->flashdata('success_msg');
		if(!empty($success_msg)) {
			echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
			echo $this->session->flashdata('success_msg')."</div>";			
		}
	?>
	</div>
	<div class="row">
		<div class="col-lg-12">
		   <div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
					<i class="fa fa-users" aria-hidden="true"></i> 	Promo Code
					
				</div>
				<div class="panel-body">
					<button type="button" class="btn-green  " data-toggle="modal" data-target="#exampleModal">
						Add New Promo Code
					</button><br><br>
					<div class="table-responsive">
						<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Promo Code <i class="fa fa-sort"></i></th>
									<th>Promo Code Amount <i class="fa fa-sort"></i></th>
									<th>Start Date <i class="fa fa-sort"></i></th>
									<th>End Date <i class="fa fa-sort"></i></th>
									<th>Product Name<i class="fa fa-sort"></i></th>									
									<th>Status/action <i class="fa fa-sort"></i></th>                                        
								</tr>
							</thead>
							<tbody>
							<?php 	foreach($all_staff as $val){
								if($val['user_type'] == 'Admin' || $val['user_type'] == 'Sales' ){?>
									
									<tr class="odd gradeX">
									<td><?php echo  $val['name'];?></th>										
									<td><?php echo  $val['display_name'];?></td>
									 <td><?php echo  $val['user_type'];?></td>
									 <td><?php echo  $val['email'];?></td>
									<td><?php echo  $val['contact'];?></td>
									<td class="center">
										<form action='' method='post'>
										<?php
										if($val['flag_enabled']==0){
											echo '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Unactivated
                        <span class="caret"></span>
                    </button> 
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-staff-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit User
                    </a>
                </li>
                <li>
                	<form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="enable" data-id="'.$val['id'].'" class="js-staff-enable">
                    <i class="fa fa-minus-circle"></i> Enable User
                    </button>
                	</form>
                </li>
               
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-staff-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete User</button>
                	</form>
                </li>
            </ul>
        </div>';
										}else{
											echo '<div class="btn-group">
            
                
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        Active
                        <span class="caret"></span>
                    </button>            
            <ul class="dropdown-menu" role="menu">
				 
			   <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-staff-edit" data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit User
                    </a>
                </li>
                 <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$val['id'].'" id="disable" data-id="'.$val['id'].'" class="js-staff-disable">
                    <i class="fa fa-minus-circle"></i>  Disable User
                    </button>
                	</form>
                    
                </li>
                
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete User</button>
                	</form>
                </li>
            </ul>
        </div>';
										}
										
										?>
									</form>
										</td>
									</tr>
							<?php }
							}?>
							</tbody>
						</table>
					</div>
					<button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">
						Add New Promo Code
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Add Staff Modal    -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add New Promo Code</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="name" autocomplete="off" value=""  placeholder="Please enter the name" type="text">
								</div>
							</div> 
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="display_name" autocomplete="off" value="" placeholder="Please enter the Display Name" type="text">
								</div>
							</div> 
						</div>
						
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
								</div>
							</div>
						</div>
										 
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="contact" autocomplete="off" placeholder="" type="text">
								</div>
							</div>
						</div>
						  <div class="col-sm-6">
							<div class="form-group ">
								<label>User Type</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									 <select id="input_locale" class="form-control" name="user_type" title="Locale" required>
										<option value="Admin" selected="">Admin</option>
										<option value="Sales">Sales</option>
										
									</select>
								</div>
							</div>
						</div>
						
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save" class="btn-green">Create Promo Code </button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>

<div class="modal fade" id="edit_sale_Modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add New Promo Code</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="" novalidate="novalidate">
					<div id="form-alerts"></div>
					<div class="saleseditdiv">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>User Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="name" autocomplete="off" value=""  placeholder="Please enter the username" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="display_name" autocomplete="off" value="" placeholder="Please enter the Display Name" type="text">
								</div>
							</div>
						</div>
										 
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
								<div class="input-group">
									<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
									<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
								</div>
							</div>
						</div>
										 
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="contact" autocomplete="off" placeholder="" type="text">
								</div>
							</div>
						</div>
						  <div class="col-sm-6">
							<div class="form-group ">
								<label>User Type</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									 <select id="input_locale" class="form-control" name="user_type" title="Locale" required>
										<option value="Admin" selected="">Admin</option>
										<option value="Sales">Sales</option>
										
									</select>
								</div>
							</div>
						</div>
						
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatesale" class="btn-green">Update Promo Code</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

