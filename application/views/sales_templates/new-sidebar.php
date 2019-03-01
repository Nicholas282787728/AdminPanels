
		<div class="row dash-icon">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
					<a href="<?php echo base_url('sales-sign-updocuments'); ?>" >
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i style="color:#FF8961;" class="fa fa fa-file fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div class="font-small">Sign Up Documents</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer adi-head-orange">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
                    </div>
                </div>
<!--                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
					<a href="<?php echo base_url(); ?>panels/supermacdaddy/sales/attachment_zip" >
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i style="color:#FF8961;" class="fa fa-download fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $this->db->count_all('sal_zip'); ?></div>
                                    <div class="font-small">Attachment Zip</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer adi-head-orange">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
                    </div>
                </div>-->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                     <a href="<?php echo base_url('sales-general-sales'); ?>" >
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i style="color:#56BDDC;" class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                                    $conditions = array('stateCityStatus' => '1');
                                        $this->db->select('id');
                                        $this->db->from('uf_general_sale');
                                        $this->db->where($conditions);
                                      echo  $num_results = $this->db->count_all_results();


                                    ?></div>
                                    <div class="font-small">General Sales</div>
                                </div>
                            </div>
                        </div>
                       
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
						<a href="<?php echo base_url('sales-advertisement-sales'); ?>">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
									   <i style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php 
                                        $id = $this->session->userdata('id');
                                        $conditions = array('created_by' => $id);
                                        $this->db->select('id');
                                        $this->db->from('sal_advertisement');
                                        $this->db->where($conditions);
                                      echo  $num_results = $this->db->count_all_results();
                                       ?></div>
										<div class="font-small">Advertisement Sales</div>
									</div>
								</div>
							</div>
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
						</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
					<a href="<?php echo base_url('sales-promo-list'); ?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i style="color:#10B1AC;" class="fa fa-inbox fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div class="font-small">Promo Codes</div>
                                </div>
                            </div>
                        </div>
                   
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>