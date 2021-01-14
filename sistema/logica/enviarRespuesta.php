<?php 

    if (empty($_POST['id']) || empty($_POST['dia']) || empty($_POST['user']) || empty($_POST['respuesta'])
        || empty($_POST['cerrarTicket'])) {
            $alert='<p class="msg_error"> Todos los campos son Obligatorios </p>';
    } else {
        
        require('../../config/db.php');
        require('../../config/conexion.php');

        $registro = $_POST['id'];
        $userRespuesta = $_POST['user'];
        $fechaRespuesta = $_POST['dia'];
        $horaRespuesta = $_POST['hora'];
        $respuestaSoporte = $_POST['respuesta'];
        $cerrarTicket = $_POST['cerrarTicket'];
        
        if (!empty($_FILES['archivo']['tmp_name'])) {
        
            $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
            $nombre_archivo = $archivo['name'];
            $ruta_destino_archivo = "archivos/{$archivo['name']}";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], "../../$ruta_destino_archivo");
            
            if ($archivo_ok) {

                $insertSsql = "UPDATE tickets SET   id_quienResponde = '$userRespuesta',
                                                    fechaRespuesta = STR_TO_DATE('$fechaRespuesta', '%d/%m/%Y'),
                                                    horaRespuesta = '$horaRespuesta',
                                                    respuestaContact = '$respuestaSoporte',
                                                    adjuntoSoporte = '$nombre_archivo',
                                                    cierreTicket = '$cerrarTicket'
                                                    WHERE id_ticket = '$registro'";
            } else {
                $alert='<p class="msg_error"> error al guardar el archivo </p>';
            }

        } else {
            $insertSsql = "UPDATE tickets SET   id_quienResponde = '$userRespuesta',
                                                fechaRespuesta = STR_TO_DATE('$fechaRespuesta', '%d/%m/%Y'),
                                                horaRespuesta = '$horaRespuesta',
                                                respuestaContact = '$respuestaSoporte',
                                                cierreTicket = '$cerrarTicket'
                                                WHERE id_ticket = '$registro'";            
        }

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert='<p class="msg_save"> El ticket N°'. $registro .' ha sido actualizado Correctamente</p>';
        }else{
            $alert='<p class="msg_error"> error al actualizar el Ticket</p>';    
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>