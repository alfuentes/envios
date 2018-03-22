<?php
require_once("clases/Conexion.php");
// obtenemos valores del metodo POST
$usuario = $_POST['usuario'];
$clave = $_POST['pass'];
// Invocamos la cadena de conexión
$con = Conectar();
sleep(1);
session_start();
// Preparamos la consulta
$sql = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' AND clave = '".$clave."' AND status ='Activo' ";
$stmt = $con->prepare($sql);
// Si existe algun resultado
$respuesta = array('error'=>true);

if ($result = $stmt->execute()) {
  // obtenemos todos los resultados y enviamos una respuesta JSON
  $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);

  foreach($rows as $row){
    $respuesta = array('error'=>false, 'id'=>$row->id,'usuario'=>$row->usuario,'nombre'=>$row->nombre, 'email'=>$row->email, 'status'=>$row->status,'tipo'=>$row->tipo);
    //echo json_encode(array('error'=>false, 'tipo'=>$row->tipo,'nombre'=>$row->nombre));
  }
} else {
  //echo json_encode(array('error'=>true));
  $respuesta = array('error'=>true);
}
$_SESSION['usuario'] = $respuesta;
echo json_encode($respuesta);
$stmt = null;
 ?>
