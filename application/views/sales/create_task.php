<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.css">

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
    	<?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
		?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <p><i class="fa fa-users" aria-hidden="true"></i> Sales Staff</p>
            </div>
            <!-- /.panel-heading -->
        	<div class="panel-body">
        	
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
                    				<input class="form-control" name="task_name" autocomplete="off" value="" placeholder="Enter task name" type="text">
                				</div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Task Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="task_description" autocomplete="off" value="" placeholder="Enter task description" type="text">
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Start date</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="start_date" autocomplete="off" value="" placeholder="Enter start date" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>End date</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="end_date" autocomplete="off" value="" placeholder="Enter end date" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-12">
         <div class="form-group ">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="save" class="btn-green">Create Task</button>
                		</div>          
            		</div>
             	
            </div>
                 </div>  
            </div>
            <br>
    		
    </div>
</form>
        	
        	
        	</div>
        </div>
     </div>   	
 </div> 

