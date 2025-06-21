<?php
    session_start();
    include_once('conexion.php');
    // Verificar que todos los datos y credenciales estén en condiciones
    if(!isset($_SESSION)){
        header('location:../index.php');
    }
    if($_SESSION['admin'] == FALSE || !isset($_POST['producto']) && !isset($_SESSION['producto'])){
        header('location:../index.php');
    }

    
    if(isset($_POST['producto'])){
        $_SESSION['producto'] = $_POST['producto'];
        $informacionProducto = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto = ".$_POST['producto'].";")->fetch_assoc();
    }else{
        $informacionProducto = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto = ".$_SESSION['producto'].";")->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/productoAdmin.css">
    <title>Producto vendedor</title>
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST['btnVendedor'])){
            switch($_POST['btnVendedor']){
                case 'Modificar':
                    echo '<form action="./modificarProductoAdmin.php" method="post">
                        <label for="nombre">Nombre</label><br>
                        <input type="text" name="nombre" placeholder = "Nombre"><br>
                        <label for="descripcion">Descripción</label><br>
                        <textarea class="text" name="descripcion" cols="25" rows="3" placeholder = "Descripción"></textarea><br><br>
                        <label for="categoria">Categoría</label> <br>
                        <select name="categoria" required>
                            <option value="Vuelo">Vuelo</option>
                            <option value="Hospedaje">Hospedaje</option>
                            <option value="Vehiculo">Vehículo</option>
                        </select><br><br>
                        <label for="precio">Precio</label> <br>
                        <input type="number" name="precio" placeholder = "Precio"><br><br>
                        <button type = "submit">Modificar</button>
                    </form>';
                    break;
                case 'Eliminar':
                    header('location:./eliminarProductoCatalogo.php');
                    break;
                default: 
                    echo "Error";
                    break;
            }
        }else{
            echo '
                    <div class="tarjetaProducto">
                        <h1>'.$informacionProducto["nombre"].'</h1>
                        <p>'.$informacionProducto["descripcion"].'</p>
                        ';
                        echo '<p>Precio: $'.$informacionProducto['precio'].'</p>
                        <form action="productoAdmin.php" method="post">
                            <input type="submit" name="btnVendedor" value="Modificar">
                            <input type="submit" name="btnVendedor" value="Eliminar">
                        </form>
                    </div>';
        }
        ?> 
        <a href="../index.php">Volver</a>
    </div>
</body>
</html>