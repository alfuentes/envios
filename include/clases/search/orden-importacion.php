<?php
session_start();
#session_destroy();

date_default_timezone_set('America/Guatemala'); #Seteamos la hora

$directorio="../../";

#----------------------- CONDICIONES DE ACCESO A LA PAGINA -----------------------#
#PRIMERA CONDICION#
// si la sesion del usuario no ha sido encontrada entonces denegamos el acceso

if (!isset($_SESSION['user_id'])){
    $badpage=$directorio."assets/template/badpage.php";
    require($badpage);

    //destruimos sesion
    session_destroy();

    //redirigimos al index.php
    ?><META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo $directorio; ?>index.php">  <?php
    }

else
{

/* iniciamos cargando los datos del usuario*/
$user_id = $_SESSION['user_id'];

/* clases para datos de usuario, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
$conectorodbc=$directorio."assets/lib/functions/odbc.php";
include($conectorodbc);
$libdatauser=$directorio."assets/lib/functions/datauser.php";
include($libdatauser);

/* declaramos un nuevo objeto de conexion al usuario Mysql*/
$d_usuario = new ConexionUsuarioMy();

/* enviamos al metodo dataset_id los datos de conexion a la BD */
$d_usuario->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);

/* Enviamos los valores de la tabla, el campo al que apunta, el nombre del campo donde hace el where y el valor a buscar  */
$d_usuario->datosusuario("tbl_usuarios","id",$user_id);

/* Funciones con valores retornados*/
/* Pueden editarse, crear las funciones publicas y las variables privadas*/
$usuario_nombre = $d_usuario->retornar_nombre("");
$usuario_apellido = $d_usuario->retornar_apellido("");
$usuario_usuario = $d_usuario->retornar_usuario("");
$usuario_pass = $d_usuario->retornar_pass("");
$usuario_correo = $d_usuario->retornar_correo("");
$usuario_fecha = $d_usuario->retornar_fecha("");
$usuario_status = $d_usuario->retornar_status("");
$usuario_rol = $d_usuario->retornar_rol("");
$usuario_obs = $d_usuario->retornar_obs("");

/* Formateando la fecha almacenada en sistema*/
$formato_fecha = explode("-", $usuario_fecha);

/* cuerpo del sitio, encabezado, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
$template_header=$directorio."assets/template/site/header.php";
include($template_header);
/* footer del sitio, rutas js, footer y otras funciones */
$template_footer=$directorio."assets/template/site/footer.php";
include($template_footer);

$titulo_pagina="Ordenes de Importación";
encabezado("$titulo_pagina"); #Encabezado de la pagina

/* direcciones de hojas de estilos, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
$es1=$directorio."assets/css/bootstrap.min3.css";                   // url href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
$es2=$directorio."assets/css/main.css";                             // url href="assets/css/main.css"
$es3=$directorio."assets/css/theme.css";                            // url href="assets/css/theme.css"
$es4=$directorio."assets/css/MoneAdmin.css";                        // url href="assets/css/MoneAdmin.css"
$fontawesome="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css";
estilos($es1,$es2,$es3,$es4,$fontawesome); #Estilos de la pagina y rutas de las hojas de estilos

$icon = $directorio."assets/css/html.svg";
icono($icon);

$css_jqueryui=$directorio."assets/js/jquery-ui/jquery-ui.css";
agregar_css($css_jqueryui);

$css_layout2=$directorio."assets/css/layout2.css";
agregar_css($css_layout2);

$css_typeahead=$directorio."assets/css/typeahead.css";
agregar_css($css_typeahead);

$jquery_12js=$directorio."assets/js/jquery-1.10.2.js";
agregar_script($jquery_12js);

$jqueryui_js=$directorio."assets/js/jquery-ui.js";
agregar_script($jqueryui_js);

/* SCRIPT PARA BUSQUEDAS DINAMICAS*/
$js_typeahead = $directorio."assets/plugins/typeahead2.js";
agregar_script($js_typeahead);

?>
     <!-- Javascript -->
      <script>
          $(function() {
          $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
              Ok: function() {
                $( this ).dialog( "close" );
                }
              }
            });
          });
      </script>

      <!-- AJAX PARA BUSQUEDA DE PROVEEDOR -->
    <script>
        $(document).ready(function() {
            $('input.prov').typeahead({
                name: 'prov',
                remote:'../../assets/lib/search/proveedor.php?key=%QUERY',
                limit: 12
            });
        });
    </script>


    <!-- AJAX PARA BUSQUEDA DE FORWARDER -->
    <script>
        $(document).ready(function() {
            $('input.forwarder').typeahead({
                name: 'forwarder',
                remote:'../../assets/lib/search/forwarder.php?key=%QUERY',
                limit: 12
            });
        });
    </script>

    <!-- AJAX PARA BUSQUEDA DE CODIGO SAE -->
    <script>
        $(document).ready(function() {
            $('input.sae').typeahead({
                name: 'sae',
                remote:'../../assets/lib/search/codigosae.php?key=%QUERY',
                limit: 12
            });
        });
    </script>

    <!-- AJAX PARA BUSQUEDA DE FORWARDER -->
    <script>
        $(document).ready(function() {
            $('input.fabricante').typeahead({
                name: 'fabricante',
                remote:'../../assets/lib/search/fabricante.php?key=%QUERY',
                limit: 12
            });
        });
    </script>




<?php
fin_head();
?>

