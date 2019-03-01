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
        <form method="post" action="<?php echo base_url('panels/supermacdaddy/doctor/composemail');?>" enctype="multipart/form-data">
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
                <label>Subject</label>
                <div class="input-group" style="width: 100%;" >
                  <input type="text" name="send_subject" class="form-control" required="" >
                </div>
              </div>


              <div class="form-group" style="overflow-y: auto;">
                <label>Message</label>
                <div class="input-group" style="width: 100%;" >
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
    <!--<script src="<?php echo base_url(); ?>public/vendor/jquery/jquery.min.js"></script>-->
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
	<script src="<?php echo base_url()?>public/datepicker/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function() {
//		$("#txtEditor").Editor();
        $('#dataTables-example').DataTable({
            responsive: false
        });
		
		setInterval(function(){
				notification();
				task_notify();
				message_notify();
		}, 5000);
    });
	
	notification();
	function notification()
	{
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/notification",
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
		url:"<?php echo base_url();?>panels/supermacdaddy/doctor/tasknotification",
		data: "",
		dataType: "json",
		success: function(response)
		{
		  $("#task_messages_list").html(response.inpdex_notiy);
		  $("#task_msgcount").html(response.count);
		} 
	 });
	}
	
	message_notify();
	function message_notify()
	{
	  $.ajax({
		type: "post",
		url:"<?php echo base_url();?>panels/supermacdaddy/doctor/msg_notification",
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
	
	$("body").delegate(".update_status_read", "click", function(){
		var notify_id = $(this).attr('id');
		var typeread = $(this).attr('data-typeread');
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/update_notification",
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

	$(".js-promocode-edit").click(function(){
		var id =$(this).attr("data-id");
		$.ajax({
			type: "post",
			url:"<?php echo base_url();?>panels/supermacdaddy/doctor/edit_promo",
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

<script>
  $(function () {
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
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'title',
        center: '',
        right : ''
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
//          title          : 'Long Event',
//          start          : new Date(y, m, d - 5),
//          end            : new Date(y, m, d - 2),
//          backgroundColor: '#f39c12', //yellow
//          borderColor    : '#f39c12' //yellow
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
  
  
$('#my-next-button').click(function() {
  $('#calendar').fullCalendar('next');
});
$('#my-prev-button').click(function() {
  $('#calendar').fullCalendar('prev');
});
</script>
</body>
</html>