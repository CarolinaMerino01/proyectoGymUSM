<?php
  session_start();
  if(!isset($_SESSION["correo"])){

    header("location:../index.html");
  }


 
include_once('../php/conexion.php'); // Incluye el archivo de conexión a la base de datos

// Realiza la consulta SQL
$query = "SELECT nombre FROM usuario WHERE rol = '0'";
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
    <title>ADMIN</title>
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
                    <a href="../src/horasReservadasAdmin.php" class="menuini" ; status='Horas Reservadas' ; return true;
                        style="color: #ffff;">
                        &nbsp;Horas Reservadas</a>
                </td>

            </tr>
        </table>
    </div>

    <form action="../php/ingresarSancion.php" method="post">
        <div class="container">
            <div class="content-wrapper">
                <h1 style="color: #fff;">Ingresar sancion</h1>
    
                <div class="form-group">
                    <label for="Sanciones" style="color: #fff;">Sanciones</label>
                    <select id="sancion" name="sancion" class="form-control">
                        <option value="Inasistencia"> Inasistencia</option>
                        <option value="Vestuario inadecuado"> Vestuario inadecuado</option>
                        <option value="Llegada tardía"> Llegada tardía</option>
                    </select>
                </div>
    
                            <div class="form-group">
                <label for="Usuarios" style="color: #fff;">Usuarios</label>
                <select id="nombre" name="nombre" class="form-control">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<option  value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";


                    }
                    ?>
                </select>
            </div>




    
                <div>
                    <button id="aa" class="btn btn-primary">Ingresar sancion</button>
                    <p id="mensaje" style="color: #fff;"></p>
                </div>
            </div>
        </div>
    </form>



    
            </div>
        </div>
    