<?php
session_start(); // Inicia la sesión
include "conexion.php"; // Asegúrate de que la ruta sea correcta

$fechaCoincidente = $_SESSION['fecha_coincidente']; // Obtén la fecha almacenada en la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén la hora seleccionada del usuario
    $horaSeleccionada = $_POST['hora'];

    // Ejecuta una consulta SQL para actualizar el estado de la hora seleccionada
    $query = "UPDATE reservadehora SET cancelar = 1 WHERE hora = '$horaSeleccionada' and fecha='$fechaCoincidente'";

    if ($conn->query($query) === TRUE) {
        echo "Hora reservada con éxito";
    } else {
        echo "Error al reservar la hora: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    echo "Método no permitido";
}
?>
