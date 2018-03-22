<?php
	require_once("../Conexion.php");
	$keyword = strval($_POST['query']);
	$search_param = "%{$keyword}%";

	//Acceso a la BD
  $db = new AccesoDB();
	$conn =new mysqli($db->getHost(), $db->getUser(), $db->getPass() , $db->getDatabase());

	$sql = $conn->prepare("SELECT * FROM vendedores WHERE nombre LIKE ?");
	$sql->bind_param("s",$search_param);
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$vendedor[] = $row["id"]." - ".$row["nombre"];
		}
		echo json_encode($vendedor);
	}
	$conn->close();
?>
