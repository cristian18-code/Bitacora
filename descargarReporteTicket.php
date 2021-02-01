<?php
///// INCLUIR LA CONEXIÓN A LA BD /////////////////

include('config/session.php');

header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */

mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */
///// CONSULTA A LA BASE DE DATOS /////////////////
						
$Tickets="SELECT * FROM tickets WHERE  (respuestaContact != 'Si' AND respuestaContact != 'seguimiento' AND respuestaContact != '') order by id_ticket ASC";
$GenenHistoricosTickets=$con->query($Tickets);


/* traer el total de los datos del registro recibido*/
$traerDatos = "SELECT t.id_ticket,
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
						WHERE  (respuestaContact != 'Si' AND respuestaContact != 'seguimiento' AND respuestaContact != '') order by id_ticket ASC";
						 $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');

?>

<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/styles/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/styles/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/styles/seguimiento_ticket.css">
    <link rel="stylesheet" href="media/styles/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/getTime.js"></script>
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Reportar incidencia - Bitacora</title>
</head>
<body>
    <header>
    <?php 
        include 'sistema/header.php';
    ?>
        <nav>
        <?php
            include 'sistema/nav.php';
        ?>
        </nav>
    </header>
    <div class="adicional"></div>
	
 <section>
 
 <a href="#ventana1" class="btn btn-primary" data-toggle="modal" id="cuenta" ><span class="icon-download"></span> Generar Reporte</a>
<div class="modal fade" id="ventana1" >

  <div class="modal-dialog" >

	   <div class="modal-content">

				  <!-- Contenedor de titulo ventana emergente-->  
				  <div class="modal-header">

						  <h4 class="modal-title"> Reporte Consolidado de Tickets </h4>
					
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>  

				  </div>
				  <!-- Contenedor de titulo ventana emergente-->
				  <!-- Contenedor de Formulario Descagar reporte-->
				  <div class="modal-body">
				  <section>
					<div id="formulario_usuario" style="z-index:30px;">
							<form method="POST" action="reporteTickets.php">
							<label> Fecha Inicial </label>
							<input type="date" name="fecha1" class="form-control">
                            <br>
							<label> Fecha Final </label>
							<input type="date" name="fecha2" class="form-control">
                            <br>
							<label> Hora Inicial </label>
							<input type="text" name="hora1" class="form-control">
                            <br>
							<label> Hora Final </label>
							<input type="text" name="hora2" class="form-control">
							<br>
							<label style="visibility:hidden;">---------</label>
							<br>
							<input type="submit" name="generar_reportes"  class="btn btn-primary" placeholder="Descargar Reporte" value="Descargar Reporte" id="reporte"></input>
					
							</form>
					</div>	
				</section>
				  </div>

				  <div class="modal-footer">

						  <button type="button" class="btn btn-primary" data-dismiss="modal" ><span class="icon-switch"></span> Cerrar</button> 

				  </div>

	   </div>

  </div>
  
</div>
			<table class="table table-striped table-bordered" id="table" style="width:100%;">
			<thead>
				<tr>
					<th>id Ticket</th>
					<th>Area Solicitante</th>
					<th>Quien Reporta</th>
					<th>Fecha Reporte</th>
					<th>Hora Reporte</th>
					<th>Tipo Reporte</th>
					<th>Tipo Incidencia</th>
					<th>Prioridad</th>
					<th>Fecha Gestion</th>
					<th>Hora Gestion</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($registroTickets = $ver->fetch_array(MYSQLI_BOTH))
				{
					echo'<tr>
						 <td>'.$registroTickets['id_ticket'].'</td>
						 <td>'.$registroTickets['tipificacion_area'].'</td>
						 <td>'.$registroTickets['user_reporta'].'</td>
						 <td>'.$registroTickets['fecha_reporte'].'</td>
						 <td>'.$registroTickets['horaReporte'].'</td>
						 <td>'.$registroTickets['tipo_reporte'].'</td>
						 <td>'.$registroTickets['tipo_incidencia'].'</td>
						 <td>'.$registroTickets['prioridad'].'</td>
                         <td>'.$registroTickets['fecha_respuesta'].'</td>
                         <td>'.$registroTickets['horaRespuesta'].'</td>
						 </tr>';
				}
				?>
			 </tbody>
			 <tfoot>
			 <tr>
			        <th>id Ticket</th>
					<th>Area Solicitante</th>
					<th>Quien Reporta</th>
					<th>Fecha Reporte</th>
					<th>Hora Reporte</th>
					<th>Tipo Reporte</th>
					<th>Tipo Incidencia</th>
					<th>Prioridad</th>
					<th>Fecha Gestion</th>
					<th>Hora Gestion</th>
				</tr>
			</tfoot>

		</table>
</form>
		</section>
		<div class="adicional"></div>
		
	
		
</body>
		<script>
		$(document).ready(function() {
			$('#table').DataTable(); /* Script para la tabla */
		} );
		</script>	
		<script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
		<script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
		<script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>


