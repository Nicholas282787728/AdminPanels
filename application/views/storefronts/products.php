<div id="page-wrapper" >
        <?php $this->load->view('storefronts_templates/new-sidebar'); ?>
        
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Products</p>
                </div> <!-- /.panel-heading -->
                <div class="panel-body">
                    <div>
                        <button type="button" class="btn-green" data-toggle="modal" data-target="#exampleModalAdd">Add New Product</button>
						<button type="button" class="btn-green" id="upload" data-toggle="modal" data-target="#Modalbulk">Upload Bulk Product</button>
                        <div><br>
                            <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="first-row">
										<!-- <th>S.No</th>
										<th>Image</th>
                                        <th>Product Name</th>
										<th>Type</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Notes</th> -->
                                       <!-- 
 <th>K1</th>
                                        <th>K2</th>
                                        <th>K3</th>
                                        <th>K4</th>
                                        <th>K5</th>
                                        <th>K6</th>
 -->
                                        <!-- <th>Actions</th> -->
                                     <!--    <th>S.No</th> -->
                                      <!--   <th>Provider Type</th> -->
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Happy hour</th>
                                        <th>Product Price</th>
                                        <th>Category</th>
                                       <!--  <th>Sub Category</th> -->
                                        <th>Product Info</th>
                                        <th>Prep Time</th>
                                 <!--        <th>Email</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                   <?php 
									// echo "<pre>"; print_r($products);
         //                            die();
										$i = 1;
										foreach($products as $sale)
										{  
                                            $imagUrl=$sale['image_url'];
									?>
                                    <tr class="odd gradeX">
										<!-- <td><?php echo $i; ?></td> -->
                                    <!--     <td><?php echo $sale['product_type']; ?></td> -->
									<!-- 	<td><img src="https://medconnex.net/demonil/uploads/<?php  echo $sale['image']; ?>" width="150px" height="150px"></td>  -->
                                    <td><img src="<?php  echo $sale['image_url']; ?>" width="150px" height="150px"></td>
                                        <td><?php echo $sale['product_name']; ?></td>
                                        <td><?php echo $sale['happy_hour']; ?></td>
										<td><?php echo $sale['amt_d_price']; ?></td>


                                        <?php   $query = $this->db->query('SELECT name FROM `uf_categories` WHERE  id = "' . $sale['product_category'] . '" ');
        $resultarrayCategory = $query->result();
      
       ?>
                                        <td><?php echo $resultarrayCategory[0]->name; ?></td>
                                    <!--    <td><?php echo $sale['product_sub_category']; ?></td>  -->
                                        <td><?php echo $sale['product_notes']; ?></td> 
                                        
										<td><?php echo $sale['preparation_time']; ?></td> 
                                   <!--       <td><?php echo $sale['user_id']; ?></td> -->
									 
										
										
										<td class="center"><form method="post">
										<?php
										if($sale['status'] == 0){
											echo '<div class="btn-group">  
												
													<button type="submit" name="" value="'.$sale['id'].'" class="btn btn-warning dropdown-toggle js-location-create" data-toggle="dropdown">
												Disable
												 <span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													<li>
														<form method="post">
														<button type="submit" name="deactive" value="'.$sale['id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-bolt"></i> Enable
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
															Enable
												<span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													 <li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$sale['id'].'"  class="js-user-disable">
														<i class="fa fa-minus-circle"></i>  Disable 
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
						
<div class="modal fade" id="Modalbulk" tabindex="-1" role="dialog" aria-labelledby="Modalbulk" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Upload Bulk Product</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form method="post" action="<?=base_url()?>panels/supermacdaddy/storefronts/bulk" enctype='multipart/form-data'>
			<div id="form-alerts">
			</div>
			<div class="row">
				<div class="">

				<div class="col-sm-6">
					<div class="form-group">
						<label>Upload File</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="image" type="file" required/>
						</div>
					</div>
				</div>
			</div>
			</div>
			<a href="<?=base_url()?>public/sales-design/assets/bulk_pro.xlsx">Download Sample File</a>
			<br>
			 <div class="modal-footer">
			  <div class="row">
				  <div class="creatUserBottom">
					  <div class="">
						  <div class="vert-pad">
							  <input type="submit" name="upload_product" class="btn-green" value="Upload">
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
		
		</div>
	</div>
</div>  

</div>
</div> 						
						
<div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="Modalbulk" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add bulk Product</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="addbulkProduct" method="post" action="" enctype='multipart/form-data'>
    <div id="form-alerts">
    </div>
    <div class="row">
    	<div class="">
    <!-- 	
        <div class="col-sm-6">
            <div class="form-group">
                <label>Upload File</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="upload_file" type="file" required="required">
                </div>
            </div>
        </div> -->
          <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="image" autocomplete="off" type="file" required="required">
                </div>
            </div>
        </div>

		<div class="col-sm-6">
            <div class="form-group ">
              <label>Product Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                      <input class="form-control" name="product_name"  placeholder="Enter Product name" type="text" required="required">
                </div>
            </div>
        </div>
			
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Product Category </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					<select id="input_locale" class="form-control mainCategoryChanges" name="product_category" title="Locale" required="required">
								<option>--Choose One--</option>
               				 <?php  foreach($main_categories as $single) {
                				echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 			} ?>
                     </select>
                </div>
            </div>
        </div>
        
	<!-- 	<div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					 <select id="input_locale" class="form-control product_sub_category" name="product_sub_category" title="Locale" required="required">
                    	<option>--Choose One--</option>
					</select>
                </div>
            </div>
        </div> -->
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <!--<input class="form-control" name="preparation_time" autocomplete="off" placeholder="Enter Preparation Time" type="text" required="required">-->
					 <select name="preparation_time" class="form-control " required="required">
						<option value="10">10 mins</option>
						<option value="20">20 mins</option>
						<option value="30">30 mins</option>
						<option value="60">60 mins</option>
					</select>
                </div>
            </div>
        </div>
              <div class="amountPriceDiv">          
        <div class="col-sm-6">
            <div class="form-group ">
              <label>Individual Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                      <input class="form-control amountPrice" name="amt_d_price"  placeholder="Enter Amont" type="text" >
                </div>
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
     <!--    <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" autocomplete="off" placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" autocomplete="off" placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
	
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" autocomplete="off" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
       
        -->
        <div class="gramsSection">
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k1" name="k1" autocomplete="off" placeholder="10$" type="text" >
                </div>
            </div>
        </div>
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2g's</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k2" name="k2" autocomplete="off" placeholder="30$" type="text" >
                </div>
            </div>
        </div>
    
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">3.5g's</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k3" name="k3" autocomplete="off" placeholder="45$" type="text" >
                </div>
            </div>
        </div>

         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">7g's</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k4" name="k4" autocomplete="off" placeholder="60$" type="text" >
                </div>
            </div>
        </div>


         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">14g's</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k5" name="k5" autocomplete="off" placeholder="100$" type="text" >
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1oz</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control k6" name="k6" autocomplete="off" placeholder="180$" type="text" r>
                </div>
            </div>
        </div>

      </div> 
                  <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" autocomplete="off" placeholder="Enter description" type="text" >
                </div>
            </div>
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
      		
        <form name="addProduct" method="post" action="" enctype='multipart/form-data'>
    <div id="form-alerts">
    </div>
    <div class="row">
    	<div class="">
    	
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
					<select id="input_locale" class="form-control mainCategoryChanges" name="product_category" title="Locale" required="required">
								<option>--Choose One--</option>
               				 <?php  foreach($main_categories as $single) {
                				echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 			} ?>
                     </select>
                </div>
            </div>
        </div>
        
        <!--  <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					 <select id="input_locale" class="form-control product_sub_category" name="product_sub_category" title="Locale" required="required">
                    	<option>--Choose One--</option>
            			
					</select>
                </div>
            </div>
        </div>    -->            
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <!--<input class="form-control" name="preparation_time" autocomplete="off" placeholder="Enter Preparation Time" type="text" required="required">-->
					 <select name="preparation_time" class="form-control " required="required">
						<option value="10">10 mins</option>
						<option value="20">20 mins</option>
						<option value="30">30 mins</option>
						<option value="60">60 mins</option>
					</select>
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
              <label>Individual Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                      <input class="form-control" name="amt_d_price"  placeholder="Enter Amont" type="text" required="required">
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
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" autocomplete="off" placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
	
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" autocomplete="off" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
       
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" autocomplete="off" placeholder="Enter description" type="text" required="required">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="image" autocomplete="off" type="file" required="required">
                </div>
            </div>
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
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="user" method="post" action="" enctype='multipart/form-data'>
    <div id="form-alerts">
    </div>
   <div class="row">
    	<div class="updatepro">
    	
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
                     <select id="input_locale" class="form-control" name="product_category" title="Locale" required="required">
                
                <?php  foreach($main_categories as $single) {
                echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 } ?>
                            
                     </select>
                </div>
            </div>
        </div>
        
      <!--    <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select id="input_locale" class="form-control" name="product_sub_category" title="Locale" required="required">
                    	
					</select>
					
				                 
                </div>
            </div>
        </div>   -->             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="preparation_time" placeholder="Enter Preparation Time" type="text" required="required">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Tax/Patients</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="tax_patients" value="" placeholder="Enter Tax/Patients" type="text" required="required">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Happy Hour</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="happy_hour" placeholder="Enter happy_hour" type="text" required="required">
                </div>  
            </div>
        </div>
    
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" placeholder="Enter k1" type="text" >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k2" placeholder="Enter k2" type="text" >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" placeholder="Enter k3" type="text" >
                </div>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/4</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k4" placeholder="Enter k4" type="text" >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" placeholder="Enter k5" type="text" >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">OG</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k6" placeholder="Enter k6" type="text" >
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" placeholder="Enter description" type="text" >
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="image" type="file" required="required">
                </div>
            </div>
        </div>
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


   $('form').delegate('.mainCategoryChanges', 'change' ,function() {
	  
	  var data=$(this).val();
		 $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/storefronts/getsubCategory",
            data: {
                id:data
            },
            success: function(response)
            {
                 $('select[name="product_sub_category"]').html(response);
            } 
     
        });
   
});

</script>

<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
  $(".amountPrice").keyup(function(){
            var data = $('.amountPrice').val();
            if(data.length != ''){
         
            $('.gramsSection').css('display','none');
            }
            else{
                $('.gramsSection').css('display','block');
            }
        });
});

$(document).ready(function(){
  $(".k1").keyup(function(){
            var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });

});

$(document).ready(function(){
  $(".k2").keyup(function(){
           var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });
});
$(document).ready(function(){
  $(".k3").keyup(function(){
        var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });
});

$(document).ready(function(){
  $(".k4").keyup(function(){
          var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });
});

$(document).ready(function(){
  $(".k5").keyup(function(){
           var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });
});

$(document).ready(function(){
  $(".k6").keyup(function(){
           var k1 = $('.k1').val();
            var k2 = $('.k2').val();
            var k3 = $('.k3').val();
            var k4 = $('.k4').val();
            var k5 = $('.k5').val();
            var k6 = $('.k6').val();
            if((k1.length != '') || (k2.length != '') || (k3.length != '') || (k4.length != '') || (k5.length != '') || (k6.length != '')){
         
            $('.amountPriceDiv').css('display','none');
            }
            else{
                $('.amountPriceDiv').css('display','block');
            }
        });
});
</script>