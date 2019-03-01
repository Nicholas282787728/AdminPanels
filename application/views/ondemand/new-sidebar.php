<div class="row">
                <div class="col-lg-3 col-md-6 ">
                 <a href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/signupdocuments">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  <i style="color:#FF8961;" class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <div class="huge">26</div> -->
                                    <div style="font-size: 12px;">Sign up Documents</div>
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
                <div class="col-lg-3 col-md-6 ">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/promo_list">
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
                <div class="col-lg-3 col-md-6 ">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/payouts">
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
                <div class="col-lg-3 col-md-6 ">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/complimentaryAd">
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
                
                
                
            </div>
               <div class="row">
                <div class="col-lg-12">  <!-- <h1 class="page-header">Categories</h1> -->
                <?php 
                @$success_msg = $this->session->flashdata('successmessage');
                if(!empty($success_msg)) { ?>
                       <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('successmessage'); ?>.
                      </div>
                <?php }elseif($this->session->flashdata('errormessage')){ ?>
                    <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Danger!</strong> <?php echo $this->session->flashdata('errormessage'); ?>.
                  </div>
                <?php }
            ?>
            </div>
            </div>
            