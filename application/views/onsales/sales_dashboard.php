 <div id="page-wrapper">
            
            <!-- /.row -->
            <div class="row dash-icon">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i  style="color:#FF8961;"class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo count(@$salcount['sales']);?></div>
                                    <div class="font-small">Sales Staff Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-orange">
                                <span class="pull-left"><a href='panels/supermacdaddy/sales'>View Details</a></span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i  style="color:#56BDDC;"class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo @$salcount['users'];?></div>
                                    <div class="font-small">Certified Providers Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-blue">
                                <span class="pull-left"><a href='#' class="" data-toggle="modal" data-target="#exampleModal">View Details</a></span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <i  style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div class="font-small">Affiliate Partners Panel</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-per">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                     <i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div class="font-small">Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer adi-head-green">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading adi-head-blue2">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default btn-normal2" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading adi-head-per2">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                            	<?php foreach($notification as $noti){
                            		echo '<a href="#" class="list-group-item">
											<i class="fa fa-envelope fa-fw"></i> <b>'.$noti['user_name'].'</b><br>'.$noti['message'].'
											<span class="pull-right text-muted small"><em>'.$noti['created_at'].'</em>
											</span>
										  </a>';
                            	} ?>
                                
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
					</div>
                   
                       
                       
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 

<script>
$("#chat-messages-inner").animate({ scrollTop: $(document).height() }, "slow");

	
$(document).ready(function(){
	setInterval(function(){
	$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/chat_history",
			data: "",
			success: function(response)
			{
			/*alert(response);*/
			console.log(response);

			$("#chat-messages-inner").html(response);
			if(response==""){
			$(".settle-btn").css("display","none");
			}else{
			$(".settle-btn").css("display","block");
			if(settle!=""){
				
			$("#settleyes").html(settle);	
			$("#settlerequest").attr('disabled', true);
			
			}else{
			$("#settleyes").html("Yes It's Settle ?");
			}
			}
			} 
	 
		});
	}, 2000);
	


}); 
</script> 

<!--common script for all pages--> 

  
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
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
			//var form=$("#msg");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/sendmassage",
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
			document.getElementById("msg").reset();
			} 
	 
		});
	});
});	
</script>    
<!-- 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Pannel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-primary">On-Demand</button></a>
		<a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-info">Storefronts</button></a>
		<a href="http://imvisile.com/med/public/" target="_blank"><button type="button" class="btn btn-success">Industry Doctors</button></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>   
 -->                 