<?php
include('config/login.php'); // Incluye archivo del login
 
if(isset($_SESSION['login_usuario'])){ // Valida si ya hay una sesion iniciada
header("location: principal.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Bitacora - Formulario de inicio de sesión</title>
<!-- Estilos css -->
<link href="styles/index.css" rel="stylesheet" type="text/css"/>
<link href="styles/reset.css" rel="stylesheet" type="text/css"/>
<!-- Estilos css -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--Fuentes de google-->
<link href='//fonts.googleapis.com/css?family=Signika:400,600' rel='stylesheet' type='text/css'>
<!--Fuentes de google-->
</head>
<body>
<!--Header Comienza-->
<h1>Formulario de inicio de sesión - Bitacora</h1>
<div class="header agile">
	<div class="wrap">
		<div class="login-main wthree">
			<div class="login">
			<h3>Iniciar sesión</h3>
			<form action="#" method="post">
				<input type="text" placeholder="Correo electrónico" required="" name="username" required>
				<input type="password" placeholder="Contraseña" name="password" required>
				<input name="submit" type="submit" value="Ingresar">
			</form>
			<div class="clear"> </div>
				<span><?php echo $error; ?></span>
			</div>
			
			
		</div>
	</div>
</div>
<!--header termina-->

<div class="copy-rights w3l">		 	
	<p>© <?php echo date("Y");?> | MedConTactCenter</p>
</div>

 
</body>
</html>