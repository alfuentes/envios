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

<?php $tituloPagina="Vendedores"?>
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

    <!-- Jquery -->
    <script src="<?php echo $directorioRaiz.$jqueryJS; ?>"></script>

    <!--Font Awesome Icons -->
    <script type="text/javascript" src="https://use.fontawesome.com/041bce9f1d.js"></script>

    <!--Ajax Clientes -->
    <script type="text/javascript" src="../js/ajax.vendedores.js"></script>


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
        $myMenu->printMenuView($directorioRaiz,5);
        ?>
      </div>
    </nav>

    <div class="container" id="app">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

         <!-- required -->
          <h3 id="animaText1">De clic al siguiente botón para llenar el formulario de vendedores.</h3>
          <button id="animaText1s" type="button" onclick="Nuevo();" class="btn btn-primary btn-lg" >
            <i class="fa fa-spinner fa-pulse fa-fw"></i> Agregar Vendedores
            <span class="sr-only"></span>
          </button>
          <br> <br>
          <div align="center" id="animaImage">
            <img src="<?php echo $directorioRaiz.$vendedores; ?>" alt="" width="560" height="360">
          </div>
          <br>
          <div class="panel panel-default" id="animaText3s">
          <div class="panel-heading"><h4 align="center"><strong>Lista de Vendedores</strong> </h4></div>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>E-mail</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require("../include/clases/Conexion.php");
              $con = Conectar();
              $sql = "SELECT id, nombre, telefono, email FROM vendedores";
              $stmt = $con->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
              foreach($rows as $row){
                ?>
                <tr>
                  <td><?php print($row->id); ?></td>
                  <td><?php print($row->nombre); ?></td>
                  <td><?php print($row->telefono); ?></td>
                  <td><?php print($row->email); ?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Seleccione</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a onclick="Editar('<?php print($row->id); ?>','<?php print($row->nombre); ?>','<?php print($row->telefono); ?>','<?php print($row->email); ?>');">Actualizar</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>


      </div> <!-- /Fin Jumbotron -->

      <!-- Modal Para llenado -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Agregar o Actualizar Vendedores</strong></strong></h3> <br>
            </div>
            <form role="form" action="" name="frmVendedores" onsubmit="Registrar(idP,accion); return false">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="nombreV">Nombre</label>
                  <input type="text" id="nombreV" name="nombreV" class="form-control" placeholder="Ingrese el nombre del vendedor *" required>
                </div>

                <div class="form-group">
                  <label for="telefonoV">Telefono</label>
                  <input type="text" id="telefonoV" name="telefonoV" class="form-control" placeholder="Ingrese el telefono del vendedor *" required>
                </div>
                <div class="form-group">
                  <label for="emailV">Email</label>
                  <input type="text" id="emailV" name="emailV" class="form-control" placeholder="Ingrese correo del piloto" >
                </div>
                <button type="submit" class="btn btn-info btn-lg">
                <i class="fa fa-address-card" aria-hidden="true"></i> Agregar
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
        document.frmVendedores.nombreV.value ="";
        document.frmVendedores.telefonoV.value ="";
        document.frmVendedores.emailV.value ="";

        $('#modal').modal('show');
      }
      function Editar(id, nombreV, telefonoV, emailV){
        accion = 'E';
        idP = id;
        document.frmVendedores.nombreV.value = nombreV ;
        document.frmVendedores.telefonoV.value = telefonoV;
        document.frmVendedores.emailV.value = emailV;

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
      $('#animaText2s').addClass('animated fadeInDown');
      $('#animaText3').addClass('animated fadeInDown');
      $('#animaText3s').addClass('animated fadeInDown');
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
