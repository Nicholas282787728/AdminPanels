<div class="row">
                <div class="col-lg-3 col-md-6 ">
                 <a href="<?php echo base_url(); ?>affiliate-signupdocuments">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  <i style="color:#FF8961;" class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
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
                <div class="col-lg-3 col-md-6 " style="display: none;">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/affiliatepartner/promo_list">
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
                <a href="<?php echo base_url(); ?>affiliate-payouts">
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
                            <div class="col-lg-3 col-md-6">
                                 <a href="javascript:void(0)" data-toggle="modal" data-target="#affiliateTerms"> 
            <div class="panel panel-primary">
                 
                           
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            
                                <div class="huge">
                             
                                          
                                      </div>
                                <div class="font-small">Affiliate Terms</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer adi-head-green">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                
            </div>
            </a>
        </div>
                <div class="col-lg-3 col-md-6 " style="display: none;">
                <a href="<?php echo base_url(); ?>panels/supermacdaddy/affiliatepartner/complimentaryAd">
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



  <!-- Modal -->
  <div class="modal fade" id="affiliateTerms" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
                  <?php
                                              // $id = $this->session->userdata('id');
                                        $conditions = array('state_id' => 'affiliate_partners');
                                        $this->db->select('content');
                                        $this->db->from('uf_tos');
                                        $this->db->where($conditions);
                                        $query=$this->db->get();
                                        $result=$query->row();
                                      

                                         ?>

          <p><?php echo $result->content; ?></p>
        </div>
       
      </div>
      
    </div>
  </div>

            