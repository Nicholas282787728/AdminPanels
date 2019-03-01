    <br>
       <div class="content-wrapper" style="min-height: 551px;">
       <div class="row-fluid sortable">
        <div id="page-wrapper">
              <?php if($this->session->flashdata('error')){   ?>
            <div id="settings-alerts">
                <div class="alert alert-danger"><?php echo $this->session->flashdata('proerror'); ?></div>
            </div>
            <?php } ?>
               <?php if($this->session->flashdata('success')){   ?>
            <div id="settings-alerts">
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            </div>
            <?php } ?>


            
            <div class="profileDetail1">
            <div class="row panel-blue">
            <div class="col-md-2"></div>
        <div class="col-md-8">
            <button  class="profileDetail btn btn-success">Account Settings</button> <button  class="assigneeSettings btn btn-success">Assignee Settings</button>
            <br>
        <div class="panel panel-primary" style="margin-top: 10px;">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-globe"></i> Settings</h3>
        </div>
        <div class="panel-body">
        
          
            <form class="form-horizontal validatedForm" role="form" name="settings" action="<?php echo base_url(); ?>panels/supermacdaddy/affiliatepartner/updatePassword" method="post" novalidate="novalidate">
                                     
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Email</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="email" id="email" class="form-control" name="email" value="<?php if(isset($profile->email)){ echo $profile->email; } ?>" readonly>
                                                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Name</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="text" id="user_name" class="form-control" name="user_name" value="<?php if(isset($profile->user_name)){ echo $profile->user_name; } ?>">
                                                               
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_site_location" class="col-xs-4 col-sm-4 col-lg-4 control-label">New Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="password" id="password" class="form-control" name="password" > 
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_author" class="col-xs-4 col-sm-4 col-lg-4 control-label">Confirm Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                              <input type="password" id="password_confirm" class="form-control" name="password_confirm" >
                                                              
                            </div>
                        </div> 
                        <div class="form-group pull-right">
                            <div class="col-xs-8 col-sm-9 col-lg-7">
                              <input type="submit"  class="btn btn-info" name="submit" value="Submit">
                                                              
                            </div>
                        </div> 
                </form>
        </div>
        </div>
        </div>
         
    </div>

    </div>

    <div class="assigneeSettings1">         <div class="row panel-blue">
            <div class="col-md-2"></div>
        <div class="col-md-8">
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-globe"></i> Assignee Settings</h3>
        </div>
        <div class="panel-body">
        
          
            <form class="form-horizontal validatedForm" role="form"  action="<?php echo base_url(); ?>affiliatepartner/assigneeAffiliate" method="post" novalidate="novalidate">
                                     
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Email</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="email" id="email" class="form-control" name="email"  >
                                                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-4 col-lg-4 control-label">Name</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="text" id="user_name" class="form-control" name="user_name" >
                                                               
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_site_location" class="col-xs-4 col-sm-4 col-lg-4 control-label">New Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                             <input type="password" id="password" class="form-control" name="password" > 
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_author" class="col-xs-4 col-sm-4 col-lg-4 control-label">Confirm Password</label>
                            <div class="col-xs-7 col-sm-7 col-lg-7">
                              <input type="password" id="password_confirm" class="form-control" name="password_confirm" >
                                                              
                            </div>
                        </div> 
                        <div class="form-group pull-right">
                            <div class="col-xs-8 col-sm-9 col-lg-7">
                              <input type="submit"  class="btn btn-info" name="submit" value="Submit">
                                                              
                            </div>
                        </div> 
                </form>
        </div>
        </div>
        </div>
         
    </div></div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>
        </div>
        </div>

        <script type="text/javascript">
              $('.profileDetail1').css('display','block');
    $('.assigneeSettings1').css('display','none');


            $('.profileDetail').click(function(){
       

    
        $('.profileDetail1').css('display','block');
    $('.assigneeSettings1').css('display','none');


});


            $('.assigneeSettings').click(function(){
       

    
        $('.profileDetail1').css('display','none');
    $('.assigneeSettings1').css('display','block');


});
        </script>