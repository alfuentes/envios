<?php
    ### LA TABLA clientes ESTA EN MYSQL    
    $key=$_GET['key'];
    //$array = array();
    
    /*Pedimos la conexion*/
    require("Conexion.php");

    /*
    $con = Conectar();
    $sql = 'INSERT INTO vendedores (id, nombre, telefono, email) 
            VALUES (null, :nombre, :telefono, :email)';
    $q = $con->prepare($sql);
    $q->execute(array(':nombre'=>$nombre, ':telefono'=>$telefono, ':email'=>$email,));
    */
    ?>
    <script> alert("Mensaje"); </script>

    <?php    

    $sql = "SELECT id, nombre, FROM clientes WHERE nombre like '%{$key}%' ";
    $stmt = $con->prepare($sql);
    $result = $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
    foreach($rows as $row){
        $fila = utf8_encode($row->id." - ".$row->nombre);
        $arreglo[] = $fila;
    }

    echo json_encode($arreglo);

    


    /*
    $mysqli = new mysqli($caia_server, $caia_user, $caia_pass, $caia_database);
    $query_select="SELECT id, nombre FROM tbl_forwarders WHERE nombre LIKE '%{$key}%';";
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
        }
        else{
      
            $resultado = $mysqli->query($query_select);
             while($columna = $resultado->fetch_assoc()){
                #$fecha_uid = explode("-", $fila['fecha']);
                $fila = utf8_encode($columna['id']." - ".$columna['nombre']);
                $array[] = $fila;
                }
                $mysqli->close();
            }
            echo json_encode($array);    
            */

?>
