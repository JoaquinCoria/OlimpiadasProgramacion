<?php
include('conexion.php');
session_start();
// Si se ha iniciado sesion se direcciona a la página principal
if(isset($_SESSION['nombreUsuario'])){
    header('location:../index.php');
}else{
// Sino va al 
    if(isset($_POST['btnEnviar'])){
        if(!$conexion){
            die("No hay conexion: ".mysqli_connect_error());
        }
        $nombreUsuario = $_POST['nombreUsuario'];
        $clave = $_POST['clave'];
        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE nombre = '".$nombreUsuario."' AND contrasenia = '".$clave."'");
        $nr = mysqli_num_rows($query);
        if($nr == 1){
            //si el usuario esta ingresando por primera vez se guarda su nombre en la sesion
            // $_SESSION['nombreUsuario']=$nombreUsuario;
            // header("location: ../index.php");
            // die();
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $resultadoUsuario = mysqli_query($conexion, "SELECT idUsuario FROM usuario WHERE nombre = '" . $nombreUsuario . "';");
            $filaUsuario = mysqli_fetch_assoc($resultadoUsuario); // Obtener el resultado como array asociativo
            $idUsuario = $filaUsuario['idUsuario']; // Extraer el ID
            $_SESSION['idUsuario'] = $idUsuario;
            header("location: ../index.php");
            die();
        }else if ($nr == 0){
            echo "<script>alert('Usuario no registrado'); window.location = 'login.php'</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="contenedor">
        <h1 class="titulo">Iniciar sesión</h1>
        <form action="login.php" method="POST" class="formulario">
            <div class="labelInput">
                <label for="nombre">Ingrese el usuario</label>
                <input type="text" name="nombreUsuario" placeholder="Usuario" required > 
            </div>
            <div class="labelInput">
                <label for="email">Ingrese el email</label>
                <input type="email" name="mail" placeholder="E-mail">
            </div>
            <div class="labelInput">
                <label for="clave">Ingrese la contraseña</label>
                <input type="password" name="clave" id="" placeholder="Contraseña" required>
            </div>
            <input type="submit" value="Enviar" name="btnEnviar" class="btnEnviar">
            </div>
            <div class="footer">
                <a href="../index.php">Volver</a>
                <a href="register.php">Registrarse</a>
            </div>
        </form>
    </div>
</body>
</html>