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

<?php $tituloPagina="Transportes"?>
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

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $directorioRaiz.$viewportCSS; ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $directorioRaiz.$fixedCSS; ?>" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="<?php echo $directorioRaiz.$animateCSS; ?>" rel="stylesheet">

    <!-- Animate Time CSS -->
    <link href="<?php echo $directorioRaiz.$animaTimeCSS; ?>" rel="stylesheet">

    <!-- SweetAlert -->
    <link href="<?php echo $directorioRaiz.$sweetCSS; ?>" rel="stylesheet">
    <script src="<?php echo $directorioRaiz.$sweetJS; ?>"></script>


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $directorioRaiz.$emulationJS; ?>"></script>

    <!--Font Awesome Icons -->
    <script type="text/javascript" src="https://use.fontawesome.com/041bce9f1d.js"></script>

    <!-- Jquery -->
    <script src="<?php echo $directorioRaiz.$jqueryJS; ?>"></script>

    <!--Ajax Clientes -->
    <script type="text/javascript" src="../js/ajax.transportes.js"></script>


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
        $myMenu->printMenuView($directorioRaiz,3);
        ?>
      </div>
    </nav>

    <div class="container" id="app">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

         <!-- required -->
          <h3 id="animaText1">De clic al siguiente botón para llenar el formulario de transportes.</h3>
          <button id="animaText1s" type="button" onclick="Nuevo();" class="btn btn-primary btn-lg" >
            <i class="fa fa-spinner fa-pulse fa-fw"></i> Agregar Transporte
            <span class="sr-only"></span>
          </button>

          <div align="center" id="animaImage">
            <img src="<?php echo $directorioRaiz.$transporte; ?>" alt="" width="600" height="360">
          </div>

      </div> <!-- /Fin Jumbotron -->

      <!-- Modal Para llenado -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Agregar Empresa de Transporte Nueva</strong></strong></h3> <br>
            </div>
            <form role="form" action="" name="frmTransportes" onsubmit="Registrar(idP,accion); return false">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="nombreT">Nombre</label>
                  <input type="text" id="nombreT" name="nombreT" class="form-control" placeholder="Ingrese el nombre del transporte *" required>
                </div>
                <div class="form-group">
                  <label for="direccionT">Dirección</label>
                  <input type="text" id="direccionT" name="direccionT" class="form-control" placeholder="Ingrese la dirección del transporte *" required>
                </div>
                <div class="form-group">
                  <label for="telefonoT">Telefono</label>
                  <input type="text" id="telefonoT" name="telefonoT" class="form-control" placeholder="Ingrese el telefono del transporte *" required>
                </div>
                <div class="form-group">
                  <label for="contactoT">Contacto</label>
                  <input type="text" id="contactoT" name="contactoT" class="form-control" placeholder="Ingrese nombre de contacto" >
                </div>
                <div class="form-group">
                  <label for="observacionesT">Observaciones</label>
                  <input type="text" id="observacionesT" name="observacionesT" class="form-control" placeholder="Agregue Observaciones" >
                </div>
                <button type="submit" class="btn btn-info btn-lg">
                <i class="fa fa-bus" aria-hidden="true"></i> Agregar
                </button>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fa fa-times"></i> </button>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- /container con el App -->
    <!-- JS de Boostrap -->
    <script src="<?php echo $directorioRaiz.$boostrapJS; ?>"></script>
    <!-- JS Viewports -->
    <script src="<?php echo $directorioRaiz.$viewportJS; ?>"></script>

    <!-- Acciones JS -->
    <script>
      var accion;
      var idP;
      function Nuevo(){
        accion = 'N';
        document.frmTransportes.nombreT.value ="";
        document.frmTransportes.direccionT.value ="";
        document.frmTransportes.telefonoT.value ="";
        document.frmTransportes.contactoT.value ="";
        document.frmTransportes.observacionesT.value ="";

        $('#modal').modal('show');
      }
      function Editar(id, nombreT, direccionT, telefonoT, contactoT, observacionesT){
        accion = 'E';
        idP = id;
        document.frmTransportes.nombreT.value = nombreT ;
        document.frmTransportes.direccionT.value = direccionT ;
        document.frmTransportes.telefonoT.value = telefonoT;
        document.frmTransportes.contactoT.value = contactoT;
        document.frmTransportes.observacionesT.value = observacionesT ;

        $('#modal').modal('show');
      }

    </script>

    <!-- Animaciones -->
    <script>
      $('#animaTittle').addClass('animated fadeInLeft');
      $('#animaTittle1s').addClass('animated fadeInLeft');
      $('#animaText1').addClass('animated fadeInDown');
      $('#animaText1s').addClass('animated fadeInDown');
      $('#animaText2').addClass('animated fadeInDown');
      $('#animaText3').addClass('animated fadeInDown');
      $('#animaImage').addClass('animated flipInX');
    </script>


  </body>

    <footer class="footer">
        <div class="container">
        <p class="text-muted" align="center">Desarrollado por <a href="<?php echo $linkTwitter; ?>" target="_blank"><?php echo $desarrolladorApp." ".$twitterDesarrollador; ?></a>
        para <?php echo $nombreEmpresa; ?> versión <?php echo $versionApp." &#169; ".date("Y"); ?></p>
        </div>
    </footer>
</html>
