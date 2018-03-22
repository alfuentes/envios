<?php
$nombre = $_POST['nombreV'];
$telefono = $_POST['telefonoV'];
$email = $_POST['emailV'];
$idP = $_POST['idP'];

require('Conexion.php');

$con = Conectar();
$sql = 'UPDATE vendedores SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:idPersona';
$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email, ':idPersona'=>$idP));
?>
