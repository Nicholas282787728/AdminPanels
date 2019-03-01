
<div id="page-wrapper">
    <?php 
     $this->load->view('admin/top_tab_header');
  ?>
  <div class="row">
    <div class="col-lg-12">
        <?php 
      @$success_msg = $this->session->flashdata('success_msg');
      if(!empty($success_msg)) {
        echo "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>";
        echo $this->session->flashdata('success_msg')."</div>";     
      }
      @$error_msg = $this->session->flashdata('error_msg');
      if(!empty(@$error_msg)) {
        echo "<div class='alert alert-danger' style='float: center;text-transform: capitalize;' id='success-alert'>";
        echo $this->session->flashdata('error_msg')."</div>";     
      }
    ?>
      <div class="panel panel-default">
        <div class="panel-heading title-bar-green" style="color:#fff;">
          <i class="fa fa-flag mr-5"></i>Opt-Out Service
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <form action="" method="post">
           
         
            <div class="col-sm-12">
            <div class="form-group">
          <!--   <label>Opt-Out Service </label> -->
            <input type="hidden" name="optout_id" id="optout_id" value="<?php echo $optout['id'];?>">
            <textarea rows="10" name="optout_content" id="optout_content"  cols="117" class="note-codable form-control" style="width:100%; height:100%;"><?php echo $optout['content'];?></textarea>
            </div>
          </div>
         <!--   <div class="col-sm-12">
            <div class="form-group">
            <label>Opt In  </label>
              <input type="hidden" name="optin_id" id="optin_id" value="<?php echo $optin['id'];?>">
            <textarea rows="10" name="optin_content" id="optin_content"  cols="117" class="note-codable form-control" style="width:100%; height:100%;"><?php echo $optin['content'];?></textarea>
            </div>
          </div> -->
            <div class="row">
              <div class="col-xs-12">
                <button type="submit" class="btn-green js-location-create" name="save"> Submit </button>
              </div>
            </div>
          </form>
          <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'optout_content' );
      CKEDITOR.replace( 'optin_content' );

    </script>
