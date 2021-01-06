<?php
    include('config/session.php');

    /* Trae el numero de tickets pendientes */
    if ($rol == 'Administrador') { 

        $traerDatos = "SELECT count(*) from tickets WHERE cierreTicket != 'Si'";
        $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

        if ($row = mysqli_fetch_row($ver)) {
            $tickets = $row[0];
        }

    } else if ($rol == 'Supervisor') {
        
        $traerDatos = "SELECT count(*) from tickets
                                        WHERE tickets.cierreTicket != 'Si' AND id_quienReporta = ".$_SESSION['idUser']."";
        $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

        if ($row = mysqli_fetch_row($ver)) {
            $tickets = $row[0];
        }
    }
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<title>Página de Inicio - Bitacora</title>
<!-- Estilos css -->
<link rel="stylesheet" href="media/styles/libs/bootstrap.min.css">
<link rel="stylesheet" href="media/styles/header.css">
<link rel="stylesheet" href="media/styles/principal.css">
<link rel="stylesheet" href="media/icons/style.css">
<link rel="stylesheet" href="media/styles/menu.css">
<!-- Estilos css -->
<!-- Scripts -->
<script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<script src="sistema/js/getTime.js"></script>
<!-- Scripts -->
<link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--Fuentes de google-->
<link href='//fonts.googleapis.com/css?family=Signika:400,600' rel='stylesheet' type='text/css'>
<!--Fuentes de google-->

</head>
<body>
<!--header Inicia Aqui-->
<header>
    <?php include 'sistema/header.php';?>
    <nav>
        <?php include 'sistema/nav.php';?>
    </nav>
</header>
<!--header Termina Aqui-->	

<!--Section Inicia Aqui-->
<section>
    <div id="contenedor">
        <h5 class="bienvenida">Bienvenido(a) al sistema <i><?php echo $_SESSION['nombre']?></i> <p class="tickets">Tienes <span id="pendientes" name="pendientes"> <?php echo $tickets?></span> Ticket pendiente(s) </p></h5>
    </div>

    <div class="container-all" id="menu" >

        <div class="container-box">

            <a href="reportar_incidencia.php" target="_top">

            <div class="box box1">

                <img src="media/images/reportar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Reportar incidencia</h4>

                <p><strong>¡Modulo administrador!</strong></p>

            <div class="background-hover"></div>

            </a>

        </div>  

        <a href="seguimiento_ticket.php">

        <div class="box box2">

            <img src="media/images/seguimiento.png" alt="seguimiento" class="icon">

            <h4 class="title">Seguimiento</h4>

            <p><strong>¡Modulo administrador!</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="#">

            <div class="box box3">

            <img src="media/images/informes.png" alt="documento" class="icon">

            <h4 class="title">Informes</h4>

            <p><strong>Descargar informes</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="crear_usuario.php">

        <div class="box box4">

            <img src="media/images/agregar-usuario.png" class="icon">

            <h4 class="title">Crear usuario</h4>

            <p><strong>Añadir un nuevo usuario</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="listado_usuarios.php">

        <div class="box box5">

            <img src="media/images/cliente.png" class="icon">

            <h4 class="title">Lista de usuarios</h4>

            <p><strong>Usuarios registrados</strong></p>


        <div class="background-hover"></div>

        </a> 

        </div> 

    </div>
</section>
<!--Section Termina Aqui-->

</body>
<script>
    $(document).ready(function() {	
        function update(){
            var roles = '<?php echo $rol ?>';
            var user = '<?php echo $_SESSION['idUser'] ?>';
            var param = {
                rol: roles,
                usuario: user
            }
            $.ajax({
                type: "POST",
                url: "sistema/logica/contador_ticket_pendiente.php",
                data: param,
                success: function(data) {
                    $('#pendientes').text(Number(data));
                }
            });
        }
        
        setInterval(update, 3000);
    });
</script>
</html>