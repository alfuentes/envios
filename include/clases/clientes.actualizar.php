<?php
$id = $_POST['idP'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
//$departamento = $_POST['departamento'];
$departamento = explode("-", $_POST['departamento']);
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccionContacto = $_POST['direccionContacto'];
$contacto = $_POST['contacto'];
$telefonoContacto = $_POST['telefonoContacto'];


require('Conexion.php');
$con = Conectar();

$sql = 'UPDATE clientes SET nombre=:nombre, direccion=:direccion, departamento=:departamento,
               telefono=:telefono, email=:email, direccion_recepcion=:direccionContacto, contacto=:contacto,
               telefono_contacto=:telefonoContacto  WHERE id=:id';

$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':direccion'=>$direccion, ':departamento'=>$departamento[0], ':telefono'=>$telefono, ':email'=>$email,
                  ':direccionContacto'=>$direccionContacto, ':contacto'=>$contacto, ':telefonoContacto'=>$telefonoContacto, ':id'=>$id, ));
?>
