<?php 
    include('config/session.php');
    include('config/conexion.php');

    if ($_SESSION['rol'] != 1 || $_SESSION['rol'] != 2) {
        
    }
?>

<!DOCTYPE html>
<html lang="en">
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

    <section>
    
    <div id="formulario_reportar">        
        <h1>Solicitudes Soporte Contact</h1>
        <hr>

            <input type="text" name="id" id="id" readonly value="N° Ticket: <?php  echo (1 + 1)  ?>"> <!-- Muestra el numero del registro a crear -->
            <br>
            <div id="encabezado" class="form-group">
                <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                <img src="media/images/mantenimiento.png" alt="anadir" width="80px">
                <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
            </div>
            <form action="" method="post" id="formulario">

                <div id="cont-area" class="form-group">
                    <label for="area">Area</label>
                    <select name="area" id="area" class="form-control">
                        <option value="" hidden>Selecciona una opcion</option>
                    <!-- consulta traer datos de la base -->
                    <?php $areaSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'area'";
                            $areaQsql = $con -> query($areaSsql);
                    ?>
                    <!-- ciclo para mostrar las areas -->
                    <?php foreach ($areaQsql as $row) { ?>
                    
                        <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                    
                    <?php } ?>                        
                    </select>
                </div>

                <div class="form-group" id="cont-tipo_reporte">
                    <label for="tipo_reporte">Tipo De Reporte</label>
                    <select name="tipo_reporte" id="tipo_reporte" class="form-control" onchange="mostrarIncidencia(this)" >
                        <option value="" hidden>Selecciona una opcion</option>
                    <!-- consulta traer datos de la base -->
                    <?php $areaSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'reporte'";
                            $areaQsql = $con -> query($areaSsql);
                    ?>
                    <!-- ciclo para mostrar las areas -->
                    <?php foreach ($areaQsql as $row) { ?>
                    
                        <option value="<?php echo $row['nombre_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                    
                    <?php } ?>
                    </select>
                </div>
            
                <div class="form-group" id="cont-tipo_incidencia">
                    <label for="tipo_incidencia">Tipo De Incidencia</label>
                    <select name="tipo_incidencia" id="tipo_incidencia" class="form-control">
                        <option value="" hidden>Selecciona una opcion</option>

                    </select>
                </div>

                <div class="form-group" id="cont-direccion" style="display: none;">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" placeholder="Direccion de residencia">
                </div>

                <div class="form-group col-5" id="ciudades">
                    <label for="ciudades">Ciudad</label>
                    <select name="ciudadesR" id="ciudadesR" class="form-control" onchange="ciudadesOtros(this)">
            
                    </select>
                </div>

                <div class="form-group col-5" style="display: none;" id="ciudad">
                    <label for="ciudadR">Otra ciudad</label>
                    <input type="text" name="ciudadR" id="ciudadR" placeholder="Ingrese aqui la ciudad" class="form-control">
                </div>

                <div class="md-form" id="notas">
                    <label for="notasR">Notas</label>
                    <textarea name="notasR" id="notasR" class="form-control" cols="30" rows="4" style="resize:none;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="btn-submit">Registar</button>
            </form>
        </div>            

    </section>


</body>
<script src="sistema/js/peticiones_ajax.js"></script>
</html>