<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once $_SERVER['DOCUMENT_ROOT']. '/lib/PHPExcel.php';
require_once '../classes/Puesto.class.php';
$puesto = new Puesto;

$puestos = $puesto->exportExcel();


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("")
							 ->setLastModifiedBy("")
							 ->setTitle("")
							 ->setSubject("")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");


// Add some data
$i = 1;
				  
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Posición')
            ->setCellValue('B1', 'Proyecto')
            ->setCellValue('C1', 'Clave')
			->setCellValue('D1', 'Descripción')
			->setCellValue('E1', 'Observaciones')
			->setCellValue('F1', 'Responde a')
			->setCellValue('G1', 'Nombre')
            ->setCellValue('H1', 'Nombre2')
			->setCellValue('I1', 'A paterno')
			->setCellValue('J1', 'A Materno')
			->setCellValue('K1', 'Cumpleaños')
			->setCellValue('L1', 'Tel. Directo')
			->setCellValue('M1', 'Observaciones2')
			->setCellValue('N1', 'Celular')
			->setCellValue('O1', 'E-Mail')
			->setCellValue('P1', 'Edad')
			->setCellValue('Q1', 'F. Ingreso')
			->setCellValue('R1', 'Antigüedad')
			->setCellValue('S1', 'Disp. L')
			->setCellValue('T1', 'Disp. M')
			->setCellValue('U1', 'Disp. Mc')
			->setCellValue('V1', 'Disp. J')
			->setCellValue('W1', 'Disp. V')
			->setCellValue('X1', 'Disp. S')
			->setCellValue('U1', 'Disp. D')
			->setCellValue('Y1', 'ID Directorio')
			/*->setCellValue('AA', 'Activo/Inactivo')
			->setCellValue('AB', 'ID Usuario')
			->setCellValue('AC', 'F. Alta Posición')
			->setCellValue('AD', 'F. Baja Posición')
			->setCellValue('AE', 'F. Alta Portal Hova')
			->setCellValue('AF', 'F. Baja Portal Hova')
			->setCellValue('AG', 'F. F. Alta SIG')
			->setCellValue('AH', 'F. Baja SIG')*/
			;
				  

foreach( $puestos AS $m ){

$i++;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $m['posicion'])
            ->setCellValue('B'.$i, $m['proyecto'])
            ->setCellValue('C'.$i, $m['clave'])
			->setCellValue('D'.$i, $m['descripcion'])
			->setCellValue('E'.$i, $m['observaciones'])
			->setCellValue('F'.$i, $m['responde_a'])
			->setCellValue('G'.$i, $m['nombre_p'])
            ->setCellValue('H'.$i, $m['nombre_sec'])
			->setCellValue('I'.$i, $m['apaterno'])
			->setCellValue('J'.$i, $m['amaterno'])
			->setCellValue('K'.$i, 'NULL')
			->setCellValue('L'.$i, $m['telefono_directo'])
			->setCellValue('M'.$i, $m['observaciones2'])
			->setCellValue('N'.$i, $m['celular'])
			->setCellValue('O'.$i, $m['email'])
			;


}	

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="empleados.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
