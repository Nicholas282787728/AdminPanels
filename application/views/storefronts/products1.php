<style>

.myclass {
    width: 20% !important;
} 
</style>

 <div id="page-wrapper">
             <div class="row">
                <div class="col-lg-3 col-md-6 myclass">
                 <a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/signupdocuments">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                <i style="color:#FF8961;" class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge">26</div> -->
                                    <div style="font-size: 12px;">Sign up <br> Document</div>
                                </div>
                            </div>
                        </div>
                             <div class="panel-footer adi-head-orange">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/promo_list">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  <i style="color:#56BDDC;" class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge">12</div> -->
                                    <div style="font-size: 12px;">Promo Codes</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                       
                    </div> </a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/payouts">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                 <i style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                     <div style="font-size: 12px;">Payout Details</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                       
                    </div> </a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   <!--  <div class="huge">13</div> -->
                                    <div style="font-size: 12px;">Complimentary Ad</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6 myclass">   
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <i style="color:#56bddc ;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   <!--  <div class="huge">13</div> -->
                                    <div style="font-size: 12px;">Pending Approvals</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                
            </div>
        
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div>
                        	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add New Product</button>
                        <div>
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Type</th>
                                        <th>Image</th>
                                        <th>Product Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($Products as $product) { 
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><?php echo $product['product_type']; ?></td>
                                        <td class="center"><img src="<?php echo $product['image']; ?>"></td>
                                        <td class="center"><?php echo $product['product_notes']; ?></td>
                                        <td><a href="editproduct?id=<?php echo $product['id'];?>" class='btn btn-primary btn-sm'>Edit</a>
                                        <form method="post">
						  					<button type="submit" class="btn btn-danger btn-sm" name="delete_product" value="<?php echo $product['id']; ?>" onClick="return confirm('Are you sure want to Delete?');">Delete</button>
                                        </form>
                                    </tr>
                                <?php } ?> 
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div>
                        	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add New Product</button>
                        <div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            
            
</div>






<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	

<form method="post" role="form" name="product_form" id="product_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>panels/supermacdaddy/Storefronts/products">
	  <div class="panel-body">
        <div class="row">
	<div class="col-md-6">
		<div class="form-group">
            <label>Product Name</label>
            <input class="form-control" name="product_name" placeholder="Enter product name" required="required">
    	</div>
        <div class="form-group">
            <label>Product Category</label>
            <select class="form-control" name="product_category" id="product_category" required="required">
                <option>--Choose One--</option>
                <?php  foreach($main_categories as $single) {
                echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 } ?>
                                                
            </select>
        </div> 
        <div class="form-group">
            <label>Product Sub-Category</label>
            <select class="form-control" name="product_sub_category" id="product_sub_category" required="required">
               
            </select>
         </div> 
         <div class="form-group">
             <label>Preparation Time in Hours</label>
             <input class="form-control" type="number" name="preparation_time" placeholder="Enter preparation time" required="required">
         </div>
         <div class="form-group">
         	<label>Tax/Patients</label>
            <input class="form-control" name="tax_patients" placeholder="Enter tax patients" required="required">
         </div>
         <div class="form-group">
            <label>Happy Hour</label>
            <input class="form-control" type="number" name="happy_hour" placeholder="Enter happy hour" required="required">
         </div>
	
	</div>
	 
	<div class="col-md-6">
		<div class="form-group">
            <label>1G</label>
            <input class="form-control" type="number" name="k1" placeholder="Enter k1" required="required">
        </div>
        <div class="form-group">
            <label>2G</label>
            <input class="form-control" type="number" name="k2" placeholder="Enter k2" required="required">
        </div> 
                                        
        <div class="form-group">
            <label>1/8</label>
            <input class="form-control" type="number" name="k3" placeholder="Enter k3" required="required">
        </div>
        <div class="form-group">
            <label>1/4</label>
            <input class="form-control" type="number" name="k4" placeholder="Enter k4" required="required">
        </div>
        <div class="form-group">
            <label>1/2</label>
            <input class="form-control" type="number" name="k5" placeholder="Enter k5" required="required">
        </div>
        <div class="form-group">
            <label>OZ</label>
            <input class="form-control" type="number" name="k6" placeholder="Enter k6" required="required">
        </div>
		<div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="product_notes" rows="3" placeholder="Enter description" required="required"></textarea>
        </div>
    	<div class="form-group">
            <label>Upload Logo</label>
            <input type="file" name="image">
            </div> 
	</div>
	
</div>

</div>
        <input type="submit" class="btn btn-success" name="save_product" value="Save changes" />
</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div> 
</div>



