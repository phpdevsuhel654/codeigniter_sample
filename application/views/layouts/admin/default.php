<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo !empty($title)?$title:'Admin'; ?></title>

    <!-- Bootstrap core CSS-->
    <?php echo link_tag('assests/vendor/bootstrap/css/bootstrap.min.css'); ?>
    <!-- Custom fonts for this template-->
    <?php echo link_tag('assests/vendor/fontawesome-free/css/all.min.css'); ?>
    <!-- Page level plugin CSS-->
    <?php echo link_tag('assests/vendor/datatables/dataTables.bootstrap4.css'); ?>
    <!-- Include stylesheet -->
    <?php /* ?><?php echo link_tag('assests/css/quill/quill.snow.css'); ?><?php */ ?>


    <!-- Custom styles for this template-->
    <?php echo link_tag('assests/css/sb-admin.css'); ?>
    <!-- Custom styles for this template-->
    <?php echo link_tag('assests/css/custom-style.css'); ?>
    
    <!-- Include the TinyMCE library -->
    <?php /* ?><script src="<?php echo base_url('assests/js/tinymce.min.js'); ?>"></script><?php */ ?>

    <!-- Include the TinyMCE library -->
    <script src="<?php echo base_url('assests/js/ckeditor/ckeditor.js'); ?>"></script>

  </head>

  <body id="page-top">

    <?php include APPPATH.'views/layouts/admin/header.php';?>

    <div id="wrapper">

      <?php include APPPATH.'views/layouts/admin/sidebar.php';?>

      <div id="content-wrapper">

        <div class="container-fluid">
            <!-- contents -->
            <?php echo $contents ?>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include APPPATH.'views/layouts/admin/footer.php';?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>



    <script src="<?php echo base_url('assests/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assests/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assests/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url('assests/vendor/chart.js/Chart.min.js'); ?>"></script>
    <script src="<?php echo base_url('assests/vendor/datatables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('assests/vendor/datatables/dataTables.bootstrap4.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assests/js/sb-admin.min.js'); ?>"></script>
    <script src="<?php echo base_url('assests/js/demo/datatables-demo.js'); ?>"></script>
    <script src="<?php echo base_url('assests/js/demo/chart-area-demo.js'); ?>"></script>

    <!-- Include the Quill library -->
    <?php /* ?><script src="<?php echo base_url('assests/js/quill/quill.js'); ?>"></script><?php */ ?>

    <!-- Include Custom Scripts -->
    <script src="<?php echo base_url('assests/js/custom-script.js'); ?>"></script>
  </body>

</html>
