 <div class="panel-footer">

                        </div>
                        <!-- /.panel-footer -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
			$("#txtEditor").Editor();
		});
	</script>


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>public/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>public/dist/js/sb-admin-2.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/moment.js"></script>
<script type="text/javascript">
$(function() {
    $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});
</script>

<script>
	
$(document).ready(function(){
	//setInterval(function(){
	$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/notification",
			data: "",
			success: function(response)
			{
			console.log(response);

			$("#notifications").html(response);
		
			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/notificationcount",
			data: "",
			success: function(response){
				$("#notificationcount").html(response);
			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/tasknotification",
			data: "",
			success: function(response)
			{
			$("#notitasks").html(response);

			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/tasknotificationcount",
			data: "",
			success: function(response){
				$("#notitaskscount").html(response);
			} 
	 
		});
		
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/msgnotification",
			data: "",
			success: function(response)
			{
			$("#messages_list").html(response);

			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/msgnotificationcount",
			data: "",
			success: function(response){
				$("#msgcount").html(response);
			} 
	 
		});
	//}, 2000);
	
	$(".js-user-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/edit_user",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".updatepro").html(response);
				$('#editprofile').modal('show')   
			} 
	 
		});
	});

$(".js-cat-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/edit_cat",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".editcatdiv").html(response);
				$('#editcategory').modal('show')   
			} 
	 
		});
	});
	

$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>admin/edit_promo",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".updatepromodiv").html(response);
				$('#editpromomodal').modal('show')   
			} 
	 
		});
	});
	
$(".js-staff-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>admin/aut_users",
		data: "&id="+id,
		success: function(response){
			console.log(response['id']);
			$(".saleseditdiv").html(response);
			$('#edit_sale_Modal').modal('show')   
		} 
 
	});
});

$(".js-service-edit").click(function(){
	var id =$(this).attr("data-id");
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>admin/edit_services",
		data: "&id="+id,
		success: function(response){
			console.log(response['id']);
			$(".servicediv").html(response);
			//$('#edit_sale_Modal').modal('show')   
		} 
 
	});
});
});

</script>    
</body>

</html>
