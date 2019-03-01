<!-- <div class="navbar-default sidebar" role="navigation">
		<div class="logo">
			<img src="<?php echo base_url(); ?>public/images/logo.png"/>
		</div>
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">

				<li>
					<a href="<?php echo base_url(); ?>doctor/">Dashboard</a>
				<li>
					<a href="<?php echo base_url(); ?>doctor/reservation">Appointments/Reservations</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>doctor/schedule">Manage Schedule</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>doctor/support_ticket">Ticket Management</a>
				</li>

			</ul>
		</div>
	 </div>
 </nav> -->
   <div class="navbar-default sidebar" role="navigation">
               <div class="logo">
                  <a href="<?=base_url()?>"><img src="<?php echo base_url(); ?>public/images/logo.png"/></a>
               </div>
               <div class="sidebar-nav navbar-collapse collapse">
                  <ul class="nav" id="side-menu">
                    <li>
                        <a <?php if($file == 'doctor/index'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor">Dashboard </a>
                     </li>
                     <li >
                        <a <?php if($file == 'doctor/visibility'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/visibility">Visibility </a>
                     </li>
                    <!--  <li >
                        <a <?php if($file == 'doctor/promo_list'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/promo_list">Promo Codes </a>
                     </li> -->
					<li >
                        <a <?php if($file == 'doctor/support_tickets'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/support_ticket">Support Ticket </a>
                     </li>
<!--                     <li >
                        <a <?php if($file == 'doctor/viewandlikes'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/viewandlikes">Views & Likes</a>
                     </li>-->
<!--                     <li >
                        <a <?php if($file == 'doctor/scheduling'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/schedule">Scheduling</a>
                     </li>-->
                     <li>
                        <a <?php if($file == 'doctor/pending-approval'){ echo "class='active'";} ?>  href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/pendingApproval">
							<!--Pending Approvals-->
							Scheduling 
						</a>
                     </li>
                  
                     <li >
                        <a <?php if($file == 'doctor/history'){ echo "class='active'";} ?> href="<?php echo base_url(); ?>panels/supermacdaddy/doctor/history">History </a>
                     </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </nav> 