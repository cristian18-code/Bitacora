<?php 

    include('../../config/db.php');
    include('../../config/conexion.php');

    $traerDatos = "SELECT max(id_ticket) FROM tickets";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $id = $row[0];
        echo $id;
    }

?>