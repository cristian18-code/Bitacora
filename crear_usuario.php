<?php

    include('config/session.php');
    include('config/conexion.php');

    if ($_SESSION['rols'] != 'Administrador') {
        header("location: principal.php");
    }    
    
    if (!empty($_POST)) {

        $alert = '';        
        if (empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['usuario']) || empty($_POST['contrasena'])) {
            $alert='<p class="msg_error"> Todos los campos son Obligatorios </p>';
        } else {

            $nombre = $_POST['nombre'];
            $usuario = strtolower($_POST['usuario']);
            $clave = sha1($_POST['contrasena']);
            $rol = $_POST['rol'];

            $validarQsql = $con->query("SELECT * FROM usuarios WHERE username = '$usuario' ");
            $result = mysqli_fetch_array($validarQsql);

            if ($result > 0) {
                $alert='<p class="msg_error"> El usuario ya existe </p>';
            } else {
                $insertQslq = $con -> query("INSERT INTO usuarios (username, nombre, password, rol) VALUES ('$usuario', '$nombre', '$clave', '$rol')");

                if($insertQslq){
                    $alert='<p class="msg_save"> Usuario creado Correctamente</p>'; 
                }else{
                    $alert='<p class="msg_error"> error al crear el usuario</p>';    
                }
            }
        }
    }
        
?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/styles/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/styles/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/styles/crear_usuario.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Bitacora</title>
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
        <div id="formulario_usuario">
            <h1>Registrar Usuario</h1>
            <hr>
            <div class="alerta"> <?php echo isset($alert)? $alert :''; ?></div>

            <form action="" method="post">
                <div class="form-group" id="cont-nombre">
                    <label for="nombre"> <span class="icon-user-tie">&nbsp;</span> Nombre Completo</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="Ingrese su nombre" required>
                </div>

                <div class="form-group" id="cont-usuario">
                    <label for="usuario"> <span class="icon-user">&nbsp;</span> Usuario</label>
                    <input type="text" name="usuario" id="usuario" autocomplete="off" class="form-control" placeholder="Ingrese su usuario">
                </div>

                <div class="form-group" id="cont-contrasena">
                    <label for="contrasena"> <span class="icon-key">&nbsp;</span> Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" autocomplete="off" placeholder="Ingrese su contraseña">
                </div>

                <div class="form-group" id="cont-rol">
                    <label for="rol"> <span class="icon-users">&nbsp;</span> Rol</label>
                    <select name="rol" class="form-control" id="rol">
                        <option value="" hidden>Seleccione una opcion</option>
                        <?php $qsql = $con -> query( "SELECT nombre_rol, id_rol FROM roles") or die ("Fue imposible ejecutar la consulte(roles)");
                        foreach ($qsql as $row) { ?>

                        <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre_rol']; ?></option>
                            
                        <?php } ?>    
                    </select>
                </div>

                <input type="submit" value="Registrar" id="submit" class="btn btn-primary">
            </form>

        </div>
    </section>
</body>
</html>