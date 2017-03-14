<?php
include_once '../conf.php'
?>
<!-- Cambio de prueba... -->
<!DOCTYPE html>
<html lang="en" ng-app='directorioApp'>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Empleados</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $url_server; ?>/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="../css/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $url_server; ?>/lib/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/lib/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $url_server; ?>/lib/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

	<script type="text/javascript" src="<?php echo $url_server; ?>/lib/angular-1.5.8/angular.min.js"></script>
	<script type="text/javascript" src="../js/miembros.js"></script>

  </head>

  <body ng-controller='DirectorioCntroller'>



    <div class="container-fluid">
      <div class="row">



		<div >
			<?php include_once "../views/directorio/miembros/miembros.php"; ?>
		</div>



        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $url_server; ?>/lib/jquery-3.1.1.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
	<script>
		$('.datepick').datepicker({

				format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
		});
	</script>
	
	<script type="text/javascript" src="/lib/jquery-timepicker/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/lib/jquery-timepicker/jquery.timepicker.css" />

	<script src="/lib/datepair/src/datepair.js"></script>
	<script src="/lib/datepair/src/jquery.datepair.js"></script>
	<link rel="stylesheet" href="/lib/bootstrap-select.css">
	<script src="/lib/bootstrap-select.js"></script>
  
  
	<script>
		$(document).ready(function(){
			var dtr = [];

			//dtr.push(['1pm', '3:01pm']);
			$('#datepairExample .time').timepicker({
			'showDuration': true,
			'timeFormat': 'g:ia',
			//'scrollDefaultTime': '9:00pm',
			'disableTimeRanges': dtr
			});

			$('#datepairExample').datepair();
		});
	</script>

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo $url_server; ?>/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="/lib/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo $url_server; ?>/lib/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
