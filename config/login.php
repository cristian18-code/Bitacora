<?php 
    session_start(); // iniciando sesion

    $error=''; // Variable para almacenar el mensaje de error
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Por favor digite su usuario y contraseña";
        }
        else
        {
            // Define $username y $password
            $username=$_POST['username'];
            $password=$_POST['password'];
            // Estableciendo la conexion a la base de datos
            include("db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
            include("conexion.php");//Contiene de conexion a la base de datos
            
            // Para proteger de Inyecciones SQL 
            $username    = mysqli_real_escape_string($con,(strip_tags($username,ENT_QUOTES)));
            $password =  sha1($password);//Algoritmo de encriptacion de la contraseña http://php.net/manual/es/function.sha1.php
            
            $sql = "SELECT email, password FROM login WHERE email = '" . $username . "' and password='".$password."';";
            $query=mysqli_query($con,$sql);
            $counter=mysqli_num_rows($query);
            if ($counter==1){
                    $_SESSION['login_user_sys']=$username; // Iniciando la sesion
                    header("location: ./principal.php"); // Redireccionando a la pagina profile.php
                
                
            } else {
            $error = "El usuario o la contraseña es inválida.";	
            }
            }
    }
?>