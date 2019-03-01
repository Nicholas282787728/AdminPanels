<style>
.myclass {
    width: 20% !important;
	} 
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="<?php echo base_url(); ?>public/images/dash1.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div style="font-size: 12px;">Sales Staff Panel</div>
                        </div>
                    </div>
                </div>
				<a href="#">
					<div class="panel-footer adi-head-orange">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
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
							<img src="<?php echo base_url(); ?>images/dash2.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">12</div>
							<div style="font-size: 12px;">Certified Providers Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-blue">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
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
						   <img src="<?php echo base_url(); ?>public/images/dash3.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">124</div>
							<div style="font-size: 12px;">Affiliate Partners Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-per">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
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
							<img src="<?php echo base_url(); ?>public/images/dash4.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">13</div>
							<div style="font-size: 12px;">Support Tickets!</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-green">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
    </div>
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
					Users
				</div>
				<div class="panel-body">
				<!---	<button type="button" class="btn-green btn-success " data-toggle="modal" data-target="#staffmodal">
						Add New Staff Member
					</button><br><br> ---->
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							 <tr>
								<th>#</th>
								<th>Name</th>                                        
								<th>Email</th>
								<th>Contact</th>                                        
							<!--	<th>Task</th> --->
							</tr>
						</thead>
						<tbody>
							<?php 
							//echo "<pre>"; print_r($Sales); 
							$i = 1;
							foreach($Sales as $sale)
							{
							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $sale['firstname']." ". $sale['lastname']; ?></td>
								<td><?php echo $sale['email']; ?></td>                                        
								<td class="center"><?php echo $sale['contact']; ?></td>
							<!--	<td class="center"><form method="post">
										<?php
								/*		if($sale['status'] == 0){
											echo '<div class="btn-group">
												
													<button type="submit" name="" value="'.$sale['uid'].'" class="btn btn-warning dropdown-toggle js-location-create" data-toggle="dropdown">
												Deactivated
												 <span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													<li>
														<form method="post">
														<button type="submit" name="deactive" value="'.$sale['uid'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-bolt"></i> Activate Task
														</a>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button type="button" id="'.$sale['uid'].'" class="edit_staff" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_staff" value="'.$sale['uid'].'"  class="js-user-delete" >
														<i class="fa fa-trash-o"></i> Delete </button>
														</form>
													</li>
												</ul>
												</div>';
										}else{
											echo '<div class="btn-group">
											
												<button type="submit" name=""  value="'.$sale['uid'].'" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
															Active
												<span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													 <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$sale['uid'].'"  class="js-user-disable">
														<i class="fa fa-minus-circle"></i>  Disable Staff
														</button>
														</form>
														
													</li> 
													<li>
														<form action="" method="post">
														<button type="button" id="'.$sale['uid'].'" class="edit_staff" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_staff" value="'.$sale['uid'].'"  class="js-user-delete" >
														<i class="fa fa-trash-o"></i> Delete </button>
														</form>
													</li>
												</ul>
											</div>';
										}*/
									 ?>   
									 </form>
 
									</td>  --->
							   
							</tr>
							   <?php $i++; } ?>
						</tbody>
					</table>
				<!--	<button type="button" class="btn-green btn-success js-location-create" data-toggle="modal" data-target="#staffmodal">
					Add New Staff Member
					</button> ---->
				</div>
				
			</div>
		</div>
	</div> 
</div>

  <!-- Modal -->
<div class="modal fade" id="staffmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create Staff Member</h5>
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
								<label>First Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="firstname" autocomplete="off" value=""  placeholder="Please enter the First Name" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="lastname" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
								</div>
							</div>
						</div>               
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Username</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="username" autocomplete="off" value="" placeholder="Enter your username" type="text">
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
									<input class="form-control"  name="contact" maxlength= '10' autocomplete="off" placeholder="" type="text">
								</div>
							</div>
						</div>
						  
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Last Sign-in</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" name="last_sign_in_time" autocomplete="off" value="Brand new!" disabled="" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Registered Since</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" name="sign_up_time" autocomplete="off" value="Unknown" disabled="" type="text">
								</div>
							</div>
						</div>   
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save" class="btn-green">Create Sales Staff Account</button>
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

<!---------   EDIT STAFF MEMBER MODAL  --------->
<div class="modal fade" id="staffmember_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Staff Member</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="" novalidate="novalidate">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="staffmember-div">
							<div class="col-sm-6">
								<div class="form-group">
									<label>First Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control" name="firstname" autocomplete="off" value=""  placeholder="Please enter the First Name" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Last Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control"  name="lastname" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
									</div>
								</div>
							</div>               
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Username</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control"  name="username" autocomplete="off" value="" placeholder="Enter your username" type="text">
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
										<input class="form-control"  name="contact" maxlength= '10' autocomplete="off" placeholder="" type="text">
									</div>
								</div>
							</div>
							  
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Last Sign-in</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input class="form-control" name="last_sign_in_time" autocomplete="off" value="Brand new!" disabled="" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Registered Since</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input class="form-control" name="sign_up_time" autocomplete="off" value="Unknown" disabled="" type="text">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 


<script>
$(document).ready(function(){
	$(".edit_staff").click(function(){
		var id =$(this).attr("id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/sales/edit_staffmember",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".staffmember-div").html(response);
				$('#staffmember_modal').modal('show')   
			} 
	 
		});
	});
});
</script>