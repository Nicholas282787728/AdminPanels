<style type="text/css">
	.modal-content {
 
    width: 1000px !important;
  
    margin-left: -200px;

}
.signup-container{
    width: 90%;
    margin: 0 auto;
    font-family: 'CenturyGothic';
}
.signup-container ul{
    padding: 0;
    list-style: none;
    color: #78717e;
}
.signup-title{
    padding: 15px;
    color: #fff;
    background: #000;
    font-size: 22px;
    margin-bottom: 20px;
    float: left;
    width: 100%;
} 
.green, .btn-green{
    background: #00afaa;
    border-color: #00afaa;
}
.btn-green:hover{
    background: #0e9692;
    border-color: #0e9692;
}
.pink, .btn-pink{
    background: #e03d80;
    border-color: #e03d80;
}
.btn-pink:hover{
    background: #c22666;
    border-color: #c22666;
}
.affliatebtn{
    border-radius: 0;
    padding: 6px 12px;
    font-family: 'CenturyGothic';
}
.signup-container li{
    margin-bottom: 30px;
    float: left;
    width: 100%;
}
.partnershp-requirements h4{
    color: #333533;
    font-weight: bold;
}
.partnershp-requirements ol li{
    float: left;
    width: 100%;
    color: #404041;
    margin-bottom: 0;
}
.partnershp-requirements-2 p{
    font-family: 'CenturyGothic';
    color: #404041;
    margin-bottom: 15px;
    font-size: 18px;
}
.section-title p.text-capitalize{
    font-size: 31px;
}
@media(max-width: 991px){
    .img-sec img{max-width: 30%;}
    .partnershp-requirements ol{
        float: left;
        margin-bottom: 30px;
        width: 100%;
        text-align: center;
        padding: 0;
    }
}
nav.affiliate-tabbing-nav{
    margin-top: 25px;
    float: left;
    width: 100%;

}
nav.affiliate-tabbing-nav ul{
    float: left;
    width: 100%;
}
nav.affiliate-tabbing-nav ul li{
    float: left;
    width: 33.33%;
}
.affiliate-tabbing-nav .nav-tabs li.active a{
    background: #e03d80;
    
    color: #fff;
}
.affiliate-tabbing-nav .nav-tabs li.active{
    border-bottom: 3px solid #00afaa;
}
.affiliate-tabbing-nav .nav-tabs a{
    float: left;
    width: 100%;
    padding: 18px 25px;
    background: #272e38;
    border-radius: 0;
    color: #fff;
    text-align: center;
}
.affiliate-tabbing-nav .nav-tabs a.nav-item.nav-link:hover, .affiliate-tabbing-nav .nav-tabs a.nav-item.nav-link:focus {
    border: none;
    background: #e03d80;
    color: #fff;
    border-radius: 0;
    transition: background 0.20s linear;
}
#dataTables-example_length {
	display: block !important;
}
/*@media (min-width: 768px){
	.col-sm-6 {
    width: 6%;
}	
}*/
.col-sm-6 {
     width: 6%;
}
.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {
    float: right;
}

