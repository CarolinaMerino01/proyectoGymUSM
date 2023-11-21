<?php
session_start(); // Inicia la sesión

include "conexion.php"; // Asegúrate de que la ruta sea correcta

$fechaCoincidente = $_SESSION['fecha_coincidente']; // Obtén la fecha almacenada en la sesión
$idUsuario = $_SESSION['resultado_sql'];

// Consulta de verificación
$verificarQuery = "SELECT COUNT(*) as existencia FROM reservasdehora WHERE fecha = '$fechaCoincidente' AND idUsuario = $idUsuario";

$resultVerificacion = $conn->query($verificarQuery);

if ($resultVerificacion) {
    $row = $resultVerificacion->fetch_assoc();
    $existencia = $row['existencia'];

    if ($existencia > 0) {
        // Si ya existe un registro para el usuario y la fecha, no realizas la siguiente consulta
        echo json_encode(array("Ya existe una reserva para este dia"));
    } else {
        // Si no existe, realizas la consulta para obtener las horas disponibles
        $query = "SELECT hora FROM reservasdehora WHERE fecha = '$fechaCoincidente' AND cancelar = '0' AND idUsuario IS NULL";

        $result = $conn->query($query);

        $horas = array(); // Crea un array para almacenar las horas

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $horas[] = $row['hora']; // Almacena cada hora en el array
            }
            echo json_encode($horas); // Devuelve todas las horas como un JSON
        } else {
            echo json_encode(array("Hora no encontrada"));
        }
    }
} else {
    echo json_encode(array("Error en la verificación"));
}

// Cierra la conexión a la base de datos
$conn->close();

?>
