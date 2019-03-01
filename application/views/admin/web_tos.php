
<div id="page-wrapper">
		<?php 
		 $this->load->view('admin/top_tab_header');
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
			<div class="panel panel-default">
				<div class="panel-heading title-bar-green" style="color:#fff;">
					<i class="fa fa-flag mr-5"></i>Website's Terms and Conditions
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<form action="" method="post">
						<div class="col-sm-12">
							<div class="form-group">
								<label>State Name </label>
								<select class="form-control" name="state_id" id="state_web" required="">
									
									<?php foreach($all_states as $s){ ?>
									<option value="<?=$s->abv?>" ><?=$s->name?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<input type="hidden" name="term_id" id="term_id">
						<div class="col-sm-12">
						<div class="form-group">
                     	<label>Web Term &amp; conditions </label>
						<textarea rows="10" name="content" id="web_tos"  cols="117" class="note-codable form-control" style="width:100%; height:100%;"></textarea>
					  </div>
					</div>
						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn-green js-location-create" name="save"> Submit </button>
							</div>
						</div>
					</form>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
	<script>
			CKEDITOR.replace( 'content' );

		</script>
<script type="text/javascript">
	$('#state_web').on('change', function() {
       var state_id=this.value;
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/get_web_term",
			data: "&state_id="+state_id+"&section=web",
			success: function(response){
			if(response != '0'){

			 var data=$.parseJSON(response);
			 var content=data.content;
		
			 $('#term_id').val(data.id);
			 CKEDITOR.instances['web_tos'].setData(content);
			 }else{
			 	 CKEDITOR.instances['web_tos'].setData('');
			 $('#term_id').val('');
               console.log('No records found');
			 }
		  
				
			} 
	 
		});
});
	$(document).ready(function(){
		
		   var state_id=$("#state_web option:selected").val();
		 //  alert(state_id);

		 $.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/get_web_term",
		  data: "&state_id="+state_id+"&section=web",
			success: function(response){
			if(response != '0'){

			 var data=$.parseJSON(response);
			 var content=data.content;
		
			 $('#term_id').val(data.id);
			 CKEDITOR.instances['web_tos'].setData(content);
			 }else{
			 	 CKEDITOR.instances['web_tos'].setData('');
			 $('#term_id').val('');
               console.log('No records found');
			 }
		  
				
			} 
	 
		});
});
</script>