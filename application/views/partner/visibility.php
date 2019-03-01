<style>
	.panel-heading{
		height: 80px;
		max-height: 80px;
	}
	label.error{
		color:red;
		font-weight: 100;
	}
	
	.arrowdown {
		position: absolute;
		margin: auto;
		left: 0; right: 0;
		color:#ff0000;
		width: 40px;
		height: 40px;
		font-size: 80px;
		line-height: 40px;
		-webkit-animation: bounce 2s infinite ease-in-out;
	}
	@-webkit-keyframes bounce {
		0%, 20%, 60%, 100%  { -webkit-transform: translateY(0); }
		40%  { -webkit-transform: translateY(-20px); }
		80% { -webkit-transform: translateY(-10px); }
	}
	
	
	.blink_me {
    
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: steps(1, start);
    -webkit-animation-iteration-count: infinite;
    
    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: steps(1, start);
    -moz-animation-iteration-count: infinite;
    
    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: steps(1, start);
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { background-color: none; }
    50% { background-color: pink }
    100% { background-color: none; }
}

@-webkit-keyframes blinker {  
    0% { background-color: none; }
    50% { background-color: pink }
    100% { background-color: none; }
}

@keyframes blinker {  
    0% { background-color: none; }
    50% { background-color: pink }
    100% { background-color: none; }
}
	
	
</style>

  <div id="page-wrapper">
		    <?php $this->load->view('partner/new-sidebar'); ?>

	

	<div class="row">
		
		<div class="col-lg-12">
			<?php
			if(count($getvisibility) > 0){
				$getvisibility = $getvisibility[0];
				
					$loc_id			=	$getvisibility->loc_id;
					$location_name	=	$getvisibility->location_name;
					$opening_hour	=	$getvisibility->opening_hour;
					$closing_hour	=	$getvisibility->closing_hour;
					$postal_code	=	$getvisibility->postal_code;
					$city			=	$getvisibility->city;
					$paypal_busi_nm	=	$getvisibility->paypal_business_name;
					$country_code	=	$getvisibility->country_code;
					$paypal_clientid=	$getvisibility->paypal_client_id;
					$email			=	$getvisibility->email;
					$time_zone		=	$getvisibility->time_zone;
					$phone_number	=	$getvisibility->phone_number;
					$logo			=	$getvisibility->logo;
					$address		=	$getvisibility->address;
					$latitude		=	$getvisibility->latitude;
					$longitude		=	$getvisibility->longitude;
					$on_off_status	=	$getvisibility->on_off_status;
					$opt_in_out_sta	=	$getvisibility->opt_in_out;
					$patient_tax	=	$getvisibility->patient_tax;
					$adult_use_tax	=	$getvisibility->adult_use_tax;
					$image			=	$getvisibility->logo;
					$application	=	"Update";
				}else{
					$application="Add";
					$loc_id			=	"";
					$location_name	=	"";
					$opening_hour	=	"";
					$closing_hour	=	"";
					$postal_code	=	"";
					$city			=	"";
					$paypal_busi_nm	=	"";
					$country_code	=	"";
					$paypal_clientid=	"";
					$email			=	"";
					$time_zone		=	"";
					$phone_number	=	"";
					$logo			=	"";
					$address		=	"";
					$latitude		=	"";
					$longitude		=	"";
					$image			=	"";
					$on_off_status	=	"";
					$opt_in_out_sta	=	"";
					$patient_tax	=	"";
					$adult_use_tax	=	"";
				}
			?>
			
			<div id="msgsuccess"></div>
			
			<div class="panel panel-default">
				<div class="panel-heading adi-head-orange" style="font-weight:bold;height:45px;">
					<i class="fa fa-edit"></i> Add visibility
				</div>
				<div class="panel-body">
					<form id="form_data" name="user" method="post" action="<?=base_url()?>panels/supermacdaddy/affiliatepartner
						/visibility_action" enctype="multipart/form-data"  novalidate="novalidate" onsubmit="return false;">
						<div id="form-alerts"></div>
						<div class="row">
							<div class="col-lg-9 col-md-12 col-sm-12 medconnex-visibilty">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Location Name</label>
										<input class="form-control" name="location_name" autocomplete="off" value="<?=$location_name?>" type="text" required="">
										<input type="hidden" name="loc_id" value="<?=$loc_id?>">
									</div>
								</div>
								<div class="col-sm-6" style="padding: 0px !important;">
									<div class="form-group col-sm-6">
										<label>Opening Hours</label>
								
										<select  class="form-control" name="opening_hrs" >
										<?php for($i = 0; $i < 24; $i++): 
										$openhr=sprintf("%02d", $i);
										?>
										  <option value="<?= sprintf("%02d", $i); ?>" <?php if($openhr==$opening_hour){ echo "selected";}?>><?= $i % 12 ?  sprintf("%02d", $i) : 12 ?>:00 <?= $i >= 12 ? 'PM' : 'AM' ?></option>
										<?php endfor ?>
										</select>
									</div>
									<div class="form-group col-sm-6">
										<label>Closing Hours </label>
										<select class="form-control" name="closing_hours" >
										<?php for($i = 24; $i > 0; $i--):
										$closehr=sprintf("%02d", $i); ?>
										  <option value="<?= sprintf("%02d", $i); ?>" <?php if($closehr==$closing_hour){ echo "selected";}?>><?= $i % 12 ?  sprintf("%02d", $i) : 12 ?>:00 <?= $i > 12 ? 'PM' : 'AM' ?></option>
										<?php endfor ?>
										</select>
									</div>
								</div>               

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Postal Code</label>
										<input class="form-control" name="postal_code" id="txtAddress" autocomplete="off" value="<?=$postal_code?>" type="text" onblur="GetLocation()">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>City</label>
										<input class="form-control" name="city" autocomplete="off" type="text" value="<?=$city?>">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Paypal Business Details </label>
										<input class="form-control" name="paypal_business" autocomplete="off" placeholder="" type="text" required="" value="<?=$paypal_busi_nm?>" >
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Country Code</label>
										<input class="form-control" name="country_code" autocomplete="off" type="text" value="<?=$country_code?>">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Paypal ID </label>
										<input class="form-control" name="paypal_id" autocomplete="off" placeholder="" type="text" required="" value="<?=$paypal_clientid?>" >
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Email</label>
										<input class="form-control" name="email" autocomplete="off" type="email" required="" value="<?=$email?>">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Time Zone </label>
										<select class="form-control" name="time_zone">
											<option <?php if($time_zone=='PST'){ echo "selected";}?>>PST</option>
											<option <?php if($time_zone=='EST'){ echo "selected";}?>>EST</option>
											<option <?php if($time_zone=='ECT'){ echo "selected";}?>>ECT</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Phone Number</label>
										<input class="form-control" name="phone_no" autocomplete="off" type="text" required="" value="<?=$phone_number?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group ">
										<label>Patient Tax </label>
										<input class="form-control" name="patient_tax" autocomplete="off" placeholder=""  required="" type="text" value="<?=$patient_tax?>">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label>Adult Use Tax</label>
										<input class="form-control" name="adult_use_tax" autocomplete="off" type="text" required="" value="<?=$adult_use_tax?>">
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group ">
										<label>Address</label>
										<input class="form-control" name="address" id="address" autocomplete="off" type="text" required="" value="<?=$address?>">
										
										<button  type="button" id="get_lat_lon" class="btn-green">Latitude & Longitude</button>
										<!--<button  type="button" id="get_lat_lon" class="btn-green">Get LatLong</button>-->
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group ">
										<label>Latitude </label>
										<input class="form-control" name="latitude" id="latitude" autocomplete="off" placeholder="" type="text" readonly="" value="<?=$latitude?>">
									</div>
								</div>

								<div class="col-sm-6 ">
									<div class="form-group ">
										<label>Longitude</label>
										<input class="form-control" name="longitude" id="longitude"  autocomplete="off" placeholder="" type="text" readonly="" value="<?=$longitude?>">
									</div>
								</div>

							</div>
							<div class="col-lg-3 col-md-12 col-sm-12 logo-upload" style="text-align:center;">
								<div class="upload111">
									<div class="img-holder" style="width:220px; height:220px; background:#ddd; border:4px solid #ccc; margin-bottom:15px;display:inline-block;">
									<img src="<?=base_url()?>uploads/<?=$image?>" id="myImg" style="max-width:210px;max-height:210px; height: 100%;"/>
									<input type="hidden" name="old_image" value="<?=$image?>">
								</div>
							</div>
							<div class="upload112">
								<label style="background:#06F; padding:5px 8px; color:#fff;cursor:pointer;margin-bottom:0px;max-width: 220px;" id="image_file_open"><i class="fa fa-paperclip btn-blue"></i> Upload Company Logo  <input type="file" name="image" id="get_image" style="display:none;" ></label>
							</div>
								<!--<p style="color:#666; padding-top:5px;">Min. Image Size: 1024*1024</p>-->
							</div>

						</div>
						<br>
						<div class="row modal-footer">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										
										<?php 
										$optinData=str_replace('<p>', '',$optin['content']);
										$optinData1=str_replace('</p>', '',$optinData);
										$optOutData=str_replace('<p>', '',$optout['content']);
										$optOutData1=str_replace('</p>', '',$optOutData);
									


										?>
										<button type="button"   id="opt_in"	 data-toggle="tooltip" data-placement="top" title="<?=$optinData1?>" class="btn-green opt_btn blink_me">OPT In</button>
										<button  type="button"  id="opt_out" data-toggle="tooltip" data-placement="top" title="<?=$optOutData1?>" data-val="0" class="btn-green opt_btn blink_me">OPT Out</button>
									</div>          
								</div>
								<div class="">
									<div class="vert-pad">
										<?php if(!empty($loc_id)){ ?>
										<button type="submit" name="update_change" class="btn-green">Update Changes</button>
										<?php }else { ?>
										<button type="submit" name="save_change" class="btn-green">Save Changes</button>
										<?php } ?>
									</div>          
								</div>
								<div class="">
									<div class="vert-pad">
										<button type="reset" class="btn-grey" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


