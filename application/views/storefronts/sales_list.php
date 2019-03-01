
 <script type="text/javascript" src="<?=base_url()?>public/js/nicEdit-latest.js"></script>
 <script>
 	// bkLib.(function() {
		//         new nicEditor().panelInstance('task_details');
		//         new nicEditor().panelInstance('message_details');
		//   });
 	function editor () {
 	
 		// bkLib.onDomLoaded(function() {
		        new nicEditor().panelInstance('task_details');
		        new nicEditor().panelInstance('message_details');
		  // });
 	}
</script>
<style>
	label.error{
		color: red;
		font-weight: 400;
	}
</style>
 
<div id="page-wrapper">
	<?php 
		 $this->load->view('storefronts_templates/new-sidebar');
	?>
	<div class="row">
		<div class="col-lg-12">
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
			<div id="msgsuccess"></div>
			<div class="panel panel-default medconnex5-panel">
				
				<div class="panel-body medconnex5-body">
					<div class="pull-left medconnex5-left b_new">
						<button type="button" class="btn-green  " data-toggle="modal" data-target="#exampleModal">Create New Contractors</button>
					<!-- 	<button type="button" class="btn-green  " data-toggle="modal" data-target="#create_task">Create Task</button>
						<button type="button" class="btn-green  " data-toggle="modal" data-target="#send_message">Send Message</button> -->
					</div>
					
					
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue medconnex5-blue">
					<div class="row">
						<div class="col-md-6 panel-heading-responsive">
							<span><i class="fa fa-users" aria-hidden="true"></i> Contractor / Staff</span>
						</div>
						<div class="col-md-6 text-right medconnex5-blueright heading-responsive">
							<b>Total Contractors : <?=$totalContractors->totalcontractor?> </b>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="table-responsive">
							<table width="100%" class="table table-striped table-bordered table-hover medconnex5" id="dataTables-example">
								<thead>
									<tr class="first-row">
										<th>Contractor Name <i class="fa fa-sort"></i></th>
										<th>Contact<i class="fa fa-sort"></i></th>
										<th>Email <i class="fa fa-sort"></i></th>
										<th>User Type <i class="fa fa-sort"></i></th>
										<!-- <th>Display name <i class="fa fa-sort"></i></th> -->
										<th>Contracted Date<i class="fa fa-sort"></i></th>
										<th>Action <i class="fa fa-sort"></i></th>
										<th>Completed Task <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($all_staff as $val) {
									?>
										<tr class="odd gradeX">
											<td><?php echo $val['user_name']; ?></td>
											<td><?php echo $val['mob_number']; ?></td>
											<td><?php echo $val['email']; ?></td>
											<td>
												<?php ///echo $val['user_type']; 
												$user_type=$val['user_type'];
												$title='';
												if($user_type == 5){
														$title="Admin";
													}elseif($user_type == 4){
														$title="Sales";
													}elseif($user_type == 6){
														$title="Promotions";
													}elseif($user_type == 7){
														$title="Marketing";
													}elseif($user_type == 8){
														$title="Development";
													}elseif($user_type == 9){
														$title="Editorial";
													}
													echo $title;
												?>
											</td>
										<!-- 	<td><?php echo $val['display_name']; ?></td> -->
											<td><?php echo $val['created_at']; ?></td>
											<td class="center">
											<form action='' method='post'>
											<?php
											if ($val['flag_enabled'] == 0) {
												echo '<div class="btn-group">
													<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
														Unactivated
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li>
															<a href="#" data-id="' . $val['id'] . '" class="js-staff-edit"  data-toggle="modal">
															<i class="fa fa-edit"></i> Edit staff
															</a>
														</li>
														<li>
															<form action="" method="post">
															<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="' . $val['id'] . '" id="enable" data-id="' . $val['id'] . '" class="js-staff-enable">
															<i class="fa fa-minus-circle"></i> Enable staff
															</button>
															</form>
														</li>
														<li>
															<form action="" method="post">
															<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the Staff ?\');" type="submit" name="delete" value="' . $val['id'] . '" id="disable" class="js-staff-delete" data-user_name="Ajay" >
															<i class="fa fa-trash-o"></i> Delete staff</button>
															</form>
														</li>
													</ul>
												</div>';
											} else {
												echo '<div class="btn-group">
												<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
													Active
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" role="menu">

												   <li>
														<a href="#" data-id="' . $val['id'] . '" class="js-staff-edit" data-toggle="modal">
														<i class="fa fa-edit"></i> Edit staff
														</a>
													</li>
												   <li>
												   <button type="button" style="padding: 1px 20px;border: none;background: transparent;" class="js-staff-enable taskDetails"  data-id="' . $val['id'] . '" >Task Details</button>
												
														
													</li>
													 <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="' . $val['id'] . '" id="disable" data-id="' . $val['id'] . '" class="js-staff-disable">
														<i class="fa fa-minus-circle"></i>  Disable staff
														</button>
														</form>

													</li>

													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user ?\');" type="submit" name="delete" value="' . $val['id'] . '" id="disable" class="js-user-delete" data-user_name="Ajay" >
														<i class="fa fa-trash-o"></i> Delete staff</button>
														</form>
													</li>
												</ul>
											</div>';
											}
											?>
											</form>
											</td>
											<td class="center">
												<?php
													$total_task =$val['totals'];
													$total_comple=$val['completed'];
													$persatage_completed='0';
													if(!empty($total_task))
													{
														$persatage_completed=(100/$total_task)*$total_comple;
													}
													echo round($persatage_completed,2).'%';
												?>
											</td>
										</tr>

	

									<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<button type="button" class="btn-green  js-location-create" data-toggle="modal" data-target="#exampleModal">Create New Contractors</button>
						<!-- <button type="button" class="btn-green  " data-toggle="modal" data-target="#create_task">Create Task</button>
						<button type="button" class="btn-green  " data-toggle="modal" data-target="#send_message">Send Message</button> -->
					</div>
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
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create New Contractors</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" id="create_user" method="post" action="">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Contractor Name</label>
								<input class="form-control" name="user_name" autocomplete="off" value=""  placeholder="Please enter the username" required="required" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
									<input class="form-control"  name="display_name" autocomplete="off" value="" placeholder="Please enter the Display Name" type="text">
							</div>
						</div>    

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
								<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" required="" type="email">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
								<input class="form-control"  name="contact" autocomplete="off" placeholder="" type="text">
							</div>
						</div>
					<!-- 	<div class="col-sm-6">
							<div class="form-group ">
								<label>User Type</label>
								<select id="input_locale" class="form-control" name="user_type"  required="">
								
									<option value="4">Sales</option>
									<option value="6">Promotions</option>
									<option value="7">Marketing</option>
									<option value="8">Development</option>
									<option value="9">Editorial</option>
								</select>
								<input class="form-control"  name="user_type"  placeholder="" type="text">

							</div>
						</div> -->
							<div class="col-sm-6">
							<div class="form-group ">
								<label>User Type</label>
								<select id="input_locale" class="form-control" name="user_type" required>
									<option value="5">Admin</option>
									<option value="4">Sales</option>
									<option value="6">Promotions</option>
									<option value="7">Marketing</option>
									<option value="8">Development</option>
									<option value="9">Editorial</option>
								</select>
							</div>
						</div>
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="save" class="btn-green">Create Contractors</button>
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

<!----------- 	EDIT SALES MODAL  ------------->	
<div class="modal fade" id="edit_sale_Modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Staff</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="">
					<div id="form-alerts"></div>
					<div class="saleseditdiv">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Contractor Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control" name="user_name" autocomplete="off" value=""  placeholder="Please enter the username"  required="required" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Display Name</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control"  name="display_name" autocomplete="off" value="" placeholder="Please enter the Display Name" required="required" type="text">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Email</label>
									<div class="input-group">
										<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
										<input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" required="required" type="email">
										<?= form_error('email'); ?>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group ">
									<label>Contact </label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<input class="form-control"  name="contact" autocomplete="off" placeholder="" required="required" type="text">
										<?= form_error('contact'); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group ">
									<label>User Type</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-edit"></i></span>
										<!-- <select id="input_locale" class="form-control" name="title" title="Locale" required>
											<option value="Sales">Sales</option>
										</select> -->
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


<a id="advertisment"  data-toggle="modal" data-target="#myModal1"></a>
												

									<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-tasks" ></i> Task Details</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="create_task_form" id="create_task_form" method="post" action="" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
						
						
							<div class="col-sm-12 form-group"   style="overflow-y: auto;">
								<label>Task Details</label>
								<div class="input-group">
									<input type="hidden" name="id" id="id" value="">
									<textarea class="form-control task_details" id="task_details" name="task_description" rows="4" cols="20" style="width:530% !important; height:100%;"></textarea>
								</div>
							</div>
							<div class="col-sm-12 form-group">
								<label>Attach File </label>
								<div class="input-group">
									<input name="image" type="file" id="create_taskimage">
									<span id="setcreate_taskimage"></span>
									<input name="remove_image_task" type="hidden" id="get_imagetask_hidden">
								</div>
								<span class="docurl"></span>
								<img src="" id="myImg"  style="max-width:100px;max-height:100px;"/>
								<input type="hidden" id="myImg1" name="myImg" value="">

							</div>
						</div>
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updateTask" class="btn-green">Update Task</button>
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

<!--/create task Modal/-->


<!--/Send message Modal/-->

<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$(".datetimepicker4").datepicker({
			format: 'yyyy-mm-dd',
		    autoclose: true,
		});
		
		
		
		
		$("#get_image").change(function () {
			
		var formData = new FormData();
		var file_data = $('#get_image').prop('files')[0];
		formData.append('image', file_data);
		$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/dataview",
			data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success:function(data){
                console.log(data.success);
				$('#setlinkcheck').html('<br><a href="<?=base_url()?>uploads/tmp_file/'+data.success+'"  target="_blank" style="font-size:20px;">view attachment </a>');
				$('#get_image_hidden').val(data.success);
            },
            error: function(data){
                console.log(data);
            }
			});
		
    });
	$("#create_taskimage").change(function () {
		var formData = new FormData();
		var file_data = $('#create_taskimage').prop('files')[0];
		formData.append('image', file_data);
		$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/dataview",
			data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success:function(data){
                console.log(data.success);
				$('#setcreate_taskimage').html('<br><a href="<?=base_url()?>uploads/tmp_file/'+data.success+'"  target="_blank" style="font-size:20px;">view attachment </a>');
				$('#get_imagetask_hidden').val(data.success);
            },
            error: function(data){
                console.log(data);
            }
			});
		
    });
		
		
		
		$('#category_provider').change(function(){
			var user_type = $(this).val();
			$.ajax({
				type: "POST",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/get_user_provider",
				data: "&user_type="+user_type,
				dataType: "json",
				success: function(response){
					$("#authorize_user").html(response.success);
				
				} 
			});
		})
		
		$('#category_provider_msg').change(function(){
			var user_type = $(this).val();
			$.ajax({
				type: "POST",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/get_user_provider",
				data: "&user_type="+user_type,
				dataType: "json",
				success: function(response){
					$("#send_msg_dep").html(response.success);
				
				} 
			});
		})
		
		
		
		// $(".js-staff-edit").click(function(){
		// 	var id =$(this).attr("data-id");
		// 	$.ajax({
		// 		type: "post",
		// 		url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/aut_users",
		// 		data: "&id="+id,
		// 		success: function(response){
		// 			$(".saleseditdiv").html(response);
		// 			$('#edit_sale_Modal').modal('show')   
		// 		} 

		// 	});
		// });
		$(".on_off").click(function(){
			var on_off_val= $(this).val();
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/hiring_on_off",
				data: "&on_off_val="+on_off_val,
				dataType:"json",
				success: function(response){
					if(response.success == true)
					{
						$('#msgsuccess').html(response.msg);
					}
					else 
					{
						alert('something wrong..!');
					}

				} 
			});
			
		});
		
		
		
		$("#create_user").validate({
			rules: {
				user_name:"required",
				display_name:"required",
				email: {
					required: true,
					email: true,
					
				},
				contact:"required",
				title:"required",
				
			},
			messages: {
				user_name	: "Please enter username",
				display_name: "Please enter display name",
				email:{
					required: "Please provide a email",
				},
				contact		: "Please enter contact",
				title		: "Please enter user type",
				
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
		
		$("#create_taskimage").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded(e) {
			  var dataImage= $('#create_taskimage').prop('files')[0];
			  var fileName = dataImage.name;
			  var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			  var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
			   if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurl').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                  $('#myImg').attr('src', '');
                }else{
                    $('#myImg').attr('src', e.target.result);
                    $('.docurl').html('');
               }



		};
		$("#get_image").change(function () {
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
			  var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
			   if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurl1').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                  $('#myImg1').attr('src', '');
                }else{
                   $('#myImg1').attr('src', e.target.result);
                   $('.docurl1').html('');
               }
			
		};
		
		
		
	});



	$('.taskDetails').click(function(){
			///alert('fgdh');


 		var id =$(this).attr("data-id");
	


				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>Storefronts/taskDetails",
					data: {id: id},
					success: function (response)
					{



					document.getElementById('advertisment').click();
						///$('.advertisment').trigger('click');
						//$('.email').empty('');
						// var responses = $.parseJSON(response);
						
						var json_obj = $.parseJSON(response);//parse JSON
						var obj = json_obj[0];
						var task_description = obj.task_description;
      
         
          				$('#task_details').text(task_description);
          				$('#id').val(obj.id);
          				
          				var imgurl = 'https://medconnex.net/demonil/uploads/';
          				$("#myImg").attr("src",imgurl+obj.attachment);
          				$('#myImg1').val(obj.attachment);

          				setTimeout(function(){
          					editor();
          				}, 100);
        //   				bkLib.onDomLoaded(function() {
						  //       new nicEditor().panelInstance('task_details');
						  //       new nicEditor().panelInstance('message_details');
						  // });


					}
					});


				});
</script>