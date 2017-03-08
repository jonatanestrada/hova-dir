<?php
include_once "../../sistema/api/v1/conexion.php";
include_once "base.api.php";
include_once "Paginacion.class.php";

class Miembro{

var $db;

function __construct() {
       $this->db = 'directorio_v2';
   }

public function addMiembro( $datos ){
	$fn = explode("/", $datos['fecha_nacimiento']);
	//var_dump($fn);
	$fecha_nacimiento = $fn[2].'-'.$fn[0].'-'.$fn[1].' 00:00:00';
	//echo "$d, $m, $y";
	
	$datos['nombre_sec'] = isset($datos['nombre_sec']) ? $datos['nombre_sec'] : '';
	$datos['observaciones'] = isset($datos['observaciones']) ? $datos['observaciones'] : '';
	$datos['amaterno'] = isset($datos['amaterno']) ? $datos['amaterno'] : '';
	$datos['celular'] = isset($datos['celular']) ? $datos['celular'] : '';

	$sql = "INSERT INTO miembros (id_puesto, nombre, nombre_sec, apaterno, amaterno, email, telefono_directo, observaciones, celular, foto, fecha_nacimiento, active) 
	VALUES ('0', '".$datos['nombre']."', '".$datos['nombre_sec']."', '".$datos['apaterno']."', '".$datos['amaterno']."', '".$datos['email']."', '".$datos['telefono_directo']."', '".$datos['observaciones']."', '".$datos['celular']."', 'foto', '".$fecha_nacimiento."', '1');";
//echo $sql;
  DBO::select_db($this->db);
  
  $a = DBO::insert($sql);
  
  //var_dump($a);
  
  //Response::$data->result = DBO::getArray($sql);
//  Response::showResult();
	
}

public function addHorario( $datos ){
//var_dump($datos);
$t_start = $datos['t_start'];
$t_end = $datos['t_end'];
$l = isset($datos['lunes']) ? 1 : 0;
$ma = isset($datos['martes']) ? 2 : 0;
$mi = isset($datos['miercoles']) ? 3 : 0;
$j = isset($datos['jueves']) ? 4 : 0;
$v = isset($datos['viernes']) ? 5 : 0;
$s = isset($datos['sabado']) ? 6 : 0;

$this->addDaytoHorario( $l, $t_start, $t_end );
$this->addDaytoHorario( $ma, $t_start, $t_end  );
$this->addDaytoHorario( $mi, $t_start, $t_end  );
$this->addDaytoHorario( $j, $t_start, $t_end  );
$this->addDaytoHorario( $v, $t_start, $t_end  );
$this->addDaytoHorario( $s, $t_start, $t_end  );
//$this->addDaytoHorario( $datos['domingo'], $t_start, $t_end  );
	
}

private function addDaytoHorario( $day, $t_start, $t_end ){
	if( isset( $day ) )
		if( $day != 0 )
			$this->addDayDB( $day, $t_start, $t_end );
	return false;
}

private function addDayDB( $day, $t_start, $t_end ){
	echo $sql = "INSERT INTO horarios ( dia, id_descripcion, hora_inicio, hora_fin ) VALUES ( '".$day."', '1', '".$t_start."', '".$t_end."');";
	DBO::select_db($this->db);

	$a = DBO::insert($sql);
}

public function addPuestoMiembro( $datos ){
	
	$sql = "UPDATE miembros SET id_puesto = '".$datos['id_puesto']."', fecha_alta_posicion = CURRENT_TIMESTAMP WHERE id_miembro = '".$datos['id_miembro']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function deletePuestoPuesto( $datos ){
	$sql = "UPDATE miembros SET id_puesto = '0', fecha_alta_posicion = NULL WHERE id_miembro = '".$datos['id_miembro']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function darDeBaja( $datos ){
	$sql = "UPDATE miembros SET active = '0', fecha_baja = CURRENT_TIMESTAMP WHERE id_miembro = '".$datos['id_miembro']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function editMiembro( $datos ){
	/*$fn = explode("/", $datos['fecha_nacimiento']);
	var_dump($fn);
	$fecha_nacimiento = $fn[0].'-'.$fn[1].'-'.$fn[2].' 00:00:00';*/

	$sql = "UPDATE miembros SET nombre = '".$datos['nombre']."', nombre_sec = '".$datos['nombre_sec']."', apaterno = '".$datos['apaterno']."', amaterno = '".$datos['amaterno']."', email = '".$datos['email']."', 
telefono_directo = '".$datos['telefono_directo']."', observaciones = '".$datos['observaciones']."', celular = '".$datos['celular']."', foto = 'foto2'
 WHERE id_miembro = '".$datos['id_miembro']."';";


DBO::select_db($this->db);
$a = DBO::doUpdate($sql);

	/*$sql = "INSERT INTO miembros (id_puesto, nombre, nombre_sec, apaterno, amaterno, email, telefono_directo, observaciones, celular, foto, fecha_nacimiento, active) 
	VALUES ('0', '".$datos['nombre']."', '".$datos['nombre_sec']."', '".$datos['apaterno']."', '".$datos['amaterno']."', '".$datos['email']."', '".$datos['telefono_directo']."', '".$datos['observaciones']."', '".$datos['celular']."', 'foto', '2017-02-01 00:00:00', '1');";

  DBO::select_db($this->db);*/
  
  //$a = DBO::insert($sql);
  
  //var_dump($a);
  
  //Response::$data->result = DBO::getArray($sql);
//  Response::showResult();


//echo 'edit';
	
}

public function listMiembrosSinPuesto(){
	$sql = "SELECT *, REPLACE(CONCAT_WS(' ', nombre, nombre_sec, apaterno, amaterno) ,'N/A','') AS nombre FROM miembros WHERE id_puesto = 0 AND active = 1;";
	DBO::select_db($this->db);
	return DBO::getArray($sql);
}

public function listMiembros( $datos ){
	$page = isset( $datos['page'] ) ? $datos['page'] : 1;
	$n = isset( $datos['n'] ) ? $datos['n'] : '';
	if( isset( $datos['n'] ) )
		$n = $datos['n'] == 'undefined'  ? '' : $datos['n'];
	
	$n =  html_entity_decode($n);
	//$n = '';
  //$sql = "SELECT * FROM miembros ORDER BY id_miembro DESC LIMIT 10;";
  //DBO::select_db($this->db);
  //return Response::$data->result = DBO::getArray($sql); TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE())
	$db = $this->db;
	$sql = "SELECT *, REPLACE(CONCAT_WS(' ', nombre, nombre_sec, apaterno, amaterno) ,'N/A','') AS nombre2, 
	DATE_FORMAT(fecha_nacimiento,'%m-%d-%Y') AS fecha_nacimiento, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad,
	TIMESTAMPDIFF(YEAR,fecha_ingreso,CURDATE()) AS years_a, ((TIMESTAMPDIFF(MONTH,fecha_ingreso,CURDATE())) - (TIMESTAMPDIFF(YEAR,fecha_ingreso,CURDATE()) * 12) ) AS months_a
	FROM miembros 
	WHERE REPLACE(CONCAT_WS(' ', nombre, nombre_sec, apaterno, amaterno) ,'N/A','') LIKE '%".$n."%'
	ORDER BY id_miembro";
	return Response::$data->result = Paginacion::getPaginacion( $sql, $db, $page, 3, 10 );
}

}