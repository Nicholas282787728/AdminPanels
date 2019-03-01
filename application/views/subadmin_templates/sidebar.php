            <div class="navbar-default sidebar" role="navigation">
				<div class="logo">
					<img src="<?php echo base_url(); ?>public/images/logo.png"/>
				</div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- <li class="sidebar-search">
                           <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                           input-group
                        </li> -->
                        <li>
                            <a href="<?php echo base_url(); ?>/admin">Dashboard</a>
                        </li>
						<li>
                            <a href="<?php echo base_url(); ?>admin/users">Views & Likes<i class="fa fa-angle-right pull-right" aria-hidden="true"></i></a>
                        </li>
                        
						
						<li>
                            <a href="<?php echo base_url(); ?>admin/promo_list"> Promo Codes</a>
                        </li>
                    
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		<!--script>
		$(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.sidebar').css('min-height', windowHeight);
  };
  setHeight();
  
  $(window).resize(function() {
    setHeight();
  });
});</script-->