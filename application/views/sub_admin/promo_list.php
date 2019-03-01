        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Users</h1>-->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <?php 
		
      			@$success_msg = $this->session->flashdata('success_msg');
				if(!empty($success_msg)) {
                	echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
               		echo $this->session->flashdata('success_msg')."</div>";			
            	}
		?>


                <div class="col-md-12">
        <div class="panel panel-primary">
        <div class="panel-heading panel-heading-buttons clearfix title-bar-green">
            <h3 class="panel-title pull-left"><i class="fa fa-cut"></i> Promo Codes</h3>
            <div class="pull-right">
                <button id="table-promos-download" class="btn btn-sm btn-default btn-normal">Download CSV</button>
            </div>
        </div>
        <div class="panel-body">
             <button type="button" class="btn-green js-code-create" data-toggle="modal" data-target="#exampleModal"> Create New Code
                    </button>
            <div class="table-responsive">
                <table id="table-promos" class="customise-table tablesorter table table-bordered table-hover table-striped tablesorter-bootstrap hasSaveSort hasFilters" data-sortlist="[[0, 0]]" role="grid" aria-describedby="table-promos_pager_info"><colgroup class="tablesorter-colgroup"></colgroup>
                    <thead>

                         <tr>
							<th>Code<i class="fa fa-sort"></i></th>
							<th>Type<i class="fa fa-sort"></i></th>
							<th>Offer <i class="fa fa-sort"></i></th>
							<th>Description<i class="fa fa-sort"></i></th>
							<th>Starts<i class="fa fa-sort"></i></th>
							<th>End<i class="fa fa-sort"></i></th>
							<th>Created<i class="fa fa-sort"></i></th>  
							<th>User<i class="fa fa-sort"></i></th> 
							<th>Status/Actions <i class="fa fa-sort"></i></th>                                         
						</tr>
                    	<tbody aria-live="polite" aria-relevant="all">
						<tr class="search">
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
							<td><input type="search"/></td>
						</tr>
                    	<?php foreach($allpromo as $val){
                    		echo '<tr>';
                    		echo '<td data-text="'.$val['code'].'">'.$val['code'].'</td>';
                    		echo '<td data-text="SAVE 20">'.$val['type'].'</td>';
                    		echo '<td data-text="SAVE 20">'.$val['offer'].'</td>';
                    		echo '<td data-text="SAVE 20">'.$val['description'].'</td>';
                    		echo '<td data-text="SAVE 20">'.$val['start'].'</td>';
							echo '<td data-text="SAVE 20">'.$val['end'].'</td>';
							echo '<td data-text="'.$val['date'].'">'.$val['date'].'</td>';
							echo '<td data-text="'.$val['user_id'].'">'.$val['user_id'].'</td>';
							if($val['status'] == 0){
							echo '<td><div class="btn-group">
            
                
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Disabled
                        <span class="caret"></span>
                    </button>            
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-promocode-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit
                    </a>
                </li>
               
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="enable" data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i>  Enable 
                    </button>
                	</form>
                    
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the promo code ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete </button>
                	</form>
                </li>
            </ul>
        </div>
    						</td>';}else{
				echo '<td><div class="btn-group">         
                
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        Enabled
                        <span class="caret"></span>
                    </button>            
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-promocode-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit
                    </a>
                </li>
               
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="enable" data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i>  Disable
                    </button>
                	</form>
                    
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the promo code ?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete</button>
                	</form>
                </li>
            </ul>
        </div>';
							}
							echo '</tr>';
                    	}?>
                    	</tbody>
                </table>
       


       </div>
            <div class="row">
                <div class="col-md-6 ">
                    <button type="button" class="btn-green js-code-create" data-toggle="modal" data-target="#dialog-code-create"> Create New Code
                    </button>
                </div>
                <div class="col-md-6 text-right pull-right">
                    <a href="#" class="font-size-13 blue text-decoration-none">View All Promos <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        </div>
        </div>
                
                
                
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>
  <!-- Modal -->
<div class="modal fade modal-promocode" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-blue">
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
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Code</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="code" autocomplete="off" value="" placeholder="Example : SAVE 20" type="text">
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label for="input_locale">Promo Type</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-language"></i></span-->
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="type" tabindex="-1" title="Promo Type">
                        <option value="1" selected="">Dollar $ Off</option>
                        <option value="2">Percentage % Off</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Offer</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="offer" autocomplete="off" value="" placeholder="Example : 25" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Promo Description</label>
                <div class="input-group"  style="width: 100%;">
                    <textarea name="description" style="width: 100%;" rows="5"></textarea>
                </div>
            </div>
        </div>
          
		<div class="col-sm-4">
            <div class="form-group ">
                <label>Service Type</label>
                <div class="input-group">
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="service_type" tabindex="-1" title="Service Type">
                        <option value="1" selected="">Standard</option>
                        <option value="2">Premium</option>
						<option value="3">Affiliate</option>
                    </select>
                </div>
            </div>
        </div>
              
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="" style="clear:both">
                <div class="creatUserBottom">
                    <div class="">
                        <div class="vert-pad">
                            <button type="submit" name='save' class="btn-green">
                                 Create Promo
                            </button> 
                        </div>          
                    </div>       
                    <div class="">
                        <div class="vert-pad">
                            <button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</form>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>-->
  </div>
</div>              
</div>
</div>
<!-- EDIT PROMO CODE MODAL -->
<div class="modal fade modal-promocode" id="editpromomodal"  role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-blue">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Update Promo Code</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
         <form name="user" method="post" action="" novalidate="novalidate">
    <div id="form-alerts">
    </div>
    <div class="row">
        <div class="updatepromodiv">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Code</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="code" autocomplete="off" value="" placeholder="Example : SAVE 20" type="text">
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label for="input_locale">Promo Type</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-language"></i></span-->
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="type" tabindex="-1" title="Promo Type">
                        <option value="1" selected="">Dollar $ Off</option>
                        <option value="2">Percentage % Off</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Offer</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="offer" autocomplete="off" value="" placeholder="Example : 25" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Promo Description</label>
                <div class="input-group"  style="width: 100%;">
                    <textarea name="description" style="width: 100%;" rows="5"></textarea>
                </div>
            </div>
        </div>
          
		<div class="col-sm-4">
            <div class="form-group ">
                <label>Service Type</label>
                <div class="input-group">
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="service_type" tabindex="-1" title="Service Type">
                        <option value="1" selected="">Standard</option>
                        <option value="2">Premium</option>
						<option value="3">Affiliate</option>
                    </select>
                </div>
            </div>
        </div>
              
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="" style="clear:both">
                <div class="creatUserBottom">
                    <div class="">
                        <div class="vert-pad">
                            <button type="submit" name='update' class="btn-green">
                                 Update Promo
                            </button> 
                        </div>          
                    </div>       
                    <div class="">
                        <div class="vert-pad">
                            <button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>-->
  </div>
</div>              
</div>
</div>

