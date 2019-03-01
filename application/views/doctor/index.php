
<style>
	.fade{
		display:none;
	}
	.fade.in{
		display:block;
	}
	#grpah {
		display: block;
	}
	.dashboard-panel .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
		background-color: #56bddc !important;
	}
	.dashboard-panel .nav-tabs > li > a {
		background-color: #33a8cb ;
		color: #fff;
		margin-right: 0px;
	}
	.panel-heading{
		height: 80px;
		max-height: 80px;
	}
</style>
         <div id="page-wrapper">
   <?php $this->load->view('doctor_templates/new-sidebar'); ?>
 
            <div class="row">
               <div class="col-lg-8">
				   <div class="panel panel-default dashboard-panel">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#Calendara" data-toggle="tab"><i class="fa fa-bar-chart-o fa-fw"></i> Calendar</a></li>
							<li><a href="#grpah" data-toggle="tab"><i class="fa fa-bar-chart-o fa-fw"></i> Graph</a></li>
						</ul>
						<div class="adi-head-blue2"></div>

						<div class="panel-body">
							<div class="tab-pane fade" id="grpah">
								<div id="morris-area-chart" style="height: 0px;"></div>
							</div>
							<div class="tab-pane fade in active" id="Calendara">
								<div align="right">
									<button class="btn" id="my-prev-button">Preivous</button>
									<button class="btn" id="my-next-button">Next</button>
								</div>
								<div id="calendar"></div>
							</div>
							
						</div>
					</div>
			   </div>

				<div class="col-lg-4">
					<h4 style="text-align: center;color: black;font-weight: bold;text-transform: uppercase; background-color: white;padding: 10px;margin: 0px;">Chat list</h4>
					<div class="panel panel-default">
						<?php $adminCount=count($allAdmins); 
						if($adminCount > 0){
							foreach ($allAdmins as $all) { ?>
								<div class="adi-head-orange2" onclick="getChatPanel('<?=$all->id?>');" style="background-color: green !important;cursor:pointer;">
								<i class="fa fa-comments fa-fw"></i> Admin Chat  <?=ucfirst($all->email)?>
								</div>
							<?php }
						}
						?>
					</div>
					
				</div>
				
				
				<div class="col-lg-12">
					<div class="row " id="scr">
						<?php 
						$adminCount=count($allAdmins); 
						if($adminCount > 0){ 
							foreach ($allAdmins as $all) { ?>
								<div class="col-md-4 pull-right allchatboxes" id="chatpanel<?=$all->id?>" style="display: none;" >
									<div class="chat-panel panel panel-default">
										<div class="panel- adi-head-orange2">
											<i class="fa fa-comments fa-fw"></i> Admin Chat  <?=ucfirst($all->email)?>
											<a class="close" data-dismiss="alert" aria-label="close" onclick="getCloseChatPanel('<?=$all->id?>')">&times;</a>
										</div>
										<!-- /.panel-heading -->
										<div class="panel-body">
											<ul class="chat" id="chat-messages-inner<?=$all->id?>">There is a No Messages</ul>
										</div>
										<div class="panel-footer">
											<form action="" id="msg<?=$all->id?>" name="msg<?=$all->id?>" enctype="multipart/form-data" method="post" onsubmit="return false;">
												<div class="input-group">
													<input  name="message"  id="message<?=$all->id?>"  style="padding:15px; height:auto;" class="form-control input-sm" placeholder="Type your message here..." type="text">
													<input type="hidden" name="id" value="<?=$all->id?>">
													<span class="input-group-btn">
														<button type="submit" class="btn btn-warning btn-sm adi-head-orange " id="btn-chat" onclick="messageSend('<?=$all->id?>');">
															<span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
														</button>
													</span>
												</div>
											</form>
										</div>
									</div>
								 </div>
							<?php }
						}
						?>
					</div>
					</div>
				
				
				
				
			</div>
			<div class="clearfix"></div>
			
	<!-- Modal -->
