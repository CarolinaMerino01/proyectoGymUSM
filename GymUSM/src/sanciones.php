<?php
  session_start();
  if(!isset($_SESSION["correo"])){

    header("location:../index.html")
    ;
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sanciones.css">
    <title>Sanciones</title>
</head>


<body>
<div  style="position: absolute; top: 10px; right: 10px; background-color: #00365A; color: #fff; border-radius: 5px; display: flex; align-items: center; padding: 10px;">Hola, <?php echo $_SESSION["username"]; ?>
 <a href="../php/cerrar_sesion.php"><img style="width: 25px;margin-left: 5px;margin-top: 5px;" id="botonCerrarSes" src="../img/off.png" alt=""></a></div>
 
  <div class="contenedor-imagen">
    <img src="../img/deportesusm.png" alt="logo universidad tecnico federico santa maria">
</div>


    <div class="caja1">
    <table id="header-menu" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="12%" valign="center" valign="center">&nbsp;</td>
          <td width="22%" valign="center"> 
            <a href="reservaDeHoras.php" class="menuini"; status='Reserva de Horas'; return true; style="color: #ffff;">
            &nbsp;Reserva de Horas</a></td>
    
          <td width="24%" valign="center">
            <a href="horasReservadas.php" class="menuini"  ; status='Horas Reservadas'; return true; style="color: #ffff;" >
            &nbsp;Horas Reservadas</a>
          </td><td width="22%" valign="center"> 
            <a href="sanciones.php" class="menuini" ; status='Ver Sanciones'; return true; style="color: #000000; background-color: #FAAC27; border: 2px solid #FAAC27; border-radius: 5px;">
            &nbsp;Ver Sanciones</a></td>
        </tr>
      </table>

  

</div>
<div class="container">
    <div class="content-wrapper">
      <h1 style="color:#fff;">Mi Sanción</h1>
      <table border="1" class="tablaSan">
                <tr>
                    <th>Descripción</th>
                    <!-- Agrega más columnas según la estructura de tu tabla "usuario" -->
                </tr>
                <?php
                include_once('../php/conexion.php'); // Incluye el archivo de conexión a la base de datos

                $username = $_SESSION["username"];
                $query = "SELECT * FROM usuario WHERE nombre = '$username'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['sancion'] . '</td>';
                        // Agrega más celdas según las columnas que quieras mostrar
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">No tienes sanciones.</td></tr>';
                }
                ?>
            </table>
    </div>
  </div>
