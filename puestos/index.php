<?php
include_once $_SERVER['DOCUMENT_ROOT']."/menu/Menu.class.php";
Menu::start("Directorio Corporativo"); //Inicia el menú
/**** Aquí va todo el contenido, recomendable usar include_once ****/
if( $_SERVER['HTTP_HOST'] == 'localhost' )
	include_once "../paginas/puestos.php";
else
	include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/puestos.php";

Menu::end(); // Esto despues del contenido
?>
