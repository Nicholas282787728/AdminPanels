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
                    <i class="fa fa-folder mr-5"></i>Our Team
<!--					<div class="pull-right">
						<button id="table-categories-download" class="btn btn-sm btn-normal">Download CSV</button>
					</div>-->
                </div>
                <div class="panel-body">
					<button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal" >
						Create Our Team
					</button><br><br>
                    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover medconnex15" id="dataTables-example">
                            <thead>
                                <tr>
									<th>S.NO<i class="fa fa-sort"></i></th>
									<th>Our Team Name<i class="fa fa-sort"></i></th>
									<th>Our Team Image<i class="fa fa-sort"></i></th>
									<th>Status/Action<i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $i=1;
								foreach($all_cat as $val){
									$our_team_image=$val['our_team_image'];
									$imageurl=base_url('uploads/'.$our_team_image);
									echo '<tr class="odd gradeX">
									<td>'.$i.'</td>
									<td>'.$val['our_team_name'].'</td>
									<td><img src='.$imageurl.' width="200px" height="200px"></td>';
							   echo '
									<td class="center">';
									if($val['status']==1){
									echo '<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
													Enable
													<span class="caret"></span>
												</button>            
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="#" data-id="'.$val['id'].'" class="js-our-edit">
												<i class="fa fa-edit"></i> Edit 
												</a>
											</li>

											<li>
												<form action="" method="post">
												<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$val['id'].'" data-id="'.$val['id'].'" class="js-user-disable">
												<i class="fa fa-minus-circle"></i>  Disable 
												</button>
												</form>

											</li>
											<li>
												<form action="" method="post">
												<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the category ?\');" type="submit" name="delete" value="'.$val['id'].'" class="js-user-delete" data-user_name="Ajay" >
												<i class="fa fa-trash-o"></i> Delete </button>
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
                    <a href="#" data-id="'.$val['id'].'" class="js-our-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit 
                    </a>
                </li>
               
                <li>
                	<form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'"  data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i> Enable 
					
                    </button>
                	</form>
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the Category ?\');" type="submit" name="delete" value="'.$val['id'].'" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete 
					</button>
                	</form>
                </li>
            </ul>
        </div>'; }
					echo	'</td>
							</tr>';
							$i++; }?>
                            </tbody>
                        </table>
                    </div>    
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
							Create Our Team
					</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  ADD CATEGORY MODAL   -->  
   
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create Our Team</h4>
			</div>
			<div class="modal-body">     
				<form name="location" method="post" action="" novalidate="novalidate" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Our Team Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="our_team_name" autocomplete="off" value="" placeholder="" required="" aria-required="true" type="text">
								</div>
							</div>
						</div>
					<div class="col-sm-6">
							<div class="form-group">
								<label>Our Team Image</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control get_image" type="file" name="image" id="get_image" autocomplete="off" value="" placeholder="" required="" aria-required="true" type="text">
								</div>
								<img src="" class="myImg1" style="max-width:200px;max-height:200px;">
							</div>
						</div>  
			 
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name='save' class="btn-green">
											Create our team
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
				</form>
			</div>
		</div>  
	</div>
</div>

<!--  EDIT CATEGORY MODAL   -->
<div class="modal fade" id="editcategory" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Update Our Team</h4>
			</div>
			<div class="modal-body">     
				<form name="edit_category_Modal" id="edit_our_team_Modal" method="post" action="" novalidate="novalidate" enctype="multipart/form-data">
					
					<div class="editcatdiv">
					</div>
			
				
				</form>
			</div>
		</div>  
	</div>
</div>


<script type="text/javascript">
	 $(document).on('change', '#get_image',function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded1;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded1(e) {


			  var dataImage= $('#get_image').prop('files')[0];
			  var fileName = dataImage.name;
			  var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			  var validExtensions = ['jpg','png','jpeg','JPEG','JPG','PNG']; //array of valid extensions
			   if ($.inArray(fileNameExt, validExtensions) == -1) {
                  alert('please upload images only')
                }else{
                   $('.myImg1').attr('src', e.target.result);
                  
               }
			
		};
</script>