
<style>

.myclass {
    width: 20% !important;
} 
</style>

 <div id="page-wrapper">
         <div class="row">
                <div class="col-lg-3 col-md-6 myclass">
                 <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/signupdocuments">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  <i style="color:#FF8961;" class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge">26</div> -->
                                    <div style="font-size: 12px;">Sign up <br> Document</div>
                                </div>
                            </div>
                        </div>
                       
                            <div class="panel-footer adi-head-orange">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div> 
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/promo_list">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                 <i style="color:#56BDDC;" class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge">12</div> -->
                                    <div style="font-size: 12px;">Promo Codes</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                       
                    </div>
                     </a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/payouts">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                 <i style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                     <div style="font-size: 12px;">Payout Details</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6 myclass">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/complimentaryAd">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   <!--  <div class="huge">13</div> -->
                                    <div style="font-size: 12px;">Complimentary Ad</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div></a>
                </div>
                 <div class="col-lg-3 col-md-6 myclass">   
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                 <i style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   <!--  <div class="huge">13</div> -->
                                    <div style="font-size: 12px;">Pending Approvals</div>
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
                            Drivers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Email</th>
                                        <th>title</th>
                                        <th>Locale</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Zip</th>
                                        <th>Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                //echo "<pre>"; print_r($Sales); 
                                foreach($drivers as $driver)
                                {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $driver['user_name']; ?></td>
                                        <td><?php echo $driver['display_name']; ?></td>
                                        <td><?php echo $driver['email']; ?></td>
                                        <td class="center"><?php echo $driver['title']; ?></td>
                                        <td class="center"><?php echo $driver['locale']; ?></td>
                                        <td class="center"><?php echo $driver['state']; ?></td>
                                        <td class="center"><?php echo $driver['address']; ?></td>
                                        <td class="center"><?php echo $driver['user_lat']; ?></td>
                                        <td class="center"><?php echo $driver['user_long']; ?></td>
                                        <td class="center"><?php echo $driver['zip']; ?></td>
                                        <td class="center"><?php echo $driver['mob_number']; ?></td>
                                    </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            
            
</div>