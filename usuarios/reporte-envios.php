<?php date_default_timezone_set('America/Guatemala'); setlocale(LC_ALL, "Spanish_Guatemala");   $dateLong = strftime(" %A %d de %B de %Y"); setlocale(LC_ALL, 'es_GT');//declaramos la zona horaria ?>
<?php $directorioRaiz ="../"; //si la pagina esta dentro de un directorio o no ?>
<?php require("../include/config.php");  // incluimos el archivo de configuracion ?>
<?php require($directorioRaiz.$menuApp);  // incluimos el archivo de configuracion ?>
<?php require($directorioRaiz.$mediaApp);  // incluimos el archivo de links multimedia ?>
<?php

session_start();

if(isset($_SESSION['usuario'])){
  if ($_SESSION['usuario']['tipo'] != "Usuario") {
    header('Location: ../administracion/');
  }
} else {
  header('Location: ../');
}

?>

<?php $tituloPagina="Reporte de Envios"?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $nombreApp;?>">
    <meta name="author" content="<?php echo $desarrolladorApp;?>">
    <link rel="icon" href="<?php echo $directorioRaiz.$icon; ?>">

    <title><?php echo $nombreApp." - $tituloPagina"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $directorioRaiz.$boostrapCSS; ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $directorioRaiz.$fixedCSS; ?>" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="<?php echo $directorioRaiz.$animateCSS; ?>" rel="stylesheet">

    <!-- Animate Time CSS -->
    <link href="<?php echo $directorioRaiz.$animaTimeCSS; ?>" rel="stylesheet">

    <!-- SweetAlert -->
    <link href="<?php echo $directorioRaiz.$sweetCSS; ?>" rel="stylesheet">
    <script src="<?php echo $directorioRaiz.$sweetJS; ?>"></script>

    <!-- Typeahead -->
    <link href="<?php echo $directorioRaiz.$typeCSS; ?>" rel="stylesheet">
    <script src="<?php echo $directorioRaiz.$bootstrapTypeJS; ?>"></script>
    <!--
    <script type="text/javascript" src="<?php echo $directorioRaiz.$typeJS; ?>"></script> -->

    <!-- jQuery -->
    <script src="<?php echo $directorioRaiz.$jqueryJS; ?>"></script>

    <!-- typeahead -->
    <script src="<?php echo $directorioRaiz.$bootstrapTypeJS; ?>"></script>

    <!--Font Awesome Icons -->
    <script type="text/javascript" src="https://use.fontawesome.com/041bce9f1d.js"></script>

    <!--Ajax Envios -->
    <script type="text/javascript" src="../js/ajax.registroEnvios.js"></script>

     <!--datePicker -->
     <link href="<?php echo $directorioRaiz.$datepickerCSS; ?>" rel="stylesheet">
     <script src="<?php echo $directorioRaiz.$datepickerJS; ?>"></script>
     <script src="<?php echo $directorioRaiz.$datepickerES; ?>"></script>

     <!--moment -->
     <script src="<?php echo $directorioRaiz.$momentJS; ?>"></script>

     <!--dataTables -->
     <link href="<?php echo $directorioRaiz.$dataTableBoostrapCSS; ?>" rel="stylesheet">
     <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
     <script src="<?php echo $directorioRaiz.$dataTableBoostrapJS; ?>"></script>
     <script src="<?php echo $directorioRaiz.$dataTableJqueryJS; ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <?php
          //llamamos a la función menu
          $myMenu = new Menu();
          //llamamos al metodo toggleNavigation para navegación por moviles o tabletas
          $myMenu->toggleNavigation(); ?>
          <a href="index.php"><img src="<?php echo $directorioRaiz.$imageLogo; ?>" alt="" height="52" width="135"></a>

        </div>
        <?php
        //llamamos al metodo printMenuView dando como parametros la raiz del menu y un numero de acuerdo a la pagina.
        $myMenu->printMenuView($directorioRaiz,7);
        ?>
      </div>
    </nav>

    <div class="container" id="app">

      <!-- Main component for a primary marketing message or call to action -->
      <div >
        <?php
        if (isset($_GET['accion'])){
          if($_GET['accion']=="cliente-final"){
            ?>
            <h2>Envios a Cliente Final</h2>
            <hr>
            <!-- Tabla de Clientes-->
            <table id="tabla" class="table table-hover  table-bordered" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th>Nombre</th>
                  <th>Transporte</th>
                  <th>Hora Emision</th>
                  <th>Fecha Entrega</th>
                  <th>Vendedor</th>
                  <th>Factura</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT * FROM envio_clienteFinal";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $row){
                $fechaEnvio = new DateTime($row->fecha);
                $fechaEntrega = new DateTime($row->fecha_entrega);
              ?>
                <tr>
                  <td><span style="font-size:small;"><?php print($row->id); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->nombre_cliente); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->transporte); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEntrega->format('d/m/Y')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->vendedor); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->factura); ?></span></td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a onclick="EnvioCF('<?php print($row->id); ?>','<?php print($row->nombre_cliente); ?>', '<?php print($row->tipo_envio); ?>',
                          '<?php print($row->transporte); ?>', '<?php print($row->direccion); ?>', '<?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?>',
                          '<?php print($fechaEntrega->format('d/m/Y - l')); ?>', '<?php print($row->piloto); ?>', '<?php print($row->vendedor); ?>',
                          '<?php print($row->factura); ?>', '<?php print($row->envia); ?>', '<?php print($row->instrucciones); ?>', '<?php print($row->emite); ?>');">
                          <i class="fa fa-list-alt" aria-hidden="true"> Ver Detalle</i> </a>
                          </li>
                          <li>
                            <a href="../impresion/envio.php?tipo=CF&id=<?php print($row->id);?>" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i> </a>
                          </li>
                        </ul>

                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> <!-- Fin Tabla-->
            <?php
          }
          elseif($_GET['accion']=="distribucion"){
            ?>
            <h2>Envios de Distribucion</h2>
            <hr>
            <!-- Tabla de Clientes-->
            <table id="tablaDistribucion" class="table table-hover  table-bordered" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th>Nombre</th>
                  <th>Transporte</th>
                  <th>Hora Emision</th>
                  <th>Vendedor</th>
                  <th>Factura</th>
                  <th>Emite</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT * FROM envio_distribucion";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $rowD){
                $fechaEnvio = new DateTime($rowD->fecha);
                $fechaEntrega = new DateTime($rowD->fecha_entrega);

                $msgDireccion = "";
                $msgNombre = "";
                $usarDireccion ="";
                $usarNombre ="";
                $numeroEnvio = $rowD->id;

                if($rowD->tipo_direccion =="No"){
                  $msgDireccion ="Se uso la direccion del cliente";
                  $usarDireccion = $rowD->direccion_cliente;
                }
                else{
                  $msgDireccion ="Se indico otra direccion";
                  $usarDireccion = $rowD->direccion;
                }

                //seleccion de nombre
                if($rowD->tipo_nombre =="No"){
                  $msgNombre ="Se uso el nombre del cliente";
                  $usarNombre = $rowD->nombre;
                }
                else{
                  $msgNombre ="Se uso el nombre del cliente";
                  $usarNombre = $rowD->nombre_cliente;
                }

              ?>
                <tr>
                  <td><span style="font-size:small;"><?php print($rowD->id); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->nombre); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->transporte); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->vendedor); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->factura); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->emite); ?></span></td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a onclick="EnvioDistribucion('<?php print($rowD->id); ?>','<?php print($msgNombre); ?>','<?php print($usarNombre); ?>',
                          '<?php print($msgDireccion); ?>','<?php print($usarDireccion); ?>','<?php print($rowD->tipo_envio); ?>', '<?php print($rowD->transporte); ?>',
                          '<?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?>','<?php print($fechaEntrega->format('d/m/Y - l')); ?>',
                          '<?php print($rowD->piloto); ?>', '<?php print($rowD->vendedor); ?>',
                          '<?php print($rowD->factura); ?>', '<?php print($rowD->envia); ?>', '<?php print($rowD->instrucciones); ?>',
                          '<?php print($rowD->emite); ?>',<?php print($numeroEnvio); ?>);">
                          <i class="fa fa-list-alt" aria-hidden="true"> Ver Detalle</i> </a>
                          </li>
                          <li>
                            <a href="../impresion/envio.php?tipo=Dis&id=<?php print($rowD->id); ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i> </a>
                          </li>
                        </ul>

                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> <!-- Fin Tabla-->
            <?php

          }

        } # fin accion
        if (isset($_GET['delivery'])){
          if($_GET['delivery']=="cliente-final"){
            //echo "Delivery Cliente Final";
            ?>
            <h2>Envios Entregados a Cliente Final</h2>
            <hr>
            <!-- Tabla de Clientes-->
            <table id="tabla" class="table table-hover  table-bordered" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th>Nombre</th>
                  <th>Transporte</th>
                  <th>Hora Emision</th>
                  <th>Fecha Entrega</th>
                  <th>Vendedor</th>
                  <th>Factura</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT * FROM envio_clienteFinal where status='Pendiente'";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $row){
                $fechaEnvio = new DateTime($row->fecha);
                $fechaEntrega = new DateTime($row->fecha_entrega);
              ?>
                <tr>
                  <td><span style="font-size:small;"><?php print($row->id); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->nombre_cliente); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->transporte); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEntrega->format('d/m/Y')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->vendedor); ?></span></td>
                  <td><span style="font-size:small;"><?php print($row->factura); ?></span></td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a onclick="EnvioCF('<?php print($row->id); ?>','<?php print($row->nombre_cliente); ?>', '<?php print($row->tipo_envio); ?>',
                          '<?php print($row->transporte); ?>', '<?php print($row->direccion); ?>', '<?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?>',
                          '<?php print($fechaEntrega->format('d/m/Y - l')); ?>', '<?php print($row->piloto); ?>', '<?php print($row->vendedor); ?>',
                          '<?php print($row->factura); ?>', '<?php print($row->envia); ?>', '<?php print($row->instrucciones); ?>', '<?php print($row->emite); ?>');">
                          <i class="fa fa-list-alt" aria-hidden="true"> Ver Detalle</i> </a>
                          </li>
                          <li>
                            <a href="../impresion/envio.php?tipo=CF&id=<?php print($row->id);?>" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i> </a>
                          </li>
                        </ul>

                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> <!-- Fin Tabla-->
            <?php

            }
          elseif($_GET['delivery']=="distribucion"){
            //echo "Delivery Distribucion";
            ?>
            <h2>Envios Con Recepción de Distribucion</h2>
            <hr>
            <!-- Tabla de Clientes-->
            <table id="tablaDistribucion" class="table table-hover  table-bordered" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th>Nombre</th>
                  <th>Transporte</th>
                  <th>Hora Emision</th>
                  <th>Vendedor</th>
                  <th>Factura</th>
                  <th>Emite</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT * FROM envio_distribucion where status='Recibido'";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $rowD){
                $fechaEnvio = new DateTime($rowD->fecha);
                $fechaEntrega = new DateTime($rowD->fecha_entrega);
                $fechaRecepcion = new DateTime($rowD->recibido);

                $msgDireccion = "";
                $msgNombre = "";
                $usarDireccion ="";
                $usarNombre ="";
                $numeroEnvio = $rowD->id;
                $correo = "No";
                if($rowD->correo == true){
                  $correo = 'Si';
                }

                if($rowD->tipo_direccion =="No"){
                  $msgDireccion ="Se uso la direccion del cliente";
                  $usarDireccion = $rowD->direccion_cliente;
                }
                else{
                  $msgDireccion ="Se indico otra direccion";
                  $usarDireccion = $rowD->direccion;
                }

                //seleccion de nombre
                if($rowD->tipo_nombre =="No"){
                  $msgNombre ="Se uso el nombre del cliente";
                  $usarNombre = $rowD->nombre;
                }
                else{
                  $msgNombre ="Se uso otro nombre para el envio";
                  $usarNombre = $rowD->nombre_cliente;
                }

              ?>
                <tr>
                  <td><span style="font-size:small;"><?php print($rowD->id); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->nombre); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->transporte); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->vendedor); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->factura); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->emite); ?></span></td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a onclick="EnvioDistribucion('<?php print($rowD->id); ?>','<?php print($msgNombre); ?>','<?php print($usarNombre); ?>',
                          '<?php print($msgDireccion); ?>','<?php print($usarDireccion); ?>','<?php print($rowD->tipo_envio); ?>', '<?php print($rowD->transporte); ?>',
                          '<?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?>','<?php print($fechaEntrega->format('d/m/Y - l')); ?>',
                          '<?php print($rowD->piloto); ?>', '<?php print($rowD->vendedor); ?>',
                          '<?php print($rowD->factura); ?>', '<?php print($rowD->envia); ?>', '<?php print($rowD->instrucciones); ?>',
                          '<?php print($rowD->emite); ?>',<?php print($numeroEnvio); ?>, '<?php print($rowD->status); ?>','<?php print($fechaRecepcion->format('d/m/Y h:i:s A')); ?>',
                          '<?php print($correo); ?>','<?php print($rowD->ingresa); ?>','<?php print($rowD->firma); ?>');">
                          <i class="fa fa-list-alt" aria-hidden="true"> Ver Detalle</i> </a>
                          </li>
                          <li>
                            <a href="../impresion/envio.php?tipo=Dis&id=<?php print($rowD->id); ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i> </a>
                          </li>
                        </ul>

                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> <!-- Fin Tabla-->
            <?php

            }
        } # fin delivery

        if (isset($_GET['noDelivery'])){
          if($_GET['noDelivery']=="cliente-final"){
            echo "No Delivery Cliente Final";

          }
          elseif($_GET['noDelivery']=="distribucion"){
            //echo "No Delivery Distribucion";
            ?>
            <h2>Envios No Entregados de Distribucion</h2>
            <hr>
            <!-- Tabla de Clientes-->
            <table id="tablaDistribucion" class="table table-hover  table-bordered" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th>Nombre</th>
                  <th>Transporte</th>
                  <th>Hora Emision</th>
                  <th>Vendedor</th>
                  <th>Factura</th>
                  <th>Emite</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              require_once("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT * FROM envio_distribucion where status='Pendiente'";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $rowD){
                $fechaEnvio = new DateTime($rowD->fecha);
                $fechaEntrega = new DateTime($rowD->fecha_entrega);

                $msgDireccion = "";
                $msgNombre = "";
                $usarDireccion ="";
                $usarNombre ="";
                $numeroEnvio = $rowD->id;

                if($rowD->tipo_direccion =="No"){
                  $msgDireccion ="Se uso la direccion del cliente";
                  $usarDireccion = $rowD->direccion_cliente;
                }
                else{
                  $msgDireccion ="Se indico otra direccion";
                  $usarDireccion = $rowD->direccion;
                }

                //seleccion de nombre
                if($rowD->tipo_nombre =="No"){
                  $msgNombre ="Se uso el nombre del cliente";
                  $usarNombre = $rowD->nombre;
                }
                else{
                  $msgNombre ="Se uso el nombre del cliente";
                  $usarNombre = $rowD->nombre_cliente;
                }

              ?>
                <tr>
                  <td><span style="font-size:small;"><?php print($rowD->id); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->nombre); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->transporte); ?></span></td>
                  <td><span style="font-size:small;"><?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->vendedor); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->factura); ?></span></td>
                  <td><span style="font-size:small;"><?php print($rowD->emite); ?></span></td>

                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a onclick="EnvioDistribucion('<?php print($rowD->id); ?>','<?php print($msgNombre); ?>','<?php print($usarNombre); ?>',
                          '<?php print($msgDireccion); ?>','<?php print($usarDireccion); ?>','<?php print($rowD->tipo_envio); ?>', '<?php print($rowD->transporte); ?>',
                          '<?php print($fechaEnvio->format('d/m/Y h:i:s A')); ?>','<?php print($fechaEntrega->format('d/m/Y - l')); ?>',
                          '<?php print($rowD->piloto); ?>', '<?php print($rowD->vendedor); ?>',
                          '<?php print($rowD->factura); ?>', '<?php print($rowD->envia); ?>', '<?php print($rowD->instrucciones); ?>',
                          '<?php print($rowD->emite); ?>',<?php print($numeroEnvio); ?> , '<?php print($rowD->status); ?>');">
                          <i class="fa fa-list-alt" aria-hidden="true"> Ver Detalle</i> </a>
                          </li>
                          <li>
                            <a onclick="RecibirDistribucion(<?php print($rowD->id); ?>,'<?php print($msgNombre); ?>','<?php print($rowD->nombre); ?>','<?php print($msgDireccion); ?>',
                              '<?php print($usarDireccion); ?>', '<?php print($rowD->tipo_envio); ?>', '<?php print($rowD->transporte); ?>', '<?php print($rowD->id_piloto); ?>', '<?php print($rowD->piloto); ?>',
                              '<?php print($rowD->vendedor); ?>','<?php print($rowD->envia); ?>', '<?php print($rowD->instrucciones); ?>', '<?php print($rowD->emite); ?>',
                              '<?php print($_SESSION['usuario']['nombre']); ?>',<?php print($numeroEnvio); ?>);"><i class="fa fa-check-square-o" aria-hidden="true"> Recibir Envio</i> </a>
                          </li>
                          <li>
                            <a href="../impresion/envio.php?tipo=Dis&id=<?php print($rowD->id); ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i> </a>
                          </li>
                        </ul>

                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> <!-- Fin Tabla-->
            <?php
          }

        } # fin no delivery

        ?>




      </div> <!-- /Fin Jumbotron -->

      <!-- Modal Para llenado Cliente Final-->
     <div class="modal fade" id="modal-cf" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" align="center"> <strong><strong>Detalle de envio Cliente Final</strong></strong></h3> <br>
          </div>

            <table class="table table-hover">
              <thead>
              <tr>
                <td align="center"><h4><strong>Campo</strong></h4></td>
                <td align="center"><h4><strong>Valor</strong></h4></td>
              </tr>
              </thead>
              <tbody>
                <tr>
                  <td><h5><strong>Nombre</strong></h5></td>
                  <td><h5><input type="text" id="nombreCF" class="form-control" readonly></h5></td>
                </tr>
                <tr>
                  <td><h5><strong>Tipo de Envio</strong></h5></td>
                  <td><h4><input type="text" id="tEnvioCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Transporte</strong></h5></td>
                  <td><h4><input type="text" id="transporteCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Direccion</strong></h5></td>
                  <td><h4><input type="text" id="direccionCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Fecha Emision</strong></h5></td>
                  <td><h4><input type="text" id="fechaEmisionCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Fecha de Entrega</strong></h5></td>
                  <td><h4><input type="text" id="fechaEntregaCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Piloto</strong></h5></td>
                  <td><h4><input type="text" id="pilotoCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Vendedor</strong></h5></td>
                  <td><h4><input type="text" id="vendedorCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Factura</strong></h5></td>
                  <td><h4><input type="text" id="facturaCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Se envia</strong></h5></td>
                  <td><h4><input type="text" id="seEnviaCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Instrucciones Especiales</strong></h5></td>
                  <td><h4><input type="text" id="obsCF" class="form-control" value="" readonly></h4></td>
                </tr>
                <tr>
                  <td><h5><strong>Emitido por</strong></h5></td>
                  <td><h4><input type="text" id="emiteCF" class="form-control" value="" readonly></h4></td>
                </tr>
              </tbody>
            </table>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
          </div>
       </div>
      </div>
     </div> <!-- fin modal -->

      <!-- Modal Para llenado Distribucion-->
      <div class="modal fade" id="modal-distribucion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Detalle de envio Distribucion</strong></strong></h3> <br>
            </div>

              <table class="table table-hover">
                <thead>
                <tr>
                  <td align="center"><h4><strong>Campo</strong></h4></td>
                  <td align="center"><h4><strong>Valor</strong></h4></td>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><h5><strong>Nombre</strong></h5></td>
                    <td>
                      <h5>
                        <label for="nombreD" id="nombreDL">Valor</label>
                        <input type="text" id="nombreD" class="form-control" readonly>
                      </h5>
                    </td>
                  </tr>
                  <tr>
                  <td><h5><strong>Direccion</strong></h5></td>
                  <td>
                    <h5>
                      <label for="direccionD" id="direccionDL">Valor</label>
                      <input type="text" id="direccionD" class="form-control" readonly>
                    </h5>
                  </td>
                </tr>
                  <tr>
                    <td><h5><strong>Tipo Envio</strong></h5></td>
                    <td><h4><input type="text" id="tipoD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Transporte</strong></h5></td>
                    <td><h4><input type="text" id="transporteD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Fecha Emision</strong></h5></td>
                    <td><h4><input type="text" id="fechaEmisionD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Fecha de Entrega</strong></h5></td>
                    <td><h4><input type="text" id="fechaEntregaD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Piloto</strong></h5></td>
                    <td><h4><input type="text" id="pilotoD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Vendedor</strong></h5></td>
                    <td><h4><input type="text" id="vendedorD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Factura</strong></h5></td>
                    <td><h4><input type="text" id="facturaD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Se envia</strong></h5></td>
                    <td><h4><input type="text" id="seEnviaD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Instrucciones Especiales</strong></h5></td>
                    <td><h4><input type="text" id="obsD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Emitido por</strong></h5></td>
                    <td><h4><input type="text" id="emiteD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Status</strong></h5></td>
                    <td><h4><input type="text" id="statusD" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Recibido</strong></h5></td>
                    <td><h4><input type="text" id="recibido" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Se envio correo</strong></h5></td>
                    <td><h4><input type="text" id="correo" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Ingreso</strong></h5></td>
                    <td><h4><input type="text" id="ingreso" class="form-control" value="" readonly></h4></td>
                  </tr>
                  <tr>
                    <td><h5><strong>Firma como</strong></h5></td>
                    <td><h4><input type="text" id="firma" class="form-control" value="" readonly></h4></td>
                  </tr>
                </tbody>
              </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
            </div>
         </div>
        </div>
       </div> <!-- fin modal -->

     <!-- Modal Para recepcion de envios-->
     <div class="modal fade" id="modal-recepcion" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h3 class="modal-title" align="center"> <strong><strong>Recepcion de Envio</strong></strong></h3> <br>
           </div>
           <form role="form" action="" name="frmRecepcion" onsubmit="RecepcionEnvio(idP,accion); return false">
             <table class="table table-hover">
               <thead>
               <tr>
                 <td align="center"><h4><strong>Campo</strong></h4></td>
                 <td align="center"><h4><strong>Valor</strong></h4></td>
               </tr>
               </thead>
               <tbody>
                 <tr>
                   <td><h5><strong>Numero de Envio</strong></h5></td>
                   <td><h4><input type="text" id="numeroEnvio" class="form-control" value="" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Nombre</strong></h5></td>
                   <td>
                     <h5>
                       <label for="nombreI" id="nombreL">Valor</label>
                       <input type="text" id="nombreI" class="form-control" readonly>
                     </h5>
                   </td>
                 </tr>
                 <tr>
                 <td><h5><strong>Direccion</strong></h5></td>
                 <td>
                   <h5>
                     <label for="direccion" id="direccionL">Valor</label>
                     <input type="text" id="direccion" class="form-control" readonly>
                   </h5>
                 </td>
               </tr>
                 <tr>
                   <td><h5><strong>Tipo Envio</strong></h5></td>
                   <td><h4><input type="text" id="tipo" class="form-control" value="" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Transporte</strong></h5></td>
                   <td><h4><input type="text" id="transporte" class="form-control" value="" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Piloto</strong></h5></td>
                   <td><h4><input type="text" id="qPiloto" class="form-control" autocomplete="off" required /></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Vendedor</strong></h5></td>
                   <td><h4><input type="text" id="vendedor" class="form-control" autocomplete="off" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Se envia</strong></h5></td>
                   <td><h4><input type="text" id="seEnvia" class="form-control" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Instrucciones Especiales</strong></h5></td>
                   <td><h4><input type="text" id="obs" class="form-control" value="" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Envio Emitido por</strong></h5></td>
                   <td><h4><input type="text" id="emite" class="form-control" value="" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Status</strong></h5></td>
                   <td><h4><input type="text" id="status" class="form-control" value="Recibido" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Registro Ingresado por</strong></h5></td>
                   <td><h4><input type="text" id="registra" class="form-control" value="Recibido" readonly></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Persona que recibe envio</strong></h5></td>
                   <td><h4><input type="text" id="recibido" class="form-control" placeholder="Ingrese nombre de la persona que recibio el envio o el transporte"  autocomplete="off" required /></h4></td>
                 </tr>
                 <tr>
                   <td><h5><strong>Enviar Notificacion por Correo</strong></h5></td>
                   <td><h4><label><input type="checkbox" value="" id="notificacion"> Check para enviar correo </label></h4></td>
                 </tr>
               </tbody>
             </table>
             <button type="submit" class="btn btn-info btn-lg">
               <i class="fa fa-user-plus" aria-hidden="true"></i> Ingreso de Envio
             </button>
           </form>
           <div class="modal-footer">
             <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
           </div>
        </div>
       </div>
      </div> <!-- fin modal -->




    </div> <!-- /container con el App -->
    <!-- JS de Boostrap -->
    <script src="<?php echo $directorioRaiz.$boostrapJS; ?>"></script>
    <!-- JS Viewports -->
    <script src="<?php echo $directorioRaiz.$viewportJS; ?>"></script>

    <!-- Acciones JS -->
    <script>
      var accion;
      var idP;

      function EnvioCF(idCF, cliente, tipo, transporte, direccion, fechaEnvio, fechaEntrega, piloto, vendedor, factura, seEnvia, obs, emite){
        $('#nombreCF').attr("value",cliente)
        $('#tEnvioCF').attr("value",tipo)
        $('#transporteCF').attr("value",transporte)
        $('#direccionCF').attr("value",direccion)
        $('#fechaEmisionCF').attr("value",fechaEnvio)
        $('#fechaEntregaCF').attr("value",fechaEntrega)
        $('#pilotoCF').attr("value",piloto)
        $('#vendedorCF').attr("value",vendedor)
        $('#facturaCF').attr("value",factura)
        $('#seEnviaCF').attr("value",seEnvia)
        $('#obsCF').attr("value",obs)
        $('#emiteCF').attr("value",emite)

        $('#modal-cf').modal('show');
      }

      function EnvioDistribucion(idD,msgNombre,nombreD, msgDireccion, direccionD, tipoD, transporteD, fechaEnvioD, fechaEntregaD, pilotoD, vendedorD, facturaD, seEnviaD, obsD, emiteD, envioN, statusD, fechaR, correo, ingreso, firma){
        $('#nombreD').attr("value",nombreD)
        $("#nombreDL").text(msgNombre);
        $('#direccionD').attr("value",direccionD)
        $("#direccionDL").text(msgDireccion);
        $('#tipoD').attr("value",tipoD)
        $('#transporteD').attr("value",transporteD)
        $('#fechaEmisionD').attr("value",fechaEnvioD)
        $('#fechaEntregaD').attr("value",fechaEntregaD)
        $('#pilotoD').attr("value",pilotoD)
        $('#vendedorD').attr("value",vendedorD)
        $('#facturaD').attr("value",facturaD)
        $('#seEnviaD').attr("value",seEnviaD)
        $('#obsD').attr("value",obsD)
        $('#emiteD').attr("value",emiteD)
        $('#statusD').attr("value",statusD)
        $('#recibido').attr("value",fechaR)
        $('#correo').attr("value",correo)
        $('#ingreso').attr("value",ingreso);
        $('#firma').attr("value",firma);

        $('#modal-distribucion').modal('show');
      }

      function RecibirDistribucion(idEnvio, msgNombre, nombre, msgDireccion, direccion, envio, transporte, idP, piloto, vendedor, seEnvia, obs, emite, registra, numeroEnvio){
        idP = numeroEnvio;
        accion = 'UD';

        $('#numeroEnvio').attr("value",numeroEnvio);
        $("#nombreL").text(msgNombre);
        $('#nombreI').attr("value",nombre);
        $("#direccionL").text(msgDireccion);
        $('#direccion').attr("value",direccion);
        $('#tipo').attr("value",envio);
        $('#transporte').attr("value",transporte);
        //$('#qPiloto').attr("value",idP+' - '+piloto)
        $('#vendedor').attr("value",vendedor);
        $('#seEnvia').attr("value",seEnvia);
        $('#obs').attr("value",obs);
        $('#emite').attr("value",emite);
        $('#registra').attr("value",registra);

        $('#modal-recepcion').modal('show');
      }
    </script>

    <!-- Animaciones -->
    <script>
      $('#animaTittle').addClass('animated fadeInLeft');
      $('#animaTittle1s').addClass('animated fadeInLeft');
      $('#animaText1').addClass('animated fadeInDown');
      $('#animaText1s').addClass('animated fadeInDown');
      $('#animaText2').addClass('animated fadeInDown');
      $('#animaText2s').addClass('animated fadeInDown');
      $('#animaText3').addClass('animated fadeInDown');
      $('#animaText3s').addClass('animated fadeInDown');
      $('#animaImage').addClass('animated flipInX');
    </script>

    <script>
      $('.autoDate').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "es",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        //toggleActive: true
      });
    </script>

    <script>
      $(document).ready(function() {
          $('#tabla').DataTable( {
              "language": {
                  "url": "../js/datatables/Spanish.json"
              },
              "order": [[ 0, "desc" ]]
          } );
      } );

      $(document).ready(function() {
          $('#tablaDistribucion').DataTable( {
              "language": {
                  "url": "../js/datatables/Spanish.json"
              },
              "order": [[ 0, "desc" ]]
          } );
      } );
    </script>

    <!-- AJAX PARA BUSQUEDA DE PILOTO CF-->
    <script>
      $(document).ready(function(){
        $('#qPiloto').typeahead({
          source: function(query, result)
          {
          $.ajax({
            url:"../include/clases/search/search.piloto.php",
            method:"POST",
            data:{query:query},
            dataType:"json",
            success:function(data)
            {
              result($.map(data, function(item){
              return item;
              }));
            }
          })
        }
      });
    });
    </script>

  </body>

    <footer class="footer">
        <div class="container">
        <p class="text-muted" align="center">Desarrollado por <a href="<?php echo $linkTwitter; ?>" target="_blank"><?php echo $desarrolladorApp." ".$twitterDesarrollador; ?></a>
        para <?php echo $nombreEmpresa; ?> versión <?php echo $versionApp." &#169; ".date("Y"); ?></p>
        </div>
    </footer>
</html>
