<?php

include "../functions.php";

$autoLoad = new Cusmtomers();

class Cusmtomers {

   public function __construct() {
      $action = isset($_GET["action"]) ? $_GET["action"] : header("location: ../index.php");;
      if($action == "search") {
         // Search Function
         $stmt = $this->search();

         // Output The New Data To users
         $this->table($stmt);
      } elseif ($action == "delete") {
         $itemId = $_POST['userId'];

         // Delete Function
         $this->deleteFromCust($itemId);

         // Get The New Data from Database
         $stmt = $this->getCustomersData();

         // Output The New Data To users
         $this->table($stmt);

      }
   }

   // This Function is to show The output (Result)
   private function table($stmt) {
      while($ftc = $stmt->fetch()) {
         echo "<tr>
            <td>" . $ftc['Name'] . "</td>
            <td>" . $ftc['UserName'] . "</td>
            <td>" . $ftc['Email'] . "</td>
            <td>" . $ftc['Country'] . "</td>
            <td>" . formateDate($ftc['Date']) . "</td>
            <td class='text-center'>
               <a onclick='deleteUser(" . $ftc['User_id'] . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
            </td>
         </tr>";
      }
   }

   // Connect To Databse Function
   private function conectDataBase(){
      $load = new DataBase();
      $con = $load->_connect();
      return $con;
   }

   /* 
      Function to get data from database
      * 1 = 1 is mean everything 
   */
   private function getCustomersData() {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM users WHERE isAdmin = 0");
      $stmt->execute();
      
      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 36px'></i><p>No Items To Show</p></th>";
      }

      return $stmt;
   }

   // Get Data Search From Database Function
   private function getSearchData($keyword) {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM users WHERE Name LIKE $keyword");
      $stmt->execute();

      // If The Keyword Not Matched
      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-error-alt bx-flashing' style='color: #FF3A3A; font-size: 36px'></i><p>No Search Match</p></th>";
      }

      return $stmt;
   }

   // Get The Search Data Of The Keyword Data Function
   private function search() {
      $keyValue = filter_var($_POST["keyword"], FILTER_SANITIZE_STRING);
      if($keyValue == "") {
         $stmt = $this->getCustomersData();
      } else {
         $keyword = "'%" . $keyValue . "%'";
         $stmt = $this->getSearchData($keyword);
      }

      return $stmt;
   }

   // Delete User From Database
   private function deleteFromCust($id) {
      $con = $this->conectDataBase();
   
      $stmt = $con->prepare("DELETE FROM users WHERE User_id = '$id'");
      $stmt->execute();

      return $stmt;
   }
}