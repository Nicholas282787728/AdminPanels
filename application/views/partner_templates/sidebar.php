<div class="navbar-default sidebar" role="navigation">
	<div class="logo">
		<img src="<?php echo base_url(); ?>public/images/logo.png"/>
	</div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a <?php if($file == 'affiliatepartner/index'){ ?> class="active"<?php } ?> href="<?php echo base_url(); ?>affiliate-partners">Dashboard</a>
            </li>

            <li <?php if($file == 'affiliatepartner/attachment-zip'){ echo "class='active'";} ?>>
              <a  href="<?php echo base_url(); ?>affiliate-attachment_zip">
                Attachments / Zip
              </a>
            </li>
             <li <?php if($file == 'affiliatepartner/distributionZone'){ echo "class='active'";} ?>>
              <a  href="<?php echo base_url(); ?>affiliate-distributionZone">
               Territories
              </a>
            </li>
        <!--     <li>
                <a <?php if($file == 'affiliatepartner/visibility'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>panels/supermacdaddy/affiliatepartner/visibility">Visibility</a> 
            </li> -->

            <li>
                <a <?php if($file == 'affiliatepartner/history'){ ?> class="active"<?php } ?> href="<?php echo base_url();?>affiliate-history">History</a>
            </li>
           
            
            
        </ul>
    </div>
</div>
            <!-- /.navbar-static-side -->
 </nav>