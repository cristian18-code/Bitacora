<?php 

    include('../../config/db.php');
    include('../../config/conexion.php');

    /* Trae el ultimo registro creado */
    /* Trae el numero de tickets pendientes */

    $rol = $_POST['rol'];
    $usuario = $_POST['usuario'];

    if ($rol == 'Administrador') { 

        $traerDatos = "SELECT count(*) from tickets WHERE cierreTicket != 'Si'";
        $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

        if ($row = mysqli_fetch_row($ver)) {
            $tickets = $row[0];
        }
        
    } else if ($rol == 'Supervisor') {
        
        $traerDatos = "SELECT count(*) from tickets
                                        WHERE tickets.cierreTicket != 'Si' AND id_quienReporta = ".$usuario."";
        $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

        if ($row = mysqli_fetch_row($ver)) {
            $tickets = $row[0];
        }
    }

    echo $tickets;

?>