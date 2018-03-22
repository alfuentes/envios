<?php
function Conectar(){
  $conn = null;
/**/
## CONEXION FREE SQL
  $host = 'sql3.freesqldatabase.com';
  $db = 'sql3201771';
  $user = 'sql3201771';
  $pwd = 'gTeyQbhvWq';

/*
## CONEXION LOCAL
  $host = 'localhost';
  $db = 'envios';
  $user = 'root';
  $pwd = '';
  /**/

  try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
  }catch(PDOException $e){
    echo ':( Error al conectar con la base de datos '.$e;
    exit;
  }
  return $conn;
}

class AccesoDB {
/**/
  ## CONEXION FREE SQL
   private $dbHostname = "sql3.freesqldatabase.com";
   private $dbDatabase = "sql3201771";
   private $dbUser = "sql3201771";
   private $dbPass = "gTeyQbhvWq";

/*
## CONEXION LOCALHOST
   private $dbHostname = "localhost";
   private $dbDatabase = "envios";
   private $dbUser = "root";
   private $dbPass = "";
/**/

   public function getHost(){
     return $this->dbHostname;
   }

   public function getUser(){
     return $this->dbUser;
   }

   public function getPass(){
     return $this->dbPass;
   }

   public function getDatabase(){
     return $this->dbDatabase;
   }
}


?>
