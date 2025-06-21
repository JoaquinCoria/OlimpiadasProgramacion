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
        case 'Alojamiento':
            $sql = "SELECT * FROM producto WHERE fkIdCategoria = 3";
            break;
        case 'Vuelo':
            $sql = "SELECT * FROM producto WHERE fkIdCategoria = 2";
            break;
        case 'Auto':
            $sql = "SELECT * FROM producto WHERE fkIdCategoria = 1";
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
    <link rel="stylesheet" href="./style/index.css?2">
    <title>Olimpiada de Programación</title>
</head>
<body>
    <header>
        <div class="logo_principal">
            <a href="index.php"><img src="./img/logo.png" alt="Logo"></a>
        </div>
        <form action="index.php" method="post" class = "iconos">
            <button type="submit" name="categoria" value="Alojamiento" class="alojamientos">
                <img src="./img/cama.svg" alt="Alojamientos">
                <p>Alojamientos</p>
            </button>
            <button type="submit" name="categoria" value="Vuelo" class="vuelos">
                <img src="./img/avion.svg" alt="Vuelos">
                <p>Vuelos</p>
            </button>
            <button type="submit" name="categoria" value="Auto" class="autos">
                <img src="./img/auto.svg" alt="Autos">
                <p>Autos</p>
            </button>
        </form>
        <div class="headerDerecha">
            <?php if (isset($_SESSION['nombreUsuario'])){
            echo '<div class="carrito">
                <a href="./php/carrito.php">
                    <img src="./img/carrito.png" alt="Carrito">
                </a>
            </div>';
            }?>
            <div>
                <div class="usuario">
                    <img src="./img/usuario.svg" alt="Usuario">
                    <?php if (isset($_SESSION['nombreUsuario'])){
                        echo "Bienvenido " . $_SESSION['nombreUsuario'];?>
                    <?php }else{?>
                        <a href="./php/login.php">Iniciar Sesión</a>
                        <a href="./php/register.php">Registrarse</a>
                    <?php } ?>
                </div>
                <?php if(isset($_SESSION['nombreUsuario'])){
                echo '<div class="cerrarSesion">
                    <a href="./php/logout.php">Cerrar Sesión</a>
                </div>';
                } ?>
            </div>
        </div>
    </header>

    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0){
            echo '<form action="./php/datosPedido.php" method="post" class="formularioProductos">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<button type='submit' name='producto' value='".$row['idProducto']."' class='producto'>";
                echo '<label for="producto'.$row['idProducto'].'" class="menu"> 
                    <p class="nombreProducto">' . $row['nombre'] . '</p>
                    <p>' . $row['descripcion'] . '</p>
                    <p>$' . $row['precio'] . ' </p>
                </label>';
                echo "</button>";
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
        <div class="email">
            <p>Correo Electrónico</p>
            <p>sigma@gmail.com</p>
        </div>
        <div class="atencion_al_cliente">
            <p>Atención al cliente</p>
            <p>+54 9 2262 34-9131</p> 
        </div>
    </footer>
</body>
</html>