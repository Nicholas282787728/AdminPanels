<style type="text/css">
    .blue{
        background-color: #50b0d2;
        color: #fff;
    }
    .dashboard-panel .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
        background-color: #56bddc !important;
    }
    .dashboard-panel .nav-tabs > li > a {
        background-color: #33a8cb ;
        color: #fff; 
        margin-right: 0px;
    }
    .chatList{
        /*  height: 350px;*/
        height: 240px;
        overflow-y: auto;
    }

    /*  #user-type-chart svg{
            width:100%;
            min-width: 807px; 
        }*/
</style>
<div id="page-wrapper">
           <?php $this->load->view('storefronts_templates/new-sidebar'); ?>

    <div class="row">
                    
        <div class="col-lg-8 medconnex1">
                    <div class="medconnex-right" align="right">
                        <form method="post" action="" class="form-inline">
                            <div class="form-group medconnexgrp">
                                <input type="text" id="startdate_graph" name="startdate" class="form-control datetimepicker4" placeholder="Start Date" size="18">
                            </div>
                            <div class="form-group medconnexgrp">
                                <input type="text" id="enddate_graph" name="enddate" class="form-control datetimepicker4" placeholder="End Date" size="18">
                            </div>
                            <div class="form-group medconnexgrp">
                                <input type="submit" class="btn btn-primary" value="submit">
                            </div>
                        </form>
                    </div>
                    <br>
            <div class="panel panel-default medconnex-panel">
                <div class="panel-heading adi-head-blue2 medconnex-panelheading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Charts : 
                    <button type="button" class="btn btn-primary tabcharts firstClick"   data-chartid="morris-area-chart">Mobile Devices</button>
                    <button type="button" class="btn btn-default tabcharts"   data-chartid="user-type-chart">Certified Providers</button>
                    <button type="button" class="btn btn-default tabcharts"   data-chartid="provider-usertype-chart">App Users VS Certified Providers</button>


                </div>
                <div class="panel-body medconnex-panelbody" >
                    <div class="tab-content medconnex-tab">
                        <div class="tab-pane active medconnex-pane">
                            <div id="morris-area-chart" class="chartuser updateidchart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- /.col-lg-8 -->
        <div class="col-lg-4 medconnex2">
            <div class="panel panel-default medconnex2-panel" style="display: none;">
                <div class="panel-heading adi-head-per2 medconnex2-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <div class="panel-body medconnex2-body">
                    <div class="list-group medconnex2-listgrp">
                        <div id="notificationsinpdex_notiy"></div>
                    </div>
                </div>
            </div>


            <h4 style="text-align: center;color: black;font-weight: bold;text-transform: uppercase; background-color: white;padding: 10px;margin: 0px;">Chat list</h4>

            <div class="panel panel-default chatList">
                <?php
                $adminCount = count($allAdmins);
                if ($adminCount > 0) {
                    foreach ($allAdmins as $all) {
                        ?>

                        <div class="panel-heading adi-head-orange2" onclick="getChatPanel('<?= $all->id ?>');" style="background-color: green !important;cursor:pointer;">

                            <i class="fa fa-comments fa-fw"></i> User Chat  <?= ucfirst($all->email) ?>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>


        </div>
        <div class="clearfix"></div>
        <div class="row " id="scr">
            <?php
            $adminCount = count($allAdmins);
            if ($adminCount > 0) {
                foreach ($allAdmins as $all) {
                    ?>
                    <div class="col-md-4 pull-right allchatboxes" id="chatpanel<?= $all->id ?>" style="display: none;" >
                        <div class="chat-panel panel panel-default">
                            <div class="panel-heading adi-head-orange2">
                                <i class="fa fa-comments fa-fw"></i> User chat <?= ucfirst($all->email) ?>
                                <a class="close" data-dismiss="alert" aria-label="close" onclick="getCloseChatPanel('<?= $all->id ?>')">&times;</a>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <ul class="chat" id="chat-messages-inner<?= $all->id ?>">
                                    There is a No Messages
                                </ul>
                            </div>
                            <div class="panel-footer">
                                <form action="" id="msg<?= $all->id ?>" name="msg<?= $all->id ?>" enctype="multipart/form-data" method="post" onsubmit="return false;">
                                    <div class="input-group">
                                        <input  name="message"  id="message<?= $all->id ?>"  style="padding:15px; height:auto;" class="form-control input-sm" placeholder="Type your message here..." type="text">
                                        <input type="hidden" name="id" value="<?= $all->id ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-sm adi-head-orange " id="btn-chat<?= $all->id ?>" onclick="messageSend('<?= $all->id ?>');">
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

            
            <script type="text/javascript">
                function getChatPanel(id) {
                    var chatid = "#chatpanel" + id;
                    var chatmessage = "#chat-messages-inner" + id;
                    //$('.allchatboxes').hide();
                    $(chatid).show();
                    $("html, body").animate({scrollTop: $(document).height()}, 1000);
                    $("#chatmessage,.panel-body").animate({scrollTop: $(document).height()}, 1000);
                }
                function getCloseChatPanel(id) {
                    var chatid = "#chatpanel" + id;
                    $(chatid).hide();
                }
            </script>
            <!-- Morris Charts JavaScript -->
            <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
            <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.min.js"></script>

            <script>
                //$("#chat-messages-inner").animate({scrollTop: $(document).height()}, "slow");
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
                        url: "<?php echo base_url(); ?>panels/supermacdaddy/storefronts/sendmassage",
                        //data: datastring+"&message="+meg,
                        data: new FormData(form),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data)
                        {
                            //alert(response);
                            console.log(data);
                            /*$("#mesage").html(response);*/
                            document.getElementById("msg" + id).reset();
                        }

                    });
                }


                function sendMessageClick(id)
                {
                    $('.send_id').val(id);
                }
               

                $(document).on('click', '.chat li', function () {
                    if ($(this).hasClass('blue')) {
                        //$(this). removeClass('blue');
                        $('.chat li').removeClass('blue');
                    } else
                    {
                        $('.chat li').removeClass('blue');
                        $(this).addClass('blue');
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
                        if (checkid == "morris-area-chart") {
                            chart1();
                        } else if (checkid == "user-type-chart") {
                            chart2();
                        } else if (checkid == "provider-usertype-chart") {
                            chart3();
                        }
                    });


                    function chart1()
                    {

                        Morris.Area({
                            element: 'morris-area-chart',
                            data: [<?php
            foreach ($usercount as $value) {
                echo "{period: '" . $value['dates'] . "', ios:'" . $value['ios'] . "', android:'" . $value['android'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['ios', 'android'],
                            labels: ['iOS', 'Android'],
                            pointSize: 2,
                            hideHover: 'auto',
                            resize: true
                        });
                    }
                    function chart2()
                    {

                        Morris.Area({
                            element: 'user-type-chart',
                            data: [<?php
            foreach ($usertype_count as $value) {
                echo "{period: '" . $value['dates'] . "', store:'" . $value['store_count'] . "', doctor:'" . $value['docotor_count'] . "', driver:'" . $value['driver_count'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['store', 'doctor', 'driver'],
                            labels: ['Store', 'Doctor', 'Driver'],
                            pointSize: 3,
                            hideHover: 'auto',
                            resize: true
                        });
                    }


                    function chart3()
                    {


                        Morris.Area({
                            element: 'provider-usertype-chart',
                            data: [<?php
            foreach ($provider_usertype_count as $value) {
                echo "{period: '" . $value['dates'] . "', provider:'" . $value['provider'] . "', user:'" . $value['users'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['provider', 'user'],
                            labels: ['Provider', 'User'],
                            pointSize: 2,
                            hideHover: 'auto',
                            resize: true
                        });
                    }
                });
            </script>
            <script>
                $("#chat-messages-inner").animate({scrollTop: $(document).height()}, "slow");


                $(document).ready(function () {
                    $(".datetimepicker4").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        orientation: "bottom"
                    });


                    $("#enddate_graph").change(function () {
                        var startDate = document.getElementById("startdate_graph").value;
                        var endDate = document.getElementById("enddate_graph").value;

                        if ((Date.parse(endDate) <= Date.parse(startDate))) {
                            alert("End date should be greater than Start date");
                            document.getElementById("enddate_graph").value = "";
                        }
                    });

                    setInterval(function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url(); ?>panels/supermacdaddy/storefronts/chat_history",
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
                    }, 2000);



                });
                $(document).ready(function () {
                    $('#ratingClick').click();
                    $('.firstClick').click();

                })

            </script> 
