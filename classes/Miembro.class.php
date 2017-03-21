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
	//$fn = explode("/", $datos['fecha_nacimiento']);
	//var_dump($fn);
	//$fecha_nacimiento = $fn[2].'-'.$fn[0].'-'.$fn[1].' 00:00:00';
	//echo "$d, $m, $y";
	$fecha_nacimiento = $datos['fecha_nacimiento'].' 00:00:00';
	$fecha_ingreso = $datos['fecha_ingreso'].' 00:00:00';
	
	$datos['nombre_sec'] = isset($datos['nombre_sec']) ? $datos['nombre_sec'] : '';
	$datos['observaciones'] = isset($datos['observaciones']) ? $datos['observaciones'] : '';
	$datos['amaterno'] = isset($datos['amaterno']) ? $datos['amaterno'] : '';
	$datos['celular'] = isset($datos['celular']) ? $datos['celular'] : '';

	$sql = "INSERT INTO miembros (id_puesto, nombre, nombre_sec, apaterno, amaterno, email, telefono_directo, observaciones, celular, foto, fecha_nacimiento, fecha_ingreso, active) 
	VALUES ('0', '".$datos['nombre']."', '".$datos['nombre_sec']."', '".$datos['apaterno']."', '".$datos['amaterno']."', '".$datos['email']."', '".$datos['telefono_directo']."', '".$datos['observaciones']."', '".$datos['celular']."', 'foto', '".$fecha_nacimiento."', '".$fecha_ingreso."', '1');";
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

public function altaPortal( $data ){
	/*$sql = "INSERT INTO horarios ( id_miembro, dia, id_descripcion, hora_inicio, hora_fin ) VALUES ( '".$id_miembro."','".$day."', '".$id_descripcion."', '".$t_start."', '".$t_end."');";
	DBO::select_db($this->db);
	
	$a = DBO::insert($sql);*/
	
	//var_dump($data);
	
	if( $UserIdForEmpleado = $this->existUserIdForEmpleado( $data['id_miembro'] ) ){
		$data['usu_id'] = $UserIdForEmpleado;
		if( $this->existUserPortal( $data['usu_id'] ) )
			$this->updatePassUserPortal( $data['usu_id'], $data['password'] );
		else
			$this->addUSerDBPortal( $data );
		$user_id = $this->getLastUserIdMiembros() + 1;
		$this->setAccessPortal( $data['id_miembro'], $user_id, 0 );
		//echo 'Existe';
	}
	else{
		//echo 'No Existe';
		$data['usu_id'] = $this->getLastUserIdMiembros() + 1;
		$oldID = $this->addUSerDBPortal( $data );
		$user_id = $data['usu_id'];
		$this->setAccessPortal( $data['id_miembro'], $user_id );
	}
	
	
	
	$id_sistema = 1;
	$id_miembro = $data['id_miembro'];
	
	//$this->logAltaSistema( $id_sistema, $id_miembro );
}
	private function setAccessPortal( $id_miembro, $user_id, $setUser = 1 ){
		if( $setUser )
			$set_user_id = ", user_id = '".$user_id."'";
		else
			$set_user_id = '';
	
		$sql = "UPDATE miembros SET accesoPortal = '1' $set_user_id WHERE id_miembro = '".$id_miembro."';";

		DBO::select_db($this->db);
		$a = DBO::doUpdate($sql);
	}
	
	private function getLastUserIdMiembros(){
		$sql = 'SELECT Max(user_id) AS maxId FROM miembros';
		DBO::select_db($this->db);
		$row = DBO::get($sql);
		$lastUserIdMiembros = $row->maxId;
		return $lastUserIdMiembros;
	}
	
	private function updateIDUserPortal( $oldID, $newID ){	
		$sql = "UPDATE usuario SET usu_id = '".$oldID."' WHERE usu_id = '".$newID."';";

		DBO::select_db($this->db);
		$a = DBO::doUpdate($sql);
	}
	
	private function existUserIdForEmpleado( $id_miembro ){
		$sql = "SELECT * FROM miembros WHERE id_miembro = '".$id_miembro."';";
		DBO::select_db($this->db);
		$row = DBO::get($sql);
		
		if( !$row->user_id )
			return false;
		else
			return $row->user_id;
	}
	
	private function existUserPortal( $usu_id ){
		$sql = "SELECT * FROM usuario WHERE usu_id = '".$usu_id."';";
		DBO::select_db('hovahlt');
		$row = DBO::get($sql);
		
		if( !$row->usu_id )
			return false;
		else
			return $row->usu_id;
	}
	
	

    private function addUSerDBPortal( $d ){
		
		$datos['usu_id'] = $d['usu_id'];
		$datos['usu_nom'] = $d['nombre'].' '.$d['nombre_sec'];
		$datos['usu_pat'] = $d['apaterno'];
		$datos['usu_mat'] = $d['amaterno'];
		$datos['usu_alias'] = $d['username'];
		$datos['usu_psw'] = $d['password'];
		$datos['usu_mail'] = $d['email'];
		$datos['catNivelUsuario_niv_id'] = $d['nivelUser'];
	
		$sql = "INSERT INTO usuario ( usu_id, usu_nom, usu_pat, usu_mat, usu_alias, usu_psw, usu_mail, usu_cel, usu_sky, catNivelUsuario_niv_id, zona, gerente, 
		usu_lastlogin, foto, area_usuarios, area2_usuarios, clave_area, clave_usuario) 
		VALUES ('".$datos['usu_id']."', '".$datos['usu_nom']."', '".$datos['usu_pat']."', '".$datos['usu_mat']."', '".$datos['usu_alias']."', '".$datos['usu_psw']."', '".$datos['usu_mail']."', 
		'', '', '".$datos['catNivelUsuario_niv_id']."', '0', '0', CURRENT_TIMESTAMP, NULL, '', NULL, '', '');";
		DBO::select_db('hovahlt');
	
		return DBO::insert($sql, true);
	}
	
