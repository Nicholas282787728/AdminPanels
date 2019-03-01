<div id="page-wrapper">
		   <?php 
     $this->load->view('admin/top_tab_header');
  ?>

             <div class="row">
        <div class="col-lg-12">
            
            <div id="msg_success_ajax"></div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
                    <h3 class="panel-title pull-left"><i class="fa fa-users"></i> Document Verfication</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="first-row">
                                    <th>User Name</th>
                                    <th>Contact#</th>
                                    <th>User Email </th>
                                    <th>User Type</th>
                                    <th>Registered Since</th>
                                    <th>Documents/Links</th>
                                    <th>Status/action</th>                                        
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // echo "<pre>"; print_r($all_data);
                                // die();
                              
                                 foreach($all_data as $val){
                                    
                                    ?>

                                <tr class="odd gradeX" >
                                    <td><?php echo $val['user_name'];?></td>
                                    <td><?php echo $val['mob_number'];?></td>
                                    <td><?php echo $val['email'];?></td>
                                    <td><?php
                                     
                                    if(!empty($val['prescription'])){
                                        echo "PATIENT";
                                    }
                                    else{
                                        echo "RECREATIONAL";
                                    }
                                    ?></td>
                                    
                                    <td><?php echo $val['created_at'];?></td>

                                    <td>
        

                                       
                                        <img width="55px" src="<?php echo $val['prescription']; ?>">

                                        <img width="55px" src="<?php echo $val['stateId']; ?>">
                                    
                                      


                                    </td>
                                    <td class="center">
                                        <?php if($val['status']==1){
                                                                                
                                    }else if($val['status']==0) {
                                         echo ' <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            View
                                            <span class="caret"></span>
                                        </button>            
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <form action="" method="post">
                                            
                                            <input type="hidden" name="activeUserId" value="'.$val['ind'].'">
                                            <button style="padding: 1px 20px;border: none;background: transparent;" type="submit" name="active"   class="js-user-disable">
                                         Yes 
                                            </button>
                                            </form>
                                        </li>
                                       
                                </ul>
                            </div>';

                                            
                                            }
                                            ?>
                                    </td>
                                   

                                </tr>


 
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
 </div>




