
<style>

.myclass {
    width: 20% !important;
} 
</style>

 <div id="page-wrapper">
           
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Doctors
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                
                        	<br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
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
                                //echo "<pre>"; print_r($Sales); 
                                foreach($doctors as $doctor)
                                {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $doctor['user_name']; ?></td>
                                        <td><?php echo $doctor['display_name']; ?></td>
                                        <td><?php echo $doctor['email']; ?></td>
                                        <td class="center"><?php echo $doctor['title']; ?></td>
                                        <td class="center"><?php echo $doctor['locale']; ?></td>
                                        <td class="center"><?php echo $doctor['state']; ?></td>
                                        <td class="center"><?php echo $doctor['address']; ?></td>
                                        <td class="center"><?php echo $doctor['user_lat']; ?></td>
                                        <td class="center"><?php echo $doctor['user_long']; ?></td>
                                        <td class="center"><?php echo $doctor['zip']; ?></td>
                                        <td class="center"><?php echo $doctor['mob_number']; ?></td>
                                    </tr>
                                   <?php } ?>
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