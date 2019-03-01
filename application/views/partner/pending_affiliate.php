<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
			?>
			<div id="msg_success_ajax"></div>
			<div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
					<h3 class="panel-title pull-left"><i class="fa fa-users"></i>Pending Affiliate</h3>
				</div>
                <div class="panel-body">
					<div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>S.No</th>
									<th>Phone</th>
									<th>City Name</th>
									<th>Current Email</th>
									<th>Status/action</th>                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $sno='1';
                                 foreach($alluser as $val){?>
                                <tr class="odd gradeX" id="rejectremove_<?=$val['id']?>">
									<td><?php echo $sno;?></td>
									<td><?php echo $val['phone'];?></td>
									<td><?php echo $val['city_name'];?></td>
									<td><?php echo $val['current_email'];?></td>
									
									<td class="center">
                                        <?php if($val['flag_enabled']==1){
                                        	 echo '<div class="btn-group">
            							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
											Activate 
											<span class="caret"></span>
										</button>            
								<ul class="dropdown-menu" role="menu">
									<li>
										<form action="" method="post">
										<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="deactive" value="'.$val['id'].'" id="deactive" data-id="'.$val['id'].'" class="js-user-disable">
										<i class="fa fa-minus-circle"></i>  Deactivate 
										</button>
										</form>
									</li>
								</ul>
							</div>';                                       	
									}else{
										 echo ' <div class="btn-group">
										<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
											Unactivated
											<span class="caret"></span>
										</button>            
								     	<ul class="dropdown-menu" role="menu">
										<li>
											<form action="" method="post">
											<button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active" value="'.$val['id'].'" id="active" data-id="'.$val['id'].'" class="js-user-disable">
											<i class="fa fa-minus-circle"></i>  Activate 
											</button>
											</form>
										</li>
										</ul>
									   </div>';
                                        	}?>
									</td>
                                </tr>
                                    <?php }?>
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
 </div>


