
<div class="container">

  <!-- Trigger the modal with a button -->

  <a id="abc"  data-toggle="modal" data-target="#myModal"></a>


  <!-- Modal -->
  <div class="modal fade calendarmodal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        	<div class="table-responsive">
        		<table class="table table-bordered email">
        			<tr>
        				<th colspan="3">Title</th>
        			</tr>

        		</table>
        	</div>
        	
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<div class="container">

  <!-- Trigger the modal with a button -->

  <a id="weekly"  data-toggle="modal" data-target="#myModal1"></a>


  <!-- Modal -->
  <div class="modal fade calendarmodal" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        	<div class="table-responsive">
        		<table class="table table-bordered email">
        			<tr>
        				<th colspan="3">Title</th>
        			</tr>

        		</table>
        	</div>	
        	
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  <a id="advertisment"  data-toggle="modal" data-target="#myModal1"></a>


  <!-- Modal -->
  <div class="modal fade calendarmodal" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        	<div class="table-responsive">
        		<table class="table table-bordered email">
        			<tr>
        				<th colspan="3">Title</th>
        			</tr>

        		</table>
        	</div>	
        	
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">  <!-- <h1 class="page-header">Promo Codes</h1> -->
			<?php
			@$success_msg = $this->session->flashdata('successmessage');
			if (!empty($success_msg)) {
				?>
				<div class="alert alert-success alert-dismissable">
	                <button type="button" class="close" data-dismiss="alert">&times;</button>
	                <strong>Success!</strong> <?php echo $this->session->flashdata('successmessage'); ?>.
				</div>
			<?php } elseif ($this->session->flashdata('errormessage')) { ?>
	            <div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Danger!</strong> <?php echo $this->session->flashdata('errormessage'); ?>.
				</div>
			<?php }
			?>
		</div>
    </div>

<?php $this->load->view('sales_templates/new-sidebar'); ?>

	<input type="hidden" class="cliccc" value="<?php echo $getCompActive[0]->count; ?>">


	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default dashboard-panel">
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<!-- Nav tabs -->
					<ul class="nav nav-tabs ">
						<li class="active"><a href="#calendars" data-toggle="tab">&nbsp; Calendar</a>
						</li>
						<li><a href="#calendarweeklys"  id="calendarweeklyaction" onclick="testRun()" data-toggle="tab">&nbsp; Sign Up's</a>
						</li>
						<li><a href="#calendargerenals"   onclick="gerenalRun()" data-toggle="tab">&nbsp; Advertisement</a>
						</li>

					</ul>
					<div class="adi-head-blue2"></div>
					<br/>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane fade in active" id="calendars">
							<div id="calendars" class="tab-pane fade in active">
								<div id="calendar"></div>
							</div>
						</div>
						<div class="tab-pane fade" id="calendarweeklys" style="min-height: 300px;">
							<div id="calendarweeklys" class="center-box text-right">
									<a class="export btn btn-primary" href="<?php echo base_url(); ?>sales/exportSignupUsers" style="margin-bottom: 10px;" >Export</a>
						
								<!-- <h3>Comming Soon</h3> -->
								<div id="calendarweekly"></div>
							</div>
							

						</div>
						<div class="tab-pane fade" id="calendargerenals" style="min-height: 300px;">
							<div id="calendargerenals" class="center-box text-right">  
								<a class="export btn btn-primary" href="<?php echo base_url(); ?>sales/exportAdvertisement" style="margin-bottom: 10px;" >Export</a>
								<!-- <h3>Comming Soon</h3> -->
								<div id="calendargerenal"></div>
							</div>
						</div>

					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
		<div class="col-lg-4" >
			<div class="chat-panel panel panel-default">
				<div class="panel-heading adi-head-per2">
					<i class="fa fa-user fa-fw"></i> Signed-In Contractors
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<ul class="chat">

						<?php
						if (!empty($allsalesContractors)) {
							foreach ($allsalesContractors as $view) {
								?>


								<li class="left clearfix">
									<span class="chat-img pull-left">
										<img src="<?php echo base_url(); ?>public/images/member.jpg" alt="User Avatar" class="img-circle" style="width:50px;height:50px " />
									</span>
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font">Name:<?= $view->user_name ?></strong>
											<small class="pull-right text-muted">
												<i class="fa fa-clock-o fa-fw"></i><?= $view->last_login ?>
												<!--12 mins ago-->
											</small>
										</div>
										<p>Date: <?= date('d/m/Y', strtotime($view->created_at)) ?>  </p>
										<p>Time: <?= date('h:i a', strtotime($view->created_at)) ?>  </p>
									</div>
								</li>
								<?php
							}
						} else {
							echo "contractors no found..";
						}
						?>



					</ul>
				</div>

			</div>
			<h4 style="text-align: center;color: black;font-weight: bold;text-transform: uppercase; background-color: white;padding: 10px;margin: 0px;">Chat list</h4>
			<div class="panel panel-default">
