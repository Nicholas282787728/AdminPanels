<script type="text/javascript" src="<?=base_url()?>public/js/nicEdit-latest.js"></script>
<script>
	bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('web_tos');
	});
</script>
		<div id="page-wrapper">
			<?php 
					$this->load->view('admin/top_tab_header');
			   ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <?php 
                    @$success_msg = $this->session->flashdata('success_msg');
                    if(!empty($success_msg)) { ?>
                           <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>.
                          </div>
                    <?php }elseif($this->session->flashdata('error_msg')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Danger!</strong> <?php echo $this->session->flashdata('error_msg'); ?>.
                      </div>
                    <?php }
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading title-bar-green" style="color:#fff;">
                           <!--  <i class="fa fa-flag mr-5"></i>On-Demand Driver's Terms and Conditions -->
                               <i class="fa fa-flag mr-5"></i>Affiliate Partner Terms  & Conditions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<form action="" method="post">
							<textarea rows="10" name="content" id="web_tos" cols="117" class="note-codable form-control" style="width: 100%;"><?php echo $tos['content'];?></textarea>
							<div class="row">
								<div class="col-xs-12">
									<button type="submit" class="btn-green js-location-create" name="save"> Submit </button>
								</div>
							</div>
							</form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>