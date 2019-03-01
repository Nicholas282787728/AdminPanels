<style>
.myclass {
    width: 20% !important;
} 
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
						<div class="col-xs-3">
							<img src="http://medconnex.net/med/public/images/dash1.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">26</div>
							<div style="font-size: 12px;">Sales Staff Panel</div>
						</div>
                    </div>
                </div>
				<a href="#">
					<div class="panel-footer adi-head-orange">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<img src="http://medconnex.net/med/public/images/dash2.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">12</div>
							<div style="font-size: 12px;">Certified Providers Panel</div>
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
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
						   <img src="http://medconnex.net/med/public/images/dash3.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">124</div>
							<div style="font-size: 12px;">Affiliate Partners Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-per">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<img src="http://medconnex.net/med/public/images/dash4.png">
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">13</div>
							<div style="font-size: 12px;">Support Tickets!</div>
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
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products
                </div>
                <div class="panel-body">
                    <div>
                        <button type="button" class="btn btn-success">Add New Product</button>
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
                                        <th>Product Type</th>
                                        <th>MRP</th>
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
											echo 'Sative';
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
										<td><?php echo $sale['mrp']; ?></td> 
										<td></td>
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
														<form action="" method="post">
														<button type="button" id="'.$sale['id'].'" class="edit_staff" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
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
														<button type="button" id="'.$sale['id'].'" class="edit_staff" style="padding: 1px 20px;border: none;background: transparent;">
														<i class="fa fa-edit"></i> Edit 
														</button>
														</form>
													</li>
													
													<li>
														<form action="" method="post">
														<button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_staff" value="'.$sale['id'].'"  class="js-user-delete" >
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
								<button type="button" class="btn btn-success">Add New Product</button>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>