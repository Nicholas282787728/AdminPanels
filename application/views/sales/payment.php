<div id="page-wrapper">
	<div class="row-fluid sortable">		
		<div class="box span12">
		<?php 
		@$success_msg = $this->session->flashdata('success_msg');
		if(!empty($success_msg)) {
			echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
			echo $this->session->flashdata('success_msg')."</div>";			
		}
		?>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<h2><img src="<?php echo base_url(); ?>public/sales-design/images/genral-sale-icon.png" style="background-color: #10b1ac;border-radius: 5px;">  Payment</h2>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
									<tr>
										<th class="br-n">S.No.</th>
										<th class="br-n">Email</th>
										<th class="br-n">Contact No.</th>
										<th class="br-n">Zip</th>
										<th class="br-n">Username</th>
										<th class="br-n">Location</th>
										<th class="br-n">User Type</th>
										<th class="br-n">Status</th>
										<th class="br-n">Actions</th>
									</tr>
                                </thead>
                                <tbody>
								
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div><!--/row-->
</div>