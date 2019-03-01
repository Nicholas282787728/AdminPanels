
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
	// setInterval(function(){
	$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/notification",
			data: "",
			success: function(response)
			{
			console.log(response);

			$("#notifications").html(response);
		
			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/notificationcount",
			data: "",
			success: function(response){
				$("#notificationcount").html(response);
			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/tasknotification",
			data: "",
			success: function(response)
			{
			$("#notitasks").html(response);

			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/tasknotificationcount",
			data: "",
			success: function(response){
				$("#notitaskscount").html(response);
			} 
	 
		});
		
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/msgnotification",
			data: "",
			success: function(response)
			{
			$("#messages_list").html(response);

			} 
	 
		});
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/msgnotificationcount",
			data: "",
			success: function(response){
				$("#msgcount").html(response);
			} 
	 
		});
		
	// }, 2000);
	
	$(".js-user-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/onadmin/edit_product",
			data: "&id="+id,
			success: function(response){
				//console.log(response['id']);
				$(".updatepro").html(response);
				$('#editproduct').modal('show')   
			} 
	 
		});
	});
});
</script>    
</body>

</html>
