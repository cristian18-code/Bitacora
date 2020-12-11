<?php 
	    $rol = $_SESSION['rol'];

		switch ($rol) {
			case 1:
				$rol = 'Administrador';
				break;
			case 2: 
				$rol = 'Supervisor - Pro';
				break;
			case 3:
				$rol = 'Supervisor';
				break;
			case 4: 
				$rol = 'OMT - Terapias';
				break;
			case 5:
				$rol = 'SMD - Prefiltro';
				break;
			case 6: 
				$rol = 'Prefiltro';
				break;
			case 7:
				$rol = 'SMD';
				break;
		}
?>
	<div class="header">
		<img src="./images/soporte-tecnico.png" class="logo" width="40px"><h1>Soporte tecnico - Contact Center</h1>
		<div class="optionsBar">
			<span class="user"><?php echo $rol ?></span>
			<span>|</span>
			<span class="user"><?php echo $_SESSION['nombre'] ?></span>
			<img class="photouser" src="images/user.png" alt="Usuario">
			<span>|</span>
			<h4><a href="./config/logout.php"> Cerrar sesión</a></h4>
			
		</div>
	</div>