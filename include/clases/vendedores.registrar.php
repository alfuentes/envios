<?php

$nombre = $_POST['nombreV'];
$telefono = $_POST['telefonoV'];
$email = $_POST['emailV'] ;

require('Conexion.php');

$con = Conectar();
$sql = 'INSERT INTO vendedores (id, nombre, telefono, email) 
        VALUES (null, :nombre, :telefono, :email)';
$q = $con->prepare($sql);
$q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email,));
?>
