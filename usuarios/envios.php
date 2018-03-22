<?php date_default_timezone_set('America/Guatemala'); setlocale(LC_ALL, "Spanish_Guatemala");   $dateLong = strftime(" %A %d de %B de %Y"); //declaramos la zona horaria ?>
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

<?php $tituloPagina="Envios"?>
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
    <!--
    <script type="text/javascript" src="<?php echo $directorioRaiz.$typeJS; ?>"></script> -->

    <!-- jQuery -->
    <script src="<?php echo $directorioRaiz.$jqueryJS; ?>"></script>

    <!-- typeahead -->
    <script src="<?php echo $directorioRaiz.$bootstrapTypeJS; ?>"></script>

    <!--Font Awesome Icons -->
    <script type="text/javascript" src="https://use.fontawesome.com/041bce9f1d.js"></script>

    <!--Ajax Envios -->
    <script type="text/javascript" src="../js/ajax.envios.js"></script>

     <!--datePicker -->
     <link href="<?php echo $directorioRaiz.$datepickerCSS; ?>" rel="stylesheet">
     <script src="<?php echo $directorioRaiz.$datepickerJS; ?>"></script>
     <script src="<?php echo $directorioRaiz.$datepickerES; ?>"></script>

     <!--moment -->
     <script src="<?php echo $directorioRaiz.$momentJS; ?>"></script>



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
        $myMenu->printMenuView($directorioRaiz,6);
        ?>
      </div>
    </nav>

    <div class="container" id="app">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

         <!-- required -->
         <h3 id="animaText1" align="center">De clic al siguiente botón según el tipo de envio que desea generar.</h3>
        <div align="center">
          <button id="animaText1s" type="button" onclick="envioDistribuidor();" class="btn btn-primary btn-lg" >
          <i class="fa fa-bus" aria-hidden="true"></i> Envio a Distribuidores
            <span class="sr-only"></span>
          </button>

          <button id="animaText2s" type="button" onclick="envioClienteFinal();" class="btn btn-success btn-lg" >
          <i class="fa fa-user-circle" aria-hidden="true"></i> Envio a Cliente Final
            <span class="sr-only"></span>
          </button>
        </div>


      </div> <!-- /Fin Jumbotron -->

      <!-- Modal Para llenado Distribucion-->
      <div class="modal fade" id="modalDistribucion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Envio a Distribuidores</strong></strong> </h3> <br>
            </div>
            <form role="form" action="" name="frmEnvioDi" onsubmit="registroDistribuidor(idP,accion); return false">
              <div class="col-lg-12">

                <div class="form-group">
                  <label for="nombre">Tipo de Envio</label>
                  <input type="text" id="envio" name="envio" class="form-control" placeholder="Distribucion" value ="Distribucion" readonly >
                </div>

                <div class="form-group">
                  <label for="qCliente">Cliente - Autobúsqueda </label>
                  <input type="text" id="qCliente" name="qCliente" class="form-control" placeholder="Ingrese nombre de cliente" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="seleccionNombre">Desea cambiar el nombre del envío?</label>
                  <select class="form-control" id="seleccionNombre" required >
                    <option selected>No</option>
                    <option>Si</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nombreEnvio">Nuevo Nombre en el Envío</label>
                  <input type="text" id="nombreEnvio" name="nombreEnvio" class="form-control" placeholder="Ingrese el nuevo nombre que aparece en el envío, si aplica" autocomplete="off" >
                </div>

                <div class="form-group">
                  <label for="qTransporte">Transporte - Autobúsqueda </label>
                  <input type="text" id="qTransporte" name="qTransporte" class="form-control" placeholder="Ingrese nombre de transporte" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="seleccionDireccion">Desea cambiar la dirección del envío?</label>
                  <select class="form-control" id="seleccionDireccion" required>
                    <option selected>No</option>
                    <option>Si</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="direccionEnvio">Nueva Dirección Envío</label>
                  <input type="text" id="direccionEnvio" name="direccionEnvio" class="form-control" placeholder="Ingrese la nueva dirección de envio, si aplica" autocomplete="off" >
                </div>

                <div class="form-group">
                  <label for="qPiloto">Piloto - Autobúsqueda</label>
                  <input type="text" id="qPiloto" name="qPiloto" class="form-control" placeholder="Ingrese nombre del piloto" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="qVendedor">Vendedor - Autobúsqueda</label>
                  <input type="text" id="qVendedor" name="qVendedor" class="form-control" placeholder="Ingrese el nombre del vendedor " autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="seEnvia">Que es lo que se Envía</label>
                  <input type="text" id="seEnvia" name="seEnvia" class="form-control" placeholder="Que es lo que se envía " autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="factura">Ingrese el No. de Factura</label>
                  <input type="text" id="factura" name="factura" class="form-control" placeholder="Ingrese el numero de factura " autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="instrucciones">Instrucciones</label>
                  <input type="text" id="instrucciones" name="instrucciones" class="form-control" placeholder="Instrucciones del Envio " autocomplete="off" >
                </div>

                <div class="form-group">
                  <label for="emite">Emite</label>
                  <input type="text" id="emite" name="emite" class="form-control"  placeholder="<?php echo $_SESSION['usuario']['nombre'];?>" value="<?php echo $_SESSION['usuario']['nombre'];?>" readonly >
                </div>

                <button type="submit" class="btn btn-info btn-lg">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Envío
                </button>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
            </div>
          </div>
        </div>
      </div> <!-- Fin modal Distribucion -->

      <!-- Modal Para llenado Cliente Final -->
      <div class="modal fade" id="modalClienteFinal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Envio a Cliente Final</strong></strong> </h3> <br>
              <h4 align="justify"> Se les recuerda a todos los vendedores que no se ofrecen horarios específicos de entrega,
              que no se ofrece traslado de la mercadería hasta la puerta si no se tiene parqueo o si se habla de llevar el producto a
              diferentes niveles de un edificio, no se le puede pedir al transportista que cobre dinero pendiente, y por último,
              no se ofrece servicio a los siguientes lugares: La Verbena, El milagro, San José las Rosas, San Rafael, Colonia Maya y Zona 18. </h4> <br>
            </div>
            <form role="form" action="" name="frmEnvioCF" onsubmit="registroClienteFinal(idP,accion); return false">
              <div class="col-lg-12">

                <div class="form-group">
                  <label for="nombre">Tipo de Envio</label>
                  <input type="text" id="envio" name="envio" class="form-control" placeholder="Cliente Final" value ="Cliente Final" readonly >
                </div>

                <div class="form-group">
                  <label for="nombreEnvio">Nombre del Cliente</label>
                  <input type="text" id="nombreEnvio" name="nombreEnvio" class="form-control" placeholder="Ingrese el nombre que aparece en el envío" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="telefonoEnvio">Telefono Cliente</label>
                  <input type="text" id="telefonoEnvio" name="telefonoEnvio" class="form-control" placeholder="Ingrese el telefono que aparece en el envío" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="qTransporteCF">Transporte - Autobúsqueda </label>
                  <input type="text" id="qTransporteCF" name="qTransporteCF" class="form-control" placeholder="Ingrese nombre de transporte" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="direccionEnvio">Dirección Envío</label>
                  <input type="text" id="direccionEnvio" name="direccionEnvio" class="form-control" placeholder="Ingrese la dirección de envio" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="qPilotoCF">Piloto - Autobúsqueda</label>
                  <input type="text" id="qPilotoCF" name="qPilotoCF" class="form-control" placeholder="Ingrese nombre del piloto" autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="qVendedorCF">Vendedor - Autobúsqueda</label>
                  <input type="text" id="qVendedorCF" name="qVendedorCF" class="form-control" placeholder="Ingrese el nombre del vendedor " autocomplete="off" required >
                </div>

                <div class="form-group date autoDate">
                  <label for="fechaEntrega">Selecciones la fecha de entrega</label>
                  <input type="text" id="fechaEntrega" name="fechaEntrega" class="form-control" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="seEnvia">Que es lo que se Envía</label>
                  <input type="text" id="seEnvia" name="seEnvia" class="form-control" placeholder="Que es lo que se envía " autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="factura">Ingrese el No. de Factura</label>
                  <input type="text" id="factura" name="factura" class="form-control" placeholder="Ingrese el numero de factura " autocomplete="off" required >
                </div>

                <div class="form-group">
                  <label for="instrucciones">Instrucciones</label>
                  <input type="text" id="instrucciones" name="instrucciones" class="form-control" placeholder="Instrucciones del Envio " autocomplete="off" >
                </div>

                <div class="form-group">
                  <label for="emite">Emite</label>
                  <input type="text" id="emite" name="emite" class="form-control" placeholder="<?php echo $_SESSION['usuario']['nombre'];?>" value="<?php echo $_SESSION['usuario']['nombre'];?>" readonly >
                </div>

                <button type="submit" class="btn btn-info btn-lg">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Envío
                </button>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
            </div>
          </div>
        </div>
      </div> <!-- Fin modal -->

    </div> <!-- /container con el App -->

    <!-- JS de Boostrap -->
    <script src="<?php echo $directorioRaiz.$boostrapJS; ?>"></script>
    <!-- JS Viewports -->
    <script src="<?php echo $directorioRaiz.$viewportJS; ?>"></script>

    <!-- Acciones JS -->
    <script>
      var accion;
      var idP;
      function envioDistribuidor (){
        accion = 'N';
        document.frmEnvioDi.envio.value ="";
        document.frmEnvioDi.qCliente.value ="";
        document.frmEnvioDi.seleccionNombre.value ="";
        document.frmEnvioDi.nombreEnvio.value ="";
        document.frmEnvioDi.qTransporte.value ="";
        document.frmEnvioDi.seleccionDireccion.value ="";
        document.frmEnvioDi.direccionEnvio.value ="";
        document.frmEnvioDi.qPiloto.value ="";
        document.frmEnvioDi.qVendedor.value ="";
        document.frmEnvioDi.seEnvia.value ="";
        document.frmEnvioDi.factura.value ="";
        document.frmEnvioDi.instrucciones.value ="";
        document.frmEnvioDi.emite.value ="<?php echo $_SESSION['usuario']['nombre'];?>";

        $('#modalDistribucion').modal('show');
      }

      function envioClienteFinal (){
        accion = 'N';
        document.frmEnvioCF.envio.value ="";
        document.frmEnvioCF.nombreEnvio.value ="";
        document.frmEnvioCF.telefonoEnvio.value ="";
        document.frmEnvioCF.qTransporteCF.value ="";
        document.frmEnvioCF.direccionEnvio.value ="";
        document.frmEnvioCF.qPilotoCF.value ="";
        document.frmEnvioCF.qVendedorCF.value ="";
        document.frmEnvioCF.fechaEntrega.value ="";
        document.frmEnvioCF.seEnvia.value ="";
        document.frmEnvioCF.factura.value ="";
        document.frmEnvioCF.instrucciones.value ="";
        document.frmEnvioCF.emite.value ="<?php echo $_SESSION['usuario']['nombre'];?>";

        $('#modalClienteFinal').modal('show');
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

    <!-- AJAX PARA BUSQUEDA DE CLIENTE -->
    <script>
      $(document).ready(function(){
        $('#qCliente').typeahead({
          source: function(query, result)
          {
          $.ajax({
            url:"../include/clases/search/search.cliente.php",
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

  <!-- AJAX PARA BUSQUEDA DE TRANSPORTE -->
  <script>
    $(document).ready(function(){
      $('#qTransporte').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"../include/clases/search/search.transporte.php",
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

    <!-- AJAX PARA BUSQUEDA DE TRANSPORTE CF -->
  <script>
    $(document).ready(function(){
      $('#qTransporteCF').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"../include/clases/search/search.transporte.php",
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

  <!-- AJAX PARA BUSQUEDA DE PILOTO -->
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

  <!-- AJAX PARA BUSQUEDA DE PILOTO CF-->
  <script>
    $(document).ready(function(){
      $('#qPilotoCF').typeahead({
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

  <!-- AJAX PARA BUSQUEDA DE VENDEDOR -->
  <script>
    $(document).ready(function(){
      $('#qVendedor').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"../include/clases/search/search.vendedor.php",
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

<!-- AJAX PARA BUSQUEDA DE VENDEDOR CF-->
<script>
    $(document).ready(function(){
      $('#qVendedorCF').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"../include/clases/search/search.vendedor.php",
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

  </body>

    <footer class="footer">
        <div class="container">
        <p class="text-muted" align="center">Desarrollado por <a href="<?php echo $linkTwitter; ?>" target="_blank"><?php echo $desarrolladorApp." ".$twitterDesarrollador; ?></a>
        para <?php echo $nombreEmpresa; ?> versión <?php echo $versionApp." &#169; ".date("Y"); ?></p>
        </div>
    </footer>
</html>
