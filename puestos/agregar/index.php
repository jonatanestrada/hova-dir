<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sistema/class/Menu.class.php";
Menu::start(); //Inicia el menú
/**** Aquí va todo el contenido, recomendable usar include_once ****/
if( $_SERVER['HTTP_HOST'] == 'localhost' ) 
	include_once "../../paginas/add_puesto.php";
else
	include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/add_puesto.php";

Menu::end(); // Esto despues del contenido
?>