<?php
$salesCount = count($allsales);
if ($salesCount > 0) {
	foreach ($allsales as $all) {
		?>
						<div class="adi-head-orange2" onclick="getChatPanel('<?= $all->id ?>');" style="background-color: green !important; cursor: pointer;">
							<i class="fa fa-comments fa-fw"></i> Admin Chat  <?= ucfirst($all->email) ?>
						</div>
					<?php
					}
				}
				?>
			</div>



		</div>


	<!-- 	<div class="col-lg-8">

			<div class="panel panel-default ">
				<div class="panel-heading adi-head-blue2 content-bluegrp">
					<i class="fa fa-bar-chart-o fa-fw"></i> Charts :
					<button type="button" class="btn btn-primary tabcharts"   data-chartid="website-chart">Web site</button>
					<button type="button" class="btn btn-default tabcharts"   data-chartid="mobile-app-chart">Mobile App</button>
					<button type="button" class="btn btn-default tabcharts"   data-chartid="hootsuite-chart">Hootsuite</button>
					<div class="pull-right medconnex-tabcenter">
						<button type="button" class="btn btn-default ">Export</button>
						<button type="button" class="btn btn-default "  >Print</button>
					</div>

				</div>
				<div class="panel-body" >
					<div class="tab-content">
						<div class="tab-pane active">
							<div id="website-chart" class="chartuser updateidchart"></div>
						</div>
					</div>
				</div>
			</div>

		</div> -->




		<div class="col-lg-4">

		</div>
