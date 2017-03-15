	<?php
include_once $_SERVER['DOCUMENT_ROOT']."/menu/Menu.class.php";
Menu::start("Directorio Corporativo"); //Inicia el menú
/**** Aquí va todo el contenido, recomendable usar include_once ****/
if( $_SERVER['HTTP_HOST'] == 'localhost' )
	include_once "../paginas/miembros.php";
else
	include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/miembros.php";
Menu::end(); // Esto despues del contenido
?>
