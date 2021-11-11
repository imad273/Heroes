<?php

session_start();

include "../functions.php";

$autoLoad = new Profile();

class Profile {

   public function __construct() {
      $action = isset($_GET["action"]) ? $_GET["action"] : header("location: ../index.php");;
      if($action == "edit-admin") {
         $id = $_SESSION['admin_login'];

         // Insert The new Data In Database
         $this->insertEditp($id);

      } elseif ($action == "edit-pass") {
         $id = $_SESSION['admin_login'];

         // Insert The new Data In Database
         $this->insertpass($id);
      }
   }

   // Connect To Databse Function
   private function conectDataBase(){
      $load = new DataBase();
      $con = $load->_connect();
      return $con;
   }

   // Insert The Edit's Into The Database
   private function insertEditp($id) {
      
      $con = $this->conectDataBase();
         
      $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
      $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);

      $errors = array();

      if(empty($username)) {
         $errors[] = "Please Enter Username";
      } elseif (empty($email)) {
         $errors[] = "Please Enter Email";
      } elseif (empty($name)) {
         $errors[] = "Please Enter Name";
      }

      foreach($errors as $error) {
         echo $error;
      }

      if(empty($errors)) {
         $stmt = $con->prepare("UPDATE users SET UserName = ?, Email = ?, Name = ? WHERE User_id = '$id'");
         $stmt->execute(array($username, $email, $name));
         echo "succ";
      }
   }

   private function insertpass($id) {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM users WHERE User_id = $id");
      $stmt->execute();
      $ftc = $stmt->fetch();

      $oldPass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
      $newPass = filter_var($_POST['new-pass'], FILTER_SANITIZE_STRING);
      $conPass = filter_var($_POST['con-pass'], FILTER_SANITIZE_STRING);

      $errors = array();

      if(empty($oldPass)) {
         $errors[] = "Please Enter Your Password";
      } elseif (empty($newPass)) {
         $errors[] = "Please Enter New Password";
      } elseif (empty($conPass)) {
         $errors[] = "Please Confirm Your New Password";
      }

      foreach($errors as $error) {
         echo $error;
      }

      if(empty($errors)) {
         if(password_verify($oldPass, $ftc['Password'])) {
            if($newPass !== $conPass) {
               echo "Password Not Match";
            } else {
               $password = password_hash($newPass, PASSWORD_DEFAULT);
               $stmt = $con->prepare("UPDATE users SET Password = ? WHERE User_id = '$id'");
               $stmt->execute(array($password));
               echo "succ";
            }
         } else {
            echo "The Current Password is Wrong";
         }
      }
   }
}

?>