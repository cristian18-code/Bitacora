<?php 

    include('../../config/db.php');
    include('../../config/conexion.php');

    /* Trae el ultimo registro creado */
    $traerDatos = "SELECT count(*) from tickets WHERE cierreTicket = 'No'";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $tickets = $row[0];

        echo $tickets;
    }

?>