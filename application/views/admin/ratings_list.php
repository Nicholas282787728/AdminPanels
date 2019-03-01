
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
			<div class="panel panel-default medconnex6-panel">
				
				<div class="panel-body medconnex6-body">
					<div class="pull-left medconnex6-left">
							<div class="form-group medconnex6-grp" >
								<label>Select Provider </label>
								<div class="input-group medconnex6-inputgrp" >
									<select class="form-control category_provider" required="" id="" style=" width:200px;">
										<option value="">Select Provider</option>
										<option value="1">Driver</option>
										<option value="2">Doctor</option>
										<option value="3">Storefront</option>
									</select>
								</div>
							</div>
					</div>
					
				</div>
			</div>
			<div class="panel panel-default medconnex6-panel1">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Rating <span class="provider_name"></span>
				</div>
				<div class="panel-body medconnex6-body1">
					<div class="table-responsive" style="min-height: 300px;">
						<table width="100%" class="table table-hover medconnex6" >
							<thead>
								<tr class="first-row">
									<th>id </th>
									<th>Contact</th>
									<th>Email </th>
									<th>Display name</th>
									<th>Registered Since</th>
									<th>Last Sign-In</th>
									<th>Rating</th>
									<th>Visit Panel</th>
									<th>Completed Task</th>
								</tr>
							</thead>
							<tbody class="get_provider_list">
								<tr><td colspan="100%" align="center">Please Select Provider..</td></tr>
							</tbody>
						</table>
					</div>
				
				</div>
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
		
	
			
			
			
			
		
			
			
		
		
		
		
		
		
	});
</script>