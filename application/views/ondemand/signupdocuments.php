<div id="page-wrapper">
	    <?php $this->load->view('ondemand/new-sidebar'); ?>

            <!-- /.row -->
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
				<div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
					<i class="fa fa-users" aria-hidden="true"></i> 	My Sign Up Documents
					
	 			</div>
				<div class="panel-body">
					
					<div class="table-responsive">
						<table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
							 <thead>
                                    <tr>
                                        <!-- <th>S.No </th> -->
                                        <th>Document Name</th>
                                        <th>File attached </th>
                                        <th>Date & Time stamp </th>
                                        <!-- <th>Notes </th>
                                        <th>Status </th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									  <?php 
									  $i=1; 
									  foreach ($uploadDocuments as $row) {
									   ?>
                                       <tr class="odd">
                                        <!-- <td><?php echo $i++; ?></td> -->
                                        <td>
											<?php
												$link_name = explode( '.', $row->document);
												echo $link_name[0];
											?>
										</td>
                                        <td>
											<?php
											$filename = 'uploads/'.$row->document;
											if (file_exists($filename)) {
												$tmp        =explode(".", $filename);
					                            $extension	= end($tmp);
					                            $imgextension = array("jpg", "jpeg", "png");
					                            $orginalExtension=strtolower($extension);
					                            if(in_array($orginalExtension, $imgextension)){


											?>

											 <a href="<?php echo base_url();?>uploads/<?=$row->document?>" target="_blank"><img src="<?php echo base_url();?>uploads/<?=$row->document?>" style="height: 150px; width: 150px;"></a> 
											
											<?php 
											  }else{ ?>
											  	 <a href="<?php echo base_url();?>uploads/<?=$row->document?>" target="_blank">click document</a> 
											  	<!--  <iframe src="<?php echo base_url();?>uploads/<?=$row->document?>"></iframe>
 -->
											 <?php }
											}
											?>
										</td>
										 <td><?php echo $row->created_at; ?></td>
                                         <!-- <td><?php echo $row->notes; ?></td> -->
                                        <!-- <td class="center">
                                          <?php if($row->document_status == '1'){ ?>
                                            <span style="padding:3px;" class="btn-success">Approved</span>
                                          <?php }else{ ?>
                                            <span style="padding:3px;" class="btn-warning">Pending</span>
                                          <?php } ?>
                                        </td> -->
									<!-- 	<td style="width:10%">
											
											          <form action="" method="post">
														<button class="btn btn-danger " onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_product" value="<?=$row->id;?>" >
														<i class="fa fa-trash-o"></i>  </button>
														<a class="btn btn-info edit_document" href="javascript:;" data-id="<?=$row->user_document_id?>">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</a>
														</form>

											
										</td> -->
										<td >
                                        <?php
                                
                                         echo ' <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            Action
                                            <span class="caret"></span>
                                        </button> 

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                        <form action="" method="post">
                                           <button class="form-list-item" style="margin-left: 45px;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_product" value="'.$row->id.'">
                                                       Trash  </button>
                                                       </form>

                                        </li>
                                        <li>
                                        <form action="" method="post">
										<a style="text-align: center;" class="form-list-item edit_document" href="javascript:;" data-id="'.$row->user_document_id.'">
									
											
									
                                                          Notes
                                                        </a>
                                                        </form>
                                        </li>
                                </ul>
                            </div>';

                                            
                                            
                                            ?>
                                    </td>
                                    </tr>
                                    <?php } ?>
									
                           
                                </tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


<!--/Edit data/-->
<div class="modal fade" id="edit_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Sign Up Documents </h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form name="edit_document_form" id="edit_document_form" method="post" action=""  enctype="multipart/form-data" >
					<div id="form-alerts"></div>
					<div class="row">
						<div id="edit_document_data"></div>
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<button type="submit" name="updatedocument" class="btn-green" >Update Document</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>


<script>
	$('.edit_document').click(function(){
		var document_id=$(this).attr('data-id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_signupdocuments",
			data: "&document_id="+document_id,
			success: function(response){
				$("#edit_document_data").html(response);
				$('#edit_document').modal('show')   
			} 
		});
	})
</script>

	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace("notes");

    </script>