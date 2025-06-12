<?php
    if(isset($_POST['nombreUsuario']))
    {
        include('conexion.php');
        $usuario = $_POST['nombreUsuario'];
        $password = $_POST['clave'];
        $email = $_POST['mail'];
        
        $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE nombre ='".$usuario."'");
        
        $num = mysqli_num_rows($query);
        function validarPassword($contrasenia)
        {
            $pattern = '/^[\\da-zA-Z]{8,}$/';
            $contraseniaValida = preg_match($pattern, $contrasenia);
            return $contraseniaValida;
        }
        if($num > 0){
            echo "<script>alert('Usuario en uso, intente con otro nombre'); window.location='register.php'</script>";
        }else{ 
            if(validarPassword($password))
            {
                //insertar usuarios
                $sql_insert = "INSERT INTO usuario(nombre,email,contrasenia) 
                VALUES ('$usuario','$email','$password')";
                $query= mysqli_query($conexion,$sql_insert);
                if($query){
                    echo "<script>alert('Usuario registrado'); window.location = 'login.php'</script>";
                }else{
                    echo "<div class='alert'>Error: Hay un error !</div>";
                }
            }else{
                echo "<div class='alert'>Error: La contraseña no cumple con el formato </div>";
            }

        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>
<body>
    <header>
    <div class="contenedor">
        <h1>Registrarse</h1>
        <form action="register.php" method="post" class="Formulario">
            <div class="labelInput">
                <label for="nombre">Ingrese el usuario</label><br>
                <input class="input" type="text" name="nombreUsuario" placeholder="Usuario" autocomplete="off" required>
            </div>
            <div class="labelInput">
                <label for="email">Ingrese el email</label><br>
                <input class="relleno" type="email" name=mail placeholder="E-mail" autocomplete="off" required>
            </div>
            <div class="labelInput">
                <label for="clave">Ingrese la contraseña</label><br>
                <input class="relleno" type="password" name="clave" id="" placeholder="password" autocomplete="off" required>
            </div>
            <button class="btnEnviar" type="submit">Registrarse</button><br><br>
        </form>
    <div class="footer">
                <a href="../index.php">Volver</a>
                <a href="login.php">Iniciar sesion</a>                
            </div>
    </header>
</body>
</html>