<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sistema/class/Menu.class.php";
Menu::start(); //Inicia el menú
/**** Aquí va todo el contenido, recomendable usar include_once ****/
include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/puestos.php";
Menu::end(); // Esto despues del contenido
?>
