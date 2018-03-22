<?php

    include("../functions/odbc.php");
    $key=$_GET['key'];
    $array = array();
    $connection_string = "DRIVER={SQL Server};SERVER=$sql_server;DATABASE=$sql_database";
    $conne = odbc_connect($connection_string,$sql_user,$sql_pass);
    if ($conne){
        $query = "SELECT ICL.CAMPLIB2 , I.DESCR FROM INVE01 AS I
        INNER JOIN INVE_CLIB01 AS ICL ON I.CVE_ART = ICL.CVE_PROD
        WHERE ICL.CAMPLIB2 like '%{$key}%'";
        $consulta = odbc_exec($conne, $query);

        if(!$consulta){
          exit("Error en consulta SQL");
        } # fin IF si hay error en la consulta
        while ($row=odbc_fetch_row($consulta)){
            $fila = utf8_encode(odbc_result($consulta, "CAMPLIB2")." - ".odbc_result($consulta, "DESCR"));
            $array[] = $fila;
            #$array[] = odbc_result($consulta, "NOMBRE");
        } #Fin while de recorrido de la consulta

        odbc_close($conne); #Cerrando la conexion odbc
    }
    echo json_encode($array);
?>
