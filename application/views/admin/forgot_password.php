<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Login</title>
    <?php echo link_tag('assests/vendor/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assests/vendor/fontawesome-free/css/all.min.css'); ?>
    <?php echo link_tag('assests/css/sb-admin.css'); ?>
  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Forgot Password</div>
        <!---- Success Message ---->
        <?php if ($this->session->flashdata('success')) { ?>
          <div class="alert alert-success"><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></div>
        <?php } ?>
        <!---- Error Message ---->
        <?php if ($this->session->flashdata('error')) { ?>
          <p style="color:red; font-size:18px;" align="center"><?php echo $this->session->flashdata('error');?></p>
        <?php } ?>  
        <div class="card-body">
            <?php echo form_open('admin/login/forgot_password');?>
            <div class="form-group">
              <div class="form-label-group">
                <?php echo form_input(['name'=>'username','id'=>'username','class'=>'form-control','autofocus'=>'autofocus','value'=>set_value('username')]);?>
                <?php echo form_label('Enter Username', 'username'); ?>
                <?php echo form_error('username',"<div style='color:red'>","</div>");?>
              </div>
            </div>
   
            <?php echo form_submit(['name'=>'login','value'=>'Login','class'=>'btn btn-primary btn-block']); ?>
            <a class="d-block small" href="<?php echo site_url('home'); ?>">Back to Home page</a>
            <a class="d-block small" href="<?php echo site_url('admin/login'); ?>">Back to Login</a>
            <?php echo form_close(); ?>
     
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assests/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assests/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assests/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  </body>

</html>
