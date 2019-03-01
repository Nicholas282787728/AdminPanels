
<style type="text/css">
    .right-upload-box {
      padding-top: 10px;
    }  
    </style>
    
 <div id="page-wrapper">
	 
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
     <?php $this->load->view('sales_templates/new-sidebar'); ?>
    <!-- Main content -->
    
   <div class="row-fluid sortable">		
				<div class="box span12">
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                          <div class="panel-heading title-bar-blue">
	                    <p><i class="fa fa-file" aria-hidden="true"></i> Attachments / Zip</p>
	                     </div> <!-- /.panel-heading -->
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                        	<div class="table-responsive">
                           <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="dataTables-example">
                                <thead>
								 <tr class="first-row">
							      <th class="br-n">S.No.</th> 
								  <th class="br-n">Title</th>
								  <th class="br-n">Description</th>
								  <th class="br-n">File</th> 
								  <th class="br-n">Date & Time</th> 
								  <th class="br-n" >Action </th>
								
								
							  </tr>
                                </thead>
                                <tbody>
							<?php $i='1'; foreach ($all_advrZip as $row) {
								//print_r($row);
							 ?>
					          <tr>
							  	 <td><?php echo $i++; ?></td> 
								<td><?php echo $row['title']; ?></td>
                                <td class="center" ><?php echo substr($row['description'], 0,50); ?></td>
								<td >
									
									 <?php
										   $fileType=explode('.', $row['upload_file']);
                                           	$extension= strtolower(end($fileType));
                                           	$inarray = array('jpg','jpeg','png','gif','bmp');
                                           	if(in_array($extension, $inarray)){
											$filename = 'uploads/'.$row['upload_file'];
											if (file_exists($filename) && !empty($row['upload_file'])) {
										?>
										  
											<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>" >
												<img src="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>" width="100px" height="100px">
												
											</a>
										<?php
											} 
										}else{?>
											  <div>&nbsp;</div>
											<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>" >
												<span class="label label-success">View Document</span>
												
											</a>

										<?php }
										?>
										
								</td>
								<td><?php echo $row['insert_date']; ?></td>
								<!-- <td >
										   <?php
										
											$filename = 'uploads/'.$row['upload_file'];
											if (file_exists($filename) && !empty($row['upload_file'])) {
										?>
										<div>&nbsp;</div>
											<a onmouseover="this.style='color:#fff;';" target="_blank" href="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>" >
												
												<span class="label label-success">View</span>
											</a>
										<?php
											} 
										
										?>
										
								</td> -->
			                   <td>
									<div class="btn-group">
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
										Share
										<span class="caret"></span>
										</button>            
										<ul class="dropdown-menu" role="menu">
											<li>
											<button style="padding: 4px 10px;border: none;background: transparent;" type="button" name="enable" value="" id="enable"  class="js-share-email" data-id="<?php echo $row['zip_id']; ?>">
											<i class="fa fa-minus-circle"></i>  Email 
											</button>
											</li>
											<li>
											<button style="padding: 4px 10px;border: none;background: transparent;" type="button" name="enable" value="" id="enable"  class="js-share-mobile" data-id="<?php echo $row['zip_id']; ?>">
											<i class="fa fa-minus-circle"></i>  Mobile 
											</button>

											</li>
										</ul>
									</div>
								</td>
							
							</tr>
							<?php } ?>
							 
                                </tbody>
                            </table>
                        </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
					
				</div><!--/span-->
				
				
				<div class="box span12">
					
					
					
					<div class="row">
                <div class="col-lg-12" style="display: none;">
                    <div class="panel panel-default">
                    	  <div class="panel-heading title-bar-blue">
	                    <p><i class="fa fa-file" aria-hidden="true"></i>
                        <!-- /.panel-heading -->
                        <?php
								$status="Add";
								if(!empty($zip_id))
								{
									$status="Edit";
								}
								echo $status.' Doc File';
							?>  
								</p>
	                     </div> <!-- /.panel-heading -->
                       
                        <div class="panel-body">
                            <div class="row Advertisement-Upload">
								<form id="add_doc_form" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/<?=!empty($zip_id)?'updateAttach':'saveZipFile'?>" enctype="multipart/form-data"  >
								<div class="col-lg-6">
									<div class="form-group">
										<label for="email">File Title</label>
										<input type="text" class="form-control" id="email" name="title" value="<?=!empty($edit_zip['title'])?$edit_zip['title']:''?>" required="">
									</div>  
									 
									<div class="form-group">
										<label for="extra">Choose File</label>
										<input type="file"  id="get_image" name="image"  <?php if(empty($zip_id)) { ?>required="" <?php } ?> >
										<?php
										if(!empty($zip_id))
										{?>
										<input type="hidden"   name="image_old" value="<?=!empty($edit_zip['upload_file'])?$edit_zip['upload_file']:''?>" >
										<input type="hidden"   name="zip_id" value="<?=!empty($zip_id)?$zip_id:''?>" >
										
										<?php
											$filenamea = 'uploads/'.$edit_zip['upload_file'];
											if (file_exists($filenamea)) {
										?>
											<img src="<?=base_url()?>uploads/<?=!empty($edit_zip['upload_file'])?$edit_zip['upload_file']:''?>" class="image_set" width="100px;"> 
										<?php
											}
											
										}else
											{
												?>
											<img src="" class="image_set" width="100px;" style="display:none;"> 
												<?php
											}?>
									</div>
                                </div>
								
								<div class="col-lg-6">
									<div class="form-group">
										<label for="seltop">File Description</label>
										  <textarea name="description" class="form-control" rows="5px"><?=!empty($edit_zip['description'])?$edit_zip['description']:''?> </textarea>
								   </div>
										<?php
										if(!empty($zip_id))
										{?>
									<div class="form-group">
										<label for="email">Select sales (Send Mail) </label>
										<select class="form-control" name="mail_send">
											<option>Select sales</option>
											<?php
											foreach($all_staff as $view)
											{
											?>
											<option><?=$view['email']?></option>
											<?php
											}
											?>
										</select>
									</div> 
									<?php
										}
									?>
									
									<button type="submit" class="btn btn-info signin-btn" name="update">
										 <?php
										 $stat_btn="Save Changes";
										if(!empty($zip_id))
										{
											 $stat_btn="Update Changes";
										}
										echo $stat_btn;
										?></button>
									<button type="reset" class="btn btn-danger cancel-btn">Cancel</button>
									
								</div>
							</form> 
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
                 	</div>
				
				
			</div><!--/row-->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="modal fade" id="shareEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Share Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('panels/supermacdaddy/sales/shareEmail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="send_to" class="form-control" required="">
									<input type="hidden" name="id" value="" class="shareId">
								</div>
							</div>
								<div class="form-group">
								<label>CC</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="cc" class="form-control" required="">
									
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<div class="input-group" style="width: 100%;" >
									<input type="text" name="send_subject" class="form-control" required="" value="Attachment/zip Image">
								</div>
							</div>


							<div class="form-group" style="overflow-y: auto;">
								<label>Share Image</label>
								<div class="input-group" >
									<img src="" class="shareImage">
								</div>
							</div>
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit"  class="btn-green">Share Image</button>
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

<script>
	
	$("#get_image").change(function () {
		if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
	function imageIsLoaded(e) {
		$('.image_set').show();
		$('.image_set').attr('src', e.target.result);
	};
	$(document).ready(function(){
		 $(".js-share-email,.js-share-mobile").click(function(){
	      var id =$(this).attr("data-id");
	      //alert(id);
	    //  return false;
	      $.ajax({
	        type: "post",
	        url:"<?php echo base_url();?>panels/supermacdaddy/sales/shareEmailOrMobile",
	        data: "&id="+id,
	        success: function(response){
	        	var data=$.parseJSON(response);
	        	console.log(data);
	        	var sharimage='<?php echo base_url('uploads/')?>'+data.upload_file;
	        	$('.shareImage').attr('src',sharimage);
	        	$('.shareId').val(data.zip_id);
	        	$('#shareEmail').modal('show');

	         
	        } 
         });
    });

	});

</script>