<div id="page-wrapper">
	  <?php $this->load->view('ondemand/new-sidebar'); ?>
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
    <div class="row">
        <div class="col-lg-12">
		
            <div class="panel panel-default">
               
                <div class="panel-body">
					<button type="button" class="btn-green js-location-create"data-toggle="modal" data-target="#exampleModal" >
						Create New Sub Category
					</button><br><br>
                    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>S.NO<i class="fa fa-sort"></i></th>
									<th>Category Name<i class="fa fa-sort"></i></th>
									<th>Sub Category Name<i class="fa fa-sort"></i></th>
									<th>Added By<i class="fa fa-sort"></i></th>
									<th>Created<i class="fa fa-sort"></i></th>
									<th>Status/Action<i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
							<?php 
							$i='1';
							foreach($allsub_cat as $subctg)
							{ ?>
								<tr>
									<td><?=$i;?></td>
									<td><?=$subctg['maincategory_nm']?></td>
									<td><?=$subctg['sub_category']?></td>
									<td>
									<?php 
									$usertype=$subctg['user_type'];
									if($usertype == 1){ echo 'Driver';}
									else if($usertype == 2){echo 'Doctor';}
									else if($usertype == 3){echo 'Store'; }
									else if($usertype == 4){echo 'Sales'; }
									else if($usertype == 5){echo 'Admin'; }
									else if($usertype == 0){echo 'User'; }
									?>
									</td>
									<td><?=$subctg['date']?></td>
									<td>
										<?php 
										if($subctg['status']==1)
										{
											echo '<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
													Enable
													<span class="caret"></span>
												</button>            
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="javascript:void(0)" style="background: transparent;" data-id="'.$subctg['id'].'" class="js-sub-cat-edit">
												<i class="fa fa-edit"></i> Edit 
												</a>
											</li>

											<li>
												<form action="" method="post">
												<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$subctg['id'].'" id="enable" data-id="'.$subctg['id'].'" class="js-user-disable">
												<i class="fa fa-minus-circle"></i>  Disable 
												</button>
												</form>

											</li>
											<li>
												<form action="" method="post">
												<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the Sub Category ?\');" type="submit" name="delete" value="'.$subctg['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
												<i class="fa fa-trash-o"></i> Delete </button>
												</form>
											</li>
										</ul>
									</div>';
										}else{
									echo ' <div class="btn-group">


											   <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
												   Disabled
												   <span class="caret"></span>
											   </button>            


									   <ul class="dropdown-menu" role="menu">

										   <li>
											   <a href="javascript:void(0)" data-id="'.$subctg['id'].'" class="js-sub-cat-edit"  data-toggle="modal">
											   <i class="fa fa-edit"></i> Edit 
											   </a>
										   </li>

										   <li>
											   <form action="" method="post">
											   <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$subctg['id'].'" id="disable" data-id="'.$subctg['id'].'" class="js-user-disable">
											   <i class="fa fa-minus-circle"></i> Enable 

											   </button>
											   </form>
										   </li>
										   <li>
											   <form action="" method="post">
											   <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the Sub Category ?\');" type="submit" name="delete" value="'.$subctg['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
											   <i class="fa fa-trash-o"></i> Delete 
											   </button>
											   </form>
										   </li>
									   </ul>
								   </div>'; }
										?>
										
									</td>
								</tr>
							<?php
							$i++;
							}
							?>
                            <tbody>
								
                            </tbody>
                        </table>
                    </div>    
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
							Create New Sub Category
					</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD CATEGORY MODAL   -->  
   
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create New Sub Category</h4>
			</div>
			<div class="modal-body">     
				<form name="sub_category" method="post" action="">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Category Name </label>
								<select class="form-control" name="main_category">
									<?php foreach($all_cat as $v_catg){ ?>
									<option value="<?=$v_catg['id']?>"><?=$v_catg['name']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Sub Category Name </label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="sub_category" autocomplete="off" value="" placeholder="" required="" aria-required="true" type="text">
								</div>
							</div>
						</div>
			
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name='save' class="btn-green">
											Create Sub Category
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

<!--   EDIT CATEGORY MODAL    -->
<div class="modal fade" id="editsubcategory" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Update Sub Category</h4>
			</div>
			<div class="modal-body">     
				<form name="edit_subcategory_Modal" id="edit_subcategory_Modal" method="post" action="" >
					<div id="form-alerts"></div>
					<div class="row">
						<div class="editsubcatdiv">
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div>
</div>


<script>
	$(".js-sub-cat-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_Subcat",
			data: "&id="+id,
			success: function(response){
				$(".editsubcatdiv").html(response);
				$('#editsubcategory').modal('show')   
			} 
	 
		});
	});
	</script>