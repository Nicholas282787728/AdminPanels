<div id="page-wrapper"> 
	<?php $this->load->view('partner/new-sidebar'); ?>
	<div class="row">
		<div class="col-lg-12">
			<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-success' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
				$checkava = !empty($comp->id) ? $comp->id : '';
			
			?>
			<div class="panel panel-default">
				<div class="panel-heading" style="font-weight:bold;">
					<i class="fa fa-edit"></i> Complimentary Ad
				</div>
				<div class="panel-body">
					
					<form name="user" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/<?=!empty($checkava)?'updateComp':'add_insertComp'?>" novalidate="novalidate">
						<input type="hidden" name="image_old" value="<?php echo!empty($comp->image) ? $comp->image : ''; ?>">
						<input type="hidden" name="id" value="<?php echo!empty($comp->id) ? $comp->id : ''; ?>">
						<div id="form-alerts"></div>
						<div class="row">
							<div class="col-sm-6">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Ad Title</label>
										<input class="form-control" name="title" autocomplete="off" value="<?php echo!empty($comp->title) ? $comp->title : ''; ?>" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Ad Size</label>
										<select class="form-control" name="ad_size" required="" id="ad_size">
											<?php
											if(!empty($comp->ad_size))
											{
											?>
											<option value="1080x1920" <?=($comp->ad_size =="1080x1920" )?'selected':'';?> >1080 x 1920</option>
											<?php	
											}
											else
											{
											?>
											<option value="1080x1920"  >1080 x 1920</option>
											<?php
											}
											?>
											
										</select>
										Please upload image in proper size menstion.
									</div>
								</div>               
								<div class="col-sm-6">
									<div class="form-group ">
										<label>Choose File</label>
										<input class="form-control" name="image" autocomplete="off" type="file" id="create_taskimage">
										<span id="setcreate_taskimage"><br><img src="<?=base_url()?>public/images/dummy.jpg" ></span>
										<input name="remove_image_task" type="hidden" id="get_imagetask_hidden">
										
										
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group ">
										<?php 
										if(!empty($checkava))
										{?>
										<img width="60" height="60" src="<?php echo base_url(); ?>uploads/<?php echo!empty($comp->image) ? $comp->image : ''; ?>">
										<?php }?>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group ">
										<label>Active Since </label>
										<input class="form-control datetimepicker4" type="text" name="created" value="<?php echo!empty($comp->created) ? date('Y-m-d', strtotime($comp->created)) : ''; ?>" autocomplete="off" placeholder="DD/MM/YYY" >
									</div>

								</div> 
							</div>
							<div class="col-sm-6 logo-upload" >
								<div class="form-group ">
									<label>Text Box </label>
									<textarea class="form-control" name="description" id="textarea" placeholder="" rows ="9" maxlength="200"><?php echo!empty($comp->description) ? $comp->description : ''; ?></textarea>
									<div id="textarea_feedback"></div>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="save" class="btn-green"><?=!empty($checkava)?'Update':'Save';?>Changes</button>
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
			<script>
				$(document).ready(function() {
					var text_max = 200;
					$('#textarea_feedback').html(text_max + ' characters remaining');

					$('#textarea').keyup(function() {
						maxlength();
					});
					
					maxlength();
					function maxlength()
					{
						var text_length = $('#textarea').val().length;
						var text_remaining = text_max - text_length;

						$('#textarea_feedback').html(text_remaining + ' characters remaining');
					}
				});
				
					$("#create_taskimage").change(function () {
						var formData = new FormData();
						var file_data = $('#create_taskimage').prop('files')[0];
						formData.append('image', file_data);
						var ad_size =$('#ad_size').val();
						formData.append('ad_size', ad_size);
						$.ajax({
							type:'POST',
							url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/temp_view",
							data: formData,
							cache:false,
							contentType: false,
							processData: false,
							dataType: "JSON",
							success:function(data){
								console.log(data.success);
								$('#setcreate_taskimage').html('<br><img src="<?=base_url()?>uploads/tmp_file/'+data.success+'" >');
								$('#get_imagetask_hidden').val(data.success);
							},
							error: function(data){
								console.log(data);
							}
							});

					});
				
				</script>