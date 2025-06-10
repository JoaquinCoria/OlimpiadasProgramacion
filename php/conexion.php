<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$basededatos = 'e-commerce';

$conexion = new mysqli($host, $usuario, $contraseña, $basededatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->close();
?>