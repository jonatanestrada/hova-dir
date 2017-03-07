<?php
define(ROOT_DIR, $_SERVER['DOCUMENT_ROOT']);
include_once ROOT_DIR."/sistema/api/v1/conexion.php";
include_once ROOT_DIR."/sistema/class/Usuarios.class.php";
include_once ROOT_DIR."sistema/class/Calendario.class.php";

// include_once ROOT_DIR."/sistema/class/Tickets.class.php";
// include_once ROOT_DIR."/sistema/class/SAM.class.php";
class Directorio
{
  public static function test(){
    echo "Testing;!";
  }

  public static function getDirectorio(){
    DBO::select_db('directorio');
    $pre = [];
    $puestos = DBO::getArray("SELECT * FROM puestos");
    foreach ($puestos as $k => $puesto) {
      $puesto['miembro'] = self::getMiembro($puesto['id_puesto']);
      // if($puesto['vacante'] == 0){//no hay miembro
        // $miembro = self::getMiembro($puesto['id_puesto']);
        // $puesto = array_merge($puesto, (array)$miembro);
      // }
      $pre []= $puesto;
    }
    return $pre;
  }

  public static function getMiembro($idPuesto){
    $sql = "SELECT * FROM directorio.miembros WHERE id_puesto = $idPuesto AND active = 1";
    return DBO::get($sql);
  }


}

 ?>
