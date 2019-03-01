<div class="navbar-default sidebar" role="navigation">
	<div class="logo">
		<img src="<?php echo base_url(); ?>public/images/logo.png"/>
	</div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a <?php if($file == 'ondemand/index'){ ?> class="active"<?php } ?> href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand">Dashboard</a>
            </li>
            <li style="display: none;">
                <a <?php if($file == 'ondemand/drivers'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/drivers">Drivers</a>
            </li>

<!--             <li>
                <a <?php if($file == 'ondemand/auth_users'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/auth_user">Authorized Users</a>
            </li>-->
              <li style="display: none;">
                <a <?php if($file == 'ondemand/categories'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/categories">Categories</a>
            </li>

           
              <li>
                <a <?php if($file == 'ondemand/visibility'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/visibility">Visibility</a> 
            </li>

            <li>
                <a <?php if($file == 'ondemand/products'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/products">Products</a>
            </li>
             <li>
                <a <?php if($file == 'ondemand/liveOrders'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/liveOrders">Live Orders</a>
            </li>
       <!--         <li >
                <a <?php if($file == 'ondemand/subcategories'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/subcategories">Sub Categories</a>
            </li> -->
<!--             <li>
                <a <?php if($file == 'ondemand/promo_list'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/promo_list">Promo Codes</a>
            </li>-->

            <li>
                <a <?php if($file == 'ondemand/support_tickets'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/support_tickets">Support Tickets</a>
            </li>
          
            <li style="display: none;">
                <a <?php if($file == 'ondemand/visibility_list'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/visibility_list">Visibility List</a> 
            </li>
               <li>
                <a <?php if($file == 'ondemand/orders'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/orders">Transaction Orders</a>
            </li>
                <li>
                <a <?php if($file == 'ondemand/history'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/ondemand/history">History</a>
            </li>
               <li>
                <a <?php if($file == 'ondemand/giftedProducts'){ ?> class="active"<?php } ?> href="<?php echo base_url('ondemand/giftedProducts');?>">Favorites</a>
            </li>
           
            
            
        </ul>
    </div>
</div>
            <!-- /.navbar-static-side -->
 </nav>