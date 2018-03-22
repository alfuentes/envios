<?php
date_default_timezone_set('America/Guatemala');
/*
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
*/
$idEnvio = $_POST['numeroEnvio'];
$piloto = explode("-",$_POST['piloto']);
$status = $_POST['status'];
$registra = $_POST['registra'];
$correo = $_POST['correo'];
$firma = $_POST['firma'];

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

$sql = 'UPDATE envios SET recibido = :recibido, ingresa = :ingresa, firma = :firma, idpiloto = :idpiloto,
correo = :correo, status = :status WHERE id = :idenvio ';

$q = $con->prepare($sql);

$q->execute(array(':recibido'=>$fecha, ':ingresa'=>$registra, ':firma'=>$firma, ':correo'=>$correo,
                  ':idpiloto'=>$piloto[0], ':status'=>$status, ':idenvio'=>$idEnvio, ));


//$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email,));

?>
