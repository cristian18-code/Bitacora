<?php

    include('config/session.php');
    include('config/conexion.php');
    
    if(!empty($_POST))
	{
		$idusuario = $_POST['idusuario'];
		$query_delete = mysqli_query($con, "DELETE FROM usuarios WHERE id_usuario = $idusuario");
		if($query_delete){
			header('location: listado_usuarios.php');
		}else{
			echo"Error al eliminar el usuario";
		}
	}

    if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 || $_REQUEST['id'] == 2 || $_REQUEST['id'] == 3)
    {
        header('location: listado_usuarios.php');
    }else{
	
		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($con, "SELECT u.nombre, u.username, r.nombre_rol 
												  FROM usuarios u
												  INNER JOIN 
												  roles r ON u.rol = r.id_rol 
												  WHERE u.id_usuario =$idusuario");
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)){ 
				$nombre = $data['nombre'];
				$usuario = $data['username'];
				$rol = $data['nombre_rol'];
			}
		}else{
			header('location: listado_usuarios.php');
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/styles/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/styles/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/styles/eliminar_usuario.css">
    <link rel="stylesheet" href="media/styles/registros_principal.css">
    <link rel="stylesheet" href="media/styles/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Listado Usuarios - Bitacora</title>
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

    <div class="adicional"></div>

    <section id="container">

	 <div class="data-delete">
		
		 <form method="POST"class="delete" action=""> 
			<h2>¿Esta seguro de Eliminar el siguiente Usuario?</h2>
			<p>Nombre:<span><?php echo $nombre; ?></span></p>
			<p>Usuario:<span><?php echo $usuario; ?></span></p>
			<p>Tipo Usuario:<span><?php echo $rol; ?></span></p>
			 <input type="hidden" name="idusuario" value="<?php echo $idusuario;?>"></input>
			 <a href="listado_usuarios.php" class="btn_cancel">Cancelar</a>
			 <input type="submit" value="Aceptar" class="btn_ok"></input>
		</form>	
	 </div>

    </section>
    
</body>
</html>