<style type="text/css">
    .dataTables_length{
        display: none;
    }
    .dataTables_filter{
        display: none;
    }

</style>

<div id="page-wrapper" >
        <?php $this->load->view('storefronts_templates/new-sidebar'); ?>
        
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Favorites</p>
                </div> <!-- /.panel-heading -->
                <div class="panel-body">
                    <form action="" method="post" class="form-inline" style="display: inline-block;">
                      <div class="form-group">
                        <input type="text" name="random_code" placeholder="enter referral code" class="form-control">
                      </div>
                      <div class="form-group">
                        <input type="submit"  name="searchrandom_code" value="Search" class="btn btn-default">
                      </div>
                    </form>
                      <form action="" method="post" class="form-inline" style="display: inline-block;">
                   
                      <div class="form-group">
                        <select name="claimed" id="cars" class="form-control">
                          <option value="">Select</option>
                          <option value="daily">Daily</option>
                              <option value="weekly">Weekly</option>
                                  <option value="all">All</option>
                        </select>
                        <input type="submit" id="submit" style="display: none;"  value="Claimed" class="btn btn-default">
                      </div>
                    </form>

                    <div>

                        <div><br>
                          <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="first-row">
						
                                        <th>Sender name</th> 
                                        <!-- <th>Sender email</th> -->
                                        <th>Receiver name</th>
                                        <th>Receiver email</th>
                                        <!-- <th>Product Image</th>
                                        <th>Product Name</th> -->
                                        <th>Product Price</th>
                                        <th>Date/Time</th>
                                        <th>Claimed Date</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>





