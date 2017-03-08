<?php
include_once "conexion.php";
include_once "base.api.php";
include_once "Paginacion.class.php";

class Permiso{

var $db;

function __construct() {
       $this->db = 'sistemas';
   }

public function updateDetalle( $datos ){
	$sql = "UPDATE permisos_cat SET permiso_detalles = '".html_entity_decode($datos['permiso_detalles'])."' WHERE permiso_id = '".$datos['permiso_id']."';";
	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function updateGroup( $datos ){
	$sql = "UPDATE permisos_cat SET id_grupo = '".$datos['group']."' WHERE permiso_id = ".$datos['permiso_id'].";";
	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function updatePagina( $datos ){
	$sql = "UPDATE permisos_cat SET id_pagina = '".$datos['id_pagina']."' WHERE permiso_id = ".$datos['permiso_id'].";";
	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
} 

public function listGroups(){
  $sql = "SELECT * FROM permisos_grupo";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listPags(){
  $sql = "SELECT * FROM permisos_pagina";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}
 
public function listCatPuestos( $datos ){
  $sql = "SELECT pc.*, pg.id_grupo as 'group', pg.grupo as groupName, pp.pagina as pagina
FROM permisos_cat pc
LEFT JOIN permisos_grupo pg ON pg.id_grupo = pc.id_grupo
LEFT JOIN permisos_pagina pp ON pp.id_pagina = pc.id_pagina";
  $db = 'sistemas';
  $page = isset( $datos['page'] ) ? $datos['page'] : 1;
  
  return Response::$data->result = Paginacion::getPaginacion( $sql, $db, $page, 3, 100 );
  
}



}