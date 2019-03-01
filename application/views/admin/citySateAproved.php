

<div id="page-wrapper">
	  <div class="row">
        <div class="col-lg-12">  <!-- <h1 class="page-header">Promo Codes</h1> -->
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
     <?php 
		 $this->load->view('admin/top_tab_header');
	?>
     		<div class="loader" style="position: fixed;left: 0;top: 0;height: 100%;width: 100%;background: rgba(255,255,255,.9);text-align: center;display: none;z-index: 1051;align-items: center;justify-content: center;">
	<img src="http://medconnex.net/demonil/loader.gif">
</div>

	<div class="row-fluid sortable">		
		<div class="box span12">
		
			<div class="row">
                <div class="col-lg-12">
	<!-- 			<button type="button" class="storefront">Storefront</button>  <button type="button" class="ondemand">Ondemand</button> <button type="button" class="sales">Sales</button> -->
												  <ul class="nav nav-tabs" style="margin-bottom: 7px;border-bottom: 0px solid;">
								    <li style="margin-right: 5px;"><button type="button" class="storefront btn btn-success" >Storefront</button></li>
								    <li style="margin-right: 5px;"><button type="button" class="ondemand btn btn-success" >Ondemand</button></li>
									<li><button type="button" class="doctor btn btn-success">Industry Doctor</button></li>
								  </ul>
                    <div class="panel panel-default">
                    <div class="panel-heading title-bar-blue">
	                  <p><i class="fa fa-shopping-cart" aria-hidden="true"></i> State & City Approval For <span class="sectionName"></span></p>
	                </div> 
	                <!-- /.panel-heading -->
                        
                    <div  class="storefront1">
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <form method="post" action="">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example">
                                <thead>
									<tr class="first-row">
										<th class="br-n">S.No.</th>
										<th class="br-n">State</th>
										<!-- <th class="br-n">City</th>
										<th class="br-n">Actions</th> -->
									</tr>
                                </thead>
                         <tbody>
									<?php $i = 1;
									foreach ($citySateAprovedStore as $row) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><a href="javascript:void(0)" class="statesesarch"  data-state="<?php echo $row['state']; ?>" ><?php echo $row['state']; ?></a></td>
										</tr>
									<?php } ?>
                                </tbody>			
                            </table>
                        </from>
                        </div>
                        </div>
                    </div>


                    <div class="ondemand1">
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <form method="post" action="">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example">
                                <thead>
									<tr class="first-row">
										<th class="br-n">S.No.</th>
										<th class="br-n">State</th>
										<!-- <th class="br-n">City</th>		
										<th class="br-n">Actions</th> -->
									</tr>
                                </thead>
                         <tbody>
									<?php $i = 1;
									foreach ($citySateAprovedOndemand as $row) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><a href="javascript:void(0)" class="statesesarchOndemand"  data-stateondemand="<?php echo $row['state']; ?>" ><?php echo $row['state']; ?></a></td>
										</tr>
									<?php } ?>
                                </tbody>			
                            </table>
                        </from>
                        </div>
                        </div>
                    </div>

					<div class="doctor1">
                        <div class="panel-body">
                        	<div class="table-responsive">
                            <form method="post" action="">
                            <table width="100%" class="table table-striped table-bordered table-hover medconnex17" id="example">
                                <thead>
									<tr class="first-row">
										<th class="br-n">S.No.</th>
										<th class="br-n">State</th>
										<!-- <th class="br-n">City</th>
										<th class="br-n">Actions</th> -->
									</tr>
                                </thead>
                         <tbody>
									<?php $i = 1;
									foreach ($citySateAprovedDoctor as $row) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><a href="javascript:void(0)" class="statesesarchDoctor"  data-stateDoctor="<?php echo $row['state']; ?>" ><?php echo $row['state']; ?></a></td>
										</tr>
									<?php } ?>
                                </tbody>			
                            </table>
                        </from>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
		</div>
	</div><!--/row-->
</div>
<!-- /.content-wrapper -->



