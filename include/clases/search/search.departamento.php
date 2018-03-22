<?php
	require_once("../Conexion.php");

	$keyword = strval($_POST['query']);
	$search_param = "%{$keyword}%";

  //Acceso a la BD
  $db = new AccesoDB();
	$conn = new mysqli($db->getHost(), $db->getUser(), $db->getPass() , $db->getDatabase());

	$sql = $conn->prepare("SELECT * FROM departamentos WHERE nombre LIKE ?");
	$sql->bind_param("s",$search_param);
	$sql->execute();
	$result = $sql->get_result();
  $respuesta = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$departamento[] = $row["id"]." - ".$row["nombre"]." ";
    $respuesta = $departamento;
		}
		echo json_encode($respuesta);
	}

$conn->close();
?>
