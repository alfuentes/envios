<?php
$nombre = $_POST['nombreP'];
$telefono = $_POST['telefonoP'];
$email = $_POST['emailP'];
$idP = $_POST['idP'];

require('Conexion.php');

$con = Conectar();
$sql = 'UPDATE pilotos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:idPersona';
$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email, ':idPersona'=>$idP));
?>