<a id="advertisment"  data-toggle="modal" data-target="#myModal1"></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
      </div>
    </div>
  </div> 



 <script type="text/javascript">
 

		var my_arr = [];
			$('.statesesarch').click(function(){
			$('.loader').css('display','flex');
			var state =$(this).attr("data-state");
			var type = 3;

				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySatesSearch",
					data: {state: state,type:type},
					success: function (response)
					{

 				$('.loader').css('display','none');
					document.getElementById('advertisment').click();
						///$('.advertisment').trigger('click');
						$('.email').empty('');
						// var responses = $.parseJSON(response);
						
						var json_obj = $.parseJSON(response);//parse JSON
            			my_arr = json_obj;
            			statea = state;
						var output="<tbody>	<tr> <th>Cities of "+ state +"</th><th>Actions</th>";
						for (var i in json_obj) 
						{
						if(json_obj[i].stateCityStatus == 0){
							var yesno = `<button type="button" class="btn btn-warning dropdown-toggle b${i}" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"   onclick="enableCitystore(${i})" class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
						}
						else{
						var yesno = `<button type="button" class="btn btn-success dropdown-toggle b${i}" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable" onclick="disableCitystore(${i})"  class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
						}
						output+="<tr><td>" + json_obj[i].city +"</td><td><div class='btn-group  a" + i + "'>" + yesno +"</div></td></tr>";
						}
						output+="</tr></tbody>";
						$('.email').append(output);
					}
					});
				});


function enableCitystore (i) {
	 	

	 	$('.loader').css('display','flex');
	
		stateCityStatus = 1;
		update = 1;
		type = 3;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable"   class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
					
    $('.a' + i + '').append(yesno);
    $('.b' + i + '').css('display','none');
    	$('.loader').css('display','none');
   

					}
				});
}

function disableCitystore (i) {
	 	
		$('.loader').css('display','flex');
		stateCityStatus = 0;
		update = 1;
		type = 3;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"    class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
$('.a' + i + '').append(yesno);
$('.b' + i + '').css('display','none');
$('.loader').css('display','none');
					}
				});
}


















$(document).ready(function(){
		$('.sectionName').append('Storefront');
	$('.ondemand1').css('display','none');
		$('.doctor1').css('display','none');

})


$('.storefront').click(function(){
	$('.sectionName').empty();

	$('.sectionName').append('Storefront');
	$('.storefront1').css('display','block');
$('.ondemand1').css('display','none');
		$('.doctor1').css('display','none');

})



$('.ondemand').click(function(){
	
	$('.sectionName').empty();

	$('.sectionName').append('On-Demand');
	$('.storefront1').css('display','none');
$('.ondemand1').css('display','block');
		$('.doctor1').css('display','none');

})



$('.doctor').click(function(){
	$('.sectionName').empty();

	$('.sectionName').append('Doctor');

	$('.storefront1').css('display','none');
$('.ondemand1').css('display','none');
		$('.doctor1').css('display','block');

})

</script>

  









<a id="advertisment1"  data-toggle="modal" data-target="#myModal2"></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
      <div class="table-responsive">
        		<table class="table table-bordered email1">
        			<tr>
        				<th colspan="3">Title</th>
        			</tr>

        		</table>
        	</div>	
        
        </div>
     
      </div>
      
    </div>
  </div> 


<script type="text/javascript">
	var my_arr = [];
		$('.statesesarchOndemand').click(function(){
			///alert('fgdh');
			$('.loader').css('display','flex');

		
 		var state =$(this).attr("data-stateondemand");
	
var type = 1;

				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySatesSearch",
					data: {state: state,type:type},
					success: function (response)
					{

 $('.loader').css('display','none');
					document.getElementById('advertisment1').click();
						///$('.advertisment').trigger('click');
						$('.email1').empty('');
						// var responses = $.parseJSON(response);
						
						var json_obj = $.parseJSON(response);//parse JSON
            			my_arr = json_obj;
            			statea = state;
            var output="<tbody>	<tr> <th>Cities of "+ state +"</th><th>Actions</th>";
            for (var i in json_obj) 
            {
            	if(json_obj[i].stateCityStatus == 0){
            		var yesno = `<button type="button" class="btn btn-warning dropdown-toggle b${i}" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"   onclick="enableCityOndemand(${i})" class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
            	}
            	else{
	var yesno = `<button type="button" class="btn btn-success dropdown-toggle b${i}" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable" onclick="disableCityOndemand(${i})"  class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
            	}
                output+="<tr><td>" + json_obj[i].city +"</td><td><div class='btn-group  a" + i + "'>" + yesno +"</div></td></tr>";
            }
            output+="</tr></tbody>";

          
            
            $('.email1').append(output);



					}
					});


				});


			
