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

        $query = $con-> query("SELECT id_tipificacion FROM tipificaciones WHERE nombre_tipificacion = '$tipo_reporte'") or die ($alert='<p class="msg_error"> error en la base de datos</p>');
        if ($query) {
            $row = mysqli_fetch_row($query);
            $tipo_reporte = $row[0];
        }

        $tipo_incidencia = $_POST['tipo_incidencia'];
        $detalle = $_POST['detalle'];
        $prioridad = $_POST['prioridad'];
        $nivel = $_POST['nivel'];
        
        if (!empty($_FILES['archivo']['tmp_name'])) {
        
            $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
            $nombre_archivo = $archivo['name'];
            $ruta_destino_archivo = "archivos/{$archivo['name']}";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], "../../$ruta_destino_archivo");
            
            if ($archivo_ok) {

                $insertSsql = "INSERT INTO tickets (id_quienReporta,
                                            id_area_solicitante,
                                            fechaReporte,
                                            horaReporte,
                                            id_tipoReporte,
                                            id_tipoIncidencia,
                                            detalleSoporte,
                                            adjuntoReporte,
                                            prioridad,
                                            incidenciaNivel)
                                    VALUES ('$userReporta',
                                            '$area',
                                            STR_TO_DATE('$fechaReporte', '%d/%m/%Y'),
                                            '$horaReporte',
                                            '$tipo_reporte',
                                            '$tipo_incidencia',
                                            '$detalle',
                                            '$nombre_archivo',
                                            '$prioridad',
                                            '$nivel')";

                $insertQslq = $con-> query($insertSsql);

                if($insertQslq){
                    $alert='<p class="msg_save"> Ticket creado Correctamente</p>'; 
                }else{
                    $alert='<p class="msg_error"> error al crear el Ticket</p>';    
                }

            } else {
                $alert='<p class="msg_error"> error al crear el Ticket</p>';
            }

        } else {
            $insertSsql = "INSERT INTO tickets (id_quienReporta,
                                            id_area_solicitante,
                                            fechaReporte,
                                            horaReporte,
                                            id_tipoReporte,
                                            id_tipoIncidencia,
                                            detalleSoporte,
                                            prioridad,
                                            incidenciaNivel)
                                    VALUES ('$userReporta',
                                            '$area',
                                            STR_TO_DATE('$fechaReporte', '%d/%m/%Y'),
                                            '$horaReporte',
                                            '$tipo_reporte',
                                            '$tipo_incidencia',
                                            '$detalle',
                                            '$prioridad',
                                            '$nivel')";

            $insertQslq = $con-> query($insertSsql);   
            
            if($insertQslq){
                $alert='<p class="msg_save"> Ticket creado Correctamente</p>'; 
            }else{
                $alert='<p class="msg_error"> error al crear el Ticket</p>';    
            }
        }
           
        echo $alert;
        mysqli_close($con);
    }

?>