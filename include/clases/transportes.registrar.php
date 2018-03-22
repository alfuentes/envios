<?php

$nombre = $_POST['nombreT'];
$direccion = $_POST['direccionT'];
$telefono = $_POST['telefonoT'];
$contacto = $_POST['contactoT'] ;
$observaciones = $_POST['observacionesT'] ; 

require('Conexion.php');

$con = Conectar();
$sql = 'INSERT INTO transportes (id, nombre, direccion, telefono, contacto, observaciones) 
        VALUES (null, :nombre, :direccion, :telefono, :contacto, :observaciones)';
$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':direccion'=>$direccion, ':telefono'=>$telefono, 
                  ':contacto'=>$contacto, ':observaciones'=>$observaciones, ));
?>
