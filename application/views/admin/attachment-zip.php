
<style type="text/css">
    .right-upload-box {
      padding-top: 10px;
    }  
    </style>
    
 <div id="page-wrapper">
	 <?php 
		 $this->load->view('admin/top_tab_header');
	?>
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
								  <th class="br-n" >Attachment </th>
								  <th class="br-n" >Actions</th> 
								
							  </tr>
                                </thead>
                                <tbody>
							<?php $i='1';


							 foreach ($all_advrZip as $row) { ?>
					          <tr>
							  	<td><?php echo $i++; ?></td>
								<td><?php echo $row['title']; ?></td>
                                <td class="center" width="30%"><?php echo substr($row['description'], 0,50); ?></td>

                                <?php $files = explode('.', $row['upload_file']);

                           if(($files[1] == 'doc') || ($files[1] == 'docx') || ($files[1] == 'DOCX') || ($files[1] == 'DOC')){
                           	?>
                           	<td width="20%"><a href="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>"   >
									<?php echo $row['upload_file']; ?></td>
                           	<?php
                           }
                           else{
                           	?>
                           	<td width="20%"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalfile<?php echo $row['zip_id']; ?>"  >
									<?php echo $row['upload_file']; ?></td>
                           	<?php
                           }

                                 ?>

								


								<td width="10%"><?php if($row['status'] == '1'){ ?>
										<span class="label label-success my-approve">Approved</span>
									<?php }else{ ?>
										<!-- <span class="label label-success  my-approve cl-un">Unapproved</span> -->
									<?php } ?>
										
										
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
										
								</td>
								<td class="center" >
								
										
								<!-- 	<a class="btn btn-info gn-attachment-edit" href="<?=base_url()?>panels/supermacdaddy/dashboard/attachment_zip?id=<?= $row['zip_id'] ?>" data-id="<?php echo $row['zip_id']; ?>">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a> -->
									<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/deleteAttach/<?php echo $row['zip_id']; ?>">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>
								</td>
							</tr>



<div class="modal fade" id="myModalfile<?php echo $row['zip_id']; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image</h4>
        </div>
        <div class="modal-body">
   <img src="<?php echo base_url(); ?>uploads/<?php echo $row['upload_file']; ?>">
        </div>
      
      </div>
      
    </div>
</div>
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
                <div class="col-lg-12">
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
								<form id="add_doc_form" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/<?=!empty($zip_id)?'updateAttach':'saveZipFile'?>" enctype="multipart/form-data"  >
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

</script>