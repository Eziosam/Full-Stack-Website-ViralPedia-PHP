<?php

class connection{
  private $con;

  protected function connect(){

  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "170204047";

  $dsn = 'mysql:host='.$host.';dbname='.$dbname;

  try{
   $this->con = new PDO ($dsn,$user,$password);
   $this->con->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
   $this->con->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   return $this->con;
  }
  catch(PDOException $e){
    echo "Connection failed: ".$e->getMessage();
  }
}

}
?>
