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
	<!-- Custom styles for this template-->
	<?php echo link_tag('assests/css/sb-admin.css'); ?>

  </head>

  <body id="page-top">		
	
	<!-- Header -->
	<?php include APPPATH.'views/layouts/header.php';?>
	
    <div id="wrapper">
      <div id="content-wrapper">

        <div class="container-fluid">
			<!-- contents -->
            <?php echo $contents ?>
        </div>

      </div>
    </div>
	
	<!-- Footer -->
	<?php include APPPATH.'views/layouts/footer.php';?>

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
	
  </body>

</html>
