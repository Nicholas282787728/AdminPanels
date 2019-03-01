<div id="page-wrapper" >
    <?php $this->load->view('partner/new-sidebar'); ?>
         <div class="row">
            <div class="col-lg-12">  <!-- <h1 class="page-header">Products</h1> -->
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
        </div>
       </div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Products</p>
                </div> <!-- /.panel-heading -->
                <div class="panel-body">
                    <div>
                        <button type="button" class="btn-green" data-toggle="modal" data-target="#exampleModalAdd">Add New Product</button>
                        <div><br>
                            <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="dataTables-example">
                                <thead>
                                    <tr class="first-row">
										<th>S.No</th>
										<th>Image</th>
                                        <th>Product Name</th>
										<th>Type</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Notes</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
										// echo "<pre>"; print_r($products); 
          //                               exit;
										$i = 1;
										foreach($products as $sale)
										{
                                            $imagUrl=base_url('uploads/'.$sale['image']);
									?>
                                    <tr class="odd gradeX">
										<td><?php echo $i; ?></td>
										<td><img src="<?php  echo $imagUrl; ?>" width="200px" height="200px"></td> 
                                        <td><?php echo $sale['product_name']; ?></td>
										<td><?php echo $sale['product_type']; ?></td>
                                        <td><?php echo $sale['main']; ?></td>                                        
                                       <td><?php
                                            echo $sale['sub'];
                                         ?></td> 
										<td><?php echo $sale['product_notes']; ?></td> 
									 
										
										
										<td class="center"><form method="post">
										<?php
										if($sale['status'] == 0){
											echo '<div class="btn-group">  
												
													<button type="submit" name="" value="'.$sale['id'].'" class="btn btn-warning dropdown-toggle js-location-create" data-toggle="dropdown">
												Deactivated
												 <span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													<li>
														<form method="post">
														<button type="submit" name="deactive" value="'.$sale['id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-bolt"></i> Activate Product
														</a>
														</form>
													</li>
													
													<li>
														<a href="javascript:void(0);" data-id="'.$sale['id'].'" class="js-user-edit">
														<i class="fa fa-edit"></i> Edit 
														
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_product" value="'.$sale['id'].'"  class="js-user-delete" >
														<i class="fa fa-trash-o"></i> Delete </button>
														</form>
													</li>
												</ul>
												</div>';
										}else{
											echo '<div class="btn-group">
											
												<button type="submit" name=""  value="'.$sale['id'].'" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
															Active
												<span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													 <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$sale['id'].'"  class="js-user-disable">
														<i class="fa fa-minus-circle"></i>  Disable Product
														</button>
														</form>
														
													</li> 
													<li>
                                                        <a href="javascript:void(0);" data-id="'.$sale['id'].'" class="js-user-edit">
                                                        <i class="fa fa-edit"></i> Edit 
                                                        
                                                    </li>
													
													   
                                                    <li>
                                                        <form action="" method="post">
                                                        <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_product" value="'.$sale['id'].'"  class="js-user-delete" >
                                                        <i class="fa fa-trash-o"></i> Delete </button>
                                                        </form>
                                                    </li>
												</ul>
											</div>';
										}
									 ?>
											</form>
										</td>

									</tr>
                                   <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
							<div>
								<button type="button" class="btn-green" data-toggle="modal" data-target="#exampleModalAdd">Add New Product</button>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
<!-- 
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Products</p>
                  
                </div> <!~~ /.panel-heading ~~>
                <div class="panel-body">
                  
                    <table width="100%" class="table table-striped table-bordered table-hover custom-table table-responsive" id="dataTables-example">
                        <thead>
                            <tr class="first-row">
                                <th>Product Name</th>
                                <th>MRP</th>
                                <th>Location</th>
                                <th>Status</th>  
								<th>Last Modified</th> 
								<th>Modified By</th> 
								<th>Actions</th> 								
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                
                            </tr>
                            <tr class="odd gradeX">
                                
                            </tr>
                            <tr class="odd gradeX">
                                
                            </tr>
                        </tbody>
                    </table> <!~~ /.table-responsive ~~>
                    <div id="table-users-pager" class="pager pager-lg tablesorter-pager">
    				    <div class="pagination-wrap">
        					
        			</div>
                    
                </div><!~~ /.panel-body ~~>
             </div><!~~ /.panel ~~>
        </div><!~~ /.col-lg-12 ~~>
    </div><!~~ /.row ~~>
</div>
 --><!--/.page wrapper-->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">

                    <!-- /.panel -->
 
                    <!-- /.panel -->
                  
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                   
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
                   
                      
                        <!-- /.panel-heading -->
                        
                        <!-- /.panel-body -->
<!-- ~~~~~~ add product modal ~~~~~~~~- -->
<div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="addProduct" method="post" action="<?php echo base_url('panels/supermacdaddy/ondemand/products'); ?>" enctype='multipart/form-data'>
    <div id="form-alerts">
    </div>
    <div class="row">
    	
    	
        <div class="col-sm-6">
            <div class="form-group">
                <label>Product Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="product_name" autocomplete="off" value="" placeholder="Please enter the Product Name" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Product Category </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select  class="form-control mainCategoryChange" name="product_category" title="Locale" required="required" >
                     	<option>--Choose One--</option>
               				 <?php  foreach($main_categories as $single) {
                				echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 			} ?>
                     </select>
                </div>
            </div>
        </div>
        
         <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select id="input_locale" class="form-control product_sub_category" name="product_sub_category" title="Locale" required="required">
                    	<option>--Choose One--</option>
            			
					</select>
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Minutes </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <!--<input class="form-control" name="preparation_time" autocomplete="off" placeholder="Enter Preparation Time" type="text" required="required">-->
					 <select name="preparation_time" class="form-control " required="required">
						<option value="10">10 mins</option>
						<option value="20">20 mins</option>
						<option value="30">30 mins</option>
						<option value="60">60 mins</option>
					</select>
                    <span class="input-group-addon"><a href="javascript:void(0);" data-toggle="tooltip" title="Preparation Time in Minutes!"><img src="<?php echo base_url('uploads/info.png');?>" style=" width: 20px;"></a></span> 
                </div>
            </div>
        </div>
                             
<!--        <div class="col-sm-6">
            <div class="form-group ">
                <label>Tax/Patients</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="tax_patients" autocomplete="off" value="" placeholder="Enter Tax/Patients" type="text" required="required">
                    <span class="input-group-addon"><a href="javascript:void(0);" data-toggle="tooltip" title="Tax/Patients"><img src="<?php echo base_url('uploads/info.png');?>" style=" width: 20px;"></a></span> 
                </div>
            </div>
        </div>-->

		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Amount &amp; Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="amt_d_price" autocomplete="off" placeholder="Amount & Price" type="text" >
                </div>
            </div>
        </div>
                             
      <div class="col-sm-6">
			 <label>Happy Hour</label>
			 <div class="form-check">
				<label class="form-check-label">
					<input  name="happy_hour" id="" class="happu_hour" type="checkbox" value="0">
					Happy Hour specials
				</label>
			  </div>
        </div>
        
        	<div class="col-sm-12 display_hidden" style="padding: 0px;display:none;">
				
				<div class="col-sm-6">
					 <label>Day </label>
					<div class="form-group ">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<select name="happy_day" class="form-control display_disabled" style="width:100%" disabled="">
							   <option value="Monday">Monday</option>
							   <option value="Tuesday">Tuesday</option>
							   <option value="Wednesday">Wednesday</option>
							   <option value="Thursday">Thursday</option>
							   <option value="Friday">Friday</option>
							   <option value="Saturday">Saturday</option>
							   <option value="Sunday">Sunday</option>
						   </select>
					   </div>
				   </div>
			   </div>
				<div class="col-sm-6">
					<div class="col-sm-6" style="padding-left:0px;">
						<label>To</label>
						<input class="form-control display_disabled" name="happy_time_to" type="time" required="" disabled="">
					</div>
					<div class="col-sm-6" style="padding-right:0px;">
						<label>From</label>
						<input class="form-control display_disabled" name="happy_time_from" type="time" required="" disabled="">
					</div>
					
			   </div>
				
				
			</div>
        
	<div class="col-sm-12 " style="padding: 0px;">
      
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" autocomplete="off" placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
<!--        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k2" autocomplete="off" placeholder="Enter k2" type="text" required="required">
                </div>
            </div>
        </div>-->
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" autocomplete="off" placeholder="Enter k3" type="text"  required="required">
               </div>
            </div>
        </div>
<!--		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/4</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k4" autocomplete="off" placeholder="Enter k4" type="text" required="required">
                </div>
            </div>
        </div>-->
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" autocomplete="off" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
<!--        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">OG</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k6" autocomplete="off" placeholder="Enter k6" type="text" required="required">
                </div>
            </div>
        </div>-->
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <!--<input class="form-control" maxlength="250"  id="textarea" name="product_notes" autocomplete="off" placeholder="Enter description" type="text" required="required">-->
					
					<textarea class="form-control" name="product_notes" maxlength="250"  id="textarea"> </textarea>
					
                </div>
				<div id="textarea_feedback"></div>
            </div>
        </div>




         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control get_image" name="image" id="get_image" autocomplete="off" type="file" required="required">
			    </div>
                    <span class="docurl"></span>
				<img src="" id="myImg" style="max-width:100px;max-height:100px;"/>
            </div>
        </div>

       
	</div>    
            </div><br>
           <div class="modal-footer">
    		<div class="row">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="save_product" class="btn-green">Create Product</button>
                		</div>          
            		</div>
             	<div class="">
                	<div class="vert-pad">
                    	<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                	</div>
            	</div>
            </div>
            </div>
    </div>
</form>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>-->
  </div>
</div>  

</div>
</div> 

<!-- edit product modal  -->

<div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update User</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="user" method="post" action="<?php echo base_url('panels/supermacdaddy/ondemand/products'); ?>" enctype='multipart/form-data'>
    <div id="form-alerts">
    </div>
   <div class="row">
    	<div class="updatepros">
    	
  
        </div>                
            </div><br>  
           <div class="modal-footer">
    		<div class="row">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="update" class="btn-green">Update Product</button>
                		</div>          
            		</div>
             	<div class="">
                	<div class="vert-pad">
                    	<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                	</div>
            	</div>
            </div>
            </div>
    </div>
</form>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>-->
  </div>
</div>  

</div>
</div> 



<script>
	
		
$('form').delegate(".happu_hour","change",function(){
	if($(this).is(':checked')) {
		$(this).val('1');
		$('.display_disabled').prop( "disabled", false );
		
		$('.display_hidden').show();
	}
	else
	{
		$(this).val('0');
		$('.display_disabled').prop( "disabled", true );
		$('.display_hidden').hide();
	}
	
	
})
	
	
	$(document).ready(function() {
		
		$("#get_image").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoaded(e) {
              var dataImage= $('#get_image').prop('files')[0];
              var fileName = dataImage.name;
              var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
              var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
               if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurl').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                $('#myImg').attr('src', '');
                }else{
                   $('#myImg').attr('src', e.target.result);
                   $('.docurl').html('');
               }
			
		};
		$("#editproduct").delegate("#edit_get_image","change",function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = imageIsLoadededit;
				reader.readAsDataURL(this.files[0]);
			}
		});
		function imageIsLoadededit(e) {
			$('#edit_image').attr('src', e.target.result);

              var dataImage= $('#edit_get_image').prop('files')[0];
              var fileName = dataImage.name;
              var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
              var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
               if ($.inArray(fileNameExt, validExtensions) == -1) {
                $('.docurlImage').html('<a href="' + e.target.result + '" target="_blank">' +dataImage.name + '</a>');
                  $('#edit_image').css('display', "none");
                }else{
                   $('#edit_image').css('display', "block");
                   $('#edit_image').attr('src', e.target.result);
                   $('.docurlImage').html('');
               }


		};
		
		
		var text_max = 250;
		$('#textarea_feedback').html(text_max + ' characters remaining');

		$('#textarea').keyup(function() {
			maxlength();
		});

		maxlength();
		function maxlength()
		{
			var text_length = $('#textarea').val().length;
			var text_remaining = text_max - text_length;

			$('#textarea_feedback').html(text_remaining + ' characters remaining');
		}
	});
	
	
	
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
  $(document).on('change', '.mainCategoryChange' ,function() {
//$( ".mainCategoryChange" ).change(function() {
  var data=$('.mainCategoryChange').val();
  //alert(data);
     $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/getsubCategory",
            data: {
                id:data
            },
            success: function(response)
            {
                //$(".mainCategoryChange").attr('selected','');

                 $('select[name="product_sub_category"]').html(response);
                 //$('.subc').html(response);

            // $('.productSubCategory').html(response);
          
       
          
            } 
     
        });
   
});
   $(document).on('change', '.mainCategoryChanges' ,function() {
//$( ".mainCategoryChange" ).change(function() {
  var data=$('.mainCategoryChanges').val();
  //alert(data);
     $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/getsubCategory",
            data: {
                id:data
            },
            success: function(response)
            {
                //$(".mainCategoryChange").attr('selected','');

                 $('select[name="product_sub_category"]').html(response);
                 //$('.subc').html(response);

            // $('.productSubCategory').html(response);
          
       
          
            } 
     
        });
   
});

</script>
