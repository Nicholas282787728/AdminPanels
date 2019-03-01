
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	 <!-- compose mail -->

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
								<div class="input-group" >
									<textarea class="form-control" id="composmail" name="send_message" rows="4" style="width:570% !important; height:100%;"></textarea>
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
 <!--  End compose mail -->
	
	<div class="modal fade" id="certificate_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Select Panel</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="text-align: center;">
							<a data-toggle="modal" data-target="#login"><button type="button" class="btn btn-primary medconnex-modal">On-Demand</button></a>
							<a  data-toggle="modal" data-target="#login"><button type="button" class="btn btn-info medconnex-modal">Storefronts</button></a>
							<a  data-toggle="modal" data-target="#login"><button type="button" class="btn btn-success medconnex-modal">Industry Doctors</button></a>
				<!--			<a href="<?php echo base_url(); ?>panels/supermacdaddy/Ondemand" target="_blank"><button type="button" class="btn btn-primary">On-Demand</button></a>
							<a href="<?php echo base_url(); ?>panels/supermacdaddy/Storefronts" target="_blank"><button type="button" class="btn btn-info">Storefronts</button></a>
							<a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor" target="_blank"><button type="button" class="btn btn-success">Industry Doctors</button></a>-->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	
	
		<div class="modal fade" id="affilitePartners" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Select Panel</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="text-align: center;">
							<a data-toggle="modal" data-target="#rating_view"><button type="button" value="1" class="btn btn-primary category_provider">On-Demand</button></a>
							
							<a  data-toggle="modal" data-target="#rating_view"><button type="button" value="2" class="btn btn-success category_provider">Industry Doctors</button></a>
							<a  data-toggle="modal" data-target="#rating_view"><button type="button" value="3" class="btn btn-info category_provider">Storefronts</button></a>
							<a  data-toggle="modal" data-target="#login" ><button type="button" value="3" class="btn btn-info" style="background-color: #10B1AC !important">Affiliate Partners</button></a>
				<!--			<a href="<?php echo base_url(); ?>panels/supermacdaddy/Ondemand" target="_blank"><button type="button" class="btn btn-primary">On-Demand</button></a>
							<a href="<?php echo base_url(); ?>panels/supermacdaddy/Storefronts" target="_blank"><button type="button" class="btn btn-info">Storefronts</button></a>
							<a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor" target="_blank"><button type="button" class="btn btn-success">Industry Doctors</button></a>-->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary affilitePartnersClose" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	
		<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Login</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="text-align: center;">
							<form id="LoginForm" action="<?= base_url() ?>home/admin_login" method="post" class="LoginForm">
								<div class="form-group">
									<input name="login_email" class="form-control" id="loginValidEmail" placeholder="Email" required="" type="email">
								</div>
								<div class="form-group">
									<input name="login_password" class="form-control" id="loginValidPassword" placeholder="Password" required="" type="password">
								</div>
								<input name="login_btn" id="login_btn" style="width: 100% !important;border-radius: 0 !important;" value="Log in" onmouseover="this.style.color = '#000', this.style.background - color = '#fff;'" class="btn btn-main btn-lg btn-success btn-info " data-loading-text="<i class='fa fa-spinner fa-spin'></i> Searching..." type="submit">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	
	
	
	
	
		<div id="rating_view" class="modal fade  " role="dialog">
			<div class="modal-dialog modal-lg medconnex13-modal">

			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header panel-heading title-bar-blue">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Providers Ratings</h4>
				</div>
				<div class="modal-body">
				
					
			<!-- 		
					<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="pull-left medconnex12-left">
							<div class="form-group medconnex12-grp" >
								<label>Select Provider </label>
								<div class="input-group medconnex12-inputgrp" >
									<select class="form-control category_provider" required=""  style=" width:200px;">
										<option value="">Select Provider</option>
										<option value="1">Driver</option>
										<option value="2">Doctor</option>
										<option value="3">Storefront</option>
									</select>
								</div>
							</div>
					</div>
					
				</div>
			</div> -->
			<div class="panel panel-default">
				<div class="panel-heading title-bar-blue">
					<i class="fa fa-users" aria-hidden="true"></i> Rating <span class="provider_name"></span>
				</div>
				<div class="panel-body">
					<div class="table-responsive" style="min-height: 300px;">
						<table class="table table-hover medconnex13">
							<thead>
								<tr>
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
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>

			</div>
		  </div>
	
	
	
        
		<div id="actual_rating" class="modal fade  " role="dialog">
			<div class="modal-dialog modal-lg medconnex13-modal">

			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header panel-heading title-bar-blue">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Ratings view <span class="ratingstorename"></span></h4>
				</div>
				<div class="modal-body">
				
					
					
					
			<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="table-responsive" style="min-height: 300px;">
						<table class="table table-hover medconnex13">
							<thead>
								<tr>
									
									<th>User Name</th>
									<th>Store Name</th>
									<th>Rating</th>
									<th>Review</th>
									<th>Date</th>
									
								
								</tr>
							</thead>
							<tbody class="rating_view_data">
								<tr><td colspan="100%" align="center">Please Select Provider..</td></tr>
							</tbody>
						</table>
					</div>
				
				</div>
			</div>
					
					
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>

			</div>
		  </div>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>public/dist/js/sb-admin-2.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/moment.js"></script>

    <script src="<?php echo base_url() ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url() ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo base_url() ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="<?=base_url()?>public/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
