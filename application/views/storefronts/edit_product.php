<div id="page-wrapper">
             <div class="row">

<form method="post" role="form" name="product_form" id="product_form" enctype="multipart/form-data">
	  <div class="panel-body">
        <div class="row">
	<div class="col-md-6">
		<div class="form-group">
            <label>Product Name</label>
            <input class="form-control" name="product_name" placeholder="Enter product name" required="required" value="<?php echo $product_details['product_name']; ?>">
    	</div>
        <div class="form-group">
            <label>Product Category</label>
            <select class="form-control" name="product_category" id="product_category" required="required" value="<?php echo $product_details['product_category']; ?>">
                <option>--Choose One--</option>
                <?php  foreach($main_categories as $single) {
                echo ' <option value="'.$single['id'].'">'.$single['name'].'</option>';
                 } ?>
                                                
            </select>
        </div> 
        <div class="form-group">
            <label>Product Sub-Category</label>
            <select class="form-control" name="product_sub_category" id="product_sub_category" required="required" value="<?php echo $product_details['product_sub_category']; ?>">
                <option>--Choose One--</option>
                <?php  foreach($sub_categories as $sub) {
                echo ' <option value="'.$sub['main_category_id'].'">'.$sub['subcategory_name'].'</option>';
                 } ?>
            </select>
         </div>
         <div class="form-group">
             <label>Preparation Time in Hours</label>
             <input class="form-control" type="number" name="preparation_time" placeholder="Enter preparation time" required="required" value="<?php echo $product_details['preparation_time']; ?>">
         </div>
         <div class="form-group">
         	<label>Tax/Patients</label>
            <input class="form-control" name="tax_patients" placeholder="Enter tax patients" required="required" value="<?php echo $product_details['tax_patients']; ?>">
         </div>
         <div class="form-group">
            <label>Happy Hour</label>
            <input class="form-control" type="number" name="happy_hour" placeholder="Enter happy hour" required="required" value="<?php echo $product_details['happy_hour']; ?>">
         </div>
	
	</div>
	 
	<div class="col-md-6">
		<div class="form-group">
            <label>1G</label>
            <input class="form-control" type="number" name="k1" placeholder="Enter k1" required="required" value="<?php echo $price_details['k1']; ?>">
        </div>
        <div class="form-group">
            <label>2G</label>
            <input class="form-control" type="number" name="k2" placeholder="Enter k2" required="required" value="<?php echo $price_details['k2']; ?>">
        </div> 
                                        
        <div class="form-group">
            <label>1/8</label>
            <input class="form-control" type="number" name="k3" placeholder="Enter k3" required="required" value="<?php echo $price_details['k3']; ?>">
        </div>
        <div class="form-group">
            <label>1/4</label>
            <input class="form-control" type="number" name="k4" placeholder="Enter k4" required="required" value="<?php echo $price_details['k4']; ?>">
        </div>
        <div class="form-group">
            <label>1/2</label>
            <input class="form-control" type="number" name="k5" placeholder="Enter k5" required="required" value="<?php echo $price_details['k5']; ?>">
        </div>
        <div class="form-group">
            <label>OZ</label>
            <input class="form-control" type="number" name="k6" placeholder="Enter k6" required="required" value="<?php echo $price_details['k6']; ?>">
        </div>
		<div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="product_notes" rows="3" placeholder="Enter description" required="required" value="<?php echo $product_details['product_notes']; ?>"></textarea>
        </div>
    	<div class="form-group">
            <label>Upload Logo</label>
            <input type="file" name="image" value="<?php echo $product_details['image']; ?>">
            </div> 
	</div>
	
</div>

</div>
        <input type="submit" class="btn btn-success" name="update_product" value="Update" />
        </form>
</div>

</div>