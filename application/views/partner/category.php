<div id="page-wrapper">
	<?php $this->load->view('partner/new-sidebar'); ?>
	 <div class="row">
		<div class="col-lg-12">  <!-- <h1 class="page-header">Categories</h1> -->
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
	<div class="row">
		<div class="col-lg-12">
		   <div class="panel panel-default">
				<div class="panel-heading title-bar-blue" >
					<i class="fa fa-users" aria-hidden="true"></i>  Categories
					
				</div>
				<div class="panel-body">
					<button type="button" class="btn-green  " data-toggle="modal" data-target="#exampleModal">
						Add New Category
					</button><br><br>
					<div class="table-responsive">
						<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>S.No <i class="fa fa-sort"></i></th>
									<th>Category Name <i class="fa fa-sort"></i></th>
									<th>Status/action <i class="fa fa-sort"></i></th>                                        
								</tr>
							</thead>
							<tbody>
							<?php 	 
							$sno=1;
							foreach($all_staff as $val){
								?>
									
									<tr class="odd gradeX">
									<td><?php echo  $sno;?></th>										
									<td><?php echo  $val['name'];?></th>										
									
									<td class="center">
										<form action='' method='post'>
										<?php
										if($val['status']==0){
											echo '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Unactivated
                        <span class="caret"></span>
                    </button> 
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="javascript:void(0)" data-id="'.$val['id'].'" class="js-category-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit
                    </a>
                </li>
                <li>
                	<form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="enable" data-id="'.$val['id'].'" class="js-staff-enable">
                    <i class="fa fa-minus-circle"></i> Enable 
                    </button>
                	</form>
                </li>
               
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-staff-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete </button>
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
                    <a href="javascript:void(0)" data-id="'.$val['id'].'" class="js-category-edit" data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit 
                    </a>
                </li>
                 <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$val['id'].'" id="disable" data-id="'.$val['id'].'" class="js-staff-disable">
                    <i class="fa fa-minus-circle"></i>  Disable 
                    </button>
                	</form>
                    
                </li>
                
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
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
							<?php $sno++; }
							?>
							</tbody>
						</table>
					</div>
					<button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">
						Add New Category
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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create Category</h5>
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
								<label>Category Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="category_name" autocomplete="off" value=""  placeholder="Please enter the category name" type="text">
								</div>
							</div> 
						</div>
					
						  <div class="col-sm-6">
							<div class="form-group ">
								<label>Status</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									 <select id="input_locale" class="form-control" name="status" title="Locale" required>
										<option value="1" selected="">Active</option>
										<option value="0">Inactive</option>
										
									</select>
								</div>
							</div>
						</div>
						
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save" class="btn-green">Create User</button>
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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Category</h5>
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
								<label>Category Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="category_name" autocomplete="off" id="category_name" value=""  placeholder="Please enter the Category Name" type="text">
									<input type="hidden" name="id" id="id">
								</div>
							</div>
						</div>
					
						  <div class="col-sm-6">
							<div class="form-group ">
								<label>Status</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									 <select id="input_locale" class="form-control status" name="status"  title="status" required>
										<option value="1" >Active</option>
										<option value="0">Inactive</option>
										
									</select>
								</div>
							</div>
						</div>
						
						
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatecategory"  class="btn-green">Update User</button>
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