//		$(document).ready( function() {
//			$("#txtEditor").Editor();
//		});
	</script>
<script type="text/javascript">
$(function() {
	
	
	
	
	
		// $('.pull-left').delegate(".category_provider","change",function(){
			$('.category_provider').click(function(){

				$('.get_provider_list').empty();

				$('.affilitePartnersClose').trigger( "click" );




			var provider_id  = $(this).val();
			var provider_type ="";
			if(provider_id == 1){
				provider_type = "Driver";
			}else if(provider_id == 2){
				provider_type = "Doctor";
			}else if(provider_id == 3){
				provider_type = "Storefront";
			}
			
			
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/get_provider_list",
				data: "provider_id="+provider_id,
				dataType: "json",
				success: function(response)
				{
					$('.get_provider_list').html(response.success);
					$('.provider_name').html(provider_type);
				}
			});
			});
	
	
	
//		$('input[name="starts"]').daterangepicker({
//			singleDatePicker: true,
//			showDropdowns: true
//		});
		
    $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});

$(document).ready(function(){
	$('#dataTables-example').DataTable({
            responsive: false
    });
	
	function notifiy()
	{
		$.ajax({
			type: "post",
			url:"<?php echo base_url('count-notifications');?>",
			data: "",
			dataType: "json",
			success: function(response)
			{
				$("#notifications").html(response.chat);
				$("#notificationsinpdex_notiy").html(response.inpdex_notiy);
				$("#notificationcount").html(response.count);
			}
		});
	}	
	
	$("body").delegate(".update_status_read", "click", function(){
		var notify_id = $(this).attr('id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/update_notification",
			data: "&notify_id="+notify_id,
			dataType: "json",
			success: function(response)
			{
				notifiy();
			}
		});

	}); 
	
	
	function msg_notify()
	{
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/msgnotification",
			data: "",
			dataType: "json",
			success: function(response)
			{
				$("#messages_list").html(response.chat);
				$("#msgcount").html(response.count);
			}
		});
	}
	
	$('#messages_list').delegate(".chat_msg_update","click",function(){
		var notify_id = $(this).attr('id');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/chat_msg_update",
			data: "&notify_id="+notify_id,
			dataType: "json",
			success: function(response)
			{
				msg_notify();
			}
		});
	})
	
	
	
	
	//setInterval(function(){
	notifiy();
	msg_notify();
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/tasknotification",
			data: "",
			dataType: "json",
			success: function(response)
			{
				$("#notitasks").html(response.chat);
				$("#notitaskscount").html(response.count);
			}
		});
		
		
	//}, 2000);
	
	$(".js-cat-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_cat",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".editcatdiv").html(response);
				$('#editcategory').modal('show')   
			} 
	 
		});
	});

	$(".js-our-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_our_team",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".editcatdiv").html(response);
				$('#editcategory').modal('show')   
			} 
	 
		});
	});

	$(".js-background-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_background_image",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".editcatdiv").html(response);
				$('#editcategory').modal('show')   
			} 
	 
		});
	});
	
	
	
	$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_promo",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".updatepromodiv").html(response);
				$('#editpromomodal').modal('show')   
				$(".datetimepicker4").datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
				});
			} 
	 
		});
	});
	
	$(".js-service-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/edit_services",
			data: "&id="+id,
			success: function(response){
				$(".servicediv").html(response);
				//$('#edit_sale_Modal').modal('show')   
			} 
		});
	});
	$(".notes_genral").click(function(){
		var id =$(this).attr("data-id");
		//alert(id);
		$.ajax({
			type: "post",
			url:"<?php echo base_url('general-sales-note');?>",
			data: "&id="+id,
			success: function(response){
				//alert(response);
				$(".updateNote").html(response);
				$('#editUpdate').modal('show') 
			} 
		});
	});
});
  $(document).on("click", ".ratingUsers", function () {
		var id =$(this).attr("data-id");
		var getname=$('.getname'+id).html();
		alert(getname);
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/dashboard/ratingUsers",
			data: "&id="+id,
			success: function(response){
			    $('.ratingstorename').html(getname);
				$(".rating_view_data").html(response);
				$('#actual_rating').modal('show')  
				//alert(response); 
			} 
		});
	});
</script>  
<script type="text/javascript">
     $(document).ready(function(){
        $('#bookid').on('click',function(){
        if(this.checked){
            $('.check').each(function(){
                this.checked = true;
            });
        }else{
             $('.check').each(function(){
                this.checked = false;
            });
        }
    });
    
});
    
</script>  
</body>
</html>