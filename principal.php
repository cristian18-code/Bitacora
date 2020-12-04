<?php
    include('config/session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Página de Inicio</title>
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
<!--header start here-->
<h1>Página de Inicio</h1>
<div class="header agile">
	<div class="wrap">
		<div class="login-main wthree">
			<div class="login">
			<h3>Bienvenid@ al sistema  <i><?php echo $login_session; ?></i></h3>

			<div class="clear"> </div>
				<h4><a href="config/logout.php"> Cerrar sesión</a></h4>
			</div>
			
			
		</div>
	</div>
</div>
<!--header end here-->
<!--copy rights end here-->
<div class="copy-rights w3l">		 	
	<p>© <?php echo date("Y");?> MedContactCenter </p>
</div>
<!--copyrights start here-->
 
</body>
</html>