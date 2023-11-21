<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "gymusm";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}
?>

