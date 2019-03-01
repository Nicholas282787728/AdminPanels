 
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
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
				<form method="post" action="<?php echo base_url('panels/supermacdaddy/dashboard/composemail');?>" enctype="multipart/form-data">
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
								<div class="input-group"  style="width: 100%;"  >
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
	
	
	
	
	
  <!-- Modal -->
  <div class="modal fade" id="services_model" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header title-bar-orange">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" style="color:#fff;width:93%;float:left;font-weight: bold;">Upgrade Premium Service</h5>
        </div>
        <div class="modal-body">

		<form method="post" action="<?=base_url()?>panels/supermacdaddy/ondemand/service_update_document" enctype="multipart/form-data">

		 <div class="col-md-12">
            <div class="form-group">
                <label>Valid State  ID</label>
                  <input class="form-control get_image_state" name="upload[]" type="file" required="">
            </div>
            <img src="" class="get_image_state" id="get_image_state" width="200px" height="100px" style="display: none">
        </div>
		 <div class="col-md-12">
            <div class="form-group">
                <label>Monthly Utility Bill</label>
                 <input class="form-control get_image_monthly" name="upload[]" type="file" required="">
            </div>
             <img src="" class="get_image_monthly" id="get_image_monthly" width="200px" height="100px">
        </div>
		 <div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                <?php $email = $this->session->userdata('username');
              

                ?>
                    <input class="form-control" name="email" readonly="" autocomplete="off" value="<?php echo $email; ?>"     required="">
            </div>
        </div>
        
		<div class="col-md-12">
            <div class="form-group">
                <label>Social Media Link</label>
                  <input class="form-control" name="socialmedialink" autocomplete="off"  placeholder="Social Media Link" type="text"  required="">
            </div>
        </div>
				<button type="submit"  class="btn-green">Upgrade</button>
			</form>


			<!-- <form method="post" action="<?=base_url()?>panels/supermacdaddy/ondemand/service_update">
			<div class="form-group">
			   <label>Select Service</label>
			   <?php
					$user_id =  $this->session->userdata('id');
					$this->db->where('id',$user_id);
					$query = $this->db->get('uf_user');
					$getdatafootr = $query->row();
					?>
			   <select class="form-control" name="services_name">
				
				   <option value="Standard" <?=($getdatafootr->service_type == "Standard")?'selected':'' ?>>Standard</option>   
				   <option value="Premium" <?=($getdatafootr->service_type == "Premium")?'selected':'' ?>>Premium</option>   
			   </select>
			</div>
				<button type="submit" name="services_type" class="btn-green">Update</button>
			</form> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
	
	
	
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.js"></script>
    <script src="<?php echo base_url(); ?>public/data/morris-data.js"></script>

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
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/notification",
		data: {id:id},
		success: function(response)
		{
			$("#notifications").html(response);
		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/notificationcount",
		data: "",
		success: function(response){
			$("#notificationcount").html(response);
		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/tasknotification",
		data: "",
		success: function(response)
		{
		$("#notitasks").html(response);

		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/tasknotificationcount",
		data: "",
		success: function(response){
			$("#notitaskscount").html(response);
		} 

	});

	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/msgnotification",
		data: "",
		success: function(response)
		{
		$("#messages_list").html(response);

		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/msgnotificationcount",
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
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_product",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);

				$(".updatepros").html(response);
				//$(".modal-title").html('Update Product');
				
				$('#editproduct').modal('show')   
			} 
	 
		});
	});
	$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_promo",
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
	
	
	$(".js-category-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_category",
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
	$(".js-staff-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/aut_users",
		data: {
			id:id
		},
		success: function(response){
			$(".authedit").html(response);
			$('#edit_sale_Modal').modal('show');   
		} 
 
	});
});

});
</script>
<!-- <script type="text/javascript">
	$(document).ready(function(){
	 $( "#readCount" ).click(function() {

        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'notification'
            },
            success: function(response){
                $("#notificationcount").html(response);
            } 
     
        });
        });
        $( "#readTaskCount" ).click(function() {
        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'task'
            },
            success: function(response){
                $("#notitaskscount").html(response);
            } 
     
        });
        });


         $( "#readMessageCount" ).click(function() {
        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'message'
            },
            success: function(response){
                $("#msgcount").html(response);
            } 
     
        });
        });
          });

</script> -->
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
     $('#rating_date,#rating_date1').datetimepicker({
    	    minView: 2,
		    format: 'yyyy-mm-dd',
		    autoclose: true,
   
    });
     $("#rating_submit").click(function(){
      var date=$("#rating_date").val();
      var date1=$("#rating_date1").val();
     // alert(date);
      if(date && date1){
      	var url="<?php echo base_url('panels/supermacdaddy/ondemand/'); ?>"
      	window.location=url+'?date='+date+'&end='+date1;
      }else{
      	   alert('please select date')
      }
      
    });
});

</script>
<script>

    $('.edit_ticket').click(function(){
        var ticket_id=$(this).attr('data-id');
        $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_ticket",
            data: "&ticket_id="+ticket_id,
            success: function(response){
                $("#edit_tickit_data").html(response);
                new nicEditor().panelInstance('edit_message_ticket');
                $('#edit_ticket').modal('show')   
            } 
        });
    })
        
</script>
<script type="text/javascript">
	$(".js-signup-edit").click(function(){
	 var id =$(this).attr("data-id");
     var aid='#aid-'+id;
     var getid=$(aid).val();
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/updateDriverDocuments",
		data: {
			id:id
		},
		success: function(response){
		      var data= $.parseJSON(response);
		      var name=getid+' Upload Singup Document';
		      $("#id").val(data.id);
		      $("#exampleModalLabel,.documentName").html(name);
		      $("#documents").val(data.documents);
		      $("#documentName").val(getid);
			  $('#edit_signup_document').modal('show')   
		} 
 
	});
});
</script>

<script type="text/javascript">
	$(".get_image_state").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded(e) {
              var dataImage= $('.get_image_state').prop('files')[0];
              var fileName = dataImage.name;
              var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
              var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
               if ($.inArray(fileNameExt, validExtensions) == -1) {
                // $('.docurl').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                $('.get_image_state').attr('src', '');
                }else{
                	$('#get_image_state').css('display','block');
                   $('.get_image_state').attr('src', e.target.result);
                   // $('.docurl').html('');
               }
			
		};
		$(".get_image_monthly").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded1;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded1(e) {
              var dataImage= $('.get_image_monthly').prop('files')[0];
              var fileName = dataImage.name;
              var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
              var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
               if ($.inArray(fileNameExt, validExtensions) == -1) {
                // $('.docurl').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                $('.get_image_monthly').attr('src', '');
                }else{
                	$('#get_image_month').css('display','block');
                   $('.get_image_monthly').attr('src', e.target.result);
                   // $('.docurl').html('');
               }
			
		};
</script>

</body>

</html>
