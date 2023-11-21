<?php
session_start();
include_once('conexion.php');

if (isset($_GET['idReserva'])) {
  $id = $_GET['idReserva'];

  // Busca la fecha coincidente con idUsuario = 0
  $queryBuscarFecha = "SELECT fecha, hora FROM reservasdehora WHERE idReserva = '$id' ";
  $resultadoFecha = $conn->query($queryBuscarFecha);

  if ($resultadoFecha && $resultadoFecha->num_rows > 0) {
    $row = $resultadoFecha->fetch_assoc();
    $fechaCoincidente = $row['fecha'];
    $horaCoincidente = $row['hora'];

    // Actualiza el atributo 'cupo' restando 1
    $queryActualizarCupo = "UPDATE reservasdehora SET cupo = cupo - 1 WHERE fecha = '$fechaCoincidente' AND hora= '$horaCoincidente' AND idUsuario IS NULL";
    $resultadoActualizarCupo = $conn->query($queryActualizarCupo);

    if ($resultadoActualizarCupo) {
      // Elimina la reserva de la base de datos
      $queryEliminarReserva = "DELETE FROM reservasdehora WHERE idReserva = '$id'";
      $resultadoEliminarReserva = $conn->query($queryEliminarReserva);

      if ($resultadoEliminarReserva) {
        // Ventana emergente con las variables fecha y hora
        header("Location: ../src/horasReservadas.php");
        exit();
      } else {
        // Manejo de error si la cancelación no fue exitosa
        echo "Error al cancelar la hora.";
      }
    } else {
      // Manejo de error si la actualización del cupo no fue exitosa
      echo "Error al actualizar el cupo.";
    }
  } else {
    // Manejo de error si no se encuentra la fecha coincidente con idUsuario = 0
    echo "No se encontró una reserva con idUsuario = 0 para la idReserva especificada.";
  }
}
?>
