
<style>
	#chat_history li{
		    list-style-type: none;
			padding: 3%;
			border: 1px solid #d8d7d7;
	}
	#chat_history .pull-right{
		    margin-right: 1%;
	}
	#chat_history .pull-left{
		    margin-right: 1%;
	}
	
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
			<?php
			@$success_msg = $this->session->flashdata('success_msg');
			if (!empty($success_msg)) {
				echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('success_msg') . "</div>";
			}
			@$error_msg = $this->session->flashdata('error_msg');
			if (!empty(@$error_msg)) {
				echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
				echo $this->session->flashdata('error_msg') . "</div>";
			}
			?>
			<div class="panel panel-default">
                <div class="panel-heading panel-heading-buttons clearfix title-bar-blue">
					<h3 class="panel-title pull-left"><i class="fa fa-users"></i> View Users Chat</h3>
					<div class="pull-right">
					</div>
				</div>
                <div class="panel-body">
					<div class="table-responsive">    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
									<th>User/Info</th>
									<th>Last Message</th>
									<th>Action</th>
							    </tr>
                            </thead>
                            <tbody>
								<?php 
								foreach($lastuser as $view)
								{ ?>
								<tr>
									<td> <b><?=$view['user_name']?></b> (<?=$view['email']?>)</td>
									<td><?=$view['message']?></td>
									<td><button class="btn listchat_popup" data-userid="<?=$view['id']?>" data-email="<?=$view['email']?>">View</button></td>
								</tr>
								<?php
								}
								?>
                            </tbody>
                        </table>
                    </div>    
					
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chat History : <span id="chat_history_email"></span> </h4>
        </div>
        <div class="modal-body">
          <!--<p>Some text in the modal.</p>-->
		  <div id="chat_history" style="padding: 5%; border: 3px solid #d8d7d7; max-height: 400px; overflow: scroll;" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<script>
$('.listchat_popup').click(function(){
	var id = $(this).attr('data-userid');
	var email = $(this).attr('data-email');
	$.ajax({
		type:"post",
		url: "<?=base_url()?>panels/supermacdaddy/Dashboard/chat_history_userwise",
		data: "id="+id,
		dataType:"JSON",
		success: function(data){
		 $('#chat_history').html(data.success);
		 $('#chat_history_email').html(email);
		}
	});
	$('#myModal').modal('show');
})	
</script>