<style type="text/css">
    .form-list-item{
        background: transparent;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        border: 0px;
        text-align: center;
    }
    tbody tr td > div a.form-list-item{color: #000;border-top: 1px;}
</style>
<div id="page-wrapper">
	    <?php $this->load->view('partner/new-sidebar'); ?>         
    <div class="row">
        <div class="col-lg-12">
           <div class="panel panel-default">
                <div class="panel-heading title-bar-blue" style="padding-bottom:20px;">
                    <i class="fa fa-users" aria-hidden="true"></i>  My Sign Up Documents
                    
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table width="100%" class="table customise-table tablesorter table-striped table-bordered table-hover" id="dataTables-example">
                             <thead>
                                    <tr>
                                        <th>S.No </th>
                                               
                                        <th>Document Name</th>
                                        <th>File attached</th>
                                      <!--   <th>Status </th> -->
                                        <th>Date & Time stamp</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                      <?php $i=1; foreach ($uploadDocuments as $row) { ?>

                                            <?php 




                                                    $query = $this->db->query("SELECT created_at from `uf_user_documents`  where user_id = '".$this->session->userdata('id')."'"); 
            $docresult=$query->row(); 


                 ?>

                             
                                
                       
                                    <tr class="odd">

                                        <td><?php echo $i++; ?></td>
                                                
                                        <td>
                                            <?php
                                                $link_name = explode( '.', $row->document);
                                                echo $link_name[0];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $filename = 'uploads/'.$row->document;
                                            if (file_exists($filename)) {
                                            ?>
											<img src="<?php echo base_url();?>uploads/<?=$row->document?>" width="100px" height="100px"/>
                                            <a href="<?php echo base_url();?>uploads/<?=$row->document?>" target="_blank">View Document</a>
                                            <?php 
                                            }
                                            ?>
                                        </td>
                                 
                                         <td><?php if(!empty($docresult)) { echo $docresult->created_at; } else {  echo '';}  ?></td>
                           
                                  <!--       <td >
                                        <?php
                                
                            //              echo ' <div class="btn-group">
                            //             <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            //                 Action
                            //                 <span class="caret"></span>
                            //             </button> 

                            //         <ul class="dropdown-menu" role="menu">
                            //             <li>
                            //             <form action="" method="post">
                            //                <button class="form-list-item" onclick="return confirm(\'Are you sure you want to delete the user \');" type="submit" name="delete_product" value="'.$row->id.'">
                            //                            Trash  </button>
                            //                            </form>

                            //             </li>
                            //             <li>
                            //             <form action="" method="post">
                            //             <a class="form-list-item edit_document" href="javascript:;" data-id="'.$row->user_document_id.'">
                            //                               Notes
                            //                             </a>
                            //                             </form>
                            //             </li>
                            //     </ul>
                            // </div>';

                                            
                                            
                                            ?>
                                    </td> -->
                                        <td>

                                        <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        Action
                                        <span class="caret"></span>
                                        </button>            
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                            <button style="padding: 4px 10px;border: none;background: transparent;" type="button" data-toggle="modal" data-target="#edit_document<?php echo $row->id; ?>" >
                                        <i class="fa fa-edit"></i> Edit 
                                            </button>
                                            </li>
                                                    <li>    
                                             
                                              <form action="" method="post">
                                       <button style="padding: 4px 10px;border: none;background: transparent;" onclick="return confirm('Are you sure you want to delete the record ');" type="submit" name="delete_product" value="<?php echo $row->id; ?>">
                                                 <i class="fa fa-trash-o" aria-hidden="true"></i>   Trash  </button>
                                 
                                                       </form>
                                                        
                                                    </li>
                                              <!--   <li>
                                                <button style="padding: 4px 10px;border: none;background: transparent;" type="button" name="enable" value="" id="enable"  class="js-share-email" data-id="<?php echo $row->id; ?>">
                                                <i class="fa fa-minus-circle"></i>  share 
                                                </button>
                                                </li> -->

                                    
                                        </ul>
                                    </div>



                                
                                </td> 
                                    </tr>
                                    <div class="modal fade" id="edit_document<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header title-bar-orange">
                <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Sign Up Documents </h5>
                <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  method="post" action=""  enctype="multipart/form-data" >
                    <div id="form-alerts"></div>
                    <div class="row">
                       <!--  <div id="edit_document_data"> -->
                            <div class="col-sm-12">
                    <input class="form-control " type="hidden" name="document_id" readonly="" value="<?php echo $row->id; ?>" required="" >
                    <input class="form-control " type="hidden" name="document_name" readonly="" value="<?php echo $row->document_name; ?>" required="" >
                 
                    <div class="form-group">
                        <label>Attach File </label>
                        <div class="input-group">
                            <input type="file" name="image" >
                            <img width="70px" src="<?php echo base_url(); ?>uploads/<?php echo $row->document; ?>">
                            <input type="hidden" name="old_image" value="<?php echo $row->document; ?>" >
                        </div>
                        <textarea class="form-control ckeditor" name="notes" row="10"  cols="50"><?php echo $row->notes; ?></textarea>
                    </div>
                </div>
                      <!--   </div> -->
                    </div><br>
                    <div class="row modal-footer">
                        <div class="creatUserBottom ">
                            <div class="">
                                <div class="vert-pad">
                                    <button type="submit" name="updatedocument" class="btn-green" >Update Document</button>
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
            </div>
        </div>
    </div> 
</div>
                                    <?php } ?>
                                    
                           
                                </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<!--/Edit data/-->

    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

<!-- <script>
    $('.edit_document').click(function(){
        var document_id=$(this).attr('data-id');
        $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/storefronts/edit_signupdocuments",
            data: "&document_id="+document_id,
            success: function(response){
                $("#edit_document_data").html(response);
                $('#edit_document').modal('show')   
            } 
        });
    })
</script> -->