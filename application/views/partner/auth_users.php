<div id="page-wrapper">
	 <?php $this->load->view('partner/new-sidebar'); ?>
	<style>
	label.error{
		color:red;
		font-weight: 400;
	}
	.radio label.error{
		position: absolute;
		right: 100px;
		top: 25px;
	}
</style>
	<div class="row">
		<div class="col-lg-12">  <!-- <h1 class="page-header">Authroized Users</h1> -->
		<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if (!empty(@$error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('error_msg') . "</div>";
			}
			?>
	</div>
	</div>

	
	<div class="row">
		<div class="col-lg-12">

		   <div class="panel panel-default">
				<div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
					<i class="fa fa-users" aria-hidden="true"></i> Authroized Users
					
				</div>
				<div class="panel-body">
					<?php
					if($userdetails->service_type == "Premium")
					{
					?>
					<button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
						Create New User
					</button>
					<?php
					}
					?>
					
					<div class="table-responsive">
						<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>S.No <i class="fa fa-sort"></i></th>
									<th>Name <i class="fa fa-sort"></i></th>
									<th>Display name <i class="fa fa-sort"></i></th>
									<th>User Type <i class="fa fa-sort"></i></th>
									<th>Email <i class="fa fa-sort"></i></th>
									<th>Contact<i class="fa fa-sort"></i></th>									
									<th>Status/action <i class="fa fa-sort"></i></th>                                        
								</tr>
							</thead>
							<tbody>
							<?php $sno=1;	
							foreach($all_staff as $val){
								//if($val['user_type'] == 'Admin' || $val['user_type'] == 'Sales' ){
							
									?>
									
									<tr class="odd gradeX">
									<td><?=$sno?></th>
									<td><?php echo  $val['user_name'];?></th>
									<td><?php echo  $val['display_name'];?></td>
									<td>
											<?php if($val['user_type']==0){
												echo "User";
											}elseif($val['user_type']==1){
												echo "Driver";
											}elseif($val['user_type']==2){
												echo "Doctor";
											}elseif($val['user_type']==3){
												echo "Storefront";
											}
											
											?>
									</td>
									 <td><?php echo  $val['email'];?></td>
									<td><?php echo  $val['mob_number'];?></td> 
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
                    <a href="javascript:void(0)" data-id="'.$val['id'].'" class="js-staff-edit"  data-toggle="modal">
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
                    <a href="javascript:void(0)" data-id="'.$val['id'].'" class="js-staff-edit" data-toggle="modal">
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
							<?php //}
							$sno++;}?>
							</tbody>
						</table>
					</div>
				<!-- 	<button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">
						Add New User
					</button> -->
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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i> Create New Providers</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="createuser" id="createuser" method="post" action="" >
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>User Name</label>
								<input class="form-control" name="user_name" autocomplete="off" value="" placeholder="Please enter the First Name" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
									<input class="form-control" name="display_name" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
							</div>
						</div>               
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Provider Type </label>
								<select id="input_locale" class="form-control" name="user_type" title="Locale" required>
									<option value="">Select Provider</option>
									<option value="1">Driver</option>
									<option value="2">Doctor</option>
									<option value="3">Storefront</option>
								</select>
								
										
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
									<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
									<input class="form-control" name="contact" autocomplete="off" placeholder="" type="text">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale">Locale</label>
								<select id="input_locale" class="form-control" name="locale" title="Locale">
										<option value="de_DE">de_DE</option>
										<option value="en_US" selected="">en_US</option>
										<option value="es_ES">es_ES</option>
										<option value="fr_FR">fr_FR</option>
										<option value="it_IT">it_IT</option>
										<option value="nl_NL">nl_NL</option>
										<option value="pt_BR">pt_BR</option>
										<option value="ro_RO">ro_RO</option>
										<option value="th_TH">th_TH</option>
										<option value="tr_TR">tr_TR</option>
								</select>
							</div>
						</div>

					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="creatUserBottom">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="save" class="btn-green">Create User		</button>
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

<div class="modal fade" id="edit_sale_Modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update User</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="" novalidate="novalidate">
					<div id="form-alerts"></div>
					<div class="authedit">
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
									<button type="submit" name="updatesale" class="btn-green">Update User</button>
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

<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	
	$("#createuser").validate({
			rules: {
				user_name:"required",
				display_name:"required",
				user_type:"required",
				email: {
					required: true,
					email: true,
					remote: {
						url: "ufuser_EmailCheck",
						type: "post"
					}
				},
				contact:"required",
				locale:"required",
				
			},
			messages: {
				user_name	: "Please enter username",
				display_name: "Please enter display name",
				user_type		: "Please select provider",
				email:{
					required: "Please provide a email",
					remote: "email already in use!",
				},
				contact		: "Please enter contact",
				locale		: "Please enter locale",
				
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
		
		
		
	})
	</script>