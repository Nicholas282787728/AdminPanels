        <div id="page-wrapper">
				<?php 
					$this->load->view('admin/top_tab_header');
			   ?>
            <div class="row">
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
                <div class="col-lg-12 medconnex4">
                    <div class="panel panel-default medconnex4-panel">
                        <div class="panel-heading title-bar-green" style="color:#fff;">
                            <i class="fa fa-flag mr-5"></i>Standard Services
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body medconnex4-body">						
							<form action="" method="post">
							<div class="servicediv medconnex4-service">
								<textarea rows="5" cols="117" name="content" class="note-codable form-control"></textarea>
								<div class="row">
									<div class="col-xs-12 medconnex4-button">
										<button name="save" type="submit" class="btn-green js-location-create">Submit</button>
									</div>
								</div>
								</div>
							</form>
						</div>
                    </div>
                      <div class="panel-heading title-bar-green medconnex4-heading" style="color:#fff;">
                            <i class="fa fa-flag mr-5"></i>Standard Services

                        </div>
                    <div class="panel panel-default table-responsive medconnex4a-panel" style="padding: 2%;">
                    	<button type="button" class="btn-green js-our-pricing" data-toggle="modal" data-target="#updatepricing" data-id="1">
						Edit Pricing
					</button>
						<table width="100%" class="table table-striped table-bordered table-hover medconnex4-table" id="dataTables-example" >
                                <thead>
                                    <tr class="first-row">
                                    	<th>S.NO.</th>
                                        <th>User/Info</th>
                                        <th>Status/action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $i=1;foreach($standard_services as $val){?>
                                    <tr class="odd gradeX">
                                    	<td><?php echo $i++;?></td>
                                        <td><?php echo $val['services_content'];?></td>
                                        <td>
											<div class="btn-group"> 
												<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
													Action
													<span class="caret"></span>
												</button>            
												<ul class="dropdown-menu" role="menu">
												<li>
													<a href="#" data-id="<?php echo $val['services_content_id']; ?>" class="js-service-edit">
														<i class="fa fa-edit"></i> Edit
													</a>
												</li>
												<li>
													<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the service ?\');" type="submit" name="delete" value="<?php echo $val['services_content_id']; ?>" id="disable" class="js-user-delete" data-user_name="Ajay" >
														<i class="fa fa-trash-o"></i> Delete </button>
													</form>
												</li>
												</ul>
											</div>
										</td>
                                     	</form>
						             	</tr>
                                     <?php }?>
                                </tbody>
                       </table>  
                    </div>
                </div>
            </div>
        </div>


      <div class="modal fade" id="updatepricing" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Standard Services</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="user" method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/pricingUpdated')?>">
					<div id="form-alerts"></div>
					<div class="updatepricing">
						<br>
						
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(".js-our-pricing").click(function(){
		var id =$(this).attr("data-id");
		//alert(id);
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/updatepricing",
			data: "&id="+id,
			success: function(response){
				$(".updatepricing").html(response);
				$('#updatepricing').modal('show')   
			} 
	 
		});
	});
	</script>