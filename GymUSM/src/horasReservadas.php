<?php
  session_start();
  if(!isset($_SESSION["correo"])){

    header("location:../index.html");
  }


 
include_once('../php/conexion.php'); // Incluye el archivo de conexión a la base de datos

// Realiza la consulta SQL
$query = "SELECT * FROM reservasdehora WHERE idUsuario = '" . $_SESSION['resultado_sql'] . "'";

$result = $conn->query($query);


  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/horasReservadas.css">
    <title>Horas Reservadas</title>
</head>



  


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
            <a href="reservaDeHoras.php" class="menuini" ; status='Reserva de Horas'; return true; style="color: #ffff;">
            &nbsp;Reserva de Horas</a></td>
        
            <td width="24%" valign="center">
              <a href="horasReservadas.php" class="menuini"  style="color: #000000; background-color: #FAAC27; border: 2px solid #FAAC27; border-radius: 5px;">
                  &nbsp;Horas Reservadas
              </a>
          </td>
          <td width="22%" valign="center"> 
            <a href="sanciones.php" class="menuini"; status='Ver Sanciones'; return true; style="color: #ffff;">
            &nbsp;Ver Sanciones</a></td>
        </tr>
      </table>
</div>


<body>
  <div class="container">
    <div class="content-wrapper">
      <h1 style="color:#fff;">Horas Reservadas</h1>
      <table style="margin: 0 auto; text-align: center; color: #fff; border-collapse: collapse; width: 80%; border: 2px solid #FAAC27;">
        <tr>
        <th style="border: 1px solid #FAAC27; padding: 10px;">Fecha</th>
          <th style="border: 1px solid #FAAC27; padding: 10px;">Hora</th>
          <th style="border: 1px solid #FAAC27; padding: 10px;">Cancelar Hora</th>
          <!-- Agrega más encabezados de columnas según tus necesidades -->
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td style='border: 1px solid #FAAC27; padding: 10px;'>" . $row['fecha'] . "</td>";
          echo "<td style='border: 1px solid #FAAC27; padding: 10px;'>" . $row['hora'] . "</td>";
          echo "<td style='border: 1px solid #FAAC27; padding: 10px;'><a href='../php/cancelarHora.php?idReserva=" . $row['idReserva'] . "' class='btn-cancelar' style='display: inline-block; padding: 8px 12px; background-color: #CCCCCC; color: black; text-decoration: none; border-radius:2px; border: 1px solid #888888;'>Cancelar</a></td>";

          // Agrega más campos de la reserva según tus necesidades
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>
</body>


