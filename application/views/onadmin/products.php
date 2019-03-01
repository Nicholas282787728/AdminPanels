<div id="page-wrapper">
          
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
              <!-- 
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Products</h1>
                </div>
                <!~~ /.col-lg-12 ~~>
            </div>
 -->
            <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products
                </div>
                <div class="panel-body">
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add New Product</button>
                        <div><br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
										<th>Image</th>
                                        <th>Product Name</th>
										<th>Type</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Notes</th>
                                       <!-- 
 <th>K1</th>
                                        <th>K2</th>
                                        <th>K3</th>
                                        <th>K4</th>
                                        <th>K5</th>
                                        <th>K6</th>
 -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
										//echo "<pre>"; print_r($Sales); 
										$i = 1;
										foreach($products as $sale)
										{
									?>
                                    <tr class="odd gradeX">
										<td><?php echo $i; ?></td>
										<td><img src="<?php  echo $sale['image']; ?>" width="50px" height="50px"></td> 
                                        <td><?php echo $sale['product_name']; ?></td>
										<td><?php echo $sale['product_type']; ?></td>
                                        <td><?php if($sale['product_category'] == "1"){
											echo 'Sativa';
										}elseif($sale['product_category'] == "2"){
											echo 'Indica';
										}elseif($sale['product_category'] == "3"){
											echo 'Hybrid';
										} ?></td>                                        
                                       <td><?php if($sale['product_sub_category'] == "1"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "2"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "3"){
											echo 'Flowers';
										}elseif($sale['product_sub_category'] == "4"){
											echo 'Candy';
										}elseif($sale['product_sub_category'] == "5"){
											echo 'Edibles';
										}elseif($sale['product_sub_category'] == "6"){
											echo 'Beverages';
										}elseif($sale['product_sub_category'] == "7"){
											echo 'Chips';
										}elseif($sale['product_sub_category'] == "8"){
											echo 'Flowers';
										}elseif($sale['product_sub_category'] == "9"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "10"){
											echo 'Vape Pens';
										}elseif($sale['product_sub_category'] == "11"){
											echo 'Beverages';
										} ?></td> 
										<td><?php echo $sale['product_notes']; ?></td> 
										<!-- 
<td><?php echo $sale['k1']; ?></td> 
										<td><?php echo $sale['k2']; ?></td> 
										<td><?php echo $sale['k3']; ?></td>  
										<td><?php echo $sale['k4']; ?></td> 
										<td><?php echo $sale['k5']; ?></td> 
										<td><?php echo $sale['k6']; ?></td> 
 -->
										
										
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
														<a href="#" data-id="'.$sale['id'].'" class="js-user-edit">
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
														<form action="" method="post">
														<a href="#" data-id="'.$sale['id'].'" class="js-user-edit"  data-toggle="modal">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the product \');" type="submit" name="delete_staff" value="'.$sale['id'].'"  class="js-user-delete" >
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
							<div>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add New Product</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="add_product" method="post" action="" enctype='multipart/form-data'>
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
                     <select id="input_locale" class="form-control" name="product_category" title="Locale" required="required"
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
                    <select id="input_locale" class="form-control" name="product_sub_category" title="Locale" required="required">
                    	<option>--Choose One--</option>
                    	<option value="Cookies">Cookies</option>
            			<option value="Cookies">Cookies</option>
            			<option value="Flowers">Flowers</option>
            			<option value="Candy">Candy</option>
            			<option value="Edibles">Edibles</option>
            			<option value="Beverages">Beverages</option>
						<option value="Chips">Chips</option>
						<option value="Flowers">Flowers</option>
						<option value="Cookies">Cookies</option>
						<option value="Vape Pens">Vape Pens</option>
						<option value="Beverages">Beverages</option>
					</select>
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="preparation_time" autocomplete="off" placeholder="Enter Preparation Time" type="text" required="required">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Tax/Patients</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="tax_patients" autocomplete="off" value="" placeholder="Enter Tax/Patients" type="text" required="required">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Happy Hour</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" autocomplete="off" name="happy_hour" placeholder="Enter happy_hour" type="text" required="required">
                </div>  
            </div>
        </div>
        
        
        
         </div>     
      
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" autocomplete="off"placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k2" autocomplete="off"placeholder="Enter k2" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" autocomplete="off"placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/4</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k4" autocomplete="off"placeholder="Enter k4" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" autocomplete="off"placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">OG</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k6" autocomplete="off"placeholder="Enter k6" type="text" required="required">
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
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create User</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="user" method="post">
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
        
         <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select id="input_locale" class="form-control" name="product_sub_category" title="Locale" required="required">
                    	<option>--Choose One--</option>
                    	<option value="Cookies">Cookies</option>  
            			<option value="Cookies">Cookies</option>
            			<option value="Flowers">Flowers</option> 
            			<option value="Candy">Candy</option>
            			<option value="Edibles">Edibles</option>
            			<option value="Beverages">Beverages</option>
						<option value="Chips">Chips</option>
						<option value="Flowers">Flowers</option>
						<option value="Cookies">Cookies</option>
						<option value="Vape Pens">Vape Pens</option>
						<option value="Beverages">Beverages</option>
					</select>
					
				                  <!-- 
         
                                       <?php if($sale['product_sub_category'] == "1"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "2"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "3"){
											echo 'Flowers';
										}elseif($sale['product_sub_category'] == "4"){
											echo 'Candy';
										}elseif($sale['product_sub_category'] == "5"){
											echo 'Edibles';
										}elseif($sale['product_sub_category'] == "6"){
											echo 'Beverages';
										}elseif($sale['product_sub_category'] == "7"){
											echo 'Chips';
										}elseif($sale['product_sub_category'] == "8"){
											echo 'Flowers';
										}elseif($sale['product_sub_category'] == "9"){
											echo 'Cookies';
										}elseif($sale['product_sub_category'] == "10"){
											echo 'Vape Pens';
										}elseif($sale['product_sub_category'] == "11"){
											echo 'Beverages';
										} ?>
					
 -->
                </div>
            </div>
        </div>               
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
                    <input class="form-control" name="k1" placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k2" placeholder="Enter k2" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/4</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k4" placeholder="Enter k4" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">OG</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k6" placeholder="Enter k6" type="text" required="required">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" placeholder="Enter description" type="text" required="required">
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
