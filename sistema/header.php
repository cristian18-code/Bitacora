<?php 
	    $rol = $_SESSION['rol'];

		$nombreRol = $con-> query("SELECT nombre_rol FROM roles WHERE id_rol = '".$rol."'");

		if ($row = mysqli_fetch_row($nombreRol)) {
			$rol = $row[0];
		}
?>
	<div class="header">
		<img src="./media/images/soporte-tecnico.png" class="logo" width="40px"><h1>Soporte tecnico - Contact Center</h1>
		<img src="./media/images/logo_header.png" alt="medplus MP" width="140px">
		<div class="optionsBar">
			<span class="user"><?php echo $rol ?></span>
			<span>|</span>
			<span class="user"><?php echo $_SESSION['username'] ?></span>
			<img class="photouser" src="media/images/user.png" alt="Usuario">
			<span>|</span>
			<h4><a href="./config/logout.php"> Cerrar sesión</a></h4>
		</div>
	</div>