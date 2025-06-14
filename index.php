<?php 
include_once('./php/conexion.php');
session_start(); 
if(isset($_POST['categoria']))
{
    switch($_POST['categoria'])
    {
        case 'Todo':
            $sql = "SELECT * FROM producto";
            break;
        case 'Auto':
            $sql = "SELECT * FROM producto WHERE categoria = 'Auto'";
            break;
        case 'Pasaje':
            $sql = "SELECT * FROM producto WHERE categoria = 'Vuelos'";
            break;
        case 'Infantiles':
            $sql = "SELECT * FROM producto WHERE categoria = 'Hospedajes'";
            break;
        default:
            echo "No Se encontro la categoria";
            break;
    }
}else{
    $sql = "SELECT * FROM producto";
}
$result = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
    <title>Olimpiada de Programación</title>
</head>
<body>
    <header>
        <div class="logoPrincipal">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <div class="iconos">
            <div class="alojamientos">
                <img src="./img/cama.svg" alt="Alojamientos">
                <p>Alojamientos</p>
            </div>
            <div class="vuelos">
                <img src="./img/avion.svg" alt="Vuelos">
                <p>Vuelos</p>
            </div>
            <div class="autos">
                <img src="./img/auto.svg" alt="Autos">
                <p>Autos</p>
            </div>
        </div>
        <div class="registrarse">
            <img src="./img/usuario.svg" alt="Usuario">
            <?php if (isset($_SESSION['nombreUsuario'])){ ?>
                <a href="./php/logout.php">Cerrar Sesión</a>
            <?php }else{?>
                <a href="./php/login.php">Iniciar Sesión</a>
                <a href="./php/register.php">Registrarse</a>
            <?php } ?>
        </div>
    </header>

    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0){
            echo '<form action="./php/agregarProductoCarrito.php" method="post" class="formularioProductos">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='producto'>";
                echo '<input type="checkbox" id="producto'.$row['idProducto'].'" name="producto[]" value="'.$row['idProducto'].'">
                <label for="producto'.$row['idProducto'].'" class="menu">
                    <p class="soloquieto">' . $row['nombre'] . '</p>
                    <p>' . $row['descripcion'] . '</p>
                    <p>' . $row['precio'] . ' </p>
                </label>';
                echo "</div>";
            }
            if(isset($_SESSION['nombreUsuario']))
            {
                echo '<input type="submit" name="pedir" class="pedir" value="pedir">';
            }
            echo "</form>";
        } else {
            echo "No hay productos en la base de datos.";
        }
        ?>
    </div>

    <footer>
        <div class="logo_footer">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <div class="atencion_al_cliente">
            <p>Atención al cliente</p>
            <p>+54 9 2262 34-9131</p>
        </div>
    </footer>
</body>
</html>