public function bajaPortal( $datos ){
	$password = '$sin.password$!';
	$usu_id = $datos['user_id'];
	$this->updatePassUserPortal( $usu_id, $password );

	$this->setDenyAccessPortal( $datos['id_miembro'] );
}

public function updatePassUserPortal( $usu_id, $password ){

	$sql = "UPDATE usuario SET usu_alias = '".$password."' WHERE usu_id = '".$usu_id."';";

	DBO::select_db('hovahlt');
	$a = DBO::doUpdate($sql);
}

	private function setDenyAccessPortal( $id_miembro ){
		$sql = "UPDATE miembros SET accesoPortal = '0' WHERE id_miembro = '".$id_miembro."';";

		DBO::select_db($this->db);
		$a = DBO::doUpdate($sql);
	}


private function logAltaSistema( $id_sistema, $id_miembro ){
	$this->addlogSistemas( $id_sistema, $id_miembro, 1 );
}

private function logBajaSistema( $id_sistema, $id_miembro ){
	$this->addlogSistemas( $id_sistema, $id_miembro, 0 );
}

private function addlogSistemas( $id_sistema, $id_miembro, $tipo ){
	$sql = "INSERT INTO logs_sistemas ( id_sistema, id_miembro, action ) VALUES ( '".$id_sistema."', '".$id_miembro."', '".$tipo."');";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
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
	$fecha_nacimiento = $datos['fecha_nacimiento'] == '' ? '' : $datos['fecha_nacimiento'].' 00:00:00';
	$fecha_ingreso = $datos['fecha_ingreso'] == '' ? '' : $datos['fecha_ingreso'].' 00:00:00';

	$sql = "UPDATE miembros SET fecha_ingreso = '".$fecha_ingreso."', fecha_nacimiento = '".$fecha_nacimiento."', nombre = '".$datos['nombre']."', nombre_sec = '".$datos['nombre_sec']."', apaterno = '".$datos['apaterno']."', amaterno = '".$datos['amaterno']."', email = '".$datos['email']."', 
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

public function catNivelesUsuario(){
	$sql = "SELECT * FROM catnivelusuario;";
	DBO::select_db('hovahlt');
	return DBO::getArray($sql);
}

public function listMiembros( $datos, $paginacion = 1 ){
	$page = isset( $datos['page'] ) ? $datos['page'] : 1;
	$n = isset( $datos['n'] ) ? $datos['n'] : '';
	if( isset( $datos['n'] ) )
		$n = $datos['n'] == 'undefined'  ? '' : $datos['n'];
		
	$statusEmpleado = isset( $datos['statusEmpleado'] ) ? $datos['statusEmpleado'] : '';
	if( isset( $datos['statusEmpleado'] ) )
		$statusEmpleado = $datos['statusEmpleado'] == 'undefined'  ? 1 : $datos['statusEmpleado'];
	
	$n =  html_entity_decode($n);
	//$n = '';
  //$sql = "SELECT * FROM miembros ORDER BY id_miembro DESC LIMIT 10;";
  //DBO::select_db($this->db);
  //return Response::$data->result = DBO::getArray($sql); TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE())
	$db = $this->db;
	$sql = "SELECT m.*, REPLACE(CONCAT_WS(' ', m.nombre, m.nombre_sec, m.apaterno, m.amaterno) ,'N/A','') AS nombre2, 
	DATE_FORMAT(m.fecha_nacimiento,'%Y-%m-%d') AS fecha_nacimiento, DATE_FORMAT(m.fecha_ingreso,'%Y-%m-%d') AS fecha_ingreso, TIMESTAMPDIFF(YEAR, m.fecha_nacimiento, CURDATE()) AS edad,
	TIMESTAMPDIFF(YEAR,m.fecha_ingreso,CURDATE()) AS years_a, ((TIMESTAMPDIFF(MONTH,m.fecha_ingreso,CURDATE())) - (TIMESTAMPDIFF(YEAR,m.fecha_ingreso,CURDATE()) * 12) ) AS months_a,
    cp.nombre AS puesto, p.id_descripcion,
    (SELECT REPLACE(CONCAT_WS(' ', cps.nombre, '-', ms.nombre, ms.nombre_sec, ms.apaterno, ms.amaterno) ,'N/A','') FROM miembros ms 
	
	INNER JOIN puestos ps ON ps.id_puesto = ms.id_puesto
     INNER JOIN cat_puestos cps ON cps.id = ps.id_nombrePuesto
	
	WHERE ms.id_miembro = p.id_puesto_superior) AS jefe
	FROM miembros m
    LEFT JOIN puestos p ON p.id_puesto = m.id_puesto
    LEFT JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto
	WHERE m.active = '".$statusEmpleado."'  AND REPLACE(CONCAT_WS(' ', m.nombre, m.nombre_sec, m.apaterno, m.amaterno) ,'N/A','') LIKE '%".$n."%'
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