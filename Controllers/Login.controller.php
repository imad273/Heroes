<?php 
session_start();
include "../database.php";

$autoLoad = new login();

class login {
   private $username;
   private $password;

   public function __construct() {
      $this->username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
      $this->password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

      $db = new DataBase();
      $con = $db->_connect();
      $this->checkExist($con, $this->username, $this->password);
   }

   public function checkExist($con, $username, $password) {
      $stmt = $con->prepare("SELECT * FROM users WHERE UserName = '$username' AND isAdmin = 1");
      $stmt->execute();
      $ftc = $stmt->fetch();
      if($stmt->rowCount() > 0) {
         $verf = password_verify($password, $ftc['Password']);
         if($verf == true) {
            echo "seccess Login";
            $_SESSION["admin_login"] = $ftc["User_id"];
         } else {
            echo "Password is incorrect";
         }
      } else {
         echo "Wrong username";
      }
   }
}
?>