<?php if(!empty($giftedAllProducts)){


?>


  <tbody>
                                
                                   <?php 




                    $i = 1;
                    foreach($giftedAllProducts as $sale)
                    {  
                                            $imagUrl=$sale['image_url'];
                  ?>
                                    <tr class="odd gradeX">
                    <?php   $query = $this->db->query('SELECT user_name,email FROM `uf_user` WHERE  id = "' . $sale['sender_id'] . '" ');
        $resultsender = $query->result();

      
       ?> 
                                    <?php   $query1 = $this->db->query('SELECT user_name,email FROM `uf_user` WHERE  id = "' . $sale['user_id'] . '" ');
        $resultreceiver = $query1->result();
      
       ?> 
                                       <td><?php if(!empty($resultsender)){  echo $resultsender[0]->user_name;  }?></td> 
              
                          

                                       <td><?php if(!empty($resultreceiver)){  echo $resultreceiver[0]->user_name; } ?></td>
                            
                                        <td><?php if(!empty($resultreceiver)){  echo $resultreceiver[0]->email; } ?></td>
                                               
                                        <td><?php echo $sale['amt_d_price']; ?></td>
                                         <td><?php echo $sale['date'].' '.$sale['time']; ?></td>
                                          <td><?php echo $sale['claimeddate']; ?></td>


                                        
                    <td class="center">

                         <div class="btn-group">  
                                         
                                                     <button type="button" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                  Claimed
                                                    </button>
                                                                                             
                                        </td>
                                     
                                  </tr>
                                </tbody>

<?php

}
}
else {
  ?>









                                <tbody>
                                
                                   <?php 




                                   if(!empty($_REQUEST['searchrandom_code'])){
										$i = 1;
										foreach($giftedProducts as $sale)
										{  
                                            $imagUrl=$sale['image_url'];
									?>
                                    <tr class="odd gradeX">
										<?php   $query = $this->db->query('SELECT user_name,email FROM `uf_user` WHERE  id = "' . $sale['sender_id'] . '" ');
        $resultsender = $query->result();

      
       ?> 
                                    <?php   $query1 = $this->db->query('SELECT user_name,email FROM `uf_user` WHERE  id = "' . $sale['user_id'] . '" ');
        $resultreceiver = $query1->result();
      
       ?> 
                                       <td><?php if(!empty($resultsender)){  echo $resultsender[0]->user_name;  }?></td> 
							
                           <!--              <td><?php if(!empty($resultsender)){  echo $resultsender[0]->email; } ?></td> -->

                                       <td><?php if(!empty($resultreceiver)){  echo $resultreceiver[0]->user_name; } ?></td>
                            
                                        <td><?php if(!empty($resultreceiver)){  echo $resultreceiver[0]->email; } ?></td>
                                                   <!--  <td><img src="https://medconnex.net/demonil/uploads/<?php  echo $sale['image']; ?>" width="70px" height="70px"></td>  -->

                                                   
                                                  <!--  <td><img src="<?php  echo $sale['image_url']; ?>" width="70px" height="70px"></td> 
										<td><?php echo $sale['product_name']; ?></td> -->
                                        <td><?php echo $sale['amt_d_price']; ?></td>
                                         <td><?php echo $sale['date'].' '.$sale['time']; ?></td>
                                           <td><?php echo $sale['claimeddate']; ?></td>


                                        
										<td class="center">

                         <div class="btn-group actionbutton">  
                                            <?php if($sale['status'] == 0){ ?>
                                                
                                                 
                                                      
                                                        <button type="submit" class="btn btn-success pendingbutton" data-toggle="modal" data-target="#Modalbulk" >
                                                       Pending
                                                        
                                                        
                                                    </button>
                                                <?php } else if($sale['status'] == 1){ 
                                                    ?>
                                                     <button type="submit" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                  Claimed
                                                    </button>
                                                    <?php
                                                }
                                                 ?>                                              
                                        </td>
                                     <!--    <div class="btn-group open">  
                                            <?php if($sale['status'] == 0){ ?>
                                                
                                                    <button type="submit" class="btn btn-warning dropdown-toggle js-location-create" data-toggle="dropdown" aria-expanded="true">
                                                View
                                                 <span class="caret"></span>
                                                </button>
                                                
                                                <ul class="dropdown-menu" role="menu" style="min-width: 1px">
                                                    <li>
                                                      
                                                        <button type="submit" class="js-user-activate" data-toggle="modal" data-target="#Modalbulk" style="padding: 1px 20px;border: none;background: transparent;">
                                                       Approve
                                                        
                                                        
                                                    </button></li>
                                                     <li>
                                                      
                                                        <button type="submit" class="js-user-activate" data-toggle="modal" data-target="#Deny" style="padding: 1px 20px;border: none;background: transparent;">
                                                       Deny
                                                        
                                                        
                                                    </button></li>
                                                       <li>
                                                        <button type="submit" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                       Claim 
                                                    </button></li>
                                                  </ul>
                                                <?php } else if($sale['status'] == 1){ 
                                                    ?>
                                                     <button type="submit" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                  Completed
                                                    </button>
                                                    <?php
                                                }
                                                 else{ 
                                                    ?>
                                                     <button type="submit" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">
                                                  Rejected
                                                    </button>
                                                    <?php
                                                } ?>                                              
                                        </td> -->
                     
									 
										
										
									
									</tr>

    <div class="modal fade" id="Modalbulk" tabindex="-1" role="dialog" aria-labelledby="Modalbulk" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Gift Product Process</h5>
        <button style="width:6%;float:left;" type="button" class="close complete" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
        <form method="post" action="<?=base_url()?>storefronts/giftedProducts" enctype='multipart/form-data'>
            <div id="form-alerts">
            </div>
            <div class="row">
                <div class="">

                <div class="col-sm-12">
                    
                        <h2>Are You Sure. You Want To Complete This Product</h2>
                  
                </div>
            </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
            
             <div class="modal-footer">
              <div class="row">
                  <div class="creatUserBottom">
                      <div class="">
                          <div class="vert-pad">
                              <input type="button" name="complete_product" class="btn-green complete_product" data-id="<?php echo $sale['id']; ?>"  value="Complete">
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
        
        </div>
    </div>
</div>  

</div>

 <div class="modal fade" id="Deny" tabindex="-1" role="dialog" aria-labelledby="Modalbulk" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header title-bar-orange">
        <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Gift Product Process</h5>
        <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
        <form method="post" action="<?=base_url()?>storefronts/giftedProducts" enctype='multipart/form-data'>
            <div id="form-alerts">
            </div>
            <div class="row">
                <div class="">

                <div class="col-sm-12">
                    
                        <h2>Are You Want Deny This Product</h2>
                  
                </div>
            </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
            
             <div class="modal-footer">
              <div class="row">
                  <div class="creatUserBottom">
                      <div class="">
                          <div class="vert-pad">
                              <input type="submit" name="Deny_product" class="btn-green" value="Reject">
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
        
        </div>
    </div>
</div>  

</div>
                                   <?php $i++; } } ?>
                                </tbody>

                                  <?php
}
 ?> 

                            </table>
                            </div>
						
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
    $(".complete_product").click(function(){
    var id =$(this).attr("data-id");
var complete_product = 1;
    $.ajax({
      type: "post",
      url:"<?php echo base_url(); ?>storefronts/giftedProducts",
      data: {id:id,complete_product:complete_product},
      success: function(response){

        var yes = '<button type="submit" class="js-user-activate" style="padding: 1px 20px;border: none;background: transparent;">Claimed</button>';


              $('.actionbutton').append(yes);
              $('.pendingbutton').css('display','none');
              $('.complete').trigger('click');


              

       
      } 
   
    });
  });

</script>


      <script type="text/javascript">
                                  $(document).ready(function() {
                              $('#cars').on('change', function() {
                              $('#submit').click();
                             });
                          });
                                </script>



            