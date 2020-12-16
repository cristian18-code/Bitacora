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
    <?php include 'sistema/nav.php';?>
</header>
<!--header Termina Aqui-->	

<!--Section Inicia Aqui-->
<section>
    <div id="contenedor">
        <h5 class="bienvenida">Bienvenido al sistema <b><?php echo $_SESSION['nombre']?></b> <br> <br> <p class="tickets">Tienes 0 Tickets por revisar</p></h5>
    </div>
</section>
<!--Section Termina Aqui-->
<footer></footer>
</body>
</html>