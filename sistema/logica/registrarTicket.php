<?php 

    if (empty($_POST['area']) || empty($_POST['tipo_reporte']) || empty($_POST['tipo_incidencia']) || empty($_POST['detalle'])
        || empty($_POST['prioridad']) || empty($_POST['nivel'])) {
            $alert='<p class="msg_error"> Todos los campos son Obligatorios </p>';
    } else {
        
        require('../../config/db.php');
        require('../../config/conexion.php');

        $userReporta = $_POST['user'];
        $fechaReporte = $_POST['dia'];
        $horaReporte = $_POST['hora'];
        $area = $_POST['area'];
        $tipo_reporte = $_POST['tipo_reporte'];

        $query = $con-> query("SELECT id_tipificacion FROM tipificaciones WHERE nombre_tipificacion = '$tipo_reporte'") or die ("ERROR en la consulta tipificaciones");
        if ($query) {
            $row = mysqli_fetch_row($query);
            $tipo_reporte = $row[0];
        }

        $tipo_incidencia = $_POST['tipo_incidencia'];
        $detalle = $_POST['detalle'];
        $archivo = ''; if (!empty($_POST['archivo'])) {$archivo = $_POST['archivo'];}
        $prioridad = $_POST['prioridad'];
        $nivel = $_POST['nivel'];

        $insertSsql = "INSERT INTO tickets (id_quienReporta,
                                            id_area_solicitante,
                                            fechaReporte,
                                            horaReporte,
                                            id_tipoReporte,
                                            id_tipoIncidencia,
                                            detalleSoporte,
                                            prioridad,
                                            adjuntoReporte,
                                            incidenciaNivel)
                                    VALUES ('$userReporta',
                                            '$area',
                                            STR_TO_DATE('$fechaReporte', '%d/%m/%y'),
                                            '$horaReporte',
                                            '$tipo_reporte',
                                            '$tipo_incidencia',
                                            '$detalle',
                                            '$prioridad',
                                            '$archivo',
                                            '$nivel')";

        $insertQslq = $con-> query($insertSsql);

        if($insertQslq){
            $alert='<p class="msg_save"> Ticket creado Correctamente</p>'; 
        }else{
            $alert='<p class="msg_error"> error al crear el Ticket</p>';    
        }           
        
        mysqli_close($con);
        echo $alert;
    }

?>