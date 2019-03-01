

 <div id="page-wrapper">
  
          <?php $this->load->view('ondemand/new-sidebar'); ?>
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Drivers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Email</th>
                                        <th>title</th>
                                        <th>Locale</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Zip</th>
                                        <th>Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $i=1;
                                //echo "<pre>"; print_r($Sales); 
                                foreach($drivers as $driver)
                                {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $driver['user_name']; ?></td>
                                        <td><?php echo $driver['display_name']; ?></td>
                                        <td><?php echo $driver['email']; ?></td>
                                        <td class="center"><?php echo $driver['title']; ?></td>
                                        <td class="center"><?php echo $driver['locale']; ?></td>
                                        <td class="center"><?php echo $driver['state']; ?></td>
                                        <td class="center"><?php echo $driver['address']; ?></td>
                                        <td class="center"><?php echo $driver['user_lat']; ?></td>
                                        <td class="center"><?php echo $driver['user_long']; ?></td>
                                        <td class="center"><?php echo $driver['zip']; ?></td>
                                        <td class="center"><?php echo $driver['mob_number']; ?></td>
                                    </tr>
                                   <?php $i++;} ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            
            
</div>