
 <script type="text/javascript" src="<?=base_url()?>public/js/nicEdit-latest.js"></script>
 <script>
	   bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('task_details');
        new nicEditor().panelInstance('message_details');
  });
</script>
<style>
	label.error{
		color: red;
		font-weight: 400;
	}
</style>
 
<div id="page-wrapper">
	<?php 
		 $this->load->view('admin/top_tab_header');
	?>
	<div class="row">
		<div class="col-lg-12">
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
			<div id="msgsuccess"></div>
			<form method="post" action="<?=base_url()?>panels/supermacdaddy/dashboard/general_sales" enctype="multipart/form-data">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="pull-left">
					<div class="col-sm-12 form-group">
							<label>Attach File </label>
							<div class="input-group">
								<input name="image" type="file" id="create_taskimage" required/>
							</div>
						</div>
					</div>
					
					<div class="pull-right">
						<div class="form-group" align="right">
							<button type="submit" name="save_task" id="save_task" class="btn-green">Upload</button>
						</div>
						
					</div>
				</div>
			</div>
			</form>
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> General sales
					<div class="pull-right">
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>S.No. <i class="fa fa-sort"></i></th>
									<th>Email <i class="fa fa-sort"></i></th>
									<th>Contact<i class="fa fa-sort"></i></th>
									<th>Zip<i class="fa fa-sort"></i></th>
									<th>Username<i class="fa fa-sort"></i></th>
									<th>Location<i class="fa fa-sort"></i></th>
									<th>Type<i class="fa fa-sort"></i></th>
									<th>Status<i class="fa fa-sort"></i></th>
									<th>Action<i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($gen as $val) {
								?>
								<tr class="odd gradeX">
									<td><?php echo $val['s_no']; ?></td>
									<td><?php echo $val['email']; ?></td>
									<td><?php echo $val['contact_no']; ?></td>
									<td><?php echo $val['zip']; ?></td>
									<td><?php echo $val['username']; ?></td>
									<td><?php echo $val['location']; ?></td>
									<td><?php echo $val['type']; ?></td>
									<td>
										<button type="button" class="btn btn-success">Approved</button>            
									</td>
									<td align="center">
										<button type="button"  class="btn btn-info" data-toggle="modal" data-target="#compose_message_model">Send Mail</button>
										<a class="btn btn-info update" role="button" id="<?php echo $val['s_no']; ?>" ><i class="fa fa-edit"></i></a>
										<a href="<?= base_url() ?>panels/supermacdaddy/dashboard/delete_group/<?=  $val['s_no'] ?>" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
									<?php }?>
							</tbody>
	
						</table>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<div class="modal fade" id="edit_sale" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header title-bar-orange">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!--<h4 class="modal-title"></h4>-->
		  <h5 class="modal-title" style="color:#fff;width:93%;float:left;font-weight: bold;"><i class="fa fa-tasks"> Update Data</i></h5>
        </div>
        <div class="modal-body">
			
			<form method="post" action="<?=base_url()?>panels/supermacdaddy/dashboard/edit">
			<div class="form-group">
				<label>S.No</label>
				<input class="form-control" type="number" name="s_no" id="s_no" required/>
				<label>Email</label>
				<input class="form-control" type="email" name="email" id="email" required/>
				<label>Contact No</label>
				<input class="form-control" type="tel" name="contact_no" id="contact_no" required/>
				<label>Zip</label>
				<input class="form-control" type="text" name="zip" id="zip" required/>
				<label>User Name</label>
				<input class="form-control" type="text" name="username" id="username" required/>
				<label>Location</label>
				<input class="form-control" type="text" name="location" id="location" required/>
				<label>Type</label>
				<input class="form-control" type="text" name="type" id="type" required/>
			</div>
				<button type="submit" name="edit" id="edit" class="btn-green">Update</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$(".datetimepicker4").datepicker({
			format: 'yyyy-mm-dd',
		    autoclose: true,
		});
		
		$("#dataTables-example").on('click', '.update', function(){
			var srid = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_group",
				data: "srid="+srid,
				dataType: "json",
				success: function(data)
				{
					$("#s_no").val(data.s_no);
					$("#email").val(data.email);
					$("#contact_no").val(data.contact_no);
					$("#zip").val(data.zip);
					$("#username").val(data.username);
					$("#location").val(data.location);
					$("#type").val(data.type);
					$('#edit_sale').modal('show');
				}
			});
		});
		
		$("#edit_sale").on('click', '#edit', function(){
			var srid = $(this).attr('id');
			$("#s_no").val();
			$("#email").val();
			$("#contact_no").val();
			$("#zip").val();
			$("#username").val();
			$("#location").val();
			$("#type").val();
			$.ajax({
				type: 'POST',
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit",
				data: "srid="+srid,
				dataType: "json",
				success: function()
				{
//					$("#s_no").val(data.s_no);
//					$("#email").val(data.email);
//					$("#contact_no").val(data.contact_no);
//					$("#zip").val(data.zip);
//					$("#username").val(data.username);
//					$("#location").val(data.location);
//					$("#type").val(data.type);
//					$('#edit_sale').modal('show');
				}
			});
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
		
		
		
		$(".js-staff-edit").click(function(){
			var id =$(this).attr("data-id");
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/aut_users",
				data: "&id="+id,
				success: function(response){
					$(".saleseditdiv").html(response);
					$('#edit_sale_Modal').modal('show')   
				} 

			});
		});
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
					remote: {
						url: "ufuser_EmailCheck",
						type: "post"
					}
				},
				contact:"required",
				title:"required",
				
			},
			messages: {
				user_name	: "Please enter username",
				display_name: "Please enter display name",
				email:{
					required: "Please provide a email",
					remote: "email already in use!",
				},
				contact		: "Please enter contact",
				title		: "Please enter user type",
				
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
		
		
		
		
	});
</script>