 
         <div id="page-wrapper">
            <?php $this->load->view('storefronts_templates/new-sidebar'); ?>
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
    </div>
    </div>
 
            <div class="row">

                <div class="col-lg-12">
                   <?php 
                        if(count($payout) > 0){
                            $id           =$payout->payout_id;
                            $bank_name    =$payout->bank_name;
                            $info_form    =$payout->info_form;
                            $info_banking =$payout->info_banking;
                            $paypal_name  =$payout->paypal_name;
                            $paypal_email =$payout->paypal_email;
                            $payout_id    =$payout->payout_id;
                            $application  ="Update";
                        }else{
                            $application  ="Add";
                            $bank_name    ="";
                            $payout_id    ="";
                            $id           ="";
                            $info_form    ="";
                            $info_banking ="";
                            $paypal_name  ="";
                            $paypal_email ="";
                        }

                        ?>

                    <div class="panel panel-default">

                        <div class="panel-heading" style="font-weight:bold;">
                           <i class="fa fa-edit"></i><?=$application;?> Payout Details
                        </div>



                        <!-- /.panel-heading -->

      <div class="panel-body">

         <form name="user" method="post" action="" id="formzip">
          <div id="form-alerts"></div>
                    
          <div class="row">
                      <div class="col-sm-6">

                        <div class="bankdetail">

            <div class="col-sm-12">
              <div class="form-group">
                <label>Name of Bank</label>
                <input class="form-control bankName ba"  name="bank_name" autocomplete="off" value="<?=$bank_name?>" type="text" placeholder="Name of Bank">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Bank Account Number</label>
                <input class="form-control bankName bb" name="info_form" autocomplete="off" value="<?=$info_form?>" type="text" placeholder="Bank Account Number" >
                  <input type="hidden" name="payout_id" value="<?=$payout_id?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Bank Routing Number</label>
                  <input class="form-control bankName bc" name="info_banking" autocomplete="off" value="<?=$info_banking?>" type="text" placeholder="Bank Routing Number" >
              </div>
            </div>     
                  
                    </div>

                    <div class="paypaldetail">

            <div class="col-sm-12">
              <div class="form-group ">
                <label>Paypal Name</label>
                  <input class="form-control paypalName pa" name="paypal_name" autocomplete="off" value="<?=$paypal_name?>" type="text" placeholder="Paypal Name" >
              </div>
            </div>
                     
            <div class="col-sm-12">
              <div class="form-group ">
                <label>Paypal Email </label>
                  <input class="form-control paypalName pb" name="paypal_email" autocomplete="off" placeholder="Paypal Email" value="<?=$paypal_email?>" type="text" >
              </div>
            </div> 
              
</div> 
 <h3 class="alert-danger-bank"></h3>   


            </div>
                      
                <div class="col-sm-6 logo-upload" >
                    <div class="col-sm-12">
                     <table class="table table-striped table-bordered table-hover custom-table table-responsive">
                       <thead>
                         <tr>
                           <th>Total Services</th> 
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <td>Total Buyers - <?php echo count($orders);?></td> 
                         </tr>
                       </tbody>
                       <!-- <tbody>
                         <tr>
                           <td>Total Deiviries - 10239</td> 
                         </tr>
                       </tbody>
                       <tbody>
                         <tr>
                           <td>Total Deiviries - 10239</td> 
                         </tr>
                       </tbody> -->
                     </table>
                     <br>
                      <table class="table table-striped table-bordered table-hover custom-table table-responsive">
                       <thead>
                         <tr>
                           <th> Earnings</th> 
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <td>Gross Earning - $<?php $Gross=$payments->total_amount; echo $Gross; ?></td> 
                         </tr>
                       </tbody>
                       <tbody>
                         <tr>
                           <td>Certified Provider Fee - $<?php $Certified=$payments->total_amount*10/100; echo $Certified; ?></td> 
                         </tr>
                       </tbody>
                       <tbody>
                         <tr>
                           <td>Net Earning - $<?php echo  $Gross-$Certified; ?></td> 
                         </tr>
                       </tbody>
                     </table>
                   </div>
                </div>
            
          </div><br>
          <div class="row pull-left">
            <div class="creatUserBottom ">
               
                <div class="">
                <div class="vert-pad">
                  <?php if(!empty($id)) {  ?>
                  <button type="submit" name="update" class="btn-green">Update Payout Details </button>
                   <?php }else{ ?>
                    <button type="submit" name="save" class="btn-green">Save Payout Details</button>
                   <?php  }?>
                
                </div>          
              </div>
              <div class="">
              <div class="vert-pad" style="margin-top: 15px;text-decoration: none !important;">
                    <a href="<?=base_url();?>" class="btn-grey" data-dismiss="modal" style="    padding: 11px 12px 9px 12px;">Cancel</a>
                  </div>
              </div>
            </div> 
          </div>
        </form>

                        

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->
<script type="text/javascript">
  $(document).ready(function(){
  $(".paypalName").keyup(function(){
            var data = $('.paypalName').val();
            if(data.length != ''){
              $('.bankName').val('');
         
            $('.bankdetail').css('display','none');
            }
            else{
                $('.bankdetail').css('display','block');
            }
        });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $(".bankName").keyup(function(){
            var data = $('.bankName').val();
            if(data.length != ''){
              $('.paypalName').val('');
         
            $('.paypaldetail').css('display','none');
            }
            else{
                $('.paypaldetail').css('display','block');
            }
        });
});
</script>
               <script>
// $('#formzip').on('submit',function(){
//    if(($('.ba').val()=='') || ($('.bb').val()=='') || ($('.bc').val()=='')) 
//    {
  
//         $('.alert-danger-bank').html('Please enter atleast one detail');
//        return false;
//      }
//      else{
//        return true;
//            if(($('.pa').val()=='') && ($('.pb').val()==''))
// {
  
//         $('.alert-danger-bank').html('Please enter atleast one detail1');
//        return false;
//      }

//      }



 
//    });
</script>