<style type="text/css">
	.table tbody tr td{
		font-size: 14px;
	}
</style>

<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">  <!-- <h1 class="page-header">Promo Codes</h1> -->
			<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				?>
				<div class="alert alert-success alert-dismissable">
	                <button type="button" class="close" data-dismiss="alert">&times;</button>
	                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>.
				</div>
				<?php } elseif ($this->session->flashdata('error_msg')) { ?>
	            <div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Danger!</strong> <?php echo $this->session->flashdata('error_msg'); ?>.
				</div>
			<?php }
			?>
		</div>
    </div>
<?php $this->load->view('sales_templates/new-sidebar'); ?>
	<div class="row sortable">
		<div class="box span12 col-md-12">
		<button type="button" id="salesButton" class="btn btn-success">ACTIVE SALES</button>	<button type="button" id="uploadButton" class="btn btn-success">UPLOAD</button>
	</div>
		<div class="box span12 col-md-12 salesDiv">
			
			<div class="row">
				<div class="col-lg-12">

                    <div class="panel panel-default">
						<div class="panel-heading title-bar-blue">
							<p><i class="fa fa-camera" aria-hidden="true"></i>  Advertisement Sales</p>
						</div> <!-- /.panel-heading -->
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                           <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->
                           	<div class="table-responsive">
								<table width="100%" class="table table-striped table-bordered table-hover custom-table medconnex17" id="dataTables-example">
									<thead>
										<tr class="first-row">
											<th>S.No</th>
											<th>Provider name</th>
											<th>Zip code zone</th>
											
											<th>Start/End dates</th>
											<th>Advertisement type</th>
									<!-- 		<th> Payment method</th>  -->
												<th> Screenshot space</th> 
											<th>description</th>
											<th>Contact#</th>
											<th>Email</th>
											<th>Upload Image</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php $i = '1';
										///echo "<pre>"; print_r($all_advr);
										foreach ($all_advr as $row) { 
		// 														  $ad_id = $row['ad_id'];
		// 													  $sql = "select id,paymentMethod from transactions where ad_id = '". $ad_id ."'";
		
		// $query = $this->db->query($sql);
		// $resultpayment = $query->row();
									

											?> 

											<tr>
												<td><?php echo $i++; ?></td>
													<td>
													<?php echo $row['providername']; ?>
												</td>
												<td><?php echo $row['zip']; ?></td>
														
												<td><?php echo $row['insert_date']; ?> <br><?php echo $row['end_date']; ?></td>
												<td><?php echo $row['ad_type']; ?></td>
									<!-- 			<td><?php if(!empty($resultpayment->paymentMethod)){ echo $resultpayment->paymentMethod; } ?></td> -->
												
											 <td><?php $screenshotspace1 =  $row['screenshotspace']; 
												 $screenshotspace = explode(',', $screenshotspace1);
												//echo "<pre>"; print_r($screenshotspace);
												if(!empty($screenshotspace[0])){
													echo $screenshotspace[0].'<br>';
												}
												if(!empty($screenshotspace[1])){
													echo $screenshotspace[1].'<br>';
												}
												if(!empty($screenshotspace[2])){
													echo $screenshotspace[2].'<br>';
												}
												if(!empty($screenshotspace[3])){
													echo $screenshotspace[3].'<br>';
												}
												?></td>
											 
												
										
												<td><?php echo $row['description']; ?></td>
												
													<td><?php echo $row['contact']; ?></td>
												<td><?php echo $row['email']; ?></td>
													<td class="center">
													<?php
													if ($row['ad_image'] != '') {
														$filename = 'uploads/' . $row['ad_image'];
														if (file_exists($filename)) {
														?>
														<a target="_blank" href="<?php echo base_url(); ?>uploads/<?php echo $row['ad_image']; ?>"><img src="<?php echo base_url(); ?>uploads/<?php echo $row['ad_image']; ?>" height="150px;" width="200px;"></a>
														<?php }
													} ?>
												</td>
											

												<td><div class="btn-group">
													<?php if ($row['status'] == '0') { ?>
													<!-- 	<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Disabled<span class="caret"></span></button> -->
															<button type="button" class="btn btn-success ">Wait For Approval<span></span></button>
														<ul class="dropdown-menu" role="menu">
															<!-- <li>
																<form action="" method="post" style="margin: 0px;">
																	<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="<?= $row['ad_id'] ?>" id="enable"  class="js-user-disable">
																		<i class="fa fa-minus-circle"></i>  Enable
																	</button>
																</form>
															</li> -->
													<?php } else { ?>
														<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Show<span class="caret"></span></button>
														<ul class="dropdown-menu" role="menu">
															<!-- <li>
																<form action="" method="post" style="margin: 0px;">
																	<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="<?= $row['ad_id'] ?>" id="disable" data-id="' . $val['id'] . '" class="js-user-disable">
																		<i class="fa fa-minus-circle"></i>  Disable
																	</button>
																</form>
															</li> -->
													<?php } ?>
															<li>
																<a  class="gn-GenSales-edit"  id="testRecord" href="javascript:void(0);" data-id="<?php echo $row['ad_id']; ?>">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li>
																<a  href="javascript:void(0);" data-id="<?php echo $row['ad_id']; ?>"  data-target="#sendmail"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> Send mail
																</a>
															</li>
															
<!-- 
															<li>
																<a  class=""  href="javascript:;" data-id="<?php echo $row['ad_id']; ?>">
																	<i class="fa fa-book"></i> Notes
																</a>
															</li> -->
<?php

		if(empty($resultpayment->id)){
			?>
				<li>
																<a  href="javascript:;"   data-toggle="modal" data-target="#myModal<?php echo $row['ad_id']; ?>">
																	<i class="fa fa-credit-card"></i> Payment
																</a>
															</li>
			<?php
		

		}
	 ?> 
														

															<li>
																<form action="<?php echo base_url(); ?>sales/deleteAdver" method="post">
																	<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
																	<input type="hidden" name="ad_type" value="<?php echo $row['ad_type']; ?>">
																	<span style="padding: 3px 20px;"><i class="fa fa-trash-o" aria-hidden="true"></i><input type="submit"  value="Delete" onclick="return confirm('Are you sure you want to delete?');" style="background: none; border: none;"></span>

																<!-- <a class="" onclick="return confirm('Are you sure you want to delete?');" href="<?php echo base_url(); ?>sales/deleteAdver/<?php echo $row['ad_id']; ?>">
																	<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
																</a> -->
																</form>

															</li>
														</ul>
													</div>
												</td>
											
											</tr>
<div class="modal fade" id="myModal<?php echo $row['ad_id']; ?>" role="dialog">
    <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Payment</h4>
			</div>
			<div class="modal-body">
				<div align="center" style="margin: 20px;">
				<!-- 	<a href="<?= base_url() ?>Paypal/buy" class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">PayPal</a> -->

					<form action="<?= base_url() ?>Paypal/buy" method="post">
						<input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
						<input type="submit" name="" class="btn-green" style="color:#fff;padding: 10px 46px ;margin: 20px;" value="PayPal">
						
					</form>

					<!-- <a href="<?= base_url() ?>panels/supermacdaddy/sales/payment"  class="btn-green" style="color:#fff;padding: 10px 30px ;margin: 20px;">Payoneer</a> -->
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

    </div>
</div>
										
										<?php } ?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
		</div><!--/span-->
		<div class="box span12 col-md-12 uploadsDiv" style="display: none;">
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
						<div class="panel-heading title-bar-orange">
							<p style="color: #fff;font-size: 16px; padding: 0px;margin: 2px;"><i class="fa fa-upload" aria-hidden="true"></i>   Advertisement Upload</p>
						</div> <!-- /.panel-heading -->
						<div class="panel-body">
                            <div class="row Advertisement-Upload">
								<form method="post" action="<?php echo base_url(); ?>sales/saveAdver" enctype="multipart/form-data"  >
									<div class="col-lg-12" style="padding: 0px !important;">

										<div class="col-lg-12 form-group  Complimentary">
											<label for="name">Provider Id</label>
											<input type="text" class="form-control"  name="providerid" >
										</div>
										<div class="col-lg-12 form-group  Complimentary">
											<label for="name">Provider name</label>
											<input type="text" class="form-control"  name="providername" >
										</div>
									

										<div class="col-lg-12 form-group ">
											<label for="email">Advertisement Type</label>
											<select class="form-control atype "  name="ad_type" required="required">
												<option value="">Select</option>
												<option value="Platinum">Platinum</option>
												<option value="Weekly Specials">Weekly Specials</option>

													<option value="1stclass">Ist Class</option>
												<option value="2ndclass">2nd Class</option>
										<!-- 		<option value="Complimentary">Complimentary</option> -->
											</select>
										</div>
											<div class="col-lg-12 form-group zipcode Complimentary" style="display: none">
											<label for="name">Zip code zone</label>
											<input type="text" class="form-control" id="nm" name="zip" maxlength="10">
										</div>
									<!-- 	<div class="col-lg-12 form-group Complimentary">
											<label for="name">Payment method</label>
											<input type="text" class="form-control crequire"  name="payment" required="">
										</div> -->
										<div class="col-lg-12 form-group Screenshotspace" style="display: none;">

											<label for="name">Screenshot space</label>
											<div class="checkbox">
												<label><input type="checkbox" name="screenshotspace[]" value="paymentmethod"> Payment Method</label>&nbsp;&nbsp;&nbsp;
												<label><input type="checkbox" name="screenshotspace[]" value="confirmation"> Confirmation</label>&nbsp;&nbsp;&nbsp;
												<label><input type="checkbox" name="screenshotspace[]" value="favorites"> Favorites</label>&nbsp;&nbsp;&nbsp;
												<label><input type="checkbox" name="screenshotspace[]" value="coins"> Coins</label>
										</div>
									</div>
										<div class="col-lg-12 form-group description description1">
											<label for="name">Description</label>
											<input type="text" class="form-control crequire description"  name="description">
											<!-- <textarea cols="10" class="form-control crequire" rows="10" name="description" ></textarea> -->
										</div>
										<!-- <div class="col-lg-12 form-group Complimentary">
											<label for="name">Payment</label>
											<input type="text" class="form-control crequire"  name="payment" required="">
										</div> -->
										<div class="col-lg-12 form-group Complimentary">
											<label for="name">Contact</label>
											<input type="text" class="form-control crequire"  name="contact" required="">
										</div>
										<div class="col-lg-12 form-group Complimentary">
											<label for="name">Email</label>
											<input type="text" class="form-control crequire"  name="email" required="">
										</div>

										<!-- <div class="col-lg-12 form-group Complimentary">
											<label for="name">Advertisement Title</label>
											<input type="text" class="form-control crequire"  name="ad_title" required="">
										</div> -->
										<div class="col-lg-12 form-group Complimentary ad_size">
											<label for="name">Advertisement Size</label>
											<select class="form-control crequire " name="ad_size" id="ad_size">
												<option value="200x200" class="200">200 x 200</option>
												<option value="1080x1920" class="1080">1080 x 1920</option>
											</select>
										</div>
										<div class="col-lg-12  form-group Complimentary imageFile">
											<label for="extra">Choose File</label>
											<input type="file"  name="image" id="create_taskimage"  class="get_image crequire">
											<span id="setcreate_taskimage"></span>
											<img src="" id="myImg" width="200px" height="100px" style="display: none">
											<input name="remove_image_task" type="hidden" id="get_imagetask_hidden">
										</div>

											<div class="col-lg-6 form-group Complimentary">
											<label for="name">Start Date</label><br/>
											<input type="text" class="form-control datetimepicker4 crequire"   name="insert_date" required="">
										</div>
										<div class="col-lg-6 form-group Complimentary">
											<label for="name">End Date</label><br/>
											<input type="text" class="form-control datetimepicker4 crequire"   name="end_date" required="">
										</div>
									
										<div class="row modal-footer">
											<div class="col-md-12">
												<div class="creatUserBottom creatUserBottom">
													<div class="vert-pad">
														<button type="submit" name="submit" class="btn-green">Save</button>
													</div>
												</div>
											</div>
											<!-- <div class="">
												<div class="vert-pad">
													<button type="reset" class="btn-grey" >Cancel</button>
												</div>
											</div> -->
										</div>
									</div>
									</div>
								<!-- 	<div class="col-lg-6 ">
										<div class="col-lg-12 form-group Complimentary">
											<label for="state">State</label>
											<select class="form-control crequire" name="state" id="state" required="required" >
												<option value="">Select state</option>
												<?php foreach ($all_state as $state){
													echo '<option value="'.$state->name.'">'.$state->name.'</option>';
												} ?>
											</select>
										</div>
										<div class="col-lg-12 form-group">
											<label for="seltop">Text Box</label>
											<textarea class="form-control textbox" name="description" rows="9" ></textarea>
											<span id="reamingtext"></span>
										</div>
									</div> -->
								
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div><!--/row-->
</div>
<?php 


