<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="col-md-12">
  <input class="form-control " type="hidden" name="document_id" readonly="" value="" required="" >
  <input class="form-control " type="hidden" name="document_name" readonly="" value="" required="" >
  <div class="form-group">
    <label>Attach File </label>
    <div class="input-group">
      <input type="file" name="image" >
      <input type="hidden" name="old_image" value="" >
    </div>
    <div class="form-group">
      <label>Note </label>
      <div >
        <textarea class="form-control" name="notes" required row="10" style="resize:none" cols="50"></textarea>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("notes");
  </script>

</body>
</html>
