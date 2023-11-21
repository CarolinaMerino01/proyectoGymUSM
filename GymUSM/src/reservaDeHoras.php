
<?php
  session_start();
  if(!isset($_SESSION["correo"])){

    header("location:../index.html");
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reservaDeHoras.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css">
    <title>Reserva De Horas</title>
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
                    <a href="reservaDeHoras.php" class="menuini" ; status='Reserva de Horas' ; return true;
                        style="color: #000000; background-color: #FAAC27; border: 2px solid #FAAC27; border-radius: 5px;">
                        &nbsp;Reserva de Horas</a>
                </td>
                <td width="24%" valign="center">
                    <a href="horasReservadas.php" class="menuini" ; status='Horas Reservadas' ; return true;
                        style="color: #ffff;">
                        &nbsp;Horas Reservadas</a>
                </td>
                <td width="22%" valign="center">
                    <a href="sanciones.php" class="menuini" ; status='Ver Sanciones' ; return true;
                        style="color: #ffff;">
                        &nbsp;Ver Sanciones</a>
                </td>
            </tr>
        </table>
        
    </div>

    





    <!-- Calendario -->

    <body>
        <form action="../php/reservaDeHora.php" method="post">
            <div class="container">
                <div class="content-wrapper">
                    <h1 style="color: #fff;">Reserva de Fecha y Hora</h1>
        
                    <div class="form-group">
                        <label for="fecha" style="color: #fff;">Fecha:</label>
                        <input  id="fecha" name="fecha" class="form-control" min="fechaActual" max="2023-12-31" type="date">
                    </div>
        
                    <button id="verificarFecha" class="btn btn-primary">Verificar Fecha</button>
                    <p id="mensaje" style="color: #fff;"></p>
                    
                </div>
            </div>
        </form>
        

        <script>
            // Obtener la fecha actual en el formato requerido (YYYY-MM-DD) en la zona horaria de Chile (GMT-3).
            const today = new Date(new Date().toLocaleString("en-US", { timeZone: "America/Santiago" })).toISOString().split('T')[0];

            // Asignar la fecha actual al campo de fecha como valor mínimo
            document.getElementById('fecha').min = today;

            function mostrarFecha() {
                var fechaActual = new Date();
                console.log(fechaActual.toLocaleDateString());
            }
        </script>




        <!--   <button onclick="mostrarFecha()">Clik</button>
        <script>
            function mostrarFecha() {
                var fechaActual = new Date();
                console.log(fechaActual.toLocaleDateString());
            }
        </script>-->
        <script>
            document.getElementById('verificarFecha').addEventListener('click', function() {
                var fechaSeleccionada = document.getElementById('fecha').value;
        
                // Realiza una solicitud AJAX al script PHP para verificar la fecha
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../php/verificar_fecha.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var mensaje = document.getElementById('mensaje');
                        mensaje.textContent = xhr.responseText; // Muestra el mensaje del servidor
                    }
                };
                xhr.send('fecha=' + fechaSeleccionada);
            });
        </script>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>

</html>

