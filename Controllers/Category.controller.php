<?php

include "../functions.php";

$autoLoad = new Category();

class Category {
   public function __construct() {
      $action = isset($_GET["action"]) ? $_GET["action"] : header("location: ../index.php");;
      if($action == "delete") {
         $catId = $_POST['catId'];

         // Delete Function
         $this->deleteFromCat($catId);

         // Get The New Data from Database
         $stmt = $this->getCategoryData();

         // Output The New Data To users
         $this->table($stmt);
      } elseif($action == "add-category") {
         $this->insertNewCateg();
      }
   }

   // Connect To Databse Function
   private function conectDataBase(){
      $load = new DataBase();
      $con = $load->_connect();
      return $con;
   }

   // This Function is to show The output (Result)
   private function table($stmt) {
      while($ftc = $stmt->fetch()) {
         $id = $ftc['cat_ID'];
         $con = $this->conectDataBase();
         $stmt2 = $con->prepare("SELECT COUNT(Item_ID) FROM items WHERE Category = '$id'");
         $stmt2->execute();
         $ftc2 = $stmt2->fetchColumn();

         echo "<tr>
            <th class='id text-center'>" . $id  . "</th>
            <td>" . $ftc['Name'] . "</td>
            <td>" . $ftc2 . "</td>
            <td class='text-center'>
               <a onclick='deleteCategory(" . $id . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
            </td>
         </tr>";
      }
   }

   private function deleteFromCat($id) {
      $con = $this->conectDataBase();
   
      $stmt = $con->prepare("DELETE FROM categories WHERE Cat_id = '$id'");
      $stmt->execute();

      return $stmt;
   }

   /* 
      Function to get data from database
   */
   private function getCategoryData() {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM categories");
      $stmt->execute();
      
      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 36px'></i><p>No Categories To Show</p></th>";
      }

      return $stmt;
   }

   private function insertNewCateg() {
      $con = $this->conectDataBase();

      $name = filter_var($_POST["catName"], FILTER_SANITIZE_STRING);

      $errors = array();

      if(empty($name)) {
         $errors[] = "Please Enter The Name";
      }

      foreach($errors as $error) {
         echo $error;
      }

      $stmt = $con->prepare("INSERT INTO categories(Name) VALUE(?)");
      $stmt->execute(array($name));
   }
}