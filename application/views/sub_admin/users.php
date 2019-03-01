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
			<div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
					<h3 class="panel-title pull-left"><i class="fa fa-users"></i> Users</h3>
					<div class="pull-right">
						<button id="table-users-download" class="btn btn-sm btn-default btn-normal">Download CSV</button>
					</div>
				</div>
                <div class="panel-body">
					<button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
							Create New Users
					</button><br><br>
				<!--	<form action='' method='post' >
						<button type="submit" name='type' value="User" class="btn-green js-location-create">	Users</button>&nbsp
						<button type="submit" name='type' value="Driver" class="btn-green js-location-create"> Driver </button>&nbsp
						<button type="submit" name='type' value="Store" class="btn-green js-location-create"> Store </button>&nbsp
						<button type="submit" name='type' value="Docter" class="btn-green js-location-create"> Docter	</button>
					</form>  ---->
                    <div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>User/Info</th>
									<th>Title</th>
									<th>Registered Since</th>
									<th>Last Sign-in</th>
									<th>Status/action</th>                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($alluser as $val){?>
                                <tr class="odd gradeX">
									<td><?php echo $val['display_name'];?><br>
										<?php echo $val['mob_number'];?><br>
										<?php echo $val['email'];?></td>
									<td><?php echo $val['title'];?></td>
									<td><?php echo $val['created_at'];?></td>
									<td><?php echo $val['last_login'];?></td>
									<td class="center">
                                        <?php if($val['flag_enabled']==1){
                                        	 echo '<div class="btn-group">
            
                
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        Active
                        <span class="caret"></span>
                    </button>            
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-user-edit" data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit user
                    </a>
                </li>
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-user-password" data-target="#dialog-user-password" data-toggle="modal">
                    <i class="fa fa-key"></i> Change password
                    </a>
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="enable" value="'.$val['id'].'" id="enable" data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i>  Disable user
                    </button>
                	</form>
                    
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user '.$val['display_name'].'?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete user</button>
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
                
            <!--    <li>
                    <a href="#" data-id="'.$val['id'].'"class="js-user-activate">
                    <i class="fa fa-bolt"></i> Activate user
                    </a>
                </li>  --->
                
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-user-edit"  data-toggle="modal">
                    <i class="fa fa-edit"></i> Edit user
                    </a>
                </li>
                <li>
                    <a href="#" data-id="'.$val['id'].'" class="js-user-password" data-target="#dialog-user-password" data-toggle="modal">
                    <i class="fa fa-key"></i> Change password
                    </a>
                </li>
                <li>
                	<form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="disable" value="'.$val['id'].'" id="disable" data-id="'.$val['id'].'" class="js-user-disable">
                    <i class="fa fa-minus-circle"></i> Enable user
                    </button>
                	</form>
                </li>
                <li>
                    <form action="" method="post">
                    <button style="padding: 1px 20px;border: none;background: transparent;" onclick="return confirm(\'Are you sure you want to delete the user '.$val['display_name'].'?\');" type="submit" name="delete" value="'.$val['id'].'" id="disable" class="js-user-delete" data-user_name="Ajay" >
                    <i class="fa fa-trash-o"></i> Delete user</button>
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
                    <button type="button" class="btn-green js-location-create" data-toggle="modal" data-target="#exampleModal">
							Created New Users
					</button>
                </div>
            </div>
        </div>
    </div>
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
                <label>User Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="user_name" autocomplete="off" value="" placeholder="Please enter the First Name" type="text">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Display Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="display_name" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Title </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select id="input_locale" class="form-control" name="title" title="Locale" required>
                            <option value="Store" selected="">Store</option>
                            <option value="Driver">Driver</option>
                            <option value="Driver">Doctor</option>
                        </select>
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Contact </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="contact" autocomplete="off" placeholder="" type="text">
                </div>
            </div>
        </div>
              
      
      
                <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Locale</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                        <select id="input_locale" class="form-control" name="locale" title="Locale">
                                                <option value="de_DE">de_DE</option>
                                                <option value="en_US" selected="">en_US</option>
                                                <option value="es_ES">es_ES</option>
                                                <option value="fr_FR">fr_FR</option>
                                                <option value="it_IT">it_IT</option>
                                                <option value="nl_NL">nl_NL</option>
                                                <option value="pt_BR">pt_BR</option>
                                                <option value="ro_RO">ro_RO</option>
                                                <option value="th_TH">th_TH</option>
                                                <option value="tr_TR">tr_TR</option>
                                            </select>
                </div>
            </div>
        </div>
                  
            </div><br>
           <div class="modal-footer">
    		<div class="row">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="save" class="btn-green">Create User		</button>
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

<!-- Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    	<div class="updatepro">
    	
        <div class="col-sm-6">
            <div class="form-group">
                <label>User Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input readonly class="form-control" name="user_name" autocomplete="off" value="" placeholder="Please enter the First Name" type="text">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Display Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="display_name" autocomplete="off" value="" placeholder="Please enter the Last Name" type="text">
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Title </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select id="input_locale" class="form-control" name="title" title="Locale" required>
                            <option value="Store" selected="">Store</option>
                            <option value="Driver">Driver</option>
                            <option value="Driver">Doctor</option>
                        </select>
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="email" autocomplete="off" value="" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Contact </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="contact" autocomplete="off" placeholder="" type="text">
                </div>
            </div>
        </div>
        
        
        
         </div>     
      
      
                <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Locale</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                        <select id="input_locale" class="form-control" name="locale" title="Locale">
                                                <option value="de_DE">de_DE</option>
                                                <option value="en_US" selected="">en_US</option>
                                                <option value="es_ES">es_ES</option>
                                                <option value="fr_FR">fr_FR</option>
                                                <option value="it_IT">it_IT</option>
                                                <option value="nl_NL">nl_NL</option>
                                                <option value="pt_BR">pt_BR</option>
                                                <option value="ro_RO">ro_RO</option>
                                                <option value="th_TH">th_TH</option>
                                                <option value="tr_TR">tr_TR</option>
                                            </select>
                </div>
            </div>
        </div>
                  
            </div><br>
           <div class="modal-footer">
    		<div class="row">
        		<div class="creatUserBottom">
                    <div class="">
                		<div class="vert-pad">
                    		<button type="submit" name="update" class="btn-green">Create User		</button>
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


<div class="modal fade" id="dialog-user-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" >Change User Password</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
        <form name="user_password" method="post" action="" novalidate="novalidate">
            <!-- Prevent browsers from trying to autofill the password field.  See http://stackoverflow.com/a/23234498/2970321 -->
            <input style="display:none" type="text">
            <input style="display:none" type="password">         
            <div id="form-alerts">
            </div>
            <div class="row">           
                <div class="col-sm-12">
                    <div class="radio">
                        <label>
                          <input name="change_password_mode" id="change_password_mode_link" value="link" checked="" type="radio">
                          <input name="flag_password_reset" value="1" type="hidden">
                          Send the user a link that will allow them to choose their own password
                        </label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="radio">
                        <label>
                          <input name="change_password_mode" id="change_password_mode_manual" value="manual" type="radio">
                          Set the user's password as:
                        </label>
                    </div>
                    <div class="row controls-password">           
                        <div class="col-sm-125">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input class="form-control" name="password" autocomplete="off" value="" placeholder="8-50 characters" disabled="" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input class="form-control" name="passwordc" autocomplete="off" value="" placeholder="Confirm password" disabled="" type="password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="creatUserBottom">
                    <div class="">
                        <div class="vert-pad">
                            <button type="submit" class="btn-green">
                                Submit
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
      