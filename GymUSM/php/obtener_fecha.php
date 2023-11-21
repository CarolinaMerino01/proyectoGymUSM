<?php
session_start();

if (isset($_SESSION['fecha_coincidente'])) {
    $fechaCoincidente = $_SESSION['fecha_coincidente'];
    echo $fechaCoincidente;
} else {
    echo "Fecha no encontrada";
}
?>
