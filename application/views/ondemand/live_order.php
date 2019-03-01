<div id="page-wrapper" >
        <?php $this->load->view('ondemand/new-sidebar'); ?>
        
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Live Orders</p>
                </div> <!-- /.panel-heading -->
                <div class="panel-body">
                    <div>
                     <!--    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalAdd">Add New Product</button> -->
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="first-row">
										<!-- <th>S.No</th>
										<th>Image of Product</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Special Request</th>
                                    
                                        <th>Zip Code</th>
                                        <th>Total Price</th>
                                        <th>Actions</th> -->
                                         <!--   <th>S.No</th> -->
                                        <th>Date & Time</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                     <!--    <th>Sub-Category</th> -->
                                        <th>Special Request</th>
                                        <th>Prep Time</th>
                                     <!--    <th>Quantity</th> -->
                                        <th>Zip Code</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
										
										$i = 1;
										foreach($products as $sale)
										{
                                          //$imagUrl=base_url('uploads/'.$sale['image']);
                                            $imagUrl= $sale['image_url'];
									 ?>
                                    <tr class="odd gradeX">
								<!-- 		<td><?php echo $i; ?></td> -->
                                        <td><?php echo $sale['created_date']; ?></td>
										<td><img src="<?php  echo $imagUrl; ?>" width="200px" height="200px"></td> 
                                        <td><?php echo $sale['product_name']; ?></td>
										
                                        <td><?php echo $sale['main']; ?></td>                                        
                                  <!--      <td><?php
                                            echo $sale['sub'];
                                         ?></td>  -->
                                         <td><?php echo $sale['delivery_info']; ?></td>
                                          <td><?php echo $sale['preparation_time']; ?></td>
                                         <!-- <td><?php echo $sale['quantity']; ?></td> -->
                                         <td><?php echo $sale['product_type']; ?></td>
                                         <td><?php echo $sale['price']; ?></td>
										<td class="center">
                                            <?php 

                                            $order_type = $sale['delivery_mode'];

                                            switch ($order_type) {
                                                case "1":
                                                    $order_status="Order is Ready";
                                                    $button_clr="btn-success";
                                                    break;
                                                case "2":
                                                     $order_status="Provider in Route";
                                                     $button_clr="btn-warning";
                                                    break;
                                                case "3":
                                                     $order_status="Order is Cancelled";
                                                     $button_clr="btn-danger";
                                                    break;
                                                default:
                                                   $order_status="New Order";
                                                    $button_clr="btn-info";
                                            }
                                         ?>
										<?php
										
											echo '<div class="btn-group">  
												
													<button type="submit"  class="btn '.$button_clr.' dropdown-toggle js-location-create" data-toggle="dropdown">
												         '.$order_status.'
												 <span class="caret"></span>
												</button>
												
												<ul class="dropdown-menu" role="menu">
													<li>
														<form method="post">
                                                        <input type="hidden" name="user_id" value="'.$sale['orderUser'].'" >
														<button type="submit" name="Order" value="'.$sale['id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-bolt"></i> Order is Ready
														</a>
														</form>
													</li>
                                                    <li>
                                                        <form method="post">
                                                        <input type="hidden" name="user_id" value="'.$sale['orderUser'].'" >
                                                        <button type="submit" name="Delay" value="'.$sale['id'].'" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                        <i class="fa fa-bolt"></i>  Order is Delay
                                                        </a>
                                                        </form>
                                                    </li>
                                                     <li>
                                                        <form method="post">
                                                           <input type="hidden" name="user_id" value="'.$sale['orderUser'].'" >
                                                        <button type="submit" name="Cancel" value="'.$sale['id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                        <i class="fa fa-bolt"></i> Cancelled
                                                        </a>
                                                        </form>
                                                    </li>
                                                      <li>
                                                        <form method="post">
                                                           <input type="hidden" name="user_id" value="'.$sale['orderUser'].'" >
                                                        <button type="submit" name="" value="'.$sale['id'].'"class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                        <i class="fa fa-bolt"></i> In Route
                                                        </a>
                                                        </form>
                                                    </li>
													
												
												</ul>
												</div>';
									
                                             ?>
										</td>
									</tr>
                                   <?php $i++; } ?>
                                </tbody>
                            </table>
							<div>
								<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalAdd">Add New Product</button> -->
							</div>
						</div>
					</div> 
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