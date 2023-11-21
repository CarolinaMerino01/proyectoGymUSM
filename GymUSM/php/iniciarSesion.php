<?php
include_once('conexion.php');
$correo = $_POST['ingresoCorreo'];
$clave = $_POST['ingresoClave'];

session_start();
$_SESSION['correo'] = $correo;

if (strpos($correo, '@usm.cl') === false) {
    // El correo electrónico no pertenece al dominio "@usm.cl"
    echo "<script>alert('Por favor, ingrese un correo de dominio @usm.cl'); window.location.href = '../index.html';</script>";
    exit;
}

$sql = "SELECT idUsuario FROM usuario WHERE correo = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $correo);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            $idUsuario = $fila['idUsuario'];
            $_SESSION['resultado_sql'] = $idUsuario;
        } else {
            echo "No se encontraron registros en la tabla usuario para el correo proporcionado.";
        }
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }
    $stmt->close();
}

$consulta = "SELECT nombre, rol FROM usuario WHERE correo='$correo' AND clave='$clave'";
$resultado = mysqli_query($conn, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas) {
    $row = mysqli_fetch_assoc($resultado);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['nombre'];
    $_SESSION['rol'] = $row['rol']; // Almacena el rol del usuario en la sesión

    if ($row['rol'] == 0) {
        header("Location: ../src/reservaDeHoras.php");
    } elseif ($row['rol'] == 1) {
        header("Location: ../src/admin.php");
    } else {
        // Si el rol no es ni 0 ni 1, redirige a una página predeterminada
        header("Location: https://www.defaultwebsite.com");
    }
} else {
    echo "<script>alert('Contraseña Incorrecta, intente nuevamente'); window.location.href = '../index.html';</script>";
}

mysqli_free_result($resultado);
?>
