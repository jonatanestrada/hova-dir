	<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sistema/class/Menu.class.php";
Menu::start(); //Inicia el men�
/**** Aqu� va todo el contenido, recomendable usar include_once ****/
include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/add_miembro.php";
Menu::end(); // Esto despues del contenido
?>
