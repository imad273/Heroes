<?php 

class DataBase {
   public $dsn = "mysql:host=localhost;dbname=heroes";
   public $username = "root";
   public $password = "";

   public function _connect() {
      try {
         $con = new PDO($this->dsn, $this->username, $this->password);
         return $con;
      } catch(PDOException $e) {
         echo "Error: " . $e->getMessage();
      }
   }
}

?>