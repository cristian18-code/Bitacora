<?php

    require('./config/db.php');//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
    require('./config/conexion.php');//Contiene de conexion a la base de datos

    header("Content-Type: text/html;charset=utf-8"); // cotejamiento de php

    mb_internal_encoding("UTF-8"); // cotejameinto de la consulta con la base de datos

    $llamada = $_POST['llamada'];

    switch ($llamada) {
        case 'mostrarIncidencia':
            mostrarIncidencia($con);
            break;
        
        default:
            # code...
            break;
    }

    function mostrarIncidencia($conexion) {

        $valor = $_POST['reporte']; // recibe el valor enviado desde ajax

        // Consulta pra traer los datos del medico seleccionado
        $incidenciaSsql =  "SELECT tipificaciones.id_tipificacion, 
                                     tipificaciones.nombre_tip
                                     ificacion
                                    FROM tipificaciones WHERE grupo_agenda = '".$valor."'";
        
        $incidenciaQsql = $conexion -> query($incidenciaSsql);
    }

?>