?>

<!-- Modal -->
<div class="modal fade" id="editadv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#000;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">General sales</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="user" method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/sales/updateAvr" enctype="multipart/form-data" novalidate="novalidate">
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="updateadvr">
							<!--/AJAX CALL/-->
						</div>

					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="col-md-12">
								<div class="creatUserBottom creatUserBottom-2">
									<button type="submit" name="update" class="btn btn-success btn-green">Update</button>
									<button type="button" class="btn btn-warning btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

 <div class="modal fade" id="sendmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('sales/composemail');?>" enctype="multipart/form-data">
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
								<label>CC</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" name="cc" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<div class="input-group" style="width: 100%;" >
									<input type="text" name="send_subject" class="form-control" required="" >
								</div>
							</div>


							<div class="form-group"  >
								<label>Message</label>
								<div class="input-group"  style="width: 100%;" >
									<textarea class="form-control" id="composmail" name="send_message" rows="4" ></textarea>

								</div>
							</div>
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="col-md-12">
							<div class="creatUserBottom creatUserBottom-2">
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





<script>
	$("#create_taskimage").change(function () {
		var formData = new FormData();
		var file_data = $('#create_taskimage').prop('files')[0];
		formData.append('image', file_data);
		var ad_size = $('#ad_size').val();
		formData.append('ad_size', ad_size);
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/temp_view",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function (data) {
				console.log(data.success);
				$('#setcreate_taskimage').html('<br><img src="<?= base_url() ?>uploads/tmp_file/' + data.success + '" >');
				$('#get_imagetask_hidden').val(data.success);
			},
			error: function (data) {
				console.log(data);
			}
		});

	});



	$(document).ready(function () {
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/auto_mailsend_ads_sales",
			data: "",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function (data) {
				console.log(data);

			},
		});
	});

	$(document).on('click', '#testRecord', function () {
		var id = $(this).attr("data-id");

		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/edit_adrv_sale",
			data: "&id=" + id,
			success: function (response) {
				//console.log(response['id']);
				$(".updateadvr").html(response);
				$('#editadv').modal('show');
				$(".datetimepicker4").datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
				});
			}

		});
	});
	$('.atype').change(function() {
    var atype=$(this).val();
    if(atype =='Weekly Specials'){
    	$('.crequire').prop('required',true);
    	$('.zipcode').prop('required',false);
        $('.zipcode').css('display','block');
        $('.Complimentary').css('display','block');
         $('.Screenshotspace').css('display','none');
        
        $(".description").val('');
        $(".description").attr('maxlength','100');
        $('.200').css('display','block');
    	   $('.1080').css('display','none');
    	     $('.description').css('display','block');



    	   $('option[value="200x200"]').attr("selected","selected");


    	   // $('.200').find(":selected").text();

    }else if(atype =='Platinum'){

  //   	 $("form").submit(function(){
		// if ($('input:checkbox').filter(':checked').length < 1){
  //       alert("Check at least one Screenshot space!");
		// return false;
		// }
  //   });
  

    	 $('.Screenshotspace').css('display','block');
    	  $('.zipcode').css('display','none');
    	  $('.1080').css('display','block');
    	   $('.200').css('display','none');
    	    $('.description').css('display','none');


												
												 $('option[value="1080x1920"]').attr("selected","selected");
    	   // $('.1080').find(":selected").text();
    	 
    	// $('.crequire').prop('required',false);

     //  $('.Complimentary').css('display','none');
    }


												
    else if(atype =='1stclass'){


  

    $('.crequire').prop('required',false);
    	$('.zipcode').prop('required',false);
        $('.zipcode').css('display','block');
        $('.Complimentary').css('display','block');
         $('.Screenshotspace').css('display','none');
         $('.ad_size').css('display','none');
          $('.imageFile').css('display','none');

         
        
        $(".description").val('');
        $(".description").attr('maxlength','100');
        $('.200').css('display','block');
    	   $('.1080').css('display','none');
    	     $('.description1').css('display','none');



    	   $('option[value="200x200"]').attr("selected","selected");
   
    
        }else if(atype =='2ndclass'){


$('.crequire').prop('required',false);
    	$('.zipcode').prop('required',false);
        $('.zipcode').css('display','block');
        $('.Complimentary').css('display','block');
         $('.Screenshotspace').css('display','none');
          $('.ad_size').css('display','none');
          $('.imageFile').css('display','none');
         $('.description1').css('display','none');
        
        $(".description").val('');
        $(".description").attr('maxlength','100');
        $('.200').css('display','block');
    	   $('.1080').css('display','none');
    	  



    	   $('option[value="200x200"]').attr("selected","selected");
  
    }

    else{
 
     
    	$('.Complimentary').css('display','block');
    	$('.crequire').prop('required',true);
    	$('.zipcode').css('display','none');
    	        $(".description").val('');
    	$(".description").attr('maxlength','10000');
    }

    var atype=$(this).val();



});



		$("#create_taskimage").change(function () {
			if (this.files && this.files[0]) {
				//alert('hi');
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded(e) {
              var dataImage= $('#create_taskimage').prop('files')[0];
              var fileName = dataImage.name;
              var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
              var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
               if ($.inArray(fileNameExt, validExtensions) == -1) {
               	 $('#myImg').css('display', 'block');
                $('#myImg').attr('src', '');
               
                }else{
                	 $('#myImg').css('display', 'block');
                   $('#myImg').attr('src', e.target.result);
                  
               }
			
		};
		$(document).ready( function() {        
        var maxLen = 200;
        
        $('.textbox').keypress(function(event){
            var Length = $(".textbox").val().length;
            var AmountLeft = maxLen - Length;
            $('#reamingtext').html(AmountLeft);
            if(Length >= maxLen){
                if (event.which != 8) {
                	alert('only enter 200 characters only')
                    return false;
                }
            }
        });

});
</script>

<script type="text/javascript">
		$("#salesButton").click(function () {

$(".salesDiv").css("display","block");
$(".uploadsDiv").css("display","none");


		});



	$("#uploadButton").click(function () {

$(".salesDiv").css("display","none");
$(".uploadsDiv").css("display","block");


		});
</script>