 
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	
	  <div class="modal fade" id="services_model" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Services Type</h4>
        </div>
        <div class="modal-body">
			<form method="post" action="<?=base_url()?>panels/supermacdaddy/storefronts/service_update">
			<div class="form-group">
			   <label>Select Service</label>
			   <?php
					$user_id =  $this->session->userdata('id');
					$this->db->where('id',$user_id);
					$query = $this->db->get('uf_user');
					$getdatafootr = $query->row();
					?>
			   <select class="form-control" name="services_name">
				   <option value="Free" <?=($getdatafootr->service_type == "Free")?'selected':'' ?>>Free</option>   
				   <option value="Standard" <?=($getdatafootr->service_type == "Standard")?'selected':'' ?>>Standard</option>   
				   <option value="Premium" <?=($getdatafootr->service_type == "Premium")?'selected':'' ?>>Premium</option>   
			   </select>
			</div>
				<button type="submit" name="services_type" class="btn-green">Update</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <div class="modal fade" id="composemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Compose Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('storefronts-composemail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="send_to" class="form-control" required="">
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<div class="input-group" style="width: 100%;" >
									<input type="text" name="send_subject" class="form-control" required="" >
								</div>
							</div>


							<div class="form-group" style="overflow-y: auto;">
								<label>Message</label>
								<div class="input-group" style="width: 100%;" >
									<textarea class="form-control" id="composmail" name="send_message" rows="4" ></textarea>
								</div>
							</div>
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit"  class="btn-green">Send Message</button>
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
	
	<?php
$id = $this->session->userdata('id');
    $sql = "select id from uf_user  where acceptTerms = '0' AND id = '$id'  ";
            
        $query = $this->db->query($sql);
        $resultarray = $query->row();
if(!empty($resultarray)){
    ?>




  <!-- Modal -->
  <div class="modal fade" id="myModalsales" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
            <?php   $sql1 = "select content from uf_tos  where state_id = 'store_partners'  ";
            
        $query1 = $this->db->query($sql1);
        $resultarray1 = $query1->row();

         ?>
          <p><?php echo $resultarray1->content; ?></p>
        </div>
        <div class="modal-footer">
            <div class="col-sm-12">
              
                <div class="col-sm-3">
            <form method="post" action="<?php echo base_url(); ?>storefronts/acceptTerms">
                <input type="hidden" name="acceptTerms" value="1">
          <button type="submit" class="btn btn-success" >Accept</button>
          </form>
      </div>
      <div class="col-sm-3">

            <form method="post" action="<?php echo base_url(); ?>storefronts-logout">
          <button type="submit" class="btn btn-danger" >Cancel</button>
          </form>
      </div>
        <div class="col-sm-6"></div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

    <?php
}

         ?>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModalsales').modal('show');
    });
    $('#myModalsales').modal({backdrop: 'static', keyboard: false})  
</script>
	
    <!-- jQuery -->
  
   <script src="<?php echo base_url() ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
   <script src="<?php echo base_url() ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
   <script src="<?php echo base_url() ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.js"></script>
    <script src="<?php echo base_url(); ?>public/data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>public/dist/js/sb-admin-2.js"></script>
 
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/moment.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.css">
<script src="<?php echo base_url()?>public/datepicker/js/bootstrap-datepicker.js"></script>

  

<script>
    $(document).ready(function() {
		
		$(".datetimepicker4").datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
				});
		
        $('#dataTables-example').DataTable({
            responsive: false
        });
    });
    </script>
    
<script type="text/javascript">
$(function() {
    $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});
</script>
<script>
	
$(document).ready(function(){
	// setInterval(function(){
		var id='<?php echo $this->session->userdata('id'); ?>';
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-get-notifications');?>",
		data: {id:id},
		success: function(response)
		{
			$("#notifications").html(response);
		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-notificationcount');?>",
		data: "",
		success: function(response){
			$("#notificationcount").html(response);
		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-tasknotification');?>",
		data: "",
		success: function(response)
		{
		$("#notitasks").html(response);

		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-tasknotificationcount');?>",
		data: "",
		success: function(response){
			$("#notitaskscount").html(response);
		} 

	});

	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-msgnotification');?>",
		data: "",
		success: function(response)
		{
		$("#messages_list").html(response);

		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-msgnotificationcount');?>",
		data: "",
		success: function(response){
			$("#msgcount").html(response);
		} 

	});
		
	// }, 2000);
	
	$(".js-user-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url('storefronts-editproduct');?>",
			data: "&id="+id,
			success: function(response){
				
				$(".updatepro").html(response);
				$('#editproduct').modal('show')   
			} 
	 
		});
	});
	$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url('storefronts-editpromo');?>",
			data: {
				id:id
			},
			success: function(response){
			
				console.log(response);
				 var data= $.parseJSON(response);

                $("#pid").val(data.id);
                $("#promo_code").val(data.code);
                $("#promo_offer").val(data.offer);
                $(".promo_type").val(data.type).attr('selected','selected');
                $(".promo_product_id").val(data.product_id).attr('selected','selected');
                $("#promo_description").html(data.description);
                 $(".date_begin").val(data.start);
                 $(".date_end").val(data.end);
				$('#editpromomodal').modal('show')   
			} 
	 
		});
	});
	
	$(".js-staff-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-autusers');?>",
		data: "&id="+id,
		success: function(response){
			console.log(response['id']);
			$(".saleseditdiv").html(response);
			$('#edit_sale_Modal').modal('show')   
		} 
 
	});
});
	$(".js-category-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url('storefronts-editcategory');?>",
		data: {
			id:id
		},
		success: function(response){
			  var data= $.parseJSON(response);
			  console.log(data);
		      $("#id").val(data.id);
		      $("#category_name").val(data.name);
              $(".status").val(data.status).attr('selected','selected');
			$('#edit_sale_Modal').modal('show')   
		} 
 
	});
});

});
</script>

<script type="text/javascript">
	$('.validatedForm').validate({
			rules : {
				password : {
					minlength : 5
				},
				password_confirm : {
					minlength : 5,
					equalTo : "#password"
				}
			},
			messages:{
				password:{
					required:'New Password is Required'
				}

			}
		});
	$('.addPromo').validate({
			
		});
</script>   

<script type="text/javascript">

	$( document ).ready(function() {
    $('#date_begin,#date_end').datetimepicker({
    	 pick12HourFormat: true,
    	  inline:true,
    });
});

</script>
<script>

    $('.edit_ticket').click(function(){
        var ticket_id=$(this).attr('data-id');
        $.ajax({
            type: "post",
            url:"<?php echo base_url('storefronts-editticket');?>",
            data: "&ticket_id="+ticket_id,
            success: function(response){
                $("#edit_tickit_data").html(response);
                new nicEditor().panelInstance('edit_message_ticket');
                $('#edit_ticket').modal('show')   
            } 
        });
    })
        
</script>
</body>

</html>
