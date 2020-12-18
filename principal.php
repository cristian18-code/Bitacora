<?php
    include('config/session.php');
?>
<!DOCTYPE HTML>
<html>
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
        <h5 class="bienvenida">Bienvenido al sistema <b><?php echo $_SESSION['username']?></b> <p class="tickets">Tienes 0 Tickets pendientes </p></h5>
    </div>

    <div class="container-all" id="menu" >

        <div class="container-box">

            <a href="crear_registro.php" target="_top">

            <div class="box box1">

                <img src="media/images/reportar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Reportar incidencia</h4>

                <p><strong>¡Modulo administrador!</strong></p>

            <div class="background-hover"></div>

            </a>

        </div>  

        <a href="tabla_smd.php">

        <div class="box box2">

            <img src="media/images/seguimiento.png" alt="seguimiento" class="icon">

            <h4 class="title">Seguimiento</h4>

            <p><strong>¡Modulo administrador!</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="Tabla_omt.php">

            <div class="box box3">

            <img src="media/images/informes.png" alt="documento" class="icon">

            <h4 class="title">Informes</h4>

            <p><strong>Descargar informes</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="Tabla_terapia.php">

        <div class="box box4">

            <img src="media/images/agregar-usuario.png" class="icon">

            <h4 class="title">Crear usuario</h4>

            <p><strong>Añadir un nuevo usuario</strong></p>

        <div class="background-hover"></div>

        </a> 

        </div> 

        <a href="reportes.php">

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
<footer></footer>
</body>
</html>