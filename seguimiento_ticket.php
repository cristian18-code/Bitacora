<?php
    include('config/session.php');
    include('config/conexion.php');

    if ($_SESSION['rol'] != 'Administrador' && $_SESSION['rol'] != 'Supervisor') {
        header("location: principal.php");
    }
    /* Traer los tickets pendientes */
    $ssql = "SELECT tickets.id_ticket,
                    usuarios.username,
                    tipificaciones.nombre_tipificacion,
                    DATE_FORMAT(tickets.fechaReporte, '%d/%m/%Y'),
                    tickets.prioridad,
                    tickets.cierreTicket
                    FROM ((tickets INNER JOIN usuarios ON tickets.id_quienReporta = usuarios.id_usuario)
                    INNER JOIN tipificaciones ON tickets.id_tipoReporte = tipificaciones.id_tipificacion)";
    $qsqlDatos = $con->query($ssql);

    //boton redireccion
    if ($_SESSION['rol'] == 'Administrador') {
        $boton = 'Editar';
    } else if ($_SESSION['rol'] == 'Supervisor') {
        $boton = 'Ver';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/styles/libs/bootstrap.min.css">
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

        <div>   
        <span class="subtitulo"><h2>Tickets <b>soporte Contact</b></h2></span>
        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
        <img src="media/images/mantenimiento.png" alt="Ambulancia-smd" width="120px">
        <input type="text" name="hora" id="hora" value="" readonly>  <!-- Muestra la hora actual en tiempo real -->
        </div>

        <br>

        <table id="registros" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Quien reporta</th>
                    <th>Tipo reporte</th>
                    <th>Fecha</th>
                    <th>Prioridad</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($qsqlDatos as $dato) { ?>
                    <tr>
                        <form action="respuesta_ticket.php" method="post">
                            <td><?php echo $dato['id_ticket']; ?></td>
                            <td><?php echo $dato['username']?></td>
                            <td><?php echo $dato['nombre_tipificacion']?></td>
                            <td><?php echo $dato["DATE_FORMAT(tickets.fechaReporte, '%d/%m/%Y')"]; ?></td>
                            <td><?php echo $dato['prioridad']?></td>
                            <input type="hidden" id="estado" value="<?php echo $dato['cierreTicket']; ?>"> <!-- para dar color a la fila-->
                            <input type="hidden" name="ticket" id="ticket" value="<?php echo $dato['id_ticket'];?>"> <!-- numero de registro -->
                            <td><input type="submit" value="<?php echo $boton;?>" class="btn btn-primary"></td> <!-- Envia los tres datos anteriores -->
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Ticket</th>
                    <th>Quien reporta</th>
                    <th>Tipo reporte</th>
                    <th>Fecha</th>
                    <th>Prioridad</th>
                    <th>Editar</th>
                </tr>
            </tfoot>
        </table>
    </section>

    <div class="adicional"></div>

</body>
<script>
    $(document).ready(function() {
        $('#registros').DataTable(); /* Script para la tabla */
    } );
</script>
    <script src="js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script>
    $("table #estado").each(function() { /* recorrer el campo de cierreTicket de todas las filas */
        var value = this.value; /* Guarda el valor*/
        if (/No/.test(value)) {
            $(this).parent('tr').attr("id", "sinGestion"); /* le da un id a la fila*/
        }
        if (/Seguimiento/.test(value)) {
            $(this).parent('tr').attr("id", "pendiente");
        }
        if (/Si/.test(value)) { 
            $(this).parent('tr').attr("id", "gestionado");
        }
    });
    </script>
    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
</html>