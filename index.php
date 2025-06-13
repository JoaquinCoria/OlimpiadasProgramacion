<?php 
session_start(); 
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
        <div class="logo_principal">
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
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="./php/logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="./php/login.php">Iniciar Sesión</a>
                <a href="./php/register.php">Registrarse</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">

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