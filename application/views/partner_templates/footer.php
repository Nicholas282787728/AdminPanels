 
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	
	
	
	
	
  <!-- Modal -->
  <div class="modal fade" id="services_model" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header title-bar-orange">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" style="color:#fff;width:93%;float:left;font-weight: bold;">Upgrade Premium Service</h5>
        </div>
        <div class="modal-body">

		<form method="post" action="<?=base_url()?>panels/supermacdaddy/ondemand/service_update_document" enctype="multipart/form-data">

		 <div class="col-md-12">
            <div class="form-group">
                <label>Valid State  ID</label>
                  <input class="form-control" name="upload[]" type="file" required="">
            </div>
        </div>
		 <div class="col-md-12">
            <div class="form-group">
                <label>Monthly Utility Bill</label>
                 <input class="form-control" name="upload[]" type="file" required="">
            </div>
        </div>
		 <div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                    <input class="form-control" name="email" autocomplete="off"  placeholder="Email" type="email"  required="">
            </div>
        </div>
        
		<div class="col-md-12">
            <div class="form-group">
                <label>Social Media Link</label>
                  <input class="form-control" name="socialmedialink" autocomplete="off"  placeholder="Social Media Link" type="text"  required="">
            </div>
        </div>
				<button type="submit"  class="btn-green">Upgrade</button>
			</form>


			<!-- <form method="post" action="<?=base_url()?>panels/supermacdaddy/ondemand/service_update">
			<div class="form-group">
			   <label>Select Service</label>
			   <?php
					$user_id =  $this->session->userdata('id');
					$this->db->where('id',$user_id);
					$query = $this->db->get('uf_user');
					$getdatafootr = $query->row();
					?>
			   <select class="form-control" name="services_name">
				
				   <option value="Standard" <?=($getdatafootr->service_type == "Standard")?'selected':'' ?>>Standard</option>   
				   <option value="Premium" <?=($getdatafootr->service_type == "Premium")?'selected':'' ?>>Premium</option>   
			   </select>
			</div>
				<button type="submit" name="services_type" class="btn-green">Update</button>
			</form> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
	
	 <div class="modal fade" id="composemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header title-bar-orange">
                <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope"></i> Compose Mail</h5>
                <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('panels/supermacdaddy/affiliatepartner/composemailMessage');?>" enctype="multipart/form-data">
                    <div id="form-alerts"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>To</label>
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" name="send_to" class="form-control" required="">
                                </div>
                            </div>

                              <div class="form-group">
                                <label>CC</label>
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" name="cc" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <div class="input-group" style="width: 100%;" >
                                    <input type="text" name="send_subject" class="form-control" required="" >
                                </div>
                            </div>


                            <div class="form-group" style="overflow-y: auto;">
                                <label>Message</label>
                                <div class="input-group" style="width: 100%">
                                    <textarea class="form-control" id="composmail" name="send_message" rows="4" ></textarea>
                                </div>
                            </div>
                            
                        </div>

                    </div><br>
                    <div class="row modal-footer">
                        <div class="creatUserBottom ">
                            <div class="">
                                <div class="vert-pad">
                                    <button type="submit"  class="btn-green">Send Message</button>
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
	
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
	


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
 
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>public/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.js"></script>
  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.css">
	<script src="<?php echo base_url()?>public/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?=base_url()?>public/dist/js/partner.js"></script>







    <script src="<?php echo base_url() ?>public/dist/js/moment.js"></script>
    <script src="<?php echo base_url() ?>public/dist/js/fullcalendar.min.js"></script>
  
<script type="text/javascript">
     /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
