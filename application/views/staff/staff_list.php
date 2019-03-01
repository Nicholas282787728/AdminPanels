
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
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Store Fronts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                       
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>Name</th>                                        
                                        <th>Email</th>
                                        <th>Contact</th>                                        
                                        <th>Task</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                //echo "<pre>"; print_r($Sales); 
								$i = 1;
                                foreach($stafflist as $staff)
                                {
                                ?>
                                    <tr class="odd gradeX">
										<td><?php echo $i; ?></td>
                                        <td><?php echo $staff['firstname']." ". $staff['lastname']; ?></td>
                                        <td><?php echo $staff['email']; ?></td>                                        
                                        <td class="center"><?php echo $staff['contact']; ?></td>
										<td>
										<?php if(!empty($staff['count'])){
										echo "<a href='staff_task?id=".$staff['uid']."' class='edit btn btn-success'>".$staff['count']. "Task </a>";
										}else{
										echo "<a href='#' class='edit btn btn-danger'> No Task </a>";
										}
										?>
										</td>
                                       
                                    </tr>
                                   <?php $i++; } ?>
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