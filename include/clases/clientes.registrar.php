<?php

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
//$departamento = $_POST['departamento'];
$departamento = explode("-", $_POST['departamento']);
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccionContacto = $_POST['direccionContacto'];
$contacto = $_POST['contacto'] ;
$telefonoContacto = $_POST['telefonoContacto'] ;

require('Conexion.php');

$con = Conectar();

$sql = 'INSERT INTO clientes (id, codigo, nombre, direccion, departamento, telefono, email, direccion_recepcion, contacto, telefono_contacto)
        VALUES (null, :codigo, :nombre, :direccion, :departamento, :telefono, :email, :direccion_recepcion, :contacto, :telefono_contacto)';

$q = $con->prepare($sql);

$q->execute(array(':codigo'=>$codigo, ':nombre'=>$nombre, ':direccion'=>$direccion, ':departamento'=>$departamento[0],':telefono'=>$telefono, ':email'=>$email,
                  ':direccion_recepcion'=>$direccionContacto, ':contacto'=>$contacto, ':telefono_contacto'=>$telefonoContacto, ));
?>
