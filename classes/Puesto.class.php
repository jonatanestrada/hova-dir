<?php
include_once "../../sistema/api/v1/conexion.php";
include_once "base.api.php";
include_once "Paginacion.class.php";

class Puesto{

var $db;

function __construct() {
       $this->db = 'directorio';
   }

public function add( $datos ){	
	$datos['observaciones'] = isset($datos['observaciones']) ? $datos['observaciones'] : 'NULL';
	$sql = "INSERT INTO puestos ( id_miembro, nombre, proyecto, clave, descripcion, responde_a, id_nombrePuesto, id_proyecto, id_clave, id_descripcion, observaciones, 
	id_puesto_superior, fecha_insert, fecha_update, vacante, status) VALUES ( '0', '', '', '', '', '', '".$datos['id_nombrePuesto']."', '".$datos['id_proyecto']."', '".$datos['id_clave']."', '".$datos['id_descripcion']."', 
	".$datos['id_descripcion'].", '".$datos['id_puesto_superior']."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1', '1');";
//echo $sql;
	DBO::select_db($this->db);  
	$a = DBO::insert($sql);  
}

public function edit( $datos ){
	$sql = "UPDATE puestos SET id_nombrePuesto = '".$datos['id_nombrePuesto']."', id_proyecto = '".$datos['id_proyecto']."', id_clave = '".$datos['id_clave']."', 
id_descripcion = '".$datos['id_descripcion']."', observaciones = '".$datos['id_descripcion']."', id_puesto_superior = '".$datos['id_puesto_superior']."' WHERE id_puesto = '".$datos['id_puesto']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function AddMiembroPuesto( $datos ){
	$sql = "UPDATE puestos SET vacante = '0', fecha_update = CURRENT_TIMESTAMP,  id_miembro = '".$datos['id_miembro']."' WHERE id_puesto = '".$datos['id_puesto']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
	
	$this->logAltaPuesto( $datos['id_puesto'], $datos['id_miembro'] );
}

private function logAltaPuesto( $id_puesto, $id_miembro ){
	$this->addlogPuestos( $id_puesto, $id_miembro, 1 );
}

private function logBajaPuesto( $id_puesto, $id_miembro, $motivo ){
	$this->addlogPuestos( $id_puesto, $id_miembro, 0, $motivo );
}

private function addlogPuestos( $id_puesto, $id_miembro, $tipo, $descripcion = '' ){
	$sql = "INSERT INTO logs_puestos ( id_puesto, id_miembro, tipo, descripcion ) VALUES ('".$id_puesto."', '".$id_miembro."', '".$tipo."', '".$descripcion."');";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
}

public function deleteMiembroPuesto( $datos ){
	$datos['motivo'] = isset($datos['motivo']) ? $datos['motivo'] : ''; 
	
	$sql = "UPDATE puestos SET vacante = '1', fecha_update = CURRENT_TIMESTAMP, id_miembro = '0' WHERE id_puesto = '".$datos['id_puesto']."';";

	DBO::select_db($this->db);
	$a = DBO::doUpdate($sql);
	
	$this->logBajaPuesto( $datos['id_puesto'], $datos['id_miembro'], $datos['motivo'] );
}

public function listPuestos( $datos ){
	$page = isset( $datos['page'] ) ? $datos['page'] : 1;

$n = isset( $datos['n'] ) ? $datos['n'] : '';
	if( isset( $datos['n'] ) )
		$n = $datos['n'] == 'undefined'  ? '' : $datos['n'];

$v = isset( $datos['vacantes'] ) ? $datos['vacantes'] : '';
	if( isset( $datos['vacantes'] ) )
		$n = $datos['vacantes'] == 'undefined'  ? '' : $datos['vacantes'];
	
	$n =  html_entity_decode($n);
	
	if( $v == 1 )
		$vacante = ' AND vacante = 1 ';
	else
		$vacante = '';
	
	$db = $this->db;
	$sql = "SELECT *, cp.nombre AS nombre, py.nombre AS proyecto,
c.nombre AS clave, d.nombre AS descripcion,

(SELECT CONCAT(cs.nombre, ' - ', ms.nombre, ' ', ms.apaterno) FROM puestos ps INNER JOIN cat_puestos cs ON cs.id = ps.id_nombrePuesto INNER JOIN miembros ms ON ms.id_miembro = ps.id_miembro WHERE ps.id_puesto = p.id_puesto_superior) AS responde_a,

(SELECT REPLACE(CONCAT_WS(' ', me.nombre, me.nombre_sec, me.apaterno, me.amaterno) ,'N/A','') FROM miembros me WHERE me.id_miembro = p.id_miembro) AS nombre_empleado,

(SELECT count(*) FROM puestos psub WHERE psub.id_puesto_superior = p.id_puesto ) AS subordinado
FROM puestos p
INNER JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto
INNER JOIN proyectos py ON py.id_proyecto = p.id_proyecto
INNER JOIN claves c ON c.id_clave = p.id_clave
INNER JOIN descripciones d ON d.id_descripcion = p.id_descripcion
WHERE 1 $vacante
";
	return Response::$data->result = Paginacion::getPaginacion( $sql, $db, $page, 3, 100 );
}

public function exportExcel(){
  $sql = "SELECT cp.nombre AS posicion, py.nombre AS proyecto,
c.nombre AS clave, d.nombre AS descripcion, p.observaciones,
cpj.nombre AS responde_a, m.nombre as nombre_p, m.nombre_sec, m.apaterno, m.amaterno, m.telefono_directo, m.observaciones AS observaciones2, m.celular, m.email,
p.* FROM puestos p
INNER JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto
INNER JOIN proyectos py ON py.id_proyecto = p.id_proyecto
INNER JOIN claves c ON c.id_clave = p.id_clave
INNER JOIN descripciones d ON d.id_descripcion = p.id_descripcion
INNER JOIN cat_puestos cpj ON cpj.id = p.id_puesto_superior
INNER JOIN miembros m ON m.id_miembro = p.id_miembro";
		
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listCatPuestos(){
  $sql = "SELECT * FROM cat_puestos";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}


public function listSubordinados( $data ){
  $sql = "SELECT p.*, (SELECT REPLACE(CONCAT_WS(' ', m.nombre, m.nombre_sec, m.apaterno, m.amaterno) ,'N/A','') FROM miembros m WHERE m.id_miembro = p.id_miembro  ) AS nombre,
			cp.nombre as puesto, c.nombre AS clave_cat
			FROM puestos p
			INNER JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto
			INNER JOIN claves c ON c.id_clave = p.id_clave

WHERE p.id_puesto_superior =  '".$data['id']."';";
		
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listCatProyectos(){
  $sql = "SELECT * FROM proyectos";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listCatClaves(){
  $sql = "SELECT * FROM claves";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listCatDescripciones(){
  $sql = "SELECT descripciones.*, c.nombre AS clave FROM descripciones
INNER JOIN claves c ON c.id_clave = descripciones.id_clave";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

public function listCatSuperiores(){
  $sql = "SELECT p.id_puesto, CONCAT(cp.nombre,' - ',m.nombre, ' ', m.apaterno) AS nombre FROM puestos p INNER JOIN cat_puestos cp ON cp.id = p.id_nombrePuesto LEFT JOIN miembros m ON m.id_miembro = p.id_miembro";
  DBO::select_db($this->db);
  return DBO::getArray($sql);
}

}