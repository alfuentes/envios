<?php

$nombre = $_POST['nombreP'];
$telefono = $_POST['telefonoP'];
$email = $_POST['emailP'] ;

require('Conexion.php');

$con = Conectar();
$sql = 'INSERT INTO pilotos (id, nombre, telefono, email) 
        VALUES (null, :nombre, :telefono, :email)';
$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email,));
?>
