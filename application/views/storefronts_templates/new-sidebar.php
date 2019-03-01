
            <!-- /.row -->
            <div class="row dash-icon">
                <div class="col-lg-3 col-md-6" >
                <a href='<?php echo base_url('storefronts-signupdocuments'); ?>'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i  style="color:#FF8961;" class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- <span><?php echo count(@$salcount['sales']);?></span> -->
                                   <div style="font-size: 12px;">Sign up Documents</div>
                                </div>
                            </div>
                        </div> 
                            <div class="panel-footer adi-head-orange">
                                <span class="pull-left">View Details </span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6" style="display: none">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i  style="color:#56BDDC;" class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="font-small">Certified Providers Panel</div>
                                </div>
                            </div>
                        </div>
                      
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left"><a href='#' class="" data-toggle="modal" data-target="#exampleModal">View Details</a></span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                </div>
                  <div class="col-lg-3 col-md-6 ">
                <a href="<?php echo base_url('storefronts-promo-list'); ?>">
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
                <a data-toggle="modal" data-target="#payoutDetail" >
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
                <div class="modal fade" id="payoutDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closepayout"  data-dismiss="modal">&times;</button>
            <!--     <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Sign Up Documents </h5> -->
               
            </div> 
            <div class="modal-body">
           <h2>You must update your billing method in order to begin conducting services.<br>
            Contact our office for further assistance</h2><br>
           <h2>Customer Service: 619.343.8465</h2>
            </div>
           <!--  <button type="button" class="btn btn-default" id="closepayout"  data-dismiss="modal">Close</button> -->
        </div>
    </div> 
</div>
<script type="text/javascript">
    $( ".closepayout" ).on( "click", function() {
         window.location.replace("<?php echo base_url(); ?>storefronts-payouts");

// setTimeout(function(){

//    window.location.replace("<?php echo base_url(); ?>storefronts-payouts");
// }, 3000);
});


</script>
                <div class="col-lg-3 col-md-6" style="display: none;">
                    <a href='<?php echo base_url(); ?>panels/supermacdaddy/storefronts/affiliate'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <i  style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                     <!-- <span>11</span> -->
                                    <div class="font-small">Affiliate Partners Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/affiliate">
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </a>
                </div>
                <div class="col-lg-3 col-md-6" style="display: none;">
                     <a href='<?php echo base_url(); ?>panels/supermacdaddy/storefronts/support_tickets'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <!-- <span><?php //echo $supportCount; ?></span> -->
                                    <div class="font-small">Support Tickets! </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>panels/supermacdaddy/storefronts/support_tickets">
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </a>
                </div>
                 <div class="col-lg-3 col-md-6 ">
                <a href="<?php echo base_url('storefronts-complimentaryAd'); ?>">
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