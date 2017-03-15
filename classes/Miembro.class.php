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
$l = isset($datos['lunes']) && $datos['lunes'] != '' ? 1 : 0;
$ma = isset($datos['martes']) && $datos['martes'] != '' ? 2 : 0;
$mi = isset($datos['miercoles']) && $datos['miercoles'] != '' ? 3 : 0;
$j = isset($datos['jueves']) && $datos['jueves'] != '' ? 4 : 0;
$v = isset($datos['viernes']) && $datos['viernes'] != '' ? 5 : 0;
$s = isset($datos['sabado']) && $datos['sabado'] != '' ? 6 : 0;
$id_miembro = $datos['id_miembro'];
$id_descripcion = $datos['id_descripcion'];

$this->addDaytoHorario( $id_miembro, $id_descripcion, $l, $t_start, $t_end );
$this->addDaytoHorario( $id_miembro, $id_descripcion, $ma, $t_start, $t_end  );
$this->addDaytoHorario( $id_miembro, $id_descripcion, $mi, $t_start, $t_end  );
$this->addDaytoHorario( $id_miembro, $id_descripcion, $j, $t_start, $t_end  );
$this->addDaytoHorario( $id_miembro, $id_descripcion, $v, $t_start, $t_end  );
$this->addDaytoHorario( $id_miembro, $id_descripcion, $s, $t_start, $t_end  );
//$this->addDaytoHorario( $datos['domingo'], $t_start, $t_end  );
	
}

private function addDaytoHorario( $id_miembro, $id_descripcion, $day, $t_start, $t_end ){
	if( isset( $day ) )
		if( $day != 0 )
			$this->addDayDB( $id_miembro, $id_descripcion, $day, $t_start, $t_end );
	return false;
}

private function addDayDB( $id_miembro, $id_descripcion, $day, $t_start, $t_end ){
	$sql = "INSERT INTO horarios ( id_miembro, dia, id_descripcion, hora_inicio, hora_fin ) VALUES ( '".$id_miembro."','".$day."', '".$id_descripcion."', '".$t_start."', '".$t_end."');";
	DBO::select_db($this->db);

	$a = DBO::insert($sql);
}

public function getHorarioMiembro( $datos, $dia ){
	$sql = "SELECT * FROM horarios h INNER JOIN descripciones d ON d.id_descripcion = h.id_descripcion WHERE h.id_miembro = '".$datos['id']."' AND h.dia = '".$dia."'";
	DBO::select_db($this->db);
	return DBO::getArray($sql);
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

public function deleteHorario( $datos ){
	$sql = "DELETE FROM horarios WHERE id_horario = '".$datos['id_horario']."';";

	DBO::select_db($this->db);
	$a = DBO::delete($sql);
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

public function listMiembros( $datos, $paginacion = 1 ){
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
	$sql = "SELECT m.*, REPLACE(CONCAT_WS(' ', m.nombre, m.nombre_sec, m.apaterno, m.amaterno) ,'N/A','') AS nombre2, 
	DATE_FORMAT(m.fecha_nacimiento,'%m-%d-%Y') AS fecha_nacimiento, TIMESTAMPDIFF(YEAR, m.fecha_nacimiento, CURDATE()) AS edad,
	TIMESTAMPDIFF(YEAR,m.fecha_ingreso,CURDATE()) AS years_a, ((TIMESTAMPDIFF(MONTH,m.fecha_ingreso,CURDATE())) - (TIMESTAMPDIFF(YEAR,m.fecha_ingreso,CURDATE()) * 12) ) AS months_a,
    cp.nombre AS puesto, p.id_descripcion,
    (SELECT REPLACE(CONCAT_WS(' ', cps.nombre, '-', ms.nombre, ms.nombre_sec, ms.apaterno, ms.amaterno) ,'N/A','') FROM miembros ms 
	
	INNER JOIN puestos ps ON ps.id_puesto = ms.id_puesto
     INNER JOIN cat_puestos cps ON cps.id = ps.id_nombrePuesto
	
	WHERE ms.id_miembro = p.id_puesto_superior) AS jefe
	FROM miembros m
    LEFT JOIN puestos p ON p.id_puesto = m.id_puesto
    LEFT JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto
	WHERE REPLACE(CONCAT_WS(' ', m.nombre, m.nombre_sec, m.apaterno, m.amaterno) ,'N/A','') LIKE '%".$n."%'
	ORDER BY m.id_miembro";
	if( $paginacion == 1 )
		return Response::$data->result = Paginacion::getPaginacion( $sql, $db, $page, 3, 100 );
	else
		{
			DBO::select_db($this->db);
			return DBO::getArray($sql);
		}
}

}