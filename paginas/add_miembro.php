<?php
include_once '../../conf.php'
?>
<!DOCTYPE html>
<html lang="en" ng-app='directorioApp'>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>A</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $url_server; ?>/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $url_server; ?>/lib/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css" rel="stylesheet">



    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $url_server; ?>/lib/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" src="<?php echo $url_server; ?>/lib/angular-1.5.8/angular.min.js"></script>
	<script type="text/javascript" src="../../js/directorio.js"></script>

  </head>

  <body ng-controller='DirectorioCntroller'>


    <div class="container-fluid">
      <div class="row">


		<div >
			<?php include_once "../../views/directorio/miembros/add.php"; ?>
		</div>



        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $url_server; ?>/lib/jquery-3.1.1.min.js"></script>

 <link rel="stylesheet" href="/lib/jqueryui_1_10_2/jquery-ui.css">
  <script src="/lib/jqueryui_1_10_2/jquery-ui.js"></script>
  
    <script>
  $( function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
    $( ".datepick" ).datepicker({
  dateFormat: "yy-mm-dd",
  changeYear: true,
  changeMonth: true,
  defaultDate: "-18y"
});

$( "#fecha_ingreso" ).datepicker({
  dateFormat: "yy-mm-dd",
  changeYear: true,
  changeMonth: true
});

  } );
  </script>
  
  	<script>
		$(document).ready(function(){
			$('#ver > option[value="1"]').attr('selected', 'selected');
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
