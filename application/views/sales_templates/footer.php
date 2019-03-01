		    </div>
            </div>
        </div>
    </div>
    <!-- compose mail -->

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
        <form method="post" action="<?php echo base_url('panels/supermacdaddy/sales/composemail');?>" enctype="multipart/form-data">
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
                <div class="input-group" style="width: 100%;">
                  <textarea class="form-control" id="composmail" name="send_message" rows="4" style="width:100% !important; height:100%;"></textarea>
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





<?php
$id = $this->session->userdata('id');
    $sql = "select id from uf_user  where acceptTerms = '0' AND id = '$id'  ";
            
        $query = $this->db->query($sql);
        $resultarray = $query->row();
if(!empty($resultarray)){
    ?>




  <!-- Modal -->
  <div class="modal fade" id="myModalsales" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
            <?php   $sql1 = "select content from uf_tos  where state_id = 'sale_partners'  ";
            
        $query1 = $this->db->query($sql1);
        $resultarray1 = $query1->row();

         ?>
          <p><?php echo $resultarray1->content; ?></p>
        </div>
        <div class="modal-footer">
            <div class="col-sm-12">
              
                <div class="col-sm-3">
            <form method="post" action="<?php echo base_url(); ?>sales/acceptTerms">
                <input type="hidden" name="acceptTerms" value="1">
          <button type="submit" class="btn btn-success" >Accept</button>
          </form>
      </div>
      <div class="col-sm-3">

            <form method="post" action="<?php echo base_url(); ?>sales-logout">
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









 <!--  End compose mail -->
<!--    <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>-->
	<script type="text/javascript">
		$(document).ready( function() {
			$("#txtEditor").Editor();
		});
	</script>
	<script src="<?php echo base_url(); ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/metisMenu/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>public/data/morris-data.js"></script>
	<script src="<?php echo base_url() ?>public/dist/js/moment.js"></script>
	<script src="<?php echo base_url() ?>public/dist/js/fullcalendar.min.js"></script>
	<script src="<?php echo base_url() ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
		<script src="<?=base_url()?>public/datepicker/js/bootstrap-datepicker.js"></script>
<script>
  $(document).ready(function() {
		$(".datetimepicker4").datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		});
        $('#dataTables-example').DataTable({
            responsive: false
        });
        $('#dataTables-example1').DataTable({
            responsive: false
        });
        $('#dataTables-example2').DataTable({
            responsive: false
        });
    });

$(document).ready(function(){
  //setInterval(function(){
 	notification();
	function notification()
	{
	  $.ajax({
		  type: "post",
		  url:"<?php echo base_url('sales-notification-message');?>",
		  data: "",
		  dataType: "json",
		  success: function(response)
		  {
			 $("#notifications").html(response.inpdex_notiy);
			 $("#notificationcount").html(response.count);
		  } 
	  });
	}
  
  	task_notify();
	function task_notify()
	{
	  $.ajax({
		type: "post",
		url:"<?php echo base_url('sales-task-notification');?>",
		data: "",
		dataType: "json",
		success: function(response)
		{
		  $("#task_messages_list").html(response.inpdex_notiy);
		  $("#task_msgcount").html(response.count);
		} 
	 });
	}
	
	
	
 	$("body").delegate(".update_status_read", "click", function(){
		var notify_id = $(this).attr('id');
		var typeread = $(this).attr('data-typeread');
		$.ajax({
			type: "post",
			url:"<?php echo base_url('sales-update-notification');?>",
			data: "&notify_id="+notify_id+"&typeread="+typeread,
			dataType: "json",
			success: function(response)
			{
				notification();
				task_notify();
				message_notify();
			}
		});
	}); 
	
	message_notify();
	function message_notify()
	{
	  $.ajax({
		type: "post",
		url:"<?php echo base_url('sales-msg-notification');?>",
		data: "",
		dataType: "json",
		success: function(response)
		{
		  $("#messages_list").html(response.inpdex_notiy);
		  $("#msgcount").html(response.count);
		  $("#dashboard_inboxmsg").html(response.count);
		} 
	  });
	}
  
//    $.ajax({
//      type: "post",
//      url:"<?php echo base_url();?>panels/supermacdaddy/sales/tasknotification",
//      data: "",
//      success: function(response)
//      {
//      $("#task_messages_list").html(response);
//
//      } 
//   
//	});
   
    });
  //}, 2000);
  $(function () {

    $(".gn-salesPanel-edit").click(function(){
      var id =$(this).attr("data-id");
      $.ajax({
        type: "post",
        url:"<?php echo base_url('sales-edit-general-sale');?>",
        data: "&id="+id,
        success: function(response){
          //console.log(response['id']);
          $(".updatepro").html(response);
          $('#editprofile').modal('show')   
        } 
     
      });
    });
    $(".gn-GenSales-edit").click(function(){
      var id =$(this).attr("data-id");
      $.ajax({
        type: "post",
        url:"<?php echo base_url('sales-edit-adrv-sale');?>",
        data: "&id="+id,
        success: function(response){
          //console.log(response['id']);
			$(".updateadvr").html(response);
			$('#editadv').modal('show') ;
			$(".datetimepicker4").datepicker({
			  format: 'yyyy-mm-dd',
			  autoclose: true,
			});
        } 
     
      });
    });
    $(".gn-attachment-edit").click(function(){
      var id =$(this).attr("data-id");
      $.ajax({
        type: "post",
        url:"<?php echo base_url('sales-edit-attachemnt-sale');?>",
        data: "&id="+id,
        success: function(response){
          //console.log(response['id']);
          $(".updateadvr").html(response);
          $('#editadv').modal('show')   
        } 
     
      });
    });

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

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
  
  
  
	
	
	$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url('sales-edit-promo');?>",
			data: "&id="+id,
			success: function(response){
				$(".updatepromodiv").html(response);
				$('#editpromomodal').modal('show')   
				$(".datetimepicker4").datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
				});
			} 
	 
		});
	});
</script>
<script type="text/javascript">
     $(document).ready(function(){
        $('#bookid').on('click',function(){
        if(this.checked){
            $('.check').each(function(){
                this.checked = true;
            });
        }else{
             $('.check').each(function(){
                this.checked = false;
            });
        }
    });
    
});
    
</script>  

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModalsales').modal('show');
    });
    $('#myModalsales').modal({backdrop: 'static', keyboard: false})  
</script>

</body>
</html>
