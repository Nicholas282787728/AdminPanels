            <div class="navbar-default sidebar" role="navigation">
				<div class="logo">
					<img src="<?php echo base_url(); ?>public/images/logo.png"/>
				</div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li >
                            <a href="<?php echo base_url('super-admin'); ?>" <?php if($file == 'admin/index'){ ?> class="active" <?php } ?>>Dashboard <?php if($file == 'admin/index'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                        </li>
                         <li <?php if($file == 'dashboard/distributionZone'){ echo "class='active'";} ?>>
                          <a  href="<?php echo base_url('distribution-zone'); ?>">
                           Affiliates Info
                          </a>
                        </li>
						<li>
                            <a href="<?php echo base_url('authorized-users'); ?>"  <?php if($file == 'admin/users'){ ?> class="active" <?php } ?>> Authorized Users <?php if($file == 'admin/users'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                        </li>

                        <li <?php if($file == 'dashboard/attachment-zip'){ echo "class='active'";} ?>>
                          <a  href="<?php echo base_url('attachment-zip'); ?>">
                            Attachments / Zip
                          </a>
                        </li>
                        
                        <li>
                          <a <?php if($file == 'dashboard/general-sales'){ echo "class='active'";} ?> href="<?php echo base_url('general-sales'); ?>">
                            General Sales
                          </a>
                        </li>
                        <li <?php if($title == 'admin/sales_list'){ ?> class="active" <?php } ?>>
                            <a href="<?php echo base_url('sales'); ?>"> Contractors / Staff <?php if($title == 'admin/sales_list'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                        </li>
					
						<li <?php if($title == 'admin/ratings'){ ?> class="active" <?php } ?> style="display: none;">
                            <a href="<?php echo base_url(); ?>panels/supermacdaddy/dashboard/ratings">Ratings</a>
                        </li>


                        
                       <!--  <li <?php if($title == 'admin/categories'){ ?> class="active" <?php } ?>>
                        	<a href="<?php echo base_url('categories'); ?>">Categories</a>
                        </li> -->





                    <!--     <li <?php if($title == 'admin/sub_categories'){ ?> class="active" <?php } ?>>
                        	<a href="<?php echo base_url('subcategories'); ?>">Sub Categories</a>
                        </li> -->
                       

                        <li>
                            <a href="#"> Our Services<i class="fa fa-angle-right pull-right" aria-hidden="true"></i></span></a>
                            <ul class="nav nav-second-level">
                                <li <?php if($title == 'admin/standard_services'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('standard-services'); ?>">Standard Services</a>
                                </li>
                                <li <?php if($title == 'admin/premium_services'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('premium-services'); ?>">Premium Services</a>
                                </li>
                                <li <?php if($title == 'admin/on_demand_services'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('ondemand-services'); ?>">Affiliate Partners</a>
                                </li>
                        
                            </ul>
                            <!-- /.nav-second-level -->


                         </li>



                            <li>
                            <a href="#">Side Features<i class="fa fa-angle-right pull-right" aria-hidden="true"></i></span></a>
                            <ul class="nav nav-second-level">
                               <li <?php if($title == 'admin/faq_ask_que'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('faq'); ?>">FAQ</a>
                                </li>
                                <li <?php if($title == 'admin/opt'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('opt'); ?>">OPT OUT</a>
                                </li>

                               
                                 <li <?php if($title == 'admin/our_team'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('our-team'); ?>">Our Team</a>
                                </li>
                                <li <?php if($title == 'admin/referralCode'){ ?> class="active" <?php } ?>>
                            <a href="<?php echo base_url('referralCode'); ?>">COINS/Referrals</a>
                        </li>
                                 

                           
                               
                                  <li <?php if($title == 'admin/background_image'){ ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url('background-image'); ?>">Background Images</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                       
                       
                        <li>
                            <a href="#">Terms and Conditions <i class="fa fa-angle-right pull-right" aria-hidden="true"></i></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a <?php if($title == 'admin/web_to'){ ?> class="active" <?php } ?> href="<?php echo base_url('web-tos'); ?>">Website <?php if($title == 'admin/web_to'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>
                                <li>
                                    <a <?php if($title == 'admin/app_tos'){ ?> class="active" <?php } ?> href="<?php echo base_url('app-tos'); ?>">Mobile App <?php if($title == 'admin/app_tos'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>
								<li>	
                                    <a <?php if($title == 'admin/loyalty_tos'){ ?> class="active" <?php } ?> href="<?php echo base_url('loyalty-tos'); ?>">Coins/Referrals <?php if($title == 'admin/loyalty_tos'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>
								<li>
                                    <a <?php if($title == 'admin/on_demand_tos'){ ?> class="active" <?php } ?> href="<?php echo base_url('ondemand-tos'); ?>">Affiliate Partners <?php if($title == 'admin/on_demand_tos'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>


                                <li>
                                    <a <?php if($title == 'admin/advertismentSales'){ ?> class="active" <?php } ?> href="<?php echo base_url('advertismentSales'); ?>">Advertisment Sales <?php if($title == 'admin/advertismentSales'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>
                                <li>
                                    <a <?php if($title == 'admin/certifiedProviders'){ ?> class="active" <?php } ?> href="<?php echo base_url('certifiedProviders'); ?>">Certified Providers <?php if($title == 'admin/certifiedProviders'){ ?><i class="fa fa-angle-right pull-right" aria-hidden="true"></i> <?php } ?></a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li <?php if($title == 'admin/support_tickets'){ ?> class="active" <?php } ?>>
                        	<a href="<?php echo base_url('support-tickets'); ?>">Support Tickets</a>
                        </li>
                       
                         <!--  <li <?php if($title == 'admin/documentVerificationStatusOnOff'){ ?> class="active" <?php } ?>>
                            <a href="<?php echo base_url('Dashboard/documentVerificationStatusOnOff'); ?>">Document Verification</a>
                        </li> -->
                     <li <?php if($title == 'admin/citySateAproved'){ ?> class="active" <?php } ?>>
                            <a href="<?php echo base_url('Dashboard/citySateAproved'); ?>">State & City Approval</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
	



		
		