<div class="navbar-default sidebar" role="navigation">
	<div class="logo">
		<img src="<?php echo base_url(); ?>public/images/logo.png"/>
	</div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a <?php if($file == 'storefronts/index'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-admin'); ?>">Dashboard</a>
            </li>
               <li style="display: none;">
                <a <?php if($file == 'storefronts/storefront_list'){ ?> class="active"<?php } ?> href="<?php echo base_url(); ?>">Store Front</a>
            </li>
            <li>
                <a <?php if($file == 'ondemand/visibility'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-visibility');?>">Visibility</a> 
            </li>
<!-- 
             <li>
                <a <?php if($file == 'storefronts/auth_users'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-auth-user');?>">Authorized Users</a>
            </li> -->
                <li >
                        <a <?php if($file == 'storefronts/sales_list'){ ?> class="active" <?php } ?> href="<?php echo base_url('storefronts-sales'); ?>"> Contractors / Staff </a>
                </li>
              
            <li>
                <a <?php if($file == 'storefronts/products'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-products');?>">Products</a>
            </li>
             <li>
                <a <?php if($file == 'storefronts/liveOrders'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-liveOrders');?>">Live Orders</a>
            </li>
           <!--   <li>
                <a <?php if($file == 'storefronts/subcategories'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-subcategories');?>">Sub Categories</a>
            </li> -->
             
            <li>
                <a <?php if($file == 'storefronts/support_tickets'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-support-tickets');?>">Support Tickets</a>
            </li>
               <li>
                <a <?php if($file == 'storefronts/orders'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-tranasction-orders');?>">Transaction Orders</a>
            </li>
               <li>
                <a <?php if($file == 'storefronts/history'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts-history');?>">History</a>
            </li>
               <li>
                <a <?php if($file == 'storefronts/giftedProducts'){ ?> class="active"<?php } ?> href="<?php echo base_url('storefronts/giftedProducts');?>">Favorites</a>
            </li>
           
            
            
        </ul>
    </div>
</div>
            <!-- /.navbar-static-side -->
 </nav>