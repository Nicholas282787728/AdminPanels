<!DOCTYPE html>
<html lang="en">
<head>
  <title>Import CSV File Data into MySQL Database using PHP</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
  </style>
</head>
<body>

<div class="container">
    <h2>Import CSV File Data into MySQL Database using PHP</h2>
    <?php if(!empty($status)){
        echo '<div class="alert alert-danger">'.$status.'</div>';
    } ?>
    <div class="panel panel-default">
    	<div class="panel-heading">
            Members list
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Members</a>
        </div>
        <div class="panel-body">
            <form action="<?php echo site_url("Paypal/upload_file");?>" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Created</th>
                      <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //get rows query
                    $query = $this->db->query("SELECT * FROM user")->result();
                    if(count($query)>0){
                    foreach($query as $row){ ?>
                    <tr>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->phone; ?></td>
                      <td><?php echo $row->created; ?></td>
                      <td><?php echo ($row->status == '1')?'Active':'Inactive'; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>            
        </div>
    </div>
</div>

</body>
</html>