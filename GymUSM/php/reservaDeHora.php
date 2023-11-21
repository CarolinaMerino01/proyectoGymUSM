<?php
session_start();

include "conexion.php";

$fechaSeleccionada = $_POST['fecha']; // Obtén la fecha seleccionada del formulario

$fechaFormateada = date("Y-m-d", strtotime(str_replace('-', '/', $fechaSeleccionada)));

// Ejecuta una consulta para verificar si la fecha seleccionada existe en la tabla
$query = "SELECT idReserva FROM ReservasDeHora WHERE fecha = '$fechaFormateada' ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // fecha encontrada en la base de datos
    $_SESSION['fecha_coincidente'] = $fechaFormateada; // Guarda la fecha en una variable de sesión

    // Continúa con la consulta de idUsuario
    $sql = "SELECT idUsuario FROM usuario WHERE correo = ?";
    

    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("s", $_SESSION['correo']); // "s" indica que es una cadena

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el resultado de la consulta
            $result = $stmt->get_result();
            

            if ($result->num_rows > 0) {
                $fila = $result->fetch_assoc();
                $idUsuario = $fila['idUsuario'];

                // Ahora tienes el valor de idUsuario
                echo "El idUsuario es: " . $idUsuario;
                $_SESSION['resultado_sql'] = $idUsuario;

                // Continúa con el resto de tu código aquí
                header("Location: ../src/horasDisponibles.php");
            } else {
                echo "No se encontraron registros en la tabla usuario para el correo proporcionado.";
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    // fecha no encontrada en la base de datos
    echo "fecha no encontrada";
    ?>
    <p>lic</p>
    <?php
}

// Cierra la conexión a la base de datos
$conn->close();
?>
