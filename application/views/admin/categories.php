<div id="page-wrapper">
	<?php 
		 $this->load->view('admin/top_tab_header');
	?>
    <div class="row">
        <div class="col-lg-12">
		<?php 
			@$success_msg = $this->session->flashdata('success_msg');
			if(!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg')."</div>";			
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if(!empty(@$error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('error_msg')."</div>";			
			}
		?>
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
                    <i class="fa fa-folder mr-5"></i>Categories
<!--					<div class="pull-right">
						<button id="table-categories-download" class="btn btn-sm btn-normal">Download CSV</button>
					</div>-->
                </div>
                <div class="panel-body">
					<button type="button" class="btn-green js-location-create"data-toggle="modal" data-target="#exampleModal" >
						Create New Category
					</button><br><br>
                    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover medconnex7" id="dataTables-example">
                            <thead>
                                <tr>
									<th>Name<i class="fa fa-sort"></i></th>
									<!-- <th>Type<i class="fa fa-sort"></i></th>
									<th>Industry<i class="fa fa-sort"></i></th>
									<th>Location<i class="fa fa-sort"></i></th>
									<th>Description<i class="fa fa-sort"></i></th>  -->
									<th>Added By<i class="fa fa-sort"></i></th>
									<th>Created<i class="fa fa-sort"></i></th>
									<th>Status/Action<i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($all_cat as $val){
									echo '<tr class="odd gradeX">
									<td>'.$val['name'].'</td>';

									 if($val['industry']==1){
										$industry='Microsoft';
									 }elseif($val['industry']==2){
										$industry='';
									 }else{
										$industry='';
									 }  
									 $location=''; 
							   echo '
									<td>'.$val['created_by'].'</td>
									<td class="center">'.$val['date'].'</td>

									<td class="center">';
									if($val['status']==1){
									echo '<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
													Enable
													<span class="caret"></span>
												</button>            
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="#" data-id="'.$val['id'].'" class="js-cat-edit">
												<i class="fa fa-edit"></i> Edit 
												</a>
											</li>

											<li>
												<form action="" method="post">
												<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$val['id'].'" id="enable'.$val['id'].'" data-id="'.$val['id'].'" class="js-user-disable">
												<i class="fa fa-minus-circle"></i>  Disable 
												</button>
												</form>

											</li>
											
										</ul>
									</div>'; }else{
					echo ' <div class="btn-group">
						<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Disabled
                        <span class="caret"></span>
                    </button>            
				<ul class="dropdown-menu" role="menu">
				<li>
                    <a href="#" data-id="'.$val['id'].'" class="js-cat-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit 
                    </a>
                </li>
               
                <li>
                	<form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="disable'.$val['id'].'" data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i> Enable 
					
                    </button>
                	</form>
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the Category ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disables'.$val['id'].'" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete 
					</button>
                	</form>
                </li>
            </ul>
        </div>'; }
        // <li>
								// 				<form action="" method="post">
								// 				<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the category ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disables'.$val['id'].'" class="js-user-delete" data-user_name="Ajay" >
								// 				<i class="fa fa-trash-o"></i> Delete </button>
								// 				</form>
								// 			</li>
					echo	'</td>
							</tr>';
							}?>
                            </tbody>
                        </table>
                    </div>    
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
							Create New Category
					</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------  ADD CATEGORY MODAL   --------------->  
   
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create New Category</h4>
			</div>
			<div class="modal-body">     
				<form name="location" method="post" action="" >
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Category Name or Title</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="category_name"    type="text" required="">
								</div>
							</div>
						</div>
				<!--	<div class="col-sm-6">
							<div class="form-group">
								<label>Category Type</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="category_type" autocomplete="off" value="" placeholder="" required="" aria-required="true" type="text">
								</div>
							</div>
						</div>  ----->
			 <!---      <div class="col-sm-6">
							<div class="form-group has-success has-feedback">
								<label for="input_locale">Industry</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-shield"></i></span>
									<select id="input_locale" class="form-control select2 select2-offscreen" name="industry" tabindex="-1" title="IndustryLocation" aria-required="true" aria-invalid="false" aria-describedby="input_locale-error">
										<option value=""> -- Choose One -- </option>
										<option value="1">Microsoft</option>
										<option value="2">Imvisile</option>
										<option value="3">Websys</option>
									</select>
								</div>
								<span id="input_locale-error" class="text-danger"></span><i class="fa fa-check form-control-feedback" aria-hidden="true"></i>
							</div>
						</div>    ----->
				<!----	<div class="col-sm-6">
							<div class="form-group">
								<label for="input_locale">Location</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-shield"></i></span>
									<select id="input_locale" class="form-control select2 select2-offscreen" name="location" tabindex="-1" title="IndustryLocation">
										<option value=""> -- Choose One -- </option>
										<option value="1">Navlakha</option>
										<option value="2">indore</option>
										<option value="3">Imvisile</option>
										<option value="4">Websys Technologies</option>
									</select>
								</div>
							</div>
						</div>  -------->
			<!----   	<div class="col-sm-12">
							<div class="form-group ">
								<label>Category Description</label>
								<div class="input-group" style="width: 100%;">
									<textarea name="description" style="width: 100%;" rows="5"></textarea>
								</div>
							</div>
						</div>  ---->
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								
										<button type="submit" name='save' class="btn-green">
											Create Category
										</button> 
								
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div>
</div>

<!------------    EDIT CATEGORY MODAL    ------------------>
<div class="modal fade" id="editcategory" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Update Category</h4>
			</div>
			<div class="modal-body">     
				<form name="edit_category_Modal" id="edit_category_Modal" method="post" action="" novalidate="novalidate">
					<div id="form-alerts"></div>
					<div class="row">
					<div class="editcatdiv">
						<div class="categorydiv">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Category Name or Title</label>
								<input class="form-control" id="category_id" name="category_id" type="hidden">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="category_name" autocomplete="off" value="" placeholder="" required="" aria-required="true" type="text">
								</div>
							</div>
						</div>
						</div>
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name='updatecategory' class="btn-green">
											Update Category
										</button> 
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
					</div>
				</form>
			</div>
		</div>  
	</div>
</div>


