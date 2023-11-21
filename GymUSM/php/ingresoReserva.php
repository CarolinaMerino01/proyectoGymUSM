<?php
include_once('conexion.php');

$hora = $_POST['horaSelect'];
$fecha = $_POST['fecha'];

session_start();
$_SESSION['hora'] = $hora;
$_SESSION['fecha'] = $fecha;

// Primero, actualizamos las filas donde idUsuario sea nulo, fecha sea igual a la variable de sesión 'fecha' y hora sea igual a la variable de sesión 'hora'.
$sqlActualizar = "UPDATE reservasdehora SET cupo = cupo + 1 WHERE idUsuario IS NULL AND fecha = ? AND hora = ?"; // Reemplaza 'columna1', 'columna2', etc., con los nombres de las columnas que deseas actualizar.

$stmtActualizar = $conn->prepare($sqlActualizar);
if ($stmtActualizar) {
    $stmtActualizar->bind_param("ss", $_SESSION['fecha'], $_SESSION['hora']);
    if ($stmtActualizar->execute()) {
        echo "Las reservas se han actualizado de forma efectiva.";
        // Puedes redirigir a la página deseada aquí.
    } else {
        echo "Hubo un error al actualizar las reservas: " . $stmtActualizar->error;
    }
    $stmtActualizar->close();
} else {
    echo "Error al preparar la consulta de actualización: " . $conn->error;
}

// Luego, insertamos una nueva reserva con los valores de sesión.
$sqlInsertar = "INSERT INTO reservasdehora VALUES (null, ?, ?, ?, 'null', 1, 0)";
$stmtInsertar = $conn->prepare($sqlInsertar);

if ($stmtInsertar) {
    $stmtInsertar->bind_param("sss", $_SESSION['resultado_sql'], $_SESSION['hora'], $_SESSION['fecha']);
    if ($stmtInsertar->execute()) {
        echo "La hora seleccionada se ha enviado de forma efectiva.";
        header("location: ../src/horasReservadas.php");
    } else {
        echo "Hubo un error al enviar la hora: " . $stmtInsertar->error;
    }
    $stmtInsertar->close();
} else {
    echo "Error al preparar la consulta de inserción: " . $conn->error;
}
?>
