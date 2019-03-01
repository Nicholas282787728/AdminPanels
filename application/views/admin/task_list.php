     <link href='http://imvisile.com/med/public/css/bootstrap-switch.css'>
    <link rel="stylesheet" href="http://imvisile.com/med/public/css/custom.css" type="text/css">
        <div id="page-wrapper">
            <!-- /.row -->
            
            <!-- Button trigger modal -->
		<?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
		?>


            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
                            <i class="fa fa-users" aria-hidden="true"></i> Task List
                            <div class="pull-right">
							     <button id="table-categories-download" class="btn btn-sm btn-normal">Download CSV</button>
						    </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<button type="button" class="btn-green btn-success " data-toggle="modal" data-target="#exampleModal">
							Add New Task
						</button><br><br>
                        <div class="table-responsive">    
                            <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Staff Name</th>
                                        <th>Task Name </th>
                                        <th>Task Description </th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Close Date</th>
                                        <th>Status/action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="search">
							            <td><input type="search"></td>
                                        <td><input type="search"></td>
							            <td><input type="search"></td>
							            <td><input type="search"></td>
							            <td><input type="search"></td>
							            <td><input type="search"></td>
							            <td><input type="search"></td>
							         </tr>
                                <?php foreach($all_task as $val){?>
										<tr class="odd gradeX">
                                        <td><?php echo  $val['firstname'].' '.$val['lastname'];?></th>
											
										<td><?php echo  $val['task_name'];?></td>
										 <td><?php echo  $val['task_description'];?></td>
                                        <td><?php echo  $val['start_date'];?></td>
                                        <td><?php echo  $val['end_date'];?></td> 
                                        <td><?php echo  $val['close_date'];?></td>
                                        <td class="center">
                                        	<?php
                                        	if($val['status']==0){
                                        		echo '<button type="button" class="btn btn-warning js-location-create" data-toggle="modal" data-target="#dialog-location-create">
													Deactivated
													</button>';
                                        	}else{
                                        		echo '<button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#dialog-location-create">
											Active
											</button>';
                                        	}
                                        	
                                        	?>
                                        	<a href="#"><button class="btn-green"><i class="fa fa-edit mr-5"></i> Edit</button></a>
                                            <a href="#"><button class="btn-danger"> <i class="fa fa-trash mr-5"></i> Delete</button></a>
											</td>
                                        
                                    </tr>
                                <?php }?>
                                   
                                   
                                   
                                  
                                    
                                </tbody>
                            </table>
                        </div>
                            <!-- /.table-responsive -->
                          <button type="button" class="btn-green btn-success js-location-create" data-toggle="modal" data-target="#exampleModal">
								Add New Task
						</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Create User</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form name="user" method="post" action="" novalidate="novalidate">
    				<div id="form-alerts">
    				</div>
    			<div class="row">
    				<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Select Staff Member</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                        <select id="input_locale" class="form-control" name="staff_id" title="staff_id" required>
                            <?php foreach($all_staff as $val){?>
                                <option value="<?php echo  $val['uid'];?>"><?php echo  $val['firstname'].' '. $val['lastname'];?></option>               
                           <?php }?> 
                            </select>
                		</div>
            </div>
        </div>
        			<div class="col-sm-6">
            			<div class="form-group">
                			<label>Task Name</label>
                				<div class="input-group">
                    				<span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    				<input class="form-control" name="task_name" autocomplete="off" value="" placeholder="Please enter the First Name" type="text">
                				</div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Task Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="task_description" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Start date</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="start_date" autocomplete="off" value="" placeholder="Enter your username" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>End date</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="end_date" autocomplete="off" value="" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-12">
         <div class="form-group ">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="save" class="btn-green">Create Task 	</button>
                		</div>          
            		</div>
             	
            </div>
                 </div>  
            </div>
            <br>
    		
    </div>
</form>
        	
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>-->
  </div>
</div>      