//      events    : [
//        {
//          title          : 'All Day Event',
//          start          : new Date(y, m, 1),
//          backgroundColor: '#f56954', //red
//          borderColor    : '#f56954' //red
//        },
//        {
//          title          : 'Long Event',
//          start          : new Date(y, m, d - 5),
//          end            : new Date(y, m, d - 2),
//          backgroundColor: '#f39c12', //yellow
//          borderColor    : '#f39c12' //yellow
//        },
//        {
//          title          : 'Meeting',
//          start          : new Date(y, m, d, 10, 30),
//          allDay         : false,
//          backgroundColor: '#0073b7', //Blue
//          borderColor    : '#0073b7' //Blue
//        },
//        {
//          title          : 'Lunch',
//          start          : new Date(y, m, d, 12, 0),
//          end            : new Date(y, m, d, 14, 0),
//          allDay         : false,
//          backgroundColor: '#00c0ef', //Info (aqua)
//          borderColor    : '#00c0ef' //Info (aqua)
//        },
//        {
//          title          : 'Birthday Party',
//          start          : new Date(y, m, d + 1, 19, 0),
//          end            : new Date(y, m, d + 1, 22, 30),
//          allDay         : false,
//          backgroundColor: '#00a65a', //Success (green)
//          borderColor    : '#00a65a' //Success (green)
//        },
//        {
//          title          : 'Click for Google',
//          start          : new Date(y, m, 28),
//          end            : new Date(y, m, 29),
//          url            : 'http://google.com/',
//          backgroundColor: '#3c8dbc', //Primary (light-blue)
//          borderColor    : '#3c8dbc' //Primary (light-blue)
//        }
//      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })
</script>
<script>
    $(document).ready(function() {
		
					$(".datetimepicker4").datepicker({
						format: 'yyyy-mm-dd',
						autoclose: true,
					});
        $('#dataTables-example').DataTable({
            responsive: false
        });
    });
    </script>
    
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
		var id='<?php echo $this->session->userdata('id'); ?>';
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/affiliatepartner/notification",
		data: {id:id},
		success: function(response)
		{
			$("#notifications").html(response);
		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/affiliatepartner/notificationcount",
		data: "",
		success: function(response){
			$("#notificationcount").html(response);
		} 

	});
	

	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/affiliatepartner/msgnotification",
		data: "",
		success: function(response)
		{
		$("#messages_list").html(response);

		} 

	});
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/affiliatepartner/msgnotificationcount",
		data: "",
		success: function(response){
			$("#msgcount").html(response);
		} 

	});
		
	// }, 2000);
	
	
	
	
	

});
</script>
<!-- <script type="text/javascript">
	$(document).ready(function(){
	 $( "#readCount" ).click(function() {

        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'notification'
            },
            success: function(response){
                $("#notificationcount").html(response);
            } 
     
        });
        });
        $( "#readTaskCount" ).click(function() {
        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'task'
            },
            success: function(response){
                $("#notitaskscount").html(response);
            } 
     
        });
        });


         $( "#readMessageCount" ).click(function() {
        $.ajax({
            type: "post",
            url:"<?php echo base_url('panels/supermacdaddy/');?>Ondemand/readMessages",
            data: {
                name:'message'
            },
            success: function(response){
                $("#msgcount").html(response);
            } 
     
        });
        });
          });

</script> -->
<script type="text/javascript">
	$('.validatedForm').validate({
			rules : {
				password : {
					minlength : 5
				},
				password_confirm : {
					minlength : 5,
					equalTo : "#password"
				}
			},
			messages:{
				password:{
					required:'New Password is Required'
				}

			}
		});
	$('.addPromo').validate({
			
		});
</script>   

<script type="text/javascript">

	$( document ).ready(function() {
    $('#date_begin,#date_end').datetimepicker({
    	 pick12HourFormat: true,
    	  inline:true,
    });
     $('#rating_date,#rating_date1').datetimepicker({
    	    minView: 2,
		    format: 'yyyy-mm-dd',
		    autoclose: true,
   
    });
     $("#rating_submit").click(function(){
      var date=$("#rating_date").val();
      var date1=$("#rating_date1").val();
     // alert(date);
      if(date && date1){
      	var url="<?php echo base_url('panels/supermacdaddy/ondemand/'); ?>"
      	window.location=url+'?date='+date+'&end='+date1;
      }else{
      	   alert('please select date')
      }
      
    });
});

</script>
<script>

    $('.edit_ticket').click(function(){
        var ticket_id=$(this).attr('data-id');
        $.ajax({
            type: "post",
            url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/edit_ticket",
            data: "&ticket_id="+ticket_id,
            success: function(response){
                $("#edit_tickit_data").html(response);
                new nicEditor().panelInstance('edit_message_ticket');
                $('#edit_ticket').modal('show')   
            } 
        });
    })
        
</script>
<script type="text/javascript">
	$(".js-signup-edit").click(function(){
	 var id =$(this).attr("data-id");
     var aid='#aid-'+id;
     var getid=$(aid).val();
	$.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/ondemand/updateDriverDocuments",
		data: {
			id:id
		},
		success: function(response){
		      var data= $.parseJSON(response);
		      var name=getid+' Upload Singup Document';
		      $("#id").val(data.id);
		      $("#exampleModalLabel,.documentName").html(name);
		      $("#documents").val(data.documents);
		      $("#documentName").val(getid);
			  $('#edit_signup_document').modal('show')   
		} 
 
	});
});
</script>
</body>

</html>


<?php
$id = $this->session->userdata('id');
    $sql = "select id from uf_user  where acceptTerms = '0' AND id = '$id'  ";
            
        $query = $this->db->query($sql);
        $resultarray = $query->row();
if(!empty($resultarray)){
    ?>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
            <?php   $sql1 = "select content from uf_tos  where state_id = 'affiliate_partners'  ";
            
        $query1 = $this->db->query($sql1);
        $resultarray1 = $query1->row();

         ?>
          <p><?php echo $resultarray1->content; ?></p>
        </div>
        <div class="modal-footer">
            <div class="col-sm-12">
              
                <div class="col-sm-3">
            <form method="post" action="<?php echo base_url(); ?>panels/supermacdaddy/affiliatepartner/acceptTerms">
                <input type="hidden" name="acceptTerms" value="1">
          <button type="submit" class="btn btn-success" >Accept</button>
          </form>
      </div>
      <div class="col-sm-3">

            <form method="post" action="<?php echo base_url(); ?>affiliate-logout">
          <button type="submit" class="btn btn-danger" >Cancel</button>
          </form>
      </div>
        <div class="col-sm-6"></div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

    <?php
}

         ?>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    $('#myModal').modal({backdrop: 'static', keyboard: false})  
</script>

