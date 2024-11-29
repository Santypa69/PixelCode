<?php
$servername = "localhost";
$username = "root"; // Usuario por defecto de MySQL en XAMPP
$password = ""; // Contraseña por defecto de MySQL en XAMPP
$dbname = "my_project_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>