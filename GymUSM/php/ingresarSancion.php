<?php
session_start(); // Inicia la sesión

include "conexion.php"; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario o de donde los estés recibiendo
    $sancion = $_POST['sancion'];
    $nameUser = $_POST['nombre'];
    

    // Preparar la consulta para actualizar la columna 'sancion' para un usuario específico
    $query = "UPDATE usuario SET sancion = ? WHERE nombre = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $sancion, $nameUser);


        if ($stmt->execute()) {
            echo "<script>alert('Sanción ingresada correctamente'); window.history.back();</script>";
            exit();
        } else {
            echo "<script>alert('Error al agregar la sanción');</script>";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}
?>