function enableCityOndemand (i) {
	 	

	 	$('.loader').css('display','flex');
	
		stateCityStatus = 1;
		update = 1;
		type = 1;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable"  class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
					
    $('.a' + i + '').append(yesno);
    $('.b' + i + '').css('display','none');
    	$('.loader').css('display','none');
   

					}
				});
}

function disableCityOndemand (i) {
	 	
		$('.loader').css('display','flex');
		stateCityStatus = 0;
		update = 1;
		type = 1;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"    class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
$('.a' + i + '').append(yesno);
$('.b' + i + '').css('display','none');
$('.loader').css('display','none');
					}
				});
}

</script>



<a id="advertisment2"  data-toggle="modal" data-target="#myModal3"></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
      <div class="table-responsive">
        		<table class="table table-bordered email3">
        			<tr>
        				<th colspan="3">Title</th>
        			</tr>

        		</table>
        	</div>	
        
        </div>
     
      </div>
      
    </div>
  </div> 


<script type="text/javascript">
	var my_arr = [];
		$('.statesesarchDoctor').click(function(){
			///alert('fgdh');
			$('.loader').css('display','flex');

		
 		var state =$(this).attr("data-stateDoctor");
	
var type = 2;

				$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySatesSearch",
					data: {state: state,type:type},
					success: function (response)
					{

 $('.loader').css('display','none');
					document.getElementById('advertisment2').click();
						///$('.advertisment').trigger('click');
						$('.email3').empty('');
						// var responses = $.parseJSON(response);
						
						var json_obj = $.parseJSON(response);//parse JSON
            			my_arr = json_obj;
            			statea = state;
            var output="<tbody>	<tr> <th>Cities of "+ state +"</th><th>Actions</th>";
            for (var i in json_obj) 
            {
            	if(json_obj[i].stateCityStatus == 0){
            		var yesno = `<button type="button" class="btn btn-warning dropdown-toggle b${i}" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"   onclick="enableCityDoctor(${i})" class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
            	}
            	else{
	var yesno = `<button type="button" class="btn btn-success dropdown-toggle b${i}" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable" onclick="disableCityDoctor(${i})"  class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
            	}
                output+="<tr><td>" + json_obj[i].city +"</td><td><div class='btn-group  a" + i + "'>" + yesno +"</div></td></tr>";
            }
            output+="</tr></tbody>";

          
            
            $('.email3').append(output);



					}
					});


				});


			
function enableCityDoctor (i) {
	 	

	 	$('.loader').css('display','flex');
	
		stateCityStatus = 1;
		update = 1;
		type = 2;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Enabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"  id="disable"  class="js-user-disable"><i class="fa fa-minus-circle"></i>  Disable</button></li></ul>`;
					
    $('.a' + i + '').append(yesno);
    $('.b' + i + '').css('display','none');
    	$('.loader').css('display','none');
   

					}
				});
}

function disableCityDoctor (i) {
	 	
		$('.loader').css('display','flex');
		stateCityStatus = 0;
		update = 1;
		type = 2;

		$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>dashboard/citySateAproved",
					data: {state: statea,city:my_arr[i].city,stateCityStatus:stateCityStatus,update:update,type:type},
					success: function (response)
					{
						var yesno = `<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Disabled<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><button style="padding: 1px 20px;border: none;background: transparent;" type="button" name="update"    class="js-user-disable"><i class="fa fa-minus-circle"></i>  Enable</button></li>`;
$('.a' + i + '').append(yesno);
$('.b' + i + '').css('display','none');
$('.loader').css('display','none');
					}
				});
}

</script>


 

 