<div class="modal fade" id="get_user_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header title-bar-orange">
				<h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><span class="usernamepopup"></span> Details</h5>
				<button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form name="user" method="post" action="" >
					<div id="form-alerts">
					</div>
					<div class="row">
						<div class="view_user_details">

						</div>     

					</div><br>
					<div class="modal-footer">
						<div class="row">
							<div class="creatUserBottom">
								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey" data-dismiss="modal">Close</button>
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
			 
			 
<script>
	$("#chat-messages-inner").animate({ scrollTop: $(document).height() }, "slow");	
	$(document).ready(function(){

		setInterval(function(){
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/doctor/chat_history",
				data: "",
				success: function(response)
				{
					/*alert(response);*/
					var responses=$.parseJSON(response);
					$.each(responses, function(key, value) {
						//For example
						 $("#chat-messages-inner"+key).html(value);
					});

					if(response==""){
						$(".settle-btn").css("display","none");
					}else{
						$(".settle-btn").css("display","block");
						if(response!=""){
							$("#settleyes").html(response);	
							$("#settlerequest").attr('disabled', true);
						}else{
							$("#settleyes").html("Yes It's Settle ?");
						}
					}
				}
			});
		}, 6000);
	
		/*$( "#send" ).click(function() {*/
		$( "#send" ).click(function() {
			var meg	 	=	$("#message").val();

			//var file1		=	$("#file1").val();
			var errorcount=0;
			if($("#message").val() ==""){
				$("#message").focus();
				$("#message").css({ 'border': "1px solid #ff0000" });
				errorcount=1;
			} else {
				$("#message").css({ 'border': "1px solid #d1d1d1" });
			}
			 if(errorcount==1)
			{
				return false;
			}
			var form =document.getElementById("msg");

			var datastring = $("#msg").serialize();
			$.ajax({
				type: "post",
				url:"<?php echo base_url();?>panels/supermacdaddy/doctor/sendmassage",
				data: new FormData(form),
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data)
				{
					document.getElementById("msg").reset();
				}
			});
		});
	});	

	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/doctor/getId",
		data: "",
		success: function(response)
		{
		   $('.send_id').val(response);
		}
	});
 
	function getChatPanel(id){
		var chatid="#chatpanel"+id;
		var chatmessage="#chat-messages-inner"+id;
		 //$('.allchatboxes').hide();
		$(chatid).show();
		$("html, body").animate({ scrollTop: $(document).height(100) }, 300);
		$("#chatmessage,.panel-body").animate({ scrollTop: $(document).height(100) }, 300);
	}

	function getCloseChatPanel(id){
		var chatid="#chatpanel"+id;
		$(chatid).hide();
	}
		
	function sendMessageClick(id){
		$('.send_id').val(id);
		$.ajax({
			 type: "post",
			 url:"<?php echo base_url();?>panels/supermacdaddy/doctor/getuserdetails",
			 data: {id:id},
			dataType: "json",
			 success: function(response)
			 {
				$(".view_user_details").html(response.result);
				$(".usernamepopup").html(response.username);
				$('#get_user_details').modal('show')   
			 }
       });
	}
    
	function messageSend(id){
		var meg       =   $("#message"+id).val();
        //var file1     =   $("#file1").val();
        //alert(meg);
        var errorcount=0;
             
        if($("#message"+id).val() ==""){
            $("#message"+id).focus();
            $("#message"+id).css({ 'border': "1px solid #ff0000" });
            errorcount=1;
        } else {
            $("#message"+id).css({ 'border': "1px solid #d1d1d1" });
        }
        if(errorcount==1)
        {
            return false;
        }
        
        var form =document.getElementById("msg"+id);
        var datastring = $("#msg"+id).serialize();
        console.log(datastring);
            //var form=$("#msg");
        $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/doctor/sendmassage",
            //data: datastring+"&message="+meg,
            data: new FormData(form),
            contentType: false,       
            cache: false,            
            processData:false,
            success: function(data)
            {
				//alert(response);
				console.log(data);
				/*$("#mesage").html(response);*/
				document.getElementById("msg"+id).reset();
            }
        });
    }
	
	$(document).on('click', '.chat li' ,function() {
		if($(this).hasClass('blue')){
			//$(this). removeClass('blue');
			 $('.chat li').removeClass('blue');
		}
		else
		{  
			$('.chat li').removeClass('blue');
			$(this).addClass('blue');
		}
	});

</script> 