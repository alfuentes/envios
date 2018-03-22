<?php

$id = $_POST['idP'];
$nombre = $_POST['nombreT'];
$direccion = $_POST['direccionT'];
$telefono = $_POST['telefonoT'];
$contacto = $_POST['contactoT'];
$observaciones = $_POST['observacionesT'];

require('Conexion.php');

$con = Conectar();
$sql = 'UPDATE transportes SET nombre=:nombre,  direccion=:direccion, telefono=:telefono, 
               contacto=:contacto,  observaciones=:observaciones WHERE id=:idTransporte';

$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':direccion'=>$direccion, ':telefono'=>$telefono, 
                  ':contacto'=>$contacto, ':observaciones'=>$observaciones, ':idTransporte'=>$id));
?>
