<?php
// Estableciendo la conexion a la base de datos
include("db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
include("conexion.php");//Contiene de conexion a la base de datos
 
session_start();// Iniciando Sesion
// Guardando la sesion
$user_check=$_SESSION['username'];
// SQL Query para completar la informacion del usuario
$ses_sql=mysqli_query($con, "SELECT id_usuario, nombre, rol FROM usuarios WHERE username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);

        $_SESSION['idUser'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol'];
        $login_session = $_SESSION['username'];

if(!isset($login_session)){
mysqli_close($con); // Cerrando la conexion
header('Location: index.php'); // Redirecciona a la pagina de inicio
}
?>