
<div class="side-menumedconnex">

<div id="sidebar-wrapper">
                <ul class="sidebar-nav main-nav">
                    <li class="sidebar-brand">
                        <a href="<?= base_url()?>"><img src="<?php echo base_url(); ?>/public/images/medco-logo.png" width="150" />
                        </a>
                    </li>
                    <li>
                        <i class="fa fa-home fa-2x"></i><a href="<?= base_url()?>#home" class="trn" data-trn-key="menu_home">Home</a>
                    </li>
                    <li>
                        <i class="fa fa-wrench fa-2x"></i><a href="<?= base_url()?>#service" class="trn" data-trn-key="menu_service">Our Services</a>
                    </li>

                    <li>
                        <i class="fa fa-phone fa-2x"></i><a href="<?= base_url()?>#contact" class="trn" data-trn-key="menu_contactus">Contact Us</a>
                    </li>
                    <!--   <li>
                        <i class="fa fa-user-plus"></i><a href="#" onclick="goToSignUp()" class="trn">Sign Up</a>
                    </li> -->
                   

					<?php
					if ($config_on_off == 1) {
						?>

	                    <li>
	                        <i class="fa fa-users fa-2x"></i><a href="<?= base_url() ?>careers" title="careers" class="trn" data-trn-key="menu_careers">careers</a>
	                    </li>
						<?php
					}
						if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') {
						?>
						<li>
							<i class="fa fa-download fa-2x"></i><a href="ticketgenerate.php" class="trn" data-trn-key="menu_help">Help</a>
						</li>
						<?php
					}
					?>
<!--					<li>
                        <i class="fa fa-download fa-2x"></i><a href="Update_Media_Kit_(1_of_2).zip" class="trn" data-trn-key="menu_mediakit">Media Kit</a>
                    </li>
                    <li>
                        <i class="fa fa-download fa-2x"></i><a href="#" title="Training Tool Kit" data-toggle="modal" data-target="#toolKitRequest" class="trn" data-trn-key="menu_training_toolkit">Training Tool Kit</a>
                    </li>
                    <li>
                        <i class="fa fa-download fa-2x"></i><a href="https://medonnex.zendesk.com/" class="trn" data-trn-key="menu_admin">Admin</a>
                    </li>-->
                </ul>
            </div>

            <div class="quick-menu">
                    <p>
                        <a href="#" title="English" data-value="en" class="btn btn-default lang_selector trn"><img class="btn-english" src="<?php echo base_url(); ?>public/images/USA.png" /></a>
                    </p>
                    <br>
                    <p>
                        <a href="#" title="Spanish" data-value="es" class="btn btn-default lang_selector trn"><img class="btn-spanish" src="<?php echo base_url(); ?>public/images/mexico.png" /></a>
                    </p>
                    <br>
                    <p><?php
                        if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') {
                            ?><a href="logout.php" title="Login" data-toggle="modal" data-target="#login" class="btn btn-default"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        <?php } else { ?><a href="#" title="Login" data-toggle="modal" data-target="#logindiffernt" class="btn btn-default"><i class="fa fa-lock fa-2x"></i></a>
                        <?php } ?>
                    </p>
                    <br>
                    <p><a href="#menu-toggle" title="Menu" class="btn btn-default" id="menu-toggle"><i class="menuChange fa fa-bars fa-2x"></i></a></p>
                </div>

    </div>