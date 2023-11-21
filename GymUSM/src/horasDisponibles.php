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
    <title>Horas Disponibles</title>
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
                    <a href="horasReservadas.php" class="menuini"  ; status='Horas Reservadas' ; return true;
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

        <div class="container">
            <div class="content-wrapper">
                <h1 style="color: #fff;">Fecha Seleccionada:</h1>
            <form    action="../php/ingresoReserva.php" method="post">
                <div class="form-group">
                    <label  style="color: #fff;">Fecha:</label>
                    <input style="background-color: gray; font-size: 16px;user-select: none;" id="fecha" name="fecha" class="form-control"  type="date" readonly>
                </div>
                <p id="mensaje" style="color: #fff;"></p>
              
            <div  id="fechaContainer" style="color: #00365A;user-select: none;"></div>
        
        
            

            
            <div>
    <label for="horaSelect" style="color: #fff;;"><h1>Seleccione una hora:</h1></label>
    <select id="horaSelect" name="horaSelect"></select>
</div>

            <div id="horaContainer" ></div>
            <script>
                mostrarFechaAlmacenada(); 
    
                function mostrarFechaAlmacenada() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '../php/obtener_fecha.php', true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var fechaCoincidente = xhr.responseText;
                            document.getElementById("fechaContainer").innerHTML = fechaCoincidente;
                            document.getElementById("fecha").value = fechaCoincidente;
    

                            var xhrHora = new XMLHttpRequest();
                            xhrHora.open('GET', '../php/obtener_hora.php', true);
                            xhrHora.onreadystatechange = function() {
                                if (xhrHora.readyState === 4 && xhrHora.status === 200) {
                                    var horas = JSON.parse(xhrHora.responseText);
                                    if (horas.length > 0) {
                                        var select = document.getElementById("horaSelect");
                                        for (var i = 0; i < horas.length; i++) {
                                            var option = document.createElement("option");
                                            option.text = horas[i];
                                            option.value = horas[i];
                                            select.add(option);
                                        }
                                        
                                    } else {
                                        document.getElementById("horaContainer").innerHTML = "Hora no encontrada";
                                    }
                                }
                            };
                            xhrHora.send();
                        }
                    };
                    xhr.send();
                }
            </script>
            <button id="reservarButton" class="btn btn-primary" style="margin-top: 20px; border-radius: 5px;">Reservar</button>
            
            </form>
            <button   id="volverButton"class="btn btn-primary" style="margin-top: 20px; border-radius: 5px;"><a style="text-decoration: none;color: black;" href="reservaDeHoras.php">Volver</a> </button>


          
            </div>
        </div>


       

        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrap
    </body>
</html>