<!-- 		<div class="col-lg-8">

			<div class="panel panel-default ">
				<div class="panel-heading adi-head-blue2 content-bluegrp">
					<i class="fa fa-bar-chart-o fa-fw"></i> Charts :
					<button type="button" class="btn btn-primary tabcharts_2"   data-chartid="general-chart">General</button>
					<button type="button" class="btn btn-default tabcharts_2"   data-chartid="advert-app-chart">Advertisement</button>
					<div class="pull-right medconnex-tabcenter" style=" display: flex;">
						<form method="post" action="" id="fliter_form" style="margin: 0px;">
							<select class="form-control" name="fliter_type" id="fliter_change" >
								<?php $fliter_type = $this->input->post('fliter_type') ?>
								<option value="Daily" <?= ($fliter_type == 'Daily') ? 'selected' : '' ?>>Daily</option>
								<option value="Weekly" <?= ($fliter_type == 'Weekly') ? 'selected' : '' ?>>Weekly</option>
								<option value="Monthly" <?= ($fliter_type == 'Monthly') ? 'selected' : '' ?>>Monthly</option>
							</select>
						</form>
						<button type="button" class="btn btn-default ">Export</button>
						<button type="button" class="btn btn-default "  >Print</button>
					</div>
				</div>
				<div class="panel-body" >
					<div class="tab-content">
						<div class="tab-pane active">
							<div id="general-chart" class="updateidchart_2"></div>
						</div>
					</div>
				</div>
			</div>

		</div> -->
		<!-- /.col-lg-6 -->

		<div class="col-lg-12">
			<div class="row " id="scr">
				<?php
				$salesCount = count($allsales);
				if ($salesCount > 0) {
					foreach ($allsales as $all) {
						?>
						<div class="col-md-4 pull-right allchatboxes" id="chatpanel<?= $all->id ?>" style="display: none;" >
							<div class="chat-panel panel panel-default">
								<div class="panel- adi-head-orange2">
									<i class="fa fa-comments fa-fw"></i> Admin Chat  <?= ucfirst($all->email) ?>
									<a class="close" data-dismiss="alert" aria-label="close" onclick="getCloseChatPanel('<?= $all->id ?>')">&times;</a>
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<ul class="chat" id="chat-messages-inner<?= $all->id ?>">There is a No Messages</ul>
								</div>
								<div class="panel-footer">
									<form action="" id="msg<?= $all->id ?>" name="msg<?= $all->id ?>" enctype="multipart/form-data" method="post" onsubmit="return false;">
										<div class="input-group">
											<input  name="message"  id="message<?= $all->id ?>"  style="padding:15px; height:auto;" class="form-control input-sm" placeholder="Type your message here..." type="text">
											<input type="hidden" name="id" value="<?= $all->id ?>">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-warning btn-sm adi-head-orange " id="btn-chat" onclick="messageSend('<?= $all->id ?>');">
													<span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
												</button>
											</span>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function () {
		$('#fliter_change').change(function () {
			$("#fliter_form").submit();
		})

		$("#chat-messages-inner").animate({scrollTop: $(document).height()}, "slow");
	
		setInterval(function () {
			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/chat_history",
				data: "",
				success: function (response)
				{
					/*alert(response);*/
					var responses = $.parseJSON(response);
					$.each(responses, function (key, value) {
						//For example
						$("#chat-messages-inner" + key).html(value);
					});

					if (response == "") {
						$(".settle-btn").css("display", "none");
					} else {
						$(".settle-btn").css("display", "block");
						if (response != "") {
							$("#settleyes").html(response);
							$("#settlerequest").attr('disabled', true);
						} else {
							$("#settleyes").html("Yes It's Settle ?");
						}
					}
				}
			});
		}, 6000);

		/*$( "#send" ).click(function() {*/
		$("#send").click(function () {
			var meg = $("#message").val();

			//var file1		=	$("#file1").val();
			var errorcount = 0;
			if ($("#message").val() == "") {
				$("#message").focus();
				$("#message").css({'border': "1px solid #ff0000"});
				errorcount = 1;
			} else {
				$("#message").css({'border': "1px solid #d1d1d1"});
			}
			if (errorcount == 1)
			{
				return false;
			}
			var form = document.getElementById("msg");

			var datastring = $("#msg").serialize();
			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/sendmassage",
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data)
				{
					document.getElementById("msg").reset();
				}
			});
		});
		
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/getId",
			data: "",
			success: function (response)
			{
				$('.send_id').val(response);
			}
		});
		
		function getChatPanel(id) {
			var chatid = "#chatpanel" + id;
			var chatmessage = "#chat-messages-inner" + id;
			//$('.allchatboxes').hide();
			$(chatid).show();
			$("html, body").animate({scrollTop: $(document).height()}, 1000);
			$("#chatmessage,.panel-body").animate({scrollTop: 5 * $(document).height()}, 1000);
		}

		function getCloseChatPanel(id) {
			var chatid = "#chatpanel" + id;
			$(chatid).hide();
		}

		function messageSend(id) {
			var meg = $("#message" + id).val();
			//var file1     =   $("#file1").val();
			//alert(meg);
			var errorcount = 0;

			if ($("#message" + id).val() == "") {
				$("#message" + id).focus();
				$("#message" + id).css({'border': "1px solid #ff0000"});
				errorcount = 1;
			} else {
				$("#message" + id).css({'border': "1px solid #d1d1d1"});
			}
			if (errorcount == 1)
			{
				return false;
			}

			var form = document.getElementById("msg" + id);
			var datastring = $("#msg" + id).serialize();
			console.log(datastring);
			//var form=$("#msg");
			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/sendmassage",
				//data: datastring+"&message="+meg,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data)
				{
					console.log(data);
					document.getElementById("msg" + id).reset();
				}
			});
		}
		function sendMessageClick(id) {
			$('.send_id').val(id);
			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>panels/supermacdaddy/sales/getuserdetails",
				data: {id: id},
				dataType: "json",
				success: function (response)
				{
					$(".view_user_details").html(response.result);
					$(".usernamepopup").html(response.username);
					$('#get_user_details').modal('show')
				}
			});
		}
	});

	$(function () {
		chart1();
		$('.tabcharts').click(function () {
			var checkid = $(this).attr('data-chartid');
			$('.updateidchart').attr('id', checkid);
			$('#' + checkid).html('');
			$('.updateidchart').attr('id', checkid);

			$('.tabcharts').each(function () {
				$(this).removeClass("btn-primary");
				$(this).addClass("btn-default");
			});
			$(this).addClass("btn-primary");
			if (checkid == "website-chart") {
				chart1();
			} else if (checkid == "mobile-app-chart") {
				chart2();
			} else if (checkid == "hootsuite-chart") {
				chart3();
			}
		});


		function chart1()
		{
			Morris.Area({
				element: 'website-chart',
				data: [<?php
				foreach ($visit_graph_count as $value) {
					echo "{period: '" . $value['dates'] . "', daliy:'" . $value['daliy'] . "', weekly:'" . $value['weekly'] . "', monthly:'" . $value['monthly'] . "',},";
				}
				?>],
				xkey: 'period',
				ykeys: ['daliy', 'weekly', 'monthly'],
				labels: ['Daliy', 'Weekly', 'Monthly'],
				pointSize: 3,
				hideHover: 'auto',
				resize: true
			});
		}
		function chart2()
		{
			Morris.Area({
				element: 'mobile-app-chart',
				data: [<?php
				foreach ($visit_graph_count as $value) {
					echo "{period: '" . $value['dates'] . "', daliy:'" . $value['daliy'] . "', weekly:'" . $value['weekly'] . "', monthly:'" . $value['monthly'] . "',},";
				}
				?>],
				xkey: 'period',
				ykeys: ['daliy', 'weekly', 'monthly'],
				labels: ['Daliy', 'Weekly', 'Monthly'],
				pointSize: 3,
				hideHover: 'auto',
				resize: true
			});
		}


		function chart3()
		{
			Morris.Area({
				element: 'hootsuite-chart',
				data: [<?php
				foreach ($visit_graph_count as $value) {
					echo "{period: '" . $value['dates'] . "', weekly:'" . $value['weekly'] . "', monthly:'" . $value['monthly'] . "',},";
				}
				?>],
				xkey: 'period',
				ykeys: ['weekly', 'monthly'],
				labels: ['Weekly', 'Monthly'],
				pointSize: 2,
				hideHover: 'auto',
				resize: true
			});
		}

		chart21();
		$('.tabcharts_2').click(function () {
			var checkid = $(this).attr('data-chartid');
			$('.updateidchart_2').attr('id', checkid);
			$('#' + checkid).html('');
			$('.updateidchart_2').attr('id', checkid);

			$('.tabcharts_2').each(function () {
				$(this).removeClass("btn-primary");
				$(this).addClass("btn-default");
			});
			$(this).addClass("btn-primary");
			if (checkid == "general-chart") {
				chart21();
			} else if (checkid == "advert-app-chart") {
				chart22();
			}
		});

		function chart21()
		{


			Morris.Area({
				element: 'general-chart',
				data: [<?php
				foreach ($general_chart as $value) {
					echo "{period: '" . $value['dates'] . "', contractor:'" . $value['contractor_count'] . "', overallsales:'" . $value['overall_sales_count'] . "'},";
				}
				?>],
				xkey: 'period',
				ykeys: ['contractor', 'overallsales'],
				labels: ['Contractor', 'Overall Sales'],
				pointSize: 2,
				hideHover: 'auto',
				resize: true
			});
		}
		function chart22()
		{


			Morris.Area({
				element: 'advert-app-chart',
				data: [<?php
				foreach ($advertisement_chart as $value) {
					echo "{period: '" . $value['dates'] . "', contractor:'" . $value['contractor_count'] . "', overallsales:'" . $value['overall_sales_count'] . "'},";
				}
				?>],
				xkey: 'period',
				ykeys: ['contractor', 'overallsales'],
				labels: ['Contractor', 'Overall Sales'],
				pointSize: 2,
				hideHover: 'auto',
				resize: true
			});
		}
	});
