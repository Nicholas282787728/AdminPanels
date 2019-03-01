<div id="page-wrapper">
          <?php $this->load->view('storefronts_templates/new-sidebar'); ?>
           
            <!-- /.row -->
			    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Orders</p>
                    
                </div>
              <!--   <button onclick="myFunction()">Print this page</button> -->
                 <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                     <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                            <!--     <th>S.No</th> -->
                                <th>Total Products</th>
                                <th>Coins</th>
                                <th>Graduity</th>
                                <th>Grand Total</th>
                                <th>Date & Time</th>
								<th>Delivery Address</th>
								<th>Payment Method</th>                              
								<th>Order Status</th>								
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        	 $i = 1;
                             // echo "<pre>"; print_r($orders);
                             // die();
                        	 foreach($orders as $order) { ?>
                            <tr class="odd gradeX">
                      <!--           <td><?php echo $i; ?></td> -->
                            	<td><?php echo $order['total_products']; ?></td>
                            	<td><?php echo $order['coins']; ?></td>
                            	<td><?php echo $order['graduity']; ?></td>
                            	<td><?php echo $order['grand_total']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                            	<td><?php echo $order['delivery_address']; ?></td>
                            	<td><?php echo $order['payment_method']; ?></td>
                            	<td><?php if($order['order_status'] == "0"){
											echo 'Placed';
										}elseif($order['order_status'] == "1"){
											echo 'Confirmed';
										}elseif($order['order_status'] == "2"){
											echo 'Delivered';
										} ?></td>
                            	  
                            	

                            </tr> 
                           <?php $i++;} ?> 
                        </tbody>
                    </table> <!-- /.table-responsive -->
                </div>
                    <div id="table-users-pager" class="pager pager-lg tablesorter-pager">
    				    <div class="pagination-wrap">
        					
        			</div>
                    
                </div><!-- /.panel-body -->
             </div><!-- /.panel -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
</div><!--/.page wrapper-->
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

<script>
function myFunction() {
  window.print();
}
</script>