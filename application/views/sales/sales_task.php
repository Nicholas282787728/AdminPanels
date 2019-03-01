
<style>

.myclass {
    width: 20% !important;
} 
</style>

 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="http://medconnex.net/med/public/images/dash1.png">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div style="font-size: 12px;">Sales Staff Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-orange">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="http://medconnex.net/med/public/images/dash2.png">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div style="font-size: 12px;">Certified Providers Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <img src="http://medconnex.net/med/public/images/dash3.png">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div style="font-size: 12px;">Affiliate Partners Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="http://medconnex.net/med/public/images/dash4.png">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div style="font-size: 12px;">Support Tickets!</div>
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
            <!-- /.row -->
           
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Task
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div>
                        	<button type="button" class="btn btn-success">Add New Task</button>
                        <div>
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Close Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($person_task)){
									$i = 1;
									foreach($person_task as $hoval){
									
								  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $hoval['task_name']; ?></td>
                                        <td><?php echo $hoval['task_description']; ?></td>
                                        <td><?php echo $hoval['start_date']; ?></td>
                                        <td class="center"><?php echo $hoval['end_date']; ?></td>
                                        <td class="center"><?php echo $hoval['close_date']; ?></td>
                                        <td class="center"><?php echo $hoval['status']; ?></td>
                                        <td class="center"><?php //echo $hoval['0']['task_name']; ?></td>
                                    </tr>
									<?php 
										$i++; } }else{
											echo '<tr class="odd gradeX"><td>NO DATA</td></tr>';
										}?> 
                                  
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div>
                        	<button type="button" class="btn btn-success">Add New Task</button>
                        <div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            
            
</div>