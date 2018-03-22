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

<?php $tituloPagina="Clientes"?>
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

    <!-- jQuery -->
    <script src="<?php echo $directorioRaiz.$jqueryJS; ?>"></script>

    <!-- typeahead -->
    <script src="<?php echo $directorioRaiz.$bootstrapTypeJS; ?>"></script>


    <!--Font Awesome Icons -->
    <script type="text/javascript" src="https://use.fontawesome.com/041bce9f1d.js"></script>

    <!--Ajax Clientes -->
    <script type="text/javascript" src="../js/ajax.clientes.js"></script>


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
        $myMenu->printMenuView($directorioRaiz,2);
        ?>
      </div>
    </nav>

    <div class="container" id="app">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

         <!-- required -->
            <h3 id="animaText1">¿El clientes que desea ingresar es Distribuidor?</h3>
            <div class="radio" id="animaText1s">
              <label class="radio-inline">
                <input type="radio" v-model="vue.cliente" :value="true"> Sí
              </label>
              <label class="radio-inline">
                <input type="radio" v-model="vue.cliente" :value="false"> No
              </label>
            </div>

            <template v-if="vue.cliente">
                <p id="animaText1s" align="justify">De clic al siguiente botón para llenar el formulario de clientes. </p>

              <button type="button" onclick="Nuevo();" class="btn btn-primary btn-lg" >
                <i class="fa fa-spinner fa-pulse fa-fw"></i> Agregar Cliente
                <span class="sr-only"></span>
              </button>
            </template>

            <template v-else-if="vue.cliente == false">
                <p id="animaText2" align="justify">Este formulario es para agregar únicamente clientes Distribuidores,
                 en el caso de transportes internos ir a la pagina de envíos directamente</p>
            </template>

      </div> <!-- /Fin Jumbotron -->

      <!-- Modal Para llenado -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" align="center"> <strong><strong>Agregar Cliente Nuevo</strong></strong> </h3> <br>
            </div>
            <form role="form" action="" name="frmClientes" onsubmit="Registrar(idP,accion); return false">
              <div class="col-lg-12">

                <div class="form-group">
                  <label for="codigo">Codigo de Cliente</label>
                  <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el codigo del cliente o cuenta *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre del cliente o cuenta *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="direccion">Dirección</label>
                  <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección del cliente o cuenta *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="qDepartamento">Departamento - Autobusqueda</label>
                  <input type="text" id="qDepartamento" name="qDepartamento" class="form-control" placeholder="Departamento al que se envia" autocomplete="off" >
                </div>

                <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono del cliente o cuenta *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese la dirección de correo del cliente o cuenta *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="direccionContacto">Direccion Envio</label>
                  <input type="text" id="direccionContacto" name="direccionContacto" class="form-control" placeholder="Ingrese la dirección que aparece en el ENVIO *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="contacto">Contacto</label>
                  <input type="text" id="contacto" name="contacto" class="form-control" placeholder="Ingrese nombre de contacto *" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="telefonoContacto">Telefono Contacto</label>
                  <input type="text" id="telefonoContacto" name="telefonoContacto" class="form-control" placeholder="Ingrese el telefono de contacto " autocomplete="off" >
                </div>

                <button type="submit" class="btn btn-info btn-lg">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Agregar
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- JS de vue 2.4 -->
    <script src="https://unpkg.com/vue@2.4.1"> </script>
    <!-- JS de Boostrap -->
    <script src="<?php echo $directorioRaiz.$boostrapJS; ?>"></script>
    <!-- JS Viewports -->
    <script src="<?php echo $directorioRaiz.$viewportJS; ?>"></script>

    <!-- Iniciamos con VUE -->
    <script>
      var vm = new Vue({
        el: "#app",
        data: {
          vue: {
            description: '',
            cliente: null,
            codigo: null,
            nombre: null,
            direccion: null,
            nombreEnvio: null,
            telefono: null,
          }
        }
      });
    </script>

    <!-- Acciones JS -->
    <script>
      var accion;
      var idP;

      function Nuevo(){
        accion = 'N';
        document.frmClientes.codigo.value = "" ;
        document.frmClientes.nombre.value = "" ;
        document.frmClientes.direccion.value = "" ;
        document.frmClientes.qDepartamento.value = "" ;
        document.frmClientes.telefono.value = "";
        document.frmClientes.email.value = "";
        document.frmClientes.direccionContacto.value = "" ;
        document.frmClientes.contacto.value = "" ;
        document.frmClientes.telefonoContacto.value = "" ;

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

    <!-- Busqueda de Departamentos -->
    <script>
        $(document).ready(function(){
          $('#qDepartamento').typeahead({
            source: function(query, result)
            {
            $.ajax({
              url:"../include/clases/search/search.departamento.php",
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
