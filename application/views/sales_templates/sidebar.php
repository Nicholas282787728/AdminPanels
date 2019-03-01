   <div class="navbar-default sidebar" role="navigation">
               <div class="logo">
                  <a href="#"><img src="<?php echo base_url(); ?>public/images/logo.png"/></a>
               </div>
               <div class="sidebar-nav navbar-collapse collapse">
                  <ul class="nav" id="side-menu">
                  <li class="header"></li>
					<li   >
					  <a  <?php if($file == 'sales/index'){ echo "class='active'";} ?> href="<?php echo base_url('sales-admin'); ?>">
					   Dashboard
					  </a>
					</li>
				
					<li >
					  <a <?php if($file == 'sales/attachment-zip'){ echo "class='active'";} ?> href="<?php echo base_url('sales-attachment-zip'); ?>">
						Attachments/Zip
					  </a>
					</li>
					<li>
						<a <?php if($file == 'sales/ticket-management'){ echo "class='active'";} ?> href="<?php echo base_url('sales-ticket-managment'); ?>">
							Ticket Management
						</a>
					</li>
					<li>
						<a <?php if($file == 'sales/setting'){ echo "class='active'";} ?> href="<?php echo base_url('sales-setting'); ?>">
							Sales Staff info
						</a>
					</li>
					<li>
						<a <?php if($file == 'sales/history'){ echo "class='active'";} ?> href="<?php echo base_url('sales/history'); ?>">
							History
						</a>
					</li>
                  </ul>
               </div>
            </div>
         </nav> 
		
<style type="text/css">
  .ad{
    min-height: 1px !important;
  }
</style>