</style>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
			?>
			<div id="msg_success_ajax"></div>
			<div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
					<h3 class="panel-title pull-left"><i class="fa fa-users"></i> Affiliate Partners</h3>
				</div>
                <div class="panel-body">
					<div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="example">
                            <thead>
                                <tr>
									<th>S.No</th>
									<th>Phone#</th>
									<th>Email</th>
										<th>Notes</th>
										<th>Link To Application</th>
							<!-- 		<th>Current Email</th> -->
									<th>Status/action</th>                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $sno='1';
                                 foreach($alluser as $val){?>
                                <tr class="odd gradeX" id="rejectremove_<?=$val['id']?>">
									<td><?php echo $sno++;?></td>
									<td><?php echo $val['mob_number'];?></td>
									<td><?php echo $val['email'];?></td>
									<td>	<a class="btn btn-info " href="javascript:void(0);" data-target="#notes<?php echo $val['user_id']; ?>"  data-toggle="modal"    >
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>

											
											</td>
											<td>	<a class="btn btn-info " href="javascript:void(0);" data-target="#viewInfo<?php echo $val['user_id']; ?>"  data-toggle="modal"    >
											View Info
											</a>

											
											</td>
								
									<!-- <td><?php echo $val['current_email'];?></td> -->
									
									<td class="center">
                                        <?php if($val['is_verify']==1){
                                        	 echo '<div class="btn-group">
            							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
											Activate 
											<span class="caret"></span>
										</button>            
								<ul class="dropdown-menu" role="menu">
									<li>
										<form action="" method="post">
										<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="deactive" value="'.$val['user_id'].'" id="deactive" data-id="'.$val['user_id'].'" class="js-user-disable">
										<i class="fa fa-minus-circle"></i>  Deactivate 
										</button>
										</form>
									</li>
									<li>
																<a  href="javascript:void(0);" data-id="'.$val['user_id'].'"  data-target="#sendmail'.$val['user_id'].'"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> send mail
																</a>
															</li>
															<li>
																 <a  href="javascript:void(0);" data-target="#notes'.$val['user_id'].'"  data-toggle="modal"    >
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>notes
											</a>
															</li>
															<li>
																 <a  href="javascript:void(0);" data-target="#changePassword'.$val['user_id'].'"  data-toggle="modal"    >
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Change Password
											</a>
															</li>
															
								</ul>
							</div>';                                       	
									}else{
										 echo ' <div class="btn-group">
										<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
											Unactivated
											<span class="caret"></span>
										</button>            
								     	<ul class="dropdown-menu" role="menu">
										<li>
											<form action="" method="post">
											<input type="hidden" name="send_to" value="'.$val['email'].'">
											<input type="hidden" name="user_name" value="'.$val['user_name'].'">
											
											<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$val['user_id'].'" id="active" data-id="'.$val['user_id'].'" class="js-user-disable">
											<i class="fa fa-minus-circle"></i>  Activate 
											</button>
											</form>
										</li>
										<li>
																<a  href="javascript:void(0);" data-id="'.$val['user_id'].'"  data-target="#sendmail'.$val['user_id'].'"  data-toggle="modal">
																	<i class="fa fa-envelope-o"></i> send mail
																</a>
															</li>
															<li>
																 <a  href="javascript:void(0);" data-target="#notes'.$val['user_id'].'"  data-toggle="modal"    >
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>notes
											</a>
															</li>
															<li>
																 <a  href="javascript:void(0);" data-target="#changePassword'.$val['user_id'].'"  data-toggle="modal"    >
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Change Password
											</a>
															</li>
															
										</ul>
									   </div>';
                                        	}?>
									</td>
									
                                </tr>

                               

                                 <div class="modal fade" id="sendmail<?php echo $val['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Send Mail</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('dashboard/affiliateEmail');?>" enctype="multipart/form-data">
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>To</label>
								<div class="input-group" style="width: 100%;">
									<input type="text" readonly="" name="send_to" value="<?php echo $val['email']; ?>" class="form-control" required="" >
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
									<input type="text" name="send_subject"  class="form-control" required="" >
								</div>
							</div>


							<div class="form-group"  >
								<label>Message</label>
								<div class="input-group"  style="width: 100%;" >
									<textarea class="form-control ckeditor" id="composmails" name="send_message" rows="4" ></textarea>

								</div>
							</div>
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom creatUserBottom-2">
							<button type="submit"  class="btn-green">Send Message</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="notes<?php echo $val['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Affiliate Partners Note update</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<form  method="post" action="<?php echo base_url();?>pending-affiliate">
					<div id="form-alerts">
					</div>
			
				
						
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Notes</label>
								<div class="input-group" style="width: 100%;">
						
		
	
			<input type="hidden" name="user_id" value="<?php echo $val['id']; ?>">
											<textarea class="ckeditor" rows="10" cols="20" name="notes"><?php echo $val['notes'];?></textarea>
								</div>
							</div>
							
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom creatUserBottom-2">
							<button type="submit"  name="updateNote" class="btn-green">Update</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
		
						
					
					
				</form>
			</div>
		</div>  
	</div>
</div> 
<div class="modal fade" id="changePassword<?php echo $val['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Change Password</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<form  method="post" action="<?php echo base_url();?>pending-affiliate">
					<div id="form-alerts">
					</div>
			
				
						
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
						<div class="form-group">
								<label>Old Password</label>
								<div class="input-group" style="width: 100%;" >
									<input type="hidden" name="user_id" value="<?php echo $val['user_id'];?>">
									<input type="password" name="password"  class="form-control" required="" >
								</div>
							</div>


							<div class="form-group"  >
								<label>New Password</label>
								<div class="input-group"  style="width: 100%;" >
					<input type="text" name="newpassword"  class="form-control" required="" >

								</div>
							</div>
							
							
						</div>

					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom creatUserBottom-2">
							<button type="submit"  name="changePassword" value="<?php echo $val['user_id'];?>" class="btn-green">Update</button>
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						</div>
					</div>
		
						
					
					
				</form>
			</div>
		</div>  
	</div>
</div> 






<div class="modal fade" id="viewInfo<?php echo $val['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Link To Application</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
		
					<div id="form-alerts">
					</div>
			
				
						
					<div id="form-alerts"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-md-12">
								<!-- 	<div class="section-title st-center">
							
										<p class="title-heading font-century text-capitalize" data-trn-key="menu_service">Med Connex License Application</p>
							
									</div> -->
									<div class="block typeOfServices">
									
									<form>
											<div class="signup-container">
												<ul>
													<li>
														<div class="signup-title green">
															Contact Information
														</div>
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-4">														
																	<div class="form-group">
																		<label>*Legal First Name :</label>
																		<input type="text" name="user_name" value="<?php echo $val['user_name'];?>" class="form-control" required="">
																		<input type="hidden" name="user_type" value="10">
																	</div>
																	<div class="form-group">
																		<label>*Mobile Number :</label>
																		<input type="text" name="mob_number" value="<?php echo $val['mob_number'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Street Number :</label>
																		<input type="text" name="street_num" value="<?php echo $val['street_num'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Country :</label>
																		<?php
																		$country1 = $val['country'];
																			 $sql = "select name from countries where id = '$country1' ";
																		
					
																		 $query = $this->db->query($sql);
																		 $country = $query->row();
																	

																		 ?>
																		<input type="text" name="country" value="<?php echo $country->name;?>" class="form-control" required="">
																		
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label>*Legal Middle Name :</label>
																		<input type="text" name="middle_name" value="<?php echo $val['middle_name'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Alternate Number :</label>
																		<input type="text" name="alternate_num" value="<?php echo $val['alternate_num'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Street Name :</label>
																		<input type="text" name="street" value="<?php echo $val['street'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*State / Number :</label>
																		<?php
																			$state = $val['state'];
																			 $sql = "select name from states where id = '$state' ";
																		
					
																		 $query = $this->db->query($sql);
																		 $state = $query->row(); 
																		?>
																			<input type="text" name="state" value="<?php echo $state->name;?>" class="form-control" required="">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label>*Legal Last Name :</label>
																		<input type="text" name="last_name" value="<?php echo $val['last_name'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Email :</label>
																		<input type="text" name="email" value="<?php echo $val['email'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*Zip / Postal Code :</label>
																	<!-- 	<select name="" class="form-control">
																			<option>Zip / Postal Code</option>
																		</select> -->
																		<input type="text" name="zip" value="<?php echo $val['zip'];?>" class="form-control" required="">
																	</div>
																	<div class="form-group">
																		<label>*City :</label>
																	<!-- 	<select name="city" class="form-control" id="city_list">
																			<option>Select State </option>
																		</select> -->
																			<?php
																			$city = $val['city'];
																			 $sql = "select name from cities where id = '$city' ";
																		
					
																		 $query = $this->db->query($sql);
																		 $city = $query->row(); 
																		?>
																		<input type="text" name="city" value="<?php echo $city->name;?>" class="form-control" required="">
																	</div>
																</div>
															</div>
														</div>
													</li>
													<li>
														<div class="signup-title pink">
															Tell Us About Yourself
														</div>
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-6">
																	
																		<div class="form-group">
																			<label>Resume upload (optional)  :</label>
																		
																			<img src="<?php echo base_url(); ?>uploads/<?php echo $val['logo'];?>">
																		</div>
																		<div class="form-group">
																			<label>*US Residency State :</label>
																			<!-- <select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																			<input type="text" name="residency_state" value="<?php echo $val['residency_state'];?>" class="form-control" required="">
																		</div>
																		<div class="form-group">
																			<label>*Are you a U.S. military veteran? </label><br>
																			 <label class="radio-inline"><input type="radio" <?php if($val['military_veteran'] == '1'){ echo 'checked="checked"'; } ?> name="military_veteran" value="1" checked="">Yes</label> 

																			<label class="radio-inline"><input type="radio" <?php if($val['military_veteran'] == '0'){ echo 'checked="checked"'; } ?> name="military_veteran" value="0">No</label>
																		</div>
																		<div class="form-group">
																			<label>Military Status :</label>
																			<!-- <select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																				<input type="text" name="military_status" value="<?php echo $val['military_status'];?>" class="form-control">
																		</div>
																		<div class="form-group">
																			<label>*How many years of retail experience do you have?</label>
																		<!-- 	<select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																				<input type="text" name="retail_experience" value="<?php echo $val['retail_experience'];?>" class="form-control" required="">
																		</div>
																		<div class="form-group">
																			<label>*How many years of management experience do you have?</label>
																		<!-- 	<select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																			<input type="text" name="management_experience" value="<?php echo $val['management_experience'];?>" class="form-control" required="">
																		</div>
																		<div class="form-group">
																			<label>*Do you have firing or hiring experience?</label><br>
																			<label class="radio-inline"><input type="radio" name="firing_or_hiring_experience" <?php if($val['firing_or_hiring_experience'] == 1){ echo 'checked="checked"checked="checked"'; } ?> value="1" checked="">Yes</label>
																			<label class="radio-inline"><input type="radio" name="firing_or_hiring_experience" <?php if($val['firing_or_hiring_experience'] == 0){ echo 'checked="checked"'; } ?> value="0">No</label>
																		</div>
																		<div class="form-group">
																			<label>*Describe how you will operate your business :</label>
																			<textarea name="operate_your_business" class="form-control"  required=""><?php echo $val['operate_your_business'];?></textarea>
																		</div>
																		<div class="form-group">
																			<label>*Describe your experience and qualification :</label>
																			<textarea name="experience_and_qualification" class="form-control" required=""><?php echo $val['experience_and_qualification'];?></textarea>
																		</div>
																		<div class="form-group">
																			<label>*What is the maximum you are able to invest in this business opportunity? (i.e. 401K) :</label>
																		<!-- 	<select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																			<input type="text" name="business_opportunity" value="<?php echo $val['business_opportunity'];?>" class="form-control" required="">
																		</div>
																		<div class="form-group">
																			<label>*How much of the investment is liquid? (cash or checking or saving account) :</label>
																		<!-- 	<select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																					<input type="text" name="investment_is_liquid" value="<?php echo $val['investment_is_liquid'];?>" class="form-control">
																		</div>
																		<div class="form-group">
																			<label>*Are you able to dedicate full-time managing and working at the store? :</label><br>
																			<label class="radio-inline"><input type="radio" checked <?php if($val['managing_and_working'] == 1){ echo 'checked="checked"'; } ?> name="managing_and_working" value="1" checked="">Yes</label>
																			<label class="radio-inline"><input type="radio" <?php if($val['managing_and_working'] == 0){ echo 'checked="checked"'; } ?> name="managing_and_working" value="0">No</label>
																		</div>
																		<div class="form-group">
																			<label>*Area of interest :</label>
																		<!-- 	<select name="" class="form-control">
																				<option>Select</option>
																			</select> -->
																					<input type="text" name="area_of_interest" value="<?php echo $val['area_of_interest'];?>" class="form-control" required="">

																		</div>
																	
																</div>
																<div class="col-md-6">
														
																		<div class="form-group">
																			<label>*Date of Birth (mm/dd/yyyy) :</label>
																			<input type="text" name="date_of_birth" value="<?php echo $val['date_of_birth'];?>" class="form-control hasDatepicker"  required="">
																		</div>
																		<div class="form-group">
																			<label>*Have you ever  been contracted by Med ConnixApp?</label><br>
																			<label class="radio-inline"><input type="radio" <?php if($val['ontracted_by_Med_ConnixApp'] == 1){ echo 'checked="checked"'; } ?> name="ontracted_by_Med_ConnixApp" value="1" checked="">Yes</label>
																			<label class="radio-inline"><input type="radio" <?php if($val['ontracted_by_Med_ConnixApp'] == 0){ echo 'checked="checked"'; } ?> name="ontracted_by_Med_ConnixApp" value="0">No</label>
																		</div>
																		<div class="form-group">
																			<label>Address of store or store number(s) :</label>
																			<textarea name="store_number" class="form-control" ><?php echo $val['store_number'];?></textarea>
																		</div>
																		<div class="form-group">
																			<label>*Will your spouse be on  Med ConnixApp?</label><br>
																			<label class="radio-inline"><input type="radio" <?php if($val['spouse_be_on_Med_ConnixApp'] == '1'){ echo 'checked="checked"'; } ?> name="spouse_be_on_Med_ConnixApp" value="1" checked="">Yes</label>
																			<label class="radio-inline"><input type="radio" <?php if($val['spouse_be_on_Med_ConnixApp'] == '0'){ echo 'checked="checked"'; } ?> name="spouse_be_on_Med_ConnixApp" value="0">No</label>
																		</div>
																		<div class="form-group">
																			<label>Spouse First Name :</label>
																			<input type="text" name="Spouse_First_Name" class="form-control" value="<?php echo $val['Spouse_First_Name'];?>">
																		</div>
																		<div class="form-group">
																			<label>Spouse Middle Name :</label>
																			<input type="text" name="Spouse_Middle_Name" class="form-control" value="<?php echo $val['Spouse_Middle_Name'];?>">
																		</div>
																		<div class="form-group">
																			<label>Spouse Last Name :</label>
																			<input type="text" name="Spouse_Last_Name" class="form-control" value="<?php echo $val['Spouse_Last_Name'];?>">
																		</div>
																		<div class="form-group">
																			<label>*Spouse Date of Birth (mm/dd/yyyy) :</label>
																			<input type="text" name="Spouse_Date_of_Birth" value="<?php echo $val['Spouse_Date_of_Birth'];?>" class="form-control hasDatepicker" required="" id="datepicker1">
																		</div>
																	
																</div>
															</div>
														</div>
													</li>
													<li>
														<div class="signup-title green">
															Acknowledgement
														</div>
														<div class="col-md-12">
															<small>I/WE recognize that Med Connex., is not in any way obligated to franchise a Med Connex store to ME/US because of MY/OUR execution of this document. I/WE acknowledge that any false statement on this application shall be considered sufficient cause to deny any further consideration or cause revocation of any signed agreement with Med Connex.  I/WE understand that any inquiry regarding MY/OUR character, general reputation, personal characteristics, financial background and general fitness for being a Med Connex Franchisee may be made as a result of this application. In addition, by signing below I/WE release any and all former and/or present employers, and any other personal or business references, from any liability whatsoever in connection with Med Connex;s attempt to investigate MY/OUR background and determine MY/OUR fitness to become a Med Connex Franchisee.  I/WE specifically authorize Med Connex to obtain credit reports from one or more credit bureaus and background check on ME/US and MY/OUR business(es).  A copy of this authorization may be used in place of and shall be valid as the original.  I/WE understand that this application is considered active for 180 days from the date below. By submitting this application I/WE agree that this information is correct and I/WE give Med Connex., permission to obtain a Credit Report and Background Report for the individuals listed on this application. I understand and acknowledge that if I am married but do not provide complete information for myself and my spouse, 7-Eleven, Inc. cannot process this application.</small>
															<div class="form-group">
																<div class="checkbox">
																  	<label><input type="checkbox" checked="" required="">*I/WE Agree</label>
																</div>
															</div>
															<div class="form-group">
																<label>*Applicant’s Signature :</label>
																<input type="text" name="Applicant_s_Signature" class="form-control" value="<?php echo $val['Applicant_s_Signature'];?>" required="">
															</div>
														</div>
													</li>
													
												</ul>
											</div>
											</form>


										
									</div>
								</div>
							</div>
						
							
							
						</div>

					</div><br>
				
		
			</div>
		</div>  
	</div>
</div>






                                    <?php }?>
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
 </div>
       <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
     

     <script type="text/javascript">
     	$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false
       
    } );
} );
     </script>