</script>



 
<script>
	$(document).ready(function () {

		$('#calendar').fullCalendar({

			events: function(start, end, timezone, callback) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getGeneralSale",
					data: "",
					success: function (response)
					{
						var eventss = []
						var responses = $.parseJSON(response);
						responses.forEach(ele => {
							eventss.push({title: ele.completion, start: ele.compEndDate});
						});
						callback(eventss)
					}
				});
			},
			eventClick: function (event) {
				//alert(event.start);
				//document.getElementById('date').click();

			var enddate = moment(event.start).format('YYYY-MM-DD');
	


				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getSaleDate",
					data: {enddate: enddate},
					success: function (response)
					{


						document.getElementById('abc').click()
						$('.email').empty('');
						// var responses = $.parseJSON(response);
						 //alert(response);
						var json_obj = $.parseJSON(response);//parse JSON
            
            var output="<tbody>	<tr> <th>Provider name</th><th>Email</th><th>Contact#</th><th>End Date</th>";
            for (var i in json_obj) 
            {
                output+="<tr><td>" + json_obj[i].user_name +"</td><td>" + json_obj[i].email + "</td> <td>" + json_obj[i].contact_no + "</td> <td>" + json_obj[i].compEndDate + "</td></tr>";
            }
            output+="</tr></tbody>";
            
            $('.email').append(output);



					}
					});

			}
		});
	});



