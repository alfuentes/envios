<?php
    ### LA TABLA tbl_forwarders ESTA EN MYSQL
    include("../functions/odbc.php");
    $key=$_GET['key'];
    $array = array();
    /*creamos un nuevo objeto mysqli*/
    $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
    $query_select="SELECT id, nombre FROM tbl_forwarders WHERE nombre LIKE '%{$key}%';";
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
        }
        else{
            /*si no hay error en el query y la conexión*/
            $resultado = $mysqli->query($query_select);
             while($columna = $resultado->fetch_assoc()){
                #$fecha_uid = explode("-", $fila['fecha']);
                $fila = utf8_encode($columna['id']." - ".$columna['nombre']);
                $array[] = $fila;
                }
                $mysqli->close();
            }
            echo json_encode($array);    

?>
