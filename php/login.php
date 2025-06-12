<?php
include('conexion.php');
session_start();

if(isset($_SESSION['nombreUsuario'])){
    header('location:../index.php');
}

if(isset($_POST['btnEnviar'])){
    if(!$conexion){
        die("No hay conexion: ".mysqli_connect_error());
    }
    $nombreUsuario = $_POST['nombreUsuario'];
    $clave = $_POST['clave'];

    $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE nombre = '".$nombreUsuario."' AND contrasenia = '".$clave."'");
    $nr = mysqli_num_rows($query);
    if($nr == 1){
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        header("location: ../index.php");
        die();
    } else if ($nr == 0){
        echo "<script>alert('Usuario no registrado'); window.location = 'login.php'</script>";
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
<header>
    <div class="contenedor">
        <h1 class="titulo">Iniciar sesión</h1>
        <form action="login.php" method="POST" class="formulario">
            <div class="labelInput">
                <label for="nombre">Ingrese el usuario</label>
                <input class="relleno" type="text" name="nombreUsuario" placeholder="usuario" required autocomplete="off"> 
            </div>
            <div class="labelInput">
                <label for="email">Ingrese el email</label>
                <input class="relleno" type="email" name="mail" placeholder="e-mail" autocomplete="off">
            </div>
            <div class="labelInput">
                <label for="clave">Ingrese la contraseña</label>
                <input class="relleno" type="password" name="clave" placeholder="password" required autocomplete="off">
            </div>
            <input type="submit" value="Enviar" name="btnEnviar" class="btnEnviar">
            </div>
            <div class="footer">
                <a href="../index.php">Volver</a>
                <a href="register.php">Registrarse</a>
            </div>
        </form>
    </div>
</header>
</body>
</html>