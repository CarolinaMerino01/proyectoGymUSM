<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("location: ../index.html");
    exit; // Es buena práctica hacer exit después de redirigir con header
}

include_once('../php/conexion.php'); // Incluye el archivo de conexión a la base de datos

// Realiza la consulta SQL con JOIN para obtener el nombre asociado a la ID de usuario
$query = "SELECT rh.*, u.nombre AS nombre_usuario 
          FROM reservasdehora AS rh 
          JOIN usuario AS u ON rh.idUsuario = u.idUsuario 
          WHERE rh.cancelar = '1'";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css">
    <title>Horas reservadas</title>
</head>

<body>
    <div
        style="position: absolute; top: 10px; right: 10px; background-color: #FAAC27; color: #fff; border-radius: 5px; display: flex; align-items: center; padding: 10px;">
        Hola, Administrador
        <a href="../php/cerrar_sesion.php"><img style="width: 25px;margin-left: 5px;margin-top: 5px;"
                id="botonCerrarSes" src="../img/off.png" alt=""></a>
    </div>

    <div class="contenedor-imagen">
        <img src="../img/deportesusm.png" alt="logo universidad tecnico federico santa maria">
    </div>
    <div class="caja1">
        <table id="header-menu" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="12%" valign="center" valign="center">&nbsp;</td>
                <td width="22%" valign="center">
                    <a href="admin.php" class="menuini" ; status='Sancionar' ; return true;
                        style="color: #000000; background-color: #FAAC27; border: 2px solid #FAAC27; border-radius: 5px;">
                        &nbsp;Sancionar</a>
                </td>
                <td width="24%" valign="center">
                    <a href="" class="menuini" ; status='Horas Reservadas' ; return true;
                        style="color: #ffff;">
                        &nbsp;Horas Reservadas</a>
                </td>
            </tr>
        </table>
    </div>
    <style>
        /* Estilos para la tabla específica */
        .horas-reservadas-table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto; /* Centrar la tabla */
            text-align: center; /* Centrar el contenido */
        }

        .horas-reservadas-table th,
        .horas-reservadas-table td {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        .horas-reservadas-table th {
            background-color: #f2f2f2;
        }
    </style>
    <form action="../php/ingresarSancion.php" method="post">
        <div class="container">
            <div class="content-wrapper">
                

                
                <h1 style="color: #fff;">Horas Reservadas</h1>

                <?php
                // Verifica si la consulta tuvo resultados
                if ($result->num_rows > 0) {
                    // Muestra los datos en una tabla
                    echo '<table border="1"  class="horas-reservadas-table">';
                    echo '<tr><th>Nombre Completo</th><th>Fecha</th><th>Hora</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['nombre_usuario'] . '</td>';
                        echo '<td>' . $row['fecha'] . '</td>';
                        echo '<td>' . $row['hora'] . '</td>';
                        // Puedes mostrar más columnas si es necesario
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo 'No hay horas reservadas';
                }
                ?>
                
                </div>
        </div>
    </form>
</body>

</html>
