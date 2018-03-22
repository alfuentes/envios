<?php
date_default_timezone_set('America/Guatemala');
setlocale(LC_ALL, "Spanish_Guatemala");
$dateLong = strftime(" %A %d de %B de %Y");
require_once("../include/clases/Conexion.php");
?>
<?php $directorioRaiz =""; //si la pagina esta dentro de un directorio o no ?>
<?php require("../include/config.php");  // incluimos el archivo de configuracion
if(isset($_GET['id']) & isset($_GET['tipo'])){

  $idenvio = $_GET['id']; //obtenemos el id en una variable TODO
  $tipoQ = $_GET['tipo'];
  $sql = "";

  if($tipoQ == "CF"){ //si la consulta es para cliente final
    $con = Conectar();  //llamamos al metodo Conectar
    $sql = "SELECT * FROM envio_clienteFinal where id = $idenvio";
    $stmt = $con->prepare($sql);
    $result = $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
    // en este punto iniciamos el codigo HTML
    foreach($rows as $row){
      $fechaEnvio = new DateTime($row->fecha);
      $fechaEntrega = new DateTime($row->fecha_entrega);
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Envio a Cliente Final No. <?php echo $idenvio; ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js" charset="utf-8"></script>
        <script src="js/jquery.min.js" charset="utf-8"></script>
      </head>
      <body>

        <!-- Inicio primer envio -->
        <br>
        <br>
        <table class="table table-no-bordered" style="line-height: 0; ">
          <tbody>
            <tr>
              <td><img src="image/logo.png" style="width: 144px; height: 52px;"></td>
              <td><img src="image/apec-logo.png"  style="width: 144px; height: 38px;"></td>
              <td><img src="image/pentair-logo.jpg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/fe-logo.svg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/myers-logo.jpg" style="width: 136px; height: 38px;"></td>
            </tr>
            <tr>
              <td colspan="5">
                <h6 style="text-align: center; ">
                  <span style="font-family: Tahoma; font-style: italic; font-weight: bold;">
                    41 Calle 6-55 Zona 8 PBX: 2387-5500 y Avenida la Castellana 42-18 Zona 8 PBX: 2389-4444 / Envio <?php echo "No. $idenvio";?>
                  </span>
                </h6>
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <h6>
                <td><span style="font-weight: bold; font-style: italic; size:50;">Atención:</span></td>
                <td><?php print($row->nombre_cliente); ?></td>
              </h6>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirección de Entrega: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
              <td><?php print($row->direccion); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Teléfono Cliente:</span></td>
              <td><?php print($row->telefono_cliente); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Emision:</span></td>
              <td><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Entrega:</span></td>
              <td><?php print($fechaEntrega->format('d/m/Y')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Transporte:</span></td>
              <td><?php print($row->transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Direccion Transporte:</span></td>
              <td><?php print($row->direccion_transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Vendedor:</span></td>
              <td><?php print($row->vendedor); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Emitio:</span></td>
              <td><?php print($row->emite); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Documento:</span></td>
              <td><?php print($row->factura); ?></td>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td align="center"><strong>Se Envia:</strong> <u><?php print($row->envia); ?></u> </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <td style="text-align: center;"><h4><span style="font-weight: bold; font-style: italic; text-decoration: underline;">Atentamente: Departamento de Ventas Aquasistemas.</span></h4></td>
            </tr>
          </tbody>
        </table>

        <!-- Inicio Segundo Envio TODO-->
        <br>
        <br>
        <br>
        <table class="table table-no-bordered" style="line-height: 0; ">
          <tbody>
            <tr>
              <td><img src="image/logo.png" style="width: 144px; height: 52px;"></td>
              <td><img src="image/apec-logo.png"  style="width: 144px; height: 44px;"></td>
              <td><img src="image/pentair-logo.jpg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/fe-logo.svg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/myers-logo.jpg" style="width: 136px; height: 40px;"></td>
            </tr>
            <tr>
              <td colspan="5">
                <h6 style="text-align: center; ">
                  <span style="font-family: Tahoma; font-style: italic; font-weight: bold;">
                    41 Calle 6-55 Zona 8 PBX: 2387-5500 y Avenida la Castellana 42-18 Zona 8 PBX: 2389-4444 / Envio <?php echo "No. $idenvio";?>
                  </span>
                </h6>
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <h6>
                <td><span style="font-weight: bold; font-style: italic; size:50;">Atención:</span></td>
                <td><?php print($row->nombre_cliente); ?></td>
              </h6>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirección de Entrega: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
              <td><?php print($row->direccion); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Teléfono Cliente:</span></td>
              <td><?php print($row->telefono_cliente); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Emision:</span></td>
              <td><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Entrega:</span></td>
              <td><?php print($fechaEntrega->format('d/m/Y')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Transporte:</span></td>
              <td><?php print($row->transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Direccion Transporte:</span></td>
              <td><?php print($row->direccion_transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Vendedor:</span></td>
              <td><?php print($row->vendedor); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Emitio:</span></td>
              <td><?php print($row->emite); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Documento:</span></td>
              <td><?php print($row->factura); ?></td>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td align="center"><strong>Se Envia:</strong> <u><?php print($row->envia); ?></u> </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <td style="text-align: center;"><h4><span style="font-weight: bold; font-style: italic; text-decoration: underline;">Atentamente: Departamento de Ventas Aquasistemas.</span></h4></td>
            </tr>
          </tbody>
        </table>

      </body>
    </html>
    <?php


    }
  }
  elseif ($tipoQ ="Dis") {
    $con = Conectar();  //llamamos al metodo Conectar
    $sql = "SELECT * FROM envio_distribucion where id = $idenvio";
    $stmt = $con->prepare($sql);
    $result = $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
    // en este punto iniciamos el codigo HTML
    foreach($rows as $row){
      $fechaEnvio = new DateTime($row->fecha);
      $fechaEntrega = new DateTime($row->fecha_entrega);
      $msgDireccion = "";
      $msgNombre = "";
      $usarDireccion ="";
      $usarNombre ="";
      $numeroEnvio = $row->id;

      if($row->tipo_direccion =="No"){
        $msgDireccion ="Se uso la direccion del cliente";
        $usarDireccion = $row->direccion_cliente;
      }
      else{
        $msgDireccion ="Se indico otra direccion";
        $usarDireccion = $row->direccion;
      }

      //seleccion de nombre
      if($row->tipo_nombre =="No"){
        $msgNombre ="Se uso el nombre del cliente";
        $usarNombre = $row->nombre;
      }
      else{
        $msgNombre ="Se uso el nombre del cliente";
        $usarNombre = $row->nombre_cliente;
      }
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Envio a Cliente Final No. <?php echo $idenvio; ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js" charset="utf-8"></script>
        <script src="js/jquery.min.js" charset="utf-8"></script>
      </head>
      <body>

        <!-- Inicio primer envio -->
        <br>
        <br>
        <table class="table table-no-bordered" style="line-height: 0; ">
          <tbody>
            <tr>
              <td><img src="image/logo.png" style="width: 144px; height: 52px;"></td>
              <td><img src="image/apec-logo.png"  style="width: 144px; height: 38px;"></td>
              <td><img src="image/pentair-logo.jpg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/fe-logo.svg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/myers-logo.jpg" style="width: 136px; height: 38px;"></td>
            </tr>
            <tr>
              <td colspan="5">
                <h6 style="text-align: center; ">
                  <span style="font-family: Tahoma; font-style: italic; font-weight: bold;">
                    42 CALLE 18-30 ZONA 8, GUATEMALA / Envio <?php echo "No. $idenvio";?>
                  </span>
                </h6>
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <h6>
                <td><span style="font-weight: bold; font-style: italic; size:50;">Señores:</span></td>
                <td><?php print($row->transporte); ?></td>
              </h6>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirección transporte: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
              <td><?php print($row->direccion_transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirigido A:</span></td>
              <td><?php print($usarNombre); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Direccion de Entrega:</span></td>
              <td><?php print($usarDireccion); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Teléfono:</span></td>
              <td><?php print($row->telefono_cliente); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Emision:</span></td>
              <td><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Entrega:</span></td>
              <td><?php print($fechaEntrega->format('d/m/Y')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Vendedor:</span></td>
              <td><?php print($row->vendedor); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Emitio:</span></td>
              <td><?php print($row->emite); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Documento:</span></td>
              <td><?php print($row->factura); ?></td>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td align="center"><strong>Se Envia:</strong> <u><?php print($row->envia); ?></u> </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <td style="text-align: center;"><h4><span style="font-weight: bold; font-style: italic; text-decoration: underline;">Atentamente: Departamento de Distribucion Aquasistemas.</span></h4></td>
            </tr>
          </tbody>
        </table>

        <!-- Inicio Segundo Envio TODO-->
        <br>
        <br>
        <br>
        <table class="table table-no-bordered" style="line-height: 0; ">
          <tbody>
            <tr>
              <td><img src="image/logo.png" style="width: 144px; height: 52px;"></td>
              <td><img src="image/apec-logo.png"  style="width: 144px; height: 38px;"></td>
              <td><img src="image/pentair-logo.jpg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/fe-logo.svg" style="width: 150px; height: 52px;"></td>
              <td><img src="image/myers-logo.jpg" style="width: 136px; height: 38px;"></td>
            </tr>
            <tr>
              <td colspan="5">
                <h6 style="text-align: center; ">
                  <span style="font-family: Tahoma; font-style: italic; font-weight: bold;">
                    42 CALLE 18-30 ZONA 8, GUATEMALA / Envio <?php echo "No. $idenvio";?>
                  </span>
                </h6>
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <h6>
                <td><span style="font-weight: bold; font-style: italic; size:50;">Señores:</span></td>
                <td><?php print($row->transporte); ?></td>
              </h6>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirección transporte: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
              <td><?php print($row->direccion_transporte); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Dirigido A:</span></td>
              <td><?php print($usarNombre); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Direccion de Entrega:</span></td>
              <td><?php print($usarDireccion); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Teléfono:</span></td>
              <td><?php print($row->telefono_cliente); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Emision:</span></td>
              <td><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Fecha de Entrega:</span></td>
              <td><?php print($fechaEntrega->format('d/m/Y')); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Vendedor:</span></td>
              <td><?php print($row->vendedor); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Emitio:</span></td>
              <td><?php print($row->emite); ?></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold; font-style: italic;">Documento:</span></td>
              <td><?php print($row->factura); ?></td>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td align="center"><strong>Se Envia:</strong> <u><?php print($row->envia); ?></u> </td>
            </tr>
          </tbody>
        </table>

        <table border="0">
          <tbody>
            <tr>
              <td style="text-align: center;"><h4><span style="font-weight: bold; font-style: italic; text-decoration: underline;">Atentamente: Departamento de Distribucion Aquasistemas.</span></h4></td>
            </tr>
          </tbody>
        </table>

      </body>
    </html>
    <?php



    }
  }
}
else {
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Error de Solicitud</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <script src="js/bootstrap.min.js" charset="utf-8"></script>
    </head>
    <body>
      <div class="" align="center">
        <hr>
        <p><h2>Error en la solicitud de envio, el dato es invalido.</h2></p>
        <img src="image/nigga-just-stop.jpg" alt="">

      </div>
    </body>
  </html>
  <?php
}
 ?>
