<style type="text/css">
    .canvasjs-chart-credit{
        display: none;
    }
   .panel-default>.panel-heading{
        cursor: pointer;
   }
</style>
 <div id="page-wrapper">
            <?php
	@$success_msg = $this->session->flashdata('successmessage');
	if (!empty($success_msg)) {
		echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
		echo $this->session->flashdata('successmessage') . "</div>";
	}
	@$error_msg = $this->session->flashdata('errormessage');
	if (!empty(@$error_msg)) {
		echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
		echo $this->session->flashdata('errormessage') . "</div>";
	}
	?>
            <!-- /.row -->
         <?php $this->load->view('ondemand/new-sidebar'); ?>
            <!-- /.row -->
            <div class="row">
                  <div class="col-lg-8">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" >
                                <li class="active"><a href="#calendars" data-toggle="tab" id="salesClick">&nbsp; Sales Graph</a>
                                </li>
                                <li ><a href="#graphs" data-toggle="tab" id="ratingClick">&nbsp; Certified Providers</a>
                                </li>
                                <li class="dateShow"><input type="text" name="start_date" id="rating_date" style="border: 1px solid #ccc;padding:6px;margin: 3px;width: 90px;" required=""><input type="text" name="end_date" id="rating_date1" style="padding:6px;margin: 3px;width: 90px;border:1px solid #ccc;" required=""><input type="submit" name="Get Reviews" id="rating_submit" style="padding: 6px;color: white;background: #10b1ac;border: none;"></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="calendars">
                                   <div class="panel-body">
                                        <div id="salesgraph" style="height: 400px; width: 100%;"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="graphs">
                                   <div class="center-box text-center">
                                    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                                </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
                            	<?php 
                                if(count($notification) >0){
                                foreach($notification as $noti){
                            		echo '<a href="#" class="list-group-item">
											<i class="fa fa-envelope fa-fw"></i> <b>'.$noti['user_name'].'</b><br>'.$noti['message'].'
											<span class="pull-right text-muted small"><em>'.$noti['created_at'].'</em>
											</span>
										  </a>';
                            	} 
                            }else{
                                echo "All are Read Messages";
                            }?>
                                
                            </div>
                             <a href="<?php echo base_url(); ?>panels/supermacdaddy/ondemand/notifications" class="btn btn-default btn-block">View All Alerts</a>
                            <!-- /.list-group -->
                           
                        </div>

                   

                    </div>
                <h4 style="text-align: center;color: black;font-weight: bold;text-transform: uppercase; background-color: white;padding: 10px;margin: 0px;">Chat list</h4>
                             <div class="panel panel-default chatlistData">
                                   <div class="panel-heading adi-head-orange2">
                                   Loading....
                                    </div>
                            </div>
					</div>
                    <div class="clearfix"></div>
                    <div class="row " id="scr">
                        <?php 
                        $adminCount=count($allAdmins); 
                        if($adminCount > 0){ 
                            foreach ($allAdmins as $all) { ?>
                                 <div class="col-md-4 pull-right allchatboxes" id="chatpanel<?=$all->id?>" style="display: none;" >
                                        <div class="chat-panel panel panel-default">
                                        <div class="panel-heading adi-head-orange2">
                                            <i class="fa fa-comments fa-fw"></i> Admin Chat  <?=ucfirst($all->email)?>
                                             <a class="close" data-dismiss="alert" aria-label="close" onclick="getCloseChatPanel('<?=$all->id?>')">&times;</a>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <ul class="chat" id="chat-messages-inner<?=$all->id?>">
                                               There is a No Messages
                                            </ul>
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
                    
                  
                   
                       
                       
 <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>--> 

<script>
$("#chat-messages-inner").animate({ scrollTop: $(document).height() }, "slow");

	
$(document).ready(function(){
	setInterval(function(){
	$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/chat_history",
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
	}, 2000);
	


}); 

$(document).ready(function(){
    setInterval(function(){
    $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/getChatLIst",
            data: "",
            success: function(response)
            {
               // alert('hi');
              $(".chatlistData").html(response);
          
       
          
            } 
     
        });
    }, 2000);
    


}); 
</script> 

<!--common script for all pages--> 

  
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
	/*$( "#send" ).click(function() {*/
	$( ".send" ).click(function() {
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
			url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/sendmassage",
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
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/sendmassage",
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

    function getChatPanel(id){
      var chatid="#chatpanel"+id;
      var chatmessage="#chat-messages-inner"+id;
       //$('.allchatboxes').hide();
      $(chatid).show();
      $("html, body").animate({ scrollTop: $(document).height() }, 1000);
      $("#chatmessage,.panel-body").animate({ scrollTop: 5*$(document).height() }, 1000);
    }
      function getCloseChatPanel(id){
      var chatid="#chatpanel"+id;
      $(chatid).hide();
    }
   
</script>    
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
<?php
 
// $dataPoints = array( 
//     array("y" => 700,"label" => "1 Stars" ),
//     array("y" => 1200,"label" => "2 Stars" ),
//     array("y" => 2800,"label" => "3 Stars" ),
//     array("y" => 1800,"label" => "4 Stars" ),
//     array("y" => 4100,"label" => "5 Stars" )
// );
$dataPoints=$ratingArray;
$getSalesGraphData=$getSalesGraph;
 
?>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title:{
        text: "Certified Providers"
    },
    axisY: {
        title: "Users",
        prefix: "",
        suffix:  ""
    },
    data: [{
        type: "bar",
        yValueFormatString: "#,##0",
        indexLabel: "{y}",
        indexLabelPlacement: "inside",
        indexLabelFontWeight: "bolder",
        indexLabelFontColor: "white",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});


var charts = new CanvasJS.Chart("salesgraph", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "Sales Graph"
    },
    axisY: {
        title: "Product sales"
    },
    data: [{        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Product Names",
        dataPoints: <?php echo json_encode($getSalesGraphData, JSON_NUMERIC_CHECK); ?>
    }]
});
charts.render();


chart.render();
 
}
</script>
<script type="text/javascript">
$( document ).ready(function() {
    $('.dateShow').hide();
   $('#ratingClick').click(function(){
      $('.dateShow').show();
    })
   $('#salesClick').click(function(){
      $('.dateShow').hide();
    })
});

    
</script>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>       