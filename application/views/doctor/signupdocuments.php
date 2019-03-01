<style>
	.panel-heading{
		height: 80px;
		max-height: 80px;
	}
	
</style>
<div id="page-wrapper">
         
<?php $this->load->view('doctor_templates/new-sidebar'); ?>

            <div class="row">
                <div class="col-lg-12">
					
                    <div class="panel panel-default">
                        <div class="panel-heading title-bar-blue" style="font-weight:bold;height:45px;">
                           <i class="fa fa-file"></i> Your Documents
                        </div>
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="dataTables-example">
                                <thead>
                                    <tr class="first-row">
                                        <th>S.No </th>
                                        <th>Document Name</th>
                                        <th>File </th>
                                        <th>Status </th>
                                        <th>Uploaded Date </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach ($document_list as $row) { ?>
                                    <tr class="odd">
                                        <td><?php echo $i++; ?></td>
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
											?>
											<a href="<?php echo base_url();?>uploads/<?=$row->document?>" target="_blank"><img width="40" height="40" src="<?php echo base_url();?>uploads/<?=$row->document?>"></a>
											<?php 
											}
											?>
										</td>
                                        <td class="center">
                                          <?php if($row->document_status == '1'){ ?>
                                            <span style="padding:3px;" class="btn-success">Approved</span>
                                          <?php }else{ ?>
                                            <span style="padding:3px;" class="btn-warning">Pending</span>
                                          <?php } ?>
                                        </td>
										<td><?=$row->created_at?></td>
										<td style="width:10%">
											<a class="btn btn-info edit_document" href="javascript:;" data-id="<?=$row->user_document_id?>">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?=base_url()?>panels/supermacdaddy/doctor/delete_document/<?=$row->user_document_id?>">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
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
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatedocument" class="btn-green" >Update Document</button>
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
	$('.edit_document').click(function(){
		var document_id=$(this).attr('data-id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/edit_signupdocuments",
			data: "&document_id="+document_id,
			success: function(response){
				$("#edit_document_data").html(response);
				$('#edit_document').modal('show')   
			} 
		});
	})
</script>