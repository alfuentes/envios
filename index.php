<?php date_default_timezone_set('America/Guatemala'); setlocale(LC_ALL, "Spanish_Guatemala");   $dateLong = strftime(" %A %d de %B de %Y"); setlocale(LC_ALL, 'es_GT');//declaramos la zona horaria ?>
<?php $directorioRaiz =""; //si la pagina esta dentro de un directorio o no ?>
<?php require("include/config.php");  // incluimos el archivo de configuracion ?>
<?php require("include/media.php");  // incluimos el archivo de configuracion ?>
<?php

session_start(); //iniciamos la sesion
### VERIFICAMOS QUE EXISTA LA SESION Y QUE VALORES ALMACENA PARA DEFINIR EL ROL DEL USUARIO
if (isset($_SESSION['usuario'])){
  if ($_SESSION['usuario']['tipo']=='Administrador') {
    header('Location: administracion/index.php');
  } else if($_SESSION['usuario']['tipo']=='Usuario') {
    header('Location: usuarios/index.php');
  }
}

?>
<?php $tituloPagina="Sistema de Envios Aquasistemas"?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - <?php echo $tituloPagina; ?></title>
  <link href="css/login.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico">
  <!-- SweetAlert -->
  <link href="<?php echo $directorioRaiz.$sweetCSS; ?>" rel="stylesheet">
  <script src="<?php echo $directorioRaiz.$sweetJS; ?>"></script>
  <!-- Animate CSS -->
  <link href="<?php echo $directorioRaiz.$animateCSS; ?>" rel="stylesheet">
  <!-- Animate Time CSS -->
  <link href="<?php echo $directorioRaiz.$animaTimeCSS; ?>" rel="stylesheet">
  <!--Font Awesome Icons -->
  <script type="text/javascript" src="js/041bce9f1d.js"></script>
</head>
<body>

  <div class="alert alert-danger" role="alert" align="center">
    <i class="fa fa-exclamation-triangle" aria-hidden="true">
    </i> Datos de Usuario Invalidos, Por favor intente nuevamente.
  </div>
  <br>
  <br>
  <br>
  <div align="center" id="animaText1s">
    <img src="<?php echo $imageLogo; ?>" alt="" height="135" width="355">
  </div>
  <div class="main">
    <form class="" action="index.php" id="formlg">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="text-center"><strong>Login</strong></h1>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control input-lg" pattern="[A-Za-z0-9_-@!#$%&/]{1,15}" id="usuario" name="usuario" placeholder="Usuario"  required />
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" pattern="[A-Za-z0-9_-@!#$%&/]{1,15}" id="pass" name="pass" placeholder="Contraseña" required />
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-block btn-lg btn-primary" id="botonlg" value="Iniciar Sesion" />
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>
<script>
  $('.alert').hide();
  $('#animaText1s').addClass('animated fadeInDown');
</script>
</body>
<footer class="footer">
  <div class="container">
    <p class="text-muted" align="center">
      <strong>
        Desarrollado por <a href="<?php echo $linkTwitter; ?>" target="_blank"><?php echo $desarrolladorApp." ".$twitterDesarrollador; ?></a>
        para <?php echo $nombreEmpresa; ?> versión <?php echo $versionApp." &#169; ".date("Y"); ?>
      </strong>
    </p>
  </div>
</footer>
</html>
