<?php
    include_once('conexion.php');
    session_start();
    // Se asegura que el usuariore este logueado
    if(!isset($_SESSION['nombreUsuario'])){
        header("location: ./login.php");
    }
    // Se asegura que haya un producto en $_POST
    if(!isset($_POST['producto']) && !isset($_SESSION['idProducto'])){
        header("location: ../index.php");
    }
    // Guarda momentaneamente el valor de $_POST['producto'] en $_SESSION
    if(isset($_POST['producto']))
    {
        unset($_SESSION['idProducto']);
        $_SESSION['idProducto'] = $_POST['producto'];
    }
    // Obtiene todos los campos de la tabla producto del producto seleccionado
    $informacionProducto = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto = ".$_SESSION['idProducto'].";")->fetch_assoc(); 


    if(isset($_POST['pedir']) )
    {
        // Cuando el usuario toca el boton agregar a carrito comprueba si las fechas son válidas
        if(strtotime($_POST['fecha'][1]) > strtotime($_POST['fecha'][0])){
            // Si la categoria es vuelo calcula el precio por la cantidad de vuelos
            if($informacionProducto['fkIdCategoria'] == 2){
                $_SESSION['cantidadCarrito'] = count($_POST['fecha']); 
                $_SESSION['precioTotal'] = $_SESSION['cantidadCarrito'] * $informacionProducto['precio'];
            // Si la categoria es otra calcula el precio por cantidad de días
            }else{
                // saca los segundos de diferencia entre las dos fechas y lo divide por la cantidad de segunos en el día
                $diasTotales = (strtotime($_POST['fecha'][1]) - strtotime($_POST['fecha'][0])) / 86400;
                $_SESSION['cantidadCarrito'] = $diasTotales;
                $_SESSION['precioTotal'] = $diasTotales * $informacionProducto['precio'];
            }
            header("location: ./agregarProductoCarrito.php");
        }else{
            echo "<div class='msjError'> Fechas inválidas, intente nuevamente </div>";
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/datosPedido.css?3">
    <title>Datos del pedido</title>
</head>
<body>
    <div class="container">
        <?php echo '
        <div class="tarjetaProducto">
            <h1>'.$informacionProducto["nombre"].'</h1>
            <p>'.$informacionProducto["descripcion"].'</p>
            '; 
            // Si es un vuelo da la opción de ida y vuelta, ida o vuelta
            if($informacionProducto['fkIdCategoria'] == 2){
            echo '<p>Precio p/vuelo: $'.$informacionProducto['precio'].'</p>
            </div>
            ';?>
        <form action="datosPedido.php" method="post">
            <button type="submit" name="cantidad" value="idaYvuelta">
                <p>Ida y vuelta</p>
            </button>
            <button type="submit" name="cantidad" value="ida">
                <p>Ida</p>
            </button>
            <button type="submit" name="cantidad" value="vuelta">
                <p>Vuelta</p>
            </button>
        </form>
        <?php
        }else{
            echo '<p>Precio p/dia : $'.$informacionProducto['precio'].'</p>
            </div>';
        }
        ?>
        <form action="datosPedido.php" method="post" class="frmFechas">
            <?php
            if(!isset($_POST['cantidad']) || $_POST['cantidad'] == 'idaYvuelta')
            {
                echo '<label for="fecha">Fecha de ingreso</label>
                <input type="date" name="fecha[0]" id="" min="20'.date('y-m-d').'" required>
                <label for="fecha">Fecha de egreso</label>
                <input type="date" name="fecha[1]" id="" min="20'.date('y-m-d').'" required>';
            }else{
                switch($_POST['cantidad']){
                    case 'ida':
                        echo '<label for="fecha">Fecha de ingreso</label>
                        <input type="date" name="fecha[0]" min="20'.date('y-m-d').'" required>';
                        break;
                    case 'vuelta':
                        echo '<label for="fecha">Fecha de egreso</label>
                        <input type="date" name="fecha[0]" min="20'.date('y-m-d').'" required>';
                        break;
                    default:
                        echo '<label for="fecha">Fecha de ingreso</label>
                        <input type="date" name="fecha[0]" id="" min="20'.date('y-m-d').'" required>
                        <label for="fecha">Fecha de egreso</label>
                        <input type="date" name="fecha[1]" id="" min="20'.date('y-m-d').'" required>';
                        break;
                }
            }
            ?>
            <div class="btnPedir">
                <button type="submit"  name="pedir" value="pedir">
                     Volver
                </button>
                <button type="submit"  name="pedir" value="pedir">
                    Agregar al carrito
                </button>
                
            </div>
        </form>   
    </div>
</body>
</html>