<div id="opt_inout_msg" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Notification</h4>
			</div>
			<div class="modal-body">
				<div style="margin-top:5%">&nbsp;</div>
				<div class="arrowdown" >&#8681;</div>
				<div style="margin-top:15%" align="center"><button  type="button"  class="btn-green blink_me" style="width:30%;">OPT Out</button></div>
				<p><?=$optout['content']?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-QWLBOFf2TuPL8w0PC5akC4-_Yi0Th7A" type="text/javascript"></script>
<script>
	


	
	function showResult(result) {
		document.getElementById('latitude').value = result.geometry.location.lat();
		document.getElementById('longitude').value = result.geometry.location.lng();
	}

	function getLatitudeLongitude(callback, address) {
		geocoder = new google.maps.Geocoder();
		if (geocoder) {
			geocoder.geocode({
				'address': address
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					callback(results[0]);
				}
			});
		}
	}

	$('#get_lat_lon').click(function () {
		var address = $('#address').val();
		getLatitudeLongitude(showResult, address);
	});
	
	
	$(document).ready(function() {
		$('button[data-toggle="tooltip"]').tooltip({
			animated: 'fade',
			placement: 'top',
		});
	//longitude location get
	getLocation();
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, positionError);
		} else { 
			alert("Geolocation is not supported by this browser.");
		}
	}
	
	function positionError() {
		alert('Geolocation is not enabled. Please enable to use this feature');
	}

	function showPosition(position) {
		$('#longitude').val(position.coords.longitude)
		$('#latitude').val(position.coords.latitude)
	}
	
	setTimeout(function(){
			$('#opt_inout_msg').modal('show');
	}, 4000);
	
	
	
			<?=($opt_in_out_sta=="0")?"$('#opt_out').hide();":"$('#opt_in').hide();"?>	
	//end longitude location get		

	$('#opt_in').click(function(){
		$('#opt_in').hide();
		$('#opt_out').show();
	})
	$('#opt_out').click(function(){
		$('#opt_out').hide();
		$('#opt_in').show();
	})
		
	$(".opt_btn").click(function(){
		var in_out_val= $(this).attr('data-val');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/opt_in_out_status",
			data: "&in_out_val="+in_out_val,
			dataType:"json",
			success: function(response){
				if(response.success == true)
				{
					$('#msgsuccess').html(response.msg);
				}
				else 
				{
					alert('something wrong..!');
				}
			} 
		});
	});
		
		
		
    $("#get_image").change(function () {
		if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
		
	$("#form_data").validate({
		ignore: [],
		rules: {
				location_name:	{
                    required: true
                },
				opening_hrs		:"required",
				closing_hours	:"required",
				postal_code		:"required",
				city			:"required",
				paypal_business	:"required",
				country_code	:"required",
				paypal_id		:"required",
				email			:"required",
				time_zone		:"required",
				phone_no		:"required",
				address			:"required",
				patient_tax		:"required",
				adult_use_tax	:"required"
		},
		messages: {
				location_name	: "Please Enter your Location Name",
				opening_hrs		: "Please Enter your Open HRS",
				closing_hours	: "Please Enter your Close HRS",
				postal_code		: "Please Enter your Postal Code",
				city			: "Please Enter your City",
				paypal_business	: "Please Enter your Paypal Business",
				country_code	: "Please Enter your Country Code",
				paypal_id		: "Please Enter your Paypal ID",
				email			: "Please Enter your Email",
				time_zone		: "Please Enter your Time Zone",
				phone_no		: "Please Enter your Phone no",
				address			: "Please Enter your Address",
				patient_tax		: "Please Enter your Patient tax",
				adult_use_tax	: "Please Enter your Adult use tax"
     	},
		submitHandler: function(form) {
			
			form.submit();
		}
	});
    $("#get_image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
	
	function imageIsLoaded(e) {
	 $('#myImg').attr('src', e.target.result);
	};
	
});

	function GetLocation() {
		var geocoder = new google.maps.Geocoder();
		var address = document.getElementById("txtAddress").value;
		geocoder.geocode({ 'address': address }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
						var textbox3 = document.getElementById('latitude');
						var textbox4 = document.getElementById('longitude');
						textbox3.value= +latitude ;
						textbox4.value=+longitude;
			} else {
				alert("Request failed.");
			}
		});
	}
</script>