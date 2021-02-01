<?php
include('config/session.php');
header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */
mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$hora1=$_POST['hora1'];
$hora2=$_POST['hora2'];
if(isset($_POST['generar_reportes']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Tickets.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Ticket', 'Area Solicitante', 'Quien Reporta', 'Fecha Reporte', 'Hora Reporte', ' Tipo Reporte', 
						   'Tipo Incidencia', 'Detalle Soporte', 'Prioridad', 'Tipicacion TI', 'Fecha Respuesta', 'Hora Respuesta','Cierre Tickets', 'Incidencia Nivel', 
						   'Respuesta TI'));
	// QUERY PARA CREAR EL REPORTE
	$traerDatos=$con->query("SELECT t.id_ticket,
								ti1.nombre_tipificacion AS tipificacion_area,
								u1.nombre AS user_reporta,
								t.horaReporte,
								DATE_FORMAT(t.fechaReporte, '%d/%m/%Y') AS fecha_reporte,
								ti2.nombre_tipificacion AS tipo_reporte,
								ti3.nombre_tipificacion AS tipo_incidencia,
								t.detalleSoporte,
								t.prioridad,
								t.adjuntoReporte,
								t.incidenciaNivel,
								u2.nombre AS user_responde,
								t.respuestaContact,
								DATE_FORMAT(t.fechaRespuesta, '%d/%m/%Y') AS fecha_respuesta,
								t.horaRespuesta,
								t.cierreTicket,
								t.adjuntoSoporte
								FROM (((((tickets t
								INNER JOIN  usuarios u1
									ON t.id_quienReporta = u1.id_usuario)
								LEFT JOIN  usuarios u2
									ON t.id_quienResponde = u2.id_usuario)                    
								INNER JOIN tipificaciones ti1
									ON t.id_area_solicitante = ti1.id_tipificacion)
								INNER JOIN tipificaciones ti2
									ON t.id_tipoReporte = ti2.id_tipificacion)
								INNER JOIN tipificaciones ti3
									ON t.id_tipoIncidencia = ti3.id_tipificacion)
								where fechaReporte BETWEEN '$fecha1' AND '$fecha2' AND horaReporte BETWEEN '$hora1' AND '$hora2' ORDER BY id_ticket ASC");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['respuestaContact'];
		$mensaje = $filaR['detalleSoporte'];

		$filaR['respuestaContact'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
		$filaR['detalleSoporte'] = preg_replace("[\n|\r|\n\r]", "", $mensaje);
	
		
		fputcsv($salida, array($filaR['id_ticket'], 
								$filaR['tipificacion_area'],
								$filaR['tipificacion_area'],
								$filaR['fecha_reporte'],
								$filaR['horaReporte'],
								$filaR['tipo_reporte'],
								$filaR['tipo_incidencia'],
								$filaR['detalleSoporte'],
								$filaR['prioridad'],
								$filaR['respuestaContact'],
								$filaR['fecha_respuesta'],
								$filaR['horaRespuesta'],
								$filaR['cierreTicket'],
								$filaR['incidenciaNivel'],
								$filaR['user_reporta']));
							
    }
}
?>