<!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
    <div id="wrap" >

        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 5px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>


                <ul class="nav navbar-top-links navbar-right">

                    <?php
                    /* cuerpo del sitio body, , con sus respectivos direccionamientos segun ubicación fisica de la ruta */
                    $template_body=$directorio."assets/template/site/body.php";
                    include($template_body);

                    #mensajes();
                    #tareas();
                    #alertas();

                    panel_usuario($usuario_nombre,$usuario_apellido,$directorio);
                    ?>

                </ul>
            </nav>
        </div>
        <!-- END HEADER SECTION -->

        <!-- MENU SECTION -->
            <?php
            /* cuerpo del sitio, encabezado, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
            $template_left=$directorio."assets/template/site/left.php";
            include($template_left);

            /* invocamos la funcion inicio de menu */
            menu("inicio");
            /* se llama la funcion foto_usuario que recibe como parametros, correo, nombre y apellido */
            foto_usuario($usuario_correo,$usuario_nombre,$usuario_apellido);
            /* se llama la funcion menu_sistema que recibe como parametros el directorio actual, nombre de modulo a excluir en directorio actual, id del usuario y pagina activa*/
            menu_sistema($directorio,"importaciones",$user_id);
            menu("fin");
            /* invocamos la funcion fin de menu */
             ?>
        <!--END MENU SECTION -->

        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> <?php echo $titulo_pagina;?> </h1>
                    </div>
                </div>
                  <hr />
                  <?php

                  /* clase de funciones con tablas de la BD, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
                  $libtables=$directorio."assets/lib/functions/tables.php";
                  include($libtables);

                  /* clase de funciones con tablas de la BD SQL, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
                  $libtables_sql=$directorio."assets/lib/functions/tables_sql.php";
                  include($libtables_sql);

                  /* declaramos un nuevo objeto Tables */
                  $tablas = new Tables();
                  /* enviamos los datos para conexión con BD */
                  $tablas->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                  /* invocamos el metodo para contar el total de filas de una tabla, devuelve numero de filas */
                  $tablas->totalfilas("tbl_modulos");
                  /* retorna el total de filas y almacena en variable */
                  $totalmodulos = $tablas->retornar_totafilas("");
                  /* invocamos el metodo para contar el todal de filas enviando tabla, campo, valor1, campo2, valor2 y devuelve numero de filas*/
                  $tablas->totalfilasdv("tbl_modulosporusuario","idusuario",$user_id,"status","Activo");
                  /* retorna el total de filas y almacena en variable */
                  $totalmodulosusuario = $tablas->retornar_totafilasdv("");

                  /* incluimos las funciones que muestran los blocks en el dashboard y otras paginas, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
                  $template_blocks=$directorio."assets/template/site/blocks.php";
                  include($template_blocks);

                  /* se declara el inicio del apartado de los blocs */
                  #bloc_iniciofin("inicio");
                  /* en este apartado se invoca la funcion block_nuevoblock */
                  /* esta recibe como parametros, un valor numerico, un url, un codigo de icono y el nombre del block*/
                  #block_nuevoblock($totalmodulos,"#","icon-th-large","Modulos");
                  #block_nuevoblock($totalmodulosusuario,"#","icon-th-list","Mis Modulos");
                  #bloc_iniciofin("fin");
                  /* se declara el final del apartado de los blocs */
                  ?>
                <!--hr /-->

                 <!-- CONTENIDO DE LA PAGINA  -->
                    <div class="row">
                    <div class="col-lg-12">
                     <div id="main" class="container-fluid">

                      <?php
                      /* incluimos las funciones de los contenedores, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
                      $libcontenedores=$directorio."assets/lib/functions/contenedores.php";
                      include($libcontenedores);

                      /* incluimos el archivo de alertas */
                      $libalertas=$directorio."assets/lib/functions/alertas.php";
                      include($libalertas);

                      if($usuario_rol<>""){

                        /* inicio de un contenedor */
                          contenedorbase("inicio");
                          /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                          contenedor("Ordenes de Importación","hand-o-right");
                          /* Agregamos el contenido que puede ser codigo HTML o PHP */
                          ?>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 >Apertura, consulta y detalles de ordenes de importación.</h4>
                            </div>
                            <div class="panel-body">
                              <div align="center">
                                  <p style="font-size:16px;"><strong>Seleccione la acción que desea realizar.</strong></p>
                                  <a href="<?php echo $_SERVER['PHP_SELF'];?>?accion=crear-orden" class="btn btn-primary" role="button">Crear Orden</a>
                                  <a href="<?php echo $_SERVER['PHP_SELF'];?>?accion=consultar-ordenes" class="btn btn-success" role="button">Consultar Ordenes</a>
                              </div>
                            </div>
                          </div>
                        </br>
                          <?php
                          contenedorbase("fin");
                          /* cerramos el contenedor */


                          if(isset($_GET["accion"])){

                            if($_GET["accion"] == "crear-orden"){
                              contenedorbase("inicio");
                              /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                              contenedor("Crear orden de Importacion","file-o");
                              /* Agregamos el contenido que puede ser codigo HTML o PHP */
                              /* declaramos un nuevo objeto Tables */
                                $tbl_importaciones_tables = new Tables();
                                /* enviamos los datos para conexión con BD */
                                $tbl_importaciones_tables->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                /* invocamos el metodo para contar el total de filas de una tabla, devuelve numero de filas */
                                $tbl_importaciones_tables->totalfilas("tbl_importaciones");
                                /* retorna el total de filas y almacena en variable */
                                $total_filas_importaciones = $tbl_importaciones_tables->retornar_totafilas("");
                                $nuevafila_importaciones = $total_filas_importaciones + 1;

                              ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Llene el siguiente formulario para crear una nueva Orden de Importacion.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=orden_creada&oid=$nuevafila_importaciones";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>LLENE EL SIGUIENTE FORMULARIO PARA AGREGAR EL REGISTRO #<?php echo $total_filas_importaciones +1; ?> A LA TABLA</strong></h5></td><tr>
                                      <tr>
                                        <td> <b>Nomenclatura de la orden:</b></td>
                                        <td><input name="nomenclatura" type="text" id="nomenclatura" class="form-control" placeholder="Ingrese la nomenclatura de la orden" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Usuario que apertura:</b></td>
                                        <td><input name="u_apertura" type="text" id="u_apertura" class="form-control" placeholder="Ingrese Nombre" value="<?php echo $usuario_usuario?>" readonly/></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Fecha Apertura:</b></td>
                                        <td><input name="f_apertura" type="text" id="f_apertura" class="form-control" placeholder="Ingrese Apellido" value="<?php echo date("d/m/Y");?>" readonly/></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Proveedor:</b></td>
                                        <td>
                                          <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                          <input type="text"  name="prov" id="prov" class="prov tt-query form-control" autocomplete="off" spellcheck="false" placeholder="Busqueda de Proveedor por Nombre" required autofocus />
                                          </span>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td> <b>Forwarder:</b></td>
                                        <td>
                                          <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                          <input type="text"  name="forwarder" id="forwarder" class="forwarder tt-query form-control" autocomplete="off" spellcheck="false" placeholder="Busqueda de Forwarder por Nombre" required autofocus />
                                          </span>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td> <b>Fecha Inicial (rotacion):</b></td>
                                        <td><input name="fecha-inicial" type="text" id="fecha-inicial" data-date-format="dd/mm/yyyy" data-mask="99/99/9999" id="dp2" class="form-control" placeholder="Fecha en formato dd/mm/AAAA" required autofocus/></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Fecha Final (rotacion):</b></td>
                                        <td><input name="fecha-final" type="text" id="fecha-final"data-date-format="dd/mm/yyyy" data-mask="99/99/9999" id="dp2" class="form-control" placeholder="Fecha en formato dd/mm/AAAA" required autofocus/></td>
                                      </tr>
                                      <tr >
                                        <td> <b>Importaciones Anuales:</b></td>
                                        <td><input name="impo-anual" type="text" id="impo-anual" data-mask="99" class="form-control" placeholder="Ingrese las importaciones anuales" required autofocus/></td>
                                      </tr>
                                      <tr >
                                        <td> <b>Crecimiento:</b></td>
                                        <td><input name="crecimiento" type="text" id="crecimiento" data-mask="99 %" class="form-control" placeholder="Ingrese el % de crecimiento de la importación" /></td>
                                      </tr>
                                      <tr >
                                        <td> <b>Terminos de Compra:</b></td>
                                        <td><input name="tc" type="text" id="tc" class="form-control" placeholder="Ingrese el termino de compra de esta orden" /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Status:</b></td>
                                        <td><input name="status" type="text" id="status" class="form-control" value="Activa" readonly /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Observaciones:</b></td>
                                        <td> <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Agregue observaciones correspondientes" ></textarea></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="orden-creada">Crear Orden</button>
                                          <button class="btn btn-lg btn-default " type="reset" >Limpiar Formulario</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                              <?php
                              contenedorbase("fin");

                            }

                            if($_GET["accion"] == "orden_creada" ){
                              if($_GET["oid"]<>""){
                                /* capturamos los valores enviados para insertarlos en la tabla de importaciones */
                                $oimp_nomenclatura = $_POST["nomenclatura"];
                                $oimp_f_apertura = date_create_from_format('d/m/Y', $_POST["f_apertura"]); // date_format($variable,"Y-m-d");
                                $oimp_idproveedor = explode("-",$_POST["prov"]); //seleccionar arreglo en posicion 0
                                $oimp_idforwarder = explode("-",$_POST["forwarder"]); //seleccionar arreglo en posicion 0
                                $oimp_rotacion_i = date_create_from_format('d/m/Y', $_POST["fecha-inicial"]); // date_format($variable,"Y-m-d");
                                $oimp_rotacion_f = date_create_from_format('d/m/Y', $_POST["fecha-final"]); // date_format($variable,"Y-m-d");
                                $oimp_impo_anual = intval($_POST["impo-anual"]);
                                $oimp_crecimiento = intval($_POST["crecimiento"]);
                                $oimp_tcompra = $_POST["tc"];
                                $oimp_tipo_orden = "Preorden";
                                $oimp_status = $_POST["status"];
                                $oimp_observaciones = $_POST["observaciones"];

                                /*creamos un nuevo objeto mysqli - 1 declaramos conector */
                                $mysqli_ordeni = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                /* comprobar la conexión  - 2 se prueba la conexion*/
                                if ($mysqli_ordeni->connect_errno) {
                                    printf("Falló la conexión: %s\n", $mysqli_ordeni->connect_error);
                                    exit();
                                }

                                /* 3 elaborar query*/
                                $query_ordeni = "
                                INSERT INTO tbl_importaciones (idorden, nomenclatura, idu_apertura,
                                idu_modifica, f_apertura, f_modificacion, idproveedor, idforwarder,
                                rotacion_i, rotacion_f, impo_anual, crecimiento, terminos_compra, tipo_orden, status,
                                total, observaciones)
                                VALUES (NULL, '$oimp_nomenclatura', '$user_id', '$user_id', '".date_format($oimp_f_apertura,"Y-m-d")."',
                                '".date_format($oimp_f_apertura,"Y-m-d")."', '".$oimp_idproveedor[0]."', '".$oimp_idforwarder[0]."',
                                '".date_format($oimp_rotacion_i,"Y-m-d")."', '".date_format($oimp_rotacion_f,"Y-m-d")."',
                                '$oimp_impo_anual', '$oimp_crecimiento', '$oimp_tcompra', '$oimp_tipo_orden', '$oimp_status', '0', '$oimp_observaciones');";

                                #echo "$query_ordeni";

                                /* Crear una tabla que no devuelve un conjunto de resultados */
                                if ($mysqli_ordeni->query($query_ordeni) === TRUE) {
                                  $tbl_importaciones_tables = new Tables();
                                  /* enviamos los datos para conexión con BD */
                                  $tbl_importaciones_tables->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                  /* invocamos el metodo para contar el total de filas de una tabla, devuelve numero de filas */
                                  $tbl_importaciones_tables->totalfilas("tbl_importaciones");
                                  /* retorna el total de filas y almacena en variable */
                                  $ultima_importacion = $tbl_importaciones_tables->retornar_totafilas("");
                                  /* comprobar la conexión */

                                  /*creamos un nuevo objeto mysqli - 1 declaramos conector */
                                  $mysqli_ordenclib = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                  /* comprobar la conexión  - 2 se prueba la conexion*/
                                  if ($mysqli_ordenclib->connect_errno) {
                                      printf("Falló la conexión: %s\n", $mysqli_ordeni->connect_error);
                                      exit();
                                  }

                                  /* 3 elaborar query*/
                                  $query_ordenclib = "
                                  INSERT INTO tbl_impo_clib (id, idorden, cantidad, descripciones,status)
                                  VALUES (NULL, '$ultima_importacion', '1', 'Factor', 'Activo');";

                                  #echo $query_ordenclib;

                                  if ($mysqli_ordenclib->query($query_ordenclib) === TRUE) {
                                    ?>
                                    <div class="col-lg-12">
                                       <div class="panel panel-success">
                                           <div class="panel-heading">
                                               Orde de Importacion Creada
                                           </div>
                                           <div class="panel-body">
                                               <p>La orden de importación numero <strong><?php echo $ultima_importacion;?></strong> ha sido creada exitosamente,
                                                 el siguiente paso es la asignación de los campos libres de la orden</p>
                                           </div>
                                           <div class="panel-footer">
                                               Dirigiendose a la tabla de asignación de campos libres
                                           </div>
                                       </div>
                                   </div>
                                   <META HTTP-EQUIV="REFRESH" CONTENT="7;URL=<?php echo $_SERVER['PHP_SELF']."?accion=crear-campos-libres&oid=$ultima_importacion";?>">
                                   <?php

                                  } #if query true campos libres
                                } #if query true
                              } #if oid
                            } #if accion orden_creada

                            if($_GET["accion"] == "crear-campos-libres" ){
                              if($_GET["oid"]<>""){
                                $ordencreada = $_GET["oid"];
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Creacion de campos libres a la orden","edit");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Seleccione los campos libres que desea agregar a la Orden <strong>#<?php echo $ordencreada; ?></strong>.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=nombrar-campos-libres&oid=$ordencreada";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>ASIGNANDO CAMPOS LIBRES A LA ORDEN #<?php echo $ordencreada; ?></strong></h5>
                                          </td>
                                      </tr>
                                      <tr>
                                        <td> <b>Agregar Campos Libres:</b></td>
                                        <td><select class="form-control" name="campos" >
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6">6</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="nombrar-campos">Asignar Campos</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                                <?php
                                contenedorbase("fin");
                              } #if oid
                            } #if accion crear-campos-libres

                            if($_GET["accion"] == "nombrar-campos-libres" ){
                              if($_GET["oid"]<>""){
                                $ordencreada = $_GET["oid"];
                                $campos_solicitados = $_POST["campos"];
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Asignacion de campos libres a la orden","edit");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Ingrese los textos de los campos libres de la orden <strong>#<?php echo $_GET["oid"]; ?></strong>.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=finalizar-campos-libres&oid=$ordencreada&campos_solicitados=$campos_solicitados";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>NOMBRANDO CAMPOS LIBRES A LA ORDEN #<?php echo $ordencreada; ?></strong></h5>
                                          </td>
                                      </tr>
                                      <?php
                                      for ($i = 1; $i<=$campos_solicitados; $i++ ){
                                        ?>
                                        <tr>
                                          <td> <b>Campo #<?php echo $i; ?>:</b></td>
                                          <td><input name="campo<?php echo $i;?>" type="text" id="campo<?php echo $i;?>" class="form-control" placeholder="Ingrese el valor del campo <?php echo $i;?>"  required autofocus/></td>
                                        </tr>
                                        <?php
                                      }
                                      ?>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="finalizar-campos">Nombrar Campos</button>
                                          <button class="btn btn-lg btn-default " type="reset" >Limpiar Formulario</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                                <?php
                                contenedorbase("fin");
                              } #if oid
                            } #if nombrar-campos-libres

                            if($_GET["accion"] == "finalizar-campos-libres" ){
                              if($_GET["oid"]<>""){
                                if($_GET["campos_solicitados"]<>""){
                                  #declaramos la variable que almacena todos los campos
                                  $cantidad_campos = $_GET["campos_solicitados"];
                                  $id_seleccionado = $_GET["oid"];
                                  $total_campos = "";

                                  for ($i = 1; $i<=$_GET["campos_solicitados"]; $i++){
                                    #echo $_POST["campo".$i]." nuevo campo<br>";
                                    #la variable total_campos le agregamos los nuevos campos
                                    $total_campos = $total_campos.$_POST["campo".$i]."/";
                                  }
                                  #eliminamos el ultimo slash de los campos agregados
                                  $total_campos = trim($total_campos,"/");

                                  /*creamos un nuevo objeto mysqli*/
                                  $mysqli_aclib = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
                                  /* comprobar la conexión */
                                  if ($mysqli_aclib->connect_errno) {
                                      printf("Falló la conexión: %s\n", $mysqli_aclib->connect_error);
                                      exit();
                                  }

                                  $query_aclib = "
                                  UPDATE tbl_impo_clib SET cantidad = '$cantidad_campos',
                                  descripciones = '$total_campos'
                                  WHERE id =$id_seleccionado AND idorden =$id_seleccionado; ";

                                  if ($mysqli_aclib->query($query_aclib) === TRUE) {
                                    ?>
                                    <div class="col-lg-12">
                                       <div class="panel panel-success">
                                           <div class="panel-heading">
                                               Campos Libres Actualizados
                                           </div>
                                           <div class="panel-body">
                                               <p>Los campos libres de la orden <strong><?php echo $id_seleccionado;?></strong> han sido actualizados exitosamente,
                                                 a continuación sera dirigido a la tabla de ordenes creadas</p>
                                           </div>
                                           <div class="panel-footer">
                                               Dirigiendose a la tabla de ordenes creadas
                                           </div>
                                       </div>
                                   </div>
                                   <META HTTP-EQUIV="REFRESH" CONTENT="7;URL=<?php echo $_SERVER['PHP_SELF']."?accion=direccion-entrega&oid=$id_seleccionado";?>">
                                   <?php
                                  } #if query true campos libres
                                  $mysqli_aclib->close(); #cerramos la coneccion mysql

                                } #campos_solicitados
                              } #if oid
                            } #if finalizar-campos-libres

                            if($_GET["accion"] == "direccion-entrega"){
                              if($_GET["oid"]<>""){
                                $ordencreada = $_GET["oid"];
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Dirección de entrega de la orden","edit");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Dirección de entrega de la Orden  <strong>#<?php echo $ordencreada; ?></strong>.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=agregar-direccion-entrega&oid=$ordencreada";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>ASIGNANDO DIRECCIÓN DE ENTREGA DE LA ORDEN #<?php echo $ordencreada; ?></strong></h5>
                                          </td>
                                      </tr>
                                      <tr>
                                        <td> <b>Facturación y Entrega:</b></td>
                                        <td>
                                          <select class="form-control" name="pais-entrega" >
                                            <option value="guatemala">Entrega en Guatemala (Enviar a dirección fiscal)</option>
                                            <option value="usa">Entrega Fuera del Pais (Llenar Campos Libres) </option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <h5><strong>SI SELECCIONA UNA DIRECCIÓN DE ENTREGA FUERA DE GUATEMALA LLENE LOS SIGUIENTES CAMPOS</strong></h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td> <b>Estado:</b></td>
                                        <td><input name="estado" type="text" id="estado" class="form-control" placeholder="Ingrese el Estado al que envia la orden" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Codigo ZIP:</b></td>
                                        <td><input name="zip" type="text" id="zip" class="form-control" placeholder="Ingrese el codigo ZIP" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Direcció de Entrega:</b></td>
                                        <td><input name="direccion-entrega" type="text" id="direccion-entrega" class="form-control" placeholder="Ingrese la direccion de entrega" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Teléfono:</b></td>
                                        <td><input name="telefono-entrega" type="text" id="telefono-entrega" class="form-control" placeholder="Ingrese numero de Telefono" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td> <b>Fax:</b></td>
                                        <td><input name="fax-entrega" type="text" id="fax-entrega" class="form-control" placeholder="Ingrese numero de Fax" required autofocus /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="nombrar-campos">Asignar Campos</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                                <?php
                                contenedorbase("fin");
                              } # fin oid
                            } #fin direccion-entrega

                            if($_GET["accion"] == "agregar-direccion-entrega" ){
                              if($_GET["oid"]<>""){
                                #declaramos la variable que almacena todos los campos
                                $id_seleccionado = $_GET["oid"];
                                $pais = $_POST["pais-entrega"];
                                $estado = $_POST["estado"];
                                $zip = $_POST["zip"];
                                $direccionentrega = $_POST["direccion-entrega"];
                                $telefonoentrega = $_POST["telefono-entrega"];
                                $faxentrega = $_POST["fax-entrega"];


                                /*creamos un nuevo objeto mysqli*/
                                $mysqli_direntrega = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
                                /* comprobar la conexión */
                                if ($mysqli_direntrega->connect_errno) {
                                    printf("Falló la conexión: %s\n", $mysqli_direntrega->connect_error);
                                    exit();
                                }

                                $query_direntrega = "
                                INSERT INTO tbl_direntrega (id, idorden, pais, estado, zip, direccion, telefono, fax)
                                VALUES (NULL, '$id_seleccionado', '$pais', '$estado', '$zip', '$direccionentrega', '$telefonoentrega', '$faxentrega');";

                                if ($mysqli_direntrega->query($query_direntrega) === TRUE) {
                                  ?>
                                  <div class="col-lg-12">
                                     <div class="panel panel-success">
                                         <div class="panel-heading">
                                             Dirección Agregada
                                         </div>
                                         <div class="panel-body">
                                             <p>La dirección de la orden <strong><?php echo $id_seleccionado;?></strong> ha sido agregado exitosamente,
                                               a continuación sera dirigido a la tabla de ordenes creadas</p>
                                         </div>
                                         <div class="panel-footer">
                                             Dirigiendose a la tabla de ordenes creadas
                                         </div>
                                     </div>
                                 </div>
                                 <META HTTP-EQUIV="REFRESH" CONTENT="5;URL=<?php echo $_SERVER['PHP_SELF']."?accion=consultar-ordenes";?>">
                                 <?php
                                } #if query true campos libres
                                $mysqli_direntrega->close(); #cerramos la coneccion mysql
                              } #if oid
                            } #if finalizar-campos-libres

                            if($_GET["accion"] == "consultar-ordenes" ){
                              /*creamos un nuevo objeto mysqli*/
                              $mysqli_cord = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                              /* query de busqueda de la tabla de usuarios*/
                              $query_selectord="SELECT * FROM vista_importaciones ORDER BY ID DESC;";

                              if($mysqli_cord->connect_errno){
                                echo "Fallo al conectar a Mysql: message ".$mysqli_cord->connect_error;
                              }
                              else{
                                /*si no hay error en el query y la conexión*/
                                $resultado=$mysqli_cord->query($query_selectord);
                                /* inicio de un contenedor */
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Consulta de ordenes creadas","table");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo "Consulta de todas las ordenes creadas"?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                      <th align="center" style="font-size:small;">ID</th>
                                                      <th align="center" style="font-size:small;">NOMENCLATURA</th>
                                                      <th align="center" style="font-size:small;">F. APERTURA</th>
                                                      <th align="center" style="font-size:small;">PROVEEDOR</th>
                                                      <th align="center" style="font-size:small;">FORWARDER</th>
                                                      <th align="center" style="font-size:small;">PERIODOS</th>
                                                      <th align="center" style="font-size:small;">TIPO</th>
                                                      <th align="center" style="font-size:small;">STATUS</th>
                                                      <th align="center" style="font-size:small;">TOTAL</th>
                                                      <th align="center" style="font-size:small;">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                while($fila= $resultado->fetch_assoc()){
                                  /* declaramos un nuevo objeto Tables_sql */
                                  $campo_sql = new Tables_sql();
                                  /* enviamos los datos para conexión con BD */
                                  $campo_sql->dataset_id_sql($sql_user,$sql_pass,$sql_server,$sql_database);
                                  /* funcion para retornar nombre, enviando tabla, nombre del campo y parametro de busqueda */
                                  /* la el resultado de la funcion se almacena en una variable nueva */
                                  $nombre_proveedor = $campo_sql->retornar_nombre("PROV01", "NOMBRE", "CLAVE", $fila["PROVEEDOR"]);

                                  $tsf = new Tables();
                                  $tsf->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                  $suma_filas = $tsf->sumafilas("totalfila","tbl_impo_filas","idorden",$fila["ID"]);

                                  #damos formato a los valores tipo fecha
                                  $o_fapertura = new DateTime($fila["APERTURA"]);
                                  $o_r1 = new DateTime($fila["R1"]);
                                  $o_r2 = new DateTime($fila["R2"]);
                                  $idfila = $fila["ID"];
                                  ?>
                                                  <tr>
                                                    <td align="center"><?php echo $fila["ID"]; #ID?></td>
                                                    <td style="font-size:small;"><?php echo $fila["NOMENCLATURA"]; #NOMENCLATURA ?></td>
                                                    <td style="font-size:small;" align="center"><?php echo $o_fapertura->format("d/m/Y"); #F. APERTURA?></td>
                                                    <td style="font-size:small;"><?php echo $fila["PROVEEDOR"]." - ".$nombre_proveedor; #PROVEEDOR ?></td>
                                                    <td style="font-size:small;"><?php echo $fila["FORWARDER"]; #FORWARDER ?></td>
                                                    <td style="font-size:small;" align="center"><?php echo $o_r1->format("d/m/Y")." - ".$o_r2->format("d/m/Y");  #PERIODOS ?></td>
                                                    <td align="center"><?php echo $fila["TIPO"]; #TIPO ?></td>
                                                    <td align="center"><?php echo $fila["STATUS"]; #STATUS ?></td>
                                                    <td><?php echo "$".round($suma_filas,2); ?></td>
                                                    <td align="center">
                                                      <a href="<?php echo $_SERVER['PHP_SELF']."?accion=editar_orden&oid=$idfila"; ?>" class="btn btn-primary btn-sm btn-round btn-line">Editar</a>
                                                      <a href="<?php echo $_SERVER['PHP_SELF']."?accion=operar_orden&oid=$idfila"; ?>" class="btn btn-success btn-sm btn-round btn-line">Operar</a>
                                                      <a href="reportes/importaciones.php?oid=<?php echo $fila["ID"];?>" target="_blank" class="btn btn-info btn-sm btn-round btn-line">Imprimir</a>
                                                    </td>
                                                  </tr>
                                                  <?php
                                    } #fin else
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                  <?php

                                contenedorbase("fin");
                              } #fin else
                            } #fin consultar-ordenes

                            if($_GET["accion"] == "editar_orden" ){
                              if($_GET["oid"] <>"") {
                                $ordenid=$_GET["oid"];

                                /*creamos un nuevo objeto mysqli*/
                                $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                /* query de busqueda de la tabla de usuarios*/
                                $query="SELECT * FROM vista_importaciones WHERE ID = $ordenid;";

                                if($mysqli->connect_errno){
                                  echo "Fallo al conectar a Mysql: message ".$mysqli->connect_error;
                                }
                                else{
                                  /*si no hay error en el query y la conexión*/
                                  $resultado=$mysqli->query($query);

                                  /* iniciamos un nuevo contenedor */
                                  contenedorbase("inicio");
                                  /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                  contenedor("Editar orden de Importacion","file-o");
                                  /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                  /* declaramos un nuevo objeto Tables */

                                  while($fila= $resultado->fetch_assoc()){
                                    /* declaramos un nuevo objeto Tables_sql */
                                    $campo_sql = new Tables_sql();
                                    /* enviamos los datos para conexión con BD */
                                    $campo_sql->dataset_id_sql($sql_user,$sql_pass,$sql_server,$sql_database);
                                    /* funcion para retornar nombre, enviando tabla, nombre del campo y parametro de busqueda */
                                    /* la el resultado de la funcion se almacena en una variable nueva */
                                    $nombre_proveedor = $campo_sql->retornar_nombre("PROV01", "NOMBRE", "CLAVE", $fila["PROVEEDOR"]);

                                    #damos formato a los valores tipo fecha
                                    $o_fapertura = new DateTime($fila["APERTURA"]);
                                    $o_r1 = new DateTime($fila["R1"]);
                                    $o_r2 = new DateTime($fila["R2"]);
                                    $idfila = $fila["ID"];
                                    ?>
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 >Llene el siguiente formulario para editar la Orden de Importacion <stong><?php echo $_GET["oid"];?></stong> </h4>
                                        </div>
                                        <div class="panel-body">
                                          <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=editando_orden&oid=".$_GET["oid"];?>">
                                          <table class="table table-striped">
                                            <tr><td colspan="2" align="center"> <h5><strong>LLENE EL SIGUIENTE FORMULARIO PARA EDITAR EL REGISTRO #<?php echo$_GET["oid"];?> </strong></h5></td></tr>
                                            <tr>
                                              <td> <b>Nomenclatura de la orden:</b></td>
                                              <td><input name="nomenclatura" type="text" id="nomenclatura" class="form-control" value="<?php echo $fila["NOMENCLATURA"];?>" placeholder="Ingrese la nomenclatura de la orden" required autofocus /></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Usuario que apertura:</b></td>
                                              <td><input name="u_apertura" type="text" id="u_apertura" class="form-control"  value="<?php echo $usuario_usuario;?>" readonly/></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Usuario que modifica:</b></td>
                                              <td><input name="u_modifica" type="text" id="u_apertura" class="form-control"  value="<?php echo $usuario_usuario;?>" readonly/></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Fecha Apertura:</b></td>
                                              <td><input name="f_apertura" type="text" id="f_apertura" class="form-control"  value="<?php echo $o_fapertura->format("d/m/Y");?>" readonly/></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Fecha Modificación:</b></td>
                                              <td><input name="f_modificacion" type="text" id="f_apertura" class="form-control"  value="<?php echo date("d/m/Y");?>" readonly/></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Proveedor:</b></td>
                                              <td>
                                                <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                                <input type="text"  name="prov" id="prov" class="prov tt-query form-control" autocomplete="off" spellcheck="false" value="<?php echo $fila["PROVEEDOR"]." - ".$nombre_proveedor;?>" placeholder="Busqueda de Proveedor por Nombre" readonly />
                                                </span>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td> <b>Forwarder:</b></td>
                                              <td>
                                                <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                                <input type="text"  name="forwarder" id="forwarder" class="forwarder tt-query form-control" autocomplete="off" spellcheck="false" value="<?php echo $fila["FID"]." - ".$fila["FORWARDER"];?>" placeholder="Busqueda de Forwarder por Nombre" required autofocus />
                                                </span>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td> <b>Fecha Inicial (rotacion):</b></td>
                                              <td><input name="fecha-inicial" type="text" id="fecha-inicial" data-date-format="dd/mm/yyyy" data-mask="99/99/9999" id="dp2" class="form-control" value="<?php echo $o_r1->format("d/m/Y");?>" placeholder="Fecha en formato dd/mm/AAAA" required autofocus/></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Fecha Final (rotacion):</b></td>
                                              <td><input name="fecha-final" type="text" id="fecha-final"data-date-format="dd/mm/yyyy" data-mask="99/99/9999" id="dp2" class="form-control" value="<?php echo $o_r2->format("d/m/Y");?>" placeholder="Fecha en formato dd/mm/AAAA" required autofocus/></td>
                                            </tr>
                                            <tr >
                                              <td> <b>Importaciones Anuales:</b></td>
                                              <td><input name="impo-anual" type="text" id="impo-anual" data-mask="99" class="form-control" placeholder="Ingrese las importaciones anuales" required autofocus/></td>
                                            </tr>
                                            <tr >
                                              <td> <b>Crecimiento:</b></td>
                                              <td><input name="crecimiento" type="text" id="crecimiento" data-mask="99 %" class="form-control" placeholder="Ingrese el % de crecimiento de la importación" /></td>
                                            </tr>
                                            <tr >
                                              <td> <b>Terminos de Compra:</b></td>
                                              <td><input name="tc" type="text" id="tc" class="form-control" value="<?php echo $fila["TERMINOS"];?>"placeholder="Ingrese el termino de compra de esta orden" /></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Status:</b></td>
                                              <td><input name="status" type="text" id="status" class="form-control" value="Activa" readonly /></td>
                                            </tr>
                                            <tr>
                                              <td> <b>Observaciones:</b></td>
                                              <td> <textarea name="observaciones" id="observaciones" class="form-control"  placeholder="Agregue observaciones correspondientes" ><?php echo $fila["OBS"];?></textarea></td>
                                            </tr>
                                            <tr>
                                              <td colspan="2" align="center">
                                                <button class="btn btn-lg btn-primary " type="submit" name="editar-orden">Actualizar Orden</button>

                                              </td>

                                            </tr>
                                          </table>
                                        </form>
                                        </div>
                                      </div>
                                    <?php
                                  }
                                  contenedorbase("fin");
                                }
                              } #fin oid
                            } #fin editar_orden

                            if($_GET["accion"] == "editando_orden"){
                              if($_GET["oid"]<>""){
                                /* capturamos los valores enviados para insertarlos en la tabla de importaciones */

                                $idorden = $_GET["oid"];
                                $oimp_nomenclatura = $_POST["nomenclatura"];
                                $oimp_idforwarder = explode("-",$_POST["forwarder"]); //seleccionar arreglo en posicion 0
                                $oimp_f_modificacion = date_create_from_format('d/m/Y', $_POST["f_modificacion"]); // date_format($variable,"Y-m-d");
                                $oimp_rotacion_i = date_create_from_format('d/m/Y', $_POST["fecha-inicial"]); // date_format($variable,"Y-m-d");
                                $oimp_rotacion_f = date_create_from_format('d/m/Y', $_POST["fecha-final"]); // date_format($variable,"Y-m-d");
                                $oimp_impo_anual = intval($_POST["impo-anual"]);
                                $oimp_terminos = $_POST["tc"];
                                $oimp_crecimiento = intval($_POST["crecimiento"]);
                                $oimp_observaciones = $_POST["observaciones"];

                                /*creamos un nuevo objeto mysqli*/
                                $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                /* comprobar la conexión */
                                if ($mysqli->connect_errno) {
                                    printf("Falló la conexión: %s\n", $mysqli->connect_error);
                                    exit();
                                }

                                $query = "
                                UPDATE tbl_importaciones SET nomenclatura = '$oimp_nomenclatura', idforwarder='".$oimp_idforwarder[0]."',
                                f_modificacion ='".date_format($oimp_f_modificacion,"Y-m-d")."',
                                rotacion_i ='".date_format($oimp_rotacion_i, "Y-m-d")."' , rotacion_f ='".date_format($oimp_rotacion_f, "Y-m-d")."',
                                impo_anual='$oimp_impo_anual', crecimiento='$oimp_crecimiento', terminos_compra='$oimp_terminos' ,observaciones='$oimp_observaciones'
                                WHERE idorden=$idorden;";

                                /* Crear una tabla que no devuelve un conjunto de resultados */
                                if ($mysqli->query($query) === TRUE) {

                                  ?>
                                  <div class="col-lg-12">
                                     <div class="panel panel-success">
                                         <div class="panel-heading">
                                             Orden de Importacion Actualizada
                                         </div>
                                         <div class="panel-body">
                                             <p>La orden de importación numero <strong><?php echo "$idorden";?></strong> ha sido actualizada exitosamente. </p>
                                         </div>
                                         <div class="panel-footer">
                                             Dirigiendose a la tabla de ordenes creadas
                                         </div>
                                     </div>
                                 </div>
                                 <META HTTP-EQUIV="REFRESH" CONTENT="7;URL=<?php echo $_SERVER['PHP_SELF']."?accion=consultar-ordenes";?>">
                                 <?php

                                } #if query true
                                $mysqli->close();

                              } #fin oid
                            } #fin editando_orden

                            if($_GET["accion"] == "operar_orden"){
                              if($_GET["oid"]<>""){
                                /* inicio de un contenedor */
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Operación de Orden #".$_GET["oid"]."","wpforms");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                #Objeto para contar las filas de una orden
                                $tfo = new Tables();
                                /* enviamos los datos para conexión con BD */
                                $tfo->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                /* invocamos el metodo para contar el total de filas de una tabla, devuelve numero de filas */
                                $filas_orden = $tfo->retornar_count_condicion("tbl_impo_filas","idorden",$_GET["oid"]);

                                /* objeto que suma el total de filas de una orden*/
                                $tsf = new Tables();
                                $tsf->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                $suma_filas = $tsf->sumafilas("totalfila","tbl_impo_filas","idorden",$_GET["oid"]);

                                /*creamos un nuevo objeto mysqli*/
                                $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                /* query de busqueda de la tabla de  vista_importaciones*/
                                $query="SELECT * FROM vista_importaciones WHERE ID =".$_GET["oid"]."; ";

                                /* query que totaliza una orden */


                                if($mysqli->connect_errno){
                                  echo "Fallo al conectar a Mysql: message ".$mysqli->connect_error;
                                } #fin si no hay conexion
                                else{
                                  /*si no hay error en el query y la conexión*/
                                  $resultado=$mysqli->query($query);
                                  ?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                       <h4 align="center">Valores para Operación de la Orden <strong>#<?php echo $_GET["oid"];?></strong></h4>
                                    </div>
                                    <div class="panel-body">
                                    <?php
                                    while($fila= $resultado->fetch_assoc()){
                                      $o_fapertura = new DateTime($fila["APERTURA"]);
                                      $o_modificacion = new DateTime($fila["MODIFICACION"]);
                                      $o_r1 = new DateTime($fila["R1"]);
                                      $o_r2 = new DateTime($fila["R2"]);
                                      ?>
                                      <table class="table table-striped">
                                        <tr><td> <b>Nomenclatura:</b></td> <td><?php echo $fila["NOMENCLATURA"];?></td></tr>
                                        <tr><td> <b>Ultima modificación de la orden:</b></td> <td><?php echo $o_modificacion->format("d/m/Y");?></td></tr>
                                        <tr><td> <b>Total de la Orden:</b></td> <td><?php echo "$".number_format($suma_filas,2);?></td></tr>
                                        <tr><td> <b>Filas totales de la orden:</b></td> <td><?php echo $filas_orden; ?></td></tr>
                                      </table>
                                      <?php
                                    } # fin while
                                    ?>
                                      <div align="center">
                                          <p style="font-size:16px;"><strong>Seleccione la acción que desea realizar.</strong></p>
                                          <a href="<?php echo $_SERVER['PHP_SELF']."?accion=agregar_fila&oid=".$_GET["oid"]."";?>" class="btn btn-primary" role="button">Agregar Fila</a>
                                          <a href="<?php echo $_SERVER['PHP_SELF']."?accion=listar_orden&oid=".$_GET["oid"]."";?>" class="btn btn-success" role="button">Listar Orden</a>
                                      </div>
                                    </div>
                                  </div>
                                    <?php
                                } #fin else


                                /* cerramos el contenedor */
                                contenedorbase("fin");

                              } #fin oid
                            } #fin operar_orden

                            if($_GET["accion"] == "listar_orden"){
                              if($_GET["oid"]<>""){
                                /* inicio de un contenedor */
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Listar Orden #".$_GET["oid"]."","wpforms");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                #Objeto Tables MySQL
                                $tfo = new Tables();
                                /* enviamos los datos para conexión con BD */
                                $tfo->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                /* llamamos el metodo para contar el total de filas de una tabla, devuelve numero de filas */
                                /* retornamos el total de las filas */
                                $filas_orden = $tfo->retornar_count_condicion("tbl_impo_filas","idorden",$_GET["oid"]);
                                /* sumamos el monto total de las filas */
                                $suma_filas = $tfo->sumafilas("totalfila","tbl_impo_filas","idorden",$_GET["oid"]);

                                /*creamos un nuevo objeto mysqli*/
                                $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);

                                /* query de busqueda de la tabla de  vista_importaciones*/
                                $query="SELECT * FROM vista_importaciones WHERE ID =".$_GET["oid"]."; ";

                                /* verificamos conexion */
                                if($mysqli->connect_errno){
                                  echo "Fallo al conectar a Mysql: message ".$mysqli->connect_error;
                                } #fin si no hay conexion
                                else{
                                  /*si no hay error en el query y la conexión*/
                                  $resultado=$mysqli->query($query);
                                  ?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                       <h4 align="center">Valores Listados para la Orden <strong>#<?php echo $_GET["oid"];?></strong></h4>
                                    </div>
                                    <div class="panel-body">
                                    <?php
                                    while($fila= $resultado->fetch_assoc()){
                                      $o_fapertura = new DateTime($fila["APERTURA"]);
                                      $o_modificacion = new DateTime($fila["MODIFICACION"]);
                                      $o_r1 = new DateTime($fila["R1"]);
                                      $o_r2 = new DateTime($fila["R2"]);
                                      ?>
                                      <table class="table table-hover table-responsive">
                                        <tbody>
                                          <tr>
                                            <td colspan="7" align="center"> <strong><i>RESUMEN DE LA ORDEN ORDEN</i></strong></td>
                                          </tr>
                                          <tr><td colspan="3"> <b><i>Nomenclatura:</i></b></td>
                                              <td colspan="4"><?php echo $fila["NOMENCLATURA"];?></td>
                                          </tr>
                                          <tr>
                                            <td colspan="3"> <b><i>Ultima modificación de la orden:</i></b></td>
                                            <td colspan="4"><?php echo $o_modificacion->format("d/m/Y");?></td>
                                          </tr>
                                          <tr>
                                            <td colspan="3"> <b><i>Total de la Orden:</i></b></td>
                                            <td colspan="4"><?php echo "$".number_format($suma_filas,2);?></td>
                                          </tr>
                                          <tr>
                                            <td colspan="3"> <b><i>Filas totales de la orden:</i></b></td>
                                            <td colspan="4"><?php echo $filas_orden; ?></td>
                                          </tr>
                                          <tr>
                                            <td colspan="7" align="center"> <strong><i>DETALLE DE LA ORDEN </i></strong></td>
                                          </tr>
                                          <tr>
                                            <td align="center"><b>Cant.</b></td>
                                            <td align="center"><b>Cod. Fab.</b></td>
                                            <td align="center"><b>Cod. SAE</b></td>
                                            <td align="center"><b>Desripcion</b></td>
                                            <td align="center"><b>P. U.</b></td>
                                            <td align="center"><b>Subtotal</b></td>
                                            <td align="center"><b>Acción</b></td>
                                          </tr>
                                          <?php
                                          /* query de busqueda de la tabla de detalle filas */
                                          $query_filas = "SELECT * FROM tbl_impo_filas WHERE idorden =".$_GET["oid"]." ;";
                                          /* verificamos conexion */
                                          if($mysqli->connect_errno){
                                            echo "Fallo al conectar a Mysql: message ".$mysqli->connect_error;
                                          } #fin si no hay conexion
                                          else{
                                            /*si no hay error en el query y la conexión se ejecutan*/
                                            $resfilas=$mysqli->query($query_filas);
                                            while($row = $resfilas->fetch_assoc()){
                                              $valsae = new Tables_sql();
                                              $valsae->dataset_id_sql($sql_user,$sql_pass,$sql_server,$sql_database);
                                              $codigosae = $valsae->retornar_nombre_str("INVE_CLIB01", "CVE_PROD", "CAMPLIB2", $row["idproducto"]);
                                              $descripcion_sae = $valsae->retornar_nombre_str("INVE01", "DESCR", "CVE_ART", $codigosae);
                                              ?>
                                              <tr>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo $row["cantidad"]; ?>
                                                </td>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo  $row["idproducto"];?>
                                                </td>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo  $codigosae;?>
                                                </td>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo  $descripcion_sae; ?>
                                                </td>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo  "$".number_format($row["preciolista"],2); ?>
                                                </td>
                                                <td align="center" style="font-size:x-small">
                                                  <?php echo  "$".number_format($row["totalfila"],2); ?>
                                                </td>
                                                <td align="center">
                                                  <a href="<?php echo $_SERVER['PHP_SELF']."?accion=editar_fila&oid=".$row["id"]."";?>" alt="Editar"class="btn btn-primary btn-circle btn-line"><i class="fa fa-edit"></i></a>
                                                  <a href="<?php echo $_SERVER['PHP_SELF']."?accion=eliminar_fila&oid=".$row["id"]."";?>" alt="Eliminar"class="btn btn-danger btn-circle btn-line"><i class="fa fa-close"></i></a>
                                                </td>
                                              <?php
                                            } #fin while
                                          } #fin else

                                          ?>
                                        </tbody>
                                      </table>
                                      <?php
                                    } # fin while
                                    ?>
                                    </div>
                                  </div>
                                    <?php
                                } #fin else


                                /* cerramos el contenedor */
                                contenedorbase("fin");

                              } #fin oid
                            } #fin operar_orden

                            if($_GET["accion"] == "agregar_fila"){
                              if($_GET["oid"]<>""){
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Criterio de Busqueda de Artículos","wpforms");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Seleccione el criterio de busqueda de articulos para procesar la orden.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=procesar_fila&oid=".$_GET["oid"]."";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>SELECIONE EL CRITERIO DE BUSQUEDA </strong></h5></td><tr>
                                      <tr>
                                        <td> <b>Criterio de Busqueda:</b></td>
                                        <td><select class="form-control" name="busqueda-producto">
                                              <option value="codigo-sae">Por Codigo SAE</option>
                                              <option value="codigo-fabricante">Por Codigo de Fabricante</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="orden-creada">Continuar</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                                <?php
                                contenedorbase("fin");
                              } # fin oid
                            } #fin agregar_fila

                            if($_GET["accion"] == "procesar_fila"){
                              if($_GET["oid"]<>""){
                                $busqueda_producto = $_POST["busqueda-producto"]; #almacenamos el post en una variable
                                echo $_POST["busqueda-producto"];
                                $mensaje_busqueda ="";

                                if($busqueda_producto =="codigo-sae"){
                                  $mensaje_busqueda ="CODIGO SAE";
                                }
                                else{
                                  $mensaje_busqueda ="CODIGO FABRICANTE";
                                }
                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Procesar fila de la orden  #".$_GET["oid"]." por $mensaje_busqueda ","wpforms");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                     <h4 >Seleccione producto por criterio <?php echo $mensaje_busqueda;?>.</h4>
                                  </div>
                                  <div class="panel-body">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=procesar_fila_orden&oid=".$_GET["oid"]."";?>">
                                    <table class="table table-striped">
                                      <tr><td colspan="2" align="center"> <h5><strong>SELECIONE PRODUCTO POR CRITERIO <?php echo $mensaje_busqueda;?> </strong></h5></td><tr>
                                      <?php
                                      if($busqueda_producto =="codigo-sae"){
                                        ?>
                                        <tr>
                                          <td> <b>Producto por codigo SAE:</b></td>
                                          <td>
                                            <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                            <input type="text"  name="sae" id="sae" class="sae tt-query form-control" autocomplete="off" spellcheck="false" placeholder="Busqueda de Producto por codigo SAE" required autofocus />
                                            </span>
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                      else{
                                        ?>
                                        <tr>
                                          <td> <b>Producto por codigo FABRICANTE:</b></td>
                                          <td>
                                            <span class="input-group-addon margin-bottom-m"><i class="fa fa-search fa-2x fa-fw" aria-hidden="true"></i>
                                            <input type="text"  name="fabricante" id="fabricante" class="fabricante tt-query form-control" autocomplete="off" spellcheck="false" placeholder="Busqueda de Producto por codigo FABRICANTE" required autofocus />
                                            </span>
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                      ?>
                                      <tr>
                                        <td colspan="2" align="center">
                                          <button class="btn btn-lg btn-primary " type="submit" name="orden-creada">Procesar</button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                  </div>
                                </div>
                                <?php
                                contenedorbase("fin");



                              } #fin oid
                            } #fin procesar_fila

                            if($_GET["accion"] == "procesar_fila_orden"){
                              if($_GET["oid"]<>""){
                                #definimos las variables a trabajar
                                $and_query="";
                                $codigo_producto = "";
                                $idproducto = "";

                                #si el post sae existe
                                if(isset($_POST["sae"])){
                                  $codigo_producto = explode("-",$_POST["sae"]);
                                  $and_query = "AND I.CVE_ART = '$codigo_producto[0]'";
                                }
                                else{
                                  $codigo_producto = explode("-",$_POST["fabricante"]);
                                  $and_query = "AND ICL.CAMPLIB2 = '$codigo_producto[0]'";
                                }

                                contenedorbase("inicio");
                                /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                contenedor("Procesar fila para orden de importación   #".$_GET["oid"]." ","wpforms");
                                /* Agregamos el contenido que puede ser codigo HTML o PHP */

                                #declaramos un objeto mysql
                                $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
                                $query_select="SELECT * FROM vista_importaciones WHERE ID = ".$_GET["oid"].";";

                                if($mysqli->connect_errno){
                                  echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
                                }
                                else{
                                  /*si no hay error en el query y la conexión*/
                                  $resultado = $mysqli->query($query_select);
                                   while($columna = $resultado->fetch_assoc()){
                                     $o_r1 = new DateTime($columna["R1"]);
                                     $o_r2 = new DateTime($columna["R2"]);
                                     $intervalo = $o_r1->diff($o_r2);
                                     #echo $intervalo->format('%R%a días');

                                     #declaramos un nuevo connection string
                                     $connection_string = "DRIVER={SQL Server};SERVER=$sql_server;DATABASE=$sql_database";
                                     $conne = odbc_connect($connection_string,$sql_user,$sql_pass);

                                     if($conne){
                                       $query="
                                       SELECT MI.CVE_ART AS SAE, ICL.CAMPLIB2 AS FABRICANTE, I.DESCR AS DESCRIPCION,  CAST(SUM(CASE WHEN MI.CVE_CPTO IN (51,2,4,56)
                                       THEN  -1 * MI.CANT * MI.SIGNO ELSE 0 END) AS FLOAT) AS UNIDVENTA, I.EXIST AS EXISTENCIAS,
                                       PR.CLAVE, PR.NOMBRE FROM MINVE01 AS MI
                                       LEFT JOIN INVE01 AS I ON I.CVE_ART = MI.CVE_ART
                                       LEFT JOIN VEND01 AS V ON V.CVE_VEND = MI.VEND
                                       INNER JOIN PRVPROD01 AS PPD ON I.CVE_ART = PPD.CVE_ART
                                       INNER JOIN PROV01 AS PR ON PR.CLAVE = PPD.CVE_PROV
                                       INNER JOIN INVE_CLIB01 AS ICL ON I.CVE_ART = ICL.CVE_PROD
                                       WHERE (MI.FECHA_DOCU>='".$o_r1->format("d.m.Y")."' AND MI.FECHA_DOCU<='".$o_r2->format("d.m.Y")."'
                                       AND MI.CVE_CPTO IN (2,4,51,53)
                                       $and_query
                                       )
                                       GROUP BY MI.CVE_ART, I.DESCR, I.EXIST, PR.CLAVE, PR.NOMBRE, ICL.CAMPLIB2
                                       ORDER BY MI.CVE_ART ASC
                                       "; #finaliza el query

                                       #echo $query;

                                       $consulta = odbc_exec($conne, $query);

                                       if(!$consulta){
                                         exit("Error en consulta SQL");
                                       } # fin IF si hay error en la consulta
                                       ?>
                                       <div class="panel panel-default">
                                         <div class="panel-heading">
                                            <h4 align="center">Analisis del producto por proveedor <strong>#<?php echo $columna["PROVEEDOR"]; ?></strong> </h4>
                                         </div>
                                         <div class="panel-body">
                                           <table class="table table-striped">
                                             <?php
                                             #creamos variables para calcular las unidades a pedir
                                             $unidades_v = "";
                                             $existecias_a ="";
                                             while ($row=odbc_fetch_row($consulta)){
                                               $unidades_v = odbc_result($consulta, "UNIDVENTA");
                                               $existecias_a = odbc_result($consulta, "EXISTENCIAS");
                                               $idproducto = odbc_result($consulta, "FABRICANTE");
                                               ?>
                                               <tr><td> <b>Codigo SAE:</b></td> <td><?php echo utf8_encode(odbc_result($consulta, "SAE")); ?></td></tr>
                                               <tr><td> <b>Codigo Fabricante:</b></td> <td><?php echo utf8_encode(odbc_result($consulta, "FABRICANTE")); ?></td></tr>
                                               <tr><td> <b>Descripción del Producto:</b></td> <td><?php echo utf8_encode(odbc_result($consulta, "DESCRIPCION")); ?></td></tr>
                                               <tr><td> <b>Unidades Vendidas:</b></td> <td><?php echo utf8_encode(round(odbc_result($consulta, "UNIDVENTA"),0))." (rotacion del ".$o_r1->format("d/m/Y")." al ".$o_r2->format("d/m/Y")." ".$intervalo->format('%R%a días analizados').")"; ?></td></tr>
                                               <tr><td> <b>Existencias:</b></td> <td><?php echo utf8_encode(round(odbc_result($consulta, "EXISTENCIAS"),0)); ?></td></tr>
                                               <tr><td> <b>Proveedor:</b></td> <td><?php echo utf8_encode(odbc_result($consulta, "CLAVE")." - ".odbc_result($consulta, "NOMBRE")); ?></td></tr>
                                               <?php
                                             } #Fin while de recorrido de la consulta
                                             odbc_close($conne); #Cerrando la conexion odbc
                                             ?>
                                           </table>
                                         </div>
                                       </div>

                                       <br>
                                       <?php
                                       #declaramos un objeto para buscar los campos libres
                                       $campos_libres = new Tables();
                                       /* enviamos los datos para conexión con BD */
                                       $campos_libres->dataset_id($caia_user,$caia_pass,$caia_server,$caia_database);
                                       $cantidad_clib = $campos_libres->retornar_valor_condicion("tbl_impo_clib","cantidad","idorden",$_GET["oid"]);
                                       $descripciones_clib = $campos_libres->retornar_contenido_condicion("tbl_impo_clib","descripciones","idorden",$_GET["oid"]);
                                       $array_clib = array();
                                       $array_clib = explode("/",$descripciones_clib);
                                       ?>

                                       <div class="panel panel-default">
                                         <div class="panel-heading">
                                            <h4 align="center">Analisis del producto por proveedor <strong>#<?php echo $columna["PROVEEDOR"]; ?></strong> </h4>
                                         </div>
                                         <div class="panel-body">
                                           <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?accion=agregar_fila_orden&oid=".$_GET["oid"]."&clib=".$cantidad_clib."";?>">
                                           <table class="table table-striped">
                                             <tr><td colspan="2" align="center"> <h5><strong>LLENE EL SIGUIENTE FORMULARIO AGREGAR UN REGISTRO A LA ORDEN #<?php echo $_GET["oid"];?></strong></h5></td><tr>
                                               <tr>
                                                 <td> <b>Numero de Parte:</b></td>
                                                 <td><input name="numero-parte" type="text" id="numero-parte" class="form-control" value="<?php echo $idproducto;?>" readonly /></td>
                                               </tr>
                                               <tr>
                                                 <td> <b>Precio de Lista $USD:</b></td>
                                                 <td><input name="preciol" type="text" id="preciol" class="form-control" placeholder="Ingrese el precio de lista en $USD" required autofocus /></td>
                                               </tr>
                                               <tr>
                                                 <td> <b>Unidades a Solicitadas:</b></td>
                                                 <?php
                                                 #la matematica de las unidades a solicitar
                                                 #echo $columna["CRECIMIENTO"]
                                                 $u_sol_crudo = $unidades_v - $existecias_a;

                                                 if ($u_sol_crudo > 0){
                                                   $u_sol_crudo = $u_sol_crudo / $columna["IMPO"]; #dividimos en importaciones
                                                   $u_sol_crudo = $u_sol_crudo * (1+($columna["CRECIMIENTO"]/100)); #aplicamos crecimiento
                                                 }

                                                  ?>
                                                 <td><input name="unidades" type="text" id="unidades" class="form-control" placeholder=" Sugeridas <?php echo round($u_sol_crudo,0); ?>" required autofocus /></td>
                                               </tr>
                                               <?php

                                               //la cantidad fue definida al inicio del formulario
                                               for ($i=0; $i<$cantidad_clib; $i++){
                                                 ?>
                                                 <tr>
                                                   <td> <b> <?php echo $array_clib[$i]; ?> :</b></td>
                                                   <td><input name="precio<?php echo $i+1;?>" type="text" id="precio<?php echo $i+1;?>" class="form-control" placeholder="Ingrese descuentos de <?php echo $array_clib[$i];?>" required autofocus /></td>
                                                 </tr>
                                                 <?php
                                               }
                                               ?>
                                               <tr>
                                                 <td> <b>Observaciones:</b></td>
                                                 <td> <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Agregue observaciones a la linea procesada" ></textarea></td>
                                               </tr>
                                               <tr>
                                                 <td colspan="2" align="center">
                                                   <button class="btn btn-lg btn-primary " type="submit" name="orden-creada">Agregar Registro</button>
                                                   <button class="btn btn-lg btn-default " type="reset" >Limpiar Formulario</button>
                                                 </td>
                                               </tr>
                                             </table>
                                           </form>
                                         </div>
                                       </div>
                                       <?php
                                     } #fin conne
                                   } #fin while 1
                                   $mysqli->close();
                                } #fin else
                                contenedorbase("fin");
                              } #fin oid
                            } #fin procesar_fila_orden

                            if($_GET["accion"] == "agregar_fila_orden"){
                              if($_GET["oid"]<>""){
                                if($_GET["clib"]<>""){
                                  //contenedorbase("inicio");
                                  /* enviamos el titulo del contenedor y un icono de FontAwesome Icons */
                                  //contenedor("Agregando fila a la orden #".$_GET["oid"]." ","wpforms");
                                  /* Agregamos el contenido que puede ser codigo HTML o PHP */
                                  ?>
                                  <!-- div class="col-lg-12">
                                     <div class="panel panel-success">
                                         <div class="panel-heading">
                                             Fila procesada
                                         </div>
                                         <div class="panel-body">
                                             <p>Se ha agregado un registro a la orden <strong><?php echo $_GET["oid"];?></strong> exitosamente,
                                               a continuación sera dirigido a la tabla de ordenes creadas</p>
                                         </div>
                                         <div class="panel-footer">
                                             Dirigiendose a la tabla de ordenes creadas
                                         </div>
                                     </div>
                                 </div -->

                                  <?php

                                  //contenedorbase("fin");

                                  #declaramos la variable que almacena todos los campos
                                  $idproducto = $_POST["numero-parte"];
                                  $preciolista = $_POST["preciol"];
                                  $cantidad = $_POST["unidades"];
                                  $fecha_tbl = date("Y-m-d");
                                  $obs_fila = $_POST["observaciones"];
                                  $valores = "";
                                  $operaciones = 1;

                                  for ($i = 1; $i<=$_GET["clib"]; $i++){
                                    #echo $_POST["campo".$i]." nuevo campo<br>";
                                    #la variable total_campos le agregamos los nuevos campos
                                    $valores = $valores.$_POST["precio".$i]."/";
                                    $operaciones = $operaciones*$_POST["precio".$i];
                                  }
                                  #eliminamos el ultimo slash de los campos agregados
                                  $valores = trim($valores,"/");
                                  $totalfila = $preciolista*$cantidad*$operaciones;

                                  /*creamos un nuevo objeto mysqli*/
                                  $mysqli_ifilas = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
                                  /* comprobar la conexión */
                                  if ($mysqli_ifilas->connect_errno) {
                                      printf("Falló la conexión: %s\n", $mysqli_ifilas->connect_error);
                                      exit();
                                  }

                                  $query_ifilas = "
                                  INSERT INTO tbl_impo_filas (id, idorden, idproducto, preciolista, cantidad, valores, totalfila, fecha, observaciones)
                                  VALUES (NULL, '".$_GET["oid"]."', '$idproducto', '$preciolista', '$cantidad', '$valores', '$totalfila', '$fecha_tbl', '$obs_fila'); ";

                                  if ($mysqli_ifilas->query($query_ifilas) === TRUE) {
                                    ?>
                                    <div class="col-lg-12">
                                       <div class="panel panel-success">
                                           <div class="panel-heading">
                                               Fila agregada a la tabla
                                           </div>
                                           <div class="panel-body">
                                               <p>Una fila ha sido agregada a la orden <strong>#<?php echo $_GET["oid"];?></strong> exitosamente,
                                                 a continuación sera dirigido a la tabla de ordenes creadas</p>
                                           </div>
                                           <div class="panel-footer">
                                               Dirigiendose a la tabla de ordenes creadas
                                           </div>
                                       </div>
                                   </div>
                                   <META HTTP-EQUIV="REFRESH" CONTENT="7;URL=<?php echo $_SERVER['PHP_SELF']."?accion=consultar-ordenes";?>">
                                   <?php
                                  } #if query true campos libres
                                  $mysqli_ifilas->close(); #cerramos la coneccion mysql
                                } #fin clib
                              } # fin oid
                            } # fin accion agregar_fila_orden

                            if($_GET["accion"] == "imprimir_orden"){
                              if($_GET["oid"]<>""){
                                $idorden = $_GET["oid"];
                                echo $idorden;
                                ?>
                                <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=reportes/importaciones.php?oid=<?php echo $idorden;?>">
                                <?php
                              } //fin oid
                            } //fin accion

                          }
                          /*Fin accion general*/

                      }
                      else{
                        /* alerta dentro del archivo de alertas*/
                        alerta_erroracceso();
                      }
                      /*Si el usuario es administrador*/

                      ?>

                    </div> <!-- FIN CONTAINER  -->

                    </div>
                    <!-- COL -->
                </div>
                 <!-- FIN CONTENIDO DE LA PAGINA ROW -->
            </div>
            <!--END INNER -->

        </div>
        <!--END PAGE CONTENT -->

        <?php
        /* barra de notificaciones derecha, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
        $template_right=$directorio."assets/template/site/right.php";
        include($template_right);

        /* se declara el inicio del de las notificaciones de la derecha */
        barra_lateral("inicio");
        modulo_ejemplo(" Avisos ");
        modulo_ejemplo(" Modulos ");
        modulo_ejemplo(" Revisiones ");
        modulo_ejemplo(" Alertas ");
        modulo_ejemplo(" Tareas ");
        barra_lateral("fin");
        /* se declara el fin del de las notificaciones de la derecha */
        ?>
    </div>
    <!--END MAIN WRAPPER -->

    <?php
    /* pie de pagina, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
    footerid();

    /* scripts js globales, con sus respectivos direccionamientos segun ubicación fisica de la ruta */
    $sg1=$directorio."assets/plugins/jquery-2.0.3.min.js";                     // url  assets/plugins/jquery-2.0.3.min.js
    #$sg1=$directorio."assets/js/jquery-1.10.2.js";                     // url  assets/plugins/jquery-2.0.3.min.js

    /* SCRIPTS BASICOS*/
    $js_boostrap=$directorio."assets/plugins/bootstrap/js/bootstrap.min.js";           // url  assets/plugins/bootstrap/js/bootstrap.min.js
    agregar_script($js_boostrap);

    /*MODRNIZR JS*/
    $js_modernizer=$directorio."assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js";    // url  assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js
    agregar_script($js_modernizer);

    /* DEVOPS JS */
    $devoops_js=$directorio."assets/js/devoops.js";
    agregar_script($devoops_js);
    /* SCRIPTS BASICOS*/

    /* TABLAS DINAMICAS*/
    $js_datatable = $directorio."assets/plugins/dataTables/jquery.dataTables.js";
    agregar_script($js_datatable);
    $js_btdatatable = $directorio."assets/plugins/dataTables/dataTables.bootstrap.js";
    agregar_script($js_btdatatable);
    /* FIN TABLAS DINAMICAS*/

    /* FORMATOS DE ENTRADA */
    $js_inputmask = $directorio."assets/plugins/jasny/js/bootstrap-inputmask.js";
    agregar_script($js_inputmask);
    $js_formsinit = $directorio."assets/js/formsInit.js";
    agregar_script($js_formsinit);
    /* fin FORMATOS DE ENTRADA */

    /* script para carga de las tablas dinamicas*/
    ?>
    <!-- SCRIPT PARA LA TABLA DINAMICA -->
    <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>

    <script>
        $(function () { formInit(); });
    </script>

</body>
    <!-- FIN BODY -->
</html>
<?php
}
?>
