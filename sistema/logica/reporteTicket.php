<?php
include('logica/conexion.php');//CONEXION A LA BD
header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */
mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$hora1=$_POST['hora1'];
$hora2=$_POST['hora2'];

if(isset($_POST['generar_reporte']))
{
	// NOMBRE DEL ARCHIVO Y CHARSET
	header('Content-Type:text/vnd.ms-excel; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Tickets.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Ticket', 'Area Solicitante', 'Quien Reporta', 'Fecha Reporte', 'Hora Reporte', ' Tipo Reporte', 
						   'Tipo Incidencia', 'Detalle Soporte', 'Prioridd', 'Tipicacion TI', 'Fecha Respuesta', 'Hora Respuesta','Cierre Tickets', 'Incidenicia Nivel', 
						   'Respuesta TI'));
	// QUERY PARA CREAR EL REPORTE
	$reporteCsv=$conectar->query("SELECT id_ticket,
										 id_area_solicitante,
										 id_quienReporta,
										 fechaReporte,
										 horaReporte,
										 id_tipoReporte,
										 id_tipoIncidencia,
										 detalleSoporte,
										 prioridad,
										 respuestaContact,
										 fechaRespuesta,
										 horaRespuesta,
										 cierreTicket,
										 incidenciaNivel,
										 idquienResponde
										 FROM tickets where fechaReporte BETWEEN '$fecha1' AND '$fecha2' AND horaReporte BETWEEN '$hora1' AND '$hora2' ORDER BY id_ticket");

	foreach ($reporteCsv as $filaR) {
				
		$cadena = $filaR['Nota'];
		$mensaje = $filaR['mensaje'];

		$filaR['detalleSoporte'] = preg_replace("[\n|\r|\n\r]", "", $cadena);

		
		fputcsv($salida, array($filaR['id_ticket'], 
								$filaR['id_area_solicitante'],
								$filaR['id_quienReporta'],
								$filaR['fechaReporte'],
								$filaR['horaReporte'],
								$filaR['id_tipoReporte'],
								$filaR['id_tipoIncidencia'],
								$filaR['detalleSoporte'],
								$filaR['prioridad'],
								$filaR['respuestaContact'],
								$filaR['fechaRespuesta'],
								$filaR['horaRespuesta'],
								$filaR['cierreTicket'],
								$filaR['incidenciaNivel'],
								$filaR['idquienResponde']));
							
	}
}
?>