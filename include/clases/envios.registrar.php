<?php
date_default_timezone_set('America/Guatemala');

$tipo = $_POST['tipoEnvio'];
$codigoCliente = explode("-",$_POST['codigoCliente']);
$seleccionNombre = $_POST['seleccionNombre'];
$nombreEnvio = $_POST['nombreEnvio'];
$codigoTransporte = explode("-",$_POST['codigoTransporte']);
$seleccionDireccion = $_POST['seleccionDireccion'];
$direccionEnvio = $_POST['direccionEnvio'] ;
$codigoPiloto = explode("-",$_POST['codigoPiloto']);
$codigoVendedor = explode("-",$_POST['codigoVendedor']);
$seEnvia = $_POST['seEnvia'];
$factura = $_POST['factura'];
$instrucciones = $_POST['instrucciones'];
$emite = $_POST['emite'];
$status = 'Pendiente';

//$Nombre ="";
//$Direccion="";

$fecha = date("Y-m-d H:i:s");
$fechaEntrega = date("Y-m-d");

//if ($seleccionNombre =="Nuevo Nombre"){
//        $Nombre = $nombreEnvio;
//}

//if ($seleccionDireccion =="Nueva dirección"){
//        $Direccion = $direccionEnvio;
//}


require('Conexion.php');

$con = Conectar();

$sql = 'INSERT INTO envios (id, idcliente, tipo_nombre, nombre_cliente, tipo_envio, idtransporte, tipo_direccion, direccion, fecha, fecha_entrega, idpiloto, idvendedor, factura, envia, instrucciones, emite, status)
        VALUES (null, :idcliente, :tipo_nombre, :nombre_cliente, :tipo_envio, :idtransporte, :tipo_direccion, :direccion, :fecha, :fecha_entrega, :idpiloto, :idvendedor, :factura, :envia, :instrucciones, :emite, :status)';

$q = $con->prepare($sql);

$q->execute(array(':idcliente'=>$codigoCliente[0], ':tipo_nombre'=>$seleccionNombre, ':nombre_cliente'=>$nombreEnvio, ':tipo_envio'=>$tipo,
                  ':idtransporte'=>$codigoTransporte[0], ':tipo_direccion'=>$seleccionDireccion, ':direccion'=>$direccionEnvio, ':fecha'=>$fecha,
                  ':fecha_entrega'=>$fechaEntrega, ':idpiloto'=>$codigoPiloto[0], ':idvendedor'=>$codigoVendedor[0], ':factura'=>$factura,
                  ':envia'=>$seEnvia,':instrucciones'=>$instrucciones, ':emite'=>$emite, ':status'=>$status, ));

//$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email,));

?>