</script>

 <script type="text/javascript">
 	// function showWeekly () {
 		
 	// }

	$(document).ready(function () {
		$('#calendarweekly').fullCalendar({
 			today: true,
			events: function(start, end, timezone, callback) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getUsersCount",
					data: "",
					success: function (response)
					{
						// alert(response);
						var eventss = []
						var responses = $.parseJSON(response);
						responses.forEach(ele => {
							eventss.push({title: ele.completion, start: ele.created_at});
						});
						callback(eventss)
					}
				});
			},
			eventClick: function (event) {
				//alert(event.start);
				//document.getElementById('date').click();

			var created_at = moment(event.start).format('YYYY-MM-DD');
	


				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getUsersDate",
					data: {created_at: created_at},
					success: function (response)
					{


						document.getElementById('weekly').click()
						$('.email').empty('');
						// var responses = $.parseJSON(response);
						 //alert(response);
						var json_obj = $.parseJSON(response);//parse JSON
            
            var output="<tbody>	<tr> <th>User name</th><th>Email</th><th>Platform</th>";
            for (var i in json_obj) 
            {
            	if(json_obj[i].device_type == 2){
            		var plateform = 'Web';
            	}
            	else{
            		var plateform = 'Android';
            	}
                output+="<tr><td>" + json_obj[i].user_name +"</td><td>" + json_obj[i].email + "</td>  <td>" + plateform + "</td></tr>";
            }
            output+="</tr></tbody>";
            
            $('.email').append(output);



					}
					});

			}
		});
	});



</script>





<script type="text/javascript">
	
		 function testRun () {
			setTimeout(() => {
				$('.fc-today-button').click();
			}, 300)
		}

</script>
 <script type="text/javascript">
 	// function showWeekly () {
 		
 	// }

	$(document).ready(function () {
		$('#calendargerenal').fullCalendar({
 			today: true,
			events: function(start, end, timezone, callback) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getadvertismentCount",
					data: "",
					success: function (response)
					{
						// alert(response);
						var eventss = []
						var responses = $.parseJSON(response);
						responses.forEach(ele => {
							eventss.push({title: ele.completion, start: ele.created_at});
						});
						callback(eventss)
					}
				});
			},
			eventClick: function (event) {
				//alert(event.start);
				//document.getElementById('date').click();

			var created_at = moment(event.start).format('YYYY-MM-DD');
	


				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>sales/getadvertismentDate",
					data: {created_at: created_at},
					success: function (response)
					{

 // alert(response);
						document.getElementById('advertisment').click()
						$('.email').empty('');
						// var responses = $.parseJSON(response);
						
						var json_obj = $.parseJSON(response);//parse JSON
            
            var output="<tbody>	<tr> <th>Provider name</th><th>Email</th><th>Contact</th><th>Ad Type</th>";
            for (var i in json_obj) 
            {
            	if(json_obj[i].ad_type == 'Platinum'){
            		var ad_type = 'Platinum Advertisement';
            	}
            	else{
            		var ad_type = 'Weekly Specials';
            	}
                output+="<tr><td>" + json_obj[i].providername +"</td><td>" + json_obj[i].email + "</td> <td>" + json_obj[i].mob_number + "</td> <td>" + ad_type + "</td></tr>";
            }
            output+="</tr></tbody>";
            
            $('.email').append(output);



					}
					});

			}
		});
	});



</script>
<script type="text/javascript">
	
		 function gerenalRun () {
			setTimeout(() => {
				$('.fc-today-button').click();
			}, 300)
		}

</script>

<!-- <script type="text/javascript">
	$(function() {

  $('#calendar').fullCalendar({
    eventClick: function(eventObj) {
      if (eventObj.url) {
        alert(
          'Clicked ' + eventObj.title + '.\n' +
          'Will open ' + eventObj.url + ' in a new tab'
        );

        window.open(eventObj.url);

        return false; // prevents browser from following link in current tab.
      } else {
        alert('Clicked ' + eventObj.title);
      }
    },
    defaultDate: '2019-01-08',
    events: [
      {
        title: 'simple event',
        start: '2019-01-05'
      }
    
    ]
  });

});
</script> -->