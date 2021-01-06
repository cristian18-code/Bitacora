<?php

    include('config/session.php');
    include('config/conexion.php');

    if($rol != 'Administrador')
    {
       header('location: principal.php');
    }

    if (!empty($_POST)) {
        // Declaracion de variables que se mostraran segun sus campos designados" //
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['rol'])) {

            $alert='<p class="msg_error"> Los campos [Nombre, usuario y rol] son Obligatorios </p>';
        } else {
        
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];
            $user = $_POST['usuario'];
            $clave = $_POST['contrasena'];
            $clave = md5($clave);
            $rol = $_POST['rol'];

            // Se ejecuta un Query que valide si el Usuario y la Cedula no se encuentran creados//
            $query = mysqli_query($con,"SELECT * FROM usuarios WHERE (username = '$user' AND id_usuario != $idUsuario) OR (nombre = '$nombre' AND id_usuario != $idUsuario)");

            $result = mysqli_fetch_array($query);

            // Si el resultado es mayor a 0 Arroja el error "el usuario ya existe" //

            if($result > 0){
                $alert='<p class="msg_error"> El usuario ya existe </p>';
            }else{

                if (empty($_POST['contrasena'])) {

                    $sql_update = mysqli_query($con, "UPDATE usuarios SET nombre = '$nombre', username = '$user', rol = '$rol' WHERE id_usuario = '$idUsuario' ");

                }else{

                    $sql_update = mysqli_query($con, "UPDATE usuarios SET nombre = '$nombre', username = '$user', password = '$clave', rol = '$rol' WHERE id_usuario = '$idUsuario'");

                }
                if($sql_update){
                    $alert='<p class="msg_save"> Usuario actualizado Correctamente</p>'; 
                }else{
                    $alert='<p class="msg_error"> error al actualizar el usuario</p>';    
                }
            }
        }
    }

    //Mostrar Datos
    if (empty($_GET['id']))
    {
        header('location: listado-usuarios.php');
        
    }
    $iduser = $_GET['id'];
    $sql = mysqli_query($con, "SELECT u.id_usuario, u.nombre, u.username, (u.rol) as id_rol, (r.nombre_rol) as rol FROM usuarios u INNER JOIN roles r on u.rol = r.id_rol WHERE id_usuario = '$iduser'");
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header ('Location: listado_usuarios.php');
    }else{
        $option = '';
        while ($data = mysqli_fetch_array($sql)){

            $iduser  = $data['id_usuario'];
            $nombre  = $data['nombre'];
            $usuario = $data['username'];
            $idrol   = $data['id_rol'];
            $rol     = $data['rol'];

            if($idrol == 1) {            
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 2) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 3) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 4) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 5) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
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
    <link rel="stylesheet" href="media/styles/listado_principales.css">
    <link rel="stylesheet" href="media/styles/registros_principal.css">
    <link rel="stylesheet" href="media/styles/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="js/getTime.js"></script>
    <script src="js/libs/jquery-3.5.1.min.js"></script>
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
            
        <div class="formulario_registro"> 
            <h1> Modificar Usuario</h1>
            <hr>
            <div class="alerta"> <?php echo isset($alert)? $alert :''; ?></div>
            
            <form action="" method="post">
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>"> </input>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo"   value="<?php echo $nombre; ?>"> </input>
                <label for="Numero">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Nombre Usuario"  value="<?php echo $usuario; ?>"> </input>
                <label for="Numero">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña de Accesso" > </input>
                <label for="rol">Rol</label>
            <?php
                $query_rol = mysqli_query($con, "SELECT * FROM roles");
                $result_rol = mysqli_num_rows($query_rol);     
            ?>
            
                <select name="rol" id="rol" class="notItemOne"> 

                <?php
                    echo $option;
                    if ($result_rol > 0 )
                    {
                        while($rol = mysqli_fetch_array($query_rol)){
                ?>   

                <option value="<?php echo $rol["id_rol"]; ?>"><?php echo $rol ["nombre_rol"] ?> </option>

                <?php     
                        }
                    }
                ?>                       
                                        
                </select>
                <input type="submit" value="Actualizar Usuario" class="btn-save"></input>
            </form>
        </div>

    </section>

</body>
</html>