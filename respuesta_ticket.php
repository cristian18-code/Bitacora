<?php 

    include('config/session.php');
    include('config/conexion.php');

    if ($_SESSION['rols'] != 'Administrador' && $_SESSION['rols'] != 'Supervisor') {
        header("location: principal.php");
    }

    if (empty($_POST['ticket'])) {

        header("location: seguimiento_ticket.php");
        
    } else {
        $registro = $_POST['ticket']; // recibe registro a actualizar

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
                            WHERE t.id_ticket = '$registro'";


    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');
    
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
<link rel="stylesheet" href="media/styles/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/styles/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/styles/reportar_incidencia.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/getTime.js"></script>
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Respuesta Soporte - Bitacora</title>
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

    <section id="container">
    <div id="formulario_reportar">        
        <h1>Solicitudes Soporte Contact</h1>
        <hr>
        <?php if ($_SESSION['rols'] == 'Administrador') { ?><div class="alerta"></div> <?php } ?>
            <form enctype="multipart/form-data" method="post" name="formRespuesta" id="formRespuesta">
                <div class="form-group" style="text-align: center;">
                <label for="id" style="font-weight: 700;">Ticket N°</label>
                <input type="text" class="form-control" name="id" id="id" readonly value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/images/mantenimiento.png" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUser']; ?>">
                </div>

            <?php foreach ($ver as $dato) { ?>
                <div id="msg" style="text-align: center; padding: 10px;"></div> <!-- Para mostrar numero de gestiones -->

                <script> /* Semaforizacion de si el ticket ya fue cerrado o no */
                    $(document).ready(function(){

                    var gestion = '<?php echo $dato['cierreTicket'] ?>';

                    switch (gestion) {
                        case 'No': 
                                    document.getElementById("msg").innerHTML = "Este ticket aun no ha sido gestionado";
                                    document.getElementById("msg").style.color = "red";

                            break;
                        case 'Seguimiento': 
                                    document.getElementById("msg").innerHTML = "Este ticket se encuentra en seguimiento";
                                    document.getElementById("msg").style.color = "orange";
                            break;
                        case 'Si': 
                                    document.getElementById("msg").innerHTML = "Este ticket ya fue gestionado";
                                    document.getElementById("msg").style.color = "green";
                            break;
                    }
                    });
                </script>

                <div id="cont-diaHora" class="form-group row">
                    <label for="diaHora" class="col-sm-4 col-form-label">Fecha de incidencia</label>
                    <div class="col-sm-8">
                        <input type="text" name="diaHora" id="diaHora" class="form-control" value="Dia: <?php echo $dato['fecha_reporte']; ?>  Hora: <?php echo $dato['horaReporte']; ?>" readonly>
                    </div>
                </div>

                <?php if ($dato['cierreTicket'] != 'No') { ?>
                    <div id="cont-diaHora_respuesta" class="form-group row">
                    <label for="diaHora_respuesta" class="col-sm-4 col-form-label">Dia y hora de Respuesta</label>
                    <div class="col-sm-8">
                        <input type="text" name="diaHora_respuesta" id="diaHora_respuesta" class="form-control" value="Dia: <?php echo $dato['fecha_respuesta']; ?> Hora: <?php echo $dato['horaRespuesta']; ?>" readonly>
                    </div>
                </div>
                <?php } ?>

                <div class="form-group row" id="cont-area_solicitante">
                    <label for="area_solicitante" class="col-sm-4 col-form-label">Area solicitante</label>
                    <div class="col-sm-8">
                        <input type="text" name="area_solicitante" id="are_solicitante" class="form-control" readonly value="<?php echo $dato['tipificacion_area']; ?>">
                    </div>
                </div>

                <div class="form-group row" id="cont-reporte">
                    <label for="reporte" class="col-sm-4 col-form-label">Reporte</label>
                    <div class="col-sm-8">
                    <input type="text" name="reporte" id="reporte" class="form-control" readonly value="<?php echo $dato['tipo_reporte']; ?>">
                    </div>
                </div>

                <div class="form-group row" id="cont-incidencia">
                    <label for="incidencia" class="col-sm-4 col-form-label">Tipo de incidencia</label>
                    <div class="col-sm-8">
                        <input type="text" name="incidencia" class="form-control" id="incidencia" value="<?php echo $dato['tipo_incidencia']; ?>" readonly>
                    </div>
                </div>
            
                <div class="form-group row" id="cont-nombreSolicitante">
                    <label for="nombreSolicitante" class="col-sm-4 col-form-label">Nombre solicitante</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombreSolicitante" id="nombreSolicitante" class="form-control" readonly value="<?php echo $dato['user_reporta']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 row" id="cont-prioridad">
                        <label for="prioridad" class="col-sm-4 col-form-label">Prioridad</label>
                        <div class="col-sm-8">
                            <input type="text" name="prioridad" class="form-control" id="prioridad" value="<?php echo $dato['prioridad']; ?>" readonly>
                        </div>
                    </div>

                    <script>
                        $("form #prioridad").each(function() { /* recorrer el campo de cierreTicket de todas las filas */
                            var value = this.value; /* Guarda el valor*/
                            if (/Alta/.test(value)) {
                                $(this).css("border", "red 1px solid"); /* le da un color*/
                            }
                            if (/Media/.test(value)) {
                                $(this).css("border", "orange 1px solid"); /* le da un id a la fila*/
                            }
                            if (/Baja/.test(value)) { 
                                $(this).css("border", "green 1px solid"); /* le da un id a la fila*/
                            }
                        });
                    </script>

                    <div class="form-group col-6 row">
                        <label for="inputZip" class="col-sm-6 col-form-label">Incidencia a nivel</label>
                        <div class="col-sm-6">
                            <input type="text" name="incidencia" class="form-control" id="incidencia" value="<?php echo $dato['incidenciaNivel']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group row" id="cont-detalle">
                    <label for="detalle" class="col-sm-4 col-form-label">Descripción de reporte</label>
                    <div class="col-sm-8">
                        <textarea name="detalle" id="detalle" class="form-control" style="resize:none;" readonly><?php echo $dato['detalleSoporte']; ?></textarea>
                    </div>
                </div>

                <?php if ($dato['adjuntoReporte'] != NULL ) { ?>
                    <center><p><a href="archivos/<?php echo $dato['adjuntoReporte']; ?>" target="_blank">Ver adjunto de reporte</a></p></center>
                <?php } ?>

                <div class="form-group row" id="cont-respuesta">
                    <label for="respuesta" class="col-sm-4 col-form-label">Respuesta soporte</label>
                    <div class="col-sm-8">
                        <textarea name="respuesta" id="respuesta" style="resize:none;" class="form-control"<?php if ($_SESSION['rols'] == 'Administrador' && $dato['cierreTicket'] != 'Si') { ?> autofocus required<?php } else { ?> readonly<?php } ?>><?php if ($dato['cierreTicket'] != 'No' && $dato['respuestaContact'] != NULL) { echo $dato['respuestaContact']; } ?></textarea>
                    </div>
                </div>

                <?php if ($dato['adjuntoSoporte'] != NULL ) { ?>
                    <center><p><a href="archivos/archivosSoporte/<?php echo $dato['adjuntoSoporte']; ?>" target="_blank">Ver adjunto de Soporte</a></p></center>
                <?php } ?>

                <?php if ($dato['cierreTicket'] != 'No') { ?>    
                <div class="form-group row" id="cont-nombreResponde">
                    <label for="nombreResponde" class="col-sm-4 col-form-label">Quien Responde</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombreResponde" id="nombreResponde" class="form-control" readonly value="<?php echo $dato['user_responde']; ?>">
                    </div>
                </div>
                <?php } ?>
                
                <?php if ($_SESSION['rols'] == 'Administrador' && $dato['cierreTicket'] != 'Si') { ?>
                <div class="form-group row" id="cont-archivo">
                    <label for="archivo" class="col-sm-4 col-form-label">Adjuntar</label>
                    <div class="col-sm-8">
                        <input type="file" name="archivo" class="form-control" id="archivo" multiple>
                    </div>
                </div>
                <?php } ?>

                <?php if ($_SESSION['rols'] == 'Administrador' && $dato['cierreTicket'] != 'Si') { ?>
                <div class="form-group row" id="cont-cerrarTicket">
                    <label for="cerrarTicket" class="col-sm-4 col-form-label">¿Cerrar Ticket?</label>
                    <div class="col-sm-8">
                        <select name="cerrarTicket" id="cerrarTicket" class="form-control" required>
                            <option value="" hidden>Selecciona un valor</option>
                            <option value="Si">Si</option>
                            <option value="Seguimiento">Seguimiento</option>
                        </select>
                    </div>
                </div>
                <?php } ?>

                <?php if ($_SESSION['rols'] == 'Administrador' && $dato['cierreTicket'] != 'Si') { ?>   
                    <center><input type="submit" class="btn btn-primary" id="btn_enviarRespuesta" name="btn_enviarRespuesta" value="Enviar"></center>
                <?php } ?>
            <?php } ?>
            </form>
        </div>    
    </section>

</body>

<script>

</script>
<script src="sistema/js/peticiones_ajax.js"></script>
</html>
<?php 
    } // condicion de id